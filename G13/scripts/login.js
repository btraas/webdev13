function emailValid(){
	var mailBox = document.getElementById("email");
	var emailPattern = /^.*?\b@\b.*?((com)|(ca)|(org))$/;
	if (emailPattern.test(mailBox.value)){
		mailBox.style.borderColor = "white";
		return true;
	} else {
		mailBox.style.borderColor = "yellow";
		mailBox.style.borderStyle = "solid";
		mailBox.style.borderWeight = "3px";
		mailBox.focus();
		return false;
	}
}

function passwordValid(){
	var pword = document.getElementById("password");
	var passwordPattern = /([\d\D\w\W]{6,20})/;
	if (passwordPattern.test(pword.value)){
		pword.style.borderColor = "white";
		return true;
	} else {
		pword.style.borderColor = "yellow";
		pword.style.borderStyle = "solid";
		pword.style.borderWeight = "3px";
		pword.focus();
		return false;
	}
}

function validate(){
	if(emailValid() && passwordValid()){
		window.location = "order.html";
		return false;
	} else {
		return false;
	}
}