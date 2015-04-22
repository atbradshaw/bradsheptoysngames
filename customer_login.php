<?php
// Log In for Customer

session_start();

require_once('database_connect.php');

// get user name and password
$uname = $_GET["uname"];
$pword = $_GET["pword"];

// find user according to info
$sql = "SELECT * FROM Customer
		WHERE user_name = '$uname' AND password = '$pword'";

$result = mysqli_query($mysqli,$sql);

// if user not found, return bad user
$rowcount=mysqli_num_rows($result);

if(!$rowcount)
	{
		echo"<script>location.href='index.php?userNotFound=1'</script>";
		return;
	}

// if user found, set session variables
$row = mysqli_fetch_assoc($result);
$_SESSION['uname'] = $uname;
$_SESSION['fname'] = $row["first_name"];
$_SESSION['lname'] = $row["last_name"];
$_SESSION['id'] = $row["cid"];

$_SESSION['user_type'] = "customer";

// return to home page
echo"<script>location.href='index.php'</script>";
return;

?>