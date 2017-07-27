<?php  $data['page']='five'; $this->load->view('layout/header',$data);?>
<div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Order Update</strong></h3>
                            <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="container-fluid">
                                <form method="post" action="<?php echo site_url('admin/Order/service_update/?order_service_id='); ?>" class="form-horizontal" enctype="multipart/form-data">
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
                                        <label class="col-md-3 col-xs-12 control-label">Freelancher Name</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
												<h3 class="panel-title"><strong><?php echo $provider_name->first_name .' '. $provider_name->last_name;?></strong></h3>
                                                
                                            </div>            
                                                
                                        </div>
                                </div>


                                  <!--div class="form-group">                                   
                                        <label class="col-md-3 col-xs-12 control-label">Price Type</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                <span class="fa fa-envelope" ></span></span>
                                               <select class="form-control select" name="service_price_type" required>
                                                <option value="0"<php if($service->price_type=='0') echo 'selected="selected"';?>>Per hour</option>
                                                <option value="1" <php if($service->price_type=='1') echo'selected="selected"';?>>Fixed</option>
                                            </select>
                                            </div>            
                                        </div>
                                    </div---->
                                

                                   
                                <div class="panel-footer">
                                    <div class="row">                                  
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