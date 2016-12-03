<div class="container">
	<?php if($user['isAdmin'] || $user['isTeacher']) : ?>
	<h2>Teacher - Grade Assignments</h2>
	<form role="form" method="get" action="gradebook/teacher">
		<div class="row">
			<div class="form-group col-md-4">
				<label for="course">Course</label>
				<select class="form-control" id="course" name="course" tabindex="5">
					<?php //Populate the select element with options containing the course ids and names.
						foreach($returnT as $row){
							echo "<option value=\"" . $row["id"] . "\">" . $row["course_name"] . "</option>";
						};
					?>
				</select>
			</div>
		</div>
		<button type="submit" class="btn btn-success" tabindex="10">View Assignments</button>
	</form>
	<?php endif; ?>
	<?php if($user['isStudent'] || $parentView) : ?>
		<h2><?php if($parentView){echo 'ParentView';}else{echo 'Student';} ?> - View Grades</h2>
		<form role="form" method="get" action="gradebook/student">
			<div class="row">
				<div class="form-group col-md-4">
					<label for="course">Select a course</label>
					<select class="form-control" id="course" name="course" tabindex="10">
						<?php //Populate the select element with options containing the course ids and names.
							foreach($returnS as $row){
								echo "<option value=\"" . $row["course_id"] . "\">" . $row["course_name"] . "</option>";
							};
						?>
					</select>
				</div>
			</div>
			<?php if($parentView) : ?>
				<input class="hiddenInfo" type="text" name="member" value="<?php echo @$_REQUEST["member"]; ?>">
			<?php endif; ?>
			<button type="submit" class="btn btn-success" tabindex="10" <?php if($parentView){echo 'name="parentview" value="1"';} ?>>View Assignments</button>
		</form>
	<?php endif; ?>
	<?php if($user["isParent"]) : ?>
		<h2>Parent - View Child Grades</h2>
		<form role="form" method="get">
			<input class="hiddenInfo" type="text" name="id" value="<?php echo $userID; ?>">
			<div class="row">
				<div class="form-group col-md-4">
					<label for="course">Select a family member</label>
					<select class="form-control" id="member" name="member" tabindex="15">
						<?php //Populate the select element with options containing the course ids and names.
							foreach($returnP as $row){
								echo "<option value=\"" . $row["user_id"] . "\">" . $row["last_name"] . ", " . $row["first_name"] . "</option>";
							};
						?>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-success" tabindex="10" name="parentview" value="1">Parentview</button>
		</form>
	<?php endif; ?>
</div>
