// This file is based on an example given in class and the Google Maps
// JavaScript API tutorial (https://developers.google.com/maps/documentation/javascript/adding-a-google-map).

// Page behaviours in the results page are defined here.

// Hard-coded locations
var locations = [
    {lat: 43.2605738, lng: -79.9304626, test: ''},
    {lat: 44.2605738, lng: -80.9304626, test: ''},
    {lat: 45.2605738, lng: -79.9304626, test: ''}
];

// InfoWindow sample content string describing object.
var contentString = "<a href='individual.html'>Goodwill Donation Centre</a><div class='left'><div class='review'><div class='stars'>☆☆☆☆☆<div class='numberofreviews'>100 reviews</div></div><ul class='types'><li>Clothing</li><li>Electronics</li></ul></div><div class='right'><p class='address'>90 Glenmount Avenue, Hamilton ON L8S2R2</p></div><div class='bottom'><p class='topcomment'> 'Much wow'</p></div>";

function initMap(position) {
// Display on a map
    var lat_ = position.coords.latitude;
    var lon_ = position.coords.longitude;
    var latlon = lat_ + "," + lon_;
// Create the Google map centred at user's position.
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 6,
        center: {lat: lat_, lng: lon_}
    });
// Create an array of alphabetical characters used to label the markers.
    var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
// Add some markers to the map.
// Note: The code uses the JavaScript Array.prototype.map() method to
// create an array of markers based on a given "locations" array.
// The map() method here has nothing to do with the Google Maps API.
    markers = locations.map(function(location, i) {
        return new google.maps.Marker({
        position: location,
        label: labels[i % labels.length]
        });
    });
    infowindow = new Array(markers.length);
    for (i = 0; i < markers.length; i ++) {
// Add a listener that waits for marker to be clicked.
        markers[i].addListener('click', function() {
// Create a clickable InfoWindow describing the location.
            iw = new google.maps.InfoWindow({
                content: contentString,
                position: locations[i]
            });
            iw.open(map, markers[i]);
        });
// Set all the map labels in the map.
        markers[i].setMap(map);
    }
}

//window.onload = function() {
function loadMap() {
// Get current location and load map.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap);
    }
// If geolocation is not enabled, an error message is displayed in the page.
    else {
        document.getElementById("map").innerHTML="<p>Geolocation is not supported by this browser.</p>";
    }   
}