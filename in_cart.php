<?php
require_once('database_connect.php');

function addToCart($pid, $id){
	global $mysqli;

	// check if item can be added
	$sql = "SELECT * FROM Product
			WHERE pid = $pid AND stock > 0";

	$result = mysqli_query($mysqli,$sql);

	$rowcount=mysqli_num_rows($result);
	if (!$rowcount){
		echo "</br> Item out of stock. Sorry.";
		return;
	}

	$sql = "SELECT * FROM In_Cart WHERE pid = $pid AND id = $id";

	$result = mysqli_query($mysqli,$sql);

	$rowcount=mysqli_num_rows($result);

	if(!$rowcount)
  	{

    	//echo "</br> New Item!";
    		// row count
    	$sql = "INSERT INTO In_Cart(pid, id, count)
				VALUES ('$pid','$id',1)";

 	}
 	else
 	{
 		//echo "</br> Updating Item Count";
 		$sql = "UPDATE In_Cart
 				SET count = count + 1
 				WHERE pid = $pid AND id = $id";

 	}
	
 	 if (!mysqli_query($mysqli,$sql)) {
		echo "Error adding to cart: " . mysqli_error($mysqli);
		}
}

function removeFromCart($pid){

	global $mysqli;
	$id = $_SESSION['id'];

	// check if item can be added
	$sql = "DELETE FROM In_Cart
			WHERE pid = $pid AND id = $id";

	if (!mysqli_multi_query($mysqli,$sql)) {
		echo "Error removing from cart: " . mysqli_error($mysqli);
		}
}

function showCart(){
	global $mysqli;

	$id = $_SESSION['id'];
	// check if item can be added
	$sql = "SELECT pname,pid,price,count FROM Product NATURAL JOIN In_Cart
			WHERE id = $id";

	$result = mysqli_query($mysqli,$sql);

	$rowcount=mysqli_num_rows($result);

	if (!$rowcount){
		return 0;
	}
	else
	{
		echo "<table class=\"table-prod\" cellspacing=\"0\" cellpadding=\"2\">";
	  $fieldNames = mysqli_fetch_fields($result);

	  echo "<tr>
	  <th>Name</th>
	  <th>PID</th>
	  <th>Price</th>
	  <th>Quantity</th>
	  <th>Purchase</th>

	  </tr>";
	 
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
	    echo"<td>";
	        // add items

    $pid = $row['pid'];
    $quant = $row['count'];
  	echo" <button  onClick='location.href=\"?pid=$pid&quant=$quant\"' > ADD</button>"; 

  	echo"</td>";

	    echo "</tr>";
	  } 

	  echo "</table>";
	}
	return 1;
}

?>