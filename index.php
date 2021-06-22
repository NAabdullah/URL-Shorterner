<?php
// Include database configuration file
require_once 'DbConnection.php';

// Include URL Shortener library file
require_once 'ShortenUrl.php';
// Initialize Shortener class and pass PDO object
$db=accessDatabase();
$shortener = new ShortenUrl($db);

$shortURL_Prefix = 'http://localhost/URL-Shorterner/?e='; 
$error=$shortened="";


if (isset($_POST['submit'])){
    
    $url=$_POST["url"];
    try{
      $randomid=$shortener->urlShorten($url);
      $shortURL = $shortURL_Prefix.$randomid;
      // echo 'Short URL: '.$shortURL;
      $shortened=$shortURL;
      unset($_POST['submit']);
      
      // unsetShortened();

    }catch(Exception $e){
      echo $e->getMessage();
      $error=$e->getMessage();
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

function unsetShortened(){
 
  unset($shortened);
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
      
        <?php 
        
          if (empty($shortened)==false)
          {
           
            echo '<br><br><input type="text" value="'.$shortened.'" id="updated">';
            // echo '<br><label id="updated" value="'.$shortened.'">'.$shortened.'</label>';
            echo '<br><br><button class="button-up" onclick="copyToClipboard()">Copy text</button>';
            echo '<button class="button-up" onclick="newEntry()">New!</button>';
            $shortened="";
          }else{
           
            echo '<form action='.htmlspecialchars($_SERVER["PHP_SELF"]);
            echo ' method="POST">
                    <input type="text" id="url" name="url"><br><br>
                    <input type="submit" name="submit" id="submit" value="Submit" class="button-up">
                  </form>';
          }
        ?>
      </div>
    </body>
    <script>
        function newEntry(){
          location.href = "index.php";

            // window.location.reload(true);
            // return false;

        }
        function copyToClipboard() {

          /* Get the text field */
          
          var copyText = document.getElementById("updated");

          /* Select the text field */

          copyText.select();
          copyText.setSelectionRange(0, 99999); /* For mobile devices */

          /* Copy the text inside the text field */
          document.execCommand("copy");

          /* Alert the copied text */
          alert("Copied the text: " + copyText.value);
        }

        
    </script>
</html>