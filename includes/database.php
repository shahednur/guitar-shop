<?php 
class Database{
    private static $dsn ='mysql:host=localhost;dbname=guiter_shop';
    private static $username = 'root';
    private static $password = '1234';
    private static $db;
    
    private static __construct(){}
    public static function getDB(){
        if(!isset(self::$db)){
            try{
                self::$db = new PDO(self::$dsn,self::$username,self::$password);
            }catch(PDOException $e){
                $error_message = $e->getMessage();
                //include('../errors/database_error.php');
                exit();
            }
        }
        return self::$db;
    }
}
?>