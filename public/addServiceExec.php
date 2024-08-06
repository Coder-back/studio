<?php include './session.php'; ?>
<?php
    //define variables
    $servicename = $image = $rate = $description = "";

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

    $errors = [];
    $dir = './uploads/';

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileError = $_FILES['image']['error'];

    if (empty($_POST['servicename'])) {
      $errors[] = "Service name is required";
      //array_push($errors, "Servicename is required")
    } else {
        $servicename = sanitize($_POST['servicename']);
    }

    if (empty($fileName)) {
        $errors[] = "Service image is required";
      } 
      else {
        $filename = basename($_FILES['image']['name']);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);
  
        $allowedImageTypes = array('jpg', 'jpeg', 'png', 'gif');
  
        if(in_array($filetype, $allowedImageTypes)) {
            if($fileError === 0){
                if(move_uploaded_file($fileTmpName, $dir.$filename)) {
                    $image = $fileName;
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
    
    if (empty($_POST['rate'])) {
        $errors[] = "Charge rate is required";
    } else {
        $rate = sanitize($_POST['rate']);
    }

    if (empty($_POST['description'])) {
        $errors[] = "Description is required";
    } else {
        $description = sanitize($_POST['description']);
    }

    // If there are no errors, insert into the database
    if (count($errors) == 0) {
    
    
    $queryService = "SELECT service_name FROM services WHERE service_name = '$servicename'";
    $Result = mysqli_query($conn,$queryService);

    if(mysqli_num_rows($Result) > 0){
        echo '<script>
                alert("The service name already exist");
                document.location.href = "addService.php";
            </script>';
        exit();
    } else {
            $query = "INSERT INTO services(service_name, service_image, description, rate) VALUES ('$servicename','$image','$description','$rate')";

            $insertData = mysqli_query($conn,$query);

            //check if query was successful
            if($insertData) {
                echo '<script>
                            alert("Service added successfully");
                            document.location.href = "adminDashboard.php";
                        </script>';
		    exit();
	        }else {
		    die("Failed to add service");
	        }

            // Close the database connection
            $conn->close();
    } 
} else {
    // Display the validation errors
    foreach ($errors as $error) {
        echo "<script>
            alert('$error');
            document.location.href = 'addService.php';
        </script>";
    }
}
    
}
?>