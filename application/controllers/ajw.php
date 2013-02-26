<?php

class AJW extends Secure_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('yummly_model');
        $this->load->model('settings_model');
        $this->settings_model->initialize($this->data['user']['id']);
        
        // make settings available to views
        $this->data['settings'] = $this->settings_model->getSettingsArray();
        
        foreach ($this->settings_model->getOptionsArray() as $key => $value) {
            $this->data['settings'][$key] = $value;
        }
        
        
    }
    
    public function index() {
        redirect('/');       
    }
    
   public function search($q = NULL, $start = 0) {
        $this->data['title'] = 'Search';
        
        $this->form_validation->set_rules('search_phrase', 'search', 'trim|required|xss_clean|urlencode');

            if ($this->form_validation->run() === FALSE) {
            
                $this->load->view('header_template', $this->data);
                $this->load->view('nav_template');
                $this->load->view('search_view');
                $this->load->view('footer_template');
            
            } else {
                $q = $this->input->post('search_phrase');
                $this->data['yummly'] = $this->yummly_model->search_recipes($q, $start);
            
                $this->load->view('header_template', $this->data);
                $this->load->view('nav_template');
                $this->load->view('search_results_view', $this->data);
                $this->load->view('sidebar_view');
                $this->load->view('footer_template');
            }
        
    }
    
    public function settings() {
        $this->data['title'] = 'settings';
        
        $this->form_validation->set_rules('maxResults', 'max results', 'trim|required|xss_clean');

        if ($this->form_validation->run() === FALSE) {
            
            $this->load->view('header_template', $this->data);
            $this->load->view('nav_template');
            $this->load->view('settings_view', $this->data);
            $this->load->view('footer_template');
            
        } else {
            
            $this->settings_model->updateSettings();
            
            // add style
            $this->session->set_flashdata('infomessage', 'settings were updated! (add style)<br><br><br>');
            redirect('ajw/settings');
            
        }
        
    }
    
    public function display($recipe_id) {
        $this->data['title'] = 'display';
        
        $this->data['recipe'] = $this->yummly_model->get_recipe($recipe_id);
        $this->load->view('header_template', $this->data);
        $this->load->view('nav_template');
        $this->load->view('display_view', $this->data);
        $this->load->view('footer_template');
    }
    
    public function meta($table, $action = 'display') {
        if ($action === 'create') {
            $this->yummly_model->create_meta_table($table);
        } else {// ($action === 'display') {
            $this->yummly_model->display_meta_table($table);
        } 
        
    }
    

}
/* End of file ajw.php */
/* Location: ./application/controllers/ajw.php */
