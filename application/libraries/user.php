<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user
{
	public $id;
	public $readableName;
	public $isAdmin = false;
	public $isTeacher = false;
	public $isParent = false;
	public $isStudent = false;

	function __construct($user_data)
	{
		$this->id = $user_data['user_id'];
		$this->readableName = sprintf("%s %s %s", $user_data["first_name"],
				$user_data["middle_initial"], $user_data["last_name"]);
		$permInt = $user_data["permission"];
		$permArr = str_split($permInt);
		if ($permArr[0] == 1) $this->isAdmin = true;
		if ($permArr[1] == 1) $this->isTeacher = true;
		if ($permArr[2] == 1) $this->isParent = true;
		if ($permArr[3] == 1) $this->isStudent = true;
	}
}