function passwordCheck() {
	var pass1 = document.getElementById("password").value;
	var pass2 = document.getElementById("password2").value;
	var firstName = document.getElementById("fname").value;
	var email = document.getElementById("email").value;
	
	
	if (isNaN(firstName) && email != "" && pass1 != "" && pass2 != "" && pass1 == pass2){
	
		alert("Verification successful");
		window.location = "order.html";
		return false;
	}
	else {
		alert("Verification failed");
		return false;
	}
}


