<?php $data['page']='two'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Actual Service</strong>Price</h3>
                                                                           
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
                                                <th>Subcategory</th>
                                                <th>Price</th>
                                                <th>Price Type</th>
                                                <th>Time stamp</th>
                                                <th>Update Stamp</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $i=1;  
                                        foreach($Servicelist as $list) { ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->category;?></td>
                                                <td><?php echo $list->sub_category;?></td>
                                                <td><?php echo $list->price; ?></td>
                                                <td><?php if($list->pricetype==1){
                                                 echo "Fixed";} else {echo "Per hour";} ?></td>
                                                <td><?php echo $list->created_at; ?></td>
                                                <td><?php echo $list->update_at; ?></td>
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