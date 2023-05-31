<?php
session_start();

if (isset($_COOKIE['username'])) {
    $username = $_COOKIE['username'];
    //echo $_SESSION['username'];
    //header('Location: index');
    exit();
} else {
    // Redirect to login page
}
    


?>