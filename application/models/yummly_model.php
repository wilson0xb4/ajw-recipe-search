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
        // yummly also returns this data under criteria
        $decoded_json_data['q'] = urldecode($q);
        $decoded_json_data['start'] = $start;
        
        $cleaned_search_data = $this->clean_search_data($decoded_json_data);
        
        //echo '<pre>'; print_r($cleaned_search_data); echo '</pre>';
        
        return $cleaned_search_data;
        
    }
    
    // check and eliminate situations where an empty variable/array is accessed
    // not generalized, only checks known problem cases
    private function clean_search_data($decoded_json) {
        
        // remove facetCounts
        unset($decoded_json['facetCounts'], $decoded_json['criteria']['facetFields']);
        
        foreach ($decoded_json['matches'] as &$recipe) {
            
            // load filler image when no image is provided
            if ( ! empty($recipe['smallImageUrls']) ) {
                // grab first image and use it (later: deal with showing all images)
                $recipe['smallImageUrls'] = $recipe['smallImageUrls'][0];
            } else {
                // replace with filler image
                $recipe['smallImageUrls'] = base_url() . 'images/130x180.gif';
            }
            
            // attributes/tags (needs work)
            // this can be moved to its own function, its used twice!
            if (isset($recipe['attributes'])) {
                $recipe['tags'] = array();
                
                if (isset($recipe['attributes']['course'])) {
                    $recipe['tags']['course'] = '';
                    foreach ($recipe['attributes']['course'] as $course) {
                        $recipe['tags']['course'] .= '<a href="#">' . $course . '</a> ';
                    }
                }

                if (isset($recipe['attributes']['holiday'])) {
                    $recipe['tags']['holiday'] = '';
                    foreach ($recipe['attributes']['holiday'] as $holiday) {
                        $recipe['tags']['holiday'] .= '<a href="#">' . $holiday . '</a> ';
                    }
                }
                
                if (isset($recipe['attributes']['cuisine'])) {
                    $recipe['tags']['cuisine'] = '';
                    foreach ($recipe['attributes']['cuisine'] as $cuisine) {
                        $recipe['tags']['cuisine'] .= '<a href="#">' . $cuisine . '</a> ';
                    }
                }
                
                if (! empty($recipe['tags'])) {
                    $recipe['tagsToString'] = 'Tags: ';
                    foreach ($recipe['tags'] as $tagCategory => $tags) {
                        $recipe['tagsToString'] .= $tags;
                    }
                } else {
                    $recipe['tagsToString'] = '';
                }
                
            } // end attributes/tags
            
            // rating
            if ($recipe['rating'] === 0) {
                $recipe['rating'] = '';
            } else {
                $recipe['rating'] = 'Rating: ' . $recipe['rating'];
            }
            
            // remove flavor data in every match
            unset($recipe['flavors']);
            
        }
        
        return $decoded_json;
    }
    
    // future attributs / tags list
    private function get_tag_list() {
        
    }
    
    // count, sort, and return the list of ingredients included in the current search
    private function get_ingredient_count($decoded_json) {

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
    
    // grab a recipe from yummly
    public function get_recipe($recipe_id) {

        $search_phrase = 'recipe/' . $recipe_id;
        
        curl_setopt($this->ch, CURLOPT_URL, ($this->BASE_URL . $search_phrase));
        
        // decoded json data
        $decoded_json_data = json_decode(curl_exec($this->ch), true);
        curl_close($this->ch);
        
        //echo '<pre>'; print_r($decoded_json_data); echo '</pre>';
        $cleaned_recipe_data = $this->clean_recipe_data($decoded_json_data);
        
        //echo '<pre>'; print_r($cleaned_recipe_data); echo '</pre>';
        
        return $cleaned_recipe_data;
        
    }
    
    // check and eliminate situations where an empty variable/array is accessed
    // not generalized, only checks known problem cases
    private function clean_recipe_data($decoded_json) {
        
        unset($decoded_json['flavors'], $decoded_json['nutritionEstimates']);
        
        // if no image is provided, show nothing
        if ( ! empty($decoded_json['images'][0]) ) {
            
            // grab first image and use it (later: deal with showing all images)
            $decoded_json['images'] = '<img src="' . $decoded_json['images'][0]['hostedLargeUrl'] . '" />';
        } else {
            // replace with filler image
            $decoded_json['images'] = NULL; //base_url() . 'images/130x180.gif';
        }
        
        // yeild
        if (isset($decoded_json['yield'])) {
            $decoded_json['yield'] = 'Yield: ' . $decoded_json['yield'];
        } else {
            $decoded_json['yield'] = NULL;
        }
        
        // total time
        if (isset($decoded_json['totalTime'])) {
            $decoded_json['totalTime'] = 'Total Time: ' . $decoded_json['totalTime'];
            
            // add comma if yield is also set
            if (isset($decoded_json['yield'])) {
                $decoded_json['totalTime'] = ', ' . $decoded_json['totalTime'];
            }
            
        } else {
            $decoded_json['totalTime'] = NULL;
        }
        
        // rating
        if (isset($decoded_json['rating'])) {
            $decoded_json['rating'] = 'Rating: ' . $decoded_json['rating'];
        } else {
            $decoded_json['rating'] = NULL;
        }
        
        // attributes/tags (needs work)
        // this can be moved to its own function, its used twice!
        if (isset($decoded_json['attributes'])) {
            $decoded_json['tags'] = array();

            if (isset($decoded_json['attributes']['course'])) {
                $decoded_json['tags']['course'] = '';
                foreach ($decoded_json['attributes']['course'] as $course) {
                    $decoded_json['tags']['course'] .= '<a href="#">' . $course . '</a> ';
                }
            }

            if (isset($decoded_json['attributes']['holiday'])) {
                $decoded_json['tags']['holiday'] = '';
                foreach ($decoded_json['attributes']['holiday'] as $holiday) {
                    $decoded_json['tags']['holiday'] .= '<a href="#">' . $holiday . '</a> ';
                }
            }

            if (isset($decoded_json['attributes']['cuisine'])) {
                $decoded_json['tags']['cuisine'] = '';
                foreach ($decoded_json['attributes']['cuisine'] as $cuisine) {
                    $decoded_json['tags']['cuisine'] .= '<a href="#">' . $cuisine . '</a> ';
                }
            }

            if (! empty($decoded_json['tags'])) {
                $decoded_json['tagsToString'] = 'Tags: ';
                foreach ($decoded_json['tags'] as $tagCategory => $tags) {
                    $decoded_json['tagsToString'] .= $tags;
                }
            } else {
                $decoded_json['tagsToString'] = '';
            }

        } // end attributes/tags
        
        return $decoded_json;
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
