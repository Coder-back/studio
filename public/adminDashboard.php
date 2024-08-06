<?php include './session.php'; ?>
<?php

if(isset($_SESSION['username'])){
      if($_SESSION['username'] != 'admin'){
        header('location: index.html');
      }
}
  else{
    header('location: adminDashboard.php');
  }

  if(isset($_GET['id'])) {
    $table = $_GET['table'];
    $id_name = $_GET['id_name'];
    $id = $_GET['id'];

    delete($table, $id_name, $id);
  }

  //sanitize user add form data
  function sanitize($data) {
    global $conn;
    $data = @trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return mysqli_real_escape_string($conn,$data);
  }

           function getAllUsers($table){
            global $conn;
            $getUsers = "SELECT * FROM `$table`";
            $totalUsers = mysqli_query($conn,$getUsers);
            if($totalUsers) {
              $row =mysqli_num_rows($totalUsers);
              if($row<1){
                echo "0";
              }
              else{
              echo $row;
              }
            }
           }

           function getAllServices($table){
            $getServices = "SELECT * FROM `$table`";
            $totalServices = mysqli_query($GLOBALS['conn'],$getServices);

            if($totalServices) {
              $row = mysqli_num_rows($totalServices);
              if($row<1){
                echo "0";
              }
              else{
              echo $row;
              }
            }
           }

           function getAllEquipments($table){
            $getEquipments = "SELECT * FROM `$table`";
            $totalEquipments = mysqli_query($GLOBALS['conn'],$getEquipments);
            
            if($totalEquipments) {
              $row = mysqli_num_rows($totalEquipments);
                if($row<1){
                  echo "0";
                }
                else{
                echo $row;
                }
              }
           }

           function getAllSessions($table){
            $getSessions = "SELECT * FROM `$table`";
            $totalsessions = mysqli_query($GLOBALS['conn'],$getSessions);
            
            if($totalsessions) {
              $row = mysqli_num_rows($totalsessions);
              if($row<1){
                echo "0";
              }
              else{
              echo $row;
              }
            }
           }
          
           function getAllSongs($table){
            $getSongs = "SELECT * FROM `$table`";
            $totalSongs = mysqli_query($GLOBALS['conn'],$getSongs);
            $row = mysqli_num_rows($totalSongs);

                if($row<1){
                  echo "0";
                }
                else{
                echo $row;
                }
           }

           function getAllReviews($table){
            $getReviews = "SELECT * FROM `$table`";
            $reviews = mysqli_query($GLOBALS['conn'],$getReviews);
            
            if($reviews) {
              $row = mysqli_num_rows($reviews);
                if($row<1){
                  echo "0";
                }
                else{
                echo $row;
                }
              }
           }

           function delete($table, $id_name, $id) { 
            $del = "DELETE FROM $table WHERE $id_name = $id";
            global $conn;
                if(mysqli_query($conn,$del)){
                  
                    echo '<script>alert("Deleted successfully");</script>';
                    header("location:adminDashboard.php");
                }
                else {
                echo mysqli_error($conn);
                }
            }
                
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bounce Studios</title>
  <link rel="stylesheet" type="text/css" href="./Styles/header.css">
  <link rel="stylesheet" type="text/css" href="./Styles/colors.css">
  <link rel="stylesheet" type="text/css" href="./Styles/admin.css">
  <link rel="icon" href="./Assets/Website icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!--<link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600&display=swap" rel="stylesheet">-->
  <script src="https://use.fontawesome.com/e9a23594ea.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>

