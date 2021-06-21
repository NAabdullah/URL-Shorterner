<?php
// Include database configuration file
require_once 'DbConnection.php';

// Include URL Shortener library file
require_once 'ShortenUrl.class.php';
// Initialize Shortener class and pass PDO object
$shortener = new ShortenUrl($db);

$shortURL_Prefix = 'https://localhost.com/?e='; 

?>
