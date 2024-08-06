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
    <h2 class="equip_title">Add Studio Gears</h2>
    <br>
    <form action="addEquipmentExec.php" method="post" enctype="multipart/form-data">

      <label for="equipmentname">Equipment Name:</label>
      <input type="text" id="equipmentname" name="equipmentname" required>

      <label for="image">Equipment Image:</label>
      <input type="file" id="image" name="image" required>

      <label for="description">Description:</label>
      <textarea name="description" id="description" placeholder="Description....." required="Required!"></textarea>

      <label for id="availability_label">Availability:
      <input type="radio" name="availability" value="Yes" required class="availability"><span class="availability_text">Yes</span>
      <input type="radio" name="availability" value="No" required class="availability"><span class="availability_text">No</span>
      </label>

      <div class="add_btns">
      <input type="submit" value="Add Gear" class="add_btn">
      <a href="adminDashboard.php" class="back_btn">Back</a>
      </div>
    </form>
  </div>
  </body>
</html>