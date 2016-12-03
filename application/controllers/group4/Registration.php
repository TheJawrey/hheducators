<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Registration extends CI_Controller {
	
	public $current_id;
	public $user;
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'group4/Registration_model' ); // I can now access the Registration_model class ($this->Registration_model)
		
		$this->user = $this->Registration_model->get_user();
		$this->current_id = $this->user->id;
	}
	
	public function select() {
		$semester_id = $this->input->post('semester_control');
		if ($semester_id) {
			$this->session->set_userdata(array('semester_id'  => $semester_id));
		} else {
			$semester_id = $this->session->semester_id;
		}
		
		$query = $this->Registration_model->get_semesters()->result_array();
		
		$data = $this->Registration_model->get_data($this->current_id, $semester_id);
		$data['semester'] = &$query;
		$data['is_editing'] = true;
		$data['current_semester'] = $this->Registration_model->get_current();
		
		$this->load->view('group1/templates/header');
		$this->load->view('group1/templates/navbar/navbar');
		$this->load->view('group4/registration/view', $data);
		$this->load->view('group1/templates/navbar/navbottom');
		$this->load->view('group1/templates/footer');
	}
	
	public function add_class() {
		$user_id = $this->input->post('add_user');
		$course_id = $this->input->post('add_course');
		$semester_id = $this->input->post('add_semester');
		$this->Registration_model->add($user_id, $course_id, $semester_id);
		redirect('select_registration');
	}
	
	public function remove_class() {
		$user_id = $this->input->post('remove_user');
		$course_id = $this->input->post('remove_course');
		$semester_id = $this->input->post('remove_semester');
		$this->Registration_model->remove($user_id, $course_id, $semester_id);
		redirect('select_registration');
	}
	
	public function view() {
		$query = $this->Registration_model->get_semesters()->result_array();
		$data['semester'] = &$query;
		$data['is_editing'] = false;
		$data['current_semester'] = $this->Registration_model->get_current();
		
        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group4/registration/view', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
	}
}


