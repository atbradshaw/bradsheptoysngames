<?php
session_start();
require_once('database_connect.php');
?>

<!DOCTYPE HTML>

<html>

  <body>
  <h1> Shopping Cart </h1>

<?php
	include 'in_cart.php';
	include 'order.php';

	if(isset($_GET['pid']) and isset($_GET['quant'])){
		addToOrder($_GET['pid'],$_GET['quant']);
		removeFromCart($_GET['pid']);
	}

	showCart();
	echo "</br>";
	showOrder();
	echo"</br>";
 	echo '<button onclick="location.href=\'index.php\'">Home</button>';
?>




</body>
</html>
