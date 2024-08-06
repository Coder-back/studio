 <?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "bounce_login";
//  $port = 3308;
 
 $conn = mysqli_connect( $dbhost,$dbuser,$dbpass,$dbname );
if(!$conn)
{

  die("Connection failed");
}