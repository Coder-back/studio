<?php

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = 'All fields are required';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email format';
    }
    
    $query = "INSERT INTO bookings ( name, email, subject, messsage) VALUES ('$name', '$email', '$subject', '$message')";

    // If there are no errors, send the email
    if (!isset($error)) {
        $to = 'cavinekotieno@gmail.com';
        $headers = "From: $name <$email>\r\nReply-To: $email\r\n";
        if (mail($to, $subject, $message, $headers)) {
            $success = 'Your message has been sent';
        } else {
            $error = 'Unable to send email. Please try again later.';
        }
    }
}
?>

<!-- Display success or error message -->
<?php if (isset($success)): ?>
<p class="success"><?php echo $success; ?></p>
<?php elseif (isset($error)): ?>
<p class="error"><?php echo $error; ?></p>
<?php endif; ?>