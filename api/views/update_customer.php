<?php $data['page']='three'; $this->load->view('layout/header',$data);?> 
<!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update</strong>&nbsp;Customer</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>

                            <!-- erro display here -->

                            <?php if(isset($error)&& $error==1) { ?>
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $message;?>
                            </div>
                            <?php } if(isset($success)&& $success==1){?>
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <?php echo $message;?>
                            </div>
                            <?php } ?>

                            <!-- erro display end here -->


                                <form action="<?php echo site_url('admin/Customer/update_customer?id='.$userlist->id);?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="panel-body form-group-separated">
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">First Name</label>
                                        <div class="col-md-6 col-xs-12">     
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="first_name" class="form-control" value="<?php echo $userlist->first_name;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                                        <div class="col-md-6 col-xs-12">     
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="last_name" class="form-control" value="<?php echo $userlist->last_name;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">DOB</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="date" name="dob" class="form-control" value="<?php echo $userlist->dob;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Enter E-mail</label>
                                        <div class="col-md-6 col-xs-12">       
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="email" name="email" class="form-control" value="<?php echo $userlist->email;?>" readonly style="color:black;"/>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Enter Mobile Number</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="mobile_no" class="form-control" value="<?php echo $userlist->mobile;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Gender</label>
                                        <div class="col-md-6 col-xs-12">                     
                                            <select class="form-control select" name="gender">
                                                <option>Select</option>
                                                <option value="male"<?php if($userlist->gender=='male') echo 'selected="selected"';?>>Male</option>
                                                <option value="female" <?php if($userlist->gender=='female') echo'selected="selected"';?>>Female</option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Address</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="address" class="form-control" value="<?php echo $userlist->address;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">about</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="about" class="form-control" value="<?php echo $userlist->about;?>" required/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Photo</label>
                                        <div class="col-md-6 col-xs-12">                      
                                            <input type="file" class="fileinput btn-primary" name="image" id="filename" title="Browse file" accept="image/jpeg"/>
                                        <img src="<?php echo base_url('upload/'.$userlist->user_image);?>" width="50px" height="50px">
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                    <input type="hidden" name="img" value="<?php echo $userlist->user_image;?>">
                                    <input type="hidden" name="id" value="<?php echo $userlist->id;?>">
                                    <input type="submit" name="update" value="Update" class="btn btn-success pull-right" style="width:250px;">
                                </div>
                              </div>
                            </form>                         
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->  
 
<?php $this->load->view('layout/footer');?> 
    





