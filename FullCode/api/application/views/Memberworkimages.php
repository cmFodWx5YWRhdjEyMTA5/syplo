<?php
//echo json_encode($AnotherServices);die();
 $data['page']='two'; $this->load->view('layout/header',$data);?> 


            <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                  <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Work</strong>Images</h3>     
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
                                <div class="image">
                                <?php foreach ($workimages as $images) { 
                                	$i=1;
                                	if($images->type!='')
                                	{ $workimage =base_url('workimage/'.$images->image); }
                                	else { $workimage = $images->image;}
                                	?>
							                      	
										<a href="#" class="pop">
								        	<img src="<?php echo $workimage; ?>" style="width:200px; height:200px; margin:20px; border:1px solid black;">
								        </a>
							                                       <?php } ?>
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
          </div>

      </div>
          
          
    </div>
  </div>