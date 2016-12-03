
<?php
include 'states.php';
$selSrchCond = "MI";

echo validation_errors();

?>

<div class="">
    <h2 style="text-align: center;"><?php echo $registration_edit? 'Edit User' : 'Registration' ?> Form</h2>	
    
    <br /><br /><br />

    <div class="container col-lg-12 col-md-12 col-sm-12">
<!-- if $registration_edit form action="/update_user_info" -->
        <form class="form-horizontal"  method='post' action='<?php echo $registration_edit ? 'update_user_info' : '.' ?>' onsubmit="return checkPassword(this);">
            <!-- <input type="hidden" name="registration_edit" value="<?php echo $registration_edit ?>"> -->
            <div class="form-group row">
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="fname">First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" value="<?php echo $registration_edit ? $first_name : '' ?>" required>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="mid_init">MI:</label>
                    <input type="text" class="form-control" id="mid_init" name="mid_init" placeholder="Initial" value="<?php echo $registration_edit ? $middle_initial : '' ?>">
                </div>
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="lname">Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name"  value="<?php echo $registration_edit ? $last_name : '' ?>" required>
                </div>
            </div>
            <?php if(!$registration_edit): ?>
                <div class="form-group row">
                    <!-- removed user ID -->
                    <div class="col-md-6 col-sm-6">
                        <label class="control-label" for="passwd">Password:</label>
                        <input type="password" class="form-control" id="passwd" name="passwd" placeholder="Enter password" required>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <label class="control-label" for="verify_passwd">Verify Password:</label>
                        <input type="password" class="form-control" id="verify_passwd" name="verify_passwd" placeholder="Verify password" required>
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="control-label col-sm-2" for="gender">Gender:</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="gender" value='0' <?php echo $registration_edit ? ($gender ? '' : "checked") : '' ?> required>Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" value='1' <?php echo $registration_edit ? ($gender ? "checked" : '') : '' ?> required>Female
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 col-sm-12">
                    <label class="cont rol-label" for="str_addr">Street Address:</label>
                    <input type="text" class="form-control" id="str_addr" name="str_addr" placeholder="Enter street address"  value="<?php echo $registration_edit ? $street : '' ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="city">City:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" required>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="state">State:</label>
                    <select class="form-control" name="which_state">
                        <!-- SELECT AND RETAIN VALUE FOR STATE -->
                        <!-- made a change here included my own state.php and made $statesArr associative -->
                        <?php foreach($statesArr as $key => $value) : ?>
                            <option value="<?php echo $key; ?>"  <?php echo $registration_edit ? ($key == $state ? "selected='selected'" : '') : ($key == 'MI' ? "selected='selected'" : '') ?> ><?php echo $key;  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="zip_code">Zip Code:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $registration_edit ? $zip : '' ?>" required>
                </div>
            </div> 

            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="birth_date">Birthdate:</label>
                    <input type="date" class="form-control" id="birth_date" name="birth_date" placeholder="Enter birthdate as MM/DD/YYYY"  value="<?php echo $registration_edit ? $birth_date : '' ?>" required>
                </div>
            </div>	

            <div class="form-group row">
                <div class="col-md-12 col-sm-12">
                    <label class="control-label" for="notes">Notes:</label>
                    <textarea class="form-control" rows="4" id="notes" name="notes" placeholder="Enter any additional notes" value="<?php echo $registration_edit ? $notes : '' ?>"></textarea>
                </div>
            </div>     


            <!-- permissions boxes add in -->
            <h3 style="text-align: left;">Add Permissions</h3>  
            <div style="width: 100%;" class="container">
               
                    <?php
                        if($registration_edit){
                            $permArray = str_split($permission);
                        }
                    ?>
                    
                    <div class="form-group" required>
                        <div class="checkbox">
                            <label><input type="checkbox" value ="1" name="add_student" <?php echo $registration_edit ? ($permArray[3] == 1 ? "checked" : '') : '' ?>>Student</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value ="1" name="add_parent" <?php echo $registration_edit ? ($permArray[2] == 1 ? "checked" : '') : '' ?>>Parent</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value ="1" name="add_teacher" <?php echo $registration_edit ? ($permArray[1] == 1 ? "checked" : '') : '' ?>>Teacher</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value ="1" name="add_admin" <?php echo $registration_edit ? ($permArray[0] == 1 ? "checked" : '') : '' ?>>Admin</label>
                        </div>
                    </div>
                    <!-- on submission, adds student/teacher/parent/admin permissions to user_id and initializes student/teacher courses_completed/courses_taken and current_courses to empty -->
                    
               
            </div><!--/container -->
                <br /><br />
                
                <!--  -->
                <?php 

                    if($registration_edit){ //<!-- include dependent -->
                        include('application/views/group1/registration/dependents/add_student.php');
                        include('application/views/group1/registration/dependents/add_admin.php');
                        include('application/views/group1/registration/dependents/add_teacher.php');
                        include('application/views/group1/registration/dependents/add_parent.php');
                        
                        echo '<input type="hidden" name="user_id" value="'.$user_id.'">';
                    } else {
                        echo '<input type="hidden" name="selection" value="register">';
                    }
                
                ?>
                <!--  -->


                <div style="margin-top: 10px" class="form-group">
                    <div style="width: 100%" class="container">
                        <button type="submit" class="btn btn-primary" name="add_user">Submit</button>
                    </div>
                </div>
                
        </form>
    </div>
</div>


