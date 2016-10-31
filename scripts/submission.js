// This file is based on an example given in class. Some changes have
// adapted to satisfy the needs of DonationBoxFinder.

// This function uses the HTML5 Geolocation API to get a user's location.
function getLocation() {
    if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        document.getElementById("status").innerHTML="Geolocation is not supported by this browser.";
    }
}

// This function displays the user's position in the input box
// for location.
function showPosition(position) {
    document.getElementById("latitude").placeholder = "";
    document.getElementById("longitude").placeholder = "";
    document.getElementById("latitude").value = position.coords.latitude;
    document.getElementById("longitude").value = position.coords.longitude;
}

// This function displays messages that explain errors in using the
// geolocation API.
function showError(error) {
    var msg = "";
    switch(error.code) {
        case error.PERMISSION_DENIED:
            msg = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            msg = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            msg = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            msg = "An unknown error occurred."
            break;
    }
    document.getElementById("status").innerHTML = msg;
}