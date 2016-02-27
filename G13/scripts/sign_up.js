function firstNameCheck(){
	var firstName = document.getElementById("fname").value;
	var fNameExp = /^([^0-9]*)$/;
	
	if (isNaN(firstName) && fNameExp.test(firstName)) {
	
		return true;
	}
	else {
		alert("Name is incorrect");
		return false;
	}
}

function lastNameCheck(){
	var lastName = document.getElementById("lname").value;
	var lNameExp = /^([^0-9]*)$/;
	
	if (lNameExp.test(lastName)) {
	
		return true;
	}
	else {
		alert("Last name is incorrect");
		return false;
	}
}

function phoneCheck(){
	var number = document.getElementById("phone").value;
	var numberExp = /([2,6,7][0,5,7][0,4,8])([0-9]{3})([0-9]{4})/;
	
	if (number != "" && numberExp.test(number)) {
	
		return true;
	}
	else {
		alert("Number is incorrect");
		return false;
	}
}

function passwordCheck() {
	var pass1 = document.getElementById("password").value;
	var pass2 = document.getElementById("password2").value;
	var passExp = /([\d\D\w\W]{1,20})/;
	
	if (pass1 != "" && pass2 != "" && passExp.test(pass1) && passExp.test(pass2) && pass1 == pass2){
	
		return false;
	}
	else {
		alert("Verification failed");
		return false;
	}
}

function mySubmit(){
	
	if(firstNameCheck() && lastNameCheck() && phoneCheck() && passwordCheck()){
		alert("Sign up successful");
		window.location ="login.html"
		return true;
	}
	else{

		return false;
	}
}