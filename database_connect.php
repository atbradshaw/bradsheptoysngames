<?php 

ini_set('display_errors',1); error_reporting(~0);

$servername='mysql.cs.uky.edu';
$username='atbr227';
$password ='thisisourpassword';



$mysqli = new MySQLi($servername,$username,$password,'test');

if( mysqli_connect_errno() ) {
    echo mysqli_connect_error();
} else{
  echo('connected to db...');
}

//Switch to our database.
$sql = "use atbr227";
if (mysqli_query($mysqli,$sql)) {
   echo "Database selected.";
} else {
  echo "Error creating database: ". mysqli_error($mysqli);
}
?> 