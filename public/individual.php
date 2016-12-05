<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";

// Prints user reviews in individual pages.
function generateReviews($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM reviews where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    echo '<div id="reviewpane">';
    foreach ($info as $row) {
        echo '<div class="review">
                <div class="user">
                    <img src='
            . $row["photo"]
            . 'alt="User photo">
                    <h4>' 
            . $row["username"] 
            . '</h4>
                </div>
                <div class="star-rating">'
            . printStars($row['stars'])
            . '</div>
                <div class="comment">'
            . $row["review"]
            .'
                </div>
            </div>';
    }
    echo '</div>';
}

// Gets the place's name for title printing.
function getName($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM places where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    return $info[0]['placename'];
}

// Generates individual pages.
function generateIndividual($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM places where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    print_r($info);
    echo '<h3 id="placename">'
    . $info[0]["placename"]
    . ' </h3>
        <h4>'
    .       $info[0]["address"]
    . ' </h4>
    <div id="productpane">
        <div id="description">'
            . $info[0]["description"]
    .   '</div>'
    .   '<div id="pictures"><img id="pic" src="'
        . $info[0]["photo"]
        . '" alt="Photo of location">
        </div>
        <div id="map">
        </div>
    </div>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            show_title(getName($_GET['place_id']));
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/individual.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Search");
            ?>
        </div>
        
        <div id="content-container">
            <div id="individual-content">
                <?php
// GET the place_id and generate HTML based on database information.
                    generateIndividual($_GET['place_id']);
                    generateReviews($_GET['place_id']);
                ?>
            </div>
        </div>

        <div id="footer-container">
            <footer>
                Micaela Estabillo's CS 4WW3 Project
            </footer>
        </div>
    </body>
</html>