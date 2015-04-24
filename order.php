<?php

function addToOrder($pid, $quant, $date){
	global $mysqli;

	$id = $_SESSION['id'];

	$sql = "INSERT INTO In_Order(pid, id, quantity, status, time_of_pur)
				VALUES ('$pid','$id','$quant','pending','$date')";

	if (mysqli_query($mysqli,$sql)) {
		 // header( 'Location: index.php');
	} else {
		echo "Error adding to order: " . mysqli_error($mysqli);
	}
}

// change order status and decrement inventory (if inv is high enough)
function shipOrder($ordid, $pid, $quant){
  global $mysqli;

  // check if inventory can ship
  $sql = "SELECT stock FROM Product
          WHERE pid = $pid";

  $result = mysqli_query($mysqli,$sql);

  $row = mysqli_fetch_assoc($result);
  var_dump($row['stock']);

  if ($row['stock'] >= $quant){

    $sql = "UPDATE Product
          SET stock = stock - $quant
          WHERE pid = $pid;

          UPDATE In_Order 
          SET status = 'shipped'
          WHERE ordid = $ordid";

          if (mysqli_multi_query($mysqli,$sql)) {
             
              echo "</br> Shipped";
          } else {
            echo "Error shipping order: " . mysqli_error($mysqli);
          }
  }
  else {
    // add shipping form
    echo "</br> Not Enough Item";
  }
}

function showOrder(){

	global $mysqli;
	$id = $_SESSION['id'];
	$sql = "SELECT * FROM In_Order NATURAL JOIN Product
			WHERE id = $id";
			
	$result = mysqli_query($mysqli,$sql);

	// row count
  	$rowcount=mysqli_num_rows($result);
	if(!$rowcount)
  	{
    	return 0;
 	}

 	// show Customer table
  echo "<table class=\"table-prod\" border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
  $fieldNames = mysqli_fetch_fields($result);

  echo "<tr>";
    echo" <th> Name </th>";
  	echo" <th> PID </th>";
  	echo" <th> Quantity </th>";
    echo" <th> Date Odered </th>";
    echo" <th> Status </th>";
  echo "</tr>";

  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    
    echo "<td>{$row['pname']}</td>";
    echo "<td>{$row['pid']}</td>";
    echo "<td>{$row['quantity']}</td>";
    echo "<td>{$row['time_of_pur']}</td>";
    echo "<td>{$row['status']}</td>";
    echo "</tr>";
  } 

  echo "</table>";
  return 1;
}

function showAllOrders ($by_date)
{
  global $mysqli;

    $sql;
    $end_date;
    $start_date;

  if($by_date != "all"){
    date_default_timezone_set('America/New_York');
    $end_date = date("Y-m-d H:i:s");

    $start_date = date("Y-m-d H:i:s", strtotime($end_date . "-1" . "$by_date"));
    echo "<div class='bar' style='position:absolute; top:-50px; height:35px; background:#092C3F'>
            <div class='box' style='top:10px'> Start: $start_date  &nbsp&nbsp  End: $end_date </div>
          </div>";

    $sql = "SELECT * FROM In_Order NATURAL JOIN Product
            WHERE time_of_pur >= '$start_date' and time_of_pur < '$end_date'
            ORDER BY id, ordid";
  }
  else{
    $sql = "SELECT * FROM In_Order NATURAL JOIN Product
            WHERE status = 'pending'
            ORDER BY id, pid";
  }
  $result = mysqli_query($mysqli,$sql);

  // row count
    $rowcount=mysqli_num_rows($result);
  if(!$rowcount)
    {
      echo '<div class="table-prod" > <div class="font" style="height:100px; font-size:20px; top:40px;"> No Orders </div></div>';
      return;
  }

  // get all ids
  if ($by_date == "all"){
    $sql = "SELECT DISTINCT id FROM In_Order NATURAL JOIN Product
            WHERE status = 'pending'
            ORDER BY id";
  }
  else{
    $sql = "SELECT DISTINCT id FROM In_Order NATURAL JOIN Product
            ORDER BY id";
  }

  $id_result = mysqli_query($mysqli,$sql);


  // show Customer table
  echo "<table class='table-prod' border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";

  echo "<tr>";
    echo" <th> ID </th>";
    echo" <th> Name </th>";
    echo" <th> PID </th>";
    echo" <th> Quantity </th>";
    echo" <th> Date Odered </th>";
    echo" <th> Status </th>";
    echo" <th> Ship </th>";
  echo "</tr>";

$temp_id= mysqli_fetch_assoc($id_result);
  echo"<tr> <td> {$temp_id['id']} </td><td colspan=\"6\"></td></tr>";

 
    while($row = mysqli_fetch_assoc($result)) {
      if ($row['id'] != $temp_id['id']){
        $temp_id= mysqli_fetch_assoc($id_result);
        echo"<tr> <td> {$temp_id['id']} </td><td colspan=\"6\"></td></tr>";
      }
        
        echo "<tr>";
        echo"<td></td>";
        echo "<td>{$row['pname']}</td>";
        echo "<td>{$row['pid']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['time_of_pur']}</td>";
        echo "<td>{$row['status']}</td>";
        
        if ($row['status'] == 'pending'){
          if ($row['quantity'] > $row['stock']){
            echo"<td><button  class='tableGreyedBtn' >Ship</button></td>";
          }
          else{
            $ordid = $row['ordid'];
            $pid = $row['pid'];
            $quant = $row['quantity'];
            echo"<td><button  class='tableBtn' onClick='location.href=\"staff_index.php?ordid=$ordid&pid=$pid&quant=$quant&page=$by_date\"' >Ship</button></td>"; 
          }
        }
        else{
          echo "<td></td>";
          echo "</tr>";
        }
      }
    
      echo "</table>";
}

?>