<?php
require_once('database_connect.php');

function printTable($tableName) {
global $mysqli;
global $dbName;


$sql = "SHOW TABLES LIKE '".$tableName."'";
if( mysqli_num_rows( mysqli_query($mysqli, $sql)) == 0)
{
	echo "</br> No results for search. :(";
	return;
}

// get Customer table data
$sql ="SELECT * FROM $tableName";
$result = mysqli_query($mysqli, $sql) or die(mysqli_error());



// row count
$rowcount=mysqli_num_rows($result);
echo "<br/>$tableName Row Count: $rowcount";

// show Customer table
echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
$fieldNames = mysqli_fetch_fields($result);

echo "<tr>";
foreach($fieldNames as $fN) {
	echo" <th> $fN->name </th>";
}
echo "</tr>";

while($row = mysqli_fetch_assoc($result)) {
	echo "<tr>";
	foreach ($row as $r) {
		echo "<td>";
		if ($r == NULL) {
			echo "NULL";
		}
		else{
			echo "$r";
		}
		echo "</td>";
	}
	echo "</tr>";
} 

echo "</table>";
mysqli_close($mysqli);
}

?>