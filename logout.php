<?php

session_start();

// If the user is logged in, destroy the session
if(isset($_SESSION['username'])) {

    
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();
    echo "<h1>Session Ended. You will be redirected to login page</h1>";
    // Redirect the user to the login page or any other page
    header("Location: login.html");
    exit;
} else {
    // If the user is not logged in, redirect to the login page or any other page
    header("Location: login.html");
    exit;
}
?>