<?php
session_start();

// remove all the session variables
unset($_SESSION['id']);
unset($_SESSION['fname']);
unset($_SESSION['lname']);
unset($_SESSION['uname']);

// go back to main menu
header('Location: index.php');
?>