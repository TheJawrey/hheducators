<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse_courses extends CI_Controller {


  public function index() {




  }

  public function get_course_details() {

    if ($this->session->logged_in) { // if logged in show user profile

        $user_id =  $this->input->post('course_id');

        // Load Teacher Classes Model
        $this->load->model('group1_models/teacher_classes_model');

        // Get the array of current Course IDs being taught from course table
        $data['course_info'] = $this->teacher_classes_model->get_course_details($user_id);
        //print_r($data);
        
        $this->load->view('group1/browse/course_details', $data);



    } else { // else redirect to Login_controller

        header('Location: login');

    }

  }




}
