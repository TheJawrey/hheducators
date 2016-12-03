<?php
    if($error){
        echo '<div class="alert alert-danger">INCORRECT PASSWORD</div>';
    }
?>


<div class="container">

    <div class="panel panel-danger">
        <div class="panel-heading">
            Enter Password
        </div>
        <div class="panel-body">
            <form action="confirm_user_password" method="post">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                <input type="hidden" name="doit" value="1">
                <div class="form-group">
                    <input type="password" class="form-control" name="password">
                </div>       
                <input type="submit" class="btn btn-danger" value="EXECUTE">         
            </form>
        </div>
    </div>

</div>