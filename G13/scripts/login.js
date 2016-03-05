function validate(){
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var emailPattern = /^.*?\b@\b.*?((com)|(ca)|(org))$/;
	var passwordPattern = /([\d\D\w\W]{6,20})/;
	if(emailPattern.test(email) && passwordPattern.test(password)){
		alert ("Login successfully");
		window.location = "order.html"; 
		return false;
	}
	else{
		alert("Failed to login.");
		return false;
	}
}
