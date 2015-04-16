<html>
<body>
<?php

require_once('database_connect.php');

$fname = $_GET["fname"];
$lname = $_GET["lname"];
$uname = $_GET["uname"];
$pword = $_GET["pword"];


$sql = "INSERT INTO Customer(first_name,last_name,user_name,password)
VALUES ('$fname','$lname','$uname','$pword')";

if (mysqli_query($mysqli,$sql)) {
  echo "<br>User account created.";
  session_start();
  $_SESSION['fname'] = $fname;
  $_SESSION['lname'] = $lname;
  $_SESSION['uname'] = $uname;
  $_SESSION['id'] = $mysqli->insert_id;

  header( 'Location: index.php');
} else {
  echo "Error creating user: " . mysqli_error($mysqli);
}

?>

</body>
</html>