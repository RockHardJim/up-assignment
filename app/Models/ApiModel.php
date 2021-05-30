<?php
namespace App\Models;
use App\Kernel\Database;


class ApiModel{


    /**
     * Checks if a user api key already exists
     * @param string $email
     * @return bool
     */
    public function user(string $email): bool
    {
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("SELECT id FROM api_keys WHERE user = :user LIMIT 1");
        $query->execute(array(':user' => $email));
        if ($query->rowCount() === 0) {
            return false;
        }
        return true;
    }

    /**
     * Creates new user api key on user account registration
     * @param $email
     * @param $key
     * @return bool
     */
    public function create($email,$key): bool
    {
        $database = Database::getFactory()->getConnection();
        $sql = "INSERT INTO api_keys (token, user) VALUES (:token, :user)";
        $query = $database->prepare($sql);
        $query->execute(array(
            ':token' => $key,
            ':user' => $email
            ));
        $count =  $query->rowCount();
        if ($count === 1) {
            return true;
        }
        else{
            return false;
        }
    }

    public function get_user_key($email){
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("SELECT id, token, api_limit, user FROM api_keys WHERE user = :user LIMIT 1");
        $query->execute(array(':user' => $email));
        if ($query->rowCount() > 0) {
            return $query->fetch();
        }
        return false;
    }

    public function get_key_details($key){
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("SELECT * FROM api_keys WHERE token = :token LIMIT 1");
        $query->execute(array(':token' => $key));
        if ($query->rowCount() > 0) {
            return $query->fetch();
        }
        return false;
    }

    public function decrement_limit($key, $limit){
        $database = Database::getFactory()->getConnection();

        $query = $database->prepare("UPDATE api_keys SET api_limit = :api_limit WHERE token = :token LIMIT 1");
        $query->execute(array(':api_limit' => $limit, ':token' => $key));
        $count = $query->rowCount();
        if ($count == 1) {
            return true;
        }
        return false;
    }
}