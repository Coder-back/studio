<?php
include("connection.php")
// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Check if email is provided
  if (empty($_POST["email"])) {
    $error_message = "Please enter your email address.";
  } else {
    // Sanitize email input
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Check if email is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error_message = "Invalid email address.";
    } else {
      
      // Connect to database
      $conn = new mysqli("$dbhost,$dbuser,$dbpass,$dbname");

      // Check if connection was successful
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Generate a random password reset token
      $token = bin2hex(random_bytes(16));

      // Set the token and expiry time in the database
      $stmt = $conn->prepare("UPDATE users SET reset_token=?, reset_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email=?");
      $stmt->bind_param("ss", $token, $email);
      $stmt->execute();

      // Check if a user with that email address exists
      if ($stmt->affected_rows == 0) {
        $error_message = "No user found with that email address.";
      } else {
        // Send password reset email
        $to = $email;
        $subject = "Password reset request";
        $message = "Hi,\n\nYou have requested to reset your password. Please click the link below to reset your password:\n\nhttp://example.com/reset_password.php?token=$token\n\nThis link is valid for the next hour only.\n\nIf you did not make this request, please ignore this email.\n\nThanks,\nThe Example Team";
        $headers = "From: webmaster@example.com" . "\r\n" .
                   "Reply-To: webmaster@example.com" . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        mail($to, $subject, $message, $headers);

        $success_message = "A password reset link has been sent to your email address.";
      }

      // Close database connection
      $stmt->close();
      $conn->close();
    }
  }
}
?>


<!DOCTYPE html>
<html>


<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bounce Studios</title>
  <link rel="stylesheet" type="text/css" href="./Styles/style.css">
  <link rel="icon" href="./Assets/Website icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
  <script src="https://use.fontawesome.com/e9a23594ea.js"></script>
</head>
<div class="log">

  <body>
    <h2>Reset Password</h2>
    <br>
    <p>Please enter your email address and we'll send you a link to reset your password.</p>
    <br>
    <form action="" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <input type="submit" value="Reset Password">
    </form>
  </body>
</div>

</html>