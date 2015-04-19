<?php
session_start();
?>

<!DOCTYPE HTML>

<html>

  <body>
  <h1> BradShep Toys n' Games </h1>

<?php
  include 'tables.php';
  include 'products.php';
  include'in_cart.php';
  include 'order.php';
  if(isset($_GET['refresh'])){
    echo"<script>location.href='staff_index.php?update=1'</script>";
  }
  echo '<button onclick="location.href=\'?view=1\'">View Inventory</button>';
  echo '<button onclick="location.href=\'?update=1\'">Update Inventory</button>';
  echo '<button onclick="location.href=\'?orders=1\'">View Orders</button>';

  if (isset($_GET['view'])){
    searchProducts('','',1,0);
  }
  elseif (isset($_GET['update'])){
    searchProducts('','',1,1);
  }
  elseif (isset($_GET['orders'])){
    showAllOrders();
    if (isset($_GET['ordid']) and isset($_GET['pid']) and isset($_GET['quant'])){
      shipOrder($_GET['ordid'], $_GET['pid'], $_GET['quant']);
      echo"<script>location.href='staff_index.php?orders=1'</script>";
    }
  }

  if (isset($_GET['pid']) and isset($_GET['stock'])){
      updateProduct($_GET['pid'], $_GET['stock']);

  }

  if (isset($_SESSION['manager'])){
    if ($_SESSION['manager']){
      echo"</br> Manager: ";
    }
    else
    {
      echo"</br> Staff: ";
    }
  }
     
echo '</br><button onclick="location.href=\'logout.php\'">Logout</button>';
?>
    </body>


</html>
