
<div class="mainContent">
    
    



        <div style="padding: 0" class="panel panel-success col-centered col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <div class="panel-heading">
                <h1>Add Category</h1>
            </div>
            <form action='save_new_category' method='post'>
                <div style="margin: 10px">
                <label for="category_name">Category Name</label>
                <?php if($error): ?>
                    <div class="alert alert-danger">
                        Category Name Already Exists!!
                    </div>
                <?php endif; ?>
                <input type='text' class="form-control" name='category_name' required/>
                <br>
                <input type='submit' class="btn btn-success" name='addCategory' value='Add Category'/>
                </div>
            </form>
        </div>

        

    

</div>
