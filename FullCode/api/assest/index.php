<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="SHORTCUT ICON" href="<?php echo base_url('assest/images/favicon.png'); ?>" type="image/png" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assest/bootstrap-3.3.7-dist/css/bootstrap.min.css');?>" />
<script src="<?php echo base_url('assest/src/jquery-3.1.1.min.js');?>"> </script>
<script src="<?php echo base_url('assest/bootstrap-3.3.7-dist/js/bootstrap.min.js');?>"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- <script src="<!?php echo base_url('assest/src/jquery-bootstrap-modal-steps.js');?>"></script> -->
<link rel="stylesheet" href="<?php echo base_url('assest/css/style.css');?>" />
<style type="text/css">
  label{margin-top: 10px;}
  .help-inline-error{margin-top:5px;color:red;}
  .fake-input { position: relative;}
  .fake-input input { border:none: background:#fff; display:block; width: 100%; box-sizing: border-box ;padding-left:50px !important; box-sizing: border-box; height:35px}
  .fake-input img { position: absolute; top: 2px; left: 5px }
  .radioshow{width:100%;height:auto;display:none;margin-top: 10px}


</style>

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

<script>
window.onscroll = function() {myFunction()};
function myFunction() {
    if (document.body.scrollTop > 40 || document.documentElement.scrollTop > 40) 
    {
        document.getElementById("myP").className = "test";
    } else {
        document.getElementById("myP").className = "test1";
    }
}
</script>

</head>

<body class="body">

<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#fff;">
          <div class="container-fluid r1" id="myP" >
                  <div class="container"  style="padding-top:5px;box-sizing:border-box;padding-right:5px;padding-bottom:5px">
                        
                          <i class="i1 fa fa-instagram  fa-pull-right" style="padding:6px 0px 0px 7px;box-sizing:border-box;font-size:12px"> </i>
                          <i class="i1 fa fa-linkedin fa-pull-right" style="padding:5px 0px 0px 7px;box-sizing:border-box;font-size:12px"> </i>
                          
                          <i class="i1 fa fa-facebook fa-pull-right" style="padding:7px 0px 0px 8px;box-sizing:border-box;font-size:12px" > </i>
         
                 </div>
           </div>
           <div class="container col-md-7 col-sm-4" id="myP1"  style="padding:15px 15px 8px 15px;box-sizing:border-box" >
               
                 <div class="navbar-header" style="padding-left:15px;box-sizing:border-box">
                   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span> 
                   </button>
                    <a class="navbar-brand" href="#"><img src="<?php echo base_url('assest/images/Untitled-3.png');?>" width="70" height="40" style="padding:0px 0px !important;margin-top:5px"/></a>
               </div>
         </div>
            
             <div class="col-md-5 col-sm-8" id="myP1"   style="padding:15px 15px 8px 15px;box-sizing:border-box">  
               <div class="collapse navbar-collapse" id="myNavbar">
                   <ul class="nav navbar-nav">
                        <li class="active" style="font-weight:500;font-size:12px"><a href="<?PHP echo base_url();?>">HEM</a></li>
                        <li style="font-weight:500;font-size:12px"><a href="translate.html">TJÄNSTER</a></li>
                        <li style="font-weight:500;font-size:12px"><a href="common question.html">VANLIGA FRÅGOR</a></li>  
                        <li style="font-weight:500;font-size:12px"><a href="contact.html">KONTAKTA OSS</a></li>
                       
                        <li style="font-weight:500;font-size:12px"><a class="a" href="#myModal1" data-toggle="modal">LOGIN</a></li> 
                   </ul>
               </div>
            </div>  
  
</nav>

<div class="container-fluid" style="background-image:url(<?php echo base_url('assest/images/syplo.jpg');?>);padding:120px 0px 40px 0px;background-size:cover;background-attachment:fixed">
<center>
   <div style="width:40%;">
    <!-- Message show here -->
        <?php if(isset($success) && $success==2) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } else if(isset($error) && $error==2) { ?>
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } ?>
    </div>
