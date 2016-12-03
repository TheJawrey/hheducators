
<!--

filter by:

duty_id
duty_name

-->

<style>
    .browse-duties-title{
        display: inline-block;
        text-align: center;
        width: 100%;
    }
</style>

<div class="panel panel-info">
    <div class="panel-heading">
        <div class="dropdown">

            <div class="browse-duties-title">
                <h2>Browse Duties</h2>

            </div>

            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Filter Results
                <span class="caret"></span>
            </button>

            <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <?php echo form_open('filter_duties') ?> <!-- route to user_model function that displays all users before loading this page in the first place -->
                <div class="row">


                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                        <label for="duty_name">Duty Name</label><br>
                        <input type="text" class="form-control" name="duty_name">

                        <label for="duty_id">Duty ID</label>
                        <input type="number" class="form-control" name="duty_id">
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
                <th>Duty ID</th>
                <th>Duty Name</th>
                <th>Duty Description</th>
            </tr>
            </thead>
            <tbody>

            <!-- loop through results -->
            <?php foreach($duties_array as $dutyInfo) : ?>

                <tr>
                    <td><?php echo $dutyInfo['duty_id'] ?></td>
                    <td><?php echo $dutyInfo['duty_name'] ?></td>
                    <td><?php echo $dutyInfo['duty_description'] ?></td>

                    <td>
                        <?php echo form_open('duty_details')?> <!-- route to userProfile page -->
                        <input type="hidden" name="duty_id" value="<?php echo $dutyInfo['duty_id'] ?>">
                        <button type="submit" class="btn btn-primary">Details</button>
                        <?php echo form_close() ?>
                    <td>
                    <td>
                        <?php echo form_open('edit_duty')?> <!-- route to userProfile page -->
                        <input type="hidden" name="duty_id" value="<?php echo $dutyInfo['duty_id'] ?>">
                        <button type="submit" class="btn btn-warning">Edit Duty</button>
                        <?php echo form_close() ?>
                    </td>
                </tr>

            <?php endforeach; ?>

            </tbody>
        </table>


    </div><!-- panel-body -->
</div>