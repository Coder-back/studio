<?php include './session.php'; ?>
<?php
//variables
$token = $email = "";


//sanitize form data
function sanitize($data) {
  global $conn;
  $data = @trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return mysqli_real_escape_string($conn,$data);
}

// Check if form has been submitted -->$email = sanitize($_POST['email']);

if(isset($_POST['password_set'])) {
  
  if (empty($_POST['password'])) {
    $_SESSION['status'] = "Password is required";
  } 
  else if ($_POST['password'] != $_POST['confirm_password']) {
    $_SESSION['status'] = "Passwords do not match";
  }
  else if (!preg_match('/^(?=.*[A-Za-z])(?=.*[@#$%^&*-+=]).{8,24}$/', $_POST['password'])) {
    $_SESSION['status'] = "Password should contain atleast one special character & be atleast 8 characters!";
  } else {
    $email = sanitize($_POST['email']);
    $token = sanitize($_POST['token']);

    if (!empty($token)) {
    $password = sanitize($_POST['password']);

    $checkToken = "SELECT verify_token FROM users WHERE `verify_token` = '$token' LIMIT 1";
    $tokenResult = mysqli_query($conn,$checkToken);

    if(mysqli_num_rows($tokenResult) > 0){

      $updatePassword = "UPDATE users SET password = '$password' WHERE `verify_token` = '$token' LIMIT 1";
      $updatePasswordRun = mysqli_query($conn, $updatePassword);

      if ($updatePasswordRun){
        
        $new_token = md5(rand());
        $updateToken = "UPDATE users SET verify_token = '$new_token' WHERE `verify_token` = '$token' LIMIT 1";
        $updateTokenRun = mysqli_query($conn, $updateToken);

        $_SESSION['status'] = "New Password Updated Successfully!";
        header("location: signIn.php");
        exit(0);

      } else {

        $_SESSION['status'] = "Something went wrong. Please try again.";
        header("location: password_set.php?token=$token&email=$get_mail");
        exit(0);

      }

    } else {

      $_SESSION['status'] = "Invalid Token";
      header("location: password_set.php?token=$token&email=$get_mail");
      exit(0);

    }

    $conn->close();

  } else{
    
    $_SESSION['status'] = "No reset token available!Maybe you refreshed the link";
    header("location: resetPassword.php");
    exit(0);
  
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

  <body>
  <div class="log reset">
    <h2 class="reset_title">Set Password</h2>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" class="passwor_reset_form">
    <?php 
      if(isset($_SESSION['status'])) {
    ?>
      <div class="message"><h3><?= $_SESSION['status']; ?></h3></div>
    <?php 
      unset($_SESSION['status']); }
    ?>

          <label for="email">Email:</label>
          <input type="email" id="email" name="email" value="<?php if(isset($_GET['email'])){ echo $_GET['email'];} ?>" required placeholder="e.g yourname@gmail.com">

          <label for="token">Token:</label>
          <input type="text" id="token" name="token" value="<?php if(isset($_GET['email'])){ echo $_GET['token'];} ?>" required>

          <label for="password">New Password:</label>
          <input id="password" type="password" name="password" required placeholder="******">

          <label for="confirmPassword">Confirm Password:</label>
          <input id="confirmPassword" type="password" name="confirm_password" required placeholder="******">

          <input id="save_changes" type="submit" name="password_set" value="Update Password">
      </form>
    </div>
  </body>
</html>