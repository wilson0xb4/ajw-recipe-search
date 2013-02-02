<?php

class Secure_Controller extends MY_Controller {
    
    function __construct() {
        parent::__construct();
 
        // Require members to be logged in. If not logged in, redirect to the Ion Auth login page.
        if( ! $this->ion_auth->logged_in()) {
            $this->the_user = $this->ion_auth->user()->row();
            $data->the_user = $this->the_user;
            $this->load->vars($data);
            redirect('auth/login');
        }
    }
    
}