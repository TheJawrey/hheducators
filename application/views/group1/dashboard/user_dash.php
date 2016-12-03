
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo 'Hello, '.$first_name.' '.$middle_initial.' '.$last_name ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>User ID:</td>
                            <td><?php echo $user_id ?></td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td>
                                <?php 
                                     
                                    if($permission[0] == 1){
                                        echo 'Administrator<br>';
                                    }
                                    if($permission[1] == 1){
                                        echo 'Teacher<br>';
                                    }
                                    if($permission[2] == 1){
                                        echo 'Parent<br>';
                                    }
                                    if($permission[3]){
                                        echo 'Student';
                                    }

                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td><?php echo $email ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            <div class="panel-footer">
                <?php echo form_open('details')?> <!-- route to userProfile page -->
                    
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                    <button type="submit" class="btn btn-primary">Details</button>
                    
                <?php echo form_close() ?>
            </div>
    </div>