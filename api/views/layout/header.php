<!--?php echo $this->session->userdata('status');?> -->
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Syplo</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
               
        <link rel="SHORTCUT ICON" href="<?php echo base_url('assest/img/Untitled-3.png');?>" type="image/png" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>assest/css/theme-default.css">
        <!-- EOF CSS INCLUDE -->        
                                
    </head>
    <body>
            <!-- START PAGE CONTAINER -->
        <div class="page-container">
        
            <!-- START PAGE SIDEBAR -->
            <?php if($this->session->userdata('status')=='admin'){ ?>
                <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="<?php echo base_url('index.php/admin/');?>">Syplo</a>
                        <a href="#" class="x-navigation-control"></a>
                    </li>
                    <li class="xn-profile">
                        <a href="#" class="profile-mini">
                            <?php 
                                $image= $this->session->userdata('img');
                                $name = $this->session->userdata('name');
                            ?>
                            <img src="<?php echo base_url('upload/'.$image);?>" alt="<?php echo $name; ?>"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="<?php echo base_url('upload/'.$image); ?>" alt="<?php echo $name; ?>"/>
                          </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $name; ?></div>
                            </div>
                         </div>                                                                     
                    </li>

                    <li class="xn-title">Navigation</li>
                    <li class="xn-envlop <?php if(isset($page) && $page=='three'){ echo 'active';}?>">
                        <a href="<?php echo site_url('admin/Customer');?>"><span class="fa fa-user"></span><span class="xn-text">Customer</span></a>
                    </li>
                    <li class="xn-openable <?php if(isset($page) && $page=='two'){ echo 'active';}?>">
                        <a href="<?php echo site_url('admin/Company');?>"><span class="fa fa-table"></span> <span class="xn-text">Company</span></a>
                        <ul> 
                           <li><a href="<?php echo site_url('admin/Company');?>"><span class="fa fa-sort-alpha-desc"></span><span class="xn-text">Company List</span></a></li>
                            <li><a href="<?php echo site_url('admin/Company/members');?>"><span class="fa fa-sort-alpha-desc"></span><span class="xn-text">Member List</span></a></li>
                        </ul>
                    </li> 


                    <!--li class="xn-envlop <!?php if(isset($page) && $page=='two'){ echo 'active';}?>">
                        <a href="<!?php echo site_url('admin/Company/');?>"><span class="fa fa-table"></span><span class="xn-text">Company</span></a>
                    </li-->

                    <li class="xn-openable <?php if(isset($page) && $page=='four'){ echo 'active';}?>">
                        <a href="tables.php"><span class="fa fa-table"></span> <span class="xn-text">Freelnacer</span></a>
                        <ul>                            
                           <li>
                                <a href="<?php echo site_url('admin/Freelancer');?>"><span class="fa fa-table"></span><span class="xn-text">Basic Detials</span>
                                </a>
                           </li>
                           <li><a href="<?php echo site_url('admin/Freelancer/Other_Details');?>">
                               <span class="fa fa-sort-alpha-desc"></span>
                               <span class="xn-text">Other Details</span></a>
                           </li>
                        </ul>
                    </li>
                    
                    
                    
                     <li class="xn-openable <?php if(isset($page) && $page=='nine'){ echo 'active';}?>">
                        <a href="tables.php"><span class="fa fa-table"></span> <span class="xn-text">Service System</span></a>
                        <ul>                            
                           <li><a href="<?php echo site_url('admin/Service/add_Service');?>"><span class="fa fa-user"></span>Add Service</a></li>
                          <li><a href="<?php echo site_url('admin/Service');?>"><span class="fa fa-table"></span><span class="xn-text">Service List</span></a> </li>

                          <li><a href="<?php echo site_url('admin/Service/another_service');?>"><span class="fa fa-table"></span><span class="xn-text">Another Service</span></a>
                        </li>
                        </ul>
                    </li>               
                    
 
                    <li class="xn-envlop <?php if(isset($page) && $page=='five'){ echo 'active';}?>">
                        <a href="<?php echo site_url('admin/Order');?>"><span class="fa fa-shopping-cart"></span><span class="xn-text">Order</span><label class="badge" id="rowcount" style="background-color:green !important; margin-left: 10px; border-radius:90% !important"></label></a>
                    </li> 

                    <li class="xn-openable <?php if(isset($page) && $page=='seven'){ echo 'active';}?>">
                        <a href="tables.php"><span class="fa fa-user"></span> <span class="xn-text">Discount System</span></a>
                        <ul>                            
                           <li><a href="<?php echo site_url('admin/Discount/add_discount');?>"><span class="fa fa-user"></span>Add Discount Code</a></li>
                           <li><a href="<?php echo site_url('admin/Discount/');?>"><span class="fa fa-sort-alpha-asc"></span><span class="xn-text">Discount List</span></a></li>
                        </ul>
                    </li>

                    <li class="xn-openable <?php if(isset($page) && $page=='setting'){ echo 'active';}?>">
                        <a href=""><span class="fa fa-user"></span> <span class="xn-text">Setting</span></a>
                        <ul> 
                            <li><a href="<?php echo site_url('admin/Discount/commissionSetting');?>">
                                <span class="fa fa-cog"></span><span class="xn-text">Commission setting</span></a>
                            </li>                           
                           <li><a href="<?php echo site_url('admin/Admin/profile');?>">
                                <span class="fa fa-user"></span><span class="xn-text">Admin Profile</span></a>
                            </li>
                           <li><a href="<?php echo site_url('admin/Admin/change_password');?>">
                                <span class="fa fa-unlock-alt"></span><span class="xn-text">Change Password</span></a>
                            </li>
                            
                        </ul>
                    </li>

                    
                    
                      
                                                                                                   
                </ul>
                <!-- END X-NAVIGATION -->
            </div>

            <!-- END PAGE SIDEBAR -->
            <?php } ?>



            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    
                    <!-- SIGN OUT -->
                    <li class="xn-icon-button pull-right">
                        <a href="#" class="mb-control" data-box="#mb-signout"><span style="position: relative;  right: 32px;" class="fa fa-sign-out">LogOut</span></a>          
                    </li>  
                    <!-- END SIGN OUT -->
                    
                </ul>
                

