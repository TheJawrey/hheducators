
<?php
//include 'states.php';
//$selSrchCond = "MI";

//echo validation_errors();

?>

<div class="">
    <h2 style="text-align: center;">Class Details</h2>	
    
    <br /><br /><br />

    <div class="container col-lg-12 col-md-12 col-sm-12">
<!-- if $registration_edit form action="/update_user_info" -->
        <form class="form-horizontal"  method='post' action='<?php echo $registration_edit ? 'update_user_info' : '.' ?>' onsubmit="return checkPassword(this);">
            <div class="form-group row">
                <div class="col-md-4 col-sm-4">
                    <label class="control-label" for="fname">Course ID:</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" value="<?php echo $registration_edit ? $first_name : '' ?>" disabled>
                </div>
                <div class="col-md-8 col-sm-8">
                    <label class="control-label" for="mid_init">Course Name:</label>
                    <input type="text" class="form-control" id="mid_init" name="mid_init" placeholder="Initial" value="<?php echo $registration_edit ? $middle_initial : '' ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-12 col-sm-12">
                    <label class="cont rol-label" for="str_addr">Description:</label>
                    <input type="text" class="form-control" id="str_addr" name="str_addr" placeholder="Enter street address"  value="<?php echo $registration_edit ? $street : '' ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="city">Session 1 Start:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="state">Session 1 End:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="zip_code">Session 2 Start:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $registration_edit ? $zip : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="zip_code">Session 2 End:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $registration_edit ? $zip : '' ?>" disabled>
                </div>
            </div> 
            
            <div class="form-group row">
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="city">Min Grade Level:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="state">Max Grade Level:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="zip_code">Min Students:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $registration_edit ? $zip : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="zip_code">Max Students:</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $registration_edit ? $zip : '' ?>" disabled>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="city">Max Waitlist:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
                <div class="col-md-3 col-sm-3">
                    <label class="control-label" for="state">Homework Hours:</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $registration_edit ? $city : '' ?>" disabled>
                </div>
            </div>	

            <div class="form-group row">
                <div class="col-md-12 col-sm-12">
                    <label class="control-label" for="notes">Notes:</label>
                    <textarea class="form-control" rows="4" id="notes" name="notes" placeholder="Enter any additional notes" value="<?php echo $registration_edit ? $notes : '' ?>"></textarea>
                </div>
            </div>     



                <br /><br />
                



                <div style="margin-top: 10px" class="form-group">
                    <div style="width: 100%" class="container">
                        <button type="submit" class="btn btn-primary" name="add_user">Submit</button>
                    </div>
                </div>
                
        </form>
    </div>
</div>


