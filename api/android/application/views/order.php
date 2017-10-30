<?php $data['page']='five'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Order</strong> List</h3>
                                                                           
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

                                    <?php if(isset($success)==1){ ?>
                                    <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>        
                                    <?php } else if(isset($error)==1) { ?>
                                    <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $message;?>
                                    </div>
                                    <?php }?>     
                                </div>                                
                                <div class="panel-body">
                                    <div class="table-responsive">
                                    <div style="overflow:scroll; height:600px;">
                                     <table id="customers2" class="table datatable">
                                        <thead>
                                         <tr>
                                        <th>Sr.No</th>
                                            <th>Provider Name</th>
                                            <th>Customer Name</th>
											<th>Order Date</th>
											<th>Order Time</th>
											<th>Address Type</th>
                                            <th>Address</th>
											<th>Approve Status</th>
                                            <th>Order Status</th>
                                            <th style="text-align:center;">Provider Cancel Policy</th>
											<th>Service</th>
											<th>Another Service</th>
                                            <th style="text-align:center;">Transaction Details</th>
                                            <!--th style="min-width:50px; text-align:center">Edit</th>
                                            <th style="min-width:50px; text-align:center">Delete</th-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $i=1;  
                                        foreach($userlist as $list) { ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list['provider_name'];?></td>
                                                <td><?php echo $list['customer_name'];?></td>
                                                <td><?php echo $list['order_date'];?></td>
                                                <td><?php echo $list['order_time'];?></td>
												<td><?php if($list['address_type'] == '0') { echo 'Provider Add'; }  else { echo 'Customer Add';} ?></td>   
												<td><?php echo $list['address'];?></td>
                                                <td><?php if($list['approve_status'] == '0') { echo 'Not Accept'; } elseif($list['approve_status'] == '1') { echo 'Accept' ;} else { echo 'Reject' ; }?></td>
												<td><?php if($list['order_status'] == '1') { echo 'Done'; } else { echo 'Not Done' ;}?></td>

                                                <td><?php if($list['cancel_policy'] == '0') { echo 'Moderate'; } elseif($list['cancel_policy'] == '1') { echo 'Flexible' ;} else { echo 'Strict' ; }?></td>

                            
												<td><a href="<?php echo site_url('admin/Order/service_coutomer/?order_id='.$list['order_id']);?>" >View Service</a></td>

												<td><a href="<?php echo site_url('admin/Order/another_service_coutomer/?order_id='.$list['order_id']);?>" >View Another Service</a></td>

                                                <td><a href="<?php echo site_url('admin/Order/trans_detail?order_id='.$list['order_id']);?>" >Get Detail</a></td>


                                                                    
                                                <!--td><php echo "<img src=".base_url()."upload/".$list->user_image." width='60px' height='60px'>";?></td>
                                                <td><php echo $list->created_at;?></td-->
                                               
                                                <!--td>
                                                    <a href="<!?php echo site_url('admin/Order/update_order/?order_id='.$list['order_id']);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                </td-->

                                                <!--td>
                                                    <a href="<!?php echo site_url('admin/Order/delete_order/?order_id='.$list['order_id']);?>">
                                                    <i class="fa fa-trash-o fa-fw">
                                                    <strong>Delete</strong></i>
                                                    </a>
                                                </td-->
                                            </tr>
                                        <?php } ?>
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
<?php if(!empty($script)) { echo $script; } ?>
<!---script>
function approve(which){
	var id=which;
	alert(which);
	 $.ajax({
        type: "GET",
        url: 'http://hireoutsource.com/syplo/api/index.php/admin/Freelancer/approved',
		data: {'id':id},
        dataType: "text",
        success: function (data) { 
		console.log(data);
		}
		
    });
}
</script---->