</center>
      <!-- Message show here End-->

            <!-- Customer Login Start  -->

    <form method="post" action="<?php echo site_url('Admin/registration'); ?>">
        <div class="col-md-4" > <br />
        <!-- Message show here -->

        <?php if(isset($success) && $success==1) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } else if(isset($error) && $error==1) { ?>
                <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $message;?>
            </div>
            <?php } ?>

      <!-- Message show here End-->

            <div style="background-color:#F7F7F7;padding:20px 30px 15px 30px;top:70px">                
                 <h4 class="text-center" style="color:#0080C0;font-weight:bold"> Registrera dig och boka tjänster </h4>
                  <div class="col-md-6" style="padding:0px 3px 0px 0px !important;">
                     <div class="form-group">
                      <input type="text" name="first_name" class="form-control1" placeholder="First name" id="fname" required >
                     </div>
                  </div>
                   <div class="col-md-6" style="padding:0px 0px 0px 0px !important">
                     <div class="form-group">
                      <input type="text" name="last_name"  class="form-control1" placeholder="Last name" id="fname" required >
                     </div>
                  </div>
                  <div class="form-group">
                     <input type="email" name="email" class="form-control1" placeholder="E-Mail" required id="fname"  autocomplete="off">
                 </div>
                 <div class="form-group ">
                    <div class="fake-input">
                    <input type="text" name="mobile" placeholder="Mobile No." required  id="phone" class="form-control1" />
                        <img src="<?php echo base_url('assest/images/swedenflag123.png');?>" style="margin-top:8px; width:45px" />
                    </div>
                  </div>
                  
                  <div class="form-group ">
                    <input type="password" name="password" placeholder="Password" class="form-control1" id="phone" required autocomplete="off">
                  </div>
                  <input type="hidden" name="user_type" value="2">
                  <input type="checkbox" name="check" required/> Jag accepterar syplo's allmanna villkor   
                  <input type="submit" class="skikabtn text" name="login" value="Stikca" style="margin-top:10px">
               
               </div> 
               </form>

               <!-- Customer Login Start End  -->
               <br /> 
              
      <div style="background-color:#F7F7F7;padding:5px 30px 15px 30px;">
          <h4 class="text-center" style="color:#0080C0;font-weight:bold"> Will du erbjuda tjänster?  </h4>
          <a class="popuptext" href="#myModal3" data-dismiss="modal" data-toggle="modal">  <button class="skikabtn" type="button" > <span class="text">I want to offer services</span> </button> </a>
    </div>           
   </div>
          
          
   <div class="col-md-8">    
    <div class="text-left" style="padding-top:140px;box-sizing:border-box;padding-left:20px !important">
        <h1 class="slidetext text-left">Beauty on demand</h1> <br /> <br />
        <span class="slidetext1">Your stylist or massör to your door step, 7 days a week, 24/7</span>
        <br> <br />
        <a class="btn btn-lg btn-success big-btn android-btn text-center" href="#">
    <i class="fa fa-apple pull-left" ></i><div class="btn-text" style="padding-right:3px"><small>Download on the</small><br><strong>App Store</strong>      </div></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-lg btn-success big-btn android-btn text-center" href="#">
<img class="pull-left" src="<?php echo base_url('assest/images/android.ico');?>" width="30"  height="30"/>
<div class="btn-text"><small>Available on</small><br><strong>Google Play</strong></div></a>
    </div>       
    </div>
    </div>
</div>



<!------------------------------------------------------------------------------------------------------------------------------------------------------>
<div class="container text-center contain">
   <h2 style="color:#1395ba">Ett nytt sätt att jobba på</h2>
     <div class="orange text-center"> </div>
     <h5 class="para"> Syplo gör det möjligt för kunder att boka skönhetsrelaterade tjänster via appen och få de utförda i sitt hem eller på annan plats. Det kan vara allt ifrån hårklippning, skäggtrim, massage, sminkning, fransar eller naglar. Det vill säga, det mesta som utförs i en skönhetssalong eller hos en frisör. Om du jobbar inom något av dessa områden och är villig att utföra dina tjänster i ditt närområde hemma hos kunder, på event eller på hotell för personer som har ont om tid, vill ha en premium tjänst eller har ett evenemang, registrera dig hos oss. Du kan registrera dig som frilansare eller företag.</h5>  
</div>
<!------------------------------------------------------------------------------------------------------------------------------------------------------>

<div class="container text-center" style="padding-top:30px;box-sizing:border-box;padding-bottom:30px;border-bottom:1px solid #ddd">
    <div class="col-md-4">
    <img src="<?php echo base_url('assest/images/web-icon_03.png'); ?>" />
    <h3 style="color:#1395ba">Tryggt</h3>
    <p class="p1">En bakgrundskontroll utförs så att kunderna ska känna sig trygga. Du som tjänsteutövare kan själv välja vilka och hur många bokningar du vill ta.</p>
    </div>
    <div class="col-md-4">
    <img src="<?php echo base_url('assest/images/web-icon_05.png');?>"  />
    <h3 style="color:#1395ba">Lönsamt</h3>
    <p class="p1">Du når ut till flera kunder, samt andra typer av kunder, och tjänar mer pengar. Du väljer själv hur kunder kan boka dig och vilken avbokningspolicy som gäller.</p>
    </div>
    <div class="col-md-4">
    <img src="<?php echo base_url('assest/images/web-icon_07.png');?>"  />
    <h3 style="color:#1395ba">Enkelt</h3>
    <p class="p1">Kunder kan enkelt hitta dig och boka dig direkt i appen. Betalningen sköts automatiskt och pengarna överförs till dig när tjänsten har utförts.</p>
    </div>    
