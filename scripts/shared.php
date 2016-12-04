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

// This function returns true if user's email already exists in the dbf database; returns false otherwise.
function userExists($email) {try {
// Use PDO to connect to the database.
        $db = getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Prepare the query.
        $query = $db->prepare('SELECT * FROM users
            WHERE username = :username
            ');
// Execute the query using passed in username and password values as parameters.
        $query->execute(array(':username' => $email));
// This would return true if exactly one match is found in the database.
        return $query->rowCount() === 1;
    }
    catch (PDOException $e) {
// TODO: Do something if there is a database connection problem.
    }
// If password/username combination is not found in the database, return false.
    return false;
}

// This function adds a user to the dbf table users after successful registration.
function addUser($email, $password, $firstname, $lastname, $zipcode, $birthday) {
    try {
// Use PDO to connect to the database.
        $db = getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Prepare the query.
        $query = $db->prepare('INSERT INTO users (username, salt, passwordhash, firstname, lastname, zipcode, birthday)
            VALUES(:email, `salt`, SHA2(CONCAT(:password, `salt`), 0),:firstname, :lastname, :zipcode, :birthday)');
// Execute the query using passed in values as parameters.
        $query->execute(array(':email' => $email, ':password' => $password, ':firstname' => $firstname, ':lastname' => $lastname, ':zipcode' => $zipcode, ':birthday' => $birthday));
    }
    catch (PDOException $e) {
    }
}
?>