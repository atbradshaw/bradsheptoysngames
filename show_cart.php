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

  <!-- Redirections -->
  <?php
    // not logged in
    if (!isset($_SESSION['user_type'])){
      echo"<script>location.href='index.php'</script>";
    }

    // not a customer
    if (isset($_SESSION['user_type']) and !( $_SESSION['user_type'] == 'customer')){
      if ($_SESSION['user_type'] == 'staff' or $_SESSION['user_type'] == 'manager'){
        echo"<script>location.href='staff_index.php'</script>";
      }
      else {
        echo"<script>location.href='index.php'</script>";
      }
    }
  ?>

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
        <button class="contShopBtn" onclick="location.href='index.php'">Continue Shopping</button>
    </div>

    <!-- Shopping Cart Heading -->
    <div class="bar" style="height:100px; background:#114E77;">
      <div class="box" style="font-size:50px; top:20px; width:1000px;">
      Shopping Cart
      </div>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; ">
    </div>


    <!-- Shopping Cart -->
    <div class="bar">
      <?php
          	if(!showCart()){
          		echo '<div class="table-prod" > <div class="font" style="height:100px; font-size:20px; top:40px;"> No Items In Cart </div></div>';
          	}
      ?>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; ">
    </div>

    <!-- Orders Heading -->
    <div class="bar" style="height:100px; background:#114E77;">
      <div class="box" style="font-size:50px; top:20px; width:1000px;">
      Orders
      </div>
    </div>

    <!-- Spacer -->
    <div class="bar" style="height:50px; ">
    </div>

    <!-- Orders -->
    <div class="bar">
    <?php
    	if(!showOrder()){
        	echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px;"> No Orders </div></div>';
        }
    ?>
  </div>

  <!-- Spacer -->
  <div class="bar" style="height:150px;">
  </div>

   <?php
      // add a header
      addFooter();
    ?>
</div>
</body>
</html>
