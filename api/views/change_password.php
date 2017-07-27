<?php  $data['page']='setting'; $this->load->view('layout/header',$data);?>
<div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Change</strong>&nbsp;Password</h3>
                            <ul class="panel-controls">
                                        <li>
                                        <a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>
                                </div>
                                <div class="container-fluid">
                                <form method="post" action="<?php echo site_url('admin/Admin/change_password'); ?>" class="form-horizontal">
                                <div class="panel-body form-group-separated">
                                    
                            <?php if(isset($error)&& $error==1) { ?>
                            <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <?php echo $message;?>
                            </div>
                            <?php } if(isset($success)&& $success==1){?>
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <?php echo $message;?>
                            </div>
                            <?php }?>

                                <div class="form-group">                                   
                                        <label class="col-md-3 col-xs-12 control-label">Enter Old Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                <input type="hidden" name="status" value="<?php echo $status;?>">
                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                <input type="password" name="old_password" class="form-control"/>
                                            </div>            
                                        </div>
                                </div>


                                    <div class="form-group">                                   
                                        <label class="col-md-3 col-xs-12 control-label">Enter New Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <span class="fa fa-unlock-alt"></span></span>
                                                <input type="password" name="password" class="form-control"/>
                                            </div>            
                                        </div>
                                    </div>


                                    <div class="form-group">            
                                        <label class="col-md-3 col-xs-12 control-label">Enter Confirm Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                                <input type="password" name="confirm_password" class="form-control"/>
                                                 </div>            
                                        </div>
                                    </div>

                                <div class="panel-footer">
                                    <div class="row">
                                    <input type="reset" class="btn btn-success" value="Form Reset" style="width:100%; max-width:300px;">                                    
                                    <input type="submit" name="submit" value="Update" class="btn btn-success pull-right" style="width:100%; max-width:300px; margin-top:5px">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </form>                         
                    </div>
                </div>                    
            </div>

<?php $this->load->view('layout/footer');?> 