<?php
require_once "../scripts/shared.php";
// This page is private so verify that user is logged in before showing.
// Redirect to signin page otherwise.
if (! isLoggedIn()) {
    $redirect_page =  'https://{$_SERVER["HTTP_HOST"]}/public\/signin.php/';
    header("Location: " . $redirect_page);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require_once "../scripts/menu.php";
            show_title("Home");
        ?>
        <link rel="icon" href="images/logo.png">
        <link rel="stylesheet" href="css/style.css">
        <script type ="text/javascript" src="../scripts/index.js"></script>
    </head>
    <body>
<!-- The header-container div contains the navigation tabs and the title of this website. -->
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Profile");
            ?>
        </div>
<!-- The content-container div separates the main functions of the search page form the header and the footer. -->
        <div id="content-container">
            <div id="search-content">
                <h3>View and edit user's data here</h3>
                <p>Show user's posts, photos, settings etc. This page was mostly created to make sure the menubar always has 5 items and that they stay centred. This is only visible when user is logged in.</p>
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