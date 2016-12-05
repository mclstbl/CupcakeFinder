<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";

// Default values always return something because they search for the minimum criteria.
$clothing = $electronics = $food = false;
$stars = 1;
$latitude = 0;
$longitude = 0;

$results = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
// Set variables according to POSTed values.
    if (isset($method['clothing']) and $method['clothing']) {
        global $clothing;
        $clothing = true;
    }
    if (isset($method['electronics']) and $method['electronics']) {
        global $electronics;
        $electronics = true;
    }
    if (isset($method['food']) and $method['food']) {
    global $food;
        $food = true;
    }
    if (isset($method['stars'])) {
        global $stars;
        $stars = $method['stars'];
    }
// Split location coordinates string into longitude and latitude floats.
    if (isset($method['location']) and $method['location'] != '') {
        $loc = explode(',', $method['location']);
        global $longitude, $latitude;
        $longitude = (float) $loc[0];
        $latitude = (float) $loc[1];
    }
}
$results = getPlaces();

// echo ($clothing . ' ' . $electronics . ' ' . $food . ' ' . $stars . ' ' . $latitude . ' ' . $longitude . ' ');
?>
<!DOCTYPE php>
<php lang="en">
    <head>
        <?php
            show_title("Search results");
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"
            locations="<?php echo json_encode(htmlentities($results));?>"></script>
        <script type ="text/javascript" src="../scripts/results.js"></script>
    </head>
    <body onload="loadMap()">
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                show_header("Search");
            ?>
        </div>
        
        <div id="content-container">
            <div id="results-content">
                <!--div id="mini-search">
                    <form id="search" action="#">
                        <legend>Donate </legend>
                        <fieldset>
                        <input id="clothing" type="checkbox" value="clothing"><label for="clothing"> Clothing</label>
                        <input id="electronics" type="checkbox" value="electronics"><label for="electronics"> Electronics</label>
                        <input id="food" type="checkbox" value="food"><label for="food"> Food</label><br>
                        </fieldset>

                        <label for="near">Near</label>
                        <input id="near" type="text" name="location" placeholder="My location">
                        <input type="submit" value="Search">
                    </form>
                </div-->
                <a name="results">
                <h3>Search results</h3>

                <div id="map">
                </div>
                
                <h4>Scroll down and click name for details</h4>

                <div id="list">
                    <ol class="hits">
                        <?php if($results != null) printSearchResults($results); ?>
                    </ol>
                </div>
            </div>
        </div>

        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</php>