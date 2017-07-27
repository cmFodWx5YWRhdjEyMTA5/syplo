<?php 
// print_r($discountlist);die();
$data['page']='seven'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Discount</strong> List</h3> 
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
                                            <th>Discount Type</th>
                                            <th>Discount Code</th>
                                            <th>Discount</th>
                                            <th>Expire Date</th> 
                                            <th>Status</th>                       
                                            <th>Edit</th>
                                            <th>Delete</th>
                                            <th>Creat_at</th>
                                            <th>Update_at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(isset($discountlist))
                                        {
                                         $i=1;  
                                         foreach($discountlist as $list) { 
                                        if($list->status==0){$stat = 1;}
                                        else{$stat=0;}                                          
                                        $id     = $list->id;
                                        if($list->discount_type==0)
                                        { $type ='General'; }
                                        else if($list->discount_type==1)
                                        { $type ='Referral'; }
                                        else{ $type ='Sponser'; }
                                        if($list->status==1)
                                        { $status='Active'; }
                                        else
                                        { $status ='Expire';}
                                        ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>

                                                <td><?php echo $type;?></td>
                                                <td><?php echo $list->code;?></td>
                                                <td><?php echo $list->discount;?></td>
                                                <td><?php echo $list->expiredate;?></td>

                                                 <td>
                                                <?php if($list->discount_type!=1){ ?>
                                                <input class="btn btn-success" type="button" id="status" onclick="status_update(<?php echo $stat; ?>,<?php echo $id; ?>)" name="status" value="<?php echo $status;?>">
                                                <?php } else {echo "<strong>Active</strong>";} ?>
                                                </td>


                                                                                  
                                                <td>
                                                    <a href="<?php echo site_url('admin/Discount/update_discount?id='.$list->id);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                </td>
                                                <td>
                                                    <?php if($list->discount_type!=1){ ?>
                                                     <a href="<?php echo site_url('admin/Discount/delete?id='.$list->id);?>">
                                                      <i class="fa fa-trash-o fa-fw">
                                                      <strong>Delete</strong></i>
                                                     </a>
                                                      <?php } ?>
                                                 </td>
                                                 <td><?php echo $list->creat_at;?></td>
                                                <!--<td><!?php echo $list->zipcode;?></td-->
                                                <td><?php echo $list->update_at;?></td>
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
 <script>
 function status_update(state,id)
 {  
     $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/Discount/update_status'); ?>",
            data: {id :id, status:state},
            success: function(data){
                $('#status').val(data);
                //console.log(data);
                location.reload();
             }
        });
    //alert(id);
 }
</script>
<?php $this->load->view('layout/second_footer');?> 