</div>
<!---------------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container text-left" style="padding-top:30px;box-sizing:border-box;padding-bottom:30px;border-bottom:1px solid #ddd">
 <h2 style="color:#1395ba">Hur fungerar det?</h2>
  <div class="orange1 text-left"> </div> <br /> <br />
  <span class="hurtext">1.Kunden söker efter tjänster: </span> <span class="hurtext1">Kunden registrerar sig i appen, söker efter en eller flera tjänster, väljer tid och plats. Kunden ser en lista, eller en karta, på tillgängliga tjänsteutövare som erbjuder valda tjänster i närområdet. Tjänsteutövaren sätter själv priset på sina tjänster. </span> <br /> <br />
<span class="hurtext">2. Kunden bokar en tid: </span> <span class="hurtext1">För att kunden ska kunna göra ett bra val så kan kunden se vad tjänsteutövaren har för tidigare recensioner, se bilder på tidigare utförda jobb, CV och eventuella certifikat som tjänsteutövaren har. Kunden gör sedan sitt val och bokar en tid.  </span> <br /> <br />
<span class="hurtext">3. Bokningen bekräftas: </span> <span class="hurtext1">Bokningen bekräftas antingen direkt, eller efter att tjänsteutövaren bekräftat bokningen. En chatt funktion finns tillgänglig i appen för kunden och tjänsteutövaren. Den nödvändiga utrustningen som krävs för att utföra tjänsterna tillhandahåller tjänsteutövaren.  </span> <br /> <br />
<span class="hurtext">4. Tjänsten utförs och betalning slutförs: </span> <span class="hurtext1"> Tjänsten är utförd och utbetalning sker! Kunden recenserar tjänsteutövaren och ger ett betyg från 0 till 5 stjärnor </span> <br /> <br />
</div>


<div class="container" style="padding-top:30px;box-sizing:border-box;padding-bottom:30px;border-bottom:1px solid #ddd">
     <div class="col-md-4 col-sm-12 text-center">
      <img src="<?php echo base_url('assest/images/black-envelope.png');?>" width="30" height="30" /> <br  /> <br />
      <span class="mgstext"> <a class="b" href="#"> info@syplo.se </a> </span>
     </div>
      <div class="col-md-4 col-sm-12 text-center">
      <img src="<?php echo base_url('assest/images/map-localization.png');?>" width="30" height="30" /> <br  /> <br />
      <span class="mgstext"> <a class="b"  href="#"> Stockholm, Sverige</a> </span>
     </div>
     <div class="col-md-4 col-sm-12 text-center">
      <img src="<?php echo base_url('assest/images/contact-methods-phone-icon-512x512-pixel-3.png');?>" width="30" height="30" /> <br  /> <br />
      <span class="mgstext"> <a class="b"  href="#">08-55 11 11 95</a> </span>
     </div>
</div>


<div class="container-fluid footer text-center"  style="padding-top:30px;box-sizing:border-box;padding-bottom:30px">
<span style="color:#fff;font-weight:500;font-size:16px"> Syplo AB </span> <br /> <br />
<span style="font-weight:500;font-size:16px"> <a href="#" class="a"> Allmänna villkor </a>  </span>&nbsp;&nbsp; 
<span style="font-weight:500;font-size:16px"> <a href="#" class="a">Säkerhet </a> </span> <br /> <br />
         <i class="i fa fa-facebook" style="padding:9px 0px 0px 0px;box-sizing:border-box" > </i>
         <i class="i fa fa-linkedin" style="padding:10px;box-sizing:border-box;font-weight:bold"> </i>
         <i class="i fa fa-instagram" style="padding:10px 0px 0px 0px;font-weight:bold"> </i>
         
</div>

