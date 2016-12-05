<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";

function generateHeader() {
    echo '<html lang="en">
    <head>'
    . show_title(getName($_GET['place_id']))
    . '
        <link rel="stylesheet" href="' 
    . 'https://' . $_SERVER["HTTP_HOST"] . '/public/css/style.css'
    .'">
        <link rel="icon" href="'
    . 'https://' . $_SERVER["HTTP_HOST"] . '/public/images/logo.png'
    . '">
        <script type ="text/javascript" src="'
    . 'https://' . $_SERVER["HTTP_HOST"] . '/scripts/individual.js'
    . '"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
        <body>
        <div id="header-container">
            <div id="header-container">
            <h1 id="headertitle"><a href='
            . 'https://' . $_SERVER["HTTP_HOST"] . '/index.php'
            .' >Donation Box Finder</a></h1>
            <h2 id="headersubtitle">Find donation centres near you</h2>
            <div id="nav"><ul>
                <li><a class="menubutton" href="'
            . 'https://' . $_SERVER["HTTP_HOST"] . '/index.php'
            .'">Home</a></li>
                <li><a class="menubutton" id="active" href="'
            . 'https://' . $_SERVER["HTTP_HOST"] . '/public/search.php'
            .'">Search</a></li>
                <li><a class="menubutton" href="'
            . 'https://' . $_SERVER["HTTP_HOST"] . '/public/submission.php'
            .'">Submit</a></li>
                <li><a class="menubutton" href="'
            . 'https://' . $_SERVER["HTTP_HOST"] . '/public/profile.php'
            .'">Profile</a></li>
                <li><a class="menubutton" href="'
            .  'https://' . $_SERVER["HTTP_HOST"] . '/scripts/logout.php'
            .'">Logout</a></li>';
}
?>
<!DOCTYPE html>
<?php
    generateHeader();
?>
            </ul>
            </div>
            </div>
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
