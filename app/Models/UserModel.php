<?php
namespace App\Models;
use App\Kernel\Database;
use App\Kernel\Request;
use App\kernel\Session;
use Exception;

/**
 * Class UserModel
 * @package App\Models
 */
class UserModel{


    public function email_exists($email): bool
    {
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $query->execute(array(':email' => $email));
        if ($query->rowCount() == 0) {
            return false;
        }
        return true;
    }

    public function register_account(string $name, string $surname, string $email, string $password): bool
    {
        $database = Database::getFactory()->getConnection();

        // write new users data into database
        $sql = "INSERT INTO users (name, surname, email, password)
                    VALUES (:name, :surname, :email, :password)";
        $query = $database->prepare($sql);
        $query->execute(array(':name' => $name,
            ':surname' => $surname,
            ':email' => $email,
            ':password' => $password));
        $count =  $query->rowCount();
        if ($count == 1) {
            if((new ApiModel())->user($email)){
                return true;
            }else{
                //honestly this key generation sequence seems fine using random_bytes, email and server microtime to generate a secure key
                $key = md5(base64_encode(microtime() . random_bytes(55) . $email));
                (new ApiModel())->create($email, $key);
            }
        }



        return false;
    }
}