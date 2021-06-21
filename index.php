<?php
// Include database configuration file
require_once 'DbConnection.php';

// Include URL Shortener library file
require_once 'ShortenUrl.php';
// Initialize Shortener class and pass PDO object
$db=accessDatabase();
$shortener = new ShortenUrl($db);

$shortURL_Prefix = 'http://localhost/URL-Shorterner/?e='; 
echo 'hello';
if (isset($_POST['submit'])){
  echo 'submitted';
    $url=$_POST["url"];
    try{
      $randomid=$shortener->urlShorten($url);
      $shortURL = $shortURL_Prefix.$randomid;
      echo 'Short URL: '.$shortURL;

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
<body>
  
<h1>What's your link?</h1>
<p>Enter your domain</p>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <label for="fname">URL</label><br>
    <input type="text" id="url" name="url"><br><br>
    <input type="submit" name="submit" id="submit" value="Submit">
  </form>

</body>
</html>