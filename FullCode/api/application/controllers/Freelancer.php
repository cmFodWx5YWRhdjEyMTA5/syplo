<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Freelancer extends CI_Controller {
	function __construct() {
        parent::__construct();
		//$this->load->helper("form");       
        $this->load->model('Service_model');
        $this->load->model('Order_model');
        $this->load->model('Registration_model');
        $this->load->model('Freelancer_model');
	 }

	public function profile_get()
	{  extract($_POST);
	    if($user_id != '')
		{
		 	$data=$this->Freelancer_model->profile_freelancher($user_id);
			echo json_encode($data);
		}
		else
		{
			$response["error"]				= 2;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}
	 
	 public function coustomer_detalis()
	 {
		extract($_POST);
		if($user_id != '')
		{
	 	$data=$this->Freelancer_model->get_user_details($user_id);
		echo json_encode($data);
		}
		else
		{
			$response["error"]				= 2;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	 }

	public function bookingCalander()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id    = $_POST['provider_id'];
			$response	    = $this->Freelancer_model->AcceptRequest($provider_id);
			if(!empty($response))
			{
				
				foreach ($response as $key => $value) 
		        {
		        	$aa  = $value->dob;
					$age = $this->Order_model->CalculateAge($aa);
					$order_id = $value->id;
					$cust_id  = $value->customer_id;
		        	$latestReview = $this->Freelancer_model->get_latestReview($cust_id);
		        	$rating  = $this->Freelancer_model->get_rating($cust_id);
					$req_services_details = $this->Order_model->order_service($order_id);
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
			        		$asd["order_id"]		= $asdd->order_id;
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
					$image = base_url().'upload/'.$value->user_image;
	                $r["user_image"]         = $image; 
	                $r["order_id"]           = $value->id;
	                $r["provider_id"]        = $value->provider_id;
	                $r["customer_id"]        = $value->customer_id;
	                $r["user_type"]          = $value->user_type;      
	                $r["full_name"]          = $value->first_name.' '.$value->last_name;
	                $r["customer_email"]	 = $value->email;
	                $r["order_date"]         = $value->date;
	                $r["order_time"]         = $value->time;
	                $r["address_type"]       = $value->address_type; 
	                $r["address"]            = $value->address;
	                $r["lat"]                = $value->lat;
	                $r["lng"]                = $value->lng;
					$r["gender"]             = $value->gender;
					$r["age"]                = $age;
	                $r["rating"]			 = $rating;
	                $r["latestReview"]		 = $latestReview;
	                $r["approve_status"]     = $value->approve_status; 
	                $r["about"]				 = $value->about;	
	                $r["order_status"]       = $value->order_status; 
	                $r["actual_services"]    = $req_details;
	                $r["another_services"]   = $anoservices_detail;
	                $book_order[]			 = $r;
	                $req_details=''; $anoservices_detail='';
					//echo json_encode($r);
				}
				$offer_res["error"]				= 0;	
				$offer_res["success"]			= 1;
				$offer_res["message"]			= "Success";
				$offer_res["data"]				= $book_order;
				echo json_encode($offer_res);
			}
			else
			{
				$offer_res["error"]				= 0;	
				$offer_res["success"]			= 1;
				$offer_res["message"]			= "No Data available";
				$offer_res["data"]				= [];
				echo json_encode($offer_res);
			}
		}
		else
		{
			$offer_res["error"]				= 1;	
			$offer_res["success"]			= 0;
			$offer_res["message"]			= "Access Denied";
			echo json_encode($offer_res);
		}
	}

	public function bookingHistory()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id    = $_POST['provider_id'];
			$data 			= $this->Freelancer_model->get_bookingHistory($provider_id);
			//print_r($data);die();
			if($data!=null)
		    {
		 	 	foreach($data as $key)
			 	{  
				    $order_id    = $key->id;
				    $cust_id 	 = $key->customer_id;
				    $latestReview = $this->Freelancer_model->get_latestReview($cust_id);
				    $rating  = $this->Freelancer_model->get_rating($cust_id);
				    $req_services_details = $this->Order_model->order_service($order_id);
				    if(!empty($req_services_details))
		        	{
			        	foreach ($req_services_details as $ke1 => $rsdd) 
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
		        		foreach ($ano_services_details as $ke => $asdd) 
		        		{
			        		$asd["service_id"]		= $asdd->service_id;
			        		$asd["order_service_id"]= $asdd->id;
			        		$asd["order_id"]		= $asdd->order_id;
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

			        $customer_profile  = $this->Freelancer_model->customer_profile($cust_id);
			        if(!empty($customer_profile))
			        {
					if($customer_profile->acceptance==0)
		   		 	{ $acceptance='Instant';}
		   		 	else
		   		 	{ $acceptance='Pre-approval';}

			   		if($customer_profile->user_type==1)
			   		{ $user_type='Freelancer';}
			   		else if($customer_profile->user_type==2)
			   		{ $user_type='Customer';}
			   		else
			   		{ $user_type='Company';}

					$age = $this->Order_model->CalculateAge($customer_profile->dob); 
					$userdata[]=array(
					'order_id'=>$key->id,
					'user_image'=>base_url().'upload/'.$customer_profile->user_image,
					'customer_id'=>$customer_profile->id,
					'full_name'=>$customer_profile->first_name .' '.$customer_profile->last_name,
					'gender'=>$customer_profile->gender,
					'about' =>$customer_profile->about,
					'age'=>$age,
					'user_type'=>$user_type,
					'date'=>$key->date,
					'time'=>$key->time,
					"address"=> $key->address,
	                "lat"=> $key->lat,
	                "lng"=> $key->lng,
					'rating'=>$rating,
					'latestReview'=>$latestReview,
					'service'=>$req_details,
					'another_service'=>$anoservices_detail
					);
					$req_details=''; $anoservices_detail='';
					}
			 	}
		     	$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success data";
				$response["data"]				= $userdata;
				echo json_encode($response);
			}
			else
			{				
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "No Order History available";
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

	public function getCustomerReview()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id    = $_POST['provider_id'];
			$review_res	    = $this->Freelancer_model->CustomerReview($provider_id);
			if(!empty($review_res))
			{
				$reviewR["error"]				= 0;	
				$reviewR["success"]				= 1;
				$reviewR["message"]				= "Success";
				$reviewR["image_url"]			= base_url().'upload/';
				$reviewR["data"]				= $review_res;
				echo json_encode($reviewR);
			}
			else
			{
				$reviewR["error"]				= 1;	
				$reviewR["success"]				= 0;
				$reviewR["message"]				= "No review";
				$reviewR["image_url"]			= '';
				$reviewR["data"]				= [];
				echo json_encode($reviewR);
			}
		}
		else
		{
			$offer_res["error"]				= 1;	
			$offer_res["success"]			= 0;
			$offer_res["message"]			= "Access Denied";
			echo json_encode($offer_res);
		}
	}

	public function SwitchTo()
	{
		if(isset($_POST['email']) && $_POST['email']!='')
		{
			$email 		  	= $_POST['email'];
			$currenty_type	= $_POST['currenty_user_type'];
			$switch_type    = $_POST['switch_user_type'];
			if($switch_type=='1')
			{
				$msg = "freelancer";
			}
			elseif($switch_type=='2')
			{
				$msg = "consumer";
			}
			else
			{
				$msg = "company";
			}
        $consumerCheck = $this->Freelancer_model->SwitchUserExits($email,$currenty_type,$switch_type);
        	//print_r($consumerCheck);die();
			if($consumerCheck!=0)
			{  
		   		$response['error']   = 0;
		   		$response["success"] = 1;
				$response["message"] = "Please Enter password! User is found as a ".$msg;
				echo json_encode($response);
				exit;
			}
			else
			{
				$response['error']   = 1;
		   		$response["success"] = 0;
				$response["message"] = "Please Sign Up! User is not found as a ".$msg;
				echo json_encode($response);
				exit;
			}
		}
		else
		{
			$response['error']   = 2;
	   		$response["success"] = 0;
			$response["message"] = "Access Denied";
			echo json_encode($response);
			exit;
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
	public function actualservice($serviceRate,$addkey)
	{
	   foreach($serviceRate as $key)
	   {
 	   		$service["id"]= $key->id;
	        $service["user_id"]= $key->user_id;
	        $service["service_id"]= $key->service_id;
	        $service["price"]= $key->price;
	        $service["pricetype"]= $key->pricetype;
	        $service["service_type"]=$addkey;
	        $service["category"]= $key->category;
	        $service["sub_category"]= $key->sub_category;
	        $serviceRates[]= $service;
		}
		return $serviceRates;
	}
	public function anotherservice($anoservicesRate,$addkey)
	{
	   foreach($anoservicesRate as $key)
	   {
 	   		$services["id"]= $key->id;
	        $services["user_id"]= $key->user_id;
	        $services["price"]= $key->price;
	        $services["pricetype"]= $key->pricetype;
	        $services["service_type"]=$addkey;
	        $services["category"]= $key->category;
	        $services["sub_category"]= $key->sub_category;
	        $anoserviceRates[]= $services;
		}
		return $anoserviceRates;
	}

		/* This function use for Freelancer Or Member full Details*/

	public function FreelancerDetail()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{		
			$user_id = $_POST['user_id'];
			$user_detail	 = $this->Registration_model->profiledata($user_id);
			if($user_detail!='')
			{
				$details = $this->keyChanges($user_detail);
				$status_level    = $this->Freelancer_model->service_level($user_id);//Bronze,silver..
				$CustomerAddress = $this->Freelancer_model->allCustomerAddress($user_id);
				$userDays 		 = $this->Freelancer_model->userDays($user_id);	
				$serviceRate	 = $this->Freelancer_model->service_price($user_id);
				$addKey          = 0;
				if(!empty($serviceRate))
				{					
					$serviceRate     = $this->actualservice($serviceRate,$addKey);
				}
				$anoservicesRate = $this->Freelancer_model->anoservice_price($user_id);
				$addKey1          = 1;
				if(!empty($anoservicesRate))
				{
					$anoservicesRate = $this->anotherservice($anoservicesRate,$addKey1);
				}
				$certificate	 = $this->Order_model->ProviderCertificate($user_id);
				$WorkImage		 = $this->Order_model->ProviderWorkImage($user_id);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["data"]["user_detail"]        = $details;
				$response["data"]["complete_serviceLevel"]= $status_level;
				$response["data"]["customer_address"]   = $CustomerAddress; 
				$response["data"]["userDays"]           = $userDays;
				$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
				$response["data"]["Certificate_url"]	= base_url().'certificateimage/';
	            $response["data"]["certificate"]    	= $certificate; 
	            $response["data"]["WorkImage_url"]		= base_url().'workimage/';
	            $response["data"]["Work_Performed"]	    = $WorkImage; 
				echo json_encode($response);die();
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "User is not found";
				$response["data"]				= array();
				echo json_encode($response);
			}	
		}
		else
		{
			$response["error"]				= 2;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}	
	}

	/* This function use for Freelancer Or Member full Details End*/	 	 	 
	
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


	/* This function use to update Freelancer Or Member  Details Start*/

	public function basic_update()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			extract($_POST);			
			$user_id    = $_POST['user_id'];
			$days		= $_POST['days'];
			$updateDay  = explode(',', $days);
			//$updateDay  = json_decode($days,true);
			$add_accept 	   = $_POST['address_acceptance']; // 1 or 2
			$area				= $_POST['customer_addresses'];
    		$customer_addresses	= json_decode($area);
    		$update_at			= date('Y-m-d h:i:s');
			$da = $this->Freelancer_model->customer_profile($user_id);
			$nn=$da->user_image;
			if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
			{
				$r =$this->radomno();
				$s=$_FILES["image"]["tmp_name"];				
	            $picture=$r.$_FILES["image"]["name"];
	            $nn = preg_replace('/\s*/m', '',$picture);
	            $d="upload/".$nn;
	            move_uploaded_file($s,$d);
			}
			$data= array(
				"first_name"		=> $_POST['first_name'],
				"last_name" 		=> $_POST['last_name'],
				"dob"       		=> $_POST['dob'],
				"address"  			=> $_POST['address'],
				"lat"      			=> $_POST['lat'],
				"long"      		=> $_POST['long'],	        
				"mobile"    		=> $_POST['mobile'],
				"user_image"		=> $nn,
				"gender"			=> $_POST['gender'],
				"about"				=> $_POST['about'],
				"address_acceptance"=> $_POST['address_acceptance'],
				"provider_address"	=> $_POST['provider_address'],
			    "provider_lat" 		=> $_POST['provider_lat'],
				"provider_long" 	=> $_POST['provider_long'],
				"availability"		=> $_POST['availability'],
				"start_time"		=> $_POST['start_time'],
				"end_time"			=> $_POST['end_time'],
				"show_position"		=> $_POST['show_position'],
				"canceling_policy"	=> $_POST['canceling_policy'],
				"acceptance"		=> $_POST['acceptance'],
				'update_at'			=> $update_at
				);

			$up =$this->Freelancer_model->basic_update($user_id,$data);
			if($up)
			{
				if(!empty($updateDay))
				{
					$this->updateDays($updateDay,$user_id);
				}
				/*   Customer Address insert,update or delete */
				$livearea = array("user_id"=>$user_id,"area_address"=>$_POST['address'],"area_lat"=>$_POST['lat'],"area_lng"=>$_POST['long'],"address_status"=>"1","update_at"=>$update_at);
					$this->CustomerAddressUpdate($customer_addresses,$user_id,$livearea,$add_accept);

				$upp = $details = $this->keyChanges($up);
				$userDays 		 = $this->Freelancer_model->userDays($user_id);
				$CustomerAddress = $this->Freelancer_model->allCustomerAddress($user_id);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["data"]["user_detail"]= $upp;
				$response["data"]["userDays"]   = $userDays;
				$response["data"]["customer_address"]   = $CustomerAddress;
				echo json_encode($response);
			}
			else
			{
				$user_detail	 = $this->Registration_model->profiledata($user_id);
				$upp             = $this->keyChanges($user_detail);
				$userDays 		 = $this->Freelancer_model->userDays($user_id);
				$CustomerAddress = $this->Freelancer_model->allCustomerAddress($user_id);
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Not success";
				$response["data"]["user_detail"]= $upp;
				$response["data"]["userDays"]   = $userDays;
				$response["data"]["customer_address"]   = $CustomerAddress;
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
	function CustomerAddressUpdate($customer_addresses,$user_id,$livearea,$add_accept)
    {
 		// [{"area_address":"vijay nagar,indore","area_lat":"25.2563","area_lng":"72.256314"}]
 		if(!empty($customer_addresses))
		{	
			$geoarea='';
			$update_at			= date('Y-m-d h:i:s');
			foreach ($customer_addresses as $key)
			{
				$ac["user_id"]		= $user_id;
				$ac["area_address"]	= $key->area_address;
				$ac["area_lat"]		= $key->area_lat;
				$ac["area_lng"]		= $key->area_lng;
				$ac["address_status"] = 0;
				$ac["update_at"]	= $update_at;
				$geoarea[]			= $ac;
			}
			$l = count($geoarea);
			$geoarea[$l]= $livearea;
			//print_r($geoarea);die();
			$this->Freelancer_model->customerAddressUpdate($geoarea,$user_id);	
		}
		if(empty($customer_addresses) && ($add_accept!=1 or $add_accept!=2) )
		{
			//echo "Delete addresses";die();
			$this->Freelancer_model->deleteCustomerAddress($user_id);
		}
    }

	function updateDays($updateDay,$user_id)
    {
    	$updateDays =$updateDay;
    	for($i=0; $i<count($updateDays); $i++)
    	{
    		$insertArray[]= array(
    				"user_id" => $user_id,
    				"day"     => $updateDays[$i]
    				);
    	}
    	$this->Freelancer_model->daysUpdate($insertArray,$user_id);    	
    }


    public function WorkImageDelete()
	{
		if(isset($_POST['image_id']) && $_POST['image_id']!='' && $_POST['user_id']!='')
		{
			$image_id  = $_POST['image_id'];
			$user_id   = $_POST['user_id'];
			$res = $this->Freelancer_model->imageDelete($image_id,$user_id);		
			if($res)
			{
				$WorkImage		 = $this->Order_model->ProviderWorkImage($user_id);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
	            $response["WorkImage_url"]		= base_url().'workimage/';
	            $response["Work_Performed"]	    = $WorkImage; 
				echo json_encode($response);
			}
			else
			{
				$WorkImage		 = $this->Order_model->ProviderWorkImage($user_id);
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! Image does not delete";
				$response["WorkImage_url"]		= base_url().'workimage/';
	            $response["Work_Performed"]	    = $WorkImage; 
				echo json_encode($response);
			}
		}
		else
		{
			$response["error"]				= 2;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}


	public function CertificateImageDelete()
	{
		if(isset($_POST['image_id']) && $_POST['image_id']!='' && $_POST['user_id']!='')
		{
			$image_id  = $_POST['image_id'];
			$user_id   = $_POST['user_id'];
			$res = $this->Freelancer_model->imageDelete($image_id,$user_id);		
			if($res)
			{
				$certificate	 = $this->Order_model->ProviderCertificate($user_id);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["Certificate_url"]	= base_url().'certificateimage/';
	            $response["certificate"]    	= $certificate; 
				echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! Image does not delete";
				$response["Certificate_url"]	= base_url().'certificateimage/';
	            $response["certificate"]    	= $certificate; 
				echo json_encode($response);
			}
		}
		else
		{
			$response["error"]				= 2;	
			$response["success"]			= 0;
			$response["message"]			= "Access Denied";
			echo json_encode($response);
		}
	}

	public function Other_BasicUpdate()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			extract($_POST);
			$provider_id        = $_POST['provider_id'];
			$update_at			= date('Y-m-d h:i:s');
			$data= array(
				"current_workplace"	  => $_POST['current_workplace'],
				"previous_workplace" => $_POST['previous_workplace'],
				"experience"  		  => $_POST['experience'],
				'update_at'			  => $update_at
				);
			$updateCheck = $this->Freelancer_model->Other_BasicUpdate($provider_id,$data);
			if($updateCheck)
			{
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "success";
				$response["data"]["id"]					 = $updateCheck->id;						
				$response["data"]["current_workplace"]   = $updateCheck->current_workplace;
				$response["data"]["previous_workplace"]  = $updateCheck->previous_workplace;
				$response["data"]["experience"]          = $updateCheck->experience;
				echo json_encode($response);
			}
			else
			{
				$response["error"]				= 2;	
				$response["success"]			= 0;
				$response["message"]			= "Not success";
				$response["data"]               = '';
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

	/* This function use to update Freelancer Or Member  Details End*/	 



	/* Api for customer list for chat purpose */
	public function ChatList()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$user_id = $_POST['user_id'];
			$userdata=array();
			$chatList=$this->Freelancer_model->CustomerChatList($user_id);
			if(!empty($chatList))
			{
				foreach($chatList as $keys)
				{  
					$customer_profile=$this->db->get_where('registration',array('id'=>$keys->customer_id))->row();
					$user_type='Customer';
			   		$userdata[]=array(
					'user_image'=>base_url().'upload/'.$customer_profile->user_image,
					'freelancher_id'=>$customer_profile->id,
					'full_name'=>$customer_profile->first_name .' '.$customer_profile->last_name,
					'email'=>$customer_profile->email,
					'user_type'=>$user_type
					);
				}
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success data";
				$response["data"]			    = $userdata;
				echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "No user available";
				$response["data"]			    = $userdata;
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

	public function updatePosition()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id       = $_POST['provider_id'];
			$provider_address  = $_POST['LiveAddress'];
			$provider_lat      = $_POST['lat'];
			$provider_long     = $_POST['long'];
			$data= array(
				"area_address" =>$provider_address,
				"area_lat"     =>$provider_lat,
				"area_lng"     =>$provider_long
				);
			if($this->Freelancer_model->updatePosition($provider_id,$data))
			{
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				echo json_encode($response);

			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Address not udpate";
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
}
