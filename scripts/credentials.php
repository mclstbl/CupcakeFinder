<?php
// Don't check this in. But needs to be available in the server.
// Also change user/password strings.
// File should be locally stored in the server, this is just an outline.
// Credentials need to work with the database created in dbsetup.sql.

function getDB() {
    try {
        $db_ = new PDO('mysql:host=localhost;dbname=dbf', 'user', 'password');
        return $db_;
    }
    catch (PDOException $e) {}
}
?>