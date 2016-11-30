<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Donation Box Finder | Sign in</title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
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
                    <form>
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="Email" required><br>
                        <label for="password">Password</label>
                        <input id="password" type="password" placeholder="Password" required><br>
                        <div class="buttonHolder">
                            <input id="submit" type="submit" value="Log in">
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