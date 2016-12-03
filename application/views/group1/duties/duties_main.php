<?php

?>

<div>

    <h2 style="text-align: center;">Add Duty Form</h2>
    <br /><br /><br />
    <div class="container col-lg-12 col-md-12 col-sm-12">
        <?php echo form_open('add_duty', array('class' => 'form-horizontal')); ?>

        <div class="form-group row">
            <div class="col-md-4 col-sm-4">
                <label class="control-label" for="duty_name">Duty Name:</label>
                <input type="text" class="form-control" id="duty_name" name="duty_name">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4 col-sm-4">
                <label class="control-label" for="duty_description">Duty Description:</label>
                <textarea class="form-control" name="duty_description" id="duty_description" rows="4"></textarea>
            </div>
        </div>
        <div style="margin-top: 10px" class="form-group">
            <div style="width: 100%" class="container">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

        </form>
    </div>
    <br>
    <br>
    <br>
</div>
