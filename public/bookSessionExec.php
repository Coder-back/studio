<?php include './session.php'; ?>
<?php
    //name spaces
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //define variables
    $email = $subject = $message = "";

    //sanitize form data
    function sanitize($data) {
        global $conn;
        $data = @trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return mysqli_real_escape_string($conn,$data);
    }

    // Validate the form data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    /*if (empty($_POST['name'])) {
      $errors[] = "name is required";
    } 
    else if (!preg_match('/^[a-zA-Z0-9]+$/', $_POST['name'])) {
      $errors[] = "Invalid name. Only alphanumeric characters are allowed.";
      //array_push($errors, "Invalid name. Only alphanumeric characters, hyphens, and underscores are allowed.")
    } else {
        $name = sanitize($_POST['name']);
    }*/
    
    if (empty($_POST['email'])) {
        $_SESSION['status'] = "Email is required";
    } 
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format";
    } else if (empty($_POST['subject'])) {
        $_SESSION['status'] = "Subject is required";
    } 
    else if (empty($_POST['message'])) {
        $_SESSION['status'] = "Message is required";
    }  else {
        $email = sanitize($_POST['email']);
        $subject = sanitize($_POST['subject']);
        $message = sanitize($_POST['message']);



        $mail = new PHPMailer(true); //new PHPMailer;

        //$mail->SMTPDebug = 3;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls'; //ssl
        $mail->Port = 587; //465 --> ssl
        $mail->Username = 'boncestudios@gmail.com';
        $mail->Password = 'fbglkjbwatgxigqi'; //app password -> security -> generate app password

        $mail->setFrom($email); //email from input
        $mail->addAddress('boncestudios@gmail.com');

        $mail->isHTML(true);

        //$mail->addAttachment()
        $mail->Subject = $subject; //$subject
        $mail->Body = $message;

        //$mail->send();

        if($mail->send()) {
        
        //insert data
        $query = "INSERT INTO bookings(user_id, email, subject, message) VALUES('$user_id','$email','$subject','$message')";
        
        $insertData = mysqli_query($conn,$query);

        //check if query was successful
        if($insertData) {

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
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject; //$subject

        $mail_template = "
          <h2>Hello,</h2>
          <h3>Your request has been received and we will get back to you about your booking.<br />Thank you for choosing Bounce Studio</h3>
          <br /><br />
          <h3>Regards<h3/>
          <h3>Bounce Studio.<h3/>
          ";
          
        $mail->Body = $mail_template;

        $mail->send();

            $_SESSION['status'] = "Thank you for your choosing Bounce Studio!\nYour Session booking is successful.";
            header('location: bookSession.php');
            exit(0);
    
	    }else {
		    die("Session booking failed!");
            //echo "<h3 style='color:red'></h3>".mysqli_error($connection);
	    }

        // Close the database connection
        $conn->close();
        } else {
            $_SESSION['status'] = "Session booking not successful! Please try again";
            header('location: bookSession.php');
            exit(0);
        }
        
        //header("Location: thankyou.php");

        $mail->smtpClose();
    }
    
}
?>