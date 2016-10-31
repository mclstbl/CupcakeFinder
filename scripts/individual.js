// This file is based on an example given in class and the Google Maps
// JavaScript API tutorial (https://developers.google.com/maps/documentation/javascript/adding-a-google-map).
// Page behaviours in the results page are defined here.

// The initMap function displays the object's position in a map.
function initMap(position) {
// The following variables extract the user's location in order to centre the map.
    var lat_ = position.coords.latitude;
    var lon_ = position.coords.longitude;
    var latlon = lat_ + "," + lon_;
// Create a map that is centred on user's location.        
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 7,
        center: {lat: lat_, lng: lon_}
    });
// Create Google Map object for loc.
    loc = new google.maps.LatLng(43.2605738, -79.9304626);
// Create marker and set attributes.
    var marker = new google.maps.Marker({
        position: loc,
        label: 'A',
        });
// Add the marker to the map.
    marker.setMap(map)
}

window.onload = function() {
// Get user's current location and load map.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap);
    }
// If geolocation is not enabled, an error message is displayed in the page.
    else {
        document.getElementById("map").innerHTML="<p>Geolocation is not supported by this browser.</p>";
    }   
}