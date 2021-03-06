<html>
<body>
	<div class="container">
	    <h2>Registration</h2><br>
	    <div class="row">
        <div class="form-group col-md-6">
	    <label>Select semester:</label>
		<form role="form" method="post" action="select_registration">
			<select class="form-control" name="semester_control" id="semester_control">
				<?php
				foreach ($semester as $row)
				{
					if ($row['semester_id'] === $current_semester) {
						$options = 'selected="selected"';
					} else {
						$options = '';
					}
                    echo sprintf('<option %s value="%s" name="%s">%s</option>', $options,
                    	$row['semester_id'].'', $row['semester_name'], $row['semester_name']);
				}
				?>
			</select><br>
			<button type="submit" name="submit" id="submit" value="edit" class="btn btn-success">Submit</button>
		</form>
		</div>
		</div>
	</div>
	<?php if ($is_editing){ ?>
	<div class="container">
	    <h3>Register for Courses: <?php echo $semester_info['semester_name'] ?></h3>
	    <table class="table table-bordered table-striped">
	        <thead>
	        <tr>
	            <th class="col-md-3">Course Name</th>
	            <th class="col-md-3">Instructor</th>
	            <th class="col-md-3">Start Time</th>
	            <th class="col-md-3">End Time</th>
	            <th class="col-md-1">Notes</th>
	            <th class="col-md-1">Delete</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php
	        foreach ($current_courses as $course){
	            echo '<tr>
					<td>' . $course['course_name'] . '</td>
					<td>' . $course['first_name'] .' '.$course['middle_initial'].' '.$course['last_name'].' '. '</td>
					<td>' . $course['time1start'] . '</td>
					<td>' . $course['time1end'] . '</td>
					<td><a href="#myModal" data-toggle="modal" id="'.$course['description'].'" data-target="#edit-modal" class="btn btn-primary">Description</a></td>					
					<td><form method="post" role="form" action="drop">
            		<input type="hidden" value='.$course['course_id'].' name="remove_course">
					<input type="hidden" value='.$user_info['user_id'].' name="remove_user">
                    <input type="hidden" value='.$semester_info['semester_id'].' name="remove_semester">
					<input type="submit" class="btn btn-danger" value="Drop">
					</form>
					</td>
				</tr>';
	        };
	        ?>
	        </tbody>
	    </table>
	</div>
	<div class="container">
	    <h3>Add a Course</h3>
	    <table class="table table-bordered table-striped">
	        <thead>
	        <tr>
	            <th class="col-md-3">Course Name</th>
	            <th class="col-md-3">Instructor</th>
	            <th class="col-md-3">Start Time</th>
	            <th class="col-md-3">End Time</th>
	            <th class="col-md-1">Notes</th>
	            <th class="col-md-1">Delete</th>
	        </tr>
	        </thead>
	        <tbody>
	        <?php
	        foreach ($all_courses as $course){
	            echo '<tr>
					<td>' . $course['course_name'] . '</td>
					<td>' . $course['first_name'] .' '.$course['middle_initial'].' '.$course['last_name'].' '. '</td>
					<td>' . $course['time1start'] . '</td>
					<td>' . $course['time1end'] . '</td>
					<td><a href="#myModal" data-toggle="modal" id="'.$course['description'].'" data-target="#edit-modal" class="btn btn-primary">Description</a></td>					
					<td><form method="post" role="form" action="register">
					<input type="hidden" value='.$course['id'].' name="add_course">
					<input type="hidden" value='.$user_info['user_id'].' name="add_user">
					<input type="hidden" value='.$semester_info['semester_id'].' name="add_semester">
					<input type="submit" class="btn btn-success" value="Register">
					</form>
					</td>
				</tr>';
	        };
	        ?>
	        </tbody>
	    </table>
	</div>
    <?php }
    include '/application/views/group4/registration/notes.php';
    ?>
</body>
</html>