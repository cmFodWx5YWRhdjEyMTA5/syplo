<?php
//echo json_encode($AnotherServices);die();
 $data['page']='two'; $this->load->view('layout/header',$data);?> 

            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Certificate</strong>Images</h3>     
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
                                <div>
                                  <div class="col-md-2" style="margin-top: 10px; font-weight:500px; font-size:16px;">About Certificate</div>
                                <div class="col-md-10" style="border:1px solid black;height: 50px;   overflow-y: scroll;">
                                      <?php if(!empty($about)){echo $about->about;} ?>                                   
                                  </div>
                                </div>
                                <div class="clearfix" style="height:3px;clear: both;"></div>

                              <hr>
                                <div class="image">
                                <div class="col-md-12">
                                <?php foreach ($certificates as $images) { $i=1; 
                                  if($images->approve_status==1)
                                  { $status='Approved'; }
                                  else
                                  { $status ='Not Approve';}

                                  ?>
                                  <div class="col-md-3">   
                                    <div class="col-md-12">                                       
                                      <a href="#" class="pop">
                                      <img src="<?php echo base_url('certificateimage/'.$images->image); ?>" style="width:200px; height:200px; margin:20px; border:1px solid black;">
                                      </a>
                                    </div>
                                    <div class="col-md-12">  
                                      <input class="btn btn-success" id="status<?php echo $images->id; ?>" onclick="approve(<?php echo $images->id; ?>)" type="button" value="<?php echo $status;?>" style="margin-left:20px; width:200px;">  
                                  </div>                
                                </div>
                                <?php } ?>
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
  //alert(id);
  //alert("Do you realy want to perform this action?");
   $.ajax({
        type: "GET",
        url: "<?php echo site_url('admin/Freelancer/certificate_approved');?>",
        data: {'id':id},
        dataType: "text",
        success: function (data)
        { 
          alert('Status has been successly changed');   
          $('#status'+id).val(data);
           // location.reload();
       //console.log(data);
    }
    
    });
}
</script>



<script>
$(function() {
    $('.pop').on('click', function() {
      $('.imagepreview').attr('src', $(this).find('img').attr('src'));
      $('#imagemodal').modal('show');   
    });   
});
</script>
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" data-dismiss="modal">
    <div class="modal-content"  >              
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div> 
      <div class="modal-footer">
          <div class="col-xs-12">
          <!--    Content         -->
          <button type="button" class="close" data-dismiss="modal">Close</button>
          </div>

      </div>
          
          
    </div>
  </div>

