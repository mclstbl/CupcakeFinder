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
function getPlaces($method) {
// Set variables according to POSTed values.
    if (isset($method['clothing']) and $method['clothing']) {
        global $clothing;
        $clothing = true;
    }
    if (isset($method['electronics']) and $method['electronics']) {
        global $electronics;
        $electronics = true;
    }
    if (isset($method['food']) and $method['food']) {
    global $food;
        $food = true;
    }
    if (isset($method['stars'])) {
        global $stars;
        $stars = $method['stars'];
    }
// Split location coordinates string into longitude and latitude floats.
    if (isset($method['location']) and $method['location'] != '') {
        $loc = explode(',', $method['location']);
        global $longitude, $latitude;
        $longitude = (float) $loc[0];
        $latitude = (float) $loc[1];
    }

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
    foreach ($query as $row) {
        echo(
        '<li>
                <img class="pic" src="' . $row['photo'] . '" alt="Location photo">
                <a href="individual.php/?place_id='
                . $row['place_id']
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

// This function uploads a submitted file to the dbf-photos S3 bucket.
function uploadToS3($file) {
// Check if the file is actually a photo.
// tmp_name is what PHP temporarily names the photo file.
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    if ($finfo->file($_FILES['newphoto']['tmp_name']) === "image/jpeg") {
        $fileextension = "jpg";
    }
// Cancel upload if its type is not jpg.
    else {
        echo 'Uploaded file was not a valid image.';
        return;
    }
// Use the file's SHA1 hash as filename in order to make it unique.
    $filehash = sha1_file($_FILES['newphoto']['tmp_name']);
    $filename = $filehash . "." . $fileextension;
// Get AWS S3 credentials from credentials.php.
    $awsAccessKey = getS3AccessId();
    $awsSecretKey = getS3SecretAccessKey();
    $bucketName = getS3BucketName();
// Use S3.php to create a connection to the bucket.
    $s3 = new S3($awsAccessKey, $awsSecretKey);
// Try to put the photo in the bucket.
    $ok = $s3->putObjectFile($_FILES['newphoto']['tmp_name'], $bucketName, $filename, S3::ACL_PUBLIC_READ);
// Check for success and update file URL which is returned.
    if ($ok) {
        $url = 'http://' . $bucketName . '.s3-website-us-west-2.amazonaws.com/' . $filename;
        return $url;
    }
    return "";
}

// This function adds a new place to the database. It is used in the submission page.
function addPlace($method, $photourl) {
// Initialize variables to hold image information.
    $place_id = -1;
    $placename = $description = "";
    $address = "See coordinates";
    $clothing = $electronics = $food = (bool) 0;
    $latitude = $longitude = 0;
// Loop through POST values and assign them to their respective variables.
    foreach ($method as $key=>$data) {
        global $place_id, $placename, $description, $address, $clothing, $electronics, $food;
        global $latitude, $longitude;
        global $placenameError, $latitudeError, $longitudeError;
// Only the place's name and location (longitude and latitude) are required. Everything else is optional.
        switch ($key) {
            case "placename":
                if(isset($method[$key]) and $method[$key] != '') {
                    $placename = $data;
                }
                else
                {
                    $placeNameError = "Name is required";
                    return false;
                }
                break;
            case "description":
                if(isset($method[$key])) {
                    $description = $data;
                }
                break;
            case "address":
                if(isset($method[$key])) {
                    $address = $data;
                }
                break;
            case "latitude":
                if(isset($method[$key]) and $method[$key] != '') {
                    $latitude = $data;
                }
                else {
                    $latitudeError = "Latitude is required";
                    return false;
                }
                break;
            case "longitude":
                if(isset($method[$key]) and $method[$key] != '') {
                    $longitude = $data;
                }
                else {
                    $longitude = "Longitude is required";
                    return false;
                }
                break;
            case "clothing":
                if(isset($method[$key])) {
                    $clothing = (bool) 1;
                }
                break;
            case "electronics":
                if(isset($method[$key])) {
                    $electronics = (bool) 1;
                }
                break;
            case "food":
                if(isset($method[$key])) {
                    $food = (bool) 1;
                }
                break;
        }
    }
// Use PDO to connect to the database.
// Do not catch to reveal DB errors.
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);
// Get the new place_id by incrementing current number of rows.
    $place_id = $db->query('SELECT * FROM places')->rowCount() + 1;
// Return if place_id failed to be updated.
    if ($place_id < 1) return;
// Debug print
// echo ($place_id . $placename . $description . $address . $clothing . $electronics . $food . $latitude . $longitude);
// Prepare the insert query.
    $query = $db->prepare("
        INSERT INTO places (place_id, placename, address, description, clothing, electronics, food, latitude, longitude, photo)
        VALUES(:place_id, :placename, :address, :description, :clothing, :electronics, :food, :latitude, :longitude, :photo)
    ");
// Execute the query using passed in values as parameters.
    return($query->execute(array('place_id'=>$place_id, 'placename'=>$placename,
        'address'=>$address, 'description'=>$description, 'clothing'=>$clothing,
        'electronics'=>$electronics, 'food'=>$food, 'latitude'=>$latitude,
        'longitude'=>$longitude, 'photo'=>$photourl)));
    return false;
}

// Prints user reviews in individual pages.
function generateReviews($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM reviews where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    echo '<div id="reviewpane">';
    foreach ($info as $row) {
        echo '<div class="review">
                <div class="user">
                    <img src='
            . $row["photo"]
            . 'alt="User photo">
                    <h4>' 
            . $row["username"] 
            . '</h4>
                </div>
                <div class="star-rating">'
            . printStars($row['stars'])
            . '</div>
                <div class="comment">'
            . $row["review"]
            .'
                </div>
            </div>';
    }
    echo '</div>';
}

// Gets the place's name for title printing.
function getName($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM places where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    return $info[0]['placename'];
}

// Generates individual pages.
function generateIndividual($p_id) {
    $db = getDB();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    error_reporting(E_ALL);

// Prepare the select query.
    $query = $db->prepare('SELECT * FROM places where place_id=:place_id');
// Execute the query using passed in values as parameters.
    $query->execute(array('place_id'=>$p_id));
    $info = $query->fetchAll();

    echo '<h3 id="placename">'
    . $info[0]["placename"]
    . ' </h3>
        <h4>'
    .       $info[0]["address"]
    . ' </h4>
    <div id="productpane">
        <div id="description">'
            . $info[0]["description"]
    .   '</div>'
    .   '<div id="pictures"><img id="pic" src="'
        . $info[0]["photo"]
        . '" alt="Photo of location">
        </div>
        <div id="map">
        </div>
    </div>';
}
?>