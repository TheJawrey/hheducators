<?php
class Gradebook extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('group4/gen_model');
		$this->load->model('group4/gradebook_model');
		$this->load->helper('url_helper');
		$this->load->library('session');
	}

	public function set($id)
	{
		$_SESSION['userID'] = $id;
	}

	public function index()
	{
		$data['title'] = 'Gradebook';

		$userID = $_SESSION['userID'];

		$user = $this->gen_model->get_user($userID);

		if($user["isAdmin"]){
			$data['returnT'] = $this->gradebook_model->get_courses();
		}elseif($user["isTeacher"]){
			//Retrieve courses that are taught by this teacher.
			$data['returnT'] = $this->gradebook_model->get_courses($userID, true);
		}

		//If a student or a parent checking on a student...
		$parentView = @$_REQUEST["parentview"];
		$data['parentView'] = $parentView;
		if($user["isStudent"] || $parentView){
			//$query = "SELECT r.*, c.course_name FROM registration AS r JOIN courses AS c ON r.course_id=c.id WHERE r.user_id=";
			if($parentView){
				//Double check that the family member belongs to the same family as the parent.
				$isInFamily = $this->gradebook_model->is_in_family($userID, @$_REQUEST["member"]);
				if($isInFamily){
					$data['returnS'] = $this->gradebook_model->get_courses(@$_REQUEST["member"]);
				}
			}else{
				$data['returnS'] = $this->gradebook_model->get_courses($userID);
			};
		}

		//If the user is a parent, get a list of other family members.
		if($user["isParent"]){
			$data['returnP'] = $this->gradebook_model->get_family($userID);
		}

		//Add information to the data array.
		$data['userID'] = $userID;
		$data['user'] = $user;

    ///

    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

    $this->load->view('group4/templates/header', $data);
    $this->load->view('group4/gradebook/index', $data);
    $this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');

    ///

	}

	public function student()
	{
		$data['title'] = 'Gradebook';

		$courseID = @$_REQUEST['course'];
		$userID = $_SESSION['userID'];

		$parentView = @$_REQUEST["parentview"];
		if($parentView){
			//Double check that the family member belongs to the same family as the parent.
			$isInFamily = $this->gradebook_model->is_in_family($userID, @$_REQUEST["member"]);
			if($isInFamily){
				$data['grades_list'] = $this->gradebook_model->get_student_class_grades(@$_REQUEST["member"], $courseID);
			}
		}else{
			$data['grades_list'] = $this->gradebook_model->get_student_class_grades($userID, $courseID);
		}


    ///

    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

    $this->load->view('group4/templates/header', $data);
    $this->load->view('group4/gradebook/student', $data);
    $this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');

    ///
	}

	public function teacher()
	{
		$data['title'] = 'Gradebook';

		$courseID = @$_REQUEST['course'];
		$userID = $_SESSION['userID'];

		//Confirm the course is taught by this teacher.
		$this->is_taught_by($userID, $courseID);

		//If delete has been passed in, delete an assignment.
		if(@$_REQUEST['delete'] && @$_REQUEST['assignment']){
			$this->gradebook_model->delete_assignment(@$_REQUEST['assignment']);
		}

		//If the 'saved-grades' query is in the URL, it's coming from grades_teacher.php.
		$savedGrades = @$_REQUEST['saved-grades'];
		if($savedGrades){
			$this->save_grades($savedGrades, $courseID);
		}

		$data['assignments'] = $this->gradebook_model->get_assignments($courseID);
		$data['courseID'] = $courseID;

    ///

    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

    $this->load->view('group4/templates/header', $data);
    $this->load->view('group4/gradebook/teacher', $data);
    $this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');

    ///
	}

	public function new_assignment()
	{
		$data['title'] = 'Gradebook';

		$courseID = @$_REQUEST['course'];
		$userID = $_SESSION['userID'];

		//Confirm the course is taught by this teacher.
		$this->is_taught_by($userID, $courseID);

		$data['course'] = $this->gradebook_model->get_course($courseID);

		$data['success'] = "";

		/*
		 if statement checks if form was submited, if true then it proceeds to retrieve input
		 data and perform error checking and update assignment in database
		 */
		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$maxPoints = $_POST['maxPoints'];
			$dueDate = $_POST['dueDate'];
			$notes = $_POST['notes'];
			$courseID = $_POST['course'];
			$error = '';

			if($name == '' ){
				$error = $error.' Please enter a title.';
			}
			if(($maxPoints < 0 || $maxPoints > 30000)){
				$error = $error.' Please enter a Maximum Point value of 0 or greater and less than 30000.';
			}
			if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $dueDate) && !preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', $dueDate)){
				$error = $error.' Please use mm/dd/yyyy format.';
			}
			if($error == ''){
				if(preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', $dueDate)){
					$dueDate = $this->dateToSql($dueDate);
				}
				$this->gradebook_model->create_assignment($name, $maxPoints, $dueDate, $notes, $courseID);

				// need to develop plan of action for user after changes are successfully made

				$data['success'] = 'Assignment created. '.
				'Click <a href=\'../teacher?course=' . $courseID . '\'>here</a> to return to View Assignments.';
			}
			else{
				echo $error;
			}
		}

		$data['courseID'] = $courseID;

    /////

    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

    $this->load->view('group4/templates/header', $data);
		$this->load->view('group4/gradebook/new_assignment', $data);
		$this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');

    /////

	}

	public function edit_assignment()
	{
		$data['title'] = 'Gradebook';

		$courseID = @$_REQUEST['course'];
		$assignmentID = @$_REQUEST['assignment'];
		$userID = $_SESSION['userID'];

		//Confirm the course is taught by this teacher.
		$this->is_taught_by($userID, $courseID);

		$data['course'] = $this->gradebook_model->get_course($courseID);

		$data['success'] = "";

		if(isset($_POST['submit'])){
			$name = $_POST['name'];
			$maxPoints = $_POST['maxPoints'];
			$dueDate = $_POST['dueDate'];
			$notes = $_POST['notes'];
			$courseID = $_POST['course'];
			$error = '';

			if($name == '' ){
				$error = $error.' Please enter a title.';
			}
			if(($maxPoints < 0 || $maxPoints > 30000)){
				$error = $error.' Please enter a Maximum Point value of 0 or greater and less than 30000.';
			}
			if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $dueDate) && !preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', $dueDate)){
				$error = $error.' Please use mm/dd/yyyy format.';
			}
			if($error == ''){
				if(preg_match('/^(0[1-9]|1[0-2])\/(0[1-9]|[1-2][0-9]|3[0-1])\/[0-9]{4}$/', $dueDate)){
					$dueDate = $this->dateToSql($dueDate);
				}
				$this->gradebook_model->update_assignment($assignmentID, $name, $maxPoints, $dueDate, $notes, $courseID);

				// need to develop plan of action for user after changes are successfully made

				$data['success'] = 'Assignment updated. '.
				'Click <a href=\'../teacher?course=' . $courseID . '\'>here</a> to return to View Assignments.';
			}
			else{
				echo $error;
			}
		}
		$data['courseID'] = $courseID;
		$data['assignment'] = $this->gradebook_model->get_assignment($assignmentID);


    ///

    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

		$this->load->view('group4/templates/header', $data);
		$this->load->view('group4/gradebook/edit_assignment', $data);
		$this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');

    ///
	}

	public function grade_assignment()
	{
		$data['title'] = 'Gradebook';

		$courseID = intval(@$_REQUEST['course']);
		$userID = $_SESSION['userID'];
		$assignmentID = intval(@$_REQUEST['assignment']);

		//Confirm the course is taught by this teacher.
		$this->is_taught_by($userID, $courseID);

		//Retrieve the grades for this assignment.
		$grades = $this->gradebook_model->get_grades($assignmentID);

		//Retrieve users in this class.
		$students = $this->gradebook_model->get_students($courseID);

		//Retrieve assignment information
		$assignment = $this->gradebook_model->get_assignment($assignmentID);

		//Build a table of grades.
		$tableHTML = "";

		//For each student in the class, create a row.
		foreach($students as $row){
			//If a grade already exists for this student, record it as $existingGrade and set update to 1;
			//The existing grade will be used to populate that student's field.
			//Update will be passed along to determine if the grade should be inserted or updated.
			$existingGrade = "";
			$update = 0;
			foreach($grades AS $grade){
				if($grade["user_id"]===$row["user_id"]){
					$existingGrade = $grade["scored_points"];
					$update = 1;
					break;
				};
			};
			//Build the row.
			$tableHTML .=
			'<tr>
				<td>' . $row["last_name"] . ', ' . $row["first_name"] . '</td>
				<td><input type="number" min="0" max="' . $assignment['max_points'] . '" class="points" value="' . $existingGrade . '"><div class="hiddenInfo userID">' . $row["user_id"] . '</div><div class="hiddenInfo existingGrade">' . $existingGrade . '</div><input type="number" class="hiddenInfo update" max="1" min="0" value="' . $update . '"></td>
			</tr>';
		}
		$data['tableHTML'] = $tableHTML;
		$data['assignment'] = $assignment;
		$data['courseID'] = $courseID;


    ////
    $this->load->view('group1/templates/header');
    $this->load->view('group1/templates/navbar/navbar');

		$this->load->view('group4/templates/header', $data);
		$this->load->view('group4/gradebook/grade_assignment', $data);
		$this->load->view('group4/templates/footer');

    $this->load->view('group1/templates/navbar/navbottom');
    $this->load->view('group1/templates/footer');
    ////
	}

	public function save_grades($savedGrades, $courseID)
	{
		//The grades are urlencoded JSON. Decode them into an associated array and get the assignment id.
		$parsedGrades = json_decode(urldecode($savedGrades), true);
		$assignmentID = intval($parsedGrades['assignment_id']);


		//Loop through and either write an update or insert query.
		foreach($parsedGrades['array'] AS $gradeObj){
			if($gradeObj['update'] && $gradeObj['scored_points']){
				$this->gradebook_model->update_grade($gradeObj, $assignmentID);
			}elseif($gradeObj['scored_points']){
				$this->gradebook_model->insert_grade($gradeObj, $assignmentID);
			};
		};

		header("Location: " . base_url() . "index.php/gradebook/teacher?course=" . $courseID);
		exit();
	}

	public function is_taught_by($userID, $courseID)
	{
		$user = $this->gen_model->get_user($userID);

		$teacher = $this->gradebook_model->get_teacher($courseID);
		if($userID != $teacher && !$user['isAdmin']){
			header("Location: " . base_url() . "index.php/gradebook");
			exit();
		}
	}

	public function dateToSql($d1){
		$year = substr($d1, -4);
		$month = substr($d1, 0, -8);
		$day = substr($d1, 3, -5);
		return $year.'-'.$month.'-'.$day;
	}
}
?>
