<div class="container">
	<h2>Assignments - View</h2>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-md-1">Grade</th>
				<th class="col-md-4">Name</th>
				<th class="col-md-2">Maximum Points</th>
				<th class="col-md-2">Due Date</th>
				<th class="col-md-1">Notes</th>
				<th class="col-md-1">Edit</th>
				<th class="col-md-1">Delete</th>
			</tr>
		</thead>
		<tbody id="assignmentTable">
		<?php
			//Tabulate all the assignments for this course.
			//The actions for each button are handled in the JavaScript, main.js.
			foreach($assignments as $row){
				if($row['assignment_id'] != @$_REQUEST['assignment']){echo '
				<tr>
					<td><a href="teacher/grade-assignment?assignment=' . $row['assignment_id'] . '&course=' . $courseID . '"><button class="btn btn-info grade">Grade</button></a></td>
					<td>' . $row['assignment_name'] . '<span class="hiddenInfo">' . $row['assignment_id'] . '</span><span class="hiddenInfo">' . $row['course_id'] . '</span></td>
					<td>' . $row['max_points'] . '</td>
					<td>' . $row['due_date'] . '</td>
					<td><button class="btn btn-primary notes">Notes</button><span class="hiddenInfo">' . $row['notes'] . '</span></td>
					<td><a href="teacher/edit-assignment?assignment=' . $row['assignment_id'] . '&course=' . $courseID . '"><button class="btn btn-warning edit">Edit</button></a></td>
					<td><a href="teacher?delete=1&assignment=' . $row['assignment_id'] . '&course=' . $courseID . '"><button class="btn btn-danger delete">Delete</button></a></td>
				</tr>';}};?>
			<tr>
				<td colspan="7">
					<a href="teacher/new-assignment?course=<?php echo $courseID; ?>"><button class="btn btn-success">Add New</button></a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
