<?php include './session.php'; ?>
<?php
//name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function send_password_reset_link($get_name,$get_mail,$token) {
  $mail = new PHPMailer(true); //new PHPMailer;

        //$mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; //ssl
        $mail->Port = 587; //465 --> ssl
        $mail->Username = 'boncestudios@gmail.com';
        $mail->Password = 'fbglkjbwatgxigqi'; //app password -> security -> generate app password

        $mail->setFrom('boncestudios@gmail.com', 'Bounce Studio'); //email from input
        $mail->addAddress($get_mail);

        $mail->isHTML(true);
        $mail->Subject = 'Password Reset'; //$subject

        $mail_template = "
          <h3>Hello $get_name,</h3>
          <h4>You are receiving this email to confirm password reset request for your account</h4>
          <br />
          <a href='http://localhost:8080/studio-master/public/password_set.php?token=$token&email=$get_mail'>Click to reset</a>
          <br /><br />
          <h4>Regards<br />Bounce Studio.<h4/>
          ";
        $mail->Body = $mail_template;

        $mail->send();

        $mail->smtpClose();
}

//sanitize form data
function sanitize($data) {
  global $conn;
  $data = @trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return mysqli_real_escape_string($conn,$data);
}


// Check if form has been submitted
if(isset($_POST['password_reset'])) {
  // Check if email is provided
  if (empty($_POST["email"])) {
    $_SESSION['status'] = "Please enter your email address.";
  } 
  else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['status'] = "Invalid email format";
  } else {
    $email = sanitize($_POST['email']);
  

    $token = md5(rand());

    $checkMail = "SELECT * FROM users WHERE `email` = '$email' LIMIT 1";
    $mailResult = mysqli_query($conn,$checkMail);

    if(mysqli_num_rows($mailResult) > 0){
      $received = mysqli_fetch_assoc($mailResult);

      $get_name = $received['user_name'];
      $get_mail = $received['email'];

      $updateToken = "UPDATE users SET verify_token = '$token' WHERE `email` = '$get_mail' LIMIT 1";
      $updateTokenRun = mysqli_query($conn, $updateToken);

      if ($updateTokenRun){

        send_password_reset_link($get_name,$get_mail,$token);
        $_SESSION['status'] = "We emailed you a reset link.\nCheck your email to set your password";
        header("location: resetPassword.php");
        exit(0);

      } else {
        $_SESSION['status'] = "Something went wrong. Please try again.";
        header("location: resetPassword.php");
        exit(0);
      }

    } else {
      //echo '<h4 style="color: #ff0000;fontSize: 1rem;"></h4>';
      $_SESSION['status'] = "No account matching the email was found!\nPlease confirm and try again.";
      header("location: resetPassword.php");
      exit(0);
    }
  $conn->close();
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


  <body>
  <div class="log">
    <h2>Reset Password</h2>
    <p>Please enter your email address to receive a password reset link.</p>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
    <?php 
      if(isset($_SESSION['status'])) {
    ?>
      <div class="message"><h3><?= $_SESSION['status']; ?></h3></div>
    <?php 
      unset($_SESSION['status']); }
    ?>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required placeholder="yourname@gmail.com">

      <input id="reset_btn" name="password_reset" type="submit" value="Reset Password">
    </form>
    </div>
  </body>
</html>