<?php 
session_start();
// login form
if (isset($_GET['login']) and $_GET['login'] == 1){
  echo
    '<form action="create_account.php"method="get">
      <h1>Login to your account!</h1>
          Username: <input type="text" name = "uname"><br>
          Password:   <input type="password"name = "pword"><br>';
  if (isset($_GET['staff'])){
      echo '<input type="hidden" name="staff" value=1>';
  }

  echo '<input type="submit">
    </form>';
  


  if (isset($_GET['baduser'])){
    if ($_GET['baduser']){
      echo "</br>User not found.</br> Please check your info or ";
    }
  }

    if (!isset($_GET['staff'])){
      echo " <button  onClick='location.href=\"account_form.php?login=0\"' >Create Account</button>"; 
    }

}

// create account
else{
  echo  '<form action="create_account.php"method="get">
      <h1>Create an account!</h1>
          First name: <input type="text" name = "fname"><br>
          Last  name: <input type="text" name = "lname"><br>
          Username: <input type="text" name = "uname"><br>
          Password: <input type="password"name = "pword"><br> 
          <input type="hidden" name="new"> 
      <input type="submit">
    </form>';

  echo '</br> Already have an account ';

  echo" <button  onClick='location.href=\"?login=1\"' > login</button>"; 
}

echo "</br></br> <button  onClick='location.href=\"index.php\"' >Home</button>";


?>