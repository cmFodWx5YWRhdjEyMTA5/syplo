<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
    <style>
        span{
            color:red;
            font-size: 16px;
        }
        .alert{
            width: 100% !important;
            line-height: 21px;
            margin-left: 0px !important;
        }
    </style>
        <!-- META SECTION -->
        <title>Recover Password</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="SHORTCUT ICON" href="https://syplo.se/api/assest/img/Untitled-3.png" type="image/png" />
        <!-- END META SECTION -->      
        <!-- CSS INCLUDE --> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>     
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>assest/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    
    <body>        
        <div class="login-container">
            <div class="login-box animated fadeInDown">
            <?php if(isset($success) && $success==1) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } else if(isset($error) && $error==1) { ?>
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } ?>
                <div class="login-logo"></div>
                <div class="login-body">
                    <div class="login-title"><strong>Recover</strong>Password</div>
                    <form class="form-horizontal" method="post" action="<?php echo site_url("admin/Admin/resetPassword?em=$email");?>">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="hidden" name="email" value="<?php echo $email;?>">  
                            <input type="text" name="new_password" class="form-control" placeholder="Enter New Password" required /> 
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">  
                            <input type="text" name="confirm_password" class="form-control" placeholder="Enter Confirm Password" required />                       
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <a href="<?php echo site_url('admin');?>" class="btn btn-link btn-block" style="font-size:16px; margin-top:20px;">Back to LogIn</a>
                        </div>>
                        <div class="col-md-6 pull-right">
                            <input type="submit" name="change" value="Submit" class="btn btn-info btn-block">
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>






