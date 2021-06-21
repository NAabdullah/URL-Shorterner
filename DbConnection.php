<?php

/* ///////////////////////////////access database////////////////////////////// */
function accessDatabase(){
    $db_user = "root";
    $db_pass = "";
    $db_name = "shortenurl";
    $db_host="127.0.0.1";
  
    
    // $connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    try{
        $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
        return $db ;
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }
    // if (!$connection){
    //     die("Database Connection Failed ".mysqli_error($connection));
    // }
    // $select_db = mysqli_select_db($connection, $db_name);
    // if (!$select_db){
    //     die("Database Selection Failed ".mysqli_error($connection));
    // }
  
    // return $connection;
  }
  
  function closeDatabase($con) {
      mysqli_close($con);
  }
  

?>