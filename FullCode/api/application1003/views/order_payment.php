<?php $data['page']='five'; $this->load->view('layout/header',$data);?> 
<?php if(!empty($script)) { echo $script; } ?>
            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Order</strong> Payment Detail</h3>
                                                                           
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
                                         <th>Order id</th>
                                         <th>Transaction Id</th>
                                         <th>Service Charge</th>
                                         <th>Discount</th>
                                         <th>Type</th>
                                         <th>Discount Type</th>
										 <th>Total Charge</th>
										 <th>Transaction Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										if(!empty($payment)){
                                          $i=1;  
                                          $discount_type='';
                                          $type ='';
                                        foreach($payment as $list) {
                                           if($list->discount_id!=0)
                                           {
                                                foreach ($discount as $dis)
                                                {
                                                    if($dis->id==$list->discount_id)
                                                    {
                                                        $discount_type =$dis->discount_type;
                                                    }
                                                }                                               
                                                if($discount_type==1)
                                                {
                                                    $discount_type='Referral';
                                                }
                                                else
                                                {
                                                    $discount_type='General';
                                                }
                                                if($list->type==0){ $type = "Percentile";}
                                                else {$type = "Currency";}
                                            }
                                            ?>

                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->order_id;?></td>
                                                <td><?php echo $list->transaction_id;?></td>
                                                <td><?php echo $list->bill_amount;?></td>
                                                <td><?php echo $list->discount;?></td>
                                                <td><?php echo $type; ?></td>
                                                <td><?php echo $discount_type;?></td>
                                                <td><?php echo $list->gross_amount;?></td>
                                                <td><?php echo $list->transaction_status;?></td>
                                            </tr>						
                                            <?php } } ?>										
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