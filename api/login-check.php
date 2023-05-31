<?php
session_start();

if (!isset($_COOKIE['username'])) {
    header('Location: index');
    exit();
} 
    


?>