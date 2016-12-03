<?php
class Gen_model extends CI_Model{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function get_user($id)
	{
		$query = $this->db->get_where('users', array('user_id' => $id));
		
		$user = $query->row_array();
		$user["isAdmin"] = $user["permission"][0];
		$user["isTeacher"] = $user["permission"][1];
		$user["isParent"] = $user["permission"][2];
		$user["isStudent"] = $user["permission"][3];
		

		return $user;
	}

	public function set_news()
	{
		$this->load->helper('url');
		
		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'text' => $this->input->post('text')
		);
		
		return $this->db->insert('news', $data);
	}
}
?>