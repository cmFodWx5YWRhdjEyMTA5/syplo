<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller
{
	function __construct() 
	{
        parent::__construct();
            $this->load->model('Registration_model');
            $this->load->model('Service_model');
            $this->load->model('Setting_model'); 
            $this->load->model('Freelancer_model');
            
    }

	public function index()
	{
		$response = array("success" => 0, "error" => 0);
		if (isset($_POST['user_type']) && $_POST['user_type'] != '')
		{	
			$customerReferral_code = $_POST['customerReferral_code'];
			$user_type 			= $_POST['user_type'];           //1=individual,2=customer,3=company		
			$device_token		= $_POST['device_token'];
			$device_type        = $_POST['device_type'];		 //0=android, 1=ios, 2=web
			$company_name		= $_POST['company_name'];
			$reg_no				= $_POST['reg_no'];
			$first_name			= $_POST['first_name'];
			$last_name			= $_POST['last_name'];
			$dob				= $_POST['dob'];
	        $address 			= $_POST['address'];
	        $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];	        
	        $mobile				= $_POST['mobile_no'];
	        $email				= $_POST['email'];
	        $password			= $_POST['password'];
			$confirm_password   = $_POST['cpassword'];
	        $gender				= $_POST['gender'];
	        $about				= $_POST['about'];
	        // Extra param
	        $address_acceptance = $_POST['address_acceptance'];  	//0=providerAdd,1=customerAdd,2=both;
	        $availability		= $_POST['availability'];  			// 1-always 2-selectTime;
	        $canceling_policy 	= $_POST['canceling_policy'];  		// 1-flexible 2-strict
			$acceptance 		= $_POST['acceptance']; 			//0=instant,1=pre-approval
			$seen_status		= $_POST['seen_status'];            // 0=not, 1=yes
			$approv_status		= $_POST['approv_status'];			//0=not approved, 1=approved
	        // payment param
	        $data				= $_POST['account'];       		//[{"secretno":"1132","type":"visa","status":"0"}]

			$accountdetails		= json_decode($data);
			/*$approve_status     = '';
			if($user_type==2)
			{
				$approve_status=1;
			}*/


	        /*$secretno   		= array($_POST['secretno']);
	        $paymenttype		= array($_POST['paymenttype']); 			 //Type:- 0=debitcard,1=bank,2=paypal
	        $active_status		= array($_POST['active_status']);          //active_status : 0=not,1=active
	        $secretnos  		= explode(',',$secretno[0]);
	        $paymenttypes  		= explode(',',$paymenttype[0]);
	        $active_status  	= explode(',',$active_status[0]);*/
	        $ReferalData =''; $ReferalData1='';
	        if($customerReferral_code!='')
	        {	        	
	        	$RefralDiscount = $this->Registration_model->CheckReferralCode($customerReferral_code);
	        	if($RefralDiscount)
	        	{
	        		$ReferalData = $RefralDiscount;

	        	}
	        	else
	        	{
	        		$response["error"]				= 4;	
		    		$response["success"]			= 0;
		    		$response["message"]			= "This Referral code is not valid";
		    		echo json_encode($response);
		    		exit();
	        	}	     		
	        }
	        if($user_type==3)
	        {
	        	$approv_status=0;
	        }
	        else
	        {
	        	$approv_status=1;
	        }

		    $db=$this->Registration_model->isuserexits($email,$user_type);
			if($db!=0)
			{  
		   		$response['error']=1;
		   		$response["success"]=0;
				$response["message"]="This email Id already registred";
				echo json_encode($response);
				exit;
			}
			else
			{
				$referral_code =$this->referral_code();
				if($password==$confirm_password)
				{
					$nn='default.jpg';
					if(isset($_FILES['image']) && $_FILES['image']!='')
					{
						$randno =$this->radomno();
		                $imageame  = $randno.$_FILES['image']['name'];
						$s  = $_FILES['image']['tmp_name'];
						$nn = preg_replace('/\s*/m', '',$imageame);
		                $d  = 'upload/'.$nn;
		                move_uploaded_file($s,$d);
				    }		
					$data = array(
							'device_token'		=> $device_token,
							'referral_code'		=> $referral_code,
							'company_name'		=> $company_name,
							'registration_no'	=> $reg_no,
							'first_name'		=> $first_name,
							'last_name'			=> $last_name,
							'dob'				=> $dob,
					        'address' 			=> $address,
					        'lat' 				=> $lat,
							'long' 				=> $long,	        
					        'mobile'			=> $mobile,
					        'user_image'		=> $nn,
					        'email'				=> $email,
							'password'			=> $password,
					        'gender'			=> $gender,
					       	'about'				=> $about,
					       	'address_acceptance'=> $address_acceptance,
					       	'availability'      => $availability,
					       	'canceling_policy'  => $canceling_policy,
					       	'acceptance'		=> $acceptance,
					       	'seen_status'		=> $seen_status,
					       	'approve_status'	=> $approv_status,
							'user_type'			=> $user_type,
							'device_type'		=> $device_type,
							'status'			=> 1
							);
				
					$res= $this->Registration_model->registration($data);
					$account ='';
					$data=[];
					$i='';
					if($res)
					{
						$user_id  = $res->id;
						$customerReferral = $res->referral_code;
						if($ReferalData!='')
						{
			        		$refer_id =$ReferalData['referaler_user_id'];
			        		$RefralDiscount['customer_id']=$user_id;
			        		$RefralDiscount['code'] =$customerReferral_code;  //Referraller customer
			        		$ReferalData = $RefralDiscount;

			        		$RefralDiscount['customer_id'] = $refer_id;
			        		$RefralDiscount['referaler_user_id']=$user_id;
			        		$RefralDiscount['code']              = $customerReferral;  //Signup customer
			        		$RefralDiscount['referal_type']=1;
			        		$ReferalData1 = $RefralDiscount;

				     		$this->Registration_model->add_refralDiscount($ReferalData); //store customer dis
				     		$this->Registration_model->add_refralDiscount($ReferalData1);//store refcustomer dis
						}
						$user_type= $res->user_type;
						$this->Setting_model->add_setting($user_id,$user_type);
						if(!empty($accountdetails))
						{
							$user_id=$res->id;
							foreach ($accountdetails as $key)
							{
								$ac["user_id"]=$user_id;
								$ac["secretno"]=$key->secretno;
								$ac["type"]=$key->type;
								$ac["status"]=$key->status;
								$account[]=$ac;
							}						
							/*for($i=0; $i<count($secretnos); $i++)               	// Payment Details
							{
								$account[]= array(
									'user_id'			=> $res,
							        'secretno'			=> $secretnos[$i],
							        'type'				=> $paymenttypes[$i],  
							        'status'			=> $active_status[$i]     
									);				
							}*/
							$data= $this->Registration_model->paymentdetail($account,$user_id);
							
						}
						$discount = $this->Registration_model->discountDetails($user_id);
						
				    	if(!empty($discount))
				    	{$discount = $discount;}
				    	else
				    	{$discount ='';}

						$response["error"]				= 0;	
			    		$response["success"]			= 1;
			    		$response["message"]			= "success";
			    		$image = base_url().'upload/'.$res->user_image;
			    		$response["data"]["user_id"]			= $res->id;
			    		$response["data"]["referral_code"]		= $res->referral_code;
			    		$response["data"]["user_image"]			= $image;
			    		$response["data"]["user_type"] 			= $res->user_type;   	
						$response["data"]["device_token"]		= $res->device_token; 
						$response["data"]["company_name"]		= $res->company_name;
						$response["data"]["reg_no"]				= $res->registration_no;
						$response["data"]["first_name"]			= $res->first_name;
						$response["data"]["last_name"]			= $res->last_name;
						$response["data"]["dob"]				= $res->dob;
				        $response["data"]["address"] 			= $res->address;
				       	$response["data"]["lat"] 				= $res->lat;
						$response["data"]["long"] 				= $res->long;	        
				     	$response["data"]["mobile"]				= $res->mobile;
				        $response["data"]["email"]				= $res->email;
				      	$response["data"]["password"]			= $res->password;
				        $response["data"]["gender"]				= $res->gender;
				       	$response["data"]["about"]				= $res->about;					      
				        $response["data"]["address_acceptance"] = $res->address_acceptance; 
				        $response["data"]["availability"]		= $res->availability;  	
				        $response["data"]["canceling_policy"] 	= $res->canceling_policy; 
						$response["data"]["acceptance"] 		= $res->acceptance; 		
						$response["data"]["seen_status"]		= $res->seen_status;            // 0=not, 1=yes
						$response["data"]["approv_status"]		= $res->approve_status;		
				        $response["account"]					= $data;
				        $response["discount"]					= $discount;
				        echo json_encode($response);								
					}
					else
					{
						$response["error"]=2;
						$response["message"]="Error occur! Not registred";
						echo json_encode($response);
					}
				}
				else
				{
					$response["error"]=3;
					$response["message"]="Password and confirm_password does not match";
					echo json_encode($response);
				}
			}					
		}
		else
		{
			$response["error"]=4;
			$response["message"]="Access Denied";
			echo json_encode($response);
		}
	} 

	

	public function individual_registration()
	{
		$response = array("success" => 0, "error" => 0);
		if (isset($_POST['user_type']) && $_POST['user_type'] != '')
		{	
			$user_type 			= $_POST['user_type'];   //1=individual,4=member		        
			$company_id			= $_POST['company_id'];	
			$device_type        = $_POST['device_type'];		 //0=android, 1=ios, 2=web
			$device_token		= $_POST['device_token'];
			$first_name			= $_POST['first_name'];
			$last_name			= $_POST['last_name'];
			$dob				= $_POST['dob'];
	        $address 			= $_POST['address'];
	        $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];	        
	        $mobile				= $_POST['mobile_no'];
	        $email				= $_POST['email'];
	        $gender				= $_POST['gender'];
	        $about				= $_POST['about'];
	        $provider_address	= $_POST['provider_address'];
	        $provider_lat 		= $_POST['provider_lat'];
			$provider_long 		= $_POST['provider_long'];
			$area				= $_POST['area'];
			$workarea			= json_decode($area);
	        $address_accept		= $_POST['address_accept']; 	//0=providerAdd,1=customerAdd,2=both
	        $availability		= $_POST['availability'];  		// 1-always 2-selectTime
	        $start_time 		= $_POST['start_time'];
	        $end_time			= $_POST['end_time'];
	        $days				= $_POST['days'];
	        $show_position 		= $_POST['show_position']; 		//0=off, 1=on
	        $canceling_policy 	= $_POST['canceling_policy'];  	// 1-flexible 2-strict 3-moderate
			$acceptance 		= $_POST['acceptance']; 		//0=instant,1=pre-approval
	        $db=$this->Registration_model->isuserexits($email,$user_type);
			if($db!=0)
			{  
		   		$response['error']=1;
		   		$response["success"]=0;
				$response["message"]="This email Id already registred";
				echo json_encode($response);
				exit;
			}
			else
			{	
				$referral_code =$this->referral_code();		
				$nn='default.jpg';
				if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
				{
					$r =$this->radomno();
					$s=$_FILES["image"]["tmp_name"];				
		            $picture=$r.$_FILES["image"]["name"];
		            $nn = preg_replace('/\s*/m', '',$picture);
		            $d="upload/".$nn;
		            move_uploaded_file($s,$d);
				}
				$data = array(
					'device_token'		=> $device_token,
					'company_id'		=> $company_id,
					'referral_code'		=> $referral_code,
					'first_name'		=> $first_name,
					'last_name'		    => $last_name,
					'dob'				=> $dob,
			        'address' 			=> $address,
			        'lat' 				=> $lat,
					'long' 				=> $long,	        
			        'mobile'			=> $mobile,
			        'user_image'		=> $nn,
			        'email'				=> $email,
			        'gender'			=> $gender,
			       	'about'				=> $about,
			       	'provider_address'  => $provider_address,
			       	'provider_lat'		=> $provider_lat,
			       	'provider_long'		=> $provider_long,
			       	'address_acceptance'=> $address_accept,
			       	'availability'      => $availability,
			       	'start_time'		=> $start_time,
			       	'end_time'			=> $end_time,
			       	'show_position'		=> $show_position,
			       	'canceling_policy'  => $canceling_policy,
		       		'acceptance'		=> $acceptance,
					'user_type'			=> $user_type,
					'device_type'		=> $device_type,
					'status'			=> 0
					);
				$res= $this->Registration_model->basicregistration($data,$email,$user_type);
				if($res)
				{
					if($days!='')
					{
						$day 				= explode(',',$days);
						$d 					= '';
						for($i=0; $i<count($day); $i++)               	// Payment Details
						{
							$d[]= array(
										'user_id'	=> $res,
										'day'		=> $day[$i],
						        		);				
						}
						$this->Registration_model->setdays($d,$res);					
					}

					if(!empty($workarea))
					{
						$geoarea='';
						foreach ($workarea as $key)
			    		{
			    			$ac["user_id"]= $res;
							$ac["area_address"]=$key->area_address;
							$ac["area_lat"]=$key->area_lat;
							$ac["area_lng"]=$key->area_lng;
							$ac["address_status"]='';
							$geoarea[]=$ac;
						}
						$c = count($geoarea);
						$geoarea[$c]= array(
							"user_id"=>$res,
							"area_address"=>$address,
							"area_lat"=>$lat,
							"area_lng"=>$long,
							"address_status"=>"1"
							);
						$this->Service_model->setArea($geoarea,$res);
					}	
					$response['error']=0;
			   		$response["success"]=1;
					$response["message"]="Success";
					$response["user_id"]=$res;
					echo json_encode($response);
				}
				else
				{
					$response['error']=1;
			   		$response["success"]=0;
					$response["message"]="Error occur! User does not registred";
					$response["user_id"]='';
					echo json_encode($response);
				}
			}
		}
		else
	    {
	    	$response["error"]=2;
	    	$response["message"]= "Access denied";
	    	echo json_encode($response);
	    }
	}

	public function individual_FinalRegistration()
    {
    	$response = array("success" => 0, "error" => 0);
		if (isset($_POST['user_id']) && $_POST['user_id'] != '')
		{	
			$user_id			= $_POST['user_id'];
	        $current_workplace  = $_POST['current_workplace'];
	        $previous_workplace = $_POST['previous_workplace'];
	        $experience			= $_POST['experience'];
			$password 			= $_POST['password'];
			$accept_term		= $_POST['accept_term'];  // Yes or No
			$approve_status		= 0;		//0=not approved, 1=approved			
			$data = array(	
		       	'current_workplace'	=> $current_workplace,
		       	'previous_workplace'=> $previous_workplace,
		       	'experience'		=> $experience,	       	
		       	'approve_status'	=> $approve_status,
		       	'password'			=> $password,
		       	'accept_term'		=> $accept_term,
				'status'			=> 1
				);
			$res= $this->Registration_model->finalregistration($data,$user_id);
			if($res)
			{
				$user_id=$res->id;
				$user_type= $res->user_type;
				$this->Setting_model->add_setting($user_id,$user_type);
				$response["error"]              = 0;    
	            $response["success"]            = 1;
	            $response["message"]            = "success";
	            $image = base_url().'upload/'.$res->user_image;
	            $response["data"]["user_id"]            = $res->id;
	            $response["data"]["company_id"]         = $res->company_id;
	            $response["data"]["user_image"]         = $image;
	            $response["data"]["user_type"]          = $res->user_type;      
	            $response["data"]["referral_code"]      = $res->referral_code;      
	            $response["data"]["device_token"]       = $res->device_token; 
	            $response["data"]["company_name"]       = $res->company_name;
	            $response["data"]["reg_no"]             = $res->registration_no;
	            $response["data"]["first_name"]         = $res->first_name;
	            $response["data"]["last_name"]          = $res->last_name;
	            $response["data"]["dob"]                = $res->dob;
	            $response["data"]["address"]            = $res->address;
	            $response["data"]["lat"]                = $res->lat;
	            $response["data"]["long"]               = $res->long; 
	            $response["data"]["provider_address"]   = $res->provider_address;
	            $response["data"]["provider_lat"]       = $res->provider_lat;
	            $response["data"]["provider_long"]      = $res->provider_long;           
	            $response["data"]["show_position"]      = $res->show_position;           
	            $response["data"]["mobile"]             = $res->mobile;
	            $response["data"]["email"]              = $res->email;
	            $response["data"]["password"]           = $res->password;
	            $response["data"]["gender"]             = $res->gender;
	            $response["data"]["about"]              = $res->about;                        
	            $response["data"]["address_acceptance"] = $res->address_acceptance; 
	            $response["data"]["availability"]       = $res->availability;  
	            $response["data"]["start_time"]         = $res->start_time;  
	            $response["data"]["end_time"]		    = $res->end_time;
	            $response["data"]["previous_workplace"] = $res->previous_workplace;  
	            $response["data"]["current_workplace"]  = $res->current_workplace;  
	            $response["data"]["experience"]		    = $res->experience;  
	            $response["data"]["canceling_policy"]   = $res->canceling_policy; 
	            $response["data"]["acceptance"]         = $res->acceptance;         
	            $response["data"]["seen_status"]        = $res->seen_status; // 0=not, 1=yes
	            $response["data"]["approv_status"]      = $res->approve_status;     
            	echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Error occur! Try again";
	    		$response["data"]				='';
	    		echo json_encode($response);
			}
		}
	}





	public function individual_registration1()
    {
    	$response = array("success" => 0, "error" => 0);
		if (isset($_POST['user_type']) && $_POST['user_type'] != '')
		{	
			$user_type 			= $_POST['user_type'];           //1=individual,2=customer,3=company
			$device_token		= $_POST['device_token'];
			$first_name			= $_POST['first_name'];
			$last_name			= $_POST['last_name'];
			$dob				= $_POST['dob'];
	        $address 			= $_POST['address'];
	        $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];	        
	        $mobile				= $_POST['mobile_no'];
	        $email				= $_POST['email'];
	        $password			= $_POST['password'];
			$confirm_password   = $_POST['cpassword'];
	        $gender				= $_POST['gender'];
	        $about				= $_POST['about'];

	        $provider_address	= $_POST['provider_address'];
	        $provider_lat 		= $_POST['provider_lat'];
			$provider_long 		= $_POST['provider_long'];

	        $address_accept		= $_POST['address_accept']; //0=providerAdd,1=customerAdd,2=both

	        $availability		= $_POST['availability'];  // 1-always 2-selectTime
	        $start_time 		= $_POST['start_time'];
	        $end_time			= $_POST['end_time'];

	        $show_position 		= $_POST['show_position']; //0=off, 1=on
	        $current_workplace  = $_POST['current_workplace'];
	        $previous_workplace = $_POST['previous_workplace'];
	        $experience			= $_POST['experience'];

	        $canceling_policy 	= $_POST['canceling_policy'];  		// 1-flexible 2-strict 3-moderate
			$acceptance 		= $_POST['acceptance']; 			//0=instant,1=pre-approval
			$seen_status		= $_POST['seen_status'];            // 0=not, 1=yes
			$approve_status		= $_POST['approve_status'];			//0=not approved, 1=approved
	        // payment param
	        $data				= $_POST['account'];       		//[{"secretno":"1132","type":"visa","status":"0"}]
			$accountdetails		= json_decode($data);
			
	        /*$secretno   		= array($_POST['secretno']);
	        $paymenttype		= array($_POST['paymenttype']); 			 //Type:- 0=debitcard,1=bank,2=paypal
	        $active_status		= array($_POST['active_status']);          //active_status : 0=not,1=active
	        $secretnos  		= explode(',',$secretno[0]);
	        $paymenttypes  		= explode(',',$paymenttype[0]);
	        $active_status  	= explode(',',$active_status[0]);*/

	        $db=$this->Registration_model->isuserexits($email);
			if($db!=0)
			{  
		   		$response['error']=1;
		   		$response["success"]=0;
				$response["message"]="This email Id already registred";
				echo json_encode($response);
				exit;
			}
			else
			{
				if($password==$confirm_password)
				{
					$referral_code =$this->referral_code();
					$nn='default.jpg';
					if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
					{
						$r =$this->radomno();
						$s=$_FILES["image"]["tmp_name"];				
			            $picture=$r.$_FILES["image"]["name"];
			            $nn = preg_replace('/\s*/m', '',$picture);
			            $d="upload/".$nn;
			            move_uploaded_file($s,$d);
					}
					$data = array(
						'device_token'		=> $device_token,
						'referral_code'		=> $referral_code,
						'first_name'		=> $first_name,
						'last_name'		    => $last_name,
						'dob'				=> $dob,
				        'address' 			=> $address,
				        'lat' 				=> $lat,
						'long' 				=> $long,	        
				        'mobile'			=> $mobile,
				        'user_image'		=> $nn,
				        'email'				=> $email,
						'password'			=> $password,
				        'gender'			=> $gender,
				       	'about'				=> $about,
				       	'provider_address'  => $provider_address,
				       	'provider_lat'		=> $provider_lat,
				       	'provider_long'		=> $provider_long,
				       	'address_acceptance'=> $address_accept,
				       	'availability'      => $availability,
				       	'start_time'		=> $start_time,
				       	'end_time'			=> $end_time,
				       	'show_position'		=> $show_position,
				       	'current_workplace'	=> $current_workplace,
				       	'previous_workplace'=> $previous_workplace,
				       	'experience'		=> $experience,	       	
				       	'canceling_policy'  => $canceling_policy,
				       	'acceptance'		=> $acceptance,
				       	'seen_status'		=> $seen_status,
				       	'approve_status'	=> $approve_status,
						'user_type'			=> $user_type
						);
					$res= $this->Registration_model->registration($data);
					$account =array();
					$i='';
					if($res)
					{
						$user_id=$res;
						foreach ($accountdetails as $key) {
							$ac["user_id"]=$user_id;
							$ac["secretno"]=$key->secretno;
							$ac["type"]=$key->type;
							$ac["status"]=$key->status;
							$account[]=$ac;
						}
						$data= $this->Registration_model->paymentdetail($account,$res);
						if($data)
						{
							$response["error"]				= 0;	
				    		$response["success"]			= 1;
				    		$response["message"]			= "success";
				    		$image = base_url().'upload/'.$data['u']->user_image;
				    		$response["data"]["user_id"]			= $data['u']->id; 
				    		$response["data"]["user_image"]			= $image;
				    		$response["data"]["user_type"] 			= $data['u']->user_type;   	
				    		$response["data"]["referral_code"] 		= $data['u']->referral_code;   	
							$response["data"]["device_token"]		= $data['u']->device_token; 
							$response["data"]["company_name"]		= $data['u']->company_name;
							$response["data"]["reg_no"]				= $data['u']->registration_no;
							$response["data"]["first_name"]			= $data['u']->first_name;
							$response["data"]["last_name"]			= $data['u']->last_name;
							$response["data"]["dob"]				= $data['u']->dob;
					        $response["data"]["address"] 			= $data['u']->address;
					       	$response["data"]["lat"] 				= $data['u']->lat;
							$response["data"]["long"] 				= $data['u']->long;	        
					     	$response["data"]["mobile"]				= $data['u']->mobile;
					        $response["data"]["email"]				= $data['u']->email;
					      	$response["data"]["password"]			= $data['u']->password;
					        $response["data"]["gender"]				= $data['u']->gender;
					       	$response["data"]["about"]				= $data['u']->about;					      
					        $response["data"]["address_acceptance"] = $data['u']->address_acceptance; 
					        $response["data"]["availability"]		= $data['u']->availability;  	
					        $response["data"]["canceling_policy"] 	= $data['u']->canceling_policy; 
							$response["data"]["acceptance"] 		= $data['u']->acceptance; 		
							$response["data"]["seen_status"]		= $data['u']->seen_status;   // 0=not, 1=yes
							$response["data"]["approv_status"]		= $data['u']->approve_status;		
					        $response["account"]					= $data['a'];
					        echo json_encode($response);								
						}
					}
					else
					{
						$response["error"]=2;
						$response["message"]="Error occur! Not registred";
						echo json_encode($response);
					}
				}
				else
				{
					$response["error"]=3;
					$response["message"]="Password and confirm_password does not match";
					echo json_encode($response);
				}
			}       
	    }
	    else
	    {
	    	$response["error"]=4;
	    	$response["message"]= "Access denied";
	    	echo json_encode($response);
	    }
    }



   public function certificate()
	{
		$certificate = array();
		$work = array();
		$instagram=array();
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$about_work				= '';
			$certificate_images		= '';
			$user_id 				= $_POST['user_id'];
			$insta_image	 		= $_POST['instagram_image'];
			$inst_image             = explode(",",$insta_image);
			//$inst_image 			= json_decode($insta_image);
			if(isset($_FILES['certificate_image'])=='' && isset($_FILES['work_image']) =='' && $_POST['instagram_image']=='')
			{
				$response['error']=0;
		   		$response["success"]=1;
				$response['message']="Success! No event occur";
				echo json_encode($response);
			}
			else
			{
				if(!empty($inst_image[0]))
				{
					for($i=0; $i<count($inst_image); $i++)
					{
						$ac["user_id"] = $user_id;
						$ac["about"]   = '';
						$ac["image"]   = $inst_image[$i];
					    $ac['type']	   = '';
						$ac["status"]  = 2;
						$ac["approve_status"]  = 1;
						$instagram[]   = $ac;
					}
					
				}

				if(isset($_FILES['certificate_image']) && $_FILES['certificate_image']!='')
				{								
					// $member_id = $_POST['member_id'];
					$about_certificate=$_POST['about_certificate'];				
					foreach($_FILES['certificate_image']['tmp_name'] as $key => $tmp_name )
					{
						$rand =$this->radomno();
						$type = $_FILES['certificate_image']['type'][$key];
				        $certificate_image_name = $rand.$_FILES['certificate_image']['name'][$key];
				        $s =  $_FILES['certificate_image']['tmp_name'][$key];
				        $certificate_image = preg_replace('/\s*/m', '',$certificate_image_name);
				        $d = "certificateimage/".$certificate_image;
				        $certificate_images[]= $certificate_image;  
				        $types[]=$type;
				        move_uploaded_file($s,$d);		        
					}
					for($i=0; $i<count($certificate_images); $i++)               	// Payment Details
					{
						$certificate[]= array(
									'user_id'	=> $user_id,
									'about'		=> $about_certificate,
					        		'image'		=> $certificate_images[$i],
					        		'type'		=> $types[$i],
					        		'status'		=> 1,
					        		'approve_status'=>0  
							);				
					}
				}

				if(isset($_FILES['work_image']) && $_FILES['work_image']!='')
				{					
					$work_images='';
					foreach($_FILES['work_image']['tmp_name'] as $key => $tmp_name )
					{
						$rand =$this->radomno();
						$type = $_FILES['work_image']['type'][$key];
				        $image_name = $rand.$_FILES['work_image']['name'][$key];
				        $s =  $_FILES['work_image']['tmp_name'][$key];
				        $name = preg_replace('/\s*/m', '',$image_name);
				        $d = "workimage/".$name;
				        $work_images[]= $name;  
				        $types[]=$type;
				        move_uploaded_file($s,$d);		        
					}
					for($i=0; $i<count($work_images); $i++) 
					{
						$work[]= array(
									'user_id'	=> $user_id,
									'about'		=> $about_work,
					        		'image'		=> $work_images[$i],
					        		'type'		=> $types[$i],
					        		'status'	=> 2,
					        		'approve_status'=>1
									);				
					}
				}
				$data = array_merge($certificate,$work,$instagram);
							
				if($this->Registration_model->certificate_detail($data))
				{
					$response['error']=0;
			   		$response["success"]=1;
					$response['message']="Success";
					echo json_encode($response);
				}
				else
				{
					$response['error']=1;
			   		$response["success"]=0;
					$response['message']="Not Success";
					echo json_encode($response);
				}
			}			
		}
		else
		{
			$response['error']=2;
		   	$response["success"]=0;
			$response['message']="Access Denied";
			echo json_encode($response);
		}
	}


	public function radomno()
    {
        $length=8;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $uuid = '';
            for ($i = 0; $i < $length; $i++) {
                $uuid .= $characters[rand(0, $charactersLength - 1)];
            }
            return $uuid;
    }
    
    public function referral_code()
    {
        $length=8;
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $code = '';
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, $charactersLength - 1)];
            }
            return $code;
    }

    public function login()
    {
    	$response = array("success" => 0, "error" => 0);
		if (isset($_POST['email']) && $_POST['email'] != '')
		{
			$device_token		= $_POST['device_token'];
			$email				= $_POST['email'];
			$password 			= $_POST['password'];
			$device_type        = $_POST['device_type'];
			$data = $this->Registration_model->login($email,$password,$device_token,$device_type);
			if($data)
			{
				$user_id         = $data['u']->id;
				$status_level    = $this->Freelancer_model->service_level($user_id);//Bronze,silver..
				$discount        = $this->Registration_model->discountDetails($user_id);
		    	if(!empty($discount))
		    	{
		    		$discount = $discount;
		    	}
		    	else
		    	{
		    		$discount ='';
		    	}
				if($data['u']->approve_status==1)
				{
					$response["error"]				= 0;	
		    		$response["success"]			= 1;
		    		$response["message"]			= "success";
		    		$image = base_url().'upload/'.$data['u']->user_image;
		    		$response["data"]["user_id"] 			= $data['u']->id;
		    		$response["data"]["user_image"]			= $image;
		    		$response["data"]["user_type"] 			= $data['u']->user_type;   	
		    		$response["data"]["referral_code"] 		= $data['u']->referral_code;   	
					$response["data"]["device_token"]		= $data['u']->device_token; 
					$response["data"]["company_name"]		= $data['u']->company_name;
					$response["data"]["reg_no"]				= $data['u']->registration_no;
					$response["data"]["first_name"]			= $data['u']->first_name;
					$response["data"]["last_name"]			= $data['u']->last_name;
					$response["data"]["dob"]				= $data['u']->dob;
			        $response["data"]["address"] 			= $data['u']->address;
			       	$response["data"]["lat"] 				= $data['u']->lat;
					$response["data"]["long"] 				= $data['u']->long;	        
			     	$response["data"]["mobile"]				= $data['u']->mobile;
			        $response["data"]["email"]				= $data['u']->email;
			      	$response["data"]["password"]			= $data['u']->password;
			        $response["data"]["gender"]				= $data['u']->gender;
			       	$response["data"]["about"]				= $data['u']->about;					      
			        $response["data"]["address_acceptance"] = $data['u']->address_acceptance; 
			        $response["data"]["availability"]		= $data['u']->availability;  	
			        $response["data"]["canceling_policy"] 	= $data['u']->canceling_policy; 
					$response["data"]["acceptance"] 		= $data['u']->acceptance; 		
					$response["data"]["seen_status"]		= $data['u']->seen_status;            // 0=not, 1=yes
					$response["data"]["approv_status"]		= $data['u']->approve_status;
					$response["data"]["complete_serviceLevel"]= $status_level;		
			        $response["account"]					= $data['a'];
			        $response["discount"]					= $discount;
			        echo json_encode($response);
			    }
				else
			    {
			    	$response["error"]          = 2;    
		            $response["success"]        = 0;
		            $response["message"]        = "User is not approved by syplo admin.";
		            echo json_encode($response);
			    }
			}
			else
			{
				$response["error"]          = 1;    
	            $response["success"]        = 0;
	            $response["message"]        = "Enter correct email and password";
	            echo json_encode($response);
			}
			
		}
		else
	    {
	    	$response["error"]=4;
	    	$response["message"]= "Access denied";
	    	echo json_encode($response);
	    }
    } 

    public function multiAccountLogin()
    {
    	$response = array("success" => 0, "error" => 0);
		if (isset($_POST['id']) && $_POST['id'] != '')
		{
			$device_token		= $_POST['device_token'];
			$id 				= $_POST['id'];	
			$device_type        = $_POST['device_type'];
			$data = $this->Registration_model->getUserDetail($id,$device_token,$device_type);
			if($data)
			{
				$status_level    = $this->Freelancer_model->service_level($id);//Bronze,silver..
				$discount 		 = $this->Registration_model->discountDetails($id);
		    	if(!empty($discount))
		    	{
		    		$discount = $discount;
		    	}
		    	else
		    	{
		    		$discount ='';
		    	}
				if($data['u']->approve_status==1)
				{
					$response["error"]				= 0;	
		    		$response["success"]			= 1;
		    		$response["message"]			= "success";
		    		$image = base_url().'upload/'.$data['u']->user_image;
		    		$response["data"]["user_image"]			= $image;
		    		$response["data"]["user_id"] 			= $data['u']->id;
		    		$response["data"]["user_type"] 			= $data['u']->user_type;   	
					$response["data"]["device_token"]		= $data['u']->device_token; 
					$response["data"]["company_name"]		= $data['u']->company_name;
					$response["data"]["reg_no"]				= $data['u']->registration_no;
					$response["data"]["first_name"]			= $data['u']->first_name;
					$response["data"]["last_name"]			= $data['u']->last_name;
					$response["data"]["dob"]				= $data['u']->dob;
			        $response["data"]["address"] 			= $data['u']->address;
			       	$response["data"]["lat"] 				= $data['u']->lat;
					$response["data"]["long"] 				= $data['u']->long;	        
			     	$response["data"]["mobile"]				= $data['u']->mobile;
			        $response["data"]["email"]				= $data['u']->email;
			      	$response["data"]["password"]			= $data['u']->password;
			        $response["data"]["gender"]				= $data['u']->gender;
			       	$response["data"]["about"]				= $data['u']->about;

			        $response["data"]["address_acceptance"] = $data['u']->address_acceptance; 
			        $response["data"]["availability"]		= $data['u']->availability;  	
			        $response["data"]["canceling_policy"] 	= $data['u']->canceling_policy; 
					$response["data"]["acceptance"] 		= $data['u']->acceptance; 		
					$response["data"]["seen_status"]		= $data['u']->seen_status;      // 0=not, 1=yes
					$response["data"]["approv_status"]		= $data['u']->approve_status;
					$response["data"]["complete_serviceLevel"]= $status_level;		
			        $response["account"]					= $data['a'];
			        $response["discount"]					= $discount;
			        echo json_encode($response);
		        }
				else
			    {
			    	$response["error"]          = 2;    
		            $response["success"]        = 0;
		            $response["message"]        = "User is not approved by syplo admin.";
		            echo json_encode($response);
			    }
			}
			else
			{
				$response["error"]          = 1;    
	            $response["success"]        = 0;
	            $response["message"]        = "User not found!";
	            echo json_encode($response);
			}	
		}
		else
	    {
	    	$response["error"]=4;
	    	$response["message"]= "Access denied";
	    	echo json_encode($response);
	    }
    }


    public function forget_password()
  	{
  		$response = array("success" => 0, "error" => 0);
  		if(isset($_POST['tag']) && $_POST['tag']!='')
  		{
  			$tag = $_POST['tag'];
  			$res = '';
  			if($tag=='Email' && isset($_POST['email']) && $_POST['email']!='')
  			{
  				$email = $_POST['email'];
				$res = $this->Registration_model->forget_password($email);
				if($res)
				{
					$response["success"]        = 1;
					$response['message']		= "Please Check your Email inbox or spam";
					$response['Email ']			= $email;
					echo json_encode($response);
					exit;				
				}
				else
				{
					$response["error"]          = 2;    
		            $response["success"]        = 0;
					$response['message']		= "Error occur! Please try again";
					echo json_encode($response);
					exit;			
				}
  			}
  			elseif ($tag=='MultiEmail' && isset($_POST['user_id']) && $_POST['user_id']!='') 
  			{
  				$id    = $_POST['user_id'];
				$email = $_POST['email'];
				$res   = $this->Registration_model->ForgetpasswordForMultipleEmail($id);
				if($res)
				{
					$response["success"]        = 1;
					$response['message']		= "Please Check your Email inbox or spam";
					$response['Email ']			= $email;
					echo json_encode($response);
					exit;				
				}
				else
				{
					$response["error"]          = 2;    
		            $response["success"]        = 0;
					$response['message']		= "Error occur! Please try again";
					echo json_encode($response);
					exit;			
				}
  			}
  			else
  			{
  				$response["error"]		=4;
		    	$response["message"]	="Access denied";
		    	echo json_encode($response);
  			}
  		}
  		else
		{
			$response["error"]		=3;
    		$response["message"]	="Access denied";
    		echo json_encode($response);
		}
  	}

  	public function change_password()
  	{
  		$response = array("success" => 0, "error" => 0);
  		if(isset($_POST['id']) && $_POST['id']!='')
  		{
			$id=$this->input->post('id');
			$old_password=$this->input->post('old_password');
			$password=$this->input->post('new_password');
			$cpassword=$this->input->post('confirm_password');
			if($password==$cpassword)
			{
				if($this->Registration_model->change_password($id,$old_password,$password))
				{
					$response["error"]				= 0;	
	    			$response["success"]			= 1;
	    			$response["message"]			= "Password has been changed successfull";
	    			echo json_encode($response);
				}
				else
				{
					$response["error"]				= 1;	
	    			$response["success"]			= 0;
	    			$response["message"]			= "Error Occur! Password is not change";
	    			echo json_encode($response);
				}
			}
			else
			{
				$response["error"]				= 2;	
    			$response["success"]			= 0;
    			$response["message"]			= "Password and confirm_password does not match";
    			echo json_encode($response);
			}
  		}
  		else
  		{
  			$response["error"]		= 4;
	    	$response["message"]	= "Access denied";
	    	echo json_encode($response);
  		}
  	}

  	public function profile_update()
  	{
  		if(isset($_POST['user_id']) && $_POST['user_id']!='')
  		{	
			$user_id 			= $_POST['user_id'];
			$first_name			= $_POST['first_name'];
			$last_name			= $_POST['last_name'];
			$dob				= $_POST['dob'];
	        $address 			= $_POST['address'];
	        $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];
	        $mobile				= $_POST['mobile_no'];
	        $gender				= $_POST['gender'];
	        $about				= $_POST['about'];
	        $update_at			= date('y-m-d h:i:s');
	        $result= $this->Registration_model->profiledata($user_id);
	        $email              = $_POST['email'];
	        if($email!=$result->email)                             // When email is update
	        {
	        	$db = $this->Registration_model->isuserexits($email);
	        	if($db!=0)
				{  
			   		$response['error']	= 1;
			   		$response["success"]= 0;
					$response["message"]= "This email Id already registred";
					echo json_encode($response);
					exit;
				}
				else
				{
					$nn 		= $result->user_image;
			        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
					{
						if($result->user_image!='default.jpg')
						{				
							unlink('upload/'.$result->user_image);
						}
						$r =$this->radomno();
						$s=$_FILES["image"]["tmp_name"];				
			            $picture=$r.$_FILES["image"]["name"];
			            $nn = preg_replace('/\s*/m', '',$picture);
			            $d="upload/".$nn;
			            move_uploaded_file($s,$d);
					}
					$data = array(
							'first_name'		=> $first_name,
							'last_name'			=> $last_name,
							'dob'				=> $dob,
					        'address' 			=> $address,
					        'lat' 				=> $lat,
							'long' 				=> $long,	        
					        'mobile'			=> $mobile,
					        'user_image'		=> $nn,
					        'email'				=> $email,
					        'gender'			=> $gender,
					       	'about'				=> $about,
					       	'update_at'			=> $update_at
					       	);
					$this->Registration_model->profile_update($user_id,$data);
					exit;
				}
	        }		
			else     											 // When email is not update
			{			
	        	$nn 				= $result->user_image;
		        if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
				{
					if($result->user_image!='default.jpg')
					{				
						unlink('upload/'.$result->user_image);
					}
					$r =$this->radomno();
					$s=$_FILES["image"]["tmp_name"];				
		            $picture=$r.$_FILES["image"]["name"];
		            $nn = preg_replace('/\s*/m', '',$picture);
		            $d="upload/".$nn;
		            move_uploaded_file($s,$d);
				}

				$data = array(
						'first_name'		=> $first_name,
						'last_name'			=> $last_name,
						'dob'				=> $dob,
				        'address' 			=> $address,
				        'lat' 				=> $lat,
						'long' 				=> $long,	        
				        'mobile'			=> $mobile,
				        'user_image'		=> $nn,
				        'email'				=> $email,
				        'gender'			=> $gender,
				       	'about'				=> $about,
				       	'update_at'			=> $update_at
				       	);
				$this->Registration_model->profile_update($user_id,$data);
				exit;
			}   
  		}
	  	else
	  	{
	  		$response["error"]		= 4;
	    	$response["message"]	= "Update Access denied";
	    	echo json_encode($response);
	  	}
  	}  

  	public function logout()
  	{
  		if(isset($_POST['user_id']) && $_POST['user_id']!='')
  		{
  			$user_id 			= $_POST['user_id'];
  			if($this->Registration_model->logout($user_id))
  			{
  				$response["error"]		= 0;
  				$response["success"]	= 1;
		    	$response["message"]	= "Log out successfull !!";
		    	echo json_encode($response);
  			}
  			else
  			{
  				$response["error"]		= 1;
  				$response["success"]	= 0;
		    	$response["message"]	= "Error occur! Try again";
		    	echo json_encode($response);
  			}
  		}
  		else
  		{
  			$response["error"]		= 2;
			$response["success"]	= 0;
			$response["message"]	= "Access Denied";
			echo json_encode($response);
  		}
  	}

  	public function certificateImage()
    {
    	if(isset($_FILES['certificate_image']['name']) && $_FILES['certificate_image']['name']!='')
		{
			$user_id= $_POST['user_id'];
			$r =$this->radomno();
			$s=$_FILES["certificate_image"]["tmp_name"];
			$type = $_FILES['certificate_image']['type'];				
	        $picture=$r.$_FILES["certificate_image"]["name"];
	        $nn = preg_replace('/\s*/m', '',$picture);
	        $d="certificateimage/".$nn;
	        move_uploaded_file($s,$d);
	        $data= array(
	        			'user_id'	=> $user_id,
		        		'image'		=> $nn,
		        		'type'		=> $type,
		        		'status'		=> 1  
	        			);
	       if($res= $this->Registration_model->certificateImage($data,$user_id))
	       {
	       		$response["error"]=0;
		   		$response["success"]=1;
				$response["message"]="Success";
				$response["Imageurl"]="freebizoffer.com/apptech/spylo/certificateimage/";
				$response["Images"]=$res;
				echo json_encode($response);
	       }
	       else
	       {
	       		$response['error']=1;
		   		$response["success"]=0;
				$response['message']="Not Success";
				echo json_encode($response);
	       }
		}
    } 
}
