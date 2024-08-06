<?php include './session.php'; ?>
<?php

//define variables
$title = $genre = $release_date = $artist_id = "";

//sanitize  form data
function sanitize($data) {
    global $conn;
    $data = @trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    return mysqli_real_escape_string($conn,$data);
}

// Validate the form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


if (empty($_POST['artist_id'])) {
  $_SESSION['status'] = "Please enter artist unique id";
}
else if (empty($_POST['title'])) {
  $_SESSION['status'] = "Please enter song title!";
}
else if (empty($_POST['genre'])) {
  $_SESSION['status'] = "Song genre is required!";
}
else if (empty($_POST['release_date'])) {
  $_SESSION['status'] = "Please enter the song release date";
  }
  else {

    $artist_id = sanitize($_POST['artist_id']);
    $title = sanitize($_POST['title']);
    $genre = sanitize($_POST['genre']);
    $release_date = sanitize($_POST['release_date']);

    //check artist_id
    $queryArtist = "SELECT * FROM users WHERE user_id = '$artist_id' LIMIT 1";
    $artistResult = mysqli_query($conn,$queryArtist);

    if(mysqli_num_rows($artistResult) > 0){
      
      //insert data
    $query = "INSERT INTO songs(song_title, song_genre, release_date, artist_id) VALUES('$title','$genre','$release_date','$artist_id')";

    $insertData = mysqli_query($conn,$query);

    //check if query was successful
    if($insertData) {
      $_SESSION['status'] = "The song has been added successfully!";
      header('location: addSong.php');
      exit(0);
    } else {
      $_SESSION['status'] = "Something went wrong.\n Please try again.";
      header('location: addSong.php');
      exit(0);
    }
  } else {
    $_SESSION['status'] = "No registered artist with the Id entered!";
      header('location: addSong.php');
      exit(0);
  }
    // Close the database connection
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
    <h2 class="add_song_form_title">Add Song</h2>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data" class="add_song_form">
    <?php 
      if(isset($_SESSION['status'])) {
    ?>
      <div class="message"><h3><?= $_SESSION['status']; ?></h3></div>
    <?php 
      unset($_SESSION['status']); }
    ?>
        <label for="title">Song Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="genre">Genre:</label>
        <input type="text" id="genre" name="genre" required>

        <label for="release_date">Release Date:</label>
        <input type="date" id="release_date" name="release_date" required>

        <label for="artist_id">Artist Id:</label>
        <input type="number" id="artist_id" name="artist_id" required>

        <div class="add_btns">
            <input type="submit" value="Add Song" class="add_btn">
            <a href="adminDashboard.php" class="back_btn">Back</a>
        </div>
    </form>
  </div>
  </body>

</html>