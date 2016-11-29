<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Donation Box Finder | Submit</title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/submission.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Submit");
            ?>
        </div>
        
        <div id="content-container">
            <div id="submission-content">
                <h3>Submit a donation centre location</h3>
                <div id="newobject">
                    <form>
                        <label for="name">Name of Organization</label>
                        <input id="name" type="text" placeholder="Name of donation centre" required><br>
                        <label for="description">Description</label>
                        <input id="description" placeholder="Description"><br>
                        <label for="latitude">Latitude</label>
                        <input id="latitude" type="number" placeholder="Latitude position" pattern="-[0-9]+\.[0-9]+"><br>
                        <label for="longitude">Longitude</label>
                        <input id="longitude" type="number" placeholder="Longitude position" pattern="-[0-9]+\.*[0-9]*"><br>
<!-- This button gets the user's location when clicked. -->
                        <button type="button" id="geolocation" onClick="getLocation()">Get my location</button>
                        <p id="status"</p>
                        <legend>Accepts</legend>
                        <fieldset>
                        <input id="clothing" type="checkbox" value="clothing"><label for="clothing"> Clothing</label>
                        <input id="electronics" type="checkbox" value="electronics"><label for="electronics"> Electronics</label>
                        <input id="food" type="checkbox" value="food"><label for="food"> Food</label>
                        </fieldset>
                        
                        <label for="image">Upload photo</label><input id="image" type="file" accept="image/*">

                        <input id="submit" type="submit" value="Submit">
                    </form>
                </div>
            </div>
        </div>

        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</html>