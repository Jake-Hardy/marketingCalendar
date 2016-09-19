<?php
class Database {

    private static $dsn  = 'mysql:host=localhost;dbname=marketing-calendar;charset=utf8';
    private static $user = 'root';
    private static $pass = '';
    private static $db;

    // private static $dsn = 'mysql:host=localhost:/tmp/mysql5.sock;dbname=db647776644;charset=utf8';
    // private static $user = 'dbo647776644';
    // private static $pass = '*removed*';

    function __construct(){}

    public static function connect() {
        if(!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$user, self::$pass);
                self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //$error_message = $e->getMessage();
                //print_r($error_message);
                exit();
            }
        }
        return self::$db;
    }
}
?>
