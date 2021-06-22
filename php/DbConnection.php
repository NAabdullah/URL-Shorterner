<?php

/* ///////////////////////////////access database////////////////////////////// */
function accessDatabase(){
    $db_user = "root";
    $db_pass = "";
    $db_name = "shortenurl";
    $db_host="127.0.0.1";
  
    

    try{
        $db = new PDO('mysql:host=' . $db_host . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
        return $db ;
    
    }catch(PDOException $e){
        echo "Connection failed: " . $e->getMessage();
    }

  }
  

?>