<body>
  <?php include './header.php'; ?>

  <main class="landing_page">

    <section class="admin_nav">
      <button class="menu_bar">
        <i class="fa fa-bars" id="admin_menuBar"></i>
        <span class="menu_text">Menu</span>
      </button>
      <div class="admin_nav_container">

        <div class="overview_btn  menu_btn activeBtn">
          <span class="menu_text">Overview</span>
        </div>

        <div class="users_btn menu_btn ">
          <span class="menu_text">Users</span>
        </div>

        <div class="songs_btn menu_btn ">
          <span class="menu_text">Songs</span>
        </div>

        <div class="services_btn menu_btn ">
          <span class="menu_text">Services</span>
        </div>

        <div class="eqipments_btn menu_btn ">
          <span class="menu_text">Equipment</span>
        </div>

        <div class="sessions_btn menu_btn ">
          <span class="menu_text">Sessions</span>
        </div>

        <div class="reviews_btn menu_btn ">
          <span class="menu_text">Reviews</span>
        </div>
      </div>
    </section>

    <!-- overview  -->
    <section class="page_section overview_sec">
      <div class="sec_title">
        Overview
      </div>

      <div class="sec_cards_container">
        <div class="info_card users_overview_card">
          <p class="value">
            <?php getAllUsers('users'); ?>
          </p>

          <p class="value_text">
            Total no. of users
          </p>
        </div>

        <div class="info_card songs_overview_card">
          <p class="value">
            <?php getAllSongs('songs'); ?>
          </p>

          <p class="value_text">
            Total no. of Songs
          </p>
        </div>

        <div class="info_card sessions_overview_card">
          <p class="value">
            <?php getAllSessions("bookings"); ?>
          </p>

          <p class="value_text">
            Sessions
          </p>
        </div>

        <div class="info_card services_overview_card">
          <p class="value">
            <?php getAllServices("services"); ?>
          </p>

          <p class="value_text">
            Services
          </p>
        </div>

        <div class="info_card equipments_overview_card">
          <p class="value">
            <?php getAllEquipments("equipment"); ?>
          </p>

          <p class="value_text">
            Total no. of Equipment
          </p>
        </div>

        <div class="info_card reviews_overview_card">
          <p class="value">
            <?php getAllReviews('reviews'); ?>
          </p>

          <p class="value_text">
            Reviews
          </p>
        </div>

      </div>
    </section>



    <section class="page_section users_sec">
      <div class="sec_title">
        <img src="icons/user-dark.svg" alt="" class="icon">
        Users
      </div>

      <table border="1" cellpadding="0" class="section_table">
        <tr>
          <th>User Id</th>
          <th>User Name</th>
          <th>Email</th>
          <th>Phone No.</th>
          <th class="operation">Operation</th>
        </tr>

        <?php
        $selectUsers = "SELECT * FROM `users`";
        $results = mysqli_query($conn,$selectUsers);

            if(!$results){
               echo mysqli_error($conn);
            }
              else{
                $row = mysqli_num_rows($results);

                if($row<1){
                  echo "No users in database";
                }
                else{
                $count = 0;
                while($row = mysqli_fetch_assoc($results)){
                  $emailArray[$count] = $row['email'];

                  /*
                  <div class="info_card">
                        <div class="info">
                            <img src="icons/user-holder.svg" alt="user" class="user_img">
  
                        <article class="info_details">
                            <div class="username">
                                <strong>'.$row['user_name'].'</strong>
                            </div>
                            <div class="info_item">
                                <img src="icons/email-svgrepo-com.svg" alt="email" class="icon">
                                '.$row['email'].'
                            </div>
                            <a href="tel:'.$row['phone_no'].'" class="phone_no" >
                            <div class="info_item">
                            <img src="icons/call-grey.svg" alt="call" class="icon">
                            '.$row['phone_no'].'
                            </div>
                            </a>

                            <a href="https://wa.me/'.$row['phone_no'].'">
                            <div class="info_item">
                               <img src="icons/whatsapp.svg" alt="whatsapp" class="icon">
                            </div>
                             </a>  
                             
                            <div class="info_item delete_item">
                                <a href="adminDashboard.php?id='.$row['user_id'].'&table=users&id_name=user_id" class="delete_btn">
                                    <i class="fa fa-delete"></i>
                                    Delete User
                                </a>
                            </div>
                        </article>
  
                        </div>
                    </div>*/

                  if($count>0 && ($emailArray[$count] === $emailArray[$count-1])){
                     continue;
                  }
                  else{ 
                    echo '
                    <tr>
                      <td>'.$row['user_id'].'</td>
                      <td>'.$row['user_name'].'</td>
                      <td><a class="link" href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>
                      <td><a class="link" href="tel:'.$row['phone_no'].'">'.$row['phone_no'].'</a></td>
                      <td class="operation">
                          <a href="adminDashboard.php?id='.$row['user_id'].'&table=users&id_name=user_id" class="delete_btn table_btn">
                            <i class="fa fa-delete"></i>
                            Delete User
                          </a>
                      </td>
                    </tr>
                    ';
                  }
                  $count++;
                }
          }
        }
      ?>
      </table>
      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <a href="addUser.php" class="sect_btn add_user">
                Add User
              </a>
              <button class="sect_btn print_btn">
                <!--<img src="icons/white-print.svg" alt="print" class="print_icon">-->
                  Print Report
              </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <section class="page_section songs_sec">
      <div class="sec_title songs_sec_title">
        Songs
        <form action="" id="Search_form" class="search_bar">
          <label id="search_label" for="song_search">Genre: </label>
          <input type="search" id="song_search" placeholder="enter song genre... e.g All">
          <button id="search_bt" type="submit" class="search_btn">Search</button>
        </form>
      </div>

      <table border="1" cellpadding="0" class="section_table songs_table">
        <tr>
          <th>No.</th>
          <th>Song Title</th>
          <th>Genre</th>
          <th>Release Date</th>
          <th class="operation">Operation</th>
        </tr>

        <div class="songs_info">

        </div>
      </table>

      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <a href="addSong.php" class="sect_btn add_user">
                Add Song
              </a>
              <button class="sect_btn print_btn">
                <!--<img src="icons/white-print.svg" alt="print" class="print_icon">-->
                  Print Report
              </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <section class="page_section services_sec">
      <div class="sec_title">
        <img src="icons/mechanic.svg" alt="" class="icon">
        Services offered
      </div>

      <div class="services_container">

        <?php
        $selectServices = "SELECT * FROM `services`";
        $results = mysqli_query($conn,$selectServices);
        // echo mysqli_num_rows($results);

            if(!$results){
               echo mysqli_error($conn);
            }
              else{
                $row = mysqli_num_rows($results);

                if($row<1){
                  echo "No services added to the database";
                }

                else {
                while($row = mysqli_fetch_assoc($results)){
                    echo '
                    <div class="service_card">
		                  <h3 class="service_title">'.$row['service_name'].'</h3>
                      <div class="underline"></div>
		                  <p class="service_info">
                      '.$row['description'].'
                      </p>
                      <span class="rate">KSH. '.$row['rate'].'/SONG</span>
                      
                      <span class="services_del_btn"><a href="adminDashboard.php?id='.$row['service_id'].'&table=services&id_name=service_id" class="delete_btn">
                            <i class="fa fa-delete"></i>
                            Delete
                        </a></span>
		                </div>
                    ';
                  }
                }
              }
            ?>
      </div>

      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <a href="addService.php" class="sect_btn add_user">
                Add Service
              </a>
                <button class="sect_btn print_btn">
                  <!--<img src="icons/white-print.svg" alt="print" class="print_icon">-->
                    Print Report
                </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <section class="page_section sessions_sec">
      <div class="sec_title">
        <img src="icons/car.svg" alt="" class="icon">
        Sessions
      </div>

      <table border="1" cellpadding="0" class="section_table">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Info</th>
          <th>Date</th>
          <th class="operation">Operation</th>
        </tr>

        <?php 
              //Query all sessions 
              $selectSessions = "SELECT * FROM bookings INNER JOIN users ON bookings.user_id = users.user_id ORDER BY booking_id DESC";
              //results = $connection->query(selectSessions)
              $results = mysqli_query($conn,$selectSessions);
              
              if(!$results){
            echo mysqli_error($conn);
              }
              else {
                $row = mysqli_num_rows($results);

                if($row<1){
                  echo "No sessions booked";
                }
                else{
                foreach($results as $row){
                  echo '
                  <tr>
                  <td class="user_name">'.$row['user_name'].'</td>
                  <td><a class="link" href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>
                  <td>'.$row['subject'].'</td>
                  <td>'.$row['message'].'</td>
                  <td>'.$row['time'].'</td>
                  <td class="operation">
                      <a href="adminDashboard.php?id='.$row['booking_id'].'&table=bookings&id_name=booking_id" class="delete_btn table_btn">
                        <i class="fa fa-delete"></i>
                        Delete Session
                      </a>
                  </td>
                </tr>
                  ';
              }
                }
                
                }
          ?>
      </table>

      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <!--<button class="sect_btn add_session">
                Add Session
              </button>-->
              <button class="sect_btn print_btn">
                Print Report
              </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <section class="page_section equipments_sec">
      <div class="sec_title">
        <img src="icons/e.svg" alt="" class="icon">
        Studio Equipments
      </div>

      <table border="1" cellpadding="0" class="section_table">
        <tr>
          <th>Equipment Id</th>
          <th>Equipment Name</th>
          <th>Description</th>
          <th>Availability</th>
          <th class="operation">Operation</th>
        </tr>

        <?php 
              //Query all sessions 
              $selectEquipments = "SELECT * FROM equipment ORDER BY equipment_name ASC";
              $results = mysqli_query($conn,$selectEquipments);
              
              if(!$results){
            echo mysqli_error($conn);
              }
              else {
                $row = mysqli_num_rows($results);

                if($row<1){
                  echo "No equipments added to the database";
                }
                else{
                foreach($results as $row){
                  echo '
                  <tr>
                      <td>'.$row['equipment_id'].'</td>
                      <td>'.$row['equipment_name'].'</td>
                      <td>'.$row['description'].'</td>
                      <td>'.$row['availability'].'</td>
                      <td class="operation operation_th">
                          <a href="adminDashboard.php?id='.$row['equipment_id'].'&table=equipment&id_name=equipment_id" class="delete_btn table_btn">
                            <i class="fa fa-delete"></i>
                            Delete Gear
                          </a>
                      </td>
                    </tr>
                  ';
              }
                }
                
                }
          ?>
      </table>

      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <a href="addEquipment.php" class="sect_btn add_user">
                Add Equipment
              </a>
              <button class="sect_btn print_btn">
                <!--<img src="icons/white-print.svg" alt="print" class="print_icon">-->
                  Print Report
              </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <section class="page_section reviews_sec">
      <div class="sec_title">
        <img src="icons/car.svg" alt="" class="icon">
        Reviews
      </div>

      <div class="sec_cards_container">

        <?php 
              $selectReviews = "SELECT * FROM reviews INNER JOIN users ON reviews.user_id = users.user_id ORDER BY review_id DESC";
              $results = mysqli_query($conn,$selectReviews);
              
              if(!$results){
            echo mysqli_error($conn);
              }
              else{
                $row = mysqli_num_rows($results);

                if($row<1){
                  echo "No reviews";
                }
                else{
                foreach($results as $row){
                  echo '
                  <div class="review_card">
		                  <h3 class="review_title"><strong class="bold">Name:</strong> '.$row['user_name'].'</h3>
		                  <p class="review_info">
                      <strong class="bold">Testimonial:</strong> '.$row["review"].'
                      </p>
                      
                      <span class="review_dlt_btn"><a href="adminDashboard.php?id='.$row['review_id'].'&table=reviews&id_name=review_id" class="delete_btn">
                            <i class="fa fa-delete"></i>
                            Delete
                        </a></span>
		                </div>
                    ';
                  }
                }
                
                }
          ?>
      </div>

      <?php if(isset($_SESSION['username'])){
        if($_SESSION['username'] === "admin"){
          echo '
            <div class="sect_btns">
              <button class="sect_btn add_review">
                Add Review
              </button>
              <button class="sect_btn print_btn">
                <!--<i class="fa fa-print" id="print_icon"></i>-->
                  Print Report
                </button>
            </div>
          ';
        }
      }
      ?>
    </section>

    <aside class="pop_up">
      <div class="close-icon" onclick="closePop('pop_up')">X</div>
      <div class="pop_info">
        <p>Please confirm if you want to perform the delete operation!</p>
        <div class="pop_btns">
          <button type="submit" class="delete_btn pop_delete_btn">Delete</button>
          <button type="reset" class="cancel-btn" onclick="closePop('pwd-pop')">Cancel</button>
        </div>
      </div>
    </aside>
  </main>

  <script src="admin.js" type="text/javascript"></script>
  <script src="jquery.min.js"></script>
  <script src="search.js" type="text/javascript"></script>
</body>

</html>