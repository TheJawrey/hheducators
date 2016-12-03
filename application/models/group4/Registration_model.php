<?php

class Registration_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_semesters()
    {
    	$query = $this->db->get('semester');
        return $query;
    }
    
    public function add($user_id, $course_id, $semester_id)
    {
    	$this->db->insert('registration', array('user_id' => $user_id, 'course_id'=>$course_id, 'semester_id'=>$semester_id));
    }
    
    public function remove($user_id, $course_id, $semester_id)
    {
    	$this->db->delete('registration', array('user_id' => $user_id, 'course_id'=>$course_id, 'semester_id'=>$semester_id));
    }
    
    public function set_current($semester_id)
    {
    	$this->db->delete('variables', array('name' => 'current_semester'));
    	$this->db->insert('variables', array('name' => 'current_semester', 'value' => $semester_id));
    }
    
    public function get_current()
    {
    	 $query = $this->db->get("variables")->row_array();
    	 return $query['value'];
    }
    
    public function get_data($user_id, $semester_id)
    { 	
    	$query_available = $this->db->from('registration')->join('courses', 'registration.course_id=courses.id')->
    	join('users', 'users.user_id=courses.teacher')->where(array("registration.user_id" => $user_id, "registration.semester_id" => $semester_id))
    	->get()->result_array();
    	$data['current_courses'] = &$query_available;
    	
    	$where[] = 0;
	   	foreach ($query_available as $row) {
    		$where[] = $row['course_id'];
    	}
    	
    	$query_all = $this->db->from('courses')->
    	join('users', 'users.user_id=courses.teacher')->where_not_in('id', $where)->get()->result_array();
    	$data['all_courses'] = &$query_all;

    	$query_semester = $this->db->where('semester_id', $semester_id)->get('semester')->row_array();
    	$data['semester_info'] = &$query_semester;
    	
    	$query_user = $this->db->where('user_id', $user_id)->get('users')->row_array();
    	$data['user_info'] = &$query_user;
    	
    	return $data;
    }
    
    public function get_name($user_id)
    {
    	$query = $this->db->where('user_id', $this->session->userID)->get('users');
    	$user_data = $query->row_array();
    	$readableName = sprintf("%s %s %s", $user_data["first_name"],
    			$user_data["middle_initial"], $user_data["last_name"]);
    	return $readableName;
    }

    // gets permission associated with $userID
    public function getPermission($userID) {
	$this->db->select ( 'permission' );
	$this->db->from ( 'users' );
	$this->db->where ( 'user_id', $userID );
	$query = $this->db->get ()->result ();
	
	return $query [0]->permission;
}
    
    public function getPassword($user_id)
    {
    	$this->db->select('password');
    	$this->db->where('user_id', $user_id);
    
    	$query = $this->db->get('users')->result();
    
    	return $query[0]->password;
    }
    
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
    
    public function get_user()
    {
    	$query = $this->db->where('user_id', $this->session->userID)->get('users');
    	$user_data = $query->row_array();
    	$this->load->library('user', $user_data);
    	return new user($user_data);
    }
}