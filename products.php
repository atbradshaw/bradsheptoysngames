<?php
require_once('database_connect.php');
/*
       first_name VARCHAR(30),
       last_name VARCHAR(30),
       user_name VARCHAR(20) UNIQUE,
       is_manager BOOLEAN,
       password VARCHAR(20),
       sid INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY
*/
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

// update inventory
function updateProduct($pid, $stock){
  global $mysqli;
  $sql = "UPDATE Product
          SET stock = $stock
          WHERE pid = $pid;";

  if (mysqli_query($mysqli,$sql)) {
    } else {
      echo "Error updating stock: " . mysqli_error($mysqli);
      var_dump($pid);
    }
}

// prints out all products for a search term
function searchProducts($field, $prod, $all, $update){
	global $mysqli;

  $sql;
  if ($all == 1){
    $sql = "SELECT pname,price,stock,pid FROM Product";
  }
  else
  {
    $prod = '%' . $prod . '%';
    $sql = "SELECT pname,price,stock,pid FROM Product WHERE $field LIKE '$prod'";
  }

	

	$result = mysqli_query($mysqli,$sql);

	// row count
  	$rowcount=mysqli_num_rows($result);
	if(!$rowcount)
  	{
    	echo "</br> No results for search. :(";
    	return;
 	}

  // show Customer table
  echo "<table border=\"1\" cellspacing=\"0\" cellpadding=\"2\">";
  $fieldNames = mysqli_fetch_fields($result);

  echo "<tr>";
    echo" <th> Name </th>";
  	echo" <th> Price </th>";
  	echo" <th> In Stock </th>";
    echo" <th> PID </th>";
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

    // add items
    if($all == 0){
      echo '<td>';
      $temp = $_GET['reff'];
      $id = $row['pid'];
    	echo" <button  onClick='location.href=\"?add=$id&reff=$temp\"' > ADD</button>"; 
      echo'</td>';
    }
    else
    {
      if ($update == 1){

      $pid = $row['pid'];
      echo "<td>";
      echo "<form action=\"staff_index.php\" method=\"get\">
          <input type=\"text\" name = \"stock\"><br>
          </td>
          <td>
          <input type = \"hidden\" name=\"pid\" value=$pid>
          <input type = \"hidden\" name=\"update\" value=1>
          <input type = \"hidden\" name=\"refresh\" value=1>
          <input type=\"submit\" value = \"Save\">
          </td>
          </form>";
      }
    }

    echo "</tr>";
  } 

  echo "</table>";
}
?>