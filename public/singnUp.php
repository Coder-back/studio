<?php
session_start();

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the submitted form data
    
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $account_type = $_POST['account_type'];


    // Validate the form data
    $errors = [];

    if (empty($username)) {
      $errors[] = "Username is required";
    } else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
      $errors[] = "Invalid username. Only alphanumeric characters, hyphens, and underscores are allowed.";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }


    if (empty($password)) {
        $errors[] = "Password is required";
    } else if ($password != $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    // If there are no errors, insert the user into the database
    if (count($errors) == 0) {


        // Check for errors
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Build the query to insert the user
        $query = "INSERT INTO users ( user_name, email, password, account_type) VALUES ('$username', '$email', '$password', '$account_type')";

        // Run the query 
        if ($conn->query($query) === TRUE) {
            // Registration successful, redirect to login page
            header('Location: SignIn.php');
        } else {
            // Registration failed, display an error message
            echo "<p>Error: " . $query . "<br>" . $conn->error . "</p>";
        }

        // Close the database connection
        $conn->close();
    } else {
        // Display the validation errors
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
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
    <h2>Sign Up</h2>
    <br>
    <form action="" method="post">

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      <br></br>

      <label>
        Account type:
        <select name="account_type" required>
          <option value="">Select account type</option>
          <option value="admin">Admin</option>
          <option value="client">Client</option>
        </select>
      </label>

      <input type="submit" value="Sign Up">
      <br></br>
      <p>Already have an account?<a href="signIn.php">Sign In</a></p>
    </form>
  </body>
</div>

</html>