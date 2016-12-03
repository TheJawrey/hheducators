<style>
    .row {
        padding: 0;
        margin: 0;
        width: 100%;
    }
    .navbar {
        margin: 0 0 10px 0;
        width: 100%;
    }
    .box {
        padding: 0;
    }
</style>

<!-- navbar start -->
    <div class="row">
        <nav class="navbar navbar-default col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">hheducators</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?php echo base_url() ?>">Dashboard<span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Gradebook</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo base_url('courses') ?>">Courses</a></li>
                    <!-- this will be full of group specific links -->
                    <!--to be added on completion of entire project-->
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="log_out">Log Out</a></li>
                    </ul>
                    </li>
                </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
<!-- navbar end -->

<!-- responsive project box start -->

<div class="row">
        <div class="box col-centered col-lg-11 col-md-11 col-sm-12 col-xs-12">
            
            <!-- insert content || other group projects here 

            **** this will be a controller file of sorts ****
            **** will decide which page to display based on button clicked **** -->