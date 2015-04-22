<?php
session_start();
// remove all the session variables
unset($_SESSION['id']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['uname']);
unset($_SESSION['manager']);
unset($_SESSION['user_type']);

// go back to home page
echo"<script>location.href='index.php'</script>";
return;

?>