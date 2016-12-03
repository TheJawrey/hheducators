<div class="container">
    <div class="form-group row">
        <div class="col-lg-56 col-md-56 col-sm-56 col-xs-12">
            <label class="control-label" for="family_id">Family ID:</label>
            <input  type="number" name="family_id" id="family_id" class="form-control" placeholder="Enter your family ID"  <?php echo isset($registration_edit) ? ($registration_edit ? (isset($family_id)? 'value="'.$family_id.'" required': '') : '') : '' ?> >
            <!-- add forgot family ID link to seperate page -->
            <!-- option to search by user id -->
        </div>
    </div>
</div>