<!--?php if(isset($error)){echo $message;die();}?-->
<?php $data['page']='seven'; $this->load->view('layout/header',$data);?>
<!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update Discount</strong> Code </h3>

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
                            <form method="post" action="<?php echo site_url('admin/Discount/update_discount?id='.$userData->id);?>" class="form-horizontal">

                            <div class="panel-body form-group-separated">
                                <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Discount type </label>
                                    <div class="col-md-6 col-xs-12">                     
                                        <select class="form-control" required title="Select atlest one type" name="discount_type" >
                                            <option value="">Select Discount Type</option>
                                            <?php if($userData->discount_type==1) {?>
                                                <option value="1" <?php if($userData->discount_type==1){echo "selected=selected";}?>>Referral discount</option>
                                            <?php } else{ ?>
                                           <option value="0" <?php if($userData->discount_type==0){echo "selected=selected";}?>>General discount</option>
                                            <option value="2" <?php if($userData->discount_type==2){echo "selected=selected";}?>>Sponsor discount</option>
                                            <?php }?>
                                        </select>                                            
                                    </div>
                                </div>
                            <?php if($userData->discount_type!=1) { ?> 
                            <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Discount code</label>
                            <div class="col-md-6 col-xs-12">        
                                <div class="input-group">
                                    <span class="input-group-addon">
                                    <span class="fa fa-pencil"></span></span>
                                    <input type="text" name="code" class="form-control" value="<?php echo $userData->code; ?>"  required />
                                </div>                                            
                            </div>
                            </div> 

                            <div class="form-group">            
                                <label class="col-md-3 col-xs-12 control-label">Enter Expire Date</label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                        <input type="text" name="expire" value="<?php echo $userData->expiredate; ?>" class="form-control datepicker" required/>
                                    </div>            
                                </div>
                            </div>  

                            <?php } else
                            { ?>
                                <input type="hidden" name="code" value=''>
                                <input type="hidden" name="expire" value=''>

                            <?php }?>                                                

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Discount</label>
                                    <div class="col-md-6 col-xs-12">        
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="number" name="discount" value="<?php echo $userData->discount; ?>" class="form-control" required />
                                        </div>                                            
                                    </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Type</label>
                                <div class="col-md-6 col-xs-12">                     
                                    <select class="form-control" required title="Select atlest one type" name="type" >
                                        <option value="">Select Discount Amount Type</option>
                                        <option value="0" <?php if($userData->type==0){echo "selected=selected";}?>>In Percentile</option>
                                        <option value="1" <?php if($userData->type==1){echo "selected=selected";}?>>In Currency</option>
                                    </select>                                            
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








