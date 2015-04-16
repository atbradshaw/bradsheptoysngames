<?php

require_once('database_connect.php');

$sql = "DROP TABLE IF EXISTS Customer,Staff,Product,Purchases,In_Cart";

if (mysqli_query($mysqli,$sql)) {
   echo "<br/>Tables deleted.";
} else {
  echo "Error deleting table: " . mysqli_error($mysqli);
}

?>