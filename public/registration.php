<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";

// Variables to hold validated values.
$firstname = $lastname = $email = $password = $zipcode = $birthday = "";
// Keep track of errors.
$firstnameError = $lastnameError = $emailError = $passwordError = $zipcodeError = $birthdayError = "";
require_once "../scripts/validate.php";

// This page is not available in private mode so verify that user is not logged in before showing.
// Redirect to home page otherwise.
if (isLoggedIn()) {
    $redirect_page =  'https://{$_SERVER["HTTP_HOST"]}/index.php/';
    header("Location: " . $redirect_page);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
// Validate and process posted input values here
    if(processData($_POST)) {
        if (! userExists($email)) {
            if (addUser($email, $password, $firstname, $lastname, $zipcode, $birthday)) {
                session_start();
                $_SESSION["isLoggedIn"] = true;
                global $email;
                $_SESSION["username"] = $email;
// Redirect user to profile page.
                $redirect_page = preg_replace('/registration.php/', 'profile.php', $_SERVER["REQUEST_URI"]);
                header("Location: " . $redirect_page);
            }
        }
        else {
            echo ("<script>alert('Registration failed - user already exists');</script>");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            show_title("Sign up");
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
        <!--script type ="text/javascript" src="../scripts/registration.js"></script-->
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                show_header("Register");
            ?>
        </div>
        
        <div id="content-container">
            <div id="registration-content">
                <h3>Sign up for Donation Box Finder</h3>
                <div id="sign-up">
                    <form name="register" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="firstname">First Name</label><br>
                        <input id="firstname" name="firstname" type="text" placeholder="First Name" value="<?php echo (rePOST('firstname')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $firstnameError;
                            ?>
                        </span><br>
                        <label for="lastname">Last Name</label><br>
                        <input id="lastname" name="lastname" type="text" placeholder="Last Name" value="<?php echo (rePOST('lastname')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $lastnameError;
                            ?>
                        </span><br>
                        <label for="email">Email</label><br>
                        <input id="email" name="email" type="email" placeholder="Email" value="<?php echo (rePOST('email')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $emailError;
                            ?>
                        </span><br>
                        <label for="password">Password</label><br>
                        <input id="password" name="password" type="password" placeholder="Password" value="<?php echo (rePOST('password')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $passwordError;
                            ?>
                        </span><br>
                        <label for="zipcode">Zip Code</label><br>
                        <input id="zipcode" name="zipcode" type="text" placeholder="ZIP Code" value="<?php echo (rePOST('zipcode')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $zipcodeError;
                            ?>
                        </span><br>
                        <label for="birthday">Birthday</label><br>
                        <input id="birthday" name="birthday" type="date" value="<?php echo (rePOST('birthday')); ?>"><br>
                        <span class="error">
                            <?php
                                echo $birthdayError;
                            ?>
                        </span><br>

                        <div class="buttonHolder">
                            <input id="submit" type="submit" name="signup">
                        </div>
                    </form>
                    <p id="signin">Already have an account? Sign in <a href="signin.php">here</a>.</p>
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