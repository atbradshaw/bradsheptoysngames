<?php
session_start();
?>

<!DOCTYPE HTML>

<html>

  <body>
  <h1> BradShep Toys n' Games </h1>

<?php
  include 'print_tables.php';
  echo '<form action="index.php" method="get">
      <h2>Search Our Products:</h2>
          Keyword: <input type="text" name = "reff"><br>
          
      <input type="submit">
    </form>';
  

  if ($_GET != NULL){
    $reff = $_GET["reff"];
    if ($reff != ''){
      echo "<h2>Results For $reff:</h2>";
      printTable($reff);
    }
  }

?>
</br>
</br>
</br>
</br>
</br>
</br> 
<?php
if (!isset($_SESSION['id'])){
    echo '<button onclick="location.href=\'account_form.php\'">Customer Login</button>';

  }
else{
    echo '<button onclick="location.href=\'logout.php\'">Logout</button>';
    echo ' (' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] .')';
}

?>
    </body>


</html>
