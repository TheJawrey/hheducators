<div class="container">
    <div class="form-group row">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="email1">Email Address:</label>
            <input type="email" class="form-control" id="email1" name="email1" placeholder="Enter email address"  <?php echo isset($registration_edit) ? ($registration_edit ? ($email? 'value="'.$email.'" required': '') : ''):'' ?>  >
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="email2">Verify Email Address:</label>
            <input type="email" class="form-control" id="email2" name="email2" placeholder="Re-enter email address"  <?php echo isset($registration_edit) ? ($registration_edit ? ($email? 'value="'.$email.'" required': '') : ''):'' ?> >
        </div>

    </div>

    <div class="form-group row">

        <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="tel">Phone Number 1:</label>
            <input type="tel" class="form-control" id="tel" name="phone1" placeholder="Enter phone number"  <?php echo isset($registration_edit) ? ($registration_edit ? ($phone_number_1? 'value="'.$phone_number_1.'" required': '') : ''):'' ?>  >
        </div>
        
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="tel">Phone Number 2:</label>
            <input type="tel" class="form-control" id="tel" name="phone2" placeholder="Enter phone number"  <?php echo isset($registration_edit) ? ($registration_edit ? ($phone_number_2? 'value="'.$phone_number_2.'" required': '') : ''): '' ?>  >
        </div>

    </div>
    
</div>