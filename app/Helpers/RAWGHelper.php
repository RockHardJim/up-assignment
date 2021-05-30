<?php
namespace App\Helpers;

/**
 * Class RAWGHelper be a lazy kalakune instead of hardcoding games i am using RAWG to get list of games and present them as if they are stored inside the site db
 * @package App\Helpers
 */
class RAWGHelper{

    /**
     * Returns a list of 20 games from RAWG
     * @return bool|string
     */
    public function games(){
        return $this->get('https://api.rawg.io/api/games?key='.RAWG_KEY);
    }


    private function get($url){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}