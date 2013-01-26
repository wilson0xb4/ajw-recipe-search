<?php

class Yummly_model extends CI_Model {

    private $APP_ID = 'b35c29b8';
    private $APP_KEY = '0bc74fba14edec1fedd54cad955961ac';
    private $BASE_URL = 'http://api.yummly.com/v1/api/';
    
    private $ch;
    
    public function __construct() {
        
        parent::__construct();
        
        // initialize cURL session
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_MAXREDIRS, 20);
        curl_setopt($this->ch, CURLOPT_ENCODING, "gzip");
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            'X-Yummly-App-ID:'.$this->APP_ID,
            'X-Yummly-App-Key:'.$this->APP_KEY));
        
    }
    
    public function search_recipes() {

        $submitted_query = $this->input->post('search_phrase');
        $search_phrase = 'recipes?q=' . $submitted_query . '&maxResult=10';
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($this->ch), true);
        curl_close($this->ch);
        
        $decoded_json_data['submitted_query'] = urldecode($submitted_query);
        return $decoded_json_data;
        
    }
    
    public function get_recipe($recipe_id) {

        $search_phrase = 'recipe/' . $recipe_id;
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($this->ch), true);
        curl_close($this->ch);
        
        return $decoded_json_data;
        
    }
    
}
/* End of file yummly_model.php */
/* Location: ./application/models/yummly_model.php */
