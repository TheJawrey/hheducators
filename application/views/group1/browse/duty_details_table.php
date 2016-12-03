<style>
    .browse-duties-title{
        display: inline-block;
        text-align: center;
        width: 100%;
    }
</style>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="container">

            <div class="browse-duties-title">
                <h2>Duty Details - <?php echo $dutyInfo[0]['duty_name'] ?></h2>

            </div>

        </div>

        <?php echo form_open('add_duty_user', array('class' => 'form-inline form-group')) ?>
        <input class="form-control" type="number" placeholder="User ID to Add" name="user_id">
        <input type="hidden" name="duty_id" value="<?php echo $dutyInfo[0]['duty_id']?>">
        <button class="btn btn-primary" type="submit">Assign User</button>
        <?php echo form_close() ?>

    </div><!-- panel-heading -->


    <div class="panel-body">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>User ID</th>
                <th>User Full Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($allUsersWithDuty as $userInfo) : ?>

                <tr>
                    <td><?php echo $userInfo['user_id'] ?></td>
                    <td><?php echo $userInfo['first_name'] . ' ' . $userInfo['middle_initial'] . ' ' . $userInfo['last_name'] ?></td>
                    <td>
                        <?php echo form_open('remove_duty_user')?> <!-- route to userProfile page -->
                        <input type="hidden" name="user_id" value="<?php echo $userInfo['user_id'] ?>">
                        <input type="hidden" name="duty_id" value="<?php echo $dutyInfo[0]['duty_id'] ?>">
                        <button type="submit" class="btn btn-danger">Un-Assign Duty</button>
                        <?php echo form_close() ?>
                    <td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>


    </div><!-- panel-body -->
</div>