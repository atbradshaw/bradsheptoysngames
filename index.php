<?php
session_start();
?>

<!DOCTYPE HTML>

<html>

    <body>
     
   <?php 
    if (!isset($_SESSION['id'])) {
  echo
    '<form action="create_account.php"method="get">
      <h1>Create an account!</h1>
          First name: <input type="text" name = "fname"><br>
          Last  name: <input type="text" name = "lname"><br>
          Password:   <input type="password"name = "pword"><br>  
      <input type="submit">
    </form>';
    } else {
      echo '<h1>Welcome, '. $_SESSION['fname'] . ' ' . $_SESSION['lname'];
}

?>

    </body>


</html>