<div class="container">
 
  <!-- Modal -->
  <div class="modal fade" id="myModal1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content" style="padding:25px">
      <button type="button" class="close" data-dismiss="modal" style="margin-bottom:10px">&times;</button> <br />
        <div class="modal-header text-center">
          
                <img src="<?php echo base_url('assest/images/Untitled-3.png');?>" width="70" height="40"/>        
        </div>
        <form method="post" action="<?php echo site_url('Admin/login');?>">
        <div class="modal-body text-center">
                <div class="input-group">
                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                   <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" style="height:50px;width:100%" required>
                </div> <br />
               <div class="input-group">
                 <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
               <input id="password" type="password" class="form-control" name="password" placeholder="Password" style="height:50px;width:100%" required>
              </div> <br />
              <label class="text-muted pull-left"><input type="checkbox" value=""> Remember password</label>
            
              <a href="#forgetpassword" data-dismiss="modal" data-toggle="modal">
            <span class="pull-right" style="color:#008080;font-weight:bold "> Forgot password? </span> </a>
            
              <button class="loginbtn" type="submit" name="login"> <span class="text"> LOGIN </span> </button> <br /> <br />
               
               
                <div class="modal-footer">
               <span class="text-center" style="color:#888;font-weight:bold">Don't have a Syplo account? <a href="#myModal3"  data-dismiss="modal" data-toggle="modal" > SIGN UP </a> </span> 
               </div>
        </div>
        </form>
        
      </div>
      
    </div>
  </div>
  
</div>

                              <!--   Forget password Model Start  -->
<div class="container">
  <div class="modal fade" id="forgetpassword" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="POST" action="<?php echo site_url('Admin/forgetpassword');?>">
        <div class="modal-header text-center">
          <img src="<?php echo base_url('assest/images/Untitled-3.png');?>" width="70" height="40"/>
          <button type="button" class="close" data-dismiss="modal">&times;</button><br><br>
          <h4 class="modal-title" style="color:#0d3c55 !important;font-weight:bold;font-size:16px">Forget Password</h4>
        </div>
        <div class="modal-body">
          <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="email" type="email" class="form-control" name="email" placeholder="Email Address" style="height:50px;width:100%" required>
          </div>
        </div>
        <div class="modal-footer">
           <button class="js-btn-step js-btn1 js-text" type="submit">Submit </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
                        <!--       Forget password Model End       -->




                                        <!-- Choose Registration type option model -->
<div class="container">
  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
    
      <!-- Modal content-->
      <div class="modal-content" style="padding:25px">
         <button type="button" class="close" data-dismiss="modal" style="margin-bottom:10px">&times;</button> <br />
           
           <div class="modal-header text-center">
                 <div style="width:100%;height:auto;background-color:#fff">
                     <img src="<?php echo base_url('assest/images/Untitled-3.png');?>" />
                     
                  </div>
             <a class="popuptext" href="#myModal7" data-dismiss="modal" data-toggle="modal"> <button class="loginbtn" type="button" > <span class="text"> I want to book services </span>  </button> </a> <br /> <br />
             <a class="popuptext" href="#myModal3" data-dismiss="modal" data-toggle="modal">    <button class="loginbtn" type="button" > <span class="text">    I want to offer services </span> </button> </a> <br /> <br />
      </div>
       
      
       </div>
    </div>
 </div> 
</div>
                            <!-- Choose Registration type option model End -->

                            <!-- Choose Option for freelancer or comapny model -->

<div class="container">
  <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog">
    
    
      <!-- Modal content-->
      <div class="modal-content" style="padding:25px">
         <button type="button" class="close" data-dismiss="modal" style="margin-bottom:10px">&times;</button> <br />
           
           <div class="modal-header text-center">
                 <div style="width:100%;height:auto;background-color:#fff">
                     <img src="<?php echo base_url('assest/images/Untitled-3.png');?>" />
                     
                  </div>
             <a class="popuptext" href="#individual" data-dismiss="modal" data-toggle="modal">  <button class="loginbtn" type="button" > <span class="text">   Register as Individual</span>  </button> </a> <br /> <br />
            <a class="popuptext" href="#myModal4" data-dismiss="modal" data-toggle="modal"> 
               <button class="loginbtn" type="button" data-toggle="modal" data-target="#companyModal" > <span class="text" >   Register as Company </span> </button> </a> <br /> <br />
      </div>
       
      
       </div>
    </div>
 </div> 
