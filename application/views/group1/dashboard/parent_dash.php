<div class="panel panel-success">
    <div class="panel-heading">
        Parent Portal
    </div>
    <div class="panel-body">

        <!-- Children Panel START -->
        <div class="panel panel-default">
            <div class="panel-heading">
                My Family
            </div>
            <div class="panel-body">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <td>First Name</td>
                        <td>Middle Initial</td>
                        <td>Actions</td>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- loop through results -->
                    <?php foreach($userArray as $userInfo) : ?>
                    
                    <tr>
                        
                        <td><?php echo $userInfo->first_name ?></td>
                        <td><?php echo $userInfo->middle_initial ?></td>
                        <td> 
                          <?php echo form_open('details') ?> <!-- route to userProfile page -->
                            <input type="hidden" name="user_id" value="<?php echo $userInfo->user_id ?>">
                            <button type="submit" class="btn btn-primary">Details</button>
                          <?php echo form_close() ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Children Panel END -->

    </div>
</div>