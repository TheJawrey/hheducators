<div class="panel panel-primary">
    <div class="panel-heading">
        Student Portal
    </div>
    <div class="panel-body">
        <!-- Current Courses Panel START -->
        <div class="panel panel-default">
            <div class="panel-heading">
                My Current Courses
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
                        foreach($results2 as $object) :

                          echo "<tr>";
                            echo "<form action='./index.php/browse_course_details' method='post' style='display: inline-block'>";
                            echo 	"<td>" . $object['id'] . "</td>";
                            echo 	"<td>" . $object['course_name'] . "</td>";
                            echo 	"<td>";
                            echo 		"<button class='btn btn-primary' name='selection' data-toggle='modal' data-target='#class_details_modal' id='class_details'>Course Details</button>&nbsp";

                            echo  "<input type='hidden' name='course_id' value='" . $object['id'] . "'>";

                            echo 	"</td>";
                            echo "</form>";
                          echo "</tr>";
                        endforeach;
                      ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Current Courses Panel END -->


        <!-- we dont need this here. completed courses will become long -->
    </div>
</div>
