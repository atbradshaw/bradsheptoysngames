<?php

include 'tables.php';
include 'products.php';

function addBaseStaff() {
  global $mysqli;
  $base_staff = [
  ['Henry','Harold','HH',0,'HHpass'],
  ['Tim','Tiff','TT',0,'TTpass'],
  ['Barb','Bills','BB',1,'BBpass'],
  ['Carl','Cramer','CC',1,'CCpass'],

  ];

  foreach ($base_staff as $b){
    $sql = "INSERT INTO Staff(first_name, last_name, user_name, is_manager, password)
        VALUES ('$b[0]','$b[1]','$b[2]','$b[3]','$b[4]')";

    if (mysqli_query($mysqli,$sql)) {
     // header( 'Location: index.php');
    } else {
      echo "Error filling staff: " . mysqli_error($mysqli);
    }
  }

  echo "</br> Base staff added";
}

function addBaseProducts() {
	global $mysqli;
	$base_items = [
	['bouncy ball', 1.25, 'toy', 10, 0.5],
	['soccer ball', 11.75, 'toy', 7, 0.1],
	['pool', 87.23, 'game', 5, 0.7],
	['slinky', 5.78, 'toy', 20, 0.2],
	['life', 10.95, 'game', 70, 0.8],
	['bouncy ball', 13.59, 'toy', 10, 0.5],
	['soccer ball', 1.75, 'toy', 74, 0.1],
	['pool', 87.3, 'game', 15, 0.7],
	['slinky', 55.78, 'toy', 200, 0.2],
	['the new life', 103.95, 'game', 40, 0.8],
	['life 3', 103.95, 'game', 40, 0.8],
	['the life long', 103.95, 'game', 40, 0.8]
	];

	foreach ($base_items as $b){
		$sql = "INSERT INTO Product(pname, price, type, stock, promo_rate)
				VALUES ('$b[0]','$b[1]','$b[2]','$b[3]','$b[4]')";

		if (mysqli_query($mysqli,$sql)) {
		 // header( 'Location: index.php');
		} else {
		  echo "Error filling items: " . mysqli_error($mysqli);
		}
	}

	echo "</br> Base items added";
}


// remove the tables in the db 
while(!removeTables()){}
	
// add all the blank tables to the db
createTables();

// insert product items into 'Product'
addBaseProducts();

// insert staff into 'Staff'
addBaseStaff();

//header('Location: logout.php');
?>