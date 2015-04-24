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

function getCartItemCnt(){
	global $mysqli;

	$id = $_SESSION['id'];

	$sql = "SELECT * FROM Product NATURAL JOIN In_Cart
			WHERE id = $id";

	$result = mysqli_query($mysqli,$sql);

	return mysqli_num_rows($result);
}

function showCart(){
	global $mysqli;

	$id = $_SESSION['id'];
	// check if item can be added
	$sql = "SELECT pname,pid,price,count,promo_rate FROM Product NATURAL JOIN In_Cart
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
	  <th>Buy / Remove</th>

	  </tr>";
	 
	  while($row = mysqli_fetch_assoc($result)) {
	    echo "<tr>";
    	$act_price = round($row['price'] * (1 - $row['promo_rate']),2);
	    echo "<td> {$row['pname']} </td>";
	    echo "<td> {$row['pid']} </td>";
	    echo "<td> $act_price </td>";
	    echo "<td> {$row['count']}</td>";

	   	echo"<td>";

    $pid = $row['pid'];
    $quant = $row['count'];
  	echo" <button  class= 'tableAddBtn' onClick='location.href=\"?pid=$pid&quant=$quant\"' >Add</button>"; 
  	echo" <button  class= 'tableDeleteBtn' onClick='location.href=\"?remove=$pid&quant=$quant\"' >Remove</button>"; 
  	echo"</td>";

	    echo "</tr>";
	  } 

	  echo "</table>";
	}
	return 1;
}

?>