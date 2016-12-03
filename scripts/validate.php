<?php
// This file contains functions for validating input data.

// Iterate through POST fields and validate each value.
// Returns true if all validations pass. False otherwise.
function processData($method) {
    $ret = true;
    foreach ($method as $key => $value) {
        if(! validateData($key, test_input($value))) {
            $ret = false;
        }
    }
    return $ret;
}

//$nameError = $emailError = $passwordError = $zipcodeError = $birthdayError = "";

// This function contains form validation code.
function validateData($field, $val) {
    switch ($field) {
// Check if first/last name field is not empty.
        case "firstname":
            if (isset($_POST[$field])) {
                if ($val == "") {
                    $GLOBALS["firstnameError"] = "First name is required";
                    return false;
                }
                else {
                    $GLOBALS[$field] = $val;
                    $GLOBALS["firstnameError"] = "";
                }
            }
            break;
        case "lastname":
            if (isset($_POST[$field])) {
                if ($val == "") {
                    $GLOBALS["lastnameError"] = "Last name is required";
                    return false;
                }
                else {
                    $GLOBALS[$field] = $val;
                    $GLOBALS["lastnameError"] = "";
                }
            }
            break;
// Return true if email is valid, false otherwise.
        case "email":
// Email is required so return false if it is unset.
            $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/';
            if (!isset($_POST[$field]))
                $GLOBALS[$emailError] = "Email is required";
            else if (preg_match($pattern, $val) === 1) {
                $GLOBALS[$field] = $val;
            }
            else {
                $GLOBALS["emailError"] = "Email needs to follow pattern abc@def.ghi";
                return false;
            }
            break;
// Password is required.
        case "password":
            if (!isset($_POST[$field]))
                $GLOBALS[$passwordError] = "Password is required";
// Check if password field is at least 8 characters long and there are no spaces or special characters.
            else if (strlen($val) >= 8 && strlen($_POST[$field]) == strlen($val))
                $GLOBALS[$field] = $val;
            else {
                $GLOBALS["passwordError"] = "Password must be 8 or more alphanumeric characters long";
                return false;
            }
            break;
// Zipcode is optional but must be a in Canadian format A1A1A1 or A1A 1A1.
        case "zipcode":
            $pattern = '/^[a-zA-Z]{1}[0-9]{1}[a-zA-Z]{1}\s*[0-9]{1}[a-zA-Z]{1}[0-9]{1}$/';
            if (!isset($_POST[$field]) || $_POST[$field] == "") {
                break;
            }
            else if (preg_match($pattern, $val) === 1) {
                $GLOBALS[$field] = $val;
            }
            else {
                $GLOBALS["zipcodeError"] = "Zipcode must be in Canada";
                return false;
            }
            break;
    }
// Return true if you get to this point without issues.
    return true;
}

// To prevent injections using forms, special characters, slashes and extra space are removed from all inputs.
// This is used in all pages containing a form.
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>