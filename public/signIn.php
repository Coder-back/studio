<?php
session_start();
  
   include("connection.php");
 

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];



    // Check for errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Build the query to check the user's credentials
    $query = "SELECT * FROM users WHERE user_name='$username' AND password='$password'";

    // Run the query
    $result = $conn->query($query);

    // Check if the login was successful
    if ($result->num_rows > 0) {
        // Login successful, set the session variable
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        // Login failed, display an error message
        echo "<p>Invalid username or password.</p>";
    }

    // Close the database connection
    $conn->close();
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
    <h2>Sign In</h2>
    <br>
    <form action="" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <br></br>
      <p>Forgot password?<a href="resetPassword.php">Reset password</a></p>

      <input type="submit" value="Sign In">
      <br></br>
      <p>Don't have an account?<a href="singnUp.php">Sign Up</a></p>
    </form>
  </body>
</div>

</html>