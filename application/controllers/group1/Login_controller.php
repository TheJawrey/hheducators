<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

    public function __construct(){
        parent::__construct(); 
    }


    public function index($error = false) {
        
        $data['errorMessage'] = $error;
        
        if($this->session->logged_in){
            header('Location: '.base_url());
        } else {
            $this->load->view('group1/templates/header');
            $this->load->view('group1/login', $data);
            $this->load->view('group1/templates/footer');
        }
    }


    public function validateCredentials() {

        $this->load->model('group1_models/user_model');
        $query = $this->user_model->validate(intval($this->input->post('userID')), md5($this->input->post('password')));

        if($query){

            $this->session->userID = $this->input->post('userID');
            $this->session->logged_in = true;
            
            header('Location: '.base_url());

        } else {
            $this->index(true);
        }
    }
}