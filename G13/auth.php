<?php

require_once('db.php');
require_once('log.php');


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
	// Using current date, hour, username and password in the MD5 hash.
	// This forces the key to change every hour, and very likely unique for all users.
	// Including the (md5 hash of the) password, so that this user cannot be spoofed
	// by someone else.

	return md5( date('Y-m-d') . $user . $pass );
} // }}}
function getPass($user) // {{{ only the MD5 hash of the password
{
	$email = getEmail($user);
	$r = runQ("SELECT password FROM users WHERE email = '$email'");

	return @$r[0]['password'];

} // }}}

?>
