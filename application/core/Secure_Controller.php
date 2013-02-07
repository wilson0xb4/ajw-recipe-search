<?php

class Secure_Controller extends MY_Controller {
    
    protected $the_user;
    protected $data;
    
    function __construct() {
        parent::__construct();
 
        // Require members to be logged in. If not logged in, redirect to the Ion Auth login page.

        if($this->ion_auth->logged_in()) {
            $this->the_user = (array) $this->ion_auth->user()->row();
            $this->data['user'] = $this->the_user;
        }
        else {
            redirect('/');
        }
    }
    
}