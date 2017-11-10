<?php $data['page']='five'; $this->load->view('layout/header',$data);?> 
<?php if(!empty($script)) { echo $script; } ?>
            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Order</strong> <?php if(!empty($service)){ echo 'Service' ; } else { echo 'Another Service';} ?></h3>
                                                                           
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
                                         <th>Category</th>
                                         <th>Sub Category</th>
										 <th>Price</th>
                                         <th>Total Hour</th>
                                         <th>Total Cost</th>
										 <!--th>Price Type</th-->
										 <!--th style="min-width:50px; text-align:center">Editdd</th>
                                         <th style="min-width:50px; text-align:center">Delete</th-->
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										if(!empty($service)){
                                          $i=1;  
                                        foreach($service as $list) { ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->category;?></td>
                                                <td><?php echo $list->sub_category;?></td>
                                                <td><?php echo $list->price;?></td>
                                                <td><?php echo $list->total_hour;?></td>
                                                <td><?php echo $list->total_cost;?></td>
                                                
                                                <!--td><!?php if($list->price_type == '0' )
                                                    { echo 'Per hour' ;} else {  echo 'Fixed' ;} ?>
                                                </td-->
												
                                                <!--td>
                                                    <a href="<!?php echo site_url('admin/Order/service_coutomer_update/?order_service_id='.$list->id);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                    </td>
                                                    <td>
                                                     <a href="<!?php echo site_url('admin/Order/service_coutomer_delete/?order_service_id='.$list->id);?>">
                                                      <i class="fa fa-trash-o fa-fw">
                                                      <strong>Delete</strong></i>
                                                     </a>
                                                 </td-->
                                            </tr>							
											
											
                                        <?php } }
										?>
										<?php
										if(!empty($another_service)){
                                          $i=1;  
                                        foreach($another_service as $list) { ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->category;?></td>
                                                <td><?php echo $list->sub_category;?></td>
                                                <td><?php echo $list->price;?></td>
                                                <td><?php if($list->price_type == '0' ) { echo 'Per hour' ;} else {  echo 'Fixed' ;} ?></td>
												
                                                <!--td>
                                                    <a href="<!?php echo site_url('admin/Order/service_coutomer_update/?order_service_id='.$list->id);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                    </td>
                                                    <td>
                                                     <a href="<!?php echo site_url('admin/Order/service_coutomer_delete/?order_service_id='.$list->id);?>">
                                                      <i class="fa fa-trash-o fa-fw">
                                                      <strong>Delete</strong></i>
                                                     </a>
                                                </td-->
                                            </tr>
											
                                        <?php } }
										?>
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