<?php
session_start();
require_once('database_connect.php');

// if new account needs to be made
if(isset($_GET['new'])) {
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

	  // go back to home page
	  header( 'Location: index.php');
	} else {
	  echo "Error creating user: " . mysqli_error($mysqli);
	}
}
// login to existing account
else{
	$uname = $_GET["uname"];
	$pword = $_GET["pword"];
	
	$table;
	if (isset($_GET["staff"])){
		$table = "Staff";
		echo"</br> Staff";
	}
	else
	{
		$table = "Customer";
	}
	$sql = "SELECT * FROM $table
			WHERE user_name = '$uname' AND password = '$pword'";

	$result = mysqli_query($mysqli,$sql);

	// row count
  	$rowcount=mysqli_num_rows($result);
	if(!$rowcount)
  	{
  		header('Location: account_form.php?login=1&baduser=1');
  		return;
 	}
 	else{
  
 	echo"</br> Found";
 	}

	$_SESSION['uname'] = $uname;

	$row = mysqli_fetch_assoc($result);

	$_SESSION['fname'] = $row["first_name"];
	$_SESSION['lname'] = $row["last_name"];

	if (isset($_GET["staff"])){
		$_SESSION['id'] = $row["sid"];
		if ($row['is_manager']){
			$_SESSION['manager'] = 1;
		}
		else
		{
			$_SESSION['manager'] = 0;
		}
		header('Location: staff_index.php');
		return;
	}
	else
	{
		$_SESSION['id'] = $row["cid"];
		header('Location: index.php');
		return;
	}
	
}
?>
