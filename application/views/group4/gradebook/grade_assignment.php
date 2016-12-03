<div class="container">
	<h2>Grades</h2>
	<h3><?php echo $assignment["assignment_name"]; ?></h3>
	<div class="hiddenInfo" id="assignmentID"><?php echo $assignment["assignment_id"]; ?></div>
	<div class="hiddenInfo" id="courseID"><?php echo $assignment["course_id"]; ?></div>
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<th class="col-md-11">Student Name</th>
				<th class="col-md-1">Points</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $tableHTML; ?>
			<tr>
				<td colspan="6">
					<!-- This submition will be handled with JavaScript. -->
					<button class="btn btn-success" id="gradeSubmit">Submit</button>
				</td>
			</tr>
		</tbody>
	</table>
</div>