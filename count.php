<?php
// Include database configuration file
require_once 'php/DbConnection.php';

// Include URL Shortener library file
require_once 'php/ShortenUrl.php';
// Initialize Shortener class and pass PDO object
$db=accessDatabase();
$shortener = new ShortenUrl($db);

if(isset($_GET["e"])){
    try{
      $count=$shortener->getCount($_GET["e"]);
      echo $count;
    }catch(Exception $e){
      echo $e->getMessage();
    }
  }
?>