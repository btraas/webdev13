<?php
	session_start();
	include('page_header.php');
	include('order_header.php');
?>
	<script language="JavaScript" type="text/javascript" src="scripts/sign_up.js"></script>
			  	<form action='signup.php' method='post'>
					<div class='centerCol'>
					  	<h1 class='underline'>Sign Up</h1>
					  	<table class='twoCol twoCol_separator'>
							<tr>
							  	<td>First Name</td>
							  	<td>
								  	<input type='text' id='fname' name='fname' required>
								  	<div id ="errFirst">
										<!--empty to begin, filled by js -->
									</div>
								</td>
							</tr>
							<tr>
							  	<td>Last Name</td>
							  	<td>
								  	<input type='text' id='lname' name='lname'>
								  	<div id ="errLast">
										<!--empty to begin, filled by js -->
									</div>
								</td>
							<tr>
							  	<td>Phone Number<br> <span class="instruction">Must have area code: 604, 250, 778</span></td>
							  	<td>
								  	<input type='text' id='phone' name='phone' maxlength="10" required><br>&nbsp;
									<div id ="errPhone">
										<!--empty to begin, filled by js -->
									</div>
								</td>
							</tr>
							<tr>
							  	<td>Email Address</td>
							  	<td>
								  	<input type='email' id='email' name='email' required>
								  	<div id ="errEmail">
										<!--empty to begin, filled by js -->
									</div>
								</td>
							</tr>
							<tr>
							  	<td>Password<br><span class ="instruction">Must be at least 6 characters</span></td>
							  	<td>
								  	<input type='password' id='password' name='password' maxlength="20" required><br>&nbsp;
									<div id ="errPassword">
										<!--empty to begin, filled by js -->
									</div>
								</td>
							</tr>
							<tr>
							  	<td>Verify Password</td>
							  	<td>
								  	<input type='password' id='password2' name='password2' maxlength="20" required>
								</td>
							</tr>
					  	</table>
					  	<div class='center space'>
							<input type="image" src="images/Signup_Button.jpg" alt="Signup Button" onclick='return mySubmit()' value='Sign Up' />
					  	</div>
					</div>
			  	</form>
<?php

	include('page_footer.php');

?>
