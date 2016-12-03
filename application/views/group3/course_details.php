<div class="mainContent">
    <h1>Course Details</h1>

    <table class="table table-striped">

        <tr>
            <td>Course name</td>
            <td><?php echo $course_info['course_name'];?></td>
        </tr>
        <tr>
            <td>Teacher</td>
            <td><?php echo $teachers['first_name']." ".$teachers['last_name'];?></td>
        </tr>
        <tr>
            <td>Category</td>
            <td><?php echo $course_info['category'];?></td>
        </tr>
        <tr>
            <td>Description</td>
            <td><?php echo $course_info['description'];?></td>
        </tr>
        <tr>
            <td>Time1start</td>
            <td><?php echo $course_info['time1start'];?></td>
        </tr>
        <tr>
            <td>Time1end</td>
            <td><?php echo $course_info['time1end'];?></td>
        </tr>

        <tr>
            <td>Time2start</td>
            <td>
                <?php
                if($course_info['time2end'] != "00:00:00"){
                    echo $course_info['time2end'];
                }
                else{
                    echo "N/A";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Time2end</td>
            <td>
                <?php
                if($course_info['time2end'] != "00:00:00"){
                    echo $course_info['time2end'];
                }
                else{
                    echo "N/A";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>Tuition</td>
            <td><?php echo "$".$course_info['tuition'];?></td>
        </tr>
        <tr>
            <td>Fees</td>
            <td><?php echo "$".$course_info['fees'];?></td>
        </tr>
        <tr>
            <td>Min gradelevel</td>
            <td><?php echo $course_info['min_gradelevel'];?></td>
        </tr>
        <tr>
            <td>Max gradelevel</td>
            <td><?php echo $course_info['max_gradelevel'];?></td>
        </tr>
        <tr>
            <td>Min students</td>
            <td><?php echo $course_info['min_students'];?></td>
        </tr>
        <tr>
            <td>Max students</td>
            <td><?php echo $course_info['max_students'];?></td>
        </tr>
        <tr>
            <td>Max waitlist</td>
            <td><?php echo $course_info['max_waitlist'];?></td>
        </tr>
        <tr>
            <td>hours of homework</td>
            <td><?php echo $course_info['homework_hours'];?></td>
        </tr>

        <tr>
            <td>homework</td>
            <td>
                <?php 
                if($course_info['homework'] == 1){
                    echo "Yes";
                }
                else{
                    echo "No";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>notes</td>
            <td><?php echo $course_info['notes'];?></td>
        </tr>

        <tr>
            <td>higschool class</td>
            <td>
                <?php
                if($course_info['highschool_class'] == 1){
                    echo "Yes";
                }
                else{
                    echo "No";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td>course cancelled</td>
            <td>
                <?php
                if($course_info['cancelled'] == 0){
                    echo "No";
                }
                else{
                    echo "Yes";
                }
                ?>
            </td>
        </tr>

        <tr>
            <td colspan='2' >
                <?php echo form_open("course_edit"); ?>
                    <input type="hidden" name="course_id" value="<?php echo $course_info['id']; ?>">
                    <button type="submit" class="btn btn-warning">edit</button>
                <?php echo form_close(); ?>
            </td>
        </tr>

    </table>

</div>