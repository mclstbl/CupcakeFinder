<?php
// Reset session.
session_start();
unset($_SESSION['isLoggedIn']);
// Find home page for redirect.
$redirect_page = preg_replace('/public\/logout.php/', 'index.php', $_SERVER["REQUEST_URI"]);
// Redirect user to home page to let them know they have logged out.
header("Location: " . $redirect_page);
exit;
?>