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

<!-- External Function Calls-->
<?php
  //
  if(isset($_GET['add'])) {
    if(isset($_SESSION['id'])){
      addToCart($_GET['add'],$_SESSION['id']);
      $temp = $_GET['key'];
      $_SESSION['cart_cnt'] = $_SESSION['cart_cnt'] + 1;

      //refresh the page
      echo"<script>location.href='index.php?key=$temp'</script>";
    }
  }
?>

<!DOCTYPE HTML>

<html>
<body>

<!-- container -->
<div class='container'>
  <!-- header filler -->
  <div style="height:60px">
  </div>

  <!-- Redirections -->
  <?php
    // if a staff or manager
    if (isset($_SESSION['user_type']) and ( $_SESSION['user_type'] == 'staff' or $_SESSION['user_type'] == 'manager')){
      echo"<script>location.href='staff_index.php'</script>";
    }
  ?>

  <!-- Header -->
  <?php
    addHeader();
  ?>

  <!-- Sign Up Button -->
  <?php
    if(!isset($_SESSION['user_type']))
    echo '<div>
            <button class="signUpBtn" onclick="location.href=\'account_form.php?form_type=customer\'">Sign Up</button>
          </div>';
  ?>

  <!-- Title and Welcome -->
  <div class="bar" style="height:350px;">
    <img style="position:relative; top:30px"src="logo_405.png" alt="Mountain View" height="176" width="500">

    <div class="box" style="font-size:20px; top:230px; width:900px;">
      For over 50 years, Bradshep Toys and Games have brought joy to people all over the world. 
      We believe in the magic that a simple toy can bring into all of our lifes. With a dedicated staff
      and years of perfecting our craft, we hope to offer you the best toy buying experince you'll ever have.
    </div>
  </div>


  <!-- Search Box -->
  <div class="bar" style="min-height:300px; background:#ffffff; ">

  <div class="bar" style="height:30px; background:#ffffff">
  </div>

    <!-- Search Bar -->
    <form action="index.php" method="get" class="search-bar" style=" top:0px; z-index:100">
      <input class="input-search" type="text" placeholder="Search for a product" name = "key"><br>
    </form>
      
    <!-- Spacer -->
    <div class="bar" style="height:60px; background:#ffffff"> 
    </div>

    <!-- Search Result Table -->
       
      <?php
        if (isset($_GET['key'])){
          $key = $_GET['key'];
          if (!searchProducts('pname',$key)){
            echo '<div class="table-prod" style="background:none"> <div class="font" style="height:100px; font-size:20px; top:35px; color:#CCC"> No Results </div></div>';
        }
      }
      ?>


  </div>

  <!-- Spacer -->
  <div class="bar" style="height:170px; background:#ffffff"> 
  </div>
  
  <!-- Footer -->
  <?php
   addFooter();
  ?>

</div>
</body>

</html>
