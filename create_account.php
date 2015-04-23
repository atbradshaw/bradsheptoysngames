<?php
// Create a new customer account

session_start();
require_once('database_connect.php');



// get inputted user info
$fname = !empty($_GET["fname"]) ? $_GET["fname"] : null;
$lname = !empty($_GET["lname"]) ? $_GET["lname"] : null;
$uname = !empty($_GET["uname"]) ? $_GET["uname"] : null;
$pword = !empty($_GET["pword"]) ? $_GET["pword"] : null;




//$sql = "INSERT INTO User(first_name,last_name,user_name,password,type)
//VALUES ('$fname','$lname','$uname','$pword','customer')";
$type = "customer";

if (!$sql = $mysqli->prepare("INSERT INTO User(first_name,last_name,user_name,password,type) VALUES (?,?,?,?,?)")) {
  echo "Prepare failed";
};

if(!$sql->bind_param("sssss",$fname,$lname,$uname,$pword,$type)) {
  echo "Binding failed.";
}

//insert user into database
if ($sql->execute()){
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
  $_SESSION['error'] = "Error creating user." . mysqli_error($mysqli);
  echo"<script>location.href='account_form.php?form_type=customer'</script>";
}

?>
