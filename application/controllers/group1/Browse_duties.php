<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Browse_duties extends CI_Controller {
    
	public function __construct(){
        parent::__construct(); 
        $this->load->model('group1_models/duties_model'); // I can now access the Duties_model class ($this->Duties_model)
    }


    public function index() {
        // add if statement 
        // if admin continue
        // else redirect to dash
        echo 'browse_duties controller';
                $this->load->view('group1/templates/header');
				$this->load->view('group1/templates/navbar/navbar');
                $this->showBrowseDuties();
				$this->load->view('group1/templates/navbar/navbottom'); 
				$this->load->view('group1/templates/footer'); 
    }

    public function filteredIndex($data)
    {
        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group1/browse/duty_table', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
    }

    public function dutyDetails()
    {
        $duty_id = $this->input->post('duty_id');
        $query = $this->db->get_where('misc_duties_table', array('duty_id' => $duty_id));

        $data['dutyInfo'] = $query->result_array();
        $data['allUsersWithDuty'] = $this->allUsersWithDuty($duty_id);


        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group1/browse/duty_details_table', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
    }

    public function allUsersWithDuty($dutyID)
    {
        $usersWithDuty = array();

        $this->db->select('user_id, first_name, middle_initial, last_name, misc_duties');
        $query = $this->db->get('users');
        $results = $query->result_array();

        foreach ($results as $user)
        {
            $user_duties = explode(',', $user['misc_duties']);
            if(in_array($dutyID, $user_duties))
            {
                array_push($usersWithDuty, $user);
            }
        }

        return $usersWithDuty;
    }
    
    public function getUserDuties()
    {
        $ids = $this->input->post('duty_ids');
        $idsArray = explode(",", $ids);
        $this->db->where_in('duty_id', $idsArray);
        $query = $this->db->get('misc_duties_table');

        $data['dutiesInfo'] = $query->result_array();
        
        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group1/browse/user_duties', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
    }


    public function showBrowseDuties() {

        $query = $this->db->get('misc_duties_table');
        $data['duties_array'] = $query->result_array();
        return $this->load->view('group1/browse/duty_table', $data);
    }

    public function addDuty()
    {
        $data['duty_name'] = $this->input->post('duty_name');
        $data['duty_description'] = $this->input->post('duty_description');
        $this->duties_model->addDuty($data);

        return redirect('welcome');
    }
    
    public function getDutyById($id)
    {
        $this->duties_model->getDutyById($id);
    }

    public function getDutyByName($name)
    {
        $this->duties_model->getDutyByName($name);
    }

    public function filterDuties()
    {
        if($this->input->post('duty_id') != null)
        {
            $this->findDutyById($this->input->post('duty_id'));
        }
        else if($this->input->post('duty_name') != null)
        {
            $this->findDutyByName($this->input->post('duty_name'));
        }
    }

    public function findDutyByName($name)
    {
        $data['duties_array'] = $this->duties_model->getDutyByName($name);
        $this->filteredIndex($data);
    }

    public function findDutyById($id)
    {
        $data['duties_array'] = $this->duties_model->getDutyById($id);
        $this->filteredIndex($data);
    }
    
    public function updateDuty()
    {
        $data['duty_id'] = $this->input->post('duty_id');
        $data['duty_name'] = $this->input->post('duty_name');
        $data['duty_description'] = $this->input->post('duty_description');
        $this->duties_model->updateDuty($data);

        return redirect('browse_duties');
    }

    public function addDutyUser()
    {
        $userID = $this->input->post('user_id');
        $dutyID = $this->input->post('duty_id');
        $this->duties_model->addDutyUser($userID, $dutyID);
        return redirect('browse_duties');
    }

    public function removeDutyUser()
    {
        $userID = $this->input->post('user_id');
        $dutyID = $this->input->post('duty_id');
        $this->duties_model->removeDutyUser($userID, $dutyID);
        return redirect('browse_duties');
    }


    public function editDuty()
    {
        $this->load->helper('form');

        $id = $this->input->post('duty_id');
        $data['duty'] = $this->duties_model->getDutyById($id);
        
        $this->load->view('group1/templates/header');
        $this->load->view('group1/templates/navbar/navbar');
        $this->load->view('group1/duties/edit_duty', $data);
        $this->load->view('group1/templates/navbar/navbottom');
        $this->load->view('group1/templates/footer');
    }

}