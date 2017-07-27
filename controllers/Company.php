<?php
									// API Company Controler
defined('BASEPATH') OR exit('No direct script access allowed');
class Company extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->model('Service_model');
        $this->load->model('Order_model');
        $this->load->model('Registration_model');
        $this->load->model('Freelancer_model');
        $this->load->model('Communication_model');
	}

	public function index()
	{
		$response["error"]		= 1;
		$response["success"]    = 0;
    	$response["message"]	= "Access denied";
    	echo json_encode($response);
	}

	public function radomno()
    {
        $length=8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $uuid = '';
        for ($i = 0; $i < $length; $i++) 
        {
            $uuid .= $characters[rand(0, $charactersLength - 1)];
        }
        return $uuid;
    }

	public function profile_update()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{	
			$user_id 			= $_POST['user_id'];
			$company_name		= $_POST['company_name'];
			$registration_no	= $_POST['registration_no'];
		    $address 			= $_POST['address'];
		    $lat 				= $_POST['lat'];
			$long 				= $_POST['long'];
		    $mobile				= $_POST['mobile_no'];
		    $update_at			= date('y-m-d h:i:s');
		    $result= $this->Company_model->profiledata($user_id);
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
					'company_name'		=> $company_name,
					'registration_no'	=> $registration_no,
			        'address' 			=> $address,
			        'lat' 				=> $lat,
					'long' 				=> $long,	        
			        'mobile'			=> $mobile,
			        'user_image'		=> $nn,
			       	'update_at'			=> $update_at
			       	);
			if($this->Company_model->profile_update($user_id,$data))
			{
				$res= $this->Company_model->profiledata($user_id);
				$response["error"]              = 0;    
	            $response["success"]            = 1;
	            $response["message"]            = "Profile has been updated successfully";
	            $image = base_url().'upload/'.$res->user_image;
	            $response["data"]["user_image"]         = $image;
	            $response["data"]["user_type"]          = $res->user_type;      
	            $response["data"]["device_token"]       = $res->device_token; 
	            $response["data"]["company_name"]       = $res->company_name;
	            $response["data"]["reg_no"]             = $res->registration_no;
	            $response["data"]["address"]            = $res->address;
	            $response["data"]["lat"]                = $res->lat;
	            $response["data"]["long"]               = $res->long;           
	            $response["data"]["email"]              = $res->email;
	            $response["data"]["mobile"]             = $res->mobile;
	            $response["data"]["first_name"]          = $res->first_name;
	            $response["data"]["last_name"]          = $res->last_name;
	            $response["data"]["dob"]                = $res->dob;
	            $response["data"]["gender"]             = $res->gender;
	            $response["data"]["about"]              = $res->about;                        
	            $response["data"]["address_acceptance"] = $res->address_acceptance; 
	            $response["data"]["availability"]       = $res->availability;   
	            $response["data"]["canceling_policy"]   = $res->canceling_policy; 
	            $response["data"]["acceptance"]         = $res->acceptance;         
	            $response["data"]["seen_status"]        = $res->seen_status;            // 0=not, 1=yes
	            $response["data"]["approv_status"]      = $res->approve_status;     
	            echo json_encode($response);  
			}
			else
			{
				$response["error"]      = 1;
	            $response["success"]    = 0;
	            $response["message"]    = "Error Occur! Profile is not update";
	            echo json_encode($response);
			}
		}		
		else
		{
			$response["success"]    = 0;
			$response["error"]		= 2;
			$response["message"]	= "Update Access denied";
			echo json_encode($response);
		}
	}

	public function service_request_list()
	{
		if(isset($_POST['company_id']) && $_POST['company_id']!='')
		{
			$company_id    = $_POST['company_id'];
			$member_ids	   = $this->Company_model->members($company_id);
			if(!empty($member_ids))
			{
				$rr     = array(); 
				//print_r($member_ids);
				$response   = $this->Company_model->order_request($member_ids);
				//print_r(count($response));
				//echo json_encode($response);die();

				if(!empty($response))
				{
			        //echo json_encode($response);die();
			        for ($j=0; $j<count($response); $j++) 
			        { 
			        	foreach ($response[$j] as $key => $value) 
				        {
				        	//print_r($value["data"]->id);die();
				        	$aa  = $value["data"]->dob;
							$age = $this->Order_model->CalculateAge($aa); 
				        	$order_id=$value["data"]->id;
				        	//echo $order_id;
				        	$cust_id  = $value["data"]->customer_id;
				        	$latestReview   = $this->Freelancer_model->get_latestReview($cust_id);
				        	$rating  = $this->Freelancer_model->get_rating($cust_id);
				        	$req_services_details = $this->Order_model->order_service($order_id);
				        	//echo json_encode($req_services_details);			        	
				        	if(!empty($req_services_details))
				        	{
					        	foreach ($req_services_details as $key1 => $rsdd) 
					        	{
					        		$rsd["service_id"]		= $rsdd->service_id;
					        		$rsd["order_service_id"]= $rsdd->id;
					        		$rsd["order_id"]		= $rsdd->order_id;
					        		$rsd["category"] 		= $rsdd->category;
					        		$rsd["sub_category"]	= $rsdd->sub_category;
					        		$rsd["price"]			= $rsdd->price;
					        		$rsd["pricetype"]		= $rsdd->price_type;
					        		$rsd["create_at"]		= $rsdd->create_at;
					        		$rsd["service_type"]	= $rsdd->service_type;
					        		$req_details[] 	= $rsd;
					        	}
					        }
					        else
				        	{
				        		$req_details = $req_services_details;
				        	}
				        	$ano_services_details = $this->Order_model->another_orderService($order_id);
				        	if(!empty($ano_services_details))
				        	{
				        		foreach ($ano_services_details as $key => $asdd) 
				        		{
					        		$asd["service_id"]		= $asdd->service_id;
					        		$asd["order_service_id"]= $asdd->id;
					        		$asd["order_id"]		= $rsdd->order_id;
					        		$asd["category"] 		= $asdd->category;
					        		$asd["sub_category"]	= $asdd->sub_category;
					        		$asd["price"]			= $asdd->price;
					        		$asd["pricetype"]		= $asdd->price_type;
					        		$asd["create_at"]		= $asdd->create_at;
					        		$asd["service_type"]	= $asdd->service_type;
					        		$anoservices_detail[] 	= $asd;
				        		}
				        	}
				        	else
				        	{
				        		$anoservices_detail = $ano_services_details;
				        	}		        	
			                $image = base_url().'upload/'.$value["data"]->user_image;
			                $r["user_image"]         = $image; 
			                $r["order_id"]           = $value["data"]->id;
			                $r["company_id"]         = $value["memberDetails"]->company_id;
			                $r["member_id"]          = $value["data"]->provider_id;
			                $r["member_name"]		 = $value["memberDetails"]->first_name.' '.$value["memberDetails"]->last_name;
			                $r["provider_email"] 	 = $value["memberDetails"]->email;	
			                $r["customer_id"]        = $value["data"]->customer_id;
			                // $r["user_type"]          = $value["data"]->user_type;      
			                $r["customer_name"]      = $value["data"]->first_name.' '.$value["data"]->last_name;
			                $r["customer_email"]     = $value["data"]->email;
			                $r["order_date"]         = $value["data"]->date;
			                $r["order_time"]         = $value["data"]->time;
			                $r["address_type"]       = $value["data"]->address_type; 
			                $r["address"]            = $value["data"]->address;
			                $r["lat"]                = $value["data"]->lat;
			                $r["lng"]                = $value["data"]->lng;
							$r["gender"]             = $value["data"]->gender;
							$r["age"]                = $age;
							$r["about"]              = $value["data"]->about;
			                $r["rating"]			 = $rating;
			                $r["latestReview"]		 = $latestReview;
			                $r["approve_status"]     = $value["data"]->approve_status; 
			                $r["order_status"]       = $value["data"]->order_status;
			                $r["services_details"]   = $req_details;
			                $r["another_services"]   = $anoservices_detail;	                
			                //$r["data"]["age"]                = $age;             
			                $offer[]=$r;
			                $req_details='';
				        }				        
			        }
			        $offer_res["error"]				= 0;	
					$offer_res["success"]			= 1;
					$offer_res["message"]			= "Success";
					$offer_res["data"]				= $offer;
					echo json_encode($offer_res);
			        
				}
				else
				{
					$response["error"]				= 1;	
					$response["success"]			= 0;
					$response["message"]			= "No Service request";
					$response["data"]				= [];
					echo json_encode($response);
				}
			}
			else
			{
				$response["error"]				= 2;	
				$response["success"]			= 0;
				$response["message"]			= "You have no member";
				$response["data"]				= [];
				echo json_encode($response);
			}
		}			
		else
		{
			$response["error"]				= 3;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}

	function keyChanges($user_detail)
	{
		$image = base_url().'upload/'.$user_detail->user_image;
		foreach($user_detail as $key => $val)
		{
		    if ($key=='user_image')
		    {
		    	$user_detail->user_image = $image;
		    }
		    if($key=='id')
		    {
		    	$user_detail->user_id= $user_detail->id;
		    }
		    if($key=='created_at')
		    {
		    	unset($user_detail->id);
		    	unset($user_detail->created_at);
		    	unset($user_detail->password);
		    }
		}
		return $user_detail;
	}


	public function CompanyBookingCalander()
	{
		if(isset($_POST['company_id']) && $_POST['company_id']!='')
		{
			$company_id    = $_POST['company_id'];
			$member_ids	   = $this->Company_model->members($company_id);
			if(!empty($member_ids))
			{
				$rr     = array(); 
				//print_r($member_ids);die();
				$response   = $this->Company_model->CompanyBookingCalander($member_ids);
				//print_r(count($response));
				//echo json_encode($response);die();

				if(!empty($response))
				{
			        //echo json_encode($response);die();
			        for ($j=0; $j<count($response); $j++) 
			        { 
			        	foreach ($response[$j] as $key => $value) 
				        {
				        	//print_r($value["data"]->id);die();
				        	$aa  = $value["data"]->dob;
							$age = $this->Order_model->CalculateAge($aa); 
				        	$order_id=$value["data"]->id;
				        	//echo $order_id;
				        	$cust_id  = $value["data"]->customer_id;
				        	$latestReview   = $this->Freelancer_model->get_latestReview($cust_id);
				        	$rating  = $this->Freelancer_model->get_rating($cust_id);
				        	$req_services_details = $this->Order_model->order_service($order_id);
				        	//echo json_encode($req_services_details);			        	
				        	if(!empty($req_services_details))
				        	{
					        	foreach ($req_services_details as $key1 => $rsdd) 
					        	{
					        		$rsd["service_id"]		= $rsdd->service_id;
					        		$rsd["order_service_id"]= $rsdd->id;
					        		$rsd["order_id"]		= $rsdd->order_id;
					        		$rsd["category"] 		= $rsdd->category;
					        		$rsd["sub_category"]	= $rsdd->sub_category;
					        		$rsd["price"]			= $rsdd->price;
					        		$rsd["pricetype"]		= $rsdd->price_type;
					        		$rsd["create_at"]		= $rsdd->create_at;
					        		$rsd["service_type"]	= $rsdd->service_type;
					        		$req_details[] 	= $rsd;
					        	}
					        }
					        else
				        	{
				        		$req_details = $req_services_details;
				        	}
				        	$ano_services_details = $this->Order_model->another_orderService($order_id);
				        	if(!empty($ano_services_details))
				        	{
				        		foreach ($ano_services_details as $key => $asdd) 
				        		{
					        		$asd["service_id"]		= $asdd->service_id;
					        		$asd["order_service_id"]= $asdd->id;
					        		$asd["order_id"]		= $rsdd->order_id;
					        		$asd["category"] 		= $asdd->category;
					        		$asd["sub_category"]	= $asdd->sub_category;
					        		$asd["price"]			= $asdd->price;
					        		$asd["pricetype"]		= $asdd->price_type;
					        		$asd["create_at"]		= $asdd->create_at;
					        		$asd["service_type"]	= $asdd->service_type;
					        		$anoservices_detail[] 	= $asd;
				        		}
				        	}
				        	else
				        	{
				        		$anoservices_detail = $ano_services_details;
				        	}		        	
			                $image = base_url().'upload/'.$value["data"]->user_image;
			                $r["user_image"]         = $image; 
			                $r["order_id"]           = $value["data"]->id;
			                $r["company_id"]         = $value["memberDetails"]->company_id;
			                $r["member_id"]          = $value["data"]->provider_id;
			                $r["member_name"]		 = $value["memberDetails"]->first_name.' '.$value["memberDetails"]->last_name;
			                $r["provider_email"] 	 = $value["memberDetails"]->email;	
			                $r["customer_id"]        = $value["data"]->customer_id;
			                // $r["user_type"]          = $value["data"]->user_type;      
			                $r["customer_name"]      = $value["data"]->first_name.' '.$value["data"]->last_name;
			                $r["customer_email"]     = $value["data"]->email;
			                $r["order_date"]         = $value["data"]->date;
			                $r["order_time"]         = $value["data"]->time;
			                $r["address_type"]       = $value["data"]->address_type; 
			                $r["address"]            = $value["data"]->address;
			                $r["lat"]                = $value["data"]->lat;
			                $r["lng"]                = $value["data"]->lng;
							$r["gender"]             = $value["data"]->gender;
							$r["age"]                = $age;
							$r["about"]              = $value["data"]->about;
			                $r["rating"]			 = $rating;
			                $r["latestReview"]		 = $latestReview;
			                $r["approve_status"]     = $value["data"]->approve_status; 
			                $r["order_status"]       = $value["data"]->order_status;
			                $r["services_details"]   = $req_details;
			                $r["another_services"]   = $anoservices_detail;	                
			                //$r["data"]["age"]                = $age;             
			                $offer[]=$r;
			                $req_details='';
				        }				        
			        }
			        $offer_res["error"]				= 0;	
					$offer_res["success"]			= 1;
					$offer_res["message"]			= "Success";
					$offer_res["data"]				= $offer;
					echo json_encode($offer_res);
			        
				}
				else
				{
					$response["error"]				= 1;	
					$response["success"]			= 0;
					$response["message"]			= "No Booking";
					$response["data"]				= [];
					echo json_encode($response);
				}
			}
			else
			{
				$response["error"]				= 2;	
				$response["success"]			= 0;
				$response["message"]			= "You have no member";
				$response["data"]				= [];
				echo json_encode($response);
			}
		}			
		else
		{
			$response["error"]				= 3;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}

	public function CompanyBookingHistory()
	{
		if(isset($_POST['company_id']) && $_POST['company_id']!='')
		{
			$company_id    = $_POST['company_id'];
			$member_ids	   = $this->Company_model->members($company_id);
			if(!empty($member_ids))
			{
				$rr     = array(); 
				//print_r($member_ids);die();
				$response   = $this->Company_model->CompanyBookingHistory($member_ids);
				//print_r(count($response));
				//echo json_encode($response);die();

				if(!empty($response))
				{
			        //echo json_encode($response);die();
			        for ($j=0; $j<count($response); $j++) 
			        { 
			        	foreach ($response[$j] as $key => $value) 
				        {
				        	//print_r($value["data"]->id);die();
				        	$aa  = $value["data"]->dob;
							$age = $this->Order_model->CalculateAge($aa); 
				        	$order_id=$value["data"]->id;
				        	//echo $order_id;
				        	$cust_id  = $value["data"]->customer_id;
				        	$latestReview   = $this->Freelancer_model->get_latestReview($cust_id);
				        	$rating  = $this->Freelancer_model->get_rating($cust_id);
				        	$req_services_details = $this->Order_model->order_service($order_id);
				        	//echo json_encode($req_services_details);			        	
				        	if(!empty($req_services_details))
				        	{
					        	foreach ($req_services_details as $key1 => $rsdd) 
					        	{
					        		$rsd["service_id"]		= $rsdd->service_id;
					        		$rsd["order_service_id"]= $rsdd->id;
					        		$rsd["order_id"]		= $rsdd->order_id;
					        		$rsd["category"] 		= $rsdd->category;
					        		$rsd["sub_category"]	= $rsdd->sub_category;
					        		$rsd["price"]			= $rsdd->price;
					        		$rsd["pricetype"]		= $rsdd->price_type;
					        		$rsd["create_at"]		= $rsdd->create_at;
					        		$rsd["service_type"]	= $rsdd->service_type;
					        		$req_details[] 	= $rsd;
					        	}
					        }
					        else
				        	{
				        		$req_details = $req_services_details;
				        	}
				        	$ano_services_details = $this->Order_model->another_orderService($order_id);
				        	if(!empty($ano_services_details))
				        	{
				        		foreach ($ano_services_details as $key => $asdd) 
				        		{
					        		$asd["service_id"]		= $asdd->service_id;
					        		$asd["order_service_id"]= $asdd->id;
					        		$asd["order_id"]		= $rsdd->order_id;
					        		$asd["category"] 		= $asdd->category;
					        		$asd["sub_category"]	= $asdd->sub_category;
					        		$asd["price"]			= $asdd->price;
					        		$asd["pricetype"]		= $asdd->price_type;
					        		$asd["create_at"]		= $asdd->create_at;
					        		$asd["service_type"]	= $asdd->service_type;
					        		$anoservices_detail[] 	= $asd;
				        		}
				        	}
				        	else
				        	{
				        		$anoservices_detail = $ano_services_details;
				        	}		        	
			                $image = base_url().'upload/'.$value["data"]->user_image;
			                $r["user_image"]         = $image; 
			                $r["order_id"]           = $value["data"]->id;
			                $r["company_id"]         = $value["memberDetails"]->company_id;
			                $r["member_id"]          = $value["data"]->provider_id;
			                $r["member_name"]		 = $value["memberDetails"]->first_name.' '.$value["memberDetails"]->last_name;
			                $r["provider_email"] 	 = $value["memberDetails"]->email;	
			                $r["customer_id"]        = $value["data"]->customer_id;
			                // $r["user_type"]          = $value["data"]->user_type;      
			                $r["customer_name"]      = $value["data"]->first_name.' '.$value["data"]->last_name;
			                $r["customer_email"]     = $value["data"]->email;
			                $r["order_date"]         = $value["data"]->date;
			                $r["order_time"]         = $value["data"]->time;
			                $r["address_type"]       = $value["data"]->address_type; 
			                $r["address"]            = $value["data"]->address;
			                $r["lat"]                = $value["data"]->lat;
			                $r["lng"]                = $value["data"]->lng;
							$r["gender"]             = $value["data"]->gender;
							$r["age"]                = $age;
							$r["about"]              = $value["data"]->about;
			                $r["rating"]			 = $rating;
			                $r["latestReview"]		 = $latestReview;
			                $r["approve_status"]     = $value["data"]->approve_status; 
			                $r["order_status"]       = $value["data"]->order_status;
			                $r["services_details"]   = $req_details;
			                $r["another_services"]   = $anoservices_detail;	                
			                //$r["data"]["age"]                = $age;             
			                $offer[]=$r;
			                $req_details='';
				        }				        
			        }
			        $offer_res["error"]				= 0;	
					$offer_res["success"]			= 1;
					$offer_res["message"]			= "Success";
					$offer_res["data"]				= $offer;
					echo json_encode($offer_res);
			        
				}
				else
				{
					$response["error"]				= 1;	
					$response["success"]			= 0;
					$response["message"]			= "No Booking";
					$response["data"]				= [];
					echo json_encode($response);
				}
			}
			else
			{
				$response["error"]				= 2;	
				$response["success"]			= 0;
				$response["message"]			= "You have no member";
				$response["data"]				= [];
				echo json_encode($response);
			}
		}			
		else
		{
			$response["error"]				= 3;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}

	public function company_member_list()
	{
		if(isset($_POST['company_id']) && $_POST['company_id']!='')
		{
			$company_id    = $_POST['company_id'];
			$member_id	   = $this->Company_model->members($company_id);
			if(!empty($member_id))
			{
				foreach ($member_id as $key => $value) 
				{
					$user_id =$value->id;  //this is a member id
					$member_detail	 = $this->Registration_model->profiledata($user_id);
					//$member_detail = $this->Freelancer_model->customer_profile($value->id);
					if($member_detail!='')
					{
						$details = $this->keyChanges($member_detail);
						$CustomerAddress = $this->Freelancer_model->allCustomerAddress($user_id);
						$userDays 		 = $this->Freelancer_model->userDays($user_id);	
						$serviceRate	 = $this->Freelancer_model->service_price($user_id);
						$addKey          = 0;
						if(!empty($serviceRate))
						{					
							$serviceRate     = $this->Freelancer_model->actualservice($serviceRate,$addKey);
						}
						$anoservicesRate = $this->Freelancer_model->anoservice_price($user_id);
						$addKey1          = 1;
						if(!empty($anoservicesRate))
						{
							$anoservicesRate = $this->Freelancer_model->anotherservice($anoservicesRate,$addKey1);
						}
						$certificate	 = $this->Order_model->ProviderCertificate($user_id);
						$WorkImage		 = $this->Order_model->ProviderWorkImage($user_id);				
			
						$response["user_detail"]        = $details;
						$response["customer_address"]   = $CustomerAddress; 
						$response["userDays"]           = $userDays;
						$response["serviceRate"]        = $serviceRate;
						$response["anoservicesRate"]    = $anoservicesRate;
						$response["Certificate_url"]	= base_url().'certificateimage/';
			            $response["certificate"]    	= $certificate; 
			            $response["WorkImage_url"]		= base_url().'workimage/';
			            $response["Work_Performed"]	    = $WorkImage; 
						//echo json_encode($response);die();						
						$mem_details[]=$response;
						//$memberDet[]= $member_details;
					}
				}
				$res["error"]			= 0;	
				$res["success"]			= 1;
				$res["message"]			= "Success";
				$res["data"]			= $mem_details;
				echo json_encode($res);
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "No Member Found!";
				$response["data"]				= array();
				echo json_encode($response);
			}
		}
		else
		{
			$response["error"]				= 1;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}

	public function delete_member()
	{
		if(isset($_POST['member_id']) && $_POST['member_id']!='')
		{
			$member_id   = $_POST['member_id'];
			$provider    = $this->Communication_model->get_notificationSetting($member_id);
			$customer_id = 0; //static id nothing to use customer id in notification.
			if($this->Company_model->delete_member($member_id))
			{
				$message = "Sorry! Your account has been deleted by company.";
				$subject = "Account Status";
				if($provider!='' && $provider->isEmail==1)
				{
					$this->Communication_model->sendCancelMessage($member_id,$messages,$subject);
				}
				$this->Communication_model->providernotification($member_id,$customer_id,$subject);
				$this->Company_model->delete_service($member_id);
				$this->Company_model->delete_workarea($member_id);
				$this->Company_model->delete_user_days($member_id);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Member has been removed successfully";
				echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! Member is not delete";
				echo json_encode($response);
			}
		}
		else
		{
			$response["error"]				   = 1;	
			$response["success"]			   = 0;
			$response["message"]			   = "Access Denied";
			echo json_encode($response);
		}
	}
	
}
