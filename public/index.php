<?php include './session.php'; ?>
<!DOCTYPE html>
<html lang="en">

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

  <!--Header section-->
  <a id="home"></a>
  <div class="header">
    <div class="logo">
      <a href="#home"><b>Bounce <br> Studios</b></a>
    </div>

    <div onclick="menu()" class="menu">
      <button class="menu_bars_btn"><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>

    <div class="nav" id="nav">
      <ul>
        <li><a href="#home" class="active menu_link" onclick="menu_hide()">Home</a></li>
        <li><a href="#about" onclick="menu_hide()" class="menu_link">About</a></li>
        <li><a href="#services" onclick="menu_hide()" class="menu_link">Services</a></li>
        <li><a href="#works" onclick="menu_hide()" class="menu_link">Work</a></li>
        <li><a href="#contact" onclick="menu_hide()" class="menu_link">Contact</a></li>
        <?php if(isset($_SESSION['username'])){
          if ($_SESSION['username'] === 'admin'){
            echo '
          <li><a href="adminDashboard.php" onclick="menu_hide()" class="menu_link">Dashboard</a></li>
          ';
          }
          
          echo '
          <li><a href="bookSession.php" onclick="menu_hide()" class="menu_link">Book Session</a></li>
          <li><a href="logout.php" onclick="menu_hide()" class="menu_link">Sign Out</a></li>
          ';} else{
            echo '
            <li><a href="signIn.php" onclick="menu_hide()" class="menu_link">Sign In</a></li>
            <li><a href="signUp.php" onclick="menu_hide()" class="menu_link">Sign Up</a></li>
            ';
          }
        
        ?>

      </ul>
    </div>
  </div>

  <!--Landing page section-->

  <div class="landing_page">
    <h1>Making Your Music Dreams <br>A Reality</h1>

    <h3>Welcome To Bounce Recording and Production Studio </h3>

    <a href="#works" id="work">Listen to our work</a>
  </div>

  <!--Content section-->
  <!--About page-->
  <div id="about">
    <a id="about"></a>

    <img src="./Assets/about image.jpg" alt="picture of studio workstation"
      class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

    <div id="about-content" class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
      <h1>About Us</h1>

      <p>
        A music production company that gives your music the premium sound it deserves. Some of
        our best genres to work on are Afrobeats, Classical pop and RnB, but we accomodate any other genre and
        style of your preference

        <br><br>

        Let us bring your music dreams to life
      </p>
    </div>
  </div>
  <a id="services"></a>
  <!--Services page-->
  <div class="services">
    <h1>What We Do For You</h1>
    <div class="blocks">
      <?php 
        //Query all sessions 
        $selectServices = "SELECT * FROM `services` ORDER BY service_id ASC";
        $results = mysqli_query($conn,$selectServices);
              
        if(!$results){
          echo mysqli_error($conn);
        }
        else {
          $row = mysqli_num_rows($results);

          if($row<1){
            echo "No services added to the database";
          }
          else{
          foreach($results as $row){
            $image_src = $row['service_image'];
            echo '
              <div class="block">
                <img src="./uploads/'.$row['service_image'].'" alt="" class="services-image">
                  <h1>'.$row['service_name'].'</h1>
                    <div class="rates">
                      <p>KSH '.$row['rate'].'/SONG</p>
                    </div>
                    <p>
                    '.$row['description'].'
                    </p>
                </div>
            ';
        }
          }
                
          }
    ?>
    </div>
  </div>

  <section>
    <main>
      <h1 style="text-align: center; background-color:#16213e; color:white">Our Gears</h1>
      <div class="gear">
        <?php 
        //Query all sessions 
        $selectEquipments = "SELECT * FROM equipment ORDER BY equipment_id ASC";
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
              <div class="gear-list" id="daw-software">
                <img class="gear-images" src="./uploads/'.$row['equipment_image'].'">
                <!--<img class="gear-images" src="<?php echo $image_src; ?>">-->
        <h2 class="gear-name">'.$row['equipment_name'].'</h2>
        <p>
          '.$row['description'].'
        </p>
      </div>
      ';
      }
      }
      }
      ?>

      <!--<div class="gear-list" id="daw-software">
          <img class="gear-images" src="./Assets/daw.jpg">
          <h2 class="gear-name">DAW Software</h2>
          <p>
            For our Digital Audio Workstation we use Pro Tools ,great for all sounds at all levels.
          </p>
        </div>

        <div class="gear-list" id="music-production">
          <img class="gear-images" src="./Assets/mic-popfilter.jpg">
          <h2 class="gear-name">Mic & popfilter</h2>
          <p>
            Shure SM57 Dynamic Mic with Stedman Proscreen XL pop filter
          </p>
        </div>

        <div class="gear-list" id="sequencer">
          <img class="gear-images" src="./Assets/sequencer.jpg">
          <h2 class="gear-name">Sequencer</h2>
          <p>
            For sequensers we have Digitakt & MPC X
          </p>
        </div>

        <div class="gear-list" id="mixer">
          <img class="gear-images" src="./Assets/mixer.jpg">
          <h2 class="gear-name">Sound mixer</h2>
          <p>
            We use Mackie Profx8v2 8-Channel Compact Mixer
          </p>
        </div>

        <div class="gear-list" id="monitors">
          <img class="gear-images" src="./Assets/studio monitor.jpg">
          <h2 class="gear-name">studio monitors</h2>
          <p>
            We use KRK Rokit5 G3.
          </p>
        </div>

        <div class="gear-list" id="amps">
          <img class="gear-images" src="./Assets/rack.webp">
          <h2 class="gear-name">Studio Rack Mounts</h2>
          <p>
            Middle Atlantic RK Series Rack Mounts
          </p>
        </div>-->

      </div>
    </main>
  </section>

  <!--Work page-->
  <a id="works"></a>
  <div class="work">
    <h1>Check our work :</h1>
    <iframe style="border-radius:12px"
      src="https://open.spotify.com/embed/album/2R0nfEjaMFMb8qyPnQmDzK?utm_source=generator" width="100%" height="50"
      frameBorder="0" allowfullscreen=""
      allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    <iframe style="border-radius:12px"
      src="https://open.spotify.com/embed/track/3yu5otkADG1ldufrPxABoo?utm_source=generator" width="100%" height="50"
      frameBorder="0" allowfullscreen=""
      allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>

  </div>

  <!-- reviews section -->
  <section class="reviews_sec">
    <h1 class="review_title">Reviews</h1>

    <div class="reviews_cards_container">
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
                <div class="card_slide active">
                  <div class="card">
                    <div class="avatar">
                      <img src="./uploads/'.$row['user_image'].'" alt="'.$row['user_name'].'">
                    </div>
                      <div class="content">
                    <h4>'.$row['user_name'].'</h4>
                  <div class="rating">'; 
                    $rate_value = 0;
                    $rating = $row['rating'];
                    $stars = "<span class='fa fa-star checked'></span>";

                    while($rating > $rate_value){
                      echo "
                      <span class='fa fa-star checked'></span>
                      "; 
                      $rate_value++;
                    }
                    echo '
                  </div>
                <p>'.$row['review'].'</p>
              </div>
            </div>
            </div>
            ';
            }
          }        
        }
      ?>
      <div class="manual_nav">

      </div>
    </div>

    <?php if(isset($_SESSION['username'])){
          echo '
            <div class="review_form_container">
              <form action="reviews.php" method="POST" class="review_form">
                <h2 class="review_form_title">Leave a Review</h2>
                  <!--<label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                      <br></br>-->
                      <label class="rating_label" for="rating">Rating:</label>
                        <select id="rating" name="rating" required>
                          <option value="5">5 stars</option>
                          <option value="4">4 stars</option>
                          <option value="3">3 stars</option>
                          <option value="2">2 stars</option>
                          <option value="1">1 star</option>
                        </select>
                          <br></br>
                        <label class="review_label" for="review">Review:</label>
                      <textarea id="review" name="review" placeholder="Testimony..." required></textarea>
                    <br></br>
                  <span class="review_submit"><input type="submit" value="Submit Review" id="reviw-button"></span>
                </form>
              </div>
            ';
          }
        
        ?>
  </section>


  <!--Contact section-->
  <a id="contact"></a>
  <section class="contact">
    <h1>Contact Us</h1>
    <form action="" class="contact_form">


      <div class="message contact_msg_display">
        <h3 id="msg_display"></h3>
      </div>


      <label for="name">Name:</label>
      <input type="text" id="name" class="name" placeholder="Your name" required>

      <label for="email">Email Address:</label>
      <input type="email" id="email" class="email" placeholder="Your email" required>

      <label for="subject">Subject:</label>
      <input type="text" id="subject" placeholder="e.g. inquiry" required class="subject">

      <label>Message:</label>
      <textarea id="message" required placeholder="Write your message here"></textarea>

      <div class="status"></div>
      <button type="submit" class="submit contact_submit">Submit</button>
    </form>
  </section>

  <div class="col-12" id="map">
    <iframe src="https://maps.google.com/maps?q=Kisumu%20milimani%20&t=&z=13&ie=UTF8&iwloc=&output=embed"
      frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>

  <div class="footer">
    <p><i>Email: boncestudios@gmail.com<br>
        Phone: +25471234567</i></p>


    <a href="https://www.instagram.com/_bounce_studios/" target="_blank"><i class="fa fa-instagram"
        aria-hidden="true"></i> Check our IG page</a>
    <br>
    <p>Copyright &copy;2023 -
      <?php echo date("Y"); ?> Bounce Studios
    </p>
  </div>

  <script src="jquery.min.js"></script>
  <script src="search.js" type="text/javascript"></script>
  <script src="app.js" type="text/javascript"></script>
  <script src="slider.js" type="text/javascript"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script> -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script> -->
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script> -->

</body>

</html>