<div class="panel panel-warning">
    <div class="panel-heading">
        Teacher's tools
    </div>
    <div class="panel-body">
        <!-- Current Courses Panel START -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Currently Teaching Courses
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <td>Course Number</td>
                        <td>Course Name</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php
                    	foreach($results2 as $object) {
                    		$cn = $object['course_name'];
                    		echo "<tr>";
                            // I don't understand why you have this form here. it is loading ./teacher_classes instead of triggering your modal'
                    			echo "<form action='./teacher_classes' method='post' style='display: inline-block'>";
                    			echo 	"<td>" . $object['id'] . "</td>";
								echo 	"<td>" . $object['course_name'] . "</td>";
								echo 	"<td>";
								echo 		"<button class='btn btn-primary' name='selection' data-toggle='modal' data-target='#class_details_modal' id='class_details'>Class Details</button>&nbsp";							
								echo 		"<button class='btn btn-info'>Archive Course</button>";
								echo 	"</td>";
								echo "</form>";
							echo "</tr>";
						}
					?>
					
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Current Courses Panel END -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" id="class_details_modal" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div style="overflow: auto;" class="modal-content">
        <?php include('application/views/group1/details/class_details.php'); ?>
    </div>
  </div>
</div>


        <!-- we dont need this here. completed courses will become long -->
    </div>
</div>