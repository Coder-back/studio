<?php include './session.php'; ?>
<?php

    //define variables
    $username = $image = $email = $phone_number = $password = "";

    //sanitize form data
    function sanitize($data) {
        global $conn;
        $data = @trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return mysqli_real_escape_string($conn,$data);
    }

    $errors = [];

    // Validate the form data
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dir = './uploads/';

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileError = $_FILES['image']['error'];

    if (empty($_POST['username'])) {
      $errors[] = "Username is required";
    } 
    else if (!preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['username'])) {
      $errors[] = "Invalid username. Only alphanumeric characters, hyphens, and underscores are allowed.";
      //array_push($errors, "Invalid username. Only alphanumeric characters, hyphens, and underscores are allowed.")
    } else {
        $username = sanitize($_POST['username']);
    }

    if (empty($fileName)) {
        $errors[] = "Your photo is required";
      } 
      else {
        $filename = basename($_FILES['image']['name']);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
  
        $allowedImageTypes = array('jpg', 'jpeg', 'png', 'gif');
  
        if(in_array($filetype, $allowedImageTypes)) {
            $imgName = uniqid("IMG-", true).'.'.$imageExtension;
            if($fileError === 0){
                if(move_uploaded_file($fileTmpName, $dir.$imgName)) {
                    $image = $imgName;
                } else {
                    echo '<script>
                            alert("Failed to upload file");
                        </script>';
                }
            }else {
                $errors[] = "There was an error uploading the image";
            }

          } else {
              $errors[] = "Invalid image format! Only jpg, jpeg, png & gif are allowed";
          }
      }
    
    if (empty($_POST['email'])) {
        $errors[] = "Email is required";
    } 
    else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        $email = sanitize($_POST['email']);
    }

    if (empty($_POST['phone'])) {
        $errors[] = "Phone no. is required";
    } 
    else if (!preg_match('/^[+][0-9]{10,}$/', $_POST['phone'])) {
        $errors[] = "Invalid phone number! Should start with +country code...";
    } else {
        $phone_number = sanitize($_POST['phone']);
    }


    if (empty($_POST['password'])) {
        $errors[] = "Password is required";
      } 
      else if ($_POST['password'] != $_POST['confirm_password']) {
        $errors[] = "Passwords do not match";
      }
      else if (!preg_match('/^(?=.*[A-Za-z])(?=.*[@#$%^&*-+=]).{8,24}$/', $_POST['password'])) {
        $errors[] = "Password should contain atleast one special character & be atleast 8 characters!";
      } else {
        $password = sanitize($_POST['password']);
      }

    // If there are no errors, insert the user into the database
    if (count($errors) == 0) {

    //hash password --> $password = password_hash($pass, PASSWORD_BCRYPT);
    
    //check whether an account with the email exist
    $queryuser = "SELECT email FROM users WHERE email = '$email'";
    $userResult = mysqli_query($conn,$queryuser);

    if(mysqli_num_rows($userResult) > 0){
        //$errors[] = "This email is already used by someone else. Try a different email kindly"; //-->
        echo '
            <script>
                alert("This email is already used by someone else. Try a different email kindly");
                document.location.href = "adduser.php";
            </script>
        ';
        exit();
    } else {
        //insert data
        $query = "INSERT INTO users(user_name, user_image, email, phone_no, password) VALUES('$username','$image','$email','$phone_number','$password')";

        $insertData = mysqli_query($conn,$query);

        //check if query was successful
        if($insertData) {
            echo '
                <script>
                    alert("User added successfully");
                    document.location.href = "adminDashboard.php";
                </script>
            ';
		    exit();
	    }else {
		    die("Something went wrong.\n Our team is working on it.\n Please try again after some few minutes.");
            //echo "<h3 style='color:red'>User not registered. Please try again.</h3>".mysqli_error($connection);
	    }

        // Close the database connection
        $conn->close();
    } 
} else {
    // Display the validation errors
    foreach ($errors as $error) {
        echo "
            <script>
                alert('$error');
                document.location.href = 'addUser.php';
            </script>
        ";
    }
}
    
}
?>