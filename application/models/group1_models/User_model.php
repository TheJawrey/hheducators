<?php

class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function addUser()
    {
        $data = array(
            'first_name' => $this->input->post('fname'),
            'middle_initial' => $this->input->post('mid_init'),
            'last_name' => $this->input->post('lname'),
            'password' => md5($this->input->post('passwd')), // md5() hashes this password before storing in the database
            'street' => $this->input->post('str_addr'),
            'city' => $this->input->post('city'),
            'state' => $this->input->post('which_state'),
            'permission' => $this->buildPermission($this->input->post('add_admin'), $this->input->post('add_teacher'), $this->input->post('add_parent'), $this->input->post('add_student')),
            'zip' => $this->input->post('zip_code'),
            'birth_date' => $this->input->post('birth_date'),
            'gender' => $this->input->post('gender'),
            'notes' => $this->input->post('notes'),
            'phone_number_1' => $this->input->post('phone1'),
            'phone_number_2' => $this->input->post('phone2'),
            'email' => $this->input->post('email1'),
            'family_id' => $this->input->post('family_id')
        );

        $this->db->insert('users', $data);

        if($this->input->post('add_teacher')){
            // get this user id and add it to the table
            $this->db->select('user_id');
            $this->db->where($data);
            $id = $this->db->get('users')->result();
            // print_r($id[0]->user_id);
            
            $this->db->insert('teacher_table', array('user_id' => $id[0]->user_id));
        }
    }

    public function buildPermission($admin, $teacher, $parent, $student)
    {
        $temp = array($admin == 1 ? '1' : '0', $teacher == 1 ? '1' : '0', $parent == 1 ? '1' : '0', $student == 1 ? '1' : '0');
        return implode($temp);
    }