</div>
                        <!-- Choose Option for freelancer or comapny model -->

 
                        <!--  Comapny Registration Start Model -->

  <!-- Modal -->
  <div class="modal fade" id="companyModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="padding:15px">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="js-title-step" style="color:#0d3c55 !important;font-weight:bold;font-size:16px" >REGISTER AS COMPANY</h4>
          </center>
        </div>
        <div class="modal-body" style="padding: 0 5px !important;">
  <div class="panel panel-primary" style="border:none !important;">
    <div class="panel-body">
      <form name="basicform" id="basicform" method="post" action="<?php echo site_url('Admin/registration');?>">
        
        <div id="sf1" class="frm">
          <fieldset>
           
           <div class="form-group ">
          <input type="text" name="company_name" class="textfield" placeholder="Company Name" id="company_name" style="padding: 0 5px !important;">
                  </div>
                   <div class="form-group ">
                       <input type="text" name="reg_no" placeholder="Registration No." class="textfield" id="reg_no">
                  </div>
                  <div class="form-group ">
                       <input type="text" name="address" placeholder="Company Address" class="textfield" id="address">
                  </div>
                 <div class="form-group ">
                    <div class="fake-input">
                    <input type="text" name="mobile" placeholder="Mobile No." required  id="phone" class="form-control1" />
                        <img src="<?php echo base_url('assest/images/swedenflag123.png');?>" style="margin-top:8px; width:45px" />
                    </div>
                  </div>
                  <div class="form-group ">
                      <input type="email" name="email" placeholder="Email ID" class="textfield" id="email">
                  </div>


            <div class="clearfix" style="height: 10px;clear: both;"></div>


            <div class="modal-footer">
         <button class="open1 js-btn-step js-btn1 js-text" type="button" style="float:right;">Next </button>
         &nbsp;&nbsp;
         <button class="btn btn-warning js-btn-step" disabled type="button" style="margin-right:10px;">Back</button>
            </div>

          </fieldset>
        </div>

        <div id="sf2" class="frm" style="display: none;">
          <fieldset>
            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">
                <input type="password" placeholder="Your Password" id="upass1" name="password" class="form-control" autocomplete="off">
            </div>
            <div class="clearfix" style="height: 10px;clear: both;"></div>

            <div class="form-group">             
                <input type="password" placeholder="Confirm Password" id="upass2" name="upass2" class="form-control" autocomplete="off">
                <input type="hidden" name="user_type" value="3">
            </div>
             <div class="form-group">
                    <input type="checkbox" id="term1" name="term1" required>&nbsp;<a href="#"><span style="color:#999;font-weight:bold">&nbsp; I accept the terms and conditions.</span> </a>
                </div>
                
            <div class="modal-footer">
                <button class="btn btn-warning js-btn-step back2" type="button">Back</button> 
                <button class="js-btn-step js-btn1 js-text open2" type="submit">Submit </button> 
          </div>

          </fieldset>
        </div>
      </form>
    </div>
  </div>
        </div>
      </div>
      
    </div>
  </div>
  
</div>


                     <!--  Comapny Registration  Model End -->

<script type="text/javascript" src="<?php echo base_url('assest/src/jquery.validate.js');?>"></script>
<script type="text/javascript">
  
  jQuery().ready(function() {

    // validate form on keyup and submit
    var v = jQuery("#basicform").validate({
      rules: {
        company_name: {
          required: true,
          minlength: 2
        },
        reg_no: {
          required: true,
          minlength: 2
        },
        address:{
          required: true,
          minlength: 2
        },
        mobile:{
          required: true,
          minlength: 2,
          digits: true
        },
        email: {
          required: true,
          minlength: 2,
          email: true,
          maxlength: 100
        },
        password: {
          required: true,
          minlength: 6
        },
        upass2: {
          required: true,
          minlength: 6,
          equalTo: "#upass1"
        }
      },
      errorElement: "span",
      errorClass: "help-inline-error",
    });

    $(".open1").click(function() {
      if (v.form()) {
        $(".frm").hide("fast");
        $("#sf2").show("slow");
      }
    });

    // $(".open2").click(function() {
    //   if (v.form()) {
    //     $("#loader").show();
    //      setTimeout(function(){
    //        $("#basicform").html('<h2>Thanks for your time.</h2>');
    //      }, 1000);
    //     return false;
    //   }
    // });
    
    /*$(".open3").click(function() {
      alert("hii");
      if (v.form()) {
        $("#loader").show();
         setTimeout(function(){
           $("#basicform").html('<h2>Thanks for your time.</h2>');
         }, 1000);
        return false;
      }
    });*/
    
    $(".back2").click(function() {
      $(".frm").hide("fast");
      $("#sf1").show("slow");
    });

    $(".back3").click(function() {
      $(".frm").hide("fast");
      $("#sf2").show("slow");
    });

  });
