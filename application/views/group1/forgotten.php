<div class="container col-lg-6 col-md-6 col-sm-9 col-xs-10 col-centered">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h2>Enter User ID:</h2>
        </div>
        <div class="panel-body">
            <?php echo form_open('send_email'); ?>
                <div class="form-group">
                    <input style="margin-bottom: 10px;" type="number" class="form-control" name="user_id">
                    <input type="submit" class="btn btn-info" value="Submit">
                </div>
            <?php echo form_open(); ?>
        </div>
        <div class="panel-footer">
            <p>if you've forgotten your User ID please contact Administrator</p>
        </div>
    </div>
</div>