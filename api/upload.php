<?php
// Include Supabase library
require 'vendor/autoload.php';

// Initialize Supabase
$supabaseUrl = 'your-supabase-url';
$supabaseKey = 'your-supabase-key';
$supabase = new \Supabase\Supabase($supabaseUrl, $supabaseKey);

// Get image file from the request
$image = $_FILES['image'];

// Define where to store the image
$storagePath = '/path/to/storage/';

// Upload the image to Supabase storage
$result = $supabase->storage->uploadFile($storagePath . $image['name'], $image['tmp_name'], array('cacheControl' => '3600'));

// Check if upload was successful
if ($result['error'] == null) {
    echo 'Upload successful';
} else {
    echo 'Upload failed: ' . $result['error']['message'];
}
?>
