<?php
session_start();
?>

<!DOCTYPE HTML>

<html>

  <body>
  <h1> BradShep Toys n' Games </h1>

<?php
  include 'tables.php';
  include 'products.php';
  include'in_cart.php';
  echo '<form action="index.php" method="get">
      <h2>Search Our Products:</h2>
          Keyword: <input type="text" name = "reff"><br>
          
      <input type="submit">
    </form>';
  

  if (isset($_GET['reff'])){
    $reff = $_GET['reff'];
    if ($reff != ''){
      echo "<h2>Results For $reff:</h2>";
      searchProducts('pname',$reff,0,0);
    }
  }

 if(isset($_GET['add']))
  {
    if(isset($_SESSION['id'])){
      addToCart($_GET['add'],$_SESSION['id']);
      $temp = $_GET['reff'];

      //refresh the page
      header("Location: index.php?reff=$temp");
      echo"</br>Refreshed";
    }
    else
    {
      echo "</br> Login to add an item";
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
    echo '<button onclick="location.href=\'account_form.php?login=1&staff=1\'">Staff Login</button>';
  }
else{
    echo '<button onclick="location.href=\'show_cart.php\'">Cart</button>';
    echo '<button onclick="location.href=\'logout.php\'">Logout</button>';
    if (isset($_SESSION['manager'])){
      if ($_SESSION['manager']){
        echo"</br> Manager: ";
      }
      else
      {
        echo"</br> Staff: ";
      }
    }
    else
    {
       echo"</br> Customer: ";
    }
    echo ' (' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . ' ' . $_SESSION['id'] . ')';
}     

?>
    </body>


</html>
