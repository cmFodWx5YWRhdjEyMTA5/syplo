<?php $data['page']='two'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Registered</strong> Company</h3>
                                                                           
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
                                            <th>Company Name</th>
                                            <th>Email</th>
                                            <th>image</th>
                                           
                                            <th style="min-width:50px; text-align:center">Member</th>
                                            <th style="min-width:50px; text-align:center">Member other details</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                          $i=1;  
                                        foreach($userlist as $list) {
                                        $id     = $list->id;

                                        if($list->approve_status==0)
                                        { $stat = 1;}
                                        else{$stat=0;}                                          
                                                                                
                                        if($list->approve_status==1)
                                        { $status='Approved'; }
                                        else
                                        { $status ='Not Approve';}

                                         ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo $list->company_name;?></td>            
                                                <td><?php echo $list->email;?></td>                    
                                                <td><?php echo "<img src=".base_url()."upload/".$list->user_image." width='60px' height='60px'>";?></td>
                                                <td><a href="<?php echo site_url('admin/Company/memberList?id='.$list->id);?>">
                                                    <input type="button" value="Members" style="background: rgba(72, 74, 72, 0.76);color: white; line-height: 2; width: 100%;">
                                                </a></td>
                                                <td align="center"><a href="<?php echo site_url('admin/Company/Other_Details?id='.$list->id);?>">
                                                    <input type="button" value="Member Other details" style="background: rgba(72, 74, 72, 0.76);color: white; line-height: 2;">
                                                </a></td>
                                                    
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