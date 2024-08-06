<?php include './session.php'; ?>
<?php

//sanitize form data
function sanitize($data) {
  global $conn;
  $data = @trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  
  return mysqli_real_escape_string($conn,$data);
}

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST['review']) || empty($_POST['rating'])) {
    echo '
      <script>
          alert("Please fill out all fields");
        </script>
      ';
  } else {
    // Sanitize inputs
    $review = sanitize($_POST['review']);
    $rating = sanitize($_POST['rating']);

    // Insert review into database
    $query = "INSERT INTO reviews(user_id, review, rating) VALUES ('$user_id','$review','$rating')";

    $insertData = mysqli_query($conn,$query);

    //check if query was successful
    if($insertData) {
      echo '
        <script>
            alert("Thank you for your review!");
            document.location.href = "index.php";
        </script>
        ';
      exit();
    } else {

      die("Failed to add equipment");

    }
    // Close database connection
    $conn->close();
  }
}
?>