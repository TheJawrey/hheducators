<div class="">
    <h2 style="text-align: center;">New Semester Form</h2>	
    
    <br /><br /><br />

    <div class="container col-lg-12 col-md-12 col-sm-12">
        <form class="form-horizontal"  method='post' action='new_semester'>
            <div class="form-group row">
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="semester_name">Semester Name:</label>
                    <input type="text" class="form-control" id="semester_name" name="semester_name" placeholder="Enter semester name" value="<?php echo $registration_edit ? $semester_name : '' ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="start_date">Start Date:</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter date as MM/DD/YYYY"  value="<?php echo $registration_edit ? $start_date : '' ?>" required>
                </div>
            </div>
                        <div class="form-group row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <label class="control-label" for="end_date">End Date:</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter date as MM/DD/YYYY"  value="<?php echo $registration_edit ? $end_date : '' ?>" required>
                </div>
            </div>	   
                <div style="margin-top: 10px" class="form-group">
                    <div style="width: 100%" class="container">
                        <button type="submit" class="btn btn-primary" name="add_semester">Submit</button>
                    </div>
                </div>
                
        </form>
    </div>
</div>


