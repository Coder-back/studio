<?php include './session.php'; ?>
<?php
    //define variables
    $equipmentname = $description = $availability ="";


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

    if (empty($_POST['equipmentname'])) {
      $errors[] = "Equipment name is required";
      //array_push($errors, "Equipmentname is required")
    } else {
        $equipmentname = sanitize($_POST['equipmentname']);
    }

    if (empty($fileName)) {
        echo '
            alert("Equipment image is required")
            ';
      
    } else {
        $filename = basename($_FILES['image']['name']);
        $filetype = pathinfo($filename, PATHINFO_EXTENSION);

        $allowedImageTypes = array('jpg', 'jpeg', 'png', 'gif', 'webp');

        if(in_array($filetype, $allowedImageTypes)) {
            if($fileError === 0) {
                if(move_uploaded_file($fileTmpName, $dir.$filename)) {
                    $image = $fileName;
                    //addslashes(file_get_contents($fileTmpName));
                } else {
                    echo '<script>
                            alert("Failed to upload file");
                        </script>';
                }
            } else {
                echo '<script>
                        alert("There was an error uploading the image");
                    </script>';
            }

        } else {
            echo '
                <script>
                    alert("Invalid image format! Only jpg, jpeg, png & gif are allowed");
                </script>
            ';
        }
    }
    

    if (empty($_POST['description'])) {
        $errors[] = "Description is required";
    } else {
        $description = sanitize($_POST['description']);
    }

    if (empty($_POST['availability'])) {
        $errors[] = "Availability should be stated";
    } else {
        $availability = sanitize($_POST['availability']);
    }

    // If there are no errors, insert into the database
    if (count($errors) == 0) {
    
    $queryEquipment = "SELECT equipment_name FROM equipment WHERE equipment_name = '$equipmentname'";
    $Result = mysqli_query($conn,$queryEquipment);

    if(mysqli_num_rows($Result) > 0){
        echo '
            <script>
                alert("The equipment already exist");
                document.location.href = "addEquipment.php";
             </script>
            ';
        exit();
    } else {
        //insert data --> imagename || image
        $query = "INSERT INTO equipment(equipment_name, equipment_image, description, availability) VALUES ('$equipmentname','$image','$description','$availability')";

        $insertData = mysqli_query($conn,$query);

        //check if query was successful
        if($insertData) {
            echo '
            <script>
                alert("Equipment added successfully");
                document.location.href = "adminDashboard.php";
             </script>
            ';
		    exit();
	    }else {
		    die("Failed to add equipment");
	    }

        // Close the database connection
        $conn->close();
    } 
} else {
    // Display the validation errors
    foreach ($errors as $error) {
        echo '
            <script>
                alert("'. $error .'");
                document.location.href = "addEquipment.php";
             </script>
        ';
    }
}
    
}
?>