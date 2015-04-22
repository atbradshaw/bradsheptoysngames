<?php
require_once('database_connect.php');

// update inventory
function updatePromoRate($pid, $rate){
  global $mysqli;
  $sql = "UPDATE Product
          SET promo_rate = $rate
          WHERE pid = $pid;";

  if (mysqli_query($mysqli,$sql)) {
    } else {
      echo "Error updating rate: " . mysqli_error($mysqli);
      var_dump($pid);
    }
}

// update inventory
function updateProductStock($pid, $stock){
  global $mysqli;
  $sql = "UPDATE Product
          SET stock = $stock
          WHERE pid = $pid;";

  if (mysqli_query($mysqli,$sql)) {
    } else {
      echo "Error updating stock: " . mysqli_error($mysqli);
      var_dump($pid);
    }
}


?>