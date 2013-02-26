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
        $query = $this->db->query("SELECT maxResults, requirePictures FROM settings WHERE uid=$this->uid");
        return $query->result_array()[0];
    }
    
    public function getSettingsString() {
        $settings = $this->getSettingsArray();
        $query_string = '';
        
        if ($settings['requirePictures']) {
            $query_string .= '&requirePictures=true';
        }
        
        $query_string .= '&maxResult='. $settings['maxResults'];
        
        return $query_string;
        
    }
    
    public function updateSettings() {
        $maxResults = $this->input->post('maxResults');
        
        if ($this->input->post('requirePictures') == 'accept') {
            $requirePictures = 1;
        } else {
            $requirePictures = 0;
        }
        
        $this->db->query("UPDATE settings SET maxResults=$maxResults, requirePictures=$requirePictures WHERE uid=$this->uid");
    }
}
/* End of file settings_model.php */
/* Location: ./application/models/settings_model.php */