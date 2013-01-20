<?php

class Yummly_model extends CI_Model {

    
    function __construct() {
        parent::__construct();
        

    }
    
    public function search_recipes() {

        $APP_ID = 'b35c29b8';
        $APP_KEY = '0bc74fba14edec1fedd54cad955961ac';
        
        // initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Yummly-App-ID:'.$APP_ID,
            'X-Yummly-App-Key:'.$APP_KEY));
        
        $BASE_URL = 'http://api.yummly.com/v1/api/';
        $search_phrase = 'recipes?q=' . urlencode($this->input->post('search_phrase')) . '&maxResult=10';
        
        curl_setopt($ch, CURLOPT_URL, ($BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        
        return $decoded_json_data;
        
        
    }
    
    public function get_recipe($recipe_id) {
        
        $APP_ID = 'b35c29b8';
        $APP_KEY = '0bc74fba14edec1fedd54cad955961ac';
        
        // initialize cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Yummly-App-ID:'.$APP_ID,
            'X-Yummly-App-Key:'.$APP_KEY));
        
        $BASE_URL = 'http://api.yummly.com/v1/api/';
        $search_phrase = 'recipe/' . $recipe_id;
        
        curl_setopt($ch, CURLOPT_URL, ($BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        
        return $decoded_json_data;
        
    }
    
}
