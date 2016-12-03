
<!-- it would be great if this could be filtered (grade, teacher, course_name, etc..)-->

<div class="mainContent">

    <h1>Courses</h1>

    
    <!-- show add class button only if user is admin -->
    <?php if($user_permission[0]): ?>
        <a class="btn btn-success" href='add-class'>Add Course</a>
    <?php endif; ?>

    

    <br/>

    

        <table class="table table-striped">

        

        <thead>



            <tr>

                <td>Grade Level</td>

                <td>Course Name</td>

                <td>Teacher</td>

                <td>Category</td>

                <td>Time Start</td>

                <td>Time End</td>

                <td colspan='2'></td>

            </tr>
            
        </thead>

        <tbody>

            <?php foreach($course_info as $row): ?>


            <tr>
                <td>
                    <?php echo $row['min_gradelevel']; ?>
                </td>
                <td>
                    <?php echo $row['course_name']; ?>		
                </td>
                <td>
                    <?php echo $row['teacher']; ?>
                </td>
                <td> 
                    <?php echo $row['category']; ?>
                </td> 
                <td>
                    <?php echo $row['time1start']; ?>
                </td>
                <td>
                    <?php echo $row['time1end']; ?>
                </td>

            <!-- make these individual forms and tie them to routes************ -->
                <td>
                    <?php echo form_open('course_details'); ?>
                        <input type="hidden" name="course_id" value="<?php echo $row['id'] ?>">
                        <button type="submit" class="btn btn-info" >details</button>
                    <?php echo form_close(); ?>
                </td>

                <td>
                    <?php echo form_open('course_delete'); ?>
                        <input type="hidden" name="course_id" value="<?php echo $row['id'] ?>">
                        <button type="submit" class="btn btn-danger" >delete</button>
                    <?php echo form_close(); ?>
                </td>
            </tr>
            <!-- // ********** -->

            <?php endforeach; ?>

            
        </tbody>
</table>
    

</div>
