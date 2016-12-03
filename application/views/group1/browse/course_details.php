<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
    <body>

          <div class="container" id="main">



          <h2 style="text-align: center;">Class Details</h2>

          <br /><br />

          <div class="container col-lg-12 col-md-12 col-sm-12">
            <!-- if $registration_edit form action="/update_user_info" -->
              <form class="form-horizontal"  action='./login' method='post'>
                <div style="margin-top: 10px" class="form-group">
                    <div style="width: 100%" class="container">
                        <button type="submit" class="btn btn-primary" name="add_user">Return</button>
                </div>
                <br />
                </div>
                  <?php foreach($course_info as $object) : ?>

                          <div class="form-group row">
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="fname">Course ID:</label>
                                  <input type="text" class="form-control" id="fname" name="fname" placeholder="<?php echo $object['id']; ?>" value="<?php echo $object['id']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="mid_init">Course Name:</label>
                                  <input type="text" class="form-control" id="mid_init" name="mid_init" placeholder="Initial" value="<?php echo $object['course_name']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="mid_init">Teacher ID:</label>
                                  <input type="text" class="form-control" id="mid_init" name="mid_init" placeholder="Initial" value="<?php echo $object['teacher']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="mid_init">Category:</label>
                                  <input type="text" class="form-control" id="mid_init" name="mid_init" placeholder="Initial" value="<?php echo $object['category']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-12 col-sm-12">
                                  <label class="cont rol-label" for="str_addr">Description:</label>
                                  <input type="text" class="form-control" id="str_addr" name="str_addr" value="<?php echo $object['description']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="city">Session 1 Start:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['time1start']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="state">Session 1 End:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['time1end']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="zip_code">Session 2 Start:</label>
                                  <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $object['time2start']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="zip_code">Session 2 End:</label>
                                  <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $object['time2end']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="city">Min Grade Level:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['min_gradelevel']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="state">Max Grade Level:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['max_gradelevel']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="zip_code">Min Students:</label>
                                  <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $object['min_students']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="zip_code">Max Students:</label>
                                  <input type="text" class="form-control" id="zip_code" name="zip_code" placeholder="Enter zip code"  value="<?php echo $object['max_students']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="city">Max Waitlist:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['max_waitlist']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="state">Homework Hours:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['homework_hours']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="state">Homework:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['homework']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="city">High School Class:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['highschool_class']; ?>" disabled>
                              </div>
                              <div class="col-md-3 col-sm-3">
                                  <label class="control-label" for="state">Cancelled:</label>
                                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name"  value="<?php echo $object['cancelled']; ?>" disabled>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-12 col-sm-12">
                                  <label class="control-label" for="notes">Notes:</label>
                                  <textarea class="form-control" rows="4" id="notes" name="notes" placeholder="<?php echo $object['notes']; ?>" value="<?php echo $object['notes']; ?>"></textarea>
                              </div>
                          </div>



                        <br /><br />




                        <div style="margin-top: 10px" class="form-group">
                            <div style="width: 100%" class="container">
                                <button type="submit" class="btn btn-primary" name="add_user">Return</button>
                            </div>
                        </div>

                      </form>
                  </div>


          <?php       endforeach; ?>

    </body>
</html>
