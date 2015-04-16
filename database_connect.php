<?php 

ini_set('display_errors',1); error_reporting(~0);

$servername='mysql.cs.uky.edu';
$username='atbr227';
$password ='thisisourpassword';


$dbName = 'test';
$mysqli = new MySQLi($servername,$username,$password,$dbName);

if( mysqli_connect_errno() ) {
    echo mysqli_connect_error();
} else{
  echo "<font color = \"white\"> connected to db...</font>";
}

//Switch to our database.
$sql = "use atbr227";
if (mysqli_query($mysqli,$sql)) {
   echo "<font color = \"white\"> Database selected. </font>";
} else {
  echo "Error creating database: ". mysqli_error($mysqli);
}
?> 