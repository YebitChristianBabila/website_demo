<?php
session_start();

// Store the redirect URL based on the type of user
$redirect_url = 'login.php';

// Check if it's an admin session
if (isset($_SESSION['admin_id'])) {
    // Clear admin session variables
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_role']);
} 
// Check if it's a user session
elseif (isset($_SESSION['user_id'])) {
    // Clear user session variables
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
}

// Unset all remaining session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: " . $redirect_url);
exit();
?> 