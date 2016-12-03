
<!--

filter by:

first_name
last_name
family_id
user_id
gender
city
birth_date (year, month, day) ex. show me all kids born in december || born in 2009

-->

<style>
    .browse-users-title{
        display: inline-block;
        text-align: center;
        width: 100%;
    }
</style>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="dropdown">

            <div class="browse-users-title">
                <h2>Browse Users</h2>

            </div>

            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Filter Results
                <span class="caret"></span>
            </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <?php echo form_open() ?> <!-- route to user_model function that displays all users before loading this page in the first place -->
                        <div class="row">


                            <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <label for="first_name">First Name</label><br>
                                <input type="text" class="form-control" name="first_name">
                            <!--</div>
                            <div class="form-group">-->
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name">
                            </div>


                            <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                <label for="family_id">Family ID</label>
                                <input type="number" class="form-control" name="family_id">

                                <label for="user_id">User ID</label>
                                <input type="number" class="form-control" name="user_id">
                            </div>


                            <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                <label for="city">City</label>
                                <input type="text" class="form-control" name="city">

                                <label for="birth_date">Birth Date</label>
                                <input type="date" class="form-control" name="birth_date">
                            </div>


                            <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
                                <label for="birth_month">Birth Month #: (1 - 12)</label> <!-- good for finding who has birthdays this month -->
                                <input type="number" class="form-control" name="birth_month" min="1" max="12">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="gender" value="0">
                                        Male
                                    </label>
                                    <label>
                                        <input type="checkbox" name="gender" value="1">
                                        Female
                                    </label>
                                </div>
                            </div>

                            
                            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="hidden" name="user_type[admin]" value="0">
                                        <input type="checkbox" name="user_type[admin]" value="1">
                                        Admin
                                    </label>
                                    <label>
                                        <input type="hidden" name="user_type[teacher]" value="0">
                                        <input type="checkbox" name="user_type[teacher]" value="1">
                                        Teacher
                                    </label>
                                    <label>
                                        <input type="hidden" name="user_type[parent]" value="0">
                                        <input type="checkbox" name="user_type[parent]" value="1">
                                        Parent
                                    </label>
                                    <label>
                                        <input type="hidden" name="user_type[student]" value="0">
                                        <input type="checkbox" name="user_type[student]" value="1">
                                        Student
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group col-lg-1 col-md-1 col-sm-2 col-xs-3">
                                <input type="submit" class="btn btn-primary" value="Filter Users">
                            </div>
                        </div>
                    <?php echo form_close() ?>
                </div>
            </div>    
        </div><!-- panel-heading -->


    <div class="panel-body">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Status</th> <!-- admin, teacher, parent, student -->
                    <th>Gender</th>
                    <th>City</th>
                </tr>
            </thead>
            <tbody>
                <!-- loop through results -->
                <?php foreach($user_array as $userInfo) : ?>
                

                <tr>
                    <td><?php echo $userInfo['user_id'] ?></td>
                    <td><?php echo $userInfo['first_name'] ?></td>
                    <td><?php echo $userInfo['last_name'] ?></td>
                    <td><?php 
                    
                       $permissionArray = str_split($userInfo['permission']); 
                       if($permissionArray[0] == 1){
                           echo 'Administrator<br>';
                       }
                       if($permissionArray[1] == 1){
                           echo 'Teacher<br>';
                       }
                       if($permissionArray[2] == 1){
                           echo 'Parent<br>';
                       }
                       if($permissionArray[3]){
                           echo 'Student';
                       }

                    ?></td>
                    <td><?php echo $userInfo['gender']? 'Female':'Male' ?></td>
                    <td><?php echo $userInfo['city'] ?></td>
                    <td>
                        <?php echo form_open('details')?> <!-- route to userProfile page -->
                            <input type="hidden" name="user_id" value="<?php echo $userInfo['user_id'] ?>">
                            <button type="submit" class="btn btn-primary">Details</button>
                        <?php echo form_close() ?>
                    <td>
                </tr>
                
                <?php endforeach; ?>
                
            </tbody>
        </table>


    </div><!-- panel-body -->
</div>