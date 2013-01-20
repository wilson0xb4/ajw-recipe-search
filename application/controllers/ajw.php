<?php

class AJW extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('yummly_model');
    }
    
    public function index() {
        $data['title'] = 'home';
        
        $this->load->view('templates/header', $data);
        $this->load->view('ajw/index');
    }
    
    public function search() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Search';

        $this->form_validation->set_rules('search_phrase', 'search', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('ajw/search');
        } else {
            
            $data['yummly'] = $this->yummly_model->search_recipes();
            $this->load->view('templates/header', $data);
            $this->load->view('ajw/search_results', $data);
        }

    }
    
    public function settings() {
        $data['title'] = 'settings';
        
        $this->load->view('templates/header', $data);
        $this->load->view('ajw/settings');
    }
    
    public function inventory() {
        $data['title'] = 'inventory';
        
        $this->load->view('templates/header', $data);
        $this->load->view('ajw/inventory');
    }
    
    public function display($slug) {
        $data['title'] = 'display';
        
        $data['recipe'] = $this->yummly_model->get_recipe($slug);
        $this->load->view('templates/header', $data);
        $this->load->view('ajw/display', $data);
    }
    

}
