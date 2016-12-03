<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $user_array['first_name'] . ' ' . $user_array['middle_initial'] . ' ' . $user_array['last_name'] . '\'s Profile' ?></h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class=" col-md-9 col-lg-9 ">
                <table class="table table-user-information">
                    <tbody>
                    <tr>
                        <td>User ID:</td>
                        <td><?php echo $user_array['user_id'] ?></td>
                    </tr>
                    <?php if($user_array['family_id']): ?>
                    <tr>
                        <td>Family ID:</td>
                        <td><?php echo $user_array['family_id']; ?></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td>Status:</td>
                        <td>
                            <?php

                            $permissionArray = str_split($user_array['permission']);
                            if ($permissionArray[0] == 1) {
                                echo 'Administrator<br>';
                            }
                            if ($permissionArray[1] == 1) {
                                echo 'Teacher<br>';
                            }
                            if ($permissionArray[2] == 1) {
                                echo 'Parent<br>';
                            }
                            if ($permissionArray[3]) {
                                echo 'Student';
                            }

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><?php echo $user_array['gender'] ? 'Female' : 'Male'; ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?php echo $user_array['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Date of Birth</td>
                        <td><?php
                            $tmpVal = $user_array['birth_date'];
                            
                            $timeZone = new DateTimeZone("America/New_York");
                            $date= new DateTime($tmpVal, $timeZone);
                            
                            echo $date->format("M d, Y");
                            ?>
                        </td>
                    </tr>

                    <tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $user_array['street'] . ', ' . $user_array['city'] . ', ' . $user_array['state'] . ' ' . $user_array['zip'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone Number 1<br><br>Phone Number 2</td>
                        <td><?php echo $user_array['phone_number_1'] ?>
                            <br><br><?php echo $user_array['phone_number_2'] ?></td>
                    </tr>
                    <tr>
                        <td>Assigned Duty ID's:</td>
                        <!-- delete this GUI comment when it's done - placed for noticeability  -->

                        <td>
                            <?php echo form_open('user_duties') ?>
                            <button type="submit" class="btn btn-primary">Browse My Duties</button>
                            <input type="hidden" name="duty_ids" value="<?php echo $user_array['misc_duties'] ?>">
                            <?php echo form_close() ?>
                        </td>
                        
                    </tr>
                    <tr>
                        <td>Notes:</td>
                        <td><?php echo $user_array['notes'] ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <!-- if administrator show 'edit account' button -->
        <?php if ($current_user_clearance[0]): ?>
            <form action="./edit_account" method="post" style="display: inline-block">

                <input type="hidden" name="user_id" value="<?php echo $user_array['user_id'] ?>">
                <button class="btn btn-warning">Edit Account</button>

            </form>
            <form action="./confirm_user_password" method="post" style="display: inline-block"
                  onsubmit="return confirm('Are you sure you want to delete this user?');">

                <input type="hidden" name="user_id" value="<?php echo $user_array['user_id'] ?>">
                <button class="btn btn-danger">Delete Account</button>

            </form>
        <?php endif; ?>
        <!-- else show 'change password' button -->

        <form action="./change_password" method="post" style="display: inline-block">

            <input type="hidden" name="user_id" value="<?php echo $user_array['user_id'] ?>">
            <button class="btn btn-info">Change Password</button>

        </form>

    </div>
</div>