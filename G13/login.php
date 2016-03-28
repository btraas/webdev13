<?php

require_once('db.php');
require_once('log.php');

$mode = @$_REQUEST['mode'];

switch($mode)
{
	case 'login' : runLogin(); exit();
}


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

function isLoggedIn() // {{{
{
	logger("checking logged in...");

	$session = @$_COOKIE['sessionkey'];
	$user    = @$_COOKIE['user'];
	if(empty($session) || empty($user)) 
	{
		logger("empty session/user");
		return false;
	}

	if($session == getSessionKey($user, getPass($user))) 
	{
		logger("session matches!");
		return true;
	}
	logger("session mismatch!");
	return false; // else

}  // }}}

function getUser() // {{{
{
	if(isLoggedIn())
	{
		$user    = @$_COOKIE['user'];
	    if( empty($user)) return array();

		$q = "SELECT * FROM users WHERE email = '".getEmail($user)."'";
		$r = runQ($q);
		return @$r[0];
	}
	return array(); // else
} // }}}

function getSessionKey($user, $pass) // {{{
{
	return md5( date('Y-m-d H') . $user . $pass );
} // }}}
function getPass($user) // {{{ only the MD5 hash of the password
{
	$email = getEmail($user);
	$r = runQ("SELECT password FROM users WHERE email = '$email'");

	return @$r[0]['password'];

} // }}}

?>
