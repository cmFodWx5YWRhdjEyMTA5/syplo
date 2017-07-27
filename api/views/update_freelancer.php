<?php $data['page']='four'; $this->load->view('layout/header',$data);?> 
<!-- PAGE CONTENT WRAPPER -->

                <div class="page-content-wrap">
                
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Update</strong>&nbsp;Freelancer</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>

                            <!-- erro display here -->

                            <?php if(isset($error)&& $error==1) { ?>
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $message;?>
                            </div>
                            <?php } if(isset($success)&& $success==1){?>
                            <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <?php echo $message;?>
                            </div>
                            <?php } ?>

                            <!-- erro display end here -->


                                <form action="<?php echo site_url('admin/Freelancer/update_Freelancer?id='.$userlist->id);?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="panel-body form-group-separated">
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">First Name</label>
                                        <div class="col-md-6 col-xs-12">     
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="first_name" class="form-control" value="<?php echo $userlist->first_name;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                                        <div class="col-md-6 col-xs-12">     
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="last_name" class="form-control" value="<?php echo $userlist->last_name;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">DOB</label>
                                        <div class="col-md-6 col-xs-12">                                            
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="date" name="dob" class="form-control" value="<?php echo $userlist->dob;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Enter E-mail</label>
                                        <div class="col-md-6 col-xs-12">       
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="email" name="email" class="form-control" value="<?php echo $userlist->email;?>" readonly style="color:black;"/>
                                            </div>                                           
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Enter Mobile Number</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="mobile_no" class="form-control" value="<?php echo $userlist->mobile;?>"/>
                                            </div>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Gender</label>
                                        <div class="col-md-6 col-xs-12">                     
                                            <select class="form-control select" name="gender" required>
                                                <option value="male"<?php if($userlist->gender=='male') echo 'selected="selected"';?>>Male</option>
                                                <option value="female" <?php if($userlist->gender=='female') echo'selected="selected"';?>>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Address</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="address" class="form-control" value="<?php echo $userlist->address;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">about</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="about" class="form-control" value="<?php echo $userlist->about;?>" required/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									<!----div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Start time</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="start_time" class="form-control" value="<php echo $userlist->start_time;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">End time</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="end_time" class="form-control" value="<php echo $userlist->end_time;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div----->
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Current workplace</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="current_workplace" class="form-control" value="<?php echo $userlist->current_workplace;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Previous workplace</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="previous_workplace" class="form-control" value="<?php echo $userlist->previous_workplace;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									<?php $array =  explode(':', $userlist->start_time);
									$arraysecond =  explode(':', $userlist->end_time);
									?>
									<!----div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Availability</label>
                                        
                          <div class="col-md-3" style="margin-right:0px;"> 
                              <input type="radio" id="radio11" name="availability" value="1" data-error="#errNm1">
                              <span style="margin-left:10px;"> Dygnet Address</span>
                          </div>                 
                           <div class="col-md-3" style="" id="availability_in">          
                           <input type="radio" id="radio10" name="availability" value="2" id="avalable">
                           <span style="margin-left:10px;">Set Availability</span>
                           </div>
						   </div--->
									<!----div class="form-group">
                           <div class="radioshow">
						    <div class="col-md-3"></div>
                              <div class="col-md-2">
                                 <center><span style="color:#0d3c55 !important;font-weight:bold;font-size:12px; align:center">Start Time</span></center>
									<center>
                  <select name="str_hh" class="text_option" style="padding:5px; border-radius: 4px; display: inline-block;  overflow:hidden"required>
				                        <option value="<php echo $array[0]; ?>"><php echo $array[0]; ?></option>
										<option value="00">00</option>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
									</select> 
									<span> : </span>
									<select name="str_mm" style="padding:5px; border-radius: 4px;" required>
									 <option value="<php echo $array[1]; ?>"><php echo $array[1]; ?></option>
									    <option value="00">00</option>
										<option value="05">05</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
										<option value="30">30</option>
										<option value="35">35</option>
										<option value="40">40</option>
										<option value="45">45</option>
										<option value="50">50</option>
										<option value="55">55</option>
										<option value="60">60</option>
									</select>
                  </center>
                                 </div>
                              <div class="col-md-2">
                                    <center><span style="color:#0d3c55 !important;font-weight:bold;font-size:12px; align:center">End Time</span></center>
									<center>
									<select name="end_hh" style="padding:5px; border-radius: 4px;" >arraysecond
									<option value="<php echo $arraysecond[0]; ?>"><php echo $arraysecond[0]; ?></option>
										<option value="00">00</option>
										<option value="01">01</option>
										<option value="02">02</option>
										<option value="03">03</option>
										<option value="04">04</option>
										<option value="05">05</option>
										<option value="06">06</option>
										<option value="07">07</option>
										<option value="08">08</option>
										<option value="09">09</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										<option value="13">13</option>
										<option value="14">14</option>
										<option value="15">15</option>
										<option value="16">16</option>
										<option value="17">17</option>
										<option value="18">18</option>
										<option value="19">19</option>
										<option value="20">20</option>
										<option value="21">21</option>
										<option value="22">22</option>
										<option value="23">23</option>
									</select>
									<span> : </span>
									<select name="end_mm" style="padding:5px; border-radius: 4px;" required>
									<option value="<php echo $arraysecond[1]; ?>"><php echo $arraysecond[1]; ?></option>
									   <option value="00">00</option>
										<option value="05">05</option>
										<option value="10">10</option>
										<option value="15">15</option>
										<option value="20">20</option>
										<option value="25">25</option>
										<option value="30">30</option>
										<option value="35">35</option>
										<option value="40">40</option>
										<option value="45">45</option>
										<option value="50">50</option>
										<option value="55">55</option>
										<option value="60">60</option>
									</select>
                           </center>      </div>
                              <div class="col-md-3" id="">  
                              <center><span style="color:#0d3c55 !important;font-weight:bold;font-size:12px;">Select Days</span>  </center>   
                                      <center>    
                             									   
                                  <select name="days[]" multiple class="form-group select" title="Select Days" id="select_id" required>
								      <option value="default"></option>
                                      <option value="0">Sunday</option>
                                      <option value="1">Monday</option>
                                      <option value="2">Tuesday</option>
                                      <option value="3">Wednesday</option>
                                      <option value="4">Thursday</option>
                                      <option value="5">Friday</option>
                                      <option value="6">Saturday</option>
                                  </select>   
								  </center>
                              </div>
							  
                           </div>
										
                                    </div---->
                                     <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Acceptance</label>
                                        <div class="col-md-6 col-xs-12"> 
										
                                              <select class="form-control select " name="acceptance" required>
                                                <option value="0"<?php if($userlist->acceptance=='0') echo 'selected="selected"';?>>Instant</option>
                                                <option value="1" <?php if($userlist->acceptance=='1') echo'selected="selected"';?>>Pre-approval</option>
                                            </select> 
                                        </div>
                                    </div>
									 <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Show position</label>
                                        <div class="col-md-6 col-xs-12"> 
										<select class="form-control select" name="show_position" required>
                                                <option value="0"<?php if($userlist->show_position=='0') echo 'selected="selected"';?>>Off</option>
                                                <option value="1" <?php if($userlist->show_position=='1') echo'selected="selected"';?>>On</option>
                                            </select> 
                                        </div>
                                    </div>
									 <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Experience</label>
                                        <div class="col-md-6 col-xs-12">   
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="experience" class="form-control" value="<?php echo $userlist->experience;?>"/>
                                            </div>                                            
                                            
                                        </div>
                                    </div>
									<div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Photo</label>
                                        <div class="col-md-6 col-xs-12">                      
                                            <input type="file" class="fileinput btn-primary" name="image" id="filename" title="Browse file" accept="image/jpeg"/>
                                        <img src="<?php echo base_url('upload/'.$userlist->user_image);?>" width="50px" height="50px">
                                        </div>
                                    </div>
                                    <div class="panel-footer">
                                    <input type="hidden" name="img" value="<?php echo $userlist->user_image;?>">
                                    <input type="hidden" name="id" value="<?php echo $userlist->id;?>">
                                    <input type="submit" name="update" value="Update" class="btn btn-success pull-right" style="width:250px;">
                                </div>
                              </div>
                            </form>                         
                        </div>
                    </div>                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->  
 
<?php $this->load->view('layout/footer');?> 
    
<script>
$(document).ready(function(){
   $("#radio10").click(function(){
       $(".radioshow").show(500);
   });
   $("#radio11").click(function(){
      $("#str").val(' ');
      $("#end").val(' ');
       $(".radioshow").hide(500);
   });
});
</script>




