<?php
require_once "scripts/shared.php";
require_once "scripts/menu.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            show_title("Home");
        ?>
        <link rel="icon" href="public/images/logo.png">
        <link rel="stylesheet" href="public/css/style.css">
        <script type ="text/javascript" src="scripts/index.js"></script>
    </head>
    <body onload="">
<!-- The header-container div contains the navigation tabs and the title of this website. -->
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                show_header("Home");
            ?>
        </div>
<!-- The content-container div separates the main functions of the search page form the header and the footer. -->
        <div id="content-container">
            <div id="search-content">
                <h3>Start your search here</h3>
                <form id="search" method="POST" action="public/search.php">
<!-- The following fieldset presents the different types of donation centres for which the user may perform a search.
A checkbox is used for each so multiple values can be selected in a single search. -->
                    <div id="options">
                        <legend>Donate </legend>
                        <fieldset>
                        <input id="clothing" type="checkbox" name="clothing" value="<?php echo (rePOST('clothing')); ?>" >
                        <label for="clothing"> Clothing</label>
                        <input id="electronics" type="checkbox" name="electronics" value="<?php echo (rePOST('electronics')); ?>">
                        <label for="electronics"> Electronics</label>
                        <input id="food" type="checkbox" name="food" value="<?php echo (rePOST('food')); ?>">
                        <label for="food"> Food</label><br>
                        </fieldset><br>
<!-- The "rating" dropdown menu allows a user to filter displayed results according to minimum rating. -->
                        <label for="rating">Minimum Rating</label><br>
                        <select id="rating" name="stars" value="<?php echo (rePOST('stars')); ?>">
                            <option value=0>Pick rating</option>
                            <option value=5>☆☆☆☆☆</option>
                            <option value=4>☆☆☆☆</option>
                            <option value=3>☆☆☆</option>
                            <option value=2>☆☆</option>
                            <option value=1>☆</option>
                        </select><br>
<!-- This is an input field where users can enter their desired location. Entering a specific location overrides the default value,
which is the user's current location. -->
                        <label for="location">Near </label><br>
                        <input id="location" type="text" name="location" placeholder="My Location" value="<?php rePOST('location'); ?>"><br>
<!-- This button gets the user's location when clicked. -->
                        <div class="buttonHolder">
                            <button type="button" id="geolocation" onClick="getLocation()">Get my location</button>
                        </div>
<!-- The status div is where the geolocation error messages are displayed,
if they exist -->
                        <p id="status"></p>
<!-- By default, the Submit button searches for donation centres near a user's location. -->
                        <div class="buttonHolder">
                            <input type="submit" value="Search" onClick="if (document.getElementById('location') == '') getLocation()">
                        </div>
                    </div>
                </form>
            </div>
        </div>
<!-- The footer currently holds a description this page. It may eventually be extended to include links and shortcuts. -->
        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</html>