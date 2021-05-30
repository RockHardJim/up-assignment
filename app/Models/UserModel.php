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


    /**
     * checks if a user provided email exists in the database
     * @param $email
     * @return bool
     */
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

    /**
     * Creates user preferences
     * @param string $email
     * @return bool
     */
    public function create_user_preferences(string $email){
        $database = Database::getFactory()->getConnection();

        // write new users data into database
        $sql = "INSERT INTO user_preferences (user, privacy, theme)
                    VALUES (:user, :privacy, :theme)";
        $query = $database->prepare($sql);
        $query->execute(array(':user' => $email,
            ':privacy' => 'N',
            ':theme' => 'Dark'));
        $count =  $query->rowCount();
        if ($count == 1) {
                return true;
        }
        return false;
    }

    public function get_user($email){
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("SELECT id, email, name, surname, password FROM users WHERE email = :email LIMIT 1");
        $query->execute(array(':email' => $email));
        if ($query->rowCount() > 0) {
            return $query->fetch();
        }
        return false;
    }

    /**
     * saves user information into the database
     * @param string $name
     * @param string $surname
     * @param string $email
     * @param string $password
     * @return bool
     * @throws Exception
     */
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
            //checks if a user has an api key created for them.
            if((new ApiModel())->user($email)){
                return true;
            }else{
                //honestly this key generation sequence seems fine using random_bytes, email and server microtime to generate a secure key
                $key = md5(base64_encode(microtime() . random_bytes(55) . $email));
                //creates new api key for new user account
                (new ApiModel())->create($email, $key);
                $this->create_user_preferences($email);
            }
        }
        return false;
    }
}