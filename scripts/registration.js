// JavaScript validation for Registration page

function validateForm() {
// Check if name field is not empty.
    var x = document.forms["register"]["firstname"].value;
    if (x == null || x == "") {
        alert("First name must be filled out");
        return false;
    }
    x = document.forms["register"]["lastname"].value;
// Check if name field is not empty.
    if (x == null || x == "") {
        alert("Last name must be filled out");
        return false;
    }
    x = document.forms["register"]["email"].value;
// Check if email is filled in.
    if (x == null || x == "") {
        alert("Email must be filled out");
        return false;
// Check if email is valid.
    	var re = /[-_\.a-zA-Z0-9]+\@{1}[a-zA-Z0-9]+\.{1}[a-zA-Z]+/;
    	if (!re.test(x)) {
    		alert("Email is invalid");
    		return false;
    	}
    }
// Check if password field is not empty.
    x = document.forms["register"]["password"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }
// Check if zipcode field is not empty.
    x = document.forms["register"]["zipcode"].value;
    if (x == null || x == "") {
        alert("Zipcode must be filled out");
        return false;
    }
// Check if zipcode is valid according to Canadian format.
    	var re = /[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}/;
    	if (!re.test(x)) {
    		alert("Zipcode is not valid");
    		return false;
    	}
    return true;
}