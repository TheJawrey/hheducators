<div class="container">
	<h2>Assignments - Edit</h2>
	<h3><?php echo $assignment["assignment_name"]; ?></h3>
	<form role="form" action="edit-assignment?course=<?php echo $assignment["course_id"]; ?>&assignment=<?php echo $assignment["assignment_id"]; ?>" method="post">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="name">Name</label>
				<input class="form-control" name="name" tabindex="10" value="<?php echo $assignment["assignment_name"]; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label for="maxPoints">Maximum Points</label>
				<input type="number" min="0" max="30000" class="form-control" name="maxPoints" tabindex="20" value="<?php echo $assignment["max_points"]; ?>" required>
			</div>
			<div class="form-group col-md-4">
				<label for="dueDate">Due Date</label>
				<input type="date" class="form-control" name="dueDate" tabindex="30" value="<?php echo $assignment["due_date"]; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="notes">Notes (optional)</label>
				<textarea class="form-control" name="notes" tabindex="40"><?php echo $assignment["notes"]; ?></textarea>
			</div>
		</div>
		<input class="hiddenInfo" type="hidden" name="assignment" value="<?php echo $assignment["assignment_id"]; ?>">
		<input class="hiddenInfo" type="hidden" name="course" value="<?php echo $courseID; ?>">
		<input type="submit" name="submit" value="Save Changes" class="btn btn-success" tabindex="50">
		<?php if($success){echo $success;} ?>
	</form>
</div>