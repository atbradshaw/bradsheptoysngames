<?php

require_once('database_connect.php');

//Create tables
$sql = "CREATE TABLE IF NOT EXISTS Customer(
     first_name VARCHAR(30),
     last_name VARCHAR(30),
     password VARCHAR(20),
     cid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "Customer table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}

?>