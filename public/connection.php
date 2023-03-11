 <?php

 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $dbname = "bounce_login";
 
if(!$con = mysqli_connect( $dbhost,$dbuser,$dbpass,$dbname))
{

  die("Connection failed");
}