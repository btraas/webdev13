<?php

// Useful functions
require_once('db.php');
require_once('log.php');
require_once('auth.php');

$mode = @$_REQUEST['mode'];

switch($mode)
{
	case 'login' : runLogin(); exit();
}

include('page_header.php');

?>

<link href='scripts/jquery-ui/jquery-ui.css' rel='stylesheet'>
<link href='style/order.css' rel='stylesheet'>
<link href='style/orderextras.css' rel='stylesheet'>
<script src="scripts/login.js"></script>


<?php if(isLoggedIn()): ?>

<div style='text-align: center; width: 100%; margin-top: 100px;'>

<h1>Welcome <?php $u = getUser(); echo @$u['fname']." ".@$u['lname'] ?>!</h1>

<input type='image' src='/images/PlaceOrder_Button.jpg' value='Place an Order' class='' onClick='location.href="/order/"' style='margin-top: 30px;' />
<input type='image' src='/images/PastOrders.jpg' value='View past orders' class='' onClick='location.href="/my_orders"' style='margin-top: 30px;' />
<input type='image' src='/images/SignOut.jpg' value='Sign Out' class='' onClick='logout()' style='margin-top: 30px;' />

</div>

<?php else: ?>
<table class='twoCol twoCol_separator largeRows'>
	<tr>
    	<td class='top'>
        	<h1>Sign In</h1>
            <p>Welcome back! Please enter your email address and password.</p>
            <label>Email Address</label>
            <input type='text' class='ui-input' name='email' id='email'>
            <label>Password</label>
            <input type='password' class='ui-input' name='password' id='password'/>
        </td>
        <td class='top'>
        	<h1>Sign Up</h1>
            <p>In order to use our online ordering service, you must have an account with us. This will give you the option to save your orders for future use and receive digital receipts.</p>
        </td>
	</tr>
    <tr>
        <td><input type="image" src="/images/Login_Button.jpg" alt="Login Button" class='' value='Sign In' id='login' onClick='validate()' /></td>
        <!-- This is not a form submission, it just takes us to the sign up page. -->
        <td><input type="image" src="/images/Signup_Button.jpg" alt="Signup Button" class='' value='Sign Up' onClick="location.href='signup.html';" /></td>
    </tr>
</table>
<?php endif; ?>


<?php

include('page_footer.php');


function runLogin() // {{{
{
	echo (login() ? "location.reload();" : "alertDialog('Incorrect Password');");

} // }}}
function login() // {{{
{

	$auth = false;
	
	$username = getEmail(@$_SERVER['PHP_AUTH_USER']);
	$pass     = getPassword(@$_SERVER['PHP_AUTH_PW']);
	
	logger($username." ".$pass);

	if(!empty($username) && !empty($pass))
	{
		$r = runQ("SELECT COUNT(*) AS count FROM users 
					WHERE email    = '$username'
					AND   password = '$pass'");
	
		if(!empty(@$r[0]['count']) && $r[0]['count'] > 0) $auth = true;
	}


	if($auth)
	{
		setcookie(	"sessionkey", 
					getSessionKey($username, $pass), 
					time()+(60*60*1000), 
					"/"	);
		setcookie(	"user",
					$username,
					time()+(60*60*1000),
					"/" );
	}

	return $auth;
} // }}}


?>
