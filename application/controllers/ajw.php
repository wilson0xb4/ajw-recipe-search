<?php

class AJW extends Secure_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('yummly_model');
    }
    
    public function index() {
        $data['title'] = 'login';
        
        if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		} else {
            redirect('search');
        }
        
    }
    
   public function search() {

        $data['title'] = 'Search';

        $this->form_validation->set_rules('search_phrase', 'search', 'trim|required|xss_clean|urlencode');

        if ($this->form_validation->run() === FALSE) {
            print_r($data);
            $this->load->view('header_template', $data);
            $this->load->view('nav_template');
            $this->load->view('search_view');
            $this->load->view('footer_template');
            
        } else {
            
            $data['yummly'] = $this->yummly_model->search_recipes();
            $this->load->view('header_template', $data);
            $this->load->view('nav_template');
            $this->load->view('search_results_view', $data);
            $this->load->view('sidebar_view');
            $this->load->view('footer_template');
            
            
        }
        

    }
    
    public function settings() {
        $data['title'] = 'settings';
        
        $this->load->view('header_template', $data);
        $this->load->view('nav_template');
        $this->load->view('settings_view');
        $this->load->view('footer_template');
    }
    
    public function inventory() {
        $data['title'] = 'inventory';
        
        $this->load->view('header_template', $data);
        $this->load->view('nav_template');
        $this->load->view('inventory_view');
        $this->load->view('footer_template');
    }
    
    public function display($recipe_id) {
        $data['title'] = 'display';
        
        $data['recipe'] = $this->yummly_model->get_recipe($recipe_id);
        $this->load->view('header_template', $data);
        $this->load->view('nav_template');
        $this->load->view('display_view', $data);
        $this->load->view('footer_template');
    }
    

}
/* End of file ajw.php */
/* Location: ./application/controllers/ajw.php */
