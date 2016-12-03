<?php
require_once "../scripts/shared.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require "../scripts/menu.php";
            show_title("Submit");
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/submission.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
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
                        <label for="name">Name of Organization</label><br>
                        <input id="name" type="text" placeholder="Name of donation centre" required><br><br>
                        <label for="description">Description</label><br>
                        <input id="description" placeholder="Description"><br><br>
                        <label for="latitude">Latitude</label><br>
                        <input id="latitude" type="number" placeholder="Latitude position" pattern="-[0-9]+\.[0-9]+"><br><br>
                        <label for="longitude">Longitude</label><br>
                        <input id="longitude" type="number" placeholder="Longitude position" pattern="-[0-9]+\.*[0-9]*"><br><br>
<!-- This button gets the user's location when clicked. -->
                        <div class="buttonHolder">
                            <button type="button" id="geolocation" onClick="getLocation()">Get my location</button>
                        </div>
                        <p id="status"</p>
                        <legend>Accepts</legend>
                        <fieldset>
                            <input id="clothing" type="checkbox" value="clothing"><label for="clothing"> Clothing</label>
                            <input id="electronics" type="checkbox" value="electronics"><label for="electronics"> Electronics</label>
                            <input id="food" type="checkbox" value="food"><label for="food"> Food</label>
                        </fieldset>
                        <br>
                        
                        <div class="buttonHolder">
                            <label for="image">Upload photo</label><br>
                            <input id="image" type="file" accept="image/*"><br>
                            <input id="submit" type="submit" value="Submit">
                        </div>
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