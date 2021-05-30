<?php
namespace App\Http\Controllers;


use App\Helpers\RAWGHelper;
use App\Models\ApiModel;

class ApiController{

    public function __construct(){
        $this->rawg = new RAWGHelper();
    }
    /**
     * Honestly no need to store the games in the db instead i'm reflecting rawg and serving it as my own
     * @param $key
     */
    public function games($key){
        //header('Content-type: application/json');
        $token = (new ApiModel())->get_key_details($key);


        if($token){
            if ($token->api_limit >= 1){
                $games = json_decode($this->rawg->games(), TRUE);
                $games = $games['results'];


                (new ApiModel())->decrement_limit($key, $token->api_limit - 1);
                echo json_encode(['status' => true, 'games' => $games], JSON_PRETTY_PRINT);
            }else{
                echo json_encode(['status' => false, 'message' => 'Api usage limit reached']);
            }
        }else{
            echo json_encode(['status' => false, 'message' => 'Hi it appears you have used an incorrect api key']);
        }
    }
}