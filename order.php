<?php
/*  pid INT(8) UNSIGNED,
       cid INT(8) UNSIGNED,
       quantity INT(3),
       status ENUM('pending','shipped'),
       time_of_pur DATETIME,
*/

function addToOrder($pid, $quant){
	global $mysqli;

	$cid = $_SESSION['id'];

	$sql = "INSERT INTO In_Order(pid, cid, quantity, status)
				VALUES ('$pid','$cid','$quant','pending')";

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
  else
  {
    echo "</br> Not Enough Item";
  }

  

}

function showOrder(){

	global $mysqli;
	$cid = $_SESSION['id'];
	$sql = "SELECT * FROM In_Order NATURAL JOIN Product
			WHERE cid = $cid";
			
	$result = mysqli_query($mysqli,$sql);

	// row count
  	$rowcount=mysqli_num_rows($result);
	if(!$rowcount)
  	{
    	echo "</br> No Orders";
    	return;
 	}

 	// show Customer table
  echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
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

}

function showAllOrders ()
{
  global $mysqli;

  //$cid = $_SESSION['id'];

  $sql = "SELECT * FROM In_Order NATURAL JOIN Product
          ORDER BY cid, pid";
      
  $result = mysqli_query($mysqli,$sql);

  // row count
    $rowcount=mysqli_num_rows($result);
  if(!$rowcount)
    {
      echo "</br> No Orders";
      return;
  }

  // get all cids
  $sql = "SELECT DISTINCT cid FROM In_Order NATURAL JOIN Product
          ORDER BY cid";
      
  $cid_result = mysqli_query($mysqli,$sql);


  // show Customer table
  echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";

  echo "<tr>";
    echo" <th> CID </th>";
    echo" <th> Name </th>";
    echo" <th> PID </th>";
    echo" <th> Quantity </th>";
    echo" <th> Date Odered </th>";
    echo" <th> Status </th>";
    echo" <th> Ship </th>";
  echo "</tr>";



$temp_cid= mysqli_fetch_assoc($cid_result);
  echo"<tr> <td> {$temp_cid['cid']} </td><td colspan=\"5\"></td>";
  echo"<td><button  onClick='location.href=\"\"' >Ship All</button></td>"; 
  echo"</tr>";
 
    while($row = mysqli_fetch_assoc($result)) {
      if ($row['cid'] != $temp_cid['cid']){
        $temp_cid= mysqli_fetch_assoc($cid_result);
        echo"<tr> <td> {$temp_cid['cid']} </td><td colspan=\"5\"></td>";
        echo"<td><button  onClick='location.href=\"\"' >Ship All</button></td>"; 
        echo"</tr>";
      }
        
        echo "<tr>";
        echo"<td></td>";
        echo "<td>{$row['pname']}</td>";
        echo "<td>{$row['pid']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['time_of_pur']}</td>";
        echo "<td>{$row['status']}</td>";
        if ($row['status'] == 'pending'){
          $ordid = $row['ordid'];
          $pid = $row['pid'];
          $quant = $row['quantity'];
          echo"<td><button  onClick='location.href=\"?orders=1&ordid=$ordid&pid=$pid&quant=$quant\"' >Ship</button></td>";
        }
        else{
          echo "<td></td>";
          echo "</tr>";
        }
      }
    
      echo "</table>";
}

?>