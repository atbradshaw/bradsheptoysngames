<?php

require_once('database_connect.php');

//Create tables

//Customer table
$sql = "CREATE TABLE IF NOT EXISTS Customer(
     first_name VARCHAR(30),
     last_name VARCHAR(30),
     password VARCHAR(20),
     cid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Customer table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}

//Staff Table
$sql = "CREATE TABLE IF NOT EXISTS Staff(
     first_name VARCHAR(30),
     last_name VARCHAR(30),
     user_name VARCHAR(20) UNIQUE,
     is_manager BOOLEAN,
     password VARCHAR(20),
     sid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Staff table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}

//Product Table
$sql = "CREATE TABLE IF NOT EXISTS Product(
     pid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     type ENUM('toy','game'),
     stock INT(10),
     promo_rate FLOAT(3)
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Product table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}


//Purchases Table
$sql = "CREATE TABLE IF NOT EXISTS Purchases(
     pid INT(8) UNSIGNED,
     cid INT(8) UNSIGNED,
     quantity INT(3),
     status ENUM('pending','shipped'),
     time_of_pur DATETIME,
     FOREIGN KEY (pid) REFERENCES Product(pid),
     FOREIGN KEY (cid) REFERENCES Customer(cid),
     PRIMARY KEY(pid,cid)
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Purchases table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}


//In cart
$sql = "CREATE TABLE IF NOT EXISTS In_Cart(
     pid INT(8) UNSIGNED,
     cid INT(8) UNSIGNED,
     FOREIGN KEY (pid) REFERENCES Product(pid),
     FOREIGN KEY (cid) REFERENCES Customer(cid),
     PRIMARY KEY(pid,cid)
     )";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Cart table created.";
} else {
  echo "Error creating table: " . mysqli_error($mysqli);
}

?>