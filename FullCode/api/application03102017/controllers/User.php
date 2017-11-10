<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	public function __construct()
	{
	    $this->load->model('User_model');
	}
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function signup()
	{
		if($this->input->post('register'))
		{
			$device_token		= $_POST['device_token'];
			$company_name		= $_POST['company_name'];
			$reg_no				= $_POST['reg_no'];
	        $address 			= $_POST['address'];
	        $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];	        
	        $mobile				= $_POST['mobile_no'];
	        $email				= $_POST['email'];
			$password			= $_POST['password'];
			$confirm_password   = $_POST['cpassword'];
			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
			{
				$s=$_FILES["image"]["tmp_name"];				
	            $picture=$r.$_FILES["image"]["name"];
	            $d="uploads/".$picture;
	            move_uploaded_file($s,$d);
			}
	        // Accept location
	        $address_accept		= $_POST['address_accept']; //0=providerAdd,1=customerAdd,2=both
	        $customerAdd[]='';
	        if($address_accept==1 || $address_accept==2)
	        {
	        	$customerAdd[]	= $_POST['customerAdd'];
	        }
	        $availity			= $_POST['availity'];  // 1-always 2-selectTime
	        $start_time='';
	        $end_time='';
	        if($availity==2)
	        {
	        	$start_time 	= $_POST['start_time'];
	        	$end_time		= $_POST['end_time'];
	        }	 

	        // Service offerred 

	        $category[]			= $_POST['category'];
	        $suburb[]			= $_POST['subcategory'];
	        $pricetype[]		= $_POST['prisetype']; //0=perhour, 1=wholeday
	        $current_workplace	= '';
	        $previous_workplace	= '';
	        if(isset($_POST['current_workplace']))
	        {
	        	$current_workplace=$_POST['current_workplace'];
	        }
	        if(isset($_POST['previous_workplace']))
	        {
	        	$previous_workplace=$_POST['previous_workplace'];
	        }
	        
	        // certificate

	        $experience			= $_POST['experience'];
	        if(isset($_FILES['certificate_image']))
			{
				foreach($_FILES['certificate_image']['tmp_name'] as $key => $tmp_name )
				{
			        $certificate_image_name = $_FILES['certificate_image']['name'][$key];
			        // $file_size = $_FILES['files']['size'][$key];
			        $s =  $_FILES['certificate_image']['tmp_name'][$key];
			        $certificate_image = preg_replace('/\s*/m', '',$certificate_image_name);
			        $d = "certificate_image/".$certificate_image;
			        $certificate_image[]= $certificate_image;  
			        move_uploaded_file($s,$d);

			   		$picupload=$this->User_model->multiImages($files,$post_id);
    			}
    		}       
			
		        $fullname			= $_POST['fullname'];
		        $dob 				= $_POST['dob'];		        
		        
		        $canceling_policy 	= $_POST['canceling_policy'];  // 1-flexible 2-strict
				$acceptance 		= $_POST['acceptance']; //0=instant,1=pre-approval				
				$house_no 			= $_POST['house_no'];			
		        
		        $reg_type 			= $_POST['reg_type'];
		        $password 			= $_POST['password'];
		        $user_type 			= $_POST['user_type']; 
				
				$street_name 		= $_POST['street_name'];
				$street_suf 		= $_POST['street_suf'];
				$country_name 		= $_POST['country_name'];
				
				$land_line_no 		= $_POST['land_line_no'];
				$state 				= $_POST['state'];
				$postcode 			= $_POST['postcode'];
				$suburb 			= $_POST['suburb'];
				$company_name 		= $_POST['company_name'];
				$abn_no 			= $_POST['abn_no'];

				extract($_POST);
				$r=rand(0,999999);
				$picture='default.jpg';
				
				$newdata = array(
								'company_name'=>$company,
	                            'firstname'=>$firstname,
	                            'lastname'=>$lastname,
	                            'email'=>$email,
	                            'phone'=>$mobno,
	                            'land_line_no'=>$llno,
	                            'password'=>$pass,
	                            'unit_no'=>$UNO,
	                            'house_no'=>$HNO,
	                            'street_name'=>$streetname,
	                            'street_suf'=>$streetsuffix,
	                            'suburb'=>$suburb,
	                            'state'=>$state,
	                            'postcode'=>$postcode,
	                            'country_name'=>$country,
	                            'profile_image'=>$picture,
	                            'device_type'=>'web',
	                            'user_type'=>1
	                          );
				$res=$this->User_model->register_user($newdata);
				if($res==1)
				{
					$data=new stdclass();
					$data->success=1;
					$data->message="Record is saved Successfully";
					$this->load->view('signup',$data);
				}
				else
				{
					$data=new stdclass();
					$data->error=1;
					$data->message="Not Register! Try Again";
					$this->load->view('signup',$data);
				}
			}
			else
			{
				$this->load->view('signup');
			}
		}
	}
	
