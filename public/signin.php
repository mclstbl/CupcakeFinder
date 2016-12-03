<?php
require_once "../scripts/shared.php";
// This page is not available in private mode so verify that user is not logged in before showing.
// Redirect to home page otherwise.
if (isLoggedIn()) {
    $redirect_page =  'https://{$_SERVER["HTTP_HOST"]}/index.php/';
    header("Location: " . $redirect_page);
    exit();
}
// Define variables and set to empty values.
$email = $password = "";
// Validate login data if there is a POST request.
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
// Check password and set isLoggedIn session variable to true.
    if (checkPassword($_POST["email"], $_POST["password"])) {
        session_start();
        $_SESSION["isLoggedIn"] = true;
// Redirect user to profile page.
        $redirect_page = preg_replace('/signin.php/', 'profile.php', $_SERVER["REQUEST_URI"]);
        header("Location: " . $redirect_page);
    }
    else {
// TODO: Display login failed msg
        session_start();
        $_SESSION["isLoggedIn"] = false;
// If credentials don't work then redirect to login page (this page).
        $redirect_page = $_SERVER["REQUEST_URI"];
        header("Location: " . $redirect_page);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            require "../scripts/menu.php";
            show_title("Sign in");
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Sign in");
            ?>
        </div>
        
        <div id="content-container">
            <div id="signin-content">
                <h3>Log in to Donation Box Finder</h3>
                <div id="sign-in">
<!-- Using the htmlspecialchars PHP function avoids HTML injection by removing escaped special chars. -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="email">Email</label><br>
                        <input id="email" name="email" type="email" placeholder="Email" required><br><br>
                        <label for="password">Password</label><br>
                        <input id="password" name="password" type="password" placeholder="Password" required><br><br>
                        <div class="buttonHolder">
                            <input id="submit" type="submit" name="login">
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