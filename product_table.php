<?php
	require_once('database_connect.php');

// prints out all products for a search term
function searchProducts($field, $prod){
  global $mysqli;

  $sql;

      $prod = '%' . $prod . '%';
      $sql = "SELECT pname,price,stock,pid FROM Product WHERE $field LIKE '$prod'"; 

  $result = mysqli_query($mysqli,$sql);

  // row count
    $rowcount=mysqli_num_rows($result);
  if(!$rowcount)
    {
      echo "</br> No results for search. :(";
      return;
  }

  // show Customer table
  
  echo "<table class=\"table-prod\" cellspacing=\"0\" cellpadding=\"2\">";
  $fieldNames = mysqli_fetch_fields($result);

  echo "<tr>";
    echo" <th> Name </th>";
    echo" <th> Price </th>";
    echo" <th> In Stock </th>";
    echo" <th> PID </th>";
    if(isset($_SESSION['user_type'])){
      echo" <th> Buy </th>";
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

    // add items
      if(isset($_SESSION['user_type'])){
        echo '<td>';
        $temp = $_GET['key'];
        $id = $row['pid'];
        echo" <button class=\"tableBtn\" onClick='location.href=\"index.php?add=$id&key=$temp\"' > Add</button>"; 
        echo'</td>';
    }

    echo "</tr>";
  } 

  echo "</table>";
  return 1;
}



// prints out all products for a search term
// types: update_promo, update_stock
function listAllProducts($type){
	global $mysqli;

	$sql = "SELECT pid, pname, stock,price,promo_rate FROM Product";

	$result = mysqli_query($mysqli,$sql);

	// row count
  	$rowcount=mysqli_num_rows($result);
	if(!$rowcount)
  	{
    	echo "</br> No products";
    	return;
 	}

  // show Customer table
  echo "<table class=\"table-prod\" cellspacing=\"0\" cellpadding=\"2\">";
  $fieldNames = mysqli_fetch_fields($result);

  echo "<tr>";
    echo" <th> PID </th>";
  	echo" <th> Name </th>";
  	echo" <th> Stock </th>";
    echo" <th> Price </th>";
    echo" <th> Promo Rate </th>";

    if($type == 'update_stock'){
    echo" <th> New Stock </th>";
    echo" <th> Update </th>";
	   }
     elseif ($type == 'update_promo'){
      echo '<th> New Promo </th>';
      echo" <th> Update </th>";
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


      if ($type == 'update_stock'){

      $pid = $row['pid'];
      echo "<td>";
      echo "<form action=\"staff_index.php\" method=\"get\">
          <input class=\"inputs\" style=\"width:50px\" type=\"text\" name = \"stock\"><br>
          </td>
          <td>
          <input type = \"hidden\" name=\"pid\" value=$pid>
          <input type = \"hidden\" name=\"update\" value=stock>
          <input type = \"hidden\" name=\"refresh\" value=1>
          <input class=\"tableBtn\" type=\"submit\" value = \"Save\">
          </td>
          </form>";
      }
      elseif ($type == 'update_promo'){

        $pid = $row['pid'];
        echo "<td>";
        echo "<form action=\"staff_index.php\" method=\"get\">
          <input class=\"inputs\" style=\"width:50px\" type=\"text\" name = \"rate\"><br>
          </td>
          <td>
          <input type = \"hidden\" name=\"pid\" value=$pid>
          <input type = \"hidden\" name=\"update\" value=promo>
          <input type = \"hidden\" name=\"refresh\" value=1>
          <input class=\"tableBtn\" type=\"submit\" value = \"Save\">
          </td>
          </form>";
      }


    echo "</tr>";
  } 

  echo "</table>";
  return 1;
}



?>