</script>
<script>
$('#myModal4').modalSteps();
</script>

                    <!-- FreeLancer Model Start -->

      <!-- Modal -->
      <div class="modal fade" id="individual" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center><h3 class="panel-title" style="margin-top: 20px;color:#0d3c55 !important;font-weight:bold;font-size:16px" >REGISTER AS FREELANCER</h4>
          </center>
        </div>
               <div class="modal-body" style="padding: 0px 15px 10px 15px !important">
                        <div class="panel-body">
                           <form name="basicform1" id="basicform1" method="post" action="yourpage.html">
                              <div id="sf11" class="frm">                              
                                 <fieldset>
                                    <div class="form-group ">
                                       <input type="text" class="form-control1" placeholder="Full Name" id="fname">
                                    </div>
                                    <div class="form-group ">
                                       <input type="text" name="phone" placeholder="YY-MM-DD-XXXX"  class="form-control1" id="phone" >
                                    </div>
                                    <div class="form-group ">
                                       <input type="text" name="phone" placeholder="Address" class="form-control1" id="phone" >
                                    </div>
                  <div class="form-group ">
                    <div class="fake-input">
                    <input type="text" name="mobile" placeholder="Mobile No." id="phone" class="form-control1" />
                        <img src="<?php echo base_url('assest/images/swedenflag123.png');?>" style="margin-top:8px; width:45px" />
                    </div>
                  </div>
                                    <div class="form-group ">
                                       <input type="text" name="email" placeholder="Email ID" class="form-control1" id="email">
                                    </div>
                                    <div class="form-group ">
                                       <select class="form-control1" style="width:100%;height:40px;color:#888">
                                          <option name="gender" style="text-transform:capitalize !important;">Gender</option>
                                          <option value="male">Male</option>
                                          <option value="female">Female</option>
                                       </select>
                                    </div>
                                    
         <div class="clearfix" style="height: 10px;clear: both;"></div>
          <div class="modal-footer">
           <button class="open11 js-btn-step js-btn1 js-text" type="button" style="float:right;">Next 
           </button> &nbsp;&nbsp;
            <button class="btn btn-warning js-btn-step" disabled type="button" style="margin-right:10px;">Back</button>
          </div>
                                 </fieldset>
                              </div>
                              <div id="sf22" class="frm" style="display: none;">
                                 <fieldset>
                                    
                                    <div class="checkbox">
                                       <span style="color:#0d3c55;font-weight:bold;font-size:16px"> Accepted location where i offered my services </span><br /> <br />
                                       <label class="text-muted" style="font-size:16px"> <input type="checkbox" value="" checked="checked"> &nbsp; At the location of the customer</label>
                                    </div>
                                    <div class="col-md-1" style="padding:0px !important;width:4.33% !important"> 
                                       <input type="checkbox"> 
                                    </div>
                                    <div class="col-md-11" style="padding:0px !important; ">
                                       <div class="inner-addon right-addon">
                                          <i class="glyphicon glyphicon-map-marker"></i>
                                          <input type="text" name="self_loaction" class="textfield" placeholder="At my location"  />
                                       </div>
                                    </div>
                                    <br /> <br /> 
                                    <div class="form-group" style="padding-top:30px">
                                       <span style="color:#0d3c55;font-weight:bold;font-size:16px"> Availability </span><br />
                                       <label class="radio-inline text-muted" style="font-size:16px;vertical-align: text-bottom;">
                                   <input type="radio" id="radio11" name="optradio" value="1">Dygnet Address</label>
                                       <label class="radio-inline text-muted" style="font-size:16px;vertical-align: text-bottom;">
                                       <input type="radio" id="radio10" name="optradio" value="2"> &nbsp;Set Availability</label>
                                       <div class="radioshow">
                                         <div class="col-md-6">
                                           <div class="form-group">
                                              <input type="text" class="textfield" id="str" name="str" placeholder="Strat Time">
                                           </div> </div>
                                           <div class="col-md-6"> 
                                           <div class="form-group">
                                              <input type="text" class="textfield" id="end" name="end" placeholder="End time">
                                          </div> </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                       <span style="color:#0d3c55;font-weight:bold;font-size:16px" >
                                       Show my position live during availability</span> <br /> <br />
                                       <label class="switch">
                                          <input type="checkbox" name="availability" value="0">
                                          <div class="slider round"></div>
                                       </label>
                                       <br /> <br />
                                       <div class="form-group">
                                          <span style="color:#0d3c55;font-weight:bold;font-size:16px">Cancellation policy </span><br/>
                                          <label class="radio-inline text-muted" style="font-size:16px;vertical-align: text-bottom;"><input type="radio" name="cancel_policy" value="1"> &nbsp; Flexible</label>
                                          <label class="radio-inline text-muted" style="font-size:16px;vertical-align: text-bottom;"><input type="radio" name="cancel_policy" value="2">&nbsp;Moderate</label>
                                          <label class="radio-inline text-muted" style="font-size:16px;vertical-align: text-bottom;"><input type="radio" name="cancel_policy" value="3">&nbsp;Stricts</label>
                                       </div>
                                       <br />
                                       <div class="form-group">
                                          <span style="color:#0d3c55;font-weight:bold;font-size:16px">Acceptance policy </span><br/>
                                          <label class="radio-inline text-muted" style="font-size:16px; vertical-align: text-bottom;"><input type="radio" name="acceptance_policy" value="0"> &nbsp;Instant</label>
                                          <label class="radio-inline text-muted" style="font-size:16px; vertical-align: text-bottom;">
                                          <input type="radio" name="acceptance_policy" value="1">&nbsp;Pre approval</label>
                                       </div>
                                       <br />
                                       <div class="clearfix" style="height: 10px;clear: both;"></div>
                                      <div class="modal-footer">
                                          <button class="btn btn-warning back22" type="button"><span class="fa fa-arrow-left"></span> Back</button>&nbsp;&nbsp; 
                                          <button class="open22 js-btn-step js-btn1 js-text" type="button" style="float:right;">Next </button>
                                      </div>
                                 </fieldset>
                                 </div>
                <!--  --------------  Service list -------------------------->


     <div id="sf33" class="frm" style="display: none;">
        <fieldset>
          
           <div class="panel-group text-left" id="accordion">
          <?php 
            $i=1;
            foreach ($categorylist as $key => $value)
            { ?> 
            

              <div class="panel panel-default">
                 <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $i;?>">
                  <div class="panel-heading" style="background-color:#F4F4F4">
                <h4 class="panel-title" style="font-size:16px"><?php echo $value->category; ?></h4>
                    </div>
                 </a>
                <div id="collapse<?php echo $i;?>" class="panel-collapse collapse">
                    <div class="panel-body"  style="overflow-y: scroll; height:auto">
                    <?php 
                  foreach($servicelist as $sub)
                  {  
                  if($value->category==$sub->category)
                  { ?> 
                       <input type="checkbox" data-toggle="modal" data-target="#myModal21"/>
                        <span class="text-muted" style="font-size:14px;font-weight:bold"><?php echo $sub->sub_category; ?>
                       </span><br>

                  <?php } }?>
                    </div>
                </div>
                  
              </div>
              <?php $i++; } ?>
           </div>
           <div class="clearfix" style="height: 10px;clear: both;"></div>
           <div class="clearfix" style="height: 10px;clear: both;"></div>
          <div class="modal-footer">
              <button class="btn btn-warning back33" type="button"><span class="fa fa-arrow-left"></span> Back</button>&nbsp;&nbsp; 
              <button class="open33 js-btn-step js-btn1 js-text" type="button" style="float:right;">Next </button>
          </div>
        </fieldset>
     </div>
                                 <div id="sf44" class="frm" style="display: none;">
                                    <fieldset>
                                       
                                       <label for="Certifications" style="font-size:14px;color:#0d3c55;font-weight:bold">Upload Certifications(Optional)</label> &nbsp;&nbsp;&nbsp;&nbsp; <input type="file" />
                                       <br />  
                                       <textarea rows="2"  id="comment" placeholder="Write about certifications" style="width:100%;padding:2px;"></textarea>
                                       <br /> <br />
                                       <label for="Pictures"  style="font-size:14px;color:#0d3c55;font-weight:bold">Upload pictures Of Worked Performed(optional) </label> <br />
                                       <br /> 
                                       <i class="fa fa-instagram" style="color:#CE1EBC;font-size:14px"> </i> <a href="#" style="text-decoration:none"> <span style="color:#CE1EBC;font-size:14px"> Connect with your instragram account </span> </a>
                                       <div class="clearfix" style="height: 10px;clear: both;"></div>
                                       <div class="clearfix" style="height: 10px;clear: both;"></div>
                                       <div class="modal-footer">
                                          <button class="btn btn-warning back44" type="button"><span class="fa fa-arrow-left"></span> Back</button>&nbsp;&nbsp; 
                                          <button class="open44 js-btn-step js-btn1 js-text" type="button" style="float:right;">Next </button>
                                      </div>
                                    </fieldset>
                                 </div>
                                 <div id="sf55" class="frm" style="display: none;">
                                    <fieldset>
                                      
                                       <div class="form-group ">
                                          <input type="password" class="textfield" id="pref_date" placeholder="Password" required="required">
                                       </div>
                                       <div class="form-group ">
                                          <input type="password" class="textfield" id="pref_date" placeholder="Confirm Password" required="required">
                                       </div>
                                       <div class="form-group  ">
                                          <input type="checkbox" value="">&nbsp;&nbsp;<a href="#" style="text-decoration:none"> <span style="color:#999;font-weight:bold">I accept the terms and conditions.</span> </a>
                                       </div>
                                       <div class="form-group ">
                                          <input type="checkbox" value="">&nbsp;&nbsp;<a href="#" style="text-decoration:none"> <span style="color:#999;font-weight:bold">Jag önskar att Syplogör avdrag för skatter och betala avgifter åt mig för de inkomster jag får för mina uppdrag, vilket innebär att jag får mina utbetalnin gar som en nettolön. </span> </a>
                                       </div>
                                       <div class="clearfix" style="height: 10px;clear: both;"></div>
                                       <div class="clearfix" style="height: 10px;clear: both;"></div>
                                       <div class="modal-footer">
            <div class="form-group">
              <div class="col-lg-10 col-lg-offset-2">
                <button class="btn btn-warning js-btn-step back55" type="button">Back</button> 
                <button class="js-btn-step js-btn1 js-text open55" type="submit">Submit </button> 
              </div>
            </div>
          </div>
                                    </fieldset>
                                 </div>
                            </form>
                          </div>
                     </div>
                  </div>
            </div>
         </div>
      </div>

     

