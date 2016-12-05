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
function userExists($email) {
    try {
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
        return ($query->execute(array(':email' => $email, ':password' => $password, ':firstname' => $firstname, ':lastname' => $lastname, ':zipcode' => $zipcode, ':birthday' => $birthday)));
    }
    catch (PDOException $e) {
    }

    return false;
}

// This function queries the database for an array of places that match the search criteria.
function getPlaces() {
    try {
// Use PDO to connect to the database.
        $db = getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Prepare the query.
        $query = $db->prepare('SELECT * FROM places,reviews
            WHERE stars >= :stars
            ');
// Execute the query using passed in username and password values as parameters.
        global $stars;
        $query->execute(array(':stars' => $stars));
// This would return true if exactly one match is found in the database.
        //return $query->rowCount();
        return $query->fetchAll();
    }
    catch (PDOException $e) {}
}

// This function takes a rating (from database) and returns the string of stars corresponding to it.
function printStars($num) {
    $st = "☆";
    for ($i = 1; $i < $num; $i ++) {
        $st = $st . "☆";
    }
    return $st;
}

// This function counts the number of reviews for a place and returns it for printing to the HTML.
function printReviewCounts($place) {
    $res = 0;
    try {
// Use PDO to connect to the database.
        $db = getDB();
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Prepare the query.
        $query = $db->prepare('SELECT count(*) FROM reviews
            WHERE place_id = :place
            ');
// Execute the query using passed in username and password values as parameters.
        $query->execute(array(':place' => $place));
// This would return true if exactly one match is found in the database.
        //return $query->rowCount();
        $res = $query->rowCount();
    }
    catch (PDOException $e) {}
    if ($res == 1)
        return $res . ' review';
    else
        return $res . ' reviews';
}

// This function prints the different types of donation for a specific place as HTML list items.
function printTypes($c, $e, $f) {
    $res = "";
    if ($c)
        $res = $res . '<li>Clothing</li>';
    if ($e)
        $res = $res . '<li>Electronics</li>';
    if ($f)
        $res = $res . '<li>Food</li>';

    return $res;
}

// This function generates "cards" for each place in the search results page.
// It uses the data found in the database to generate HTML code.
function printSearchResults($query) {
// Generate HTML card for query results.
    //print_r($query[0]);
    foreach ($query as $row) {
     //   echo $row[0];
        echo(
        '<li>
                <img class="pic" src="' . $row['photo'] . '" alt="Location photo">
                <a href="individual.php/?place_id='
                . $row[0]
                . '">'
                . $row['placename']
                . '</a>
                
                <div class="left">
                    <div class="review">
                        <div class="stars">'
                            . printStars($row['stars'])
                            . '<div class="numberofreviews">'
                            . printReviewCounts($row['place_id'])
                            .'</div>
                        </div>
                        <ul class="types">'
                            . printTypes($row['clothing'], $row['electronics'], $row['food'])
                        . '</ul>
                    </div>
                </div>

                <div class="right">
                    <p class="address">'
                    . $row['address']
                    .'</p>
                </div>

                <div class="bottom">
                    <p class="topcomment"> "The red box is big and fits all of my unwanted stuff"</p>
                </div>
            </li>'
        );
    }
}

// Redisplays submitted POST fields in forms.
function rePOST($field) {
// Return the htmlspecialchars version of the field value to avoid injection,
// or empty string if the field is not set.
    return isset($_POST[$field]) ? htmlspecialchars($_POST[$field]) : '';
}
?>