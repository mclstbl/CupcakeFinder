<?php
// Reset session.
session_start();
unset($_SESSION['isLoggedIn']);
// Find home page for redirect.
$redirect_page = preg_replace('/public\/logout.php/', 'index.php', $_SERVER["REQUEST_URI"]);
// Let the user know they are logged out and redirect.
echo (
    "<script>alert('User has been logged out');
    window.location.href='" . $redirect_page . "'</script>"
);
exit;
?>