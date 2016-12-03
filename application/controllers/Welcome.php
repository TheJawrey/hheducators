<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct(){
        parent::__construct(); 
        $this->load->model('group1_models/user_model'); // I can now access the User_model class ($this->User_model)
		
		$this->clearance = $this->user_model->getPermission($this->session->userID); // grab the users permission from the db and store it in clearance
	}
	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() // add optional user first/last name parameter for appearace in navbar
							// "Welcome, John Doe!"
	{
		// check sessions for login credentials 
		if($this->session->logged_in){ // if logged in show dashboard

				$this->load->view('group1/templates/header');
				$this->load->view('group1/templates/navbar/navbar');
				$this->pickPage($this->input->post('selection')); // logic controlling which view is selected in $_POST['selection']
				$this->load->view('group1/templates/navbar/navbottom'); 
				$this->load->view('group1/templates/footer');

		} else { // else redirect to Login_controller

			header('Location: login');
	
		}

	}

	//*******
	public function pickPage($selection = NULL){
		// echo $selection;

		$this->load->helper('form');

		switch($selection){
			case 'dash':
				$this->showDash($this->clearance);
				break;
            case 'register':
				
				// how do these work? if I remove the 'required' attribute from the
				$this->form_validation->set_rules('fname', 'First Name', 'required');
				$this->form_validation->set_rules('lname', 'Last Name', 'required');
				$this->form_validation->set_rules('passwd', 'Password', 'required|trim');
				$this->form_validation->set_rules('str_addr', 'Street Address', 'required');
				$this->form_validation->set_rules('city', 'City', 'required');
				$this->form_validation->set_rules('which_state', 'State', 'required');
				$this->form_validation->set_rules('zip_code', 'Zip Code', 'required');
				$this->form_validation->set_rules('birth_date', 'Birth Date', 'required');
				$this->form_validation->set_rules('gender', 'Gender', 'required');

				$data['post'] = $this->input->post();

				if($this->form_validation->run() == false){
					// invalid form entry
					$this->showDash($this->clearance, 1); // show dashboard but with 'add user' button clicked and error messages in form
				} else {
                	$this->registerUser($data);
				}
				break;
            default:
				$this->showDash($this->clearance); // put actual user permission in header_register_callback
									   // query database for the info
        }
	}
	// ******

	//*******
	public function showDash($perm, $button = NULL){
		$permArray = str_split($perm);

		$data =  (array)$this->user_model->getUserInfo($this->session->userID);
		$data['permission'] = $permArray;
		$data['registration_edit'] = false;

		// print_r($data);
		// render user $data to display in user_dash
		$this->load->view('group1/dashboard/user_dash', $data);
		
		$data['dispButton'] = $button;

		if($permArray[0]) 
			$this->load->view('group1/dashboard/admin_dash', $data);

		if($permArray[1]) {
		
			// Load Teacher Classes Model
			$this->load->model('group1_models/teacher_classes_model');
			
			// Get the array of current Course IDs being taught from course table 
			$data = $this->teacher_classes_model->get_current_classes($this->session->userID);
			
			// Separate the IDs into its own array
			$myCourseIDsArr = explode(',', $data->current_courses);
			//print_r($myCourseIDsArr);
			
			
			// Using the IDs array, get all rows for each course ID from the model.
			$data2['results2'] = $this->teacher_classes_model->get_course_info($myCourseIDsArr);

			// Load the view and pass in the rows from $data2
			$this->load->view('group1/dashboard/teacher_dash', $data2);

		}

		if($permArray[2]){
			$userArray = $this->findFamily($this->session->userID);
 			// print_r($userArray);
 			$this->load->view('group1/dashboard/parent_dash', array("userArray" => $userArray));
		}
		
		if($permArray[3])
			$this->load->view('group1/dashboard/student_dash');


	}
	// *******
	


	public function findFamily($userID){
		$familyID = (array)$this->user_model->getFamilyID($userID);
		// print_r($familyID);
		$userArray = $this->user_model->getKids($familyID);
		// print_r($userArray);
		return $userArray;
	}



	//*******
	public function registerUser($data) {




		if(!$this->input->post('action') || $this->input->post('action') != 'addUser'){
			
			// display dependent registration pages
			$this->showDependentReg($data);
			
		} else if($this->input->post('action') == 'addUser') {
			//----------------------------------------
			if(isset($data['post']['add_admin']) || isset($data['post']['add_Teacher']) || isset($data['post']['add_parent'])){
				$this->form_validation->set_rules('email1', 'E-mail', 'required|trim|valid_email');
			}			
			
			if($this->form_validation->run() == false){
				// invalid form entry
				$this->showDependentReg($data);
			} else {
				$this->user_model->addUser();
				$this->showDash($this->clearance);
			}





		} else {
			echo 'ERROR dependent.php';
		}
	}
	// ********


	//*********
	public function showDependentReg($data){
			//
			$this->load->view('group1/registration/depend_add_top', $data);
			//

			if($this->input->post('add_admin'))
				$this->load->view('group1/registration/dependents/add_admin');

			if($this->input->post('add_teacher'))
				$this->load->view('group1/registration/dependents/add_teacher');

			
			if($this->input->post('add_parent'))
				$this->load->view('group1/registration/dependents/add_parent');


			if($this->input->post('add_student'))
				$this->load->view('group1/registration/dependents/add_student');
				
			//
			$this->load->view('group1/registration/depend_add_bottom');
			//
	}
	// ******

}
