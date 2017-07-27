<?php $data['page']='two'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Member</strong> List</h3>
                                                                           
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
                                            <th>First_Name</th>
                                            <th>Last_Name</th>
                                            <th>DOB</th>
                                            <th>Address</th>
											<th>Address acceptance</th>
											<th>Provider address</th>
											<th>Show position</th>
                                            <th>Mobile No.</th>
											<th>Availability</th>
											<th>Start time</th>
											<th>End time</th>
											<th>Cancelling policy</th>
											<th>Acceptance</th>
                                            <th>Email</th>
											<th>Gender</th>
											<th>About</th>
											<th>Previous workplace</th>
											<th>Current workplace</th>
											<th>Experience</th>
                                            <th>Accept term</th>
											<th>Approved status</th>
                                            <th>image</th>
                                            <th>Created_at</th>
                                            <th style="min-width:50px; text-align:center">Edit</th>
                                            <th style="min-width:50px; text-align:center">Delete</th>
                                        </tr>
                                        </thead>
                                    <tbody>
                                        <?php
                                          $i=1;  
                                        foreach($member_data as $list) { 
                                        $id     = $list->id;

                                        if($list->approve_status==0)
                                        { $stat = 1;}
                                        else{$stat=0;}                                          
                                                                                
                                        if($list->approve_status==1)
                                        { $status='Not Approve Here'; }
                                        else
                                        { $status ='Approve Here';}



                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->first_name;?></td>
                                                <td><?php echo $list->last_name;?></td>
                                                <td><?php echo $list->dob;?></td>
                                                <td><?php echo $list->address;?></td>
												<td><?php if($list->address_acceptance == '0') { echo 'Provider Add'; }  elseif($list->address_acceptance == '1') { echo 'Customer Add';} else { echo 'both';} ?></td>
												<td><?php echo $list->provider_address;?></td>
												<td><?php if($list->show_position == '0'){ echo 'Off';} else { echo 'On'; }?></td>
                                                <td><?php echo $list->mobile;?></td>         
												<td><?php if($list->availability == '1') { echo 'Always';} else { echo 'Select time';} ?></td> 
												<td><?php echo $list->start_time;?></td> 
												<td><?php echo $list->end_time;?></td> 
												<td><?php if($list->canceling_policy == '1') { echo 'Flexible'; } else { echo 'Strict';}?></td> 
											    <td><?php if($list->acceptance == '0') { echo 'Instant' ;} else { echo 'Pre-approval' ;}?></td> 
                                                <td><?php echo $list->email;?></td>
												<td><?php echo $list->gender;?></td>
                                                <td><?php echo $list->about;?></td>
                                                <td><?php echo $list->previous_workplace;?></td>
                                                <td><?php echo $list->current_workplace;?></td>
                                                <td><?php echo $list->experience;?></td>
                                                <td><?php echo $list->accept_term;?></td>

                                                <td>
                                                    <input class="" type="button" id="status<?php echo $id; ?>" onclick="approve(<?php echo $id; ?>)" name="status" value="<?php echo $status;?>">
                                                </td>            
                                                <!--<td><!?php echo $list->zipcode;?></td-->                    
                                                <td><?php echo "<img src=".base_url()."upload/".$list->user_image." width='60px' height='60px'>";?></td>
                                                <td><?php echo $list->created_at;?></td>
                                               
                                                <td>
                                                    <a href="<?php echo site_url('admin/Company/update_member?id='.$list->id);?>">
                                                    <i class="fa fa-pencil fa-fw"><strong>Edit</strong>
                                                    </i></a>
                                                </td>
                                                <td>
                                                     <a href="<?php echo site_url('admin/Company/delete?id='.$list->id);?>">
                                                      <i class="fa fa-trash-o fa-fw">
                                                      <strong>Delete</strong></i>
                                                     </a>
                                                </td>
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

<script>
function approve(which){
	var id=which;
	confirm("Do you realy want to perform this action");
	 $.ajax({
        type: "GET",
        url: "<?php echo site_url('admin/Freelancer/approved');?>",
		data: {'id':id},
        dataType: "text",
        success: function (data) { 
        //location.reload();
        $('#status'+id).val(data);
		//console.log(data);
		}
		
    });
}
</script>