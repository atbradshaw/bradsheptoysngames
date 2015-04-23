<!-- Home Page -->
<?php
  session_start();
  include 'header_footer.php';
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

    <dir class="title-text"> BradShep Toys n' Games </dir>

    <div class="empty-100" style="background:#579574; top: -80px; font-size:3em; color:#ffffff;">
       <div style="position:relative; top:20px">
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





<?php
  // add a footer
  addFooter();
?>

    </body>


</html>


<?php 

function customerCreateAccountForm(){
 
if(isset($_SESSION['error'])) {
   echo "test";
   unset($_SESSION['error']);
}

  echo  '<div class="account-form-box">

          <form class="account-form-customer" action="create_account.php" method="get">
            <input class="input-search" type="text" name = "fname" placeholder="First Name" required></br></br>
            <input class="input-search" type="text" name = "lname" placeholder="Last Name" required></br></br>
            <input class="input-search" type="text" name = "uname" placeholder="User Name" required></br></br>
            <input class="input-search" type="password"name = "pword" placeholder="Password" required></br> </br>
            <input class="logInBtn" style="position: relative; left:-100px;" type="Submit">
            <button type="button" class="cancelBtn" onClick=\'location.href="index.php"\' >Cancel</button>
          </form>

        </div>';
}

function staffLogInForm(){
  echo  '<div class="account-form-box">
          <form class="account-form-customer" action="staff_login.php" method="get">
            <input class="input-search" type="text" name = "uname" placeholder="User Name" required></br></br>
            <input class="input-search" type="password"name = "pword" placeholder="Password" required></br> </br>
            <input class="logInBtn" style="position: relative; left:-100px;" type="Submit" required>
            <button type="button" class="cancelBtn" onClick=\'location.href="logout.php"\' >Cancel</button>
          </form>

        </div>';
}

?>