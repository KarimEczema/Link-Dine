<?php
// Include the JWT library
require 'vendor\firebase\php-jwt\src\JWT.php';

use \Firebase\JWT\JWT;

// Your secret key
$secretKey = '123';

// Check if the JWT exists in the cookie
if (isset($_COOKIE['jwt'])) {
    // Get the JWT from the cookie
    $jwt = $_COOKIE['jwt'];
    
    try {
        // Decode the JWT
        $decoded = JWT::decode($jwt, $secretKey, array('HS256'));
        
        // Get the username from the decoded payload
        $username = $decoded->username;
        
        // Continue processing or redirect to authenticated page
        echo "Logged in as: " . $username;
    } catch (Exception $e) {
        // JWT validation failed
        // Redirect to login page or show error message
        echo 'no';
        //header('Location: index.php');
        exit;
    }
} else {
    // JWT is not set, user is not logged in
    // Redirect to login page or show error message
    echo 'not';
    //header('Location: index.php');
    exit;
}
?>