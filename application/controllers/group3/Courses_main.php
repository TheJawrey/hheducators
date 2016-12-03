<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_main extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('group3/course_model');
        $this->load->model('group1_models/user_model');
    }

    public function courses_dash(){

        // print_r($data['course_info']);

        if($this->session->logged_in){ // if logged in do

            $data['course_info'] = (array)$this->course_model->all_course_info();
            // print_r($data['course_info']);
            foreach($data['course_info'] as &$row){
                $row['category'] = @(array)$this->course_model->get_categories($row['category'])[0];
                // print_r($row['category']);
            }

            $data['user_permission'] = str_split($this->user_model->getPermission($this->session->userID));

            $this->load->view('group1/templates/header');
            $this->load->view('group1/templates/navbar/navbar');
            $this->load->view('group3/course_dash', $data);
            $this->load->view('group1/templates/navbar/navbottom');
            $this->load->view('group1/templates/footer');


		} else { // else redirect to Login_controller

			header('Location: login');

		}
    }


    // show add new category page
    public function add_category_page($error = NULL){
        if($this->session->logged_in){ // if logged in do

            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){

                $data['error'] = $error;

                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group3/add_category', $data);
                $this->load->view('group1/templates/navbar/navbottom');
                $this->load->view('group1/templates/footer');

            } else {
                redirect('courses');
            }

		} else { // else redirect to Login_controller

			header('Location: login');

		}
    }

    //save new category and redirect to courses_dash
    public function submit_category(){
        if($this->session->logged_in){ // if logged in do

            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){
                // print_r($this->input->post("category_name"));

                if($this->course_model->save_category($this->input->post("category_name"))){
                    // after successful save redirect to courses_dash
                   redirect('view_categories');
                } else {
                    $this->add_category_page(TRUE);
                }



            } else {
                redirect('courses');
            }

	} else { // else redirect to Login_controller

		header('Location: login');

	}
    }

    // show add new course page
    public function add_class_page(){


        if($this->session->logged_in){ // if logged in do

            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){


                $data['categories'] = $this->course_model->get_categories();

                // print_r($data['categories']);

                $filter['user_type']['teacher'] = 1;

                $data['teachers'] = $this->user_model->filterUsers($filter);

                // print_r($data['teachers']);
                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group3/add_class', $data);
                $this->load->view('group1/templates/navbar/navbottom');
                $this->load->view('group1/templates/footer');

            } else {
                redirect('courses');
            }

	} else { // else redirect to Login_controller

		header('Location: login');

	}
    }

    public function save_new_class(){
        $this->course_model->insert_new_class($_REQUEST);

        redirect('courses');

    }


    public function course_details(){


        if($this->session->logged_in){ // if logged in do

            $course_id = $this->input->post('course_id');

            $data['course_info'] = (array)$this->course_model->get_one_course($course_id);


            $data['course_info']['category'] = @(array)$this->course_model->get_categories($data['course_info']['category'])[0];


            // print_r($data['course_info']);
            $filter['user_type']['teacher'] = 1;
            $filter['user_id'] = $data['course_info']['teacher'];
            // print_r($filter);
            $data['teachers'] = $this->user_model->filterUsers($filter)[0];

            // print_r($data['teachers']);
            $this->load->view('group1/templates/header');
            $this->load->view('group1/templates/navbar/navbar');
            $this->load->view('group3/course_details', $data);
            $this->load->view('group1/templates/navbar/navbottom');
            $this->load->view('group1/templates/footer');


		} else { // else redirect to Login_controller

			header('Location: login');

		}

    }

    public function course_edit(){

        if($this->session->logged_in){ // if logged in do


            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){

                $course_id = $this->input->post('course_id');

                $data['categories'] = $this->course_model->get_categories();
                $data['course_info'] = (array)$this->course_model->get_one_course($course_id);

                //**************

                $data['cancelled']="";
                if($data['course_info']['cancelled'])
                    $data['cancelled']="checked";

                $data['highschool']="";
                if($data['course_info']['highschool_class'])
                    $data['highschool']="checked";

                //*********************

                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group3/course_edit', $data);
                $this->load->view('group1/templates/navbar/navbottom');
                $this->load->view('group1/templates/footer');

            } else {
                redirect('courses');
            }

		} else { // else redirect to Login_controller

			header('Location: login');

		}
    }


    public function course_delete()
    {
        if($this->session->logged_in)
        {
            if(str_split($this->user_model->getPermission($this->session->userID))[0])
            {
                $id = $this->input->post("course_id");

                //Delete Course From Courses
                $this->db->where('id', $id);
                $this->db->delete('courses');

                redirect("courses");
            }else {
                redirect("courses");
            }
        }else {
            header('Location: login');
        }


    }

    public function view_categories(){

        if($this->session->logged_in){ // if logged in do

            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){

                $data['categories'] = $this->course_model->get_categories();

                // print_r($data['categories']);

                $this->load->view('group1/templates/header');
                $this->load->view('group1/templates/navbar/navbar');
                $this->load->view('group3/view_categories', $data);
                $this->load->view('group1/templates/navbar/navbottom');
                $this->load->view('group1/templates/footer');


            } else {
                redirect('courses');
            }

	} else { // else redirect to Login_controller

		header('Location: login');

	}
    }

    
    public function course_update(){
        if($this->session->logged_in){ // if logged in do

            // check permission
            if(str_split($this->user_model->getPermission($this->session->userID))[0]){

                // print_r($this->input->post());

                $this->course_model->update_course($this->input->post());
                
                redirect('courses');
                
            } else {
                redirect('courses');
            }

	} else { // else redirect to Login_controller

		header('Location: login');

	}
    }


    public function delete_category(){
        // get CID
        $CID = $this->input->post('CID');

        // delete from database
        $this->course_model->remove_category($CID);

        // redirect to view_categories
        redirect('view_categories');
    }

}


