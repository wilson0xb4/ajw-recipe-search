<?php

class Settings_model extends Yummly_model {
    
    protected $uid;

    public function __construct() {
        
        parent::__construct();

    }
    
    public function initialize($uid = NULL) {
        $this->uid = $uid;
        

        // need to check if user settings were created
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