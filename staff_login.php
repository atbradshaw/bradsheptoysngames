<?php

// Log In for Staff
session_start();

require_once('database_connect.php');

// get user name and password
$uname = $_GET["uname"];
$pword = $_GET["pword"];

// find user according to info
$sql = "SELECT * FROM User
		WHERE user_name = '$uname' AND password = '$pword' AND (type = 'staff' OR type = 'manager')";

$result = mysqli_query($mysqli,$sql);

// if user not found, return bad user
$rowcount=mysqli_num_rows($result);

if(!$rowcount)
	{
		echo"<script>location.href='account_form.php?userNotFound=1&form_type=staff'</script>";
		return;
	}

// if user found, set session variables
$row = mysqli_fetch_assoc($result);
$_SESSION['uname'] = $uname;
$_SESSION['fname'] = $row["first_name"];
$_SESSION['lname'] = $row["last_name"];
$_SESSION['id'] = $row["id"];
$_SESSION['user_type'] = $row['type'];


// return to home page
echo"<script>location.href='staff_index.php'</script>";
return;

?>