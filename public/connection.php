 <?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "bounce_login";
 
if(!$conn = mysqli_connect( $dbhost,$dbuser,$dbpass,$dbname))
{

  die("Connection failed");
}