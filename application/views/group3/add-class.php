<body>
<div class="mainContent">
    <h1>Add Course</h1>



    <table class="table table-striped">
        <form action='save_new_class' method='post'>


            <tr>
                <td>Course Name</td>
                <td><input type='text' name='course_name'\>*</td>
            </tr>


            <tr>
                <td>Teacher</td>
                <td><?php echo '<select name="Teacher"><option value="">(select a teacher)</option>';
                    foreach ($teachers as $teacher) {
                        echo "<option value=".$teacher['user_id'].">".$teacher['last_name'].   " , ".$teacher['first_name']."</option>";
                    }
                    echo '</select> *';
                ?></td>
            </tr>


            <tr>
                <td>Category</td>
                <td><input type='text' name='category'\>*</td>
            </tr>


            <tr>
                <td>Description</td>
                <td><input type='text' name='description'\></td>
            </tr>


            <tr>
                <td>Start Time</td>
                <td><input type='time' name='time1start'\>*</td>
            </tr>


            <tr>
                <td>End Time</td>
                <td><input type='time' name='time1end'\>*</td>
            </tr>


            <tr>
                <td>Secondary Start Time</td>
                <td><input type='time' name='time2start'\></td>
            </tr>


            <tr>
                <td>Secondary End Time</td>
                <td><input type='time' name='time2end'\></td>
            </tr>


            <tr>
                <td>Tuition Cost</td>
                <td><input type='number' min='0' name='tuition'\>*</td>
            </tr>


            <tr>
                <td>Fees</td>
                <td><input type='number' min='0' name='fees'\>*</td>
            </tr>


            <tr>
                <td>Minimum Grade Level</td>
                <td><input type='text' maxlength='3' name='min_gradelevel'\>*</td>
            </tr>


            <tr>
                <td>Maximum Grade Level</td>
                <td><input type='text' maxlength='3' name='max_gradelevel'\>*</td>
            </tr>


            <tr>
                <td>Minimum Class Size</td>
                <td><input type='number' min='0' name='min_students'\>*</td>
            </tr>


            <tr>
                <td>Maximum Class Size</td>
                <td><input type='number' min='0' name='max_students'\>*</td>
            </tr>


            <tr>
                <td>Maximum Waitlist Size</td>
                <td><input type='number' min='0' name='max_waitlist'\>*</td>
            </tr>


            <tr>
                <td>Homework Hours</td>
                <td><input type='number' min='0' name='homework_hours'\>*</td>
            </tr>


            <tr>
                <td>Notes</td>
                <td><input type='text' name='notes'\></td>
            </tr>


            <tr>
                <td>Highschool Class</td>
                <td>
                    <input type='hidden' name='highschool_class' value='0'\>
                    <input type='checkbox' name='highschool_class' value='1'\>
                </td>
            </tr>


            <tr>
                <td>Cancelled</td>
                <td>
                    <input type='hidden' name='cancelled' value='0'\>
                    <input type='checkbox' name='cancelled' value='1'\>
                </td>
            </tr>


            <tr>
                <td><input type='submit' class="btn btn-success" name='addClass' value='Add Class'\></td>
            </tr>


            * indicates a required field


        </form>

    </table>
</div>