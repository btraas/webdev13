function passwordCheck() {
	var p1 = document.getElementById("password").value;
	var p2 = document.getElementById("password2").value;
	
	if (p1 != "" && p2 != "" && p1 == p2){
	
		alert("Verification successful");
		window.location = "order.html";
		return false;
	}
	else {
		alert("Verification failed");
		return false;
	}
	
}


