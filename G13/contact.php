<?php
	include('page_header.php');
?>
			<link rel="stylesheet" type="text/css" href="style/contact.css">
			<script language="JavaScript" type="text/javascript" src="scripts/feedback-form.js"></script>
			<!-- contact information -->
				<div id="row1wrapper">
					<h1>Contact Us</h1>
					<!-- address & phone number -->
					<div id="contact-info">
						<br>
						<h2>Location</h2>
						<p>
							We're located between 38th &amp; 39th Ave.<br>
							Across from Point Grey Secondary.<br>
							(Located on the same block as REmax)<br><br>
							5405 West Boulevard<br>
							Vancouver, BC&nbsp;&nbsp;V6M 3W5
						</p>
						<p>
							Tel: (604) 263-3262
						</p>
						<h2>Hours of Operation </h2>
						<table id="hours">
	                        <tr>
								<td>Monday - Friday</td>
	                            <td class="time">11:00 AM - 8:00 PM</td>
	                        </tr>
	                        <tr>
								<td>Saturday</td>
	                            <td class="time">11:30 AM - 8:30 PM</td>
	                        </tr>
	                        <tr>
								<td>Sunday</td>
	                            <td class="time">Closed</td>
	                        </tr>
	                        <tr>
								<td>Lunch</td>
	                            <td class="time">Opening - 2:30 PM</td>
	                        </tr>
	                        <tr>
								<td>Dinner</td>
	                            <td class="time">5:00 PM - Closing</td>
	                        </tr>
						</table>
					</div>
					<!-- google map -->
					<div id="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2605.0729985742887!2d-123.15783988475035!3d49.23710518192062!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54867379f7fe376f%3A0x6c875cb4703bbf8b!2sTokyo+Thyme!5e0!3m2!1sen!2sca!4v1455391407613">
						</iframe>
					</div>
				</div>
				<!-- customer feedback form -->
				<div id="row2wrapper">
					<h2>Your Feedback</h2>
					<p>We appreciate your visits to our restaurant. In order for us to serve you better at a future time, please take your time to fill up the fields below and send us feedback.
					   For general questions, please indicate your email address and we will reply back as soon as possble. We try to answer back within 24 hours from the submission time.
					</p>
					<!-- form -->
					<form action="http://webdevfoundations.net/scripts/formdemo.asp" method="post" onsubmit="return isBlur()">
						<table>
							<tr>
								<th>
									<label for="subject">Subject</label>
								</th>
								<td>
									<input type="text" name="subject" id="subject"/>
								</td>
							</tr>
							<tr>
								<th>
									<label for="details">Details</label>
								</th>
								<td>
									<textarea rows="20" name="details" id="details"></textarea>
								</td>
							</tr>
							<tr>
								<td></td><td colspan=2 id="buttons">
									<input type=reset value=Clear id="clear" style="display:none;"><img onclick="document.getElementById('clear').click()" src="images/Clear_Button.jpg"></input>
                					<input type=image src="images/Submit_Button.jpg" id='submit1' value=Submit />
								</td>
							</tr>
						</table>
					</form>
				</div>

<?php
include('page_footer.php');
?>
