<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Donation Box Finder | Sign up </title>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/registration.js"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                require_once "../scripts/menu.php";
                show_header("Register");
            ?>
        </div>
        
        <div id="content-container">
            <div id="registration-content">
                <h3>Sign up for Donation Box Finder</h3>
                <div id="sign-up">
                    <form name="register" action="#" onsubmit="return validateForm()">
                        <label for="firstname">First Name</label>
                        <input id="firstname" type="text" placeholder="First Name" required><br>
                        <label for="lastname">Last Name</label>
                        <input id="lastname" type="text" placeholder="Last Name" required><br>
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="Email" required><br>
                        <label for="password">Password</label>
                        <input id="password" type="password" placeholder="Password" required><br>
                        <label for="zipcode">Zip Code</label>
                        <input id="zipcode" type="text" placeholder="ZIP Code"><br>
                        <label for="birthday">Birthday</label>
                        <input id="birthday" type="date"><br>

                        <input id="submit" type="submit" value="Sign up">
                    </form>
                    <p id="signin">Already have an account? Sign in <a href="signin.html">here</a></p>
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