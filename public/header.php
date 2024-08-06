<div class="header">
        <div class="logo">
            <a href="index.html"><b>Bounce <br> Studios</b></a>
        </div>

        <div onclick="menu()" class="menu">
            <button><i class="fa fa-bars" aria-hidden="true"></i></button>
        </div>

        <div class="nav">
            <ul>
                <li><a href="index.php" class="active menu_link" onclick="menu_hide()">Home</a></li>
                <?php
                if(isset($_SESSION['username']) && $_SESSION['username']=='admin'){
                    echo '
                    <li><a href="adminDashboard.php" class="menu-link">Dashboard</a></li>
                    ';
                }
            ?>
                <li><a href="index.php#about" onclick="menu_hide()" class="menu_link">About</a></li>
                <li><a href="index.php#services" onclick="menu_hide()" class="menu_link">Services</a></li>
                <li><a href="index.php#works" onclick="menu_hide()" class="menu_link">Work</a></li>
                <li><a href="index.php#contact" onclick="menu_hide()" class="menu_link">Contact</a></li>
                <?php if(isset($_SESSION['username'])){
                    echo '
                    <li><a href="logout.php" onclick="menu_hide()" class="menu_link">Sign Out</a></li>
                    ';
                }
                ?>
            </ul>
        </div>
    </div>