<!-- Account Form Page -->

<?php
  session_start();
  include 'header_footer.php';
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

    <!-- header -->
    <?php
      addHeader();
    ?>

    <!-- Title and Subtitle -->
  <div class="bar" style="height:330px; ">

    <div class="box" style="font-size:70px; top:30px; width:700px;"> 
      BradShep Toys n' Games 
    </div>

    <!-- Account Bar Text -->
    <div class="bar" style="position:absolute; height:100px; background:#114E77; bottom:0px">
      <div class="box" style="font-size:50px; top:20px; width:1000px;">
        <?php
          if (isset($_GET['form_type'])){
            if($_GET['form_type'] == 'customer'){
              echo  'Account Creator';
            }
            else {
              echo 'Staff Log In';
            }
          }
        ?>
      </div>
    </div>

  </div>


  

  <div class="bar" style="min-height:400px; background:#ffffff">
    <?php
    if (isset($_GET['form_type'])){
      if($_GET['form_type'] == 'customer'){

        customerCreateAccountForm();
      }
      else {
        staffLogInForm();
      }
    }
    ?>
  </div>



  <!-- footer -->
  <?php
    addFooter();
  ?>

</div>
</body>

</html>


<?php 
// account form for a customer
function customerCreateAccountForm(){
  if(isset($_SESSION['error'])) {
    echo $_SESSION['error'];
    unset($_SESSION['error']);
  }
  echo  '<div class="box" style="top:20px; height:270px">

          <form action="create_account.php" method="get">
            <input class="input-search" type="text" name = "fname" placeholder="First Name" required></br></br>
            <input class="input-search" type="text" name = "lname" placeholder="Last Name" required></br></br>
            <input class="input-search" type="text" name = "uname" placeholder="User Name" required></br></br>
            <input class="input-search" type="password"name = "pword" placeholder="Password" required></br> </br>
            <input class="submitBtn" style="position: relative; width:205px; left:0px;" type="Submit">
            <button type="button" class="cancelBtn" style="right:0px; width:205px" onClick=\'location.href="index.php"\' >Cancel</button>
          </form>

        </div>';
}
// account form for a staff member
function staffLogInForm(){
  echo  '<div class="box" style="top:20px; height:155px">
          <form  action="staff_login.php" method="get">
            <input class="input-search" type="text" name = "uname" placeholder="User Name" required></br></br>
            <input class="input-search" type="password"name = "pword" placeholder="Password" required></br> </br>
            <input class="submitBtn" style="position: relative; width:205px; left:0px;" type="Submit">
            <button type="button" class="cancelBtn" style="right:0px; width:205px" onClick=\'location.href="logout.php"\' >Cancel</button>
          </form>

        </div>';
}

?>