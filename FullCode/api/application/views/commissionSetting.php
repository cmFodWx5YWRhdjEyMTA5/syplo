<?php 
$data['page']='setting'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Commission</strong> List</h3> 
                                    <div class="btn-group pull-right">
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'excel',escape:'false'});"><img src='<?php echo base_url();?>/assest/img/icons/xls.png' width="24"/> XLS</a></li>
                                            
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'png',escape:'false'});"><img src='<?php echo base_url();?>/assest/img/icons/png.png' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#customers2').tableExport({type:'pdf',escape:'false'});"><img src='<?php echo base_url();?>/assest/img/icons/pdf.png' width="24"/> PDF</a></li>
                                        </ul>
                                    </div> 

                                    <?php if(isset($success) && $success==1){ ?>
                                    <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>        
                                    <?php }if(isset($error) && $error==1) { ?>
                                    <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>
                                    <?php }?>     
                                </div>                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <div style="overflow:scroll; height:600px;">
                                     <table class="table datatable">
                                        <thead>
                                            <tr>
                                            <th>Sr.No</th>
                                            <th>Commission Type</th>
                                            <th>Commission</th>
                                            <th>Update_at</th>
                                            <th>Edit Commission</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(isset($commissionlist))
                                        {
                                         $i=1;  
                                        foreach($commissionlist as $list) { 
                                        $id     = $list->id;

                                        if($list->type==0)
                                        { $type ='Bronze'; }
                                        else if($list->type==1)
                                        { $type ='Silver'; }
                                        else{ $type ='Golden'; }
                                        ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><strong><?php echo $type;?></strong></td>
                                                <td><?php echo $list->commission;?></td>
                                                <td><?php echo $list->update_at;?></td>
                                                <td>
                                                    <a href="<?php echo site_url('admin/Discount/updateCommission?id='.$list->id);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                </td>
                                                
                                          </tr>
                                        <?php }} ?>
                                        </tbody>
                                       
                                    </table>
                                    </div>                                   
                                    </div>
                                </div>
                            </div>
                            <!-- END DATATABLE EXPORT -->
                        </div>
                    </div>
                </div>     
                <!-- END PAGE CONTENT WRAPPER -->

<?php $this->load->view('layout/second_footer');?> 
