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
    <h2 class="book_title">Book Session with Bounce Studio</h2>
    <br>
    <form action="bookSessionExec.php" method="post" class="book_form">

    <?php 
      if(isset($_SESSION['status'])) {
    ?>
      <div class="message"><h3><?= $_SESSION['status']; ?></h3></div>
    <?php 
      unset($_SESSION['status']); }
    ?>
    
      <!--<label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Your name e.g. John" required>-->

      <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" placeholder="e.g. youremail@gmail.com" required>
      

      <label for="subject">Subject:</label>
      <input type="text" id="subject" name="subject" required>

      <label for="message">Message:</label>
      <textarea name="message" id="message" placeholder="message...." required="Required!"></textarea>
      
      <div class="add_btns">
      <button type="submit" class="book_btn">Book Session</button>
      <!--<a href="adminDashboard.php" class="back_btn">Back</a>-->
      </div>
    </form>
  </div>
  </body>
</html>