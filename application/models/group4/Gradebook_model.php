<?php
class Gradebook_model extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_course($courseID){
		$this->db->from('courses');
		$this->db->where('id', $courseID);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function get_courses($id = FALSE, $teacher = FALSE)
	{
		if($id && $teacher){
			$query = $this->db->get_where('courses', array('teacher' => $id));
		}elseif($id){
			$this->db->from('registration');
			$this->db->join('courses', 'registration.course_id = courses.id');
			$this->db->where('registration.user_id', $id);
			$query = $this->db->get();
		}else{
			$query = $this->db->get('courses');
		}
		return $query->result_array();
	}

	public function get_family($id)
	{
		//Get the user's family ID.
		$query = $this->db->get_where('users', array('user_id' => $id));
		$familyID = $query->row_array()["family_id"];

		//Get the user's family members.
		//"SELECT user_id, first_name, last_name FROM users WHERE family_id=" . $family['family_id'] . " AND user_id<>" . $userID . " ORDER BY last_name, first_name"
		$this->db->select('user_id, first_name, last_name');
		$this->db->from('users');
		$this->db->where('family_id', $familyID);
		$this->db->where('user_id !=', $id);
		$this->db->order_by('last_name, first_name');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function is_in_family($parent, $member)
	{
		//Get the user's family ID.
		$query = $this->db->get_where('users', array('user_id' => $parent));
		$familyID = $query->row_array()["family_id"];

		//Check if there is a user with the same id as member in that family.
		$query = $this->db->get_where('users', array('family_id' => $familyID, 'user_id' => $member));
		return $query->result_array();
	}

	public function get_student_class_grades($userID, $courseID)
	{
		$this->db->from('grades');
		$this->db->join('assignments', 'grades.assignment_id = assignments.assignment_id');
		$this->db->where('user_id', $userID);
		$this->db->where('course_id', $courseID);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get_teacher($courseID)
	{
		$this->db->select('teacher');
		$this->db->from('courses');
		$this->db->where('id', $courseID);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row_array()["teacher"];
	}

	public function get_assignment($assignmentID)
	{
		$this->db->from('assignments');
		$this->db->where('assignment_id', $assignmentID);
		$this->db->limit(1);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function get_assignments($courseID)
	{
		$this->db->from('assignments');
		$this->db->where('course_id', $courseID);
		$this->db->order_by('due_date');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function create_assignment($name, $maxPoints, $dueDate, $notes, $courseID)
	{
		//course_id, assignment_name, max_points, due_date, notes
		$data = array(
			'course_id' => $courseID,
			'assignment_name' => $name,
			'max_points' => $maxPoints,
			'due_date' => $dueDate,
			'notes' => $notes
		);

		$this->db->insert('assignments', $data);
	}

	public function update_assignment($assignmentID, $name, $maxPoints, $dueDate, $notes, $courseID)
	{
		//course_id, assignment_name, max_points, due_date, notes
		$data = array(
			'assignment_id' => $assignmentID,
			'course_id' => $courseID,
			'assignment_name' => $name,
			'max_points' => $maxPoints,
			'due_date' => $dueDate,
			'notes' => $notes
		);

		$this->db->replace('assignments', $data);
	}

	public function delete_assignment($assignmentID)
	{
		//Delete the assignment and all associated grades.
		$this->db->where('assignment_id', $assignmentID);
		$this->db->delete('assignments');
		$this->db->where('assignment_id', $assignmentID);
		$this->db->delete('grades');
	}

	public function get_grades($assignmentID)
	{
		$this->db->from('grades');
		$this->db->where('assignment_id', $assignmentID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_students($courseID)
	{
		$this->db->from('courses');
		$this->db->join('registration', 'registration.course_id = courses.id');
		$this->db->join('users', 'registration.user_id = users.user_id');
		$this->db->where('courses.id', $courseID);
		$this->db->order_by('users.last_name, users.first_name');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_grade($gradeObj, $assignmentID)
	{
		$data = array(
			"scored_points" => intval($gradeObj['scored_points'])
		);
		$this->db->where('user_id', $gradeObj['user_id']);
		$this->db->where('assignment_id', $assignmentID);
		$this->db->update('grades', $data);
	}

	public function insert_grade($gradeObj, $assignmentID)
	{
		////$query .= "INSERT INTO grades (assignment_id, user_id, scored_points) VALUES (" . intval($assignmentID) . ", " . intval($gradeObj['user_id']) . ", " . intval($gradeObj['scored_points']) . "); ";
		$data = array(
			'assignment_id' => $assignmentID,
			'user_id' => intval($gradeObj['user_id']),
			'scored_points' => intval($gradeObj['scored_points'])
		);
		$this->db->insert('grades', $data);
	}
}
?>
