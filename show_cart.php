<?php
session_start();
include 'header_footer.php';
require_once('database_connect.php');
?>

<!DOCTYPE HTML>

<html>

  <body>

 <?php
    // add a header
    addHeader();
  ?>

    <div class="empty-50"> </div>
    <div class="empty-20"> </div>

    <div>
        <button class="signUpBtn" onclick="location.href='index.php'">Contiue Shopping</button>
    </div>
<?php
	include 'in_cart.php';
	include 'order.php';

	if(isset($_GET['pid']) and isset($_GET['quant'])){
		date_default_timezone_set('America/New_York');
		$date = date("Y-m-d H:i:s");
		addToOrder($_GET['pid'],$_GET['quant'], $date);
		removeFromCart($_GET['pid']);
	}
?>

<div class="empty-100" style="background:#579574; top:-30px; font-size:3em; color:#ffffff;">
	<div style="position:relative; top:20px">Shopping Cart</div>
</div>

<div class="table-box">

  <?php
      	if(!showCart()){
      		echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px"> Cart Is Empty </div></div>';
      	}
  ?>
</div>

<div class="empty-50"></div>
<div class="empty-100" style="background:#579574; top:0px; font-size:3em; color:#ffffff;">
	<div style="position:relative; top:20px">Orders</div>
</div>


<div class="table-box" style="top:30px;">

<?php

	if(!showOrder()){
    	echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px"> No Orders </div></div>';
    }
 	//echo '<button onclick="location.href=\'index.php\'">Home</button>';
?>

</div>
<div class="empty-100"></div>
<div class="empty-100"></div>
<div class="empty-100"></div>
 <?php
    // add a header
    addFooter();
  ?>

</body>
</html>
