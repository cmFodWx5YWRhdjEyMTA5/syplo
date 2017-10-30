<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller
{
	function __construct()
	{
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Order_model');
        $this->load->model('Registration_model');
        $this->load->model('Freelancer_model');
        $this->load->model('Communication_model');
        $this->load->model('Company_model');
        $this->load->database();
	}

	public function index()
	{
		$response["error"]				= 2;	
		$response["success"]			= 0;
		$response["message"]			= "Access Denied";
		echo json_encode($response);
	}

	public function OtherServices()
	{
		$subCategory = $this->Service_model->OtherServices();
		$response["error"]				= 0;	
		$response["success"]			= 1;
		$response["message"]			= "success";
		$response["data"]			    = $subCategory;
		echo json_encode($response);
	}

	public function search()
	{
		$rawPostData 	= file_get_contents('php://input');
		$jsonData 		= json_decode($rawPostData,true);
		if(!empty($jsonData))
		{
		$customer_id    = $jsonData['customer_id'];		
		$date 			= $jsonData['date'];
		$time 			= $jsonData['time'];
		$order_address 	= $jsonData['address'];  // 0=providerAdd 1=customerAdd
		$addLat 		= $jsonData['addLat'];
		$addLng 		= $jsonData['addLng'];
		$addresstype	= $jsonData['addresstype'];
		$region_id 		= $jsonData['region_id'];
		$services_id	= $jsonData["services_id"];
		$another_id		= $jsonData["another_servicesId"];
		//print_r($another);die();
		$ss=[];
		$WorkPerformUserId = '';
		$anoservices=[];
		$services=[];
		if(!empty($services_id) && !empty($another_id))
		{ 
			//echo "both";	
			$WorkPerformUserId = $this->Order_model->UserAreaSearch($services_id,$another_id);
		}
		else if(!empty($services_id) && empty($another_id))
		{
			//echo "services_id";
			$WorkPerformUserId = $this->Order_model->UserAreaSearch($services_id,$another_id);
		}
		else
		{
			//echo "another_id";
			$WorkPerformUserId= $this->Order_model->UserSearchToAnother($another_id);
		}
		//print_r($WorkPerformUserId);die();
		//$WorkPerformUserId=array("22","23");		
		if(!empty($WorkPerformUserId))
    	{
    		$WorkPerformUserId = $this->Order_model->checkOrderTime($WorkPerformUserId,$date,$time);

	    	//$WorkPerformUserId = $this->Order_model->checkPosition($WorkPerformUserId,$date,$time);
    		//print_r($WorkPerformUserId);die();
	    	$res = $this->Order_model->search($time,$addLat,$addLng,$addresstype,$WorkPerformUserId); 
	    	// $res = $this->Order_model->search($time,$addLat,$addLng,$region_id,$WorkPerformUserId); 
    		$d='';
    		//echo json_encode($res);die();
    		if(!empty($res))
    		{
    			foreach ($res as $key => $value)
	    		{
	    			$liveAddress=''; $liveLat=''; $liveLng='';
	    			$user_id      = $value->id;
	    			if($addresstype==1)
	    			{
	    				$liveAddressData = $this->Order_model->moving_address($user_id);
	    				if(!empty($liveAddressData))
	    				{    					
		    				$liveAddress = $liveAddressData->area_address;
		    				$liveLat     = $liveAddressData->area_lat;
		    				$liveLng     = $liveAddressData->area_lng;
	    				}
	    			}
	    			else
	    			{
	    				$liveAddress = $value->provider_address;
	    				$liveLat     = $value->provider_lat;
	    				$liveLng     = $value->provider_long;
	    			}

	    			$latestReview = $this->Freelancer_model->get_latestReview($user_id);
	    			$rating       = $this->Freelancer_model->get_rating($user_id);
	    			$discount     = $this->Registration_model->discountDetails($customer_id);
	    			if(empty($discount))
			    	{  $discount =''; }

	    			if(!empty($services_id))
	    			{	    				
	    				$services	= $this->Order_model->service_price($user_id,$services_id);
	    			}
	    			if(!empty($another_id))
	    			{
	    				$anoservices= $this->Order_model->anoservice_price($user_id,$another_id);
	    			}
	    			//print_r($anoservices);die();
	    			//print_r($services);die();
	    			$data["user_id"]			= $value->id;
	    			$data["company_id"]			= $value->company_id;
		   		 	$data["user_image"]			= base_url().'/upload/'.$value->user_image;
		   		 	if($value->user_type==1)
		   		 	{ $user_type='Freelancer';}
		   		 	else if ($value->user_type==3)
		   		 	{ $user_type='Company';}
		   		 	else{$user_type='Member';}

		   		 	if($value->acceptance==0)
		   		 	{ $acceptance='Instant';}
		   		 	else
		   		 	{ $acceptance='Pre-approval';}
		   		 	$company_id = $value->company_id;
		   			$company_name ='';
		   		 	if($company_id!=0)
		   		 	{
		   		 		$company_details = $this->Registration_model->profiledata($company_id);
		   		 		$company_name = $company_details->company_name;
		   		 	}

		    		$data["user_id"]			= $value->id;
	    			$data["company_id"]			= $company_id;
	    			$data["company_name"]       = $company_name; 
		   		 	$data["user_image"]			= base_url().'/upload/'.$value->user_image;
		    		$data["user_type"] 			= $user_type;   	
					$data["name"]				= $value->first_name.' '.$value->last_name;
					$data["provider_email"]     = $value->email;
					$data["acceptance"]			= $acceptance;					
					$data["address"]			= $value->provider_address;
					$data["lat"]				= $value->provider_lat;
					$data["long"]				= $value->provider_long;
					$data["liveAddress"]		= $liveAddress;
					$data["liveLat"]			= $liveLat;
					$data["liveLng"]			= $liveLng;
					$data["distance"]			= $value->distance;
					$data["Rating"]				= $rating;
					$data["experience"]			= $value->experience;
					$data["latestReview"]		= $latestReview;
					$data["services"]			= $services;
					$data["another_services"]	= $anoservices;
					$data["discount"]           = $discount;
					//$data["another_service"]	=
	    		 	$d[]= $data;
	    		} 
	    		//echo json_encode($d);die();
	    		$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["data"]				= $d;
				$response["services_ids"]		= $services_id;
				$response["another_servicesId"] = $another_id;
				$response["order_date"]			= $date;
				$response["order_time"]			= $time;
				echo json_encode($response);	
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Please select less services";
				echo json_encode($response);
			} 		
    	}
    	else
    	{
    		$response["error"]				= 1;	
			$response["success"]			= 0;
			$response["message"]			= "Please select less services";
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
		//print_r($addLat);
	}

	public function ProviderDetail()
	{
		$rawPostData 	= file_get_contents('php://input');
		$jsonData 		= json_decode($rawPostData,true);
		if(isset($jsonData['user_id']) && $jsonData['user_id']!='')
		{
			$user_id  		= $jsonData['user_id'];
			$service_id		= $jsonData['service_id'];
			$another_id		= $jsonData['another_servicesId'];
			$ourserviceRate	= [];
			$ouranoservices	= [];
			$user_detail	= $this->Registration_model->profiledata($user_id);
			if($user_detail!=null)
			{	
				if(!empty($service_id))
    			{	    				
    				$ourserviceRate	= $this->Order_model->service_price($user_id,$service_id);
    			}
    			if(!empty($another_id))
	    		{
					$ouranoservices = $this->Order_model->anoservice_price($user_id,$another_id);
				}
				$certificate	= $this->Order_model->ProviderCertificate($user_id);
				$WorkImage		= $this->Order_model->ProviderWorkImage($user_id);
				$latestReview 	= $this->Freelancer_model->get_latestReview($user_id);
				$rating  = $this->Freelancer_model->get_rating($user_id);
				$age = $this->CalculateAge($user_detail->dob);
				if($user_detail->acceptance==0)
	   		 	{ $acceptance='Instant';}
	   		 	else
	   		 	{ $acceptance='Pre-approval';}

		   		if($user_detail->user_type==1)
		   		{ $user_type='Freelancer';}
		   		else
		   		{ $user_type='Member';}

	   		 	if($user_detail->canceling_policy==1)
	   		 	{ $canceling_policy='Flexible';}
	   		 	else if($user_detail->canceling_policy==2)
	   		 	{ $canceling_policy='Strict';}
	   		 	else
	   		 	{ $canceling_policy='Moderate';}

	   		 	$company_id = $user_detail->company_id;
		   		$company_name ='';
		   		if($company_id!=0)
		   		{
		   			$company_details = $this->Registration_model->profiledata($company_id);
		   			$company_name    = $company_details->company_name;
		   		}
		   		
				$response["error"]			  = 0;	
				$response["success"]		  = 1;
				$response["message"]		  = "Success";
				$image = base_url().'upload/'.$user_detail->user_image;
	            $response["data"]["user_image"]         = $image;
	            $response["data"]["user_id"]          	= $user_detail->id;
	            $response["data"]["user_type"]          = $user_type;      
	            $response["data"]["experience"]         = $user_detail->experience; 
	            $response["data"]["full_name"]          = $user_detail->first_name.' '.$user_detail->last_name;
	            $response["data"]["age"]                = $age;
	            $response["data"]["gender"]            	= $user_detail->gender;
	            $response["data"]["company_id"]			= $company_id;
	    		$response["data"]["company_name"]       = $company_name; 
	            $response["data"]["provider_email"]    	= $user_detail->email;
	            $response["data"]["provider_mobileno"]  = $user_detail->mobile;
	            $response["data"]["provider_address"]   = $user_detail->provider_address;
	            $response["data"]["provider_lat"]   	= $user_detail->provider_lat;
	            $response["data"]["provider_lng"]   	= $user_detail->provider_long;

	            $response["data"]["about"]              = $user_detail->about;
	            $response["data"]["current_workplace"]  = $user_detail->current_workplace;
	            $response["data"]["current_workplace"]  = $user_detail->current_workplace;
	            $response["data"]["previous_workplace"] = $user_detail->previous_workplace;
	            $response["data"]["canceling_policy"]   = $canceling_policy; 
	            $response["data"]["acceptance"]         = $acceptance; 
	            $response["data"]["Rating"]				= $rating; 
	            $response["data"]["latestReview"]		= $latestReview;            
	            $response["data"]["Service_Offered"]    = $ourserviceRate;
	            $response["data"]["another_services"]	= $ouranoservices;
	            $response["data"]["Certificate_url"]	= base_url().'certificateimage/';
	            $response["data"]["certificate"]    	= $certificate; 
	            $response["data"]["WorkImage_url"]		= base_url().'workimage/';
	            $response["data"]["Work_Performed"]	    = $WorkImage; 
            	echo json_encode($response);
			}
			else
			{				
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! User not found";
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

	public function CalculateAge($age)
	{
		$from = new DateTime($age);
		$to   = new DateTime('today');
		return $from->diff($to)->y.' year old';
	}

	public function storetransaction_details($TransactionData,$discount_id,$order_id)
	{
				/***********Store transaction details with discount**************/
		$transaction_details = $this->Order_model->storetransaction_details($TransactionData);
		if(!empty($transaction_details))
		{
			if($discount_id!='')
			{
				/***********Update discount Status**************/				
				$taken_timestamp  = date('Y-m-d H:i');
				$this->Order_model->updateDiscountStatus($discount_id,$taken_timestamp,$order_id);
				/***********Update discount Status**************/
			}			
			return $transaction_details;
		}		
	}

	public function book()
	{
		$rawPostData 	= file_get_contents('php://input');
		$jsonData 		= json_decode($rawPostData,true);
		//print_r($jsonData);die();
		if(isset($jsonData['provider_id']) && $jsonData['provider_id']!='')
		{
			$provider_id  		= $jsonData['provider_id'];
			$customer_id		= $jsonData['customer_id'];
			$date				= $jsonData['date'];
			$time				= $jsonData['time'];
			$address_type   	= $jsonData['address_type'];
			$address   			= $jsonData['address'];
			$lat   				= $jsonData['lat'];
			$lng   				= $jsonData['lng'];
			$acceptance     	= $jsonData['order_acceptance'];
			$provider_cancelPolicy = $jsonData['provider_cancelPolicy'];
			$order_service		= $jsonData['order_service'];
			$another_service 	= $jsonData['another_service'];

			$transaction_id		= $jsonData['transaction_id'];
			$transaction_status = $jsonData['transaction_status'];
			$bill_amount   		= $jsonData['bill_amount'];
			$discount   		= $jsonData['discount'];
			$type               = $jsonData['type'];   //0= % and 1= currency
			$discount_id		= $jsonData['discount_id'];
			$gross_amount   	= $jsonData['gross_amount'];			
			//print_r($jsonData);die();

			$data = array(
				"provider_id"   => $provider_id,
				"customer_id" 	=> $customer_id,
				"date" 			=> $date,
				"time" 			=> $time,
				"address_type"  => $address_type,
				"address"		=> $address,
				"lat"			=> $lat,
				"lng"			=> $lng,
				"approve_status"=> $acceptance,
				"provider_cancelPolicy"=>$provider_cancelPolicy
				);			

			if($order_id= $this->Order_model->book($data))
			{
				$actual_service=[];
				$another_services=[];
				if(!empty($order_service))
				{	
					foreach($order_service as $k =>$v)
					{
						$c["order_id"]		=  $order_id;
						$c["service_id"] 	=  $v['service_id'];
						$c["price"] 	 	=  $v['price'];
						$c["price_type"] 	=  $v['price_type'];
						if($v['price_type']==0)
						{
							$c["total_hour"] = '1';
							$c["total_cost"] = $v['price'];
						}
						else
						{
							$c["total_hour"] = '24';
							$c["total_cost"] = $v['price'];
						}
						$c["service_type"] 	=  $v['service_type'];
						$actual_service[]=$c;
					}
				}

				if(!empty($another_service))
				{
					foreach($another_service as $l =>$m)
					{
						$d["order_id"]		=  $order_id;
						$d["service_id"] 	=  $m['service_id'];
						$d["price"] 	 	=  $m['price'];
						$d["price_type"] 	=  $m['price_type'];
						if($m['price_type']==0)
						{
							$d["total_hour"] = '1';
							$d["total_cost"] = $m['price'];
						}
						else
						{
							$d["total_hour"] = '24';
							$d["total_cost"] = $m['price'];
						}
						$d["service_type"] 	=  $m['service_type'];
						$another_services[]=$d;
					}
				}
				$TransactionData = array(
					"order_id"       =>	$order_id,
					"transaction_id" => $transaction_id,
					"provider_id"    => $provider_id,
					"customer_id" 	 => $customer_id,
					"bill_amount" 	 => $bill_amount,
					"discount"  	 => $discount,
					"type"           => $type,
					"discount_id"	 => $discount_id,
					"gross_amount"	 => $gross_amount,
					"transaction_status" => $transaction_status
				);
				$Tr_details ='';
				$Tr_details = $this->storetransaction_details($TransactionData,$discount_id,$order_id);
				$book_service = array_merge($actual_service,$another_services);
				$this->Order_model->book_service($book_service);

				//------------------------ Communication System  Start------------------------------ //
				$provider 	= $this->Communication_model->get_notificationSetting($provider_id);
				$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
				
			 	$order_details = $this->Order_model->order_details($order_id);
			 	$req_services_details = $this->Order_model->order_service($order_id);
				$ano_services_details = $this->Order_model->another_orderService($order_id);
				$services = array_merge($req_services_details,$ano_services_details);
				$subject ='Ny bokning';     //New order';
				$Emailmessage = 'Hej, du har fått en ny bokning via Syplo. Se detaljer i tabellen nedan. Glöm inte logga in i appen för att godkänna eller avböja förfrågan om du inte har instant booking!';
				$Customessage      = 'Hej! Din bokning har skickats. Se detaljer i tabellen nedan. Glöm inte ta kontakt med varandra via Syplo chatten för portkoder och annat.';
				$message      = 'Hej! Du har fått en ny bokning. Glöm inte ta kontakt med varandra för att bekräfta detaljerna. Mvh Syplo';

			 	if($provider!='' && $provider->isEmail==1)
			 	{
			 		//For Order detials with customer details send to provider
			 		$mailstatus =1;
			 		$this->Communication_model->SentBillByEmail($order_id,$order_details,$services,$subject,$Emailmessage,$mailstatus);
			 	}
			 	if($customer!='' && $customer->isEmail==1)
			 	{
			 		//For Order detials with provider details send to customer
			 		$mailstatus =0;
					$this->Communication_model->SentBillByEmail($order_id,$order_details,$services,$subject,$Customessage,$mailstatus);
			 	}
			 	/*if($customer!='' && $customer->isSms==1)
			 	{
			 		$this->Communication_model->sendSms($message,$customer_id);
			 	}*/
			 	if($provider!='' && $provider->isSms==1)
			 	{
			 		$this->Communication_model->sendSms($message,$provider_id);
			 	}			 	
			 	$this->Communication_model->providernotification($provider_id,$customer_id,$message);
			 	$this->Communication_model->SentBillByEmailToSyplo($order_id,$order_details,$services,$subject,$Emailmessage);

			 	//------------------------ Communication System End------------------------------ //
				
				
				
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["order_id"]			= $order_id;
				$response["transaction_details"]= $Tr_details;
				echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! try again";
				$response["order_id"]			= "";
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

	public function book_service_prise()
	{
		$rawPostData 	= file_get_contents('php://input');
		$jsonData 		= json_decode($rawPostData,true);
		$order_prise	= $jsonData["order_prise"];
		$order_id       = $jsonData["order_id"];
		$update_at      = date('Y-m-d H:i:s');
		if($order_id!='')
		{
			if(!empty($order_prise))
			{
				foreach($order_prise as $o =>$p)
				{
					$op["id"]			=  $p['order_service_id'];
					$op["total_hour"] 	=  $p['total_hour'];
					$op["total_cost"] 	=  $p['total_cost'];
					$op["update_at"]    =  $update_at;
					$asp[]=$op;
				}
				//print_r($asp);die();
				$rr= $this->Order_model->book_service_prise($asp,$order_id);
				if($rr)
				{
					$order_details = $this->Order_model->order_details($order_id);
					$customer_id = $order_details->customer_id;
					$provider_id = $order_details->provider_id;

					//------------------------ Communication System  Start------------------------------ //
					$provider 	= $this->Communication_model->get_notificationSetting($provider_id);
					$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
				 	
				 	$req_services_details = $this->Order_model->order_service($order_id);
					$ano_services_details = $this->Order_model->another_orderService($order_id);
					$services = array_merge($req_services_details,$ano_services_details);
					$subject      = 'Kvitto';   //Order Bill
					$Emailmessage = 'Hej! Behandlingen är nu klar. Ditt transaktions ID är  '.$order_id;
					$message      = 'Hej! Behandlingen är nu klar. Ditt transaktions ID är  '.$order_id;

				 	if($customer!='' && $customer->isEmail==1)
				 	{	//For Order detials with provider details send to customer			 		
						$this->Communication_model->SentOrderBillByEmail($order_id,$order_details,$services,$Emailmessage);
				 	}
				 	if($customer!='' && $customer->isSms==1)
				 	{
				 		$this->Communication_model->sendSms($message,$customer_id);
				 	}		 	
				 	$this->Communication_model->customernotification($provider_id,$customer_id,$message);
				 	//$this->Communication_model->SentBillByEmailToSyplo($order_id,$order_details,$services,$subject,$Emailmessage);
			 		//------------------------ Communication System End------------------------------ //

					$bsp["error"]			= 0;	
					$bsp["success"]			= 1;
					$bsp["message"]			= "Success";
					echo json_encode($bsp);
				}
				else
				{
					$bsp["error"]			= 1;	
					$bsp["success"]			= 0;
					$bsp["message"]			= "Error occur! Try again";
					echo json_encode($bsp);
				}
			}
			else
			{
				if($this->Order_model->final_order($order_id))
				{
					$bsp["error"]			= 0;	
					$bsp["success"]			= 1;
					$bsp["message"]			= "Success";
					echo json_encode($bsp);
				}
				else
				{
					$bsp["error"]			= 1;	
					$bsp["success"]			= 0;
					$bsp["message"]			= "Error occur! Try again";
					echo json_encode($bsp);
				}
			}
		}
		else
		{
			$bsp["error"]			= 2;	
			$bsp["success"]			= 0;
			$bsp["message"]			= "Access Denied";
			echo json_encode($bsp);
		}
	}

	public function service_request_list()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id    = $_POST['provider_id'];
			$response	    = $this->Order_model->order_request($provider_id);
			if(!empty($response))
			{
				//echo json_encode($response);die();
				foreach ($response as $key => $value) 
		        {
					$age      = $this->CalculateAge($value->dob); 
		        	$order_id = $value->id;
		        	$cust_id  = $value->customer_id;
		        	$latestReview = $this->Freelancer_model->get_latestReview($cust_id);
		        	$rating  = $this->Freelancer_model->get_rating($cust_id);
		        	$req_services_details = $this->Order_model->order_service($order_id);
		        	// echo json_encode($req_services_details);die();
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
	                $image = base_url().'upload/'.$value->user_image;
	                $r["user_image"]         = $image; 
	                $r["order_id"]           = $value->id;
	                $r["provider_id"]        = $value->provider_id;
	                $r["customer_id"]        = $value->customer_id;
	                $r["customer_email"]     = $value->email;
	                $r["customer_mobile"]    = $value->mobile;
	                $r["user_type"]          = $value->user_type;      
	                $r["full_name"]          = $value->first_name.' '.$value->last_name;
	                $r["order_date"]         = $value->date;
	                $r["order_time"]         = $value->time;
	                $r["address_type"]       = $value->address_type; 
	                $r["address"]            = $value->address;
	                $r["lat"]                = $value->lat;
	                $r["lng"]                = $value->lng;
					$r["gender"]             = $value->gender;
					$r["age"]                = $age;
					$r["about"]              = $value->about;
	                $r["rating"]			 = $rating;
	                $r["latestReview"]		 = $latestReview;
	                $r["approve_status"]     = $value->approve_status; 
	                $r["order_status"]       = $value->order_status;
	                $r["services_details"]   = $req_details;
	                $r["another_services"]   = $anoservices_detail;	                
	                //$r["data"]["age"]                = $age;             
	                $offer[]=$r;
	                $req_details='';
	                $anoservices_detail='';
	        	}
		        $offer_res["error"]				= 0;	
				$offer_res["success"]			= 1;
				$offer_res["message"]			= "Success";
				$offer_res["data"]				= $offer;
				echo json_encode($offer_res);
			}
			else
			{
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "No Service request";
				$response["data"]				= [];
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

	public function cancel_booking_order()           // Cancel order by customer
	{
		extract($_POST);
		if(!empty($order_id))
		{
			if($this->Order_model->cancel_booking_orders($order_id))
			{
				
				$order_details = $this->Order_model->order_details($order_id);
				$customer_id   = $order_details->customer_id;
				$provider_id   = $order_details->provider_id;
				$order_date    = $order_details->date;
				$order_time    = $order_details->time;
				$customer      = $this->Registration_model->profiledata($customer_id);
		        $customer_name = '';
		        if(!empty($customer)){$customer_name=$customer->first_name.' '.$customer->last_name;}

				$subject  = "Beställning avbokad";
				$message = 'Din bokning med "'.$customer_name.'" den '.$order_date.' '.$order_time.' har blivit avbokad av kunden. Beställnings-ID är '.$order_id.'.';
				$message1 = "Din beställning har avbrutits. Beställnings-id är ".$order_id.'.';

				$provider 	= $this->Communication_model->get_notificationSetting($provider_id);
			 	$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
			 	//----------------------------------------------------------------------//
				if($provider!='' && $provider->isEmail==1)
			 	{
					$this->Communication_model->sendCancelMessage($provider_id,$message,$subject);
				}
				if($customer!='' && $customer->isEmail==1)
			 	{
					$this->Communication_model->sendCancelMessageToCustomer($customer_id,$message1,$subject);
				}
				if($provider!='' && $provider->isSms==1)
			 	{
			 		//Message send to the provider mobile number
			 		$this->Communication_model->sendSms($message,$provider_id);
			 	}
				$this->Communication_model->providernotification($provider_id,$customer_id,$message);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success data" ;
				echo json_encode($response);	
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! Please try again";
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

	/* for order accept and reject */
	public function OrderRequestResponse()             //Accept or reject form Freelancer or member side
	{
		if(isset($_POST['order_id']) && $_POST['order_id']!='')
		{
			$order_id  = $_POST['order_id'];
			$status    = $_POST['status'];
			$customer_id =$_POST['customer_id']; 
			$provider_id =$_POST['freelancer_id'];

			if($this->Order_model->OrderRequestResponse($order_id,$status))
			{
				if($status!=2)
				{				
					$message 	= " Hej! Din beställning med id ".$order_id." har bekräftats av behandlaren. Se detaljerna i tabellen nedan.";
					$sms 	= " Hej! Din beställning med id ".$order_id." har bekräftats av behandlaren.";
				 	$message1 	= "Ditt svar har sparats.";
				}
				else
				{
					$message 	= "Hej! Tyvärr har din bokning med ID ".$order_id." blivit avbokad av behandlaren. Se detaljer i tabellen nedan.";
					$sms 	= "Hej! Tyvärr har din bokning med ID ".$order_id." blivit avbokad av behandlaren.";

				 	$message1 	= "Ditt svar har sparats.";
				}
				//----------------------------------------------------------------------//
				$order_details =  $this->Order_model->order_details($order_id);
				$req_services_details = $this->Order_model->order_service($order_id);
				$ano_services_details = $this->Order_model->another_orderService($order_id);
				$services = array_merge($req_services_details,$ano_services_details);
				//----------------------------------------------------------------------//

			 	$provider 	= $this->Communication_model->get_notificationSetting($provider_id);
			 	$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
			 	//----------------------------------------------------------------------//
			 	$subject 	= "Status på bokning";
			 	if($provider!='' && $provider->isEmail==1)
			 	{
			 		//For Order detials with customer details send to provider
			 		$mailstatus =1;
			 		$this->Communication_model->SentBillByEmail($order_id,$order_details,$services,$subject,$message1,$mailstatus);
			 		//$this->Communication_model->SentDetailByEmail($data,$subject,$message1);
			 	}
			 	if($customer!='' && $customer->isEmail==1)
			 	{
			 		//Email send to the customer
			 		$mailstatus =0;
					$this->Communication_model->SentBillByEmail($order_id,$order_details,$services,$subject,$message,$mailstatus);
			 	}
			 	if($customer!='' && $customer->isSms==1)
			 	{
			 		//Message send to the customer mobile number
			 		$this->Communication_model->sendSms($sms,$customer_id);
			 	}			 	
			 	$this->Communication_model->customernotification($provider_id,$customer_id,$sms);
			 	$this->Communication_model->SentBillByEmailToSyplo($order_id,$order_details,$services,$subject,$message);
			 	if($status==2 && $customer_id!='' && $provider_id!='')
				{
					$data= array(
						"order_id"   => $order_id,
						"customer_id"=> $customer_id,
						"provider_id"=> $provider_id,
						"rating"     => '-1',
						"comment"    => 'Behandlaren avbokade denna bekräftade bokning.',
						);
					$this->Order_model->insert_review($data);
				}
				$res['success']='1';
				$res['error']='0';
				$res['message']='success';
				$res['status']=$status;
				echo json_encode($res);	
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur";
				$res['status']					=$status;
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
	/* for order accept and reject end */

	public function review()
	{
	   $rawPostData  = file_get_contents('php://input');
       $jsonData   = json_decode($rawPostData,true);
       //print_r($jsonData);die();
       if(!empty($jsonData))
       {
	       	// $customer_id = $jsonData['customer_id'];      //Sender
	       	// $provider_id = $jsonData['provider_id'];      //Sender
	       	$sender_id 	= $jsonData['customer_id'];      //Sender
		   	$receiver_id = $jsonData['provider_id'];      //Receiver  
		   	$type        = $jsonData['type']; // 0=When customer give 1= When provider give

       		$data = array(
       			'order_id'     => $jsonData['order_id'],
   				'customer_id'  => $sender_id,
   				'provider_id'  => $receiver_id,
   				'rating'       => $jsonData['rating'],
   				'comment'      => $jsonData['comment']
       			);
       		//$this->Communication_model->SentReviewByEmail($data);die();
			$id  = $this->Order_model->insert_review($data);
			if($id)
			{
				$res        = $this->Order_model->get_review($id);
				/*$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
				$provider 	= $this->Communication_model->get_notificationSetting($provider_id);*/
				$sender 	= $this->Communication_model->get_notificationSetting($sender_id);
				$receiver 	= $this->Communication_model->get_notificationSetting($receiver_id);

				//$message    = 'New review for you.'; 
				$message    = 'Du har fått ett nytt omdöme, gå in på Syplo appen för att se ditt omdöme.'; 
				if($type==0)
			 	{
					if($receiver!='' && $receiver->isEmail==1)
				 	{
				 		//Email send to provider
				 		$this->Communication_model->SentReviewByEmail($data);
				 	}
				 	if($receiver!='' && $receiver->isSms==1)
				 	{
				 		//SMS send to provider
				 		$this->Communication_model->sendSms($message,$receiver_id);
				 	}		 	
						$this->Communication_model->providernotification($receiver_id,$sender_id,$message);
				}
				if($type==1)
			 	{
				 	if($receiver!='' && $receiver->isEmail==1)
				 	{
				 		//Email send to the customer 
				 		$this->Communication_model->SentReviewByEmail($data);
				 	}
				 	if($receiver!='' && $receiver->isSms==1)
				 	{
				 		//Message send to the customer mobile number
				 		$this->Communication_model->sendSms($message,$receiver_id);
				 	}
				 		$this->Communication_model->customernotification($receiver_id,$sender_id,$message);
			 	}

			   	$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["data"]				= $res;
			   	echo json_encode($response); 
			}
			else
			{
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! try again";
				$response["data"]				= [];
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
	// hello
	public function order_list_booking()
	{
		extract($_POST);
		if(!empty($user_id))
		{
			$data=$this->Order_model->get_order_list($user_id);
			if($data!=null)
		    {
		 	 	foreach($data as $key)
			 	{  
				    $order_id       = $key->id;
				    $prov_id 	    = $key->provider_id;
				    $latestReview   = $this->Freelancer_model->get_latestReview($prov_id);
				    $rating         = $this->Freelancer_model->get_rating($prov_id);
				    $req_services_details = $this->Order_model->order_service($order_id);
			        $ano_services_details = $this->Order_model->another_orderService($order_id);
			        $freelancher_profile  = $this->Order_model->freelancher_profile($prov_id);
					// $freelancher_profile  = $this->db->get_where('registration',array('id'=>$key->provider_id))->row();
					//print_r($freelancher_profile);die();
					if($freelancher_profile->acceptance==0)
		   		 	{ $acceptance='Instant';}
		   		 	else
		   		 	{ $acceptance='Pre-approval';}

			   		if($freelancher_profile->user_type==1)
			   		{ $user_type='Freelancer';}
			   		else
			   		{ $user_type='Member';}

		   		 	if($freelancher_profile->canceling_policy==1)
		   		 	{ $canceling_policy='Flexible';}
		   		 	else if($freelancher_profile->canceling_policy==2)
		   		 	{ $canceling_policy='Strict';}
		   		 	else
		   		 	{ $canceling_policy='Moderate';}
					$age = $this->CalculateAge($freelancher_profile->dob); 

					$company_id = $freelancher_profile->company_id;
		   			$company_name ='';
		   		 	if($company_id!=0)
		   		 	{
		   		 		$company_details = $this->Registration_model->profiledata($company_id);
		   		 		$company_name    = $company_details->company_name;
		   		 	}
					$userdata[]=array(
					'order_id'=>$key->id,
					'user_image'=>base_url().'upload/'.$freelancher_profile->user_image,
					'freelancher_id'=>$freelancher_profile->id,
					'provider_email'=>$freelancher_profile->email,
					'full_name'=>$freelancher_profile->first_name .' '.$freelancher_profile->last_name,
					'gender'=>$freelancher_profile->gender,
					'age'=>$age,
					'user_type'=>$user_type,
					'company_id'=> $company_id,
					'company_name'=> $company_name,
					'date'=>$key->date,
					'time'=>$key->time,
					'order_address'=>$key->address,
					'approve_status'=>$key->approve_status,
					'rating'=>$rating,
					'canceling_policy'=>$canceling_policy,
					'acceptance'=>$acceptance,
					'experience'=>$freelancher_profile->experience,
					'latestReview'=>$latestReview,
					'service'=>$req_services_details,
					'another_service'=>$ano_services_details
					);
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
				$response["message"]			= "Data is not available";
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
	
	public function customer_order()          //Customer History
	{   extract($_POST);
	    if(!empty($user_id))
		{
			$data=$this->Order_model->order_history($user_id);
			if(!empty($data))
			{
			 	foreach($data as $key)
				{  
				    $order_id=$key->id;
				    $req_services_details = $this->Order_model->order_service($order_id);
			        $ano_services_details = $this->Order_model->another_orderService($order_id);
					$freelancher_profile=$this->db->get_where('registration',array('id'=>$key->provider_id))->row();
					$latestReview = $this->Freelancer_model->get_latestReview($freelancher_profile->id);
					$rating  = $this->Freelancer_model->get_rating($freelancher_profile->id);
					$review_status = $this->Order_model->checkReviewStatus($order_id,$user_id);
					if($freelancher_profile->acceptance==0)
		   		 	{ $acceptance='Instant';}
		   		 	else
		   		 	{ $acceptance='Pre-approval';}

			   		if($freelancher_profile->user_type==1)
			   		{ $user_type='Freelancer';}
			   		else if($freelancher_profile->user_type==4)
			   		{ $user_type='Member';}
			   		else
			   		{ $user_type='Company';}

		   		 	if($freelancher_profile->canceling_policy==1)
		   		 	{ $canceling_policy='Flexible';}
		   		 	else if($freelancher_profile->canceling_policy==2)
		   		 	{ $canceling_policy='Strict';}
		   		 	else
		   		 	{ $canceling_policy='Moderate';}
					$age = $this->CalculateAge($freelancher_profile->dob); 

					$company_id = $freelancher_profile->company_id;
		   			$company_name ='';
					if($company_id!=0)
		   		 	{
		   		 		$company_details = $this->Registration_model->profiledata($company_id);
		   		 		$company_name = $company_details->company_name;
		   		 	}

	    			$userdata[]=array(
					'order_id'=>$key->id,
					'company_id'=>$company_id,
					'company_name'=>$company_name,
					'user_image'=>base_url().'upload/'.$freelancher_profile->user_image,
					'freelancher_id'=>$freelancher_profile->id,
					'full_name'=>$freelancher_profile->first_name .' '.$freelancher_profile->last_name,
					'gender'=>$freelancher_profile->gender,
					'age'=>$age,
					'user_type'=>$user_type,
					'date'=>$key->date,
					'time'=>$key->time,
					'order_address'=>$key->address,
					'add_lat'=>$key->lat,
					'add_lng'=>$key->lng,
					'canceling_policy'=>$canceling_policy,
					'acceptance'=>$acceptance,
					'rating'=>$rating,
					'latestReview'=>$latestReview,
					'orderReviewStatus'=>$review_status,
					'experience'=>$freelancher_profile->experience,
					'service'=>$req_services_details,
					'another_service'=>$ano_services_details
					);
				}
			     	$response["error"]				= 0;	
					$response["success"]			= 1;
					$response["message"]			= "Success data";
					$response["data"]			=$userdata;
					echo json_encode($response);
			}
			else
			{				
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "No Data available";
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
	
	
	/* Api for freelancer list for chat purpose At customer side*/
	public function ChatList()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$user_id = $_POST['user_id'];
			$userdata=array();
			$chatList=$this->Order_model->ProviderChatList($user_id);
			if(!empty($chatList))
			{
				foreach($chatList as $keys)
				{  
					$freelancher_profile=$this->db->get_where('registration',array('id'=>$keys->provider_id))->row();
					if($freelancher_profile->user_type==1)
			   		{ $user_type='Freelancer';}
			   		else
			   		{ $user_type='Company';}
			   		$userdata[]=array(
					'user_image'=>base_url().'upload/'.$freelancher_profile->user_image,
					'freelancher_id'=>$freelancher_profile->id,
					'full_name'=>$freelancher_profile->first_name .' '.$freelancher_profile->last_name,
					'email'=>$freelancher_profile->email,
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

	public function GeneralDiscount()
	{
		$rawPostData  = file_get_contents('php://input');
       	$jsonData     = json_decode($rawPostData,true);
       	//print_r($jsonData);die();
       	$today 		  = date('d-m-Y');
	   	$customer_id  = $jsonData['customer_id'];
	   	$discountCode = $jsonData['discountCode'];
	   	if($customer_id!='' && $discountCode!='')
	   	{
	   		$details = $this->Order_model->checkGeneralDiscount($customer_id,$discountCode);
	   		//print_r($details);die();
			if(!empty($details))
		   	{
		   		$response['error'] = 0;
		   		$response['success'] = 1;
		   		$response['message'] = "Success";
		   		$response['discountDetails'] = $details;
		   		echo json_encode($response);
		   	} 
	   	}
	   	else
	   	{
	   		$response['error'] = 4;
	   		$response['success'] = 0;
	   		$response['message'] = "Access Denied";
	   		echo json_encode($response);
	   	}  		
	}

	// Cron job to cancel order if provider does click button after 12 hours Start
	public function Cancel_TimeOutOrder()
	{
		date_default_timezone_set("Asia/Kolkata");
		$Cdate=date('Y-m-d H:i');
		$date = new DateTime($Cdate);
		$date->modify("-12 hours");
		$current_time = $date->format('H:i');
		$date->modify('+3 min');
		$NextExpireTime = $date->format('H:i');
		$current_date   = $date->format("Y-m-d");
		/*print_r($current_date);
		echo "<br>";
		print_r($current_time);
		echo "<br>";
		print_r($NextExpireTime);die();*/
		$result = $this->Order_model->CheckOrderDateTime($current_date,$current_time,$NextExpireTime);
		$data='';
		if(!empty($result))
		{
			foreach ($result as $state)
			{
				$order_id = $state->id;
				//echo $order_id;
				$customer_id = $state->customer_id;
				$provider_id = $state->provider_id;
				$approve_status =$state->approve_status;
				//echo $approve_status;
				$status = 2;
				if($this->Order_model->OrderRequestResponse($order_id,$status))
				{
					if($approve_status==1)
					{
						//echo "accept";
						$data= array(
							"customer_id"=>$customer_id,
							"provider_id"=>$provider_id,
							"rating"=>'-1',
							"comment"=>'Beställning stiden går ut',
							);
						$this->Order_model->insert_review($data);
					}
					else
					{
						//echo "not accept";
					}
				}
			}
		}	
	}
	// Cron job to cancel order if provider does click button after 12 hours End	
}
