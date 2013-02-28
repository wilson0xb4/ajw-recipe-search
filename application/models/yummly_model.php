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
    
    public function search_recipes($q, $start) {
        
        // get settings, create query string
        $settings_string = $this->settings_model->getSettingsString();
        
        $search_phrase = 'recipes?q=' . $q . $settings_string . '&start=' . $start;
        //echo '<br><br>' . $search_phrase;
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($this->ch), true);
        curl_close($this->ch);

        
        
        $decoded_json_data['ingredient_counts'] = $this->get_ingredient_count($decoded_json_data['matches']);
        

        // add query "details" to array before return
        $decoded_json_data['q'] = urldecode($q);
        $decoded_json_data['start'] = $start;
        
        return $decoded_json_data;
        
    }
    
    public function get_ingredient_count($decoded_json) {

        $ingredient_count = array();
        
        foreach ($decoded_json as $recipe) {
            foreach ($recipe['ingredients'] as $ingredient) {
                if ( ! array_key_exists($ingredient, $ingredient_count) ) {
                    // ingredient not found, set initial value
                    $ingredient_count[$ingredient] = 1;
                } else {
                    // ingredient found, increment
                    $ingredient_count[$ingredient]++; 
                }
            }
        }
        
        // sort array by value (maintaining index/key) before return
        arsort($ingredient_count);
        return $ingredient_count;
    }
    
    public function get_recipe($recipe_id) {

        $search_phrase = 'recipe/' . $recipe_id;
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($this->ch), true);
        curl_close($this->ch);
        
        return $decoded_json_data;
        
    }
    
    // fetch a specific table of meta data from Yummly
    private function get_meta_table($table) {
        $meta_url = 'metadata/' . $table;
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $meta_url));
        
        $jsonp_data = curl_exec($this->ch);
        curl_close($this->ch);

        $jsonp_to_json = substr($jsonp_data, (17 + strlen($table)), -2);
        
        $decoded_json_data = json_decode($jsonp_to_json, true);

        return $decoded_json_data;
    }
    
    // display the meta data
    public function display_meta_table($table) {
        $decoded_json_data = $this->get_meta_table($table);
        
        echo '<pre>';
        print_r($decoded_json_data);
        echo '</pre>';
    }
    
    // create a local copy of the meta table
    // primary key prevents duplicates
    public function create_meta_table($table) {
        $decoded_json_data = $this->get_meta_table($table);
                
        foreach ($decoded_json_data as $data) {
            
            $this->db->insert( ('yum_' . $table), $data );
            
        }


         
    }
    
}
/* End of file yummly_model.php */
/* Location: ./application/models/yummly_model.php */
