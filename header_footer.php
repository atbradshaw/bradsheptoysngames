<?php
// create the HTML for the different headers needed
function createHeader($type){

	// include custom CSS sheet
	echo '<link rel="stylesheet" href="custom.css">';

	// start of header
	echo '<div class="header">';

	// logo 
	echo '<div class="logo"> 
			<img src="imgs/brandon_pic.jpg" alt="Mountain View" height="40" width="40">
		 </div>';

	// log in form
	if ($type == 'login')
	{

        echo '<div>
        		<form class="login-form" action="customer_login.php" method="get">
            	<fieldset>
	                <input type="text" class="inputs" style="position:fixed; right:360px; top:12px" placeholder="User Name" name="uname">
	                <input type="text" class="inputs" style="position:fixed; right:130px; top:12px" placeholder="Password" name="pword">

	                <button type="submit" class="logInBtn" style="width:120px; position:fixed; right:0px">Sign In</button>
            	</fieldset>
          	  </form>
          	  </div>';
    }
    // cart and sign out
    elseif ($type == 'cart')
    {
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        $cart_cnt = $_SESSION['cart_cnt'];

    	echo '<div class="login-form" style="width:400px">
    			<button type="submit" class="logOutBtn" style="width:120px; border-radius: 0px" onclick="location.href=\'logout.php\'">Sign Out</button>
    			<button type="submit" class="showCartBtn" onclick="location.href=\'show_cart.php\'">Cart</button>
    			<div class="cartItemCnt">';
                echo "$cart_cnt";
        echo '</div>
                <div class="customer-name">';
                echo "$fname  &nbsp $lname";
    	echo ' </div> </div>';
    }
    elseif ($type == 'staff'){
        $fname = $_SESSION['fname'];
        $lname = $_SESSION['lname'];
        echo '<div class="login-form" style="width:400px">
                <button type="submit" class="logOutBtn" onclick="location.href=\'logout.php\'">Sign Out</button>
                <div class="customer-name">
                <div class="staffLabel">';
        if($_SESSION['user_type'] == 'staff'){
                 echo 'Employee';
        }
        else{
            echo 'Manager';
        }
        echo '</div>';
                echo "$fname  &nbsp $lname";
        echo ' </div> </div>';
    }

    // end of header
	echo '</div>';
}

// create the HTML for the different footers needed
function createFooter($type){

// include custom CSS sheet
	echo '<link rel="stylesheet" href="custom.css">';

	// start of footer
	echo '<div class="footer">';

		echo '<dir class="contact-info" style="position:absolute; right:10px; top: 20px;text-align:left">
				Conctact
				</br>Email: bradshep@toys.com
				</br>Phone: 1-800-555-1234
			  </dir>';

		// staff login btn
		if($type == 'staff_login'){
			echo '<button class="staffLogInBtn"onclick="location.href=\'account_form.php?form_type=staff\'">Staff Sign In</button>';
    	}
    	
    // end of header
	echo '</div>';
}

// add the correct type of header
function addHeader(){
	// logged in customer/staff
    if(isset($_SESSION['user_type'])){
      if($_SESSION['user_type'] == 'customer'){
        createHeader('cart');
        }
        else{
            createHeader('staff');
        }

    }
    // show login form
    else {
      createHeader('login');
    }
}

function addFooter(){
	// show cart and sign out
    if(isset($_SESSION['user_type'])){
      createFooter('blank');
    }
    // show login form
    else {
      createFooter('staff_login');
    }
}
?>