function isBlur() {
	var subject = document.getElementById("subject");
	var details = document.getElementById("details");
	
	if (details.value != "") {
		details.style.borderWidth = "0px";
	} else if (subject.value != "") {
		subject.style.borderWidth = "0px";
	}

	if (subject.value == "") {
		subject.style.borderStyle = "solid";
		subject.style.borderColor = "yellow";
		subject.style.borderWidth = "3px";
		subject.focus();

		return false;
	}

	if (details.value == "") {
		subject.style.borderStyle = "solid";
		details.style.borderColor = "yellow";
		details.style.borderWidth = "3px";
		details.focus();

		return false;
	}
}

function clear() {
	var details = document.getElementById("details").value="";
	var subject = document.getElementById("subject").value="";

	if (details.value != "" || subject.value != "") {
		details.value = "";
		subject.value = "";
	} else if (details.value != "" && subject.value != "")
		details.value = "";
		subject.value = "";
}