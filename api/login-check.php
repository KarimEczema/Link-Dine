<?php
// Include the JWT library
require __DIR__ . '/vendor/autoload.php';


$host = "ep-twilight-term-343583-pooler.eu-central-1.postgres.vercel-storage.com";
$port = "5432";
$dbname = "verceldb";
$user = "default";
$password = "Y4vuPQm2xyTl";

$dsn = "pgsql:host=db.bmqgiyygwjnnfyrtjkno.supabase.co;port=5432;dbname=postgres;user=postgres;password=Au5SebXYkT3DUnW4";


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
        $username = $decoded->username;
        
        // Continue processing or redirect to authenticated page
        echo "Logged in as: " . $username;
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