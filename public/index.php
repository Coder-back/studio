<?php
session_start();

$_SESSION;

include("connection.php");
// include("functions.php");

// $user_data = check_login($conn);

?>

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
      <button><i class="fa fa-bars" aria-hidden="true"></i></button>
    </div>

    <div class="nav" id="nav">
      <ul>
        <li><a href="#home" class="active menu_link" onclick="menu_hide()">Home</a></li>
        <li><a href="#about" onclick="menu_hide()" class="menu_link">About</a></li>
        <li><a href="#services" onclick="menu_hide()" class="menu_link">Services</a></li>
        <li><a href="#works" onclick="menu_hide()" class="menu_link">Work</a></li>
        <li><a href="#contact" onclick="menu_hide()" class="menu_link">Contact</a></li>
        <li><a href="signIn.php" onclick="menu_hide()" class="menu_link">Sign In</a></li>


      </ul>
    </div>
  </div>

  <!--Landing page section-->

  <div class="landing_page">
    <h1>Making Your Music Dreams <br>A Reality</h1>

    <h3>Welcome To Bounce Recording and Production Studio </h3>

    <a href="#contact" id="work">Book Session</a>
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
      <div class="block">
        <img src="./Assets/recording.jpg" alt="" class="services-image">
        <h1>Recording</h1>
        <div class="rates">
          <p>KSH 8000/SONG</p>
        </div>
        <p>
          Our qualified recording engineers know exactly how to find the sound that you want.
          We have the recording expertise to give your project a premium sound
        </p>
      </div>

      <div class="block">
        <img src="./Assets/mixing.jpg" alt="" class="services-image">
        <h1>Mixing</h1>
        <div class="rates">
          <p>KSH 7000/SONG</p>
        </div>
        <p>
          We balance the elements in your song to elevate the emotions and vibe it conveys.
          Our goal is to help you achieve your vision for how you want each song to move your audience

        </p>
      </div>

      <div class="block">
        <img src="./Assets/mastering.jpg" alt="" class="services-image">
        <h1>Mastering</h1>
        <div class="rates">
          <p>KSH 7000/SONG</p>
        </div>
        <p>
          The final stage of quality control where we make sure your song translates on everything from
          earbuds to cars to hi-fi stereos to
          club systems ,all while bringing out details and making sure your songs are cohesive and competitive

        </p>
      </div>
    </div>
  </div>

  <section>
    <main>
      <h1 style="text-align: center; background-color:#16213e; color:white">Our Gears</h1>
      <div class="gear">

        <div class="gear-list" id="daw-software">
          <img class="gear-images" src="./Assets/daw.jpg">
          <h2 class="gear-name">DAW Software</h2>
          <p>
            Pro Tools ,great for all sounds at all levels.
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
        </div>

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
  <section id="reviews">
    <h1>Reviews</h1>
    <div class="card">
      <div class="avatar">
        <img src="./Assets/smith.jpg" alt="Smith headshot">
      </div>
      <div class="content">
        <h4>Jme Smith</h4>
        <div class="rating">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
        </div>
        <p>I had a great experience recording my music at this studio. The staff was friendly and professional,
          and the quality of the recording was top-notch.</p>

      </div>
    </div>
    <div class="card">
      <div class="avatar">
        <img src="./Assets/rafat.png" alt="Sande headshot">
      </div>
      <div class="content">
        <h4>Q Sande</h4>
        <div class="rating">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
        </div>
        <p>This is the best studio I've ever recorded in. The equipment is top-of-the-line, and the sound
          engineer really knows what he's doing.</p>

      </div>
    </div>
    <div>
      <form action="reviews.php" method="POST">
        <h2 style="text-align:center;">Leave a Review</h2>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br></br>
        <label for="rating">Rating:</label>
        <select id="rating" name="rating" required>
          <option value="5">5 stars</option>
          <option value="4">4 stars</option>
          <option value="3">3 stars</option>
          <option value="2">2 stars</option>
          <option value="1">1 star</option>
        </select>
        <br></br>
        <label for="review">Review:</label>
        <textarea id="review" name="review" required></textarea>
        <br></br>
        <input type="submit" value="Submit Review" id="reviw-button">
      </form>
    </div>
  </section>


  <!--Contact section-->
  <a id="contact"></a>
  <div class="contact">
    <h1>Contact Us</h1>
    <form action="booking.php" method="POST">
      <label>
        Name:
        <input type="text" name="name" class="name" placeholder="Your name" required>
      </label>

      <label>
        Email Address:
        <input type="email" name="email" class="email" placeholder="Your email" required>
      </label>

      <label>
        Subject:
        <input type="text" name="subject" class="subject">

        <label>
          Message:
          <textarea name="message" class="message" placeholder="Write your message here"></textarea>
        </label>

        <div class="status">

        </div>

        <button type="submit" class="submit">Submit</button>
    </form>
  </div>

  <div class="col-12" id="map">
    <iframe src="https://maps.google.com/maps?q=Kisumu%20milimani%20&t=&z=13&ie=UTF8&iwloc=&output=embed"
      frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>

  <div class="footer">
    <p><i>Email: bouncestudios@gmail.com<br>
        Phone: +25471234567</i></p>


    <a href="https://www.instagram.com/_bounce_studios/" target="_blank"><i class="fa fa-instagram"
        aria-hidden="true"></i>Check our IG page</a>
    <br>
    <p>Copyright &copy;2023 -
      <?php echo date("Y"); ?> Bounce Studios
    </p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
  <script src="./app.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>

</body>

</html>