// validate username and password used to l
    public function validate($userID, $password)
    {
        $array = array('user_id' => $userID, 'password' => $password);
        $this->db->where($array);
        $query = $this->db->get('users');


        if ($query->result_id->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    // gets permission associated with $userID
    public function getPermission($userID)
    {

        $this->db->select('permission');
        $this->db->from('users');
        $this->db->where('user_id', $userID);
        $query = $this->db->get()->result();

        return $query[0]->permission;
    }

    // gets info for userID
    public function getUserInfo($userID)
    {

        $this->db->select('user_id, first_name, middle_initial, last_name, gender, email, birth_date, street, city, state, zip, phone_number_1, phone_number_2, misc_duties, notes');
        $this->db->from('users');
        $this->db->where('user_id', $userID);
        $query = $this->db->get()->result();

        return $query[0];

    }

    // get all user info (user profile and settings pages)
    public function getAllUserInfo($userID)
    {

        // going to need to do a join to get family_id & misc_duties
        $this->db->where('user_id', $userID);
        $query = $this->db->get('users')->result();

        // print_r($query);
        return $query[0];
    }


    //gets family_id for current logged in user
    public function getFamilyID($userID)
    {
        $this->db->select('family_id');
        $this->db->from('users');
        $this->db->where('user_id', $userID);
        $query = $this->db->get()->result();
        return $query[0]; 
    }

   //matches family_id in users table to get associated family members
    public function getKids($familyID)
    {   
        $this->db->select('first_name, middle_initial, user_id');
        $this->db->from('users');
        $this->db->where('family_id', $familyID['family_id']);
        $this->db->like('permission', "1", 'before'); // uses regex to find permission where ***1 (students with specified family id)
        $query = $this->db->get()->result();
        
        return $query;
    }

    //  “’^[0-9].*’”

    // gets info for all users based on filter options
    // for use on browse_users page
    public function filterUsers($filterInfo = NULL)
    {
        //return array of all users to be stored in $data and sent to view

        $this->db->select('user_id, first_name, last_name, permission, gender, city');
        $this->db->from('users');

        if ($filterInfo) {
            // use $this->db->where to search based on filter
            // echo 'Filter Info';
            // print_r($filterInfo);

            if (isset($filterInfo['first_name']) && $filterInfo['first_name']) {
                $this->db->where('first_name', $filterInfo['first_name']);
            }

            if (isset($filterInfo['last_name']) && $filterInfo['last_name']) {
                $this->db->where('last_name', $filterInfo['last_name']);
            }


            // requires a table join
            if(isset($filterInfo['family_id']) && $filterInfo['family_id']){
                $this->db->where('family_id', $filterInfo['family_id']);
            }

            if (isset($filterInfo['user_id']) && $filterInfo['user_id']) {
                $this->db->where('user_id', $filterInfo['user_id']);
            }

            if (isset($filterInfo['city']) && $filterInfo['city']) {
                $this->db->where('city', $filterInfo['city']);
            }

            if (isset($filterInfo['birth_date']) && $filterInfo['birth_date']) {
                $this->db->where('birth_date', $filterInfo['birth_date']);
            }

            // find all users with birthday in specified month
            if(isset($filterInfo['birth_month']) && $filterInfo['birth_month']){
                $this->db->where('MONTH(birth_date) = '.$filterInfo['birth_month']);
            }

            if(isset($filterInfo['user_type'])){
                if(isset($filterInfo['user_type']['admin']) && $filterInfo['user_type']['admin']){
                    $this->db->where(array("permission REGEXP" => "1{1}\d{3}"));
                }
                if(isset($filterInfo['user_type']['teacher']) && $filterInfo['user_type']['teacher']){
                    $this->db->where(array("permission REGEXP" => "\d{1}1\d{2}"));
                }
                if(isset($filterInfo['user_type']['parent']) && $filterInfo['user_type']['parent']){
                    $this->db->where(array("permission REGEXP" => "\d{2}1\d{1}"));
                }
                if(isset($filterInfo['user_type']['student']) && $filterInfo['user_type']['student']){
                    $this->db->where(array("permission REGEXP" => "^\d{3}1"));
                }
            }


        }

        $query = $this->db->get()->result();

        // convert array of objects to array of arrays
        foreach ($query as &$user) {
            $user = (array)$user;
        }

        return $query;
    }


    public function updateUserInfo($post)
    {
        $data = array(
            'first_name' => $post['fname'],
            'middle_initial' => $post['mid_init'],
            'last_name' => $post['lname'],
            'street' => $post['str_addr'],
            'city' => $post['city'],
            'state' => $post['which_state'],
            'family_id' =>$post['family_id'],
            'permission' => $this->buildPermission(isset($post['add_admin']) ? $post['add_admin'] : 0, isset($post['add_teacher']) ? $post['add_teacher'] : 0, isset($post['add_parent']) ? $post['add_parent'] : 0, isset($post['add_student']) ? $post['add_student'] : 0),
            'zip' => $post['zip_code'],
            'birth_date' => $post['birth_date'],
            'gender' => $post['gender'],
            'notes' => $post['notes'],
            'phone_number_1' => $post['phone1'],
            'phone_number_2' => $post['phone2'],
            'email' => $post['email1']
        );
        $this->db->where('user_id', $post['user_id']);
        $this->db->update('users', $data);
    }

    public function getPassword($user_id)
    {
        $this->db->select('password');
        $this->db->where('user_id', $user_id);

        $query = $this->db->get('users')->result();

        return $query[0]->password;
    }


    public function deleteUser($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->delete('users');
    }


	public function updatePassword($user_id, $password){
		$data = array('password' => md5($password));

		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);


	}

    public function save_random_string($random, $user_id){
        $data = array(
            'random_string' => $random,
            'user_id' => $user_id
            );

        $this->db->insert('reset_password', $data);
    }

    // RESET PASSWORD
    // get the user_id associated with the random string in the url
    public function get_rand_id($rand){
        $this->db->select('user_id');
        $this->db->where('random_string', $rand);
        
        $query = $this->db->get('reset_password')->result();

        //delete this row from database so it can't be used again
        // $this->db->where('random_string', $rand);
        // $this->db->delete('reset_password');

        // print_r($query[0]->user_id);
        return $query[0]->user_id;
    }

}