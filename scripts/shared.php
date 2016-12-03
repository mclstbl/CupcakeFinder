<?php
// This file contains functions that are common between multiple pages.
// Include credentials needed by the database.
require_once "credentials.php";
// Tell PHP not to report errors so they don't show up in the HTML pages.
// error_reporting(0);
// This function checks that the user is logged in.
function isLoggedIn() {
// Start a new session or resume one if it exists.
    if (session_status() == PHP_SESSION_NONE)
        session_start();
// Return false if no user isLoggedIn session var is not set.
    if (!isset($_SESSION['isLoggedIn']))
        return false;
// It returns isLoggedIn value otherwise (true if logged in, false otherwise).
    return ($_SESSION['isLoggedIn']);
}
// This function queries the database for the passwordhash associated with a username.
// It uses the salted version of the password and the username (email).
function checkPassword($username, $password) {
    try {
// Use PDO to connect to the database.
        $db = getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Prepare the query.
        $query = $db->prepare('SELECT * FROM users
            WHERE username = :username
            and passwordhash = SHA2(CONCAT( :password , `salt`), 0)
            ');
// Execute the query using passed in username and password values as parameters.
        $query->execute(array(':username' => $username, ':password' => $password));
// This would return true if exactly one match is found in the database.
        return $query->rowCount() === 1;
    }
    catch (PDOException $e) {
// TODO: Do something if there is a database connection problem.
    }
// If password/username combination is not found in the database, return false.
    return false;
}
// This is a test function.
// TODO: Make it useful or remove.
function processData() {
    foreach ($_POST as $key => $value) {
        echo "($key) => ($value)<br/>";
    }
}
// This function checks if an email is in a valid format: chars@chars.chars.
function validateEmail($field_list, $field_name) {
    if (!isset($field_list[$field_name]))
        return false;
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
// Return true if email is valid, false otherwise.
    return (preg_match($pattern, $field_list[$field_name]) === 1);
}
// This function contains form validation code.
// TODO: separate into their own functions.
function validateForm() {
// Check if first name field is not empty.
    if (isset($_POST["firstname"])) {
        $firstname_ = test_input($_POST["firstname"]);
        if ($firstname_ == "") {
            return false;
        }
        else {
            $GLOBALS["firstname"] = $firstname_;
        }
    }
    else {
        return false;
    }
// Check if last name field is not empty.
    if (isset($_POST["lastname"])) {
        $lastname_ = test_input($_POST["lastname"]);
        if ($lastname_ == "") {
            return false;
        }
        else {
            $GLOBALS["lastname"] = $lastname_;    
        }
    }
    else {
        return false;
    }
/*
// TODO: Translate this to PHP (currently in Javascript).
// Check if email is filled in.
    if (x == null || x == "") {
        alert("Email must be filled out");
        return false;
// Check if email is valid.
        var re = /[-_\.a-zA-Z0-9]+\@{1}[a-zA-Z0-9]+\.{1}[a-zA-Z]+/;
        if (!re.test(x)) {
            alert("Email is invalid");
            return false;
        }
    }
// Check if password field is not empty.
    x = document.forms["register"]["password"].value;
    if (x == null || x == "") {
        alert("Password must be filled out");
        return false;
    }
// Check if zipcode field is not empty.
    x = document.forms["register"]["zipcode"].value;
    if (x == null || x == "") {
        alert("Zipcode must be filled out");
        return false;
    }
// Check if zipcode is valid according to Canadian format.
        var re = /[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}[0-9]{1}/;
        if (!re.test(x)) {
            alert("Zipcode is not valid");
            return false;
        }
*/
// Return true if you get to this point without issues.
    return true;
}
// To prevent injections using forms, special characters, slashes and extra space are removed from all inputs.
// This is only used in the registration page.
// TODO: Use in all applicable pages.
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>