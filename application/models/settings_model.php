<?php

class Settings_model extends Yummly_model {
    
    protected $uid;

    public function __construct() {
        
        parent::__construct();

    }
    
    public function initialize($uid = NULL) {
        $this->uid = $uid;
        

        // need to check if user settings were created (for brand new users)
    }
    
    public function getOptionsArray() {
        $this->db->order_by("id");
        $options['diet'] = $this->getOptions('diet');
        $this->db->order_by("id");
        $options['allergy'] = $this->getOptions('allergy');
        $options['cuisine'] = $this->getOptions('cuisine');
        $options['holiday'] = $this->getOptions('holiday');
        $options['course'] = $this->getOptions('course');
        
        $this->db->order_by("useCount", "desc"); 
        $options['ingredient'] = $this->getOptions('ingredient');
        
        return $options;
    }
    
    private function getOptions($table) {
        
        $query = $this->db->get('yum_' . $table);

        $options = array();
        foreach ($query->result_array() as $row) {
           $options[] = $row;
        }
        
        return $options;
    }
    
    public function getSettingsArray() {
        // general settings: maxResults and requirePictures
        $query = $this->db->query("SELECT * FROM ajw_settings WHERE uid=$this->uid");
        $settingsArray = $query->result_array()[0];
        
        // excluded ingredients
        $excludedIngredients = $this->db->query("SELECT ingredient FROM ajw_excluded_ingredients WHERE uid=$this->uid");
        foreach ($excludedIngredients->result_array() as $row) {
            $settingsArray['exclusions'][] = $row['ingredient'];
        }
        
        //print_r($settingsArray);
        return $settingsArray;
        
    }
    
    public function getSettingsString() {
        $settings = $this->getSettingsArray();
        $query_string = '';
        
        // require pictures
        if ($settings['requirePictures']) {
            $query_string .= '&requirePictures=true';
        }
        
        // max results
        $query_string .= '&maxResult='. $settings['maxResults'];
        
        // exclude ingredients
        if (isset($settings['exclusions'])) {
            foreach ($settings['exclusions'] as $excludedIngredient) {
                $query_string .= '&excludedIngredient[]=' . $excludedIngredient;
            }
        }
        
        // remap keys as diet id
        $dietOptions = array();
        foreach ($this->getOptions('diet') as $diet) {
            $id = $diet['id'];
            $dietOptions[$id] = $diet;
        }

        // allowed diets
        foreach (array_slice($settings, 3, 5) as $key => $value) {
            if ($value) {
                $key_substr = substr($key, 5);
                
                $query_string .= '&allowedDiet[]=' . urlencode($dietOptions[$key_substr]['searchValue']);
            }
        }
        
        // remap keys as allergy id
        $allergyOptions = array();
        foreach ($this->getOptions('allergy') as $allergy) {
            $id = $allergy['id'];
            $allergyOptions[$id] = $allergy;
        }

        // allowed allergies
        foreach (array_slice($settings, 8, 10) as $key => $value) {
            if ($value) {
                $key_substr = substr($key, 8);
                
                $query_string .= '&allowedAllergy[]=' . urlencode($allergyOptions[$key_substr]['searchValue']);
            }
        }
        
        $query_string .= $this->get_filters_string();
        
        //echo $query_string;
        return $query_string;
        
    }
    
    public function get_checked_filters() {
        $checked_filters = array();
        $filter_array = $this->input->post();
        
        // if statement to make php errors go away...
        // real problem needs to be addressed
        // filters aren't re-posted when using include/exclude ingredient links
        if (is_array($filter_array)) {
            $filter_array = array_splice($filter_array, 1);
        
            foreach ($filter_array as $key => $value) {
                if ($value === 'accept') {
                    $checked_filters[$key] = TRUE;
                }
            }
        }
        
        return $checked_filters;
    }
    
    private function get_filters_string() {
        
        $filter_array = $this->input->post();
        $filter_string = '';
        
        // if statement to make php errors go away...
        // real problem needs to be addressed
        // filters aren't re-posted when using include/exclude ingredient links
        if (is_array($filter_array)) {
            $filter_array = array_splice($filter_array, 1);
        
            foreach ($filter_array as $key => $value) {
                if ($value === 'accept') {
                    $filter_string .= $filter_array[$key . '-val'];
                }
            }
        }

        return $filter_string;
    }
    
    public function updateSettings() {
        $oldSettings = $this->getSettingsArray();
        $updateQuery = 'maxResults=' . $this->input->post('maxResults');
        
        foreach (array_slice($oldSettings, 1) as $key => $value) {
            if (! ($key === 'maxResults' || $key === 'exclusions') ) {
                if ( array_key_exists($key, $this->input->post()) ) {
                    $updateQuery .= ', ' . $key . '=' . $this->input->post($key);
                } else {
                    $updateQuery .= ', ' . $key . '=0';
                }
            }
        }
        
        $updateQuery = str_replace('accept', 1, $updateQuery);

        $this->db->query("UPDATE ajw_settings SET $updateQuery WHERE uid=$this->uid");
    }
    
    public function excludeIngredient($ingredient) {
        $this->db->set('uid', $this->uid);
        $this->db->set('ingredient', $ingredient);
        $this->db->insert('ajw_excluded_ingredients'); 
    }
    
    public function includeIngredient($ingredient) {
        $this->db->where('uid', $this->uid);
        $this->db->where('ingredient', $ingredient);
        $this->db->delete('ajw_excluded_ingredients'); 
    }
}
/* End of file settings_model.php */
/* Location: ./application/models/settings_model.php */