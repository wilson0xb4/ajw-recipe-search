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
        $options['diet'] = $this->getOptions('diet');
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
        $query = $this->db->query("SELECT maxResults, requirePictures FROM ajw_settings WHERE uid=$this->uid");
        $settingsArray = $query->result_array()[0];
        
        // excluded ingredients
        $excludedIngredients = $this->db->query("SELECT ingredient FROM ajw_excluded_ingredients WHERE uid=$this->uid");
        foreach ($excludedIngredients->result_array() as $row) {
            $settingsArray['exclusions'][] = $row['ingredient'];
        }
        
        // diets
        $query2 = $this->db->query("SELECT did FROM ajw_user_diets WHERE uid=$this->uid");
        $settingsArray['diets'] = $query2->result_array();
        
        //print_r($settingsArray);
        return $settingsArray;
        
    }
    
    public function getSettingsString() {
        $settings = $this->getSettingsArray();
        $query_string = '';
        
        if ($settings['requirePictures']) {
            $query_string .= '&requirePictures=true';
        }
        
        $query_string .= '&maxResult='. $settings['maxResults'];
        
        if (isset($settings['exclusions'])) {
            foreach ($settings['exclusions'] as $excludedIngredient) {
                $query_string .= '&excludedIngredient[]=' . $excludedIngredient;
            }
        }
        
        
        echo $query_string;
        return $query_string;
        
    }
    
    public function updateSettings() {
        $maxResults = $this->input->post('maxResults');
        
        if ($this->input->post('requirePictures') == 'accept') {
            $requirePictures = 1;
        } else {
            $requirePictures = 0;
        }
        
        $this->db->query("UPDATE ajw_settings SET maxResults=$maxResults, requirePictures=$requirePictures WHERE uid=$this->uid");
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