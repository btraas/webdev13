<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Tokyo Thyme</title>
		<link rel="stylesheet" type="text/css" href="style/base.css">
		<link rel="stylesheet" type="text/css" href="style/order.css">
		<link rel="stylesheet" type="text/css" href="style/orderextras.css">
		<link rel="icon" type="image/png" href="images/Icon.ico">
		<script language="JavaScript" type="text/javascript" src="scripts/sign_up.js"></script>
	</head>
	<body>
		<?php
			if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
				echo '<ul class="err">';
				foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
					echo '<li>',$msg,'</li>'; 
				}
				echo '</ul>';
				unset($_SESSION['ERRMSG_ARR']);
			}
		?>
		<!-- header / GNB -->
		<div id="header">
			<div id="logo">
				<a href="index.html"><img src="images/Logo2.jpg" alt="Tokyo Thyme" width="400" height="75"></a>
			</div>
		  	<div id="headerinfo">
				<!-- SNS -->
				<div id="acc">
					<a href="http://www.yelp.ca/biz/tokyo-thyme-vancouver" target="_blank"><img src="images/Yelp.png" alt="Yelp" width="30" height="30"></a>
					<a href="https://www.zomato.com/vancouver/tokyo-thyme-arbutus-ridge" target="_blank"><img src="images/Urbanspoon.png" alt="Zomato" width="30" height="30"></a>
	                <a href="https://www.facebook.com/pages/Tokyo-Thyme/144095502300686?fref=ts" target="_blank"><img src="images/Facebook.png" alt="Facebook" width="30" height="30"></a>
					<a href="https://twitter.com/tokyothyme" target="_blank"><img src="images/Twitter.png" alt="Twitter" width="30" height="30"></a>&nbsp;&nbsp;
	                <a href="login.html"><img src="images/people.png" alt="Login Status" width="30" height="30"><p id="headertext2"><b>&nbsp;Sign In</b></p></a>
				</div>
	            <div id="headertext">
					<p><b>Ph: 604-263-3262</b></p>
				</div>
				<br>
				<br>
				<br>
				<div id="h_navbar">
					<ul>
						<li><a href="menu.html">Menu</a></li>
						<li><a href="order.html">Ordering</a></li>
						<li><a href="contact.html">Contact</a></li>
						<li><a href="careers.html">Careers</a></li>
					</ul>
				</div>
			</div>
		</div>
		<!-- body -->
	 	<div id="main">    
			<div id="mainbody">
			  	<form action='http://webdevfoundations.net/scripts/formdemo.asp' method='post'>
					<div class='centerCol'>
					  	<h1 class='underline'>Sign Up</h1>
					  	<table class='twoCol twoCol_separator'>
							<tr>
							  	<td>First Name</td>
							  	<td>
								  	<div id ="errFirst">
										<!--empty to begin, filled by js -->
									</div>
									<input type='text' id='fname' name='fname' required>
								</td>
							</tr>
							<tr>
							  	<td>Last Name</td>
							  	<td>
								  	<div id ="errLast">
										<!--empty to begin, filled by js -->
									</div>
									<input type='text' id='lname' name='lname'>
								</td>
							<tr>
							  	<td>Phone Number<br> <span class="instruction">Must have area code: 604, 250, 778</span></td>
							  	<td>
								  	<div id ="errPhone">
										<!--empty to begin, filled by js -->
									</div>
								    <input type='text' id='phone' name='phone' maxlength="10" required><br>&nbsp;
									<!--<span class='required_field'></span>-->
								</td>
							</tr>
							<tr>
							  	<td>Email Address</td>
							  	<td>
								  	<div id ="errEmail">
										<!--empty to begin, filled by js -->
									</div>
									<input type='email' id='email' name='email' required>
								</td>
							</tr>
							<tr>
							  	<td>Password<br><span class ="instruction">Must be at least 6 characters</span></td>
							  	<td>
								  	<div id ="errPassword">
										<!--empty to begin, filled by js -->
									</div>
									<input type='password' id='password' name='password' maxlength="20" required><br>&nbsp;
									<!--<span class='required_field'></span>-->
								</td>
							</tr>
							<tr>
							  	<td>Verify Password</td>
							  	<td>
								  	<input type='password' id='password2' name='password2' maxlength="20" required>
									<!--<span class='required_field'></span>-->
								</td>
							</tr>
					  	</table>
					  	<div class='center space'>
							<input type="image" src="images/Signup_Button.jpg" alt="Signup Button" onclick='return mySubmit()' class='ui-button' value='Sign Up' />
					  	</div>
					</div>
			  	</form>
			</div>
		</div>	
	    <!-- footer -->
		<div id="footer-container">
		    <div id="footer">
				<!-- Footer content -->
		        <div id="footertext">
					<!-- Footer menu list1 -->
		            <div class='footercolumn' id="footermenu">
		                <h3><a href ="menu.html">Menu</a></h3>
		                <ul>
		                    <li><a href="order/sashimi.html">Sashimi</a></li>
		                    <li><a href="order/hosomaki.html">Hosomaki</a></li>
		                    <li><a href="order/inside_out_roll">Inside-Out Roll</a></li>
		                </ul>
		            </div>
					<!-- Footer menu list2 -->
		            <div class='footercolumn' id="footermenu2">
		                <h3>&nbsp;</h3>
		                <ul>
		                    <li><a href="order/noodles.html">Noodle</a></li>
		                    <li><a href="order/appetizers.html">Appetizer</a></li>
		                    <li><a href="order/nigiri.html">Nigiri</a></li>
		                </ul>
		            </div>
					<!-- Footer menu list3 -->
		            <div class='footercolumn' id="footermenu3">
		                <h3>&nbsp;</h3>
		                <ul>
		                    <li><a href="order/veggie_roll.html">Vegetarian Roll</a></li>
		                    <li><a href="order/donburi.html">Donburi</a></li>
		                    <li><a href="order/salad.html">Salad</a></li>
		                </ul>
		            </div>
					<!-- Footer menu list4 -->
		            <div class='footercolumn' id="footermenu4">
		                <h3>&nbsp;</h3>
		                <ul>
		                    <li><a href="order/specials.html">Special</a></li>
		                    <li><a href="order/combo.html">Combo</a></li>
		                    <li><a href="order/party_tray.html">Party Tray</a></li>
		                </ul>
		            </div>
					<!-- Footer order list -->
		            <div class='footercolumn' id="footerorder">
		                <h3>Ordering</h3>
		                <ul>
		                    <li><a href="login.html">Sign-in</a></li>
		                    <li><a href="signup.html">Sign-up</a></li>
		                </ul>
		            </div>
					<!-- Footer contact -->
		            <div class='footercolumn' id="footercontact">
		                <h3><a href="contact.html">Contact</a></h3>
		            </div>
		            <!-- Footer careers -->
					<div class='footercolumn' id="footercareers">
		                <h3><a href="careers.html">Careers</a></h3>
		            </div>
		            <!-- Footer site map -->
					<div class='footercolumn' id="footersitemap">
		                <h3><a href="site_map.html">Site Map</a></h3>
		            </div>
		        </div>
				<!-- Footer copyright text -->
				<div id="copyright">
					<p>Created by Group13 2016 &copy; </p>
				</div>
		        <div id="copyright">
		        	<p><br>Icons made by <a href="http://www.freepik.com" title="Freepik" style="color: rgb(126,126,120)">Freepik</a> from <a href="http://www.flaticon.com" title="Flaticon" style="color: rgb(126,126,120)">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank" style="color: rgb(126,126,120)">CC 3.0 BY</a></p>
		        </div>
		    </div>
		</div>
	</body>
</html>