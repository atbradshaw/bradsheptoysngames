<?php

require_once('database_connect.php');
include 'tables.php';

printTable('Customer');
printTable('Staff');
printTable('Product');
printTable('In_Order');
printTable('In_Cart');

?>