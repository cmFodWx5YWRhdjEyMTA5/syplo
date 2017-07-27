<!--?php if(isset($error)){echo $message;die();}?-->
<?php $data['page']='setting'; $this->load->view('layout/header',$data);?>
<!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update Commission</strong></h3>

                            <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                        <div class="container">  
                                    
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

                       <?php
                       $type='';
                       if($userData->type==0){$type ='Bronze';}
                       if($userData->type==1){$type ='Silver';}
                       if($userData->type==2){$type = 'Gold'; }?>

                        <form method="post" action="<?php echo site_url('admin/Discount/updateCommission?id='.$userData->id);?>" class="form-horizontal">
                            <div class="panel-body form-group-separated">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Discount type </label>
                                    <div class="col-md-6 col-xs-12">        
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="type" value="<?php echo $type; ?>" class="form-control" readonly style="color:black;" />
                                        </div>                                            
                                    </div>
                                    
                                </div>
                                                                        

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Commission <strong>(in %)</strong></label>
                                    <div class="col-md-6 col-xs-12">        
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="number" name="commission" value="<?php echo $userData->commission; ?>" class="form-control" required />
                                        </div>                                         
                                    </div>
                            </div>

                            <div class="panel-footer" style="margin-top:20px;">
                                <div class="row">
                                    <div class="col-md-6">
                                         <input type="reset" class="btn btn-success" value="Form Reset" style="margin:5px 0; max-width:300px; width:100%;">
                                    </div>                                   
                                    <div class="col-md-6">
                                        <input type="submit" name="submit" value="Submit" class="btn btn-success pull-right" style="max-width:300px; margin:2px 0; width:100%;">
                                    </div>                                    
                                </div>
                                   
                            </div>
                        </div>
                    </form>                         
                        </div>
                    </div>
                </div>                    
             </div>
                <!-- END PAGE CONTENT WRAPPER -->  
 
<?php $this->load->view('layout/footer');?> 








