<?php
class ShortenUrl
{
    private $pdo;
    private static $table = "shorten_url";
    private static $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    
    public function __construct(PDO $pdo){
        $this->pdo=$pdo;

    }

    /**
     * Takes url, check if it already exist, returns the shorten id
     */
    public function urlShorten($url){
        if(empty($url)){
            throw new Exception("URL is empty");
        }

        $short=$this->checkifUrlAlreadyExist($url);
        if($short==false){
            $short=$this->createShortUrl($url);
        }
        return $short;
        
    }
    /**
     * returns the original url
     */
    public function redirect($short){
        if(empty($short)) {
            throw new Exception("Input is empty");
        }
        $url=$this->getUrlFromDB($short);
        if(empty($url)){
            throw new Exception("URL does not exist in DB");
        }
        return $url["long_url"];
        

    }

    /**
     * Creating the Shorten Url
     */
    public function createShortUrl($url){
        $randomId=$this->generateRandomID();
        $this->insertUrlIntoDb($url,$randomId);
        return $randomId;


    }
    /**
     * Generates random string for a url
     */
    public static function generateRandomID($length=7){
        
        $charactersLength = strlen(self::$characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= self::$characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    /**
     * Database functions
     */
    public function checkifUrlAlreadyExist($url){
        $query = "SELECT short_code FROM ".self::$table." WHERE long_url = :long_url LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $params = array(
            "long_url" => $url
        );
        $stmt->execute($params);

        $result = $stmt->fetch();
        return (empty($result)) ? false : $result["short_code"];
    }

    public function getUrlFromDB($short){
        $query = "SELECT id, long_url FROM ".self::$table." WHERE short_code = :short_code LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $params=array(
            "short_code" => $short
        );
        $stmt->execute($params);

        $result = $stmt->fetch();
        return (empty($result)) ? false : $result;

    }
    public function insertUrlIntoDb($url,$short){

        $query = "INSERT INTO ".self::$table." (long_url, short_code) VALUES (:long_url, :short_code)";
        $stmnt = $this->pdo->prepare($query);
        $params = array(
            "long_url" => $url,
            "short_code" => $short
        );
        $stmnt->execute($params);

        return $this->pdo->lastInsertId();
    }
}
?>