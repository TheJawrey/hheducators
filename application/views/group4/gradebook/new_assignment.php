<div class="container">
	<h2>Assignments - Add New</h2>
	<h3><?php echo $course['course_name']; ?></h3>
	<form role="form" action="new-assignment?course=<?php echo $courseID ?>" method="post">
		<div class="row">
			<div class="form-group col-md-6">
				<label for="name">Name</label>
				<input class="form-control" name="name" tabindex="10" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-2">
				<label for="maxPoints">Maximum Points</label>
				<input type="number" min="0" max="30000" class="form-control" name="maxPoints" tabindex="20" required>
			</div>
			<div class="form-group col-md-4">
				<label for="dueDate">Due Date</label>
				<input type="date" class="form-control" name="dueDate" tabindex="30" required>
			</div>
		</div>
		<div class="row">
			<div class="form-group col-md-6">
				<label for="notes">Notes (optional)</label>
				<textarea class="form-control" name="notes" tabindex="40"></textarea>
			</div>
		</div>
		<input type='hidden' name='course' value='<?=($courseID) ? $courseID: '&nbsp;'?>'>
		<input type="submit" name="submit" value="Create Assignment" class="btn btn-success" tabindex="50">
		<?php if($success){echo $success;} ?>
	</form>
</div>