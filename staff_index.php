<?php
session_start();
include 'header_footer.php';
  include 'tables.php';
  include 'products.php';
  include 'in_cart.php';
  include 'product_table.php';
  include 'order.php';
  require_once('database_connect.php');
?>

<!DOCTYPE HTML>

<html>
<body>

<!-- container -->
<div class='container'>
  <!-- header filler -->
  <div style="height:60px">
  </div>

  <!-- External Functions and Refresh -->
  <?php
  // ship order
    if (isset($_GET['ordid']) and isset($_GET['pid']) and isset($_GET['quant'])){
      shipOrder($_GET['ordid'], $_GET['pid'], $_GET['quant']);
      echo"<script>location.href='staff_index.php?type=all_orders'</script>";
    }
  
    // update stock
    if (isset($_GET['update']) and $_GET['update'] == 'stock' and isset($_GET['pid']) and isset($_GET['stock'])){
        updateProductStock($_GET['pid'], $_GET['stock']);
        echo"<script>location.href='staff_index.php?type=update_stock'</script>";
    }

    // update promo
    if (isset($_GET['update']) and $_GET['update'] == 'promo' and isset($_GET['pid']) and isset($_GET['rate'])){
        updatePromoRate($_GET['pid'], $_GET['rate']);
        echo"<script>location.href='staff_index.php?type=update_promo'</script>";
    }
  ?>

  <!-- header -->
  <?php
    addHeader();
  ?>


  <!-- Button Bar -->
  <div class="bar" style="height:70px; background:#202020; top:0px; "> 

    <!-- Button Box -->
    <div class="box" style=" height:50px; top:10px; z-index=1000; width:1000px">

      <!-- Buttons -->
      <?php if ($_SESSION['user_type'] == 'staff'){
        // staff buttons
        echo'<button class="staffBtn" style="left:200px" onclick="location.href=\'staff_index.php?type=list_all\'">View Inventory</button>';
        echo '<button class="staffBtn" style="right:390px" onclick="location.href=\'staff_index.php?type=update_stock\'">Update Inventory</button>';
        echo '<button class="staffBtn" style="right:200px" onclick="location.href=\'staff_index.php?type=all_orders\'">View Orders</button>';
      }
      else {
        // manager buttons
        echo'<button class="staffBtn" style="left:0px" onclick="location.href=\'staff_index.php?type=list_all\'">View Inventory</button>';
        echo '<button class="staffBtn" style="left:200px" onclick="location.href=\'staff_index.php?type=update_stock\'">Update Inventory</button>';
        echo '<button class="staffBtn" style="right:420px" onclick="location.href=\'staff_index.php?type=all_orders\'">View Orders</button>';
        echo'<button class="staffBtn" style="right:200px" onclick="location.href=\'staff_index.php?type=orders_by_date\'">Orders (ByDate)</button>';
          echo'<button class="staffBtn" style="right:0px" onclick="location.href=\'staff_index.php?type=update_promo\'">Update Rates</button>';
      }
      ?>
    </div>
  </div>

  <!-- Subtitle -->
  <div class="bar" style="height:80px; background:#114E77; bottom:0px;">
    <div class="box" style="font-size:50px; top:10px; width:1000px;">

      <?php
          // all products
        if(isset($_GET['type'])){
          if ($_GET['type'] == 'list_all'){
            echo' Inventory';
          }
          // update stock
          elseif ($_GET['type'] == 'update_stock'){
            echo' Update Inventory';
          }
          // update promo_rate
          elseif ($_GET['type'] == 'update_promo'){
            echo'  Update Promo Rates';
          }
          // show all orders
          elseif ($_GET['type'] == 'all_orders'){
           echo'  Orders';
          }
          elseif ($_GET['type'] == 'orders_by_date'){
            echo' Orders By Date';
          }
        }
        else{
          echo' Staff Page';
        }
      ?>
    </div>
  </div>

  <!-- Order By Date Buttons -->
  <?php
    if(isset($_GET['type']) and $_GET['type'] == 'orders_by_date'){
      echo '<div class="bar" style="height:60px; background:#ffffff; bottom:0px">';

      echo" <div class=\"box\" style=\"font-size:50px; top:10px; height: 40px; width:500px;\">
              <button class='staffBtn' style='left:0px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=weeks'\">Week</button>
              <button class='staffBtn' style='right:190px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=months'\">Month</button>
              <button class='staffBtn' style='right:0px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=years'\">Year</button>
            </div>";
      
      echo'</div>';
  }
  ?>

 <!-- Spacer -->
  <div class="bar" style="height:50px; ">
  </div>

  <!-- Table -->
  <div class="bar" style="min-height:300px">
  
    <?php
      if (isset($_GET['type'])){
        // view all items
        if($_GET['type'] == 'list_all'){
          if(!listAllProducts('list_all')){
                echo '<div class="table-prod"> <div class="font" style="height:100px; font-size:20px; top:40px"> No Inventory </div></div>';
          }
        }
        // update stock
        elseif ($_GET['type'] == 'update_stock'){
          listAllProducts('update_stock');
        }
        // update promo_rate
        elseif ($_GET['type'] == 'update_promo'){
          listAllProducts('update_promo');
        }
        // show all orders
        elseif ($_GET['type'] == 'all_orders'){
          showAllOrders("all");
        }
        // show orders within date
        elseif ($_GET['type'] == 'orders_by_date' && isset($_GET['span'])){
          showAllOrders($_GET['span']);
        }
      }
    ?>
 
  </div>

 <!-- Spacer -->
  <div class="bar" style="height:150px; ">
  </div>

<?php
  addFooter();
  ?>

</div>
</body>

</html>