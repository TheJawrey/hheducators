<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Semesters extends CI_Controller {
	
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'group4/Semester_model' ); // I can now access the Semester_model class ($this->Semester_model)
	}
	
	public function add() {
		$this->clearance = $this->Semester_model->getPermission ( $this->session->userID ); // removed this from constructor and put it here - error onClick of forgot_password
		$permArray = str_split ( $this->clearance );
		
		if ($this->session->logged_in && $permArray [0] == 1) { // if logged in show browse users
			$this->Semester_model->add_semester();
			redirect('/');
		} else { // else redirect to Login_controller
			header ( 'Location: login' );
		}
	}
	
	public function select() {
		$semester_id = $this->input->post('semester_control');
		if ($semester_id) {
			$this->session->set_userdata(array('semester_id'  => $semester_id));
		} else {
			$semester_id = $this->session->semester_id;
		}
		
		$button = $this->input->post('submit');
		if ($button == 'current') {
			$this->Semester_model->set_current($semester_id);
		} else if ($button == 'delete') {
			$new_current = $this->Semester_model->delete($semester_id);
			if($this->Semester_model->get_current() == $semester_id) {
				$this->Semester_model->set_current($new_current);
				$semester_id = $new_current;
			}
		}
		
		$query = $this->Semester_model->get_semesters()->result_array();
		
		$data = $this->Semester_model->get_data($semester_id);
		$data['semester'] = &$query;
		$data['is_editing'] = true;
		$data['current_semester'] = $this->Semester_model->get_current();

		$this->load->view('group1/templates/header');
		$this->load->view('group1/templates/navbar/navbar');
		$this->load->view('group4/semesters/edit', $data);
		$this->load->view('group1/templates/navbar/navbottom');
		$this->load->view('group1/templates/footer');
	}
	
	public function add_class() {
		$semester_id = $this->input->post('add_semester');
		$course_id = $this->input->post('add_course');
		$this->Semester_model->add($semester_id, $course_id);
		redirect('select_semester');
	}
	
	public function remove_class() {
		$semester_id = $this->input->post('remove_semester');
		$course_id = $this->input->post('remove_course');
		$this->Semester_model->remove($semester_id, $course_id);
		redirect('select_semester');
	}
	
	public function edit() {
		$query = $this->Semester_model->get_semesters()->result_array();
		$data['semester'] = &$query;
		$data['is_editing'] = false;
		$data['current_semester'] = $this->Semester_model->get_current();
		
        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group4/semesters/edit', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
	}
}


