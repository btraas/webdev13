<?php

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

<link href='style/order.css' rel='stylesheet'>
<link href='style/orderextras.css' rel='stylesheet'>
<script src="scripts/login.js"></script>

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
        <td><input type="image" src="/images/Login_Button.jpg" alt="Login Button" class='ui-button' value='Sign In' id='login' onClick='validate()' /></td>
        <!-- This is not a form submission, it just takes us to the sign up page. -->
        <td><input type="image" src="/images/Signup_Button.jpg" alt="Signup Button" class='ui-button' value='Sign Up' onClick="location.href='signup.html';" /></td>
    </tr>
</table>
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
					time()+(60000*60), 
					"/"	);
		setcookie(	"user",
					$username,
					time()+(60000*60),
					"/" );
	}

	return $auth;
} // }}}


?>
