<?php
// Include the JWT library
require __DIR__ . '/vendor/autoload.php';

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

// Your secret key
$secretKey = new Key('123', 'HS256');

// Check if the JWT exists in the cookie
if (isset($_COOKIE['jwt'])) {
    // Get the JWT from the cookie
    $jwt = $_COOKIE['jwt'];
    
    try {
        // Decode the JWT
        $decoded = JWT::decode($jwt, $secretKey);
        
        // Get the username from the decoded payload
        $iduser = $decoded->iduser;
        
        // Continue processing or redirect to authenticated page

        echo '<script>';
        echo 'var username = "' . $idUser . '";';
        echo '</script>';
        echo "Logged in as: " . $idUser;
    } catch (Exception $e) {
        // JWT validation failed
        // Redirect to login page or show error message
        echo 'Error: ' . $e->getMessage();
        header('Location: index.php');
        exit;
    }
} else {
    // JWT is not set, user is not logged in
    // Redirect to login page or show error message
    echo 'not';
    header('Location: index.php');
    exit;
}
?>