<script type="text/javascript">
   jQuery().ready(function() {
   
     // validate form on keyup and submit
     var v = jQuery("#basicform1").validate({
       rules: {
         uname: {
           required: true,
           minlength: 2,
           maxlength: 16
         },
         uemail: {
           required: true,
           minlength: 2,
           email: true,
           maxlength: 100,
         },
         upass1: {
           required: true,
           minlength: 6,
           maxlength: 15,
         },
         upass2: {
           required: true,
           minlength: 6,
           equalTo: "#upass1",
         }
   
       },
       errorElement: "span",
       errorClass: "help-inline-error",
     });
   
     $(".open11").click(function() {
       if (v.form()) {
         $(".frm").hide("fast");
         $("#sf22").show("slow");
       }
     });
   
     $(".open22").click(function() {
       if (v.form()) {
         $(".frm").hide("fast");
         $("#sf33").show("slow");
       }
     });
   $(".open33").click(function() {
       if (v.form()) {
         $(".frm").hide("fast");
         $("#sf44").show("slow");
       }
     });
   $(".open44").click(function() {
       if (v.form()) {
         $(".frm").hide("fast");
         $("#sf55").show("slow");
       }
     });  
     
     $(".open55").click(function() {
       if (v.form()) {
         $("#loader").show();
          setTimeout(function(){
            $("#basicform1").html('<h2>Thanks for your time.</h2>');
          }, 1000);
         return false;
       }
     });  
     
     $(".back22").click(function() {
       $(".frm").hide("fast");
       $("#sf11").show("slow");
     });
   
     $(".back33").click(function() {
       $(".frm").hide("fast");
       $("#sf22").show("slow");
     });
   $(".back44").click(function() {
       $(".frm").hide("fast");
       $("#sf33").show("slow");
     });
      $(".back55").click(function() {
       $(".frm").hide("fast");
       $("#sf44").show("slow");
     });
   });
</script>
                  <!--          FreeLancer Model End           -->



<div class="container-fluid" style="background-color:#0d3c55;padding:5px 0px 15px 0px">
<div class="col-md-4"> </div>
    <div class="col-md-2 text-center">
    <a class="btn btn-lg btn-success big-btn android-btn" href="#">
    <i class="fa fa-apple pull-left" ></i><div class="btn-text" style="padding-right:3px"><small>Download on the</small><br><strong>App Store</strong></div></a>
   </div>
    <div class="col-md-2 text-center"> 
     <a class="btn btn-lg btn-success big-btn android-btn" href="#">
<img class="pull-left" src="<?php echo base_url('assest/images/android.ico');?>" width="30"  height="30"/><div class="btn-text"><small>Available on</small><br><strong>Google Play</strong></div></a>

   </div>
   <div class="col-md-4 ">
   </div>  
</div>