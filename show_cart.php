<?php
session_start();
include 'header_footer.php';
include 'in_cart.php';
include 'order.php';
require_once('database_connect.php');
?>

<!DOCTYPE HTML>

<html>
<body>

  <!-- container -->
  <div class='container'>

    <!-- Add to Order -->
    <?php
      if(isset($_GET['pid']) and isset($_GET['quant'])){
        date_default_timezone_set('America/New_York');
        $date = date("Y-m-d H:i:s");
        addToOrder($_GET['pid'],$_GET['quant'], $date);
        removeFromCart($_GET['pid']);
        $_SESSION['cart_cnt'] = $_SESSION['cart_cnt'] - $_GET['quant'];
        echo"<script>location.href='show_cart.php'</script>";
      }

      if(isset($_GET['remove']) and isset($_GET['quant'])){
        removeFromCart($_GET['remove']);
        $_SESSION['cart_cnt'] = $_SESSION['cart_cnt'] - $_GET['quant'];
        echo"<script>location.href='show_cart.php'</script>";
      }
    ?>

    <!-- header filler -->
    <div style="height:60px">
    </div>

    <!-- Header -->
    <?php
      addHeader();
    ?>

    <!-- Continue Shopping Button -->
    <div>
        <button class="signUpBtn" onclick="location.href='index.php'">Contiue Shopping</button>
    </div>

    <!-- Shopping Cart Heading -->
    <div class="bar" style="height:100px; background:#ff00ff;">
      <div class="box" style="font-size:50px; top:20px; width:1000px; background:#000000">
      Shopping Cart
      </div>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; background:#0f00ff;">
    </div>


    <!-- Shopping Cart -->
    <div class="bar">
      <?php
          	if(!showCart()){
          		echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px"> Cart Is Empty </div></div>';
          	}
      ?>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; background:#ff0000;">
    </div>

    <!-- Orders Heading -->
    <div class="bar" style="height:100px; background:#ff00ff;">
      <div class="box" style="font-size:50px; top:20px; width:1000px; background:#000000">
      Orders
      </div>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; background:#00ff00;">
    </div>

    <!-- Orders -->
    <div class="bar">
    <?php
    	if(!showOrder()){
        	echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px"> No Orders </div></div>';
        }
    ?>
  </div>

  <!-- Spacer -->
  <div class="bar" style="height:150px; background:#00ff00;">
  </div>

   <?php
      // add a header
      addFooter();
    ?>
</div>
</body>
</html>
