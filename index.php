<?php
// Include database configuration file
require_once 'DbConnection.php';

// Include URL Shortener library file
require_once 'ShortenUrl.php';
// Initialize Shortener class and pass PDO object
$db=accessDatabase();
$shortener = new ShortenUrl($db);

$shortURL_Prefix = 'http://localhost/URL-Shorterner/?e='; 

if (isset($_POST['submit'])){

    $url=$_POST["url"];
    try{
      $randomid=$shortener->urlShorten($url);
      $shortURL = $shortURL_Prefix.$randomid;
      echo 'Short URL: '.$shortURL;
      unset($_POST['submit']);

    }catch(Exception $e){
      echo $e->getMessage();
    }
    
}
if(isset($_GET["e"])){
  try{
    $url=$shortener->redirect($_GET["e"]);
    header("Location: ".$url);

  }catch(Exception $e){
    echo $e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
    <body class="center">
      <div class="container-fluid  "> 
        <div class="row title">
          <h1 class="title-black">WHAT'S YOUR LINK?</h1>
        </div>
        <div class="row title">
          <p>Paste it!</p>
        </div>
        <div class="row title">
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
              <input type="text" id="url" name="url"><br><br>
              <input type="submit" name="submit" id="submit" value="Submit">
            </form>
        
      </div>
    </body>
</html>