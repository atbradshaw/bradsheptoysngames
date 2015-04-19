<?php

include 'tables.php';
include 'products.php';

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