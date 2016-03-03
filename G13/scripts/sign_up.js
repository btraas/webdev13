function firstNameCheck(){
	var firstName = document.getElementById("fname");
	var fNameExp = /^([^0-9]*)$/;
	
	if (isNaN(firstName.value) && fNameExp.test(firstName.value)) {
		firstName.style.borderColor = "white";
		return true;
	}
	else {
		firstName.style.borderColor = "yellow";
		firstName.style.borderStyle = "solid";
		firstName.style.borderWeight = "3px";
		firstName.focus();
		return false;
	}
}

function lastNameCheck(){
	var lastName = document.getElementById("lname");
	var lNameExp = /^([^0-9]*)$/;
	if(lastName.value.length > 0){
	if (lNameExp.test(lastName.value)) {
		lastName.style.borderColor = "white";
		return true;
	}
	else {
		lastName.style.borderColor = "yellow";
		lastName.style.borderStyle = "solid";
		lastName.style.borderWeight = "3px";
		lastName.focus();
		return false;
	}
	} else {return true;}
}

function phoneCheck(){
	var number = document.getElementById("phone");
	var numberExp = /(250|604|778)([0-9]{3})([0-9]{4})/;
	
	if (number != "" && numberExp.test(number.value)) {
		number.style.borderColor = "white";
		return true;
	}
	else {
		number.style.borderColor = "yellow";
		number.style.borderStyle = "solid";
		number.style.borderWeight = "3px";
		number.focus();
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
		alert("Password verification failed");
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
		alert("Sign up unsuccessful. Please check over your information.")
		return false;
	}
}