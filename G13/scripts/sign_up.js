function firstNameCheck(){
	var firstName = document.getElementById("fname");
	var fNameExp = /^([^0-9]*)$/;
	
	if (isNaN(firstName.value) && fNameExp.test(firstName.value)) {
		document.getElementById('errFirst').innerHTML = "";
		firstName.style.borderColor = "white";
		return true;
	}
	else {
		document.getElementById('errFirst').innerHTML = "Must only include letters";
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
		document.getElementById('errLast').innerHTML = "";
		lastName.style.borderColor = "white";
		return true;
	}
	else {
		document.getElementById('errLast').innerHTML = "Must only include letters";
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
	var numberExp = /(250|604|778)([0-9]{7})/;
	
	if (number.value != "" && numberExp.test(number.value)) {
		document.getElementById('errPhone').innerHTML = "";
		number.style.borderColor = "white";
		return true;
	}
	else {
		document.getElementById('errPhone').innerHTML = "Must only be from area code 604, 778, 250 and 7 digits";
		number.style.borderColor = "yellow";
		number.style.borderStyle = "solid";
		number.style.borderWeight = "3px";
		number.focus();
		return false;
	}
}

function passwordCheck() {
	var pass1 = document.getElementById("password");
	var pass2 = document.getElementById("password2");
	var passExp = /([\d\D\w\W]{6,20})/;
	
	if (pass1.value != "" && pass2.value != "" && passExp.test(pass1.value) && passExp.test(pass2.value) && pass1.value == pass2.value){
		document.getElementById('errPassword').innerHTML = "";
		pass1.style.borderColor="white";
		pass2.style.borderColor="white";
		return true;
	}
	else {
		document.getElementById('errPassword').innerHTML = "Passwords must match";
		pass1.style.borderColor = "yellow";
		pass1.style.borderStyle = "solid";
		pass1.style.borderWeight = "3px";
		pass2.style.borderColor = "yellow";
		pass2.style.borderStyle = "solid";
		pass2.style.borderWeight = "3px";
		return false;
	}
}

function emailCheck(){
	var mailBox = document.getElementById("email");
	var emailPattern = /^.*?\b@\b.*?((com)|(ca)|(org))$/;
	if (emailPattern.test(mailBox.value)){	
		document.getElementById('errEmail').innerHTML = "";
		mailBox.style.borderColor = "white";
		return true;
		
	} else {
		document.getElementById('errEmail').innerHTML = "Email ending in com, ca or org";
		mailBox.style.borderColor = "yellow";
		mailBox.style.borderStyle = "solid";
		mailBox.style.borderWeight = "3px";
		mailBox.focus();
		return false;
	}
}

function mySubmit(){
	
	if(firstNameCheck() & lastNameCheck() & 
	   phoneCheck() & emailCheck() &
	   passwordCheck()){
		
		$.post('signup', {
			mode		:   'submit',
			fname		:	$('#fname').val(),
			lname		:	$('#lname').val(),
			phone		:	$('#phone').val(),
			email		:	$('#email').val(),
			password	:	$('#password').val(),
			password2	:	$('#password2').val()

		}, function( data ) { $('body').append(data); });


		return true;
	}
	else{
		return false;
	}
}
