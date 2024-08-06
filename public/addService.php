<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bounce Studios</title>
  <link rel="stylesheet" type="text/css" href="./Styles/style.css">
  <link rel="stylesheet" type="text/css" href="./Styles/header.css">
  <link rel="icon" href="./Assets/Website icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">
  <script src="https://use.fontawesome.com/e9a23594ea.js"></script>
</head>

  <body>
  <!--<?php include('header.php'); ?>-->
  <div class="log">
    <h2 class="service_title">Service</h2>
    <br>
    <form action="addServiceExec.php" method="post" enctype="multipart/form-data" class="service_form">

      <label for="servicename">Service Name:</label>
      <input type="text" id="servicename" name="servicename" required>

      <label for="image">Service Image:</label>
      <input type="file" id="image" name="image" required>

      <label for="rate">Rate (KSH.):</label>
      <input type="number" id="rate" name="rate" required>

      <label for="description">Description:</label>
      <textarea name="description" id="description" placeholder="Description....." required="Required!"></textarea>
      
      <div class="add_btns">
      <input type="submit" value="Add Service" class="add_btn">
      <a href="adminDashboard.php" class="back_btn">Back</a>
      </div>
    </form>
  </div>
  </body>
</html>