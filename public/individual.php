<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";
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