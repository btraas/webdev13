<?php
	//Start session
	@session_start();
	
	//Include database connection details
	require_once('db.php');
	require_once('log.php');
	require_once('DOM_functions.php');

	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$fname = @$_POST['fname'];
	$lname = @$_POST['lname'];
	$phone = @$_POST['phone'];
	$email = @$_POST['email'];
	$password = @$_POST['password'];
	$password2 = @$_POST['password2'];
	

	//Input Validations
	if(empty($fname)) {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}
	if(empty($lname)) {
		$errmsg_arr[] = 'Last name missing';
		$errflag = true;
	}
	if(empty($phone)) {
		$errmsg_arr[] = 'Phone number missing';
		$errflag = true;
	}
	if(empty($email)) {
		$errmsg_arr[] = 'Email address missing';
		$errflag = true;
	}
	if(empty($password)) {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if(empty($password2)) {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if(strcmp($password, $password2) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	//Check for duplicate login ID
	/*if($login != '') {
		$qry = "SELECT * FROM members WHERE login='$login'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}*/
	
	include('signup_form.php');

	//If there are input validations, redirect back to the registration form
	if($errflag) {

		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;

		$msg = "";
		foreach($errmsg_arr AS $err)
		{
			$msg .= "$err\n";
		}
		session_write_close();
		//header("location: signup_form.php");
		if(!empty($msg) && @$_POST['mode'] == 'submit' ) alert($msg);

		exit();
	}

	//Create INSERT query
	$qry = "INSERT INTO users(fname, lname, phone, email, password) VALUES('$fname', '$lname', '$phone', '$email', '".md5($_POST['password'])."')";
	
	if(runQ($qry) === FALSE) {
		alert("We could not sign you up. Please try again or contact us.");
	} else {
		$js = "location.href = '/login'";
		alert("Thank you for signing up, " .$fname. "!\nYou can now log in using the email address you provided.", $js);
	}
?>
