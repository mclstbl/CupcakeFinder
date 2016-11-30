<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Donation Box Finder | Search</title>
        <link rel="stylesheet" href="public/css/style.css">
        <script type ="text/javascript" src="scripts/index.js"></script>
        <meta charset="utf-8">
        <link rel="icon" href="public/images/logo.png">
    </head>
    <body>
<!-- The header-container div contains the navigation tabs and the title of this website. -->
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "scripts/menu.php";
                show_header("Home");
            ?>
        </div>
<!-- The content-container div separates the main functions of the search page form the header and the footer. -->
        <div id="content-container">
            <div id="search-content">
                <h3>Start your search here</h3>
                <form id="search" action="public/results.php#results-container">
<!-- The following fieldset presents the different types of donation centres for which the user may perform a search.
A checkbox is used for each so multiple values can be selected in a single search. -->
                    <div id="options">
                        <legend>Donate </legend>
                        <fieldset>
                        <input id="clothing" type="checkbox" value="clothing">
                        <label for="clothing"> Clothing</label>
                        <input id="electronics" type="checkbox" value="electronics">
                        <label for="electronics"> Electronics</label>
                        <input id="food" type="checkbox" value="food">
                        <label for="food"> Food</label><br>
                        </fieldset>
<!-- The "rating" dropdown menu allows a user to filter displayed results according to minimum rating. -->
                        <label for="rating">Minimum Rating</label>
                        <select id="rating" name="starlist">
                          <option value="five">☆☆☆☆☆</option>
                          <option value="four">☆☆☆☆</option>
                          <option value="three">☆☆☆</option>
                          <option value="two">☆☆</option>
                          <option value="one">☆</option>
                        </select> <br>
<!-- This is an input field where users can enter their desired location. Entering a specific location overrides the default value,
which is the user's current location. -->
                        <label for="location">Near </label>
                        <input id="location" type="text" name="location" placeholder="My Location"><br>
<!-- This button gets the user's location when clicked. -->
                        <div class="buttonHolder">
                            <button type="button" id="geolocation" onClick="getLocation()">Get my location</button>
                        </div>
<!-- The status div is where the geolocation error messages are displayed,
if they exist -->
                        <p id="status"></p>
<!-- By default, the Submit button searches for donation centres near a user's location. -->
                        <div class="buttonHolder">
                            <input type="submit" value="Search">
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