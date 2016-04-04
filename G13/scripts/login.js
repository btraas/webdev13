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
		submit();
	} else {
		return false;
	}
}



function submit() // {{{
{
	var user = document.getElementById("email").value;
	var pass = document.getElementById("password").value;

	var xhr = new XMLHttpRequest();
	xhr.open("GET", "login.php?mode=login", true);
	xhr.withCredentials = true;
	xhr.setRequestHeader("Authorization", 'Basic ' + btoa(user+':'+pass));
	xhr.onload = function () {
		    eval(xhr.responseText);
	};
	xhr.send();
} // }}}

function logout() // {{{
{
	document.cookie="sessionkey=0;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
	location.reload();
} // }}}
