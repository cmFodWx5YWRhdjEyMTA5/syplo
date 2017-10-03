<?php  $data['page']='nine'; $this->load->view('layout/header',$data);?>
<div class="page-content-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Service Update</strong></h3>
                            <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="container-fluid">
                                <form method="post" action="<?php echo site_url('admin/service/service_id_update/?id='.$service->id); ?>" class="form-horizontal" enctype="multipart/form-data">
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
                                        <label class="col-md-3 col-xs-12 control-label">Category Name</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="category" value="<?php echo $service->category;?>" class="form-control"/>
                                            </div>            
                                                
                                        </div>
                                </div>

                                 <div class="form-group">                                   
                                        <label class="col-md-3 col-xs-12 control-label">Subcategory Name</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="sub_category" value="<?php echo $service->sub_category;?>" class="form-control"/>
                                            </div>            
                                                
                                        </div>
                                </div>
                                   

                                   
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