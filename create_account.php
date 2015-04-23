<?php
// Create a new customer account

session_start();
require_once('database_connect.php');

// get inputted user info
$fname = $_GET["fname"];
$lname = $_GET["lname"];
$uname = $_GET["uname"];
$pword = $_GET["pword"];

$sql = "INSERT INTO User(first_name,last_name,user_name,password,type)
VALUES ('$fname','$lname','$uname','$pword','customer')";

// insert the user into the db
if (mysqli_query($mysqli,$sql)) {
  $_SESSION['fname'] = $fname;
  $_SESSION['lname'] = $lname;
  $_SESSION['uname'] = $uname;
  $_SESSION['id'] = $mysqli->insert_id;
  $_SESSION['user_type'] = "customer";

  // go back to home page
  echo"<script>location.href='index.php'</script>";
  return;
}
else {
  $_SESSION['error'] = "Error creating user." ;//. mysqli_error($mysqli);
  echo"<script>location.href='account_form.php?form_type=customer'</script>";
}

?>
