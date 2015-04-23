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
  <div class="bar" style="height:350px">
    <div class="box" style="font-size:70px; top:30px; width:700px;"> 
      BradShep Toys n' Games 
    </div>

    <div class="box" style="font-size:30px; top:200px; width:1000px;">
      We are a super cool store that has all of the amazing products
      that you and your family need. With new shipments coming in
      all the time, our delivery rates are garunteed premium. 
    </div>
  </div>


  <!-- Search Box -->
  <div class="bar" style="min-height:300px; background:#0000ff; ">

  <div class="bar" style="height:30px; background:#00ff00">
  </div>

    <!-- Search Bar -->
    <form action="index.php" method="get" class="search-bar" style=" top:0px; z-index:100">
      <input class="input-search" type="text" placeholder="Search for a product" name = "key"><br>
    </form>
      
    <!-- Spacer -->
    <div class="bar" style="height:60px; background:#000000"> 
    </div>

    <!-- Search Result Table -->
       
      <?php
          if (isset($_GET['key'])){
        $key = $_GET['key'];
        if ($key != ''){
          if (!searchProducts('pname',$key)){
            echo '<div class="table-prod"> <div class="font" style="height:25px; font-size:20px; top:0px"> No Results </div></div>';
          }
        }
      }
      ?>


  </div>

  <!-- Spacer -->
  <div class="bar" style="height:170px"> 
  </div>
  
  <!-- Footer -->
  <?php
   addFooter();
  ?>

</div>
</body>

</html>
