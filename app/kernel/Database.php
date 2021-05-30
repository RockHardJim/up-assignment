<?php
namespace App\Kernel;
use PDO;
use PDOException;

class Database{

    private static $factory;
    private $database;

    public static function getFactory()
    {
        if (!self::$factory) {
            self::$factory = new Database();
        }
        return self::$factory;
    }

    public function getConnection() {
        if (!$this->database) {
            try {
                $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
                $this->database = new PDO(
                    DB_TYPE . ':host=' . DB_HOST . ';dbname=' .
                    DB_NAME . ';port=' . DB_PORT . ';charset=' . DB_CHARSET,
                    DB_USER, DB_PASS, $options
                );
            } catch (PDOException $e) {

                // Echo custom message. Echo error code gives you some info.
                echo 'Database connection can not be estabilished. Please try again later.' . '<br>';
                echo 'Error code: ' . $e->getCode();

                // Stop application :(
                // No connection, reached limit connections etc. so no point to keep it running
                exit;
            }
        }
        return $this->database;
    }
}