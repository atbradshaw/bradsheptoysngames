<?php

require_once('database_connect.php');

function createTables(){
  global $mysqli;

  //Customer table
  $sql = "CREATE TABLE IF NOT EXISTS Customer(
       first_name VARCHAR(30),
       last_name VARCHAR(30),
       user_name VARCHAR(30),
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
       pname VARCHAR(30),
       price FLOAT(5),
       type ENUM('toy','game'),
       stock INT(10),
       promo_rate FLOAT(3)
       )";

  if (mysqli_query($mysqli,$sql)) {
     echo "<br/>Product table created.";
  } else {
    echo "Error creating table: " . mysqli_error($mysqli);
  }

  //In_Order Table
  $sql = "CREATE TABLE IF NOT EXISTS In_Order(
       pid INT(8) UNSIGNED,
       cid INT(8) UNSIGNED,
       quantity INT(3),
       status ENUM('pending','shipped'),
       time_of_pur DATETIME,
       FOREIGN KEY (pid) REFERENCES Product(pid),
       FOREIGN KEY (cid) REFERENCES Customer(cid),
       ordid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY
       )";

  if (mysqli_query($mysqli,$sql)) {
     echo "<br/>In_Order table created.";
  } else {
    echo "Error creating table: " . mysqli_error($mysqli);
  }

  //In cart
  $sql = "CREATE TABLE IF NOT EXISTS In_Cart(
       pid INT(8) UNSIGNED,
       cid INT(8) UNSIGNED,
       count INT(4),
       FOREIGN KEY (pid) REFERENCES Product(pid),
       FOREIGN KEY (cid) REFERENCES Customer(cid),
       PRIMARY KEY(pid,cid)
       )";

  if (mysqli_query($mysqli,$sql)) {
     echo "<br/>Cart table created.";
  } else {
    echo "Error creating table: " . mysqli_error($mysqli);
  }
}


function printTable($tableName) {
  global $mysqli;

  $sql = "SHOW TABLES LIKE '".$tableName."'";
  if( mysqli_num_rows( mysqli_query($mysqli, $sql)) == 0)
  {
    echo "</br> No table with given name :(";
    return;
  }

  // get Customer table data
  $sql ="SELECT * FROM $tableName";
  $result = mysqli_query($mysqli, $sql) or die(mysqli_error());

  // row count
  $rowcount=mysqli_num_rows($result);
  echo "<br/>$tableName: $rowcount";

  // show Customer table
  echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
  $fieldNames = mysqli_fetch_fields($result);

  echo "<tr>";
  foreach($fieldNames as $fN) {
    echo" <th> $fN->name </th>";
  }
  echo "</tr>";

  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    foreach ($row as $r) {
      echo "<td>";
      if ($r == NULL) {
        echo "NULL";
      }
      else{
        echo "$r";
      }
      echo "</td>";
    }
    echo "</tr>";
  } 

  echo "</table>";
}

function removeTables(){
  global $mysqli;
  $sql = "DROP TABLE IF EXISTS Customer,Staff,Product,In_Order,In_Cart";

  if (mysqli_query($mysqli,$sql)) {
     echo "<br/>Tables deleted.";
     return 1;
  } else {
    echo "Error deleting table: " . mysqli_error($mysqli);
    return 0;
  }
}
?>