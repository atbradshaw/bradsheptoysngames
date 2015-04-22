<!-- Home Page -->

<?php
  session_start();
  include 'header_footer.php';
  include 'tables.php';
  include 'products.php';
  include 'in_cart.php';
  include 'product_table.php';
  require_once('database_connect.php');
?>

<!DOCTYPE HTML>

<html>
  <!-- bacjground color -->
  <body>

  <?php
    // add a header
    addHeader();
  ?>

    <div class="empty-50"> </div>
    <div class="empty-20"> </div>

    <!-- Sign Up Button -->
    <?php
      if(!isset($_SESSION['user_type']))
      echo '<div>
              <button class="signUpBtn" onclick="location.href=\'account_form.php?form_type=customer\'">Sign Up</button>
            </div>';
    ?>

  <dir class="title-text"> BradShep Toys n' Games </dir>

  <div class="about-text">We are a super cool store that has all of the amazing products
  that you and your family need. With new shipments coming in
  all the time, our delivery rates are garunteed premium. 
  </div>

  <div class="search-box">

  <form action="index.php" method="get" class="search-bar">
    <input class="input-search" type="text" placeholder="Search for a product" name = "key"><br>
      </form>';
    
  <div class="table-box" style="top:30px">
  <?php
      if (isset($_GET['key'])){
    $key = $_GET['key'];
    if ($key != ''){
      searchProducts('pname',$key);
      echo '<div class="empty-100"></div>';
    }
  }
  ?>
  </div>
  </div>

<?php


 if(isset($_GET['add']))
  {
    if(isset($_SESSION['id'])){
      addToCart($_GET['add'],$_SESSION['id']);
      $temp = $_GET['key'];

      //refresh the page
      header("Location: index.php?key=$temp");
      echo"</br>Refreshed";
    }
    else
    {
      echo "</br> Login to add an item";
    }
  }

?>

<?php
  // add a footer
  addFooter();
?>

    </body>


</html>