<script>
/*function popupremove()
{
    $('#myModal').modal('hide');
    $.ajax({
            url: "http://localhost/codeignator/medicalapp/index.php/PrescriptionControler/popupremove",
            success: function (popup) 
            {
                console.log(popup);
            }
        });
}
setInterval(function() {
        checkprescription();// Do something every 5 seconds
        checkuser();
        checkpopup();
}, 4000);
function checkprescription()
{
    $.ajax({
        url: "http://localhost/codeignator/medicalapp/index.php/PrescriptionControler/checkprescription",
        success: function (emp_list) {
            console.log(emp_list);
            if(emp_list!=0)
            {
                $("#rowcount").html(emp_list);
            }
        }
    });
};

function checkuser() {
            $.ajax({
                url: "http://localhost/codeignator/medicalapp/index.php/user/checkuser",
                success: function (list) {
                    console.log(list);
                    if(list!=0){
                    $("#rowcount1").html(list);
                    }
                }
        });
    };

function checkpopup()
{
    $.ajax({
           dataType: "json",
            url: "http://localhost/codeignator/medicalapp/index.php/PrescriptionControler/checkpopup",
            success: function (popup) 
            {
                console.log(popup);
                if(popup.name)
                {
                    $('#myModal').modal('show');
                    $('#des').html(popup.name);
                }
            }
        });
}
*/


</script>

<div id="myModal" class="modal fade" role="dialog" style="background-color: transparent;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" >
      <div class="modal-header" >
        <button type="button" class="close" data-dismiss="modal" onclick="popupremove()">&times;</button>
        <h4 class="modal-title">New Prescription Request</h4>
      </div>
      <div class="modal-body" id="des"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="popupremove()">Close</button>
      </div>
    </div>

  </div>
</div>

        