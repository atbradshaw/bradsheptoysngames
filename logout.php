<?php
session_start();

// remove all the session variables
unset($_SESSION['id']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['uname']);
unset($_SESSION['manager']);

// go back to main menu
header('Location: index.php');

?>