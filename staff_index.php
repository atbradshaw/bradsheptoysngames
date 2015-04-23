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


  <?php
    // add a header
    addHeader();
  ?>

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


<div class="empty-100"></div>


<div class="table-prod" style="border:0px; top:-10px; background:#000000; height:100px; z-index=14000;">

<?php if ($_SESSION['user_type'] == 'staff'){
  // staff buttons
  echo'<button class="staffBtn" style="left:0px" onclick="location.href=\'staff_index.php?type=list_all\'">View Inventory</button>';
  echo '<button class="staffBtn" style="right:190px" onclick="location.href=\'staff_index.php?type=update_stock\'">Update Inventory</button>';
  echo '<button class="staffBtn" style="right:0px" onclick="location.href=\'staff_index.php?type=all_orders\'">View Orders</button>';
}
else {
  // manager buttons
  echo'<button class="staffBtn" style="left:-200px" onclick="location.href=\'staff_index.php?type=list_all\'">View Inventory</button>';
  echo '<button class="staffBtn" style="left:0px" onclick="location.href=\'staff_index.php?type=update_stock\'">Update Inventory</button>';
  echo '<button class="staffBtn" style="right:220px" onclick="location.href=\'staff_index.php?type=all_orders\'">View Orders</button>';
  echo'<button class="staffBtn" style="right:0px" onclick="location.href=\'staff_index.php?type=orders_by_date\'">Orders (ByDate)</button>';
    echo'<button class="staffBtn" style="right:-190px" onclick="location.href=\'staff_index.php?type=update_promo\'">Update Rates</button>';
}

?>
</div>

<div class="empty-100" style=" position:absolute; background:#707070; top:60px; font-size:3em; color:#ffffff;"></div>
 
<div class="empty-100" style=" position:absolute; background:#579574; top:160px; font-size:3em; color:#ffffff;">

<?php
  // all products
if(isset($_GET['type'])){
  if ($_GET['type'] == 'list_all'){
    echo'  <div style="position:relative; top:20px">Inventory</div>';
  }
  // update stock
  elseif ($_GET['type'] == 'update_stock'){
    echo'  <div style="position:relative; top:20px">Update Inventory</div>';
  }
  // update promo_rate
  elseif ($_GET['type'] == 'update_promo'){
    echo'  <div style="position:relative; top:20px">Update Promo Rates</div>';
  }
  // show all orders
  elseif ($_GET['type'] == 'all_orders'){
   echo'  <div style="position:relative; top:20px">Orders</div>';
  }
}
?>

</div>

<?php
  if(isset($_GET['type']) and $_GET['type'] == 'orders_by_date'){
  echo"<div class='empty-50' style='position:absolute; background:#ffff00; top:150px; z-index:1000;'> 
        <div class='table-prod' >
          <button class='staffBtn' style='left:0px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=weeks'\">Week</button>
          <button class='staffBtn' style='right:245px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=months'\">Month</button>
          <button class='staffBtn' style='right:0px' onclick=\"location.href='staff_index.php?type=orders_by_date&span=years'\">Year</button>
        </div>
      </div>";
}
?>

<div class="table-box" style="top:100px">
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






    <div class="empty-100" style="min-height:600px"></div>

<?php
  addFooter();
  ?>

    </body>


</html>
