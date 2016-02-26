function validate(){
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	if ( email != "" && password != ""){
		alert ("Login successfully");
		window.location = "order.html"; 
		return false;
		}

	else{
	alert("Failed to login.");
	return false;
		}
	}
