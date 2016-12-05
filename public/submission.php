<?php
require_once "../scripts/shared.php";
require_once "../scripts/menu.php";
require("../scripts/S3.php");

$placenameError = $latitudeError = $longitudeError = "";

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

if ($_SERVER["REQUEST_METHOD"] == "POST" and !empty($_POST)) {
    $photourl = "";
    if (file_exists($_FILES['newphoto']['tmp_name'])) {
        $photourl = uploadToS3($_FILES['newphoto']['tmp_name']);
    }
// If the place is successfully added to the database, redirect to the object's page.
    if (addPlace($_POST, $photourl)) {
        //$redirect_page =  'https://{$_SERVER["HTTP_HOST"]}/public\/signin.php/';
        //header("Location: " . $redirect_page);
        //exit();
    }
}


// This function shows user a submission form if they are signed in.
// It shows the registration link otherwise.
function newObject() {
    global $placenameError, $latitudeError, $longitudeError;
    if (isLoggedIn()) {
        echo '<form method="POST" action="submission.php" enctype="multipart/form-data">
            <label for="name">Name of Organization</label><br>
            <input id="name" name="placename" type="text" placeholder="Name of donation centre" value="' . rePOST("placename") . '"><br>
            <span class="error">
                <?php
                    echo ' . $placenameError . '
                ?>
            </span><br>
            <label for="description">Description</label><br>
            <input id="description" name="description" placeholder="Description" value="' . rePOST("description") . '"><br><br>
            <label for="address">Address</label><br>
            <input id="addess" name="address" placeholder="Address" value="' . rePOST("address") . '"><br><br>
            <label for="latitude">Latitude</label><br>
            <input id="latitude" name="latitude" type="number" step="0.001" placeholder="Latitude position" pattern="-[0-9]+\.[0-9]+" value="' . rePOST("latitude") . '"><br>
            <span class="error">
                <?php
                    echo $latitudeError;
                ?>
            </span><br>
            <label for="longitude">Longitude</label><br>
            <input id="longitude" name="longitude" type="number" step="0.001" placeholder="Longitude position" pattern="-[0-9]+\.*[0-9]*" value="' . rePOST("longitude") . '"><br>
            <span class="error">
                <?php
                    echo $longitudeError;
                ?>
            </span><br>
        <!-- This button gets the user location when clicked. -->
            <div class="buttonHolder">
                <button type="button" id="geolocation" onClick="getLocation()">Get my location</button>
            </div>
            <p id="status"</p>
            <legend>Accepts</legend>
            <fieldset>
                <input id="clothing" name="clothing" type="checkbox" value="clothing"><label for="clothing"> Clothing</label>
                <input id="electronics" name="electronics" type="checkbox" value="electronics"><label for="electronics"> Electronics</label>
                <input id="food" name="food" type="checkbox" value="food"><label for="food"> Food</label>
            </fieldset>
            <br>
            
            <div class="buttonHolder">
                <label for="image">Upload photo</label><br>
                <input id="image" type="file" name="newphoto" value="' . rePOST("newphoto") . '"><br>
                <input id="submit" type="submit" value="Submit">
            </div>
        </form>';
    }
    else {
        echo "<p>You need an account to submit a donation centre. Register <a href='registration.php'>here</a>.</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            show_title("Submit");
        ?>
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" href="images/logo.png">
        <script type ="text/javascript" src="../scripts/submission.js"></script>
        <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA10vc2deGv18oPyOA1w1k7H6i7mAIzMuA" type="text/javascript"></script>
    </head>
    <body>
        <div id="header-container">
<!-- The menu.php show_header function is used to generate the nav bar.
Passing the page title determines what the generated header looks like. -->
            <?php
                show_header("Submit");
            ?>
        </div>
        
        <div id="content-container">
            <div id="submission-content">
                <h3>Submit a donation centre location</h3>
                <div id="newobject">
                    <?php
                        newObject();
                    ?>
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