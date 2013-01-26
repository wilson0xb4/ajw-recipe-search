<?php

class AJW extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('yummly_model');
    }
    
    public function index() {
        $data['title'] = 'home';
        
        $this->load->view('header_template', $data);
        $this->load->view('index_view');
    }
    
    public function search() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Search';

        $this->form_validation->set_rules('search_phrase', 'search', 'trim|required|xss_clean|urlencode');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('header_template', $data);
            $this->load->view('search_view');
        } else {
            
            $data['yummly'] = $this->yummly_model->search_recipes();
            $this->load->view('header_template', $data);
            $this->load->view('search_results_view', $data);
        }

    }
    
    public function settings() {
        $data['title'] = 'settings';
        
        $this->load->view('header_template', $data);
        $this->load->view('settings_view');
    }
    
    public function inventory() {
        $data['title'] = 'inventory';
        
        $this->load->view('header_template', $data);
        $this->load->view('inventory_view');
    }
    
    public function display($recipe_id) {
        $data['title'] = 'display';
        
        $data['recipe'] = $this->yummly_model->get_recipe($recipe_id);
        $this->load->view('header_template', $data);
        $this->load->view('display_view', $data);
    }
    

}
/* End of file ajw.php */
/* Location: ./application/controllers/ajw.php */
