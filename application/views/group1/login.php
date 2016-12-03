
<style>
    .panel {
        text-align: center;
        margin: 10% auto;
        padding: 0;
    }
    .input-group {
        text-align: center;
        width: 100%;
    }
    .container {
        width: 100%;
        padding: 0;
    }
</style>

<div class="container">
    <!-- flash alert if info entered is wrong -->
    <?php if($errorMessage): ?>
        <div class="alert alert-danger">Oops! You've entered incorrect information.</div>
    <?php endif; ?>
     
    <div class="panel panel-default col-lg-6 col-md-9 col-sm-12 col-xs-12 col-centered">
        <div class="panel-heading">
            <h3>Log In</h3>
        </div>
        <div class="panel-body">
            <form action="login_validate" method="post">
                <div class="input-group">
                    <label for="userID">User ID:</label><br>
                    <input type="text" class="form-control" id="userID" name="userID"><br><br>
                    <label for="password">Password:</label><br>
                    <input type="password" class="form-control" name="password" >
                </div><br>
                <button type="submit" class="btn btn-primary col-lg-6 col-md-6 col-sm-6 col-xs-12">Log In</button>

                <!-- link this to email password reset menu -->
                <!-- what about forgotten user id functionality -->
                
            </form>
            <?php echo form_open('forgot_password'); ?>
                <button type="submit" class="btn btn-default col-lg-6 col-md-6 col-sm-6 col-xs-12">Forgot Password</button>
            <?php echo form_close(); ?>
        </div>
    </div>
    
</div>