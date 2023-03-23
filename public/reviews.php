<?php
   include("connection.php");

// // Connect to database
// $conn = new mysqli("localhost", "username", "password", "database_name");

// // Check if connection was successful
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// Check if form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if name, review, and rating are provided
  if (empty($_POST["name"]) || empty($_POST["review"]) || empty($_POST["rating"])) {
    $error_message = "Please fill out all fields.";
  } else {
    // Sanitize inputs
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $review = filter_var($_POST["review"], FILTER_SANITIZE_STRING);
    $rating = filter_var($_POST["rating"], FILTER_SANITIZE_NUMBER_INT);

    // Insert review into database
    $stmt = $conn->prepare("INSERT INTO reviews (name, review, rating) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $name, $review, $rating);
    $stmt->execute();

    header("Location: thankyou.php");

    $success_message = "Thank you for your review!";
  }
}

// Fetch reviews from database
$result = $conn->query("SELECT * FROM reviews ORDER BY review_id DESC");
$reviews = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
  }
}

// Close database connection
$conn->close();
?>