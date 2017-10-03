<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testing extends CI_Controller
{
	function __construct() {
        parent::__construct();
        $this->load->model('Service_model');
        $this->load->model('Order_model');
        $this->load->model('Registration_model');
        $this->load->model('Freelancer_model');
        $this->load->model('Test1_model');
        $this->load->model('Communication_model');
        $this->load->model('Company_model');
        }
	public function index()
	{
		
	}

	public function getCustomerReview()
	{
		if(isset($_POST['provider_id']) && $_POST['provider_id']!='')
		{
			$provider_id    = $_POST['provider_id'];
			$review_res	    = $this->Test1_model->CustomerReview($provider_id);
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


	public function checkReviewStatus()
	{
		$order_id = $_POST['order_id'];
		$giver_id = $_POST['giver_id'];
		$this->Test1_model->checkReviewStatus($order_id,$giver_id);
	}

	public function multiupload()
	{
		if(isset($_FILES['certificate_image']))
		{
			$user_id = $_POST['user_id'];
			$member_id = $_POST['member_id'];
			$about=$_POST['about']; 
			$certificate_images='';
			foreach($_FILES['certificate_image']['tmp_name'] as $key => $tmp_name )
			{
				$type = $_FILES['certificate_image']['type'][$key];
		        $certificate_image_name = $_FILES['certificate_image']['name'][$key];
		        $s =  $_FILES['certificate_image']['tmp_name'][$key];
		        $certificate_image = preg_replace('/\s*/m', '',$certificate_image_name);
		        $d = "certificateimage/".$certificate_image;
		        $certificate_images[]= $certificate_image;  
		        $types[]=$type;
		        move_uploaded_file($s,$d);		        
			}
			$data =array();
			for($i=0; $i<count($certificate_images); $i++)               	// Payment Details
			{
				$data[]= array(
							'user_id'	=> $user_id,
							'member_id'	=> $member_id,
							'about'		=> $about,
			        		'image'		=> $certificate_images[$i],
			        		'type'		=> $types[$i]  
					);				
			}
			if($this->test_model->multiImages($data))
			{
				$response['message']="Success";
				echo json_encode($response);
			}
			else
			{
				$response['message']="Not Success";
				echo json_encode($response);
			}
		}
		else
		{
			$response['message']="Plase filled required fields";
			echo json_encode($response);
		}
	}

	public function muticheckbox()
	{
		$user_id 	= $_POST['user_id'];
		$member_id 	= $_POST['member_id'];
		$price_type = array($_POST['prise_type']);
		$ids		= array($_POST['id']);
		$rate 		= array($_POST['rate']);
		$productId  = explode(',',$ids[0]);
		$productRate= explode(',',$rate[0]);
		$type 		= explode(',', $price_type[0]);
		$data=array();
		foreach ($productId as $id)
		{
			foreach ($productRate as $rate)
			{
				foreach ($type as $t)
				{
					$data[] = array(
					"user_id"		=> $user_id,
					"member_id"		=> $member_id,
					"service_id" 	=> $id,
					"price" 		=> $rate,
					"pricetype"		=> $t
					);
				}
				
			}				
		}
		if($this->test_model->member_service($data))	
		{
			$response['message']="Success";
			echo json_encode($response);
		}
		else
		{
			$response['message']="Not Success";
			echo json_encode($response);
		}	
	}

	public function user_data()
    {
    	$data= $this->Registration_model->user_data();
    	if($data)
    	{    	
    		$response["error"]				= 0;	
    		$response["success"]			= 1;
    		$response["message"]			= "success";
    		$image = base_url().'upload/'.$data['u']->user_image;
    		$response["data"]["user_image"]			=$image;
    		$response["data"]["user_type"] 			=$data['u']->user_status;        //1=individual,2=customer,3=company	
			$response["data"]["device_token"]		= $data['u']->device_token; 
			$response["data"]["company_name"]		= $data['u']->company_name;
			$response["data"]["reg_no"]				= $data['u']->registration_no;
			$response["data"]["full_name"]			= $data['u']->full_name;
			$response["data"]["dob"]				= $data['u']->dob;
	        $response["data"]["address"] 			= $data['u']->address;
	       	$response["data"]["lat"] 				= $data['u']->lat;
			$response["data"]["long"] 				= $data['u']->long;	        
	     	$response["data"]["mobile"]				= $data['u']->mobile;
	        $response["data"]["email"]				= $data['u']->email;
	      	$response["data"]["password"]			= $data['u']->password;
	        $response["data"]["gender"]				= $data['u']->gender;
	       	$response["data"]["about"]				= $data['u']->about;
	        // Extra param
	        $response["data"]["address_acceptance"] = $data['u']->address_acceptance;  	//0=providerAdd,1=customerAdd,2=both;
	        $response["data"]["availability"]		= $data['u']->availability;  			// 1-always 2-selectTime;
	        $response["data"]["canceling_policy"] 	= $data['u']->canceling_policy;  		// 1-flexible 2-strict
			$response["data"]["acceptance"] 		= $data['u']->acceptance; 			//0=instant,1=pre-approval
			$response["data"]["seen_status"]		= $data['u']->seen_status;            // 0=not, 1=yes
			$response["data"]["approv_status"]		= $data['u']->approve_status;		//0=not approved, 1=approved
	         // payment param
	        $response["account"]["login"]			= $data['a']->login;
	        $response["account"]["secretno"]		= $data['a']->secretno;
	        $response["account"]["paymenttype"]		= $data['a']->type; 			 //Type:- 0=debitcard,1=bank,2=paypal
	        $response["account"]["active_status"]	= $data['a']->status;
	        echo json_encode($response);
	    }
    }

    public function account()
    {
	    // payment param
        $secretno   		= array($_POST['secretno']);
        $paymenttype		= array($_POST['paymenttype']); 			 //Type:- 0=debitcard,1=bank,2=paypal
        $active_status		= array($_POST['active_status']);          //active_status : 0=not,1=active
        $secretnos  		= explode(',',$secretno[0]);
        $paymenttypes  		= explode(',',$paymenttype[0]);
        $active_status  	= explode(',',$active_status[0]);
        // print_r(count($secretnos));die();
        $account =array();
		$i='';
		$user_id=1;
			// Payment Details
			for($i=0; $i<count($secretnos); $i++)
			{
				$account[]= array(
					'user_id'			=> $user_id,
			        'secretno'			=> $secretnos[$i],
			        'type'				=> $paymenttypes[$i],  
			        'status'			=> $active_status[$i]     
					);				
			}


			print_r($account);die();

			//echo json_encode($account);die();

			$payment= $this->test_model->paymentdetail($account);
    }

    public function check_mail()
	{
		$to = "shubhamapptech6@gmail.com";
		$subject = "My subject";
		$txt = "Hello world!";
		$headers = "From: webmaster@example.com";
		if(mail($to,$subject,$txt,$headers))
		{      	
			echo "send";
        }
        else
        {
         	echo "not send";            	
        }
	}

	public function get_rating()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$user_id = $_POST['user_id'];
			$rating  = $this->Freelancer_model->get_rating($user_id);
			print_r($rating);
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

	public function search()
	{
		$rawPostData 	= file_get_contents('php://input');
		$jsonData 		= json_decode($rawPostData,true);
		if(!empty($jsonData))
		{		
			$date 			= $jsonData['date'];
			$time 			= $jsonData['time'];
			$order_address 	= $jsonData['address'];
			$addLat 		= $jsonData['addLat'];
			$addLng 		= $jsonData['addLng'];
			$addresstype	= $jsonData['addresstype'];  // 0=providerAdd 1=customerAdd
			$region_id 		= $jsonData['region_id'];
			$services_id	= $jsonData["services_id"];
			$another_id		= $jsonData["another_servicesId"];
			//print_r($another);die();
			$ss=[];			
			/*$checkDate = $date.' '.$time;
			$endTime = strtotime('+1 hours',strtotime($checkDate));
    		$endTime = date('H:i',$endTime);*/
			$WorkPerformUserId = '';
			$anoservices=[];
			$services=[];
			if(!empty($services_id) && !empty($another_id))
			{ 
				//echo "both";	
				$WorkPerformUserId = $this->Test1_model->UserAreaSearch($services_id,$another_id);
			}
			else if(!empty($services_id) && empty($another_id))
			{
				//echo "services_id";
				$WorkPerformUserId = $this->Test1_model->UserAreaSearch($services_id,$another_id);
			}
			else
			{
				//echo "another_id";
				$WorkPerformUserId= $this->Test1_model->UserSearchToAnother($another_id);
			}
			//print_r($WorkPerformUserId);die();
			//$WorkPerformUserId=array("22","23");		
			if(!empty($WorkPerformUserId))
	    	{ 
	    		$WorkPerformUserId = $this->Test1_model->checkOrderTime($WorkPerformUserId,$date,$time);
	    		
	    		//$WorkPerformUserId = $this->Order_model->checkPosition($WorkPerformUserId,$date,$time);
	    		print_r($WorkPerformUserId);die();

	    		$res = $this->Test1_model->search($time,$addLat,$addLng,$addresstype,$WorkPerformUserId); 
	    		$d='';	    		
	    		if(!empty($res))
	    		{
	    			//echo json_encode($res);die();
	    			foreach ($res as $key => $value)
		    		{
		    			$liveAddress=''; $liveLat=''; $liveLng='';
		    			$user_id      = $value->id;
		    			if($addresstype==1)
		    			{
		    				$liveAddressData = $this->Test1_model->moving_address($user_id);
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
		    			$rating  = $this->Freelancer_model->get_rating($user_id);
		    			//print_r($latestReview);die();
		    			if(!empty($services_id))
		    			{	    				
		    				$services	= $this->Order_model->service_price($user_id,$services_id);
		    			}
		    			if(!empty($another_id))
		    			{
		    				$anoservices= $this->Order_model->anoservice_price($user_id,$another_id);
		    			}
		    			//print_r($services);die();
		    			//print_r($anoservices);die();
		    			if($value->user_type==1)
			   		 	{ $user_type='Freelancer';}
			   		 	else
			   		 	{ $user_type='Company';}
			   		 	if($value->acceptance==1)
			   		 	{ $acceptance='Instant';}
			   		 	else
			   		 	{ $acceptance='Pre-approval';}

		    			$data["user_id"]			= $value->id;
		    			$data["company_id"]			= $value->company_id;
			   		 	$data["user_image"]			= base_url().'/upload/'.$value->user_image;
			    		$data["user_type"] 			= $user_type;   	
						$data["name"]				= $value->first_name.' '.$value->last_name;
						$data["acceptance"]			= $acceptance;					
						$data["address"]			= $value->provider_address;
						$data["lat"]				= $value->provider_lat;
						$data["long"]				= $value->provider_long;
						$data["liveAddress"]		= $liveAddress;
						$data["liveLat"]			= $liveLat;
						$data["liveLng"]			= $liveLng;
						$data["distance"]			= $value->distance;
						$data["Rating"]				= $rating;
						$data["latestReview"]		= $latestReview;
						$data["services"]			= $services;
						$data["another_services"]	= $anoservices;
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
			$order_service		= $jsonData['order_service'];
			$another_service 	= $jsonData['another_service'];
			//print_r($acceptance);die();
			$data = array(
				"provider_id"   => $provider_id,
				"customer_id" 	=> $customer_id,
				"date" 			=> $date,
				"time" 			=> $time,
				"address_type"  => $address_type,
				"address"		=> $address,
				"lat"			=> $lat,
				"lng"			=> $lng,
				"approve_status"=> $acceptance
				);
			if($acceptance==1)
			{	
				$message1 = "New booking request for you";	
				$pra = $this->Test1_model->get_notificationSetting($provider_id);

				print_r($pra);die();				
				//$this->Test1_model->SentDetailByEmail($data,$provider_id,$message1);
				$order_id =1;
				$this->Test1_model->notification($data,$provider_id,$customer_id,$order_id);
				//$this->Test1_model->ios($data,$provider_id);
			}
			else
			{
				echo $acceptance;
			}
			die();

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
				$book_service = array_merge($actual_service,$another_services);
				$this->Order_model->book_service($book_service);
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success";
				$response["order_id"]			= $order_id;
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

	public function sendOrderbill()
	{
		if(isset($_GET['order_id']) && $_GET['order_id']!='')
		{
			$data = new stdClass();
			$order_id = $_GET['order_id'];
			$order_detail = $this->Order_model->order_details($order_id);
			$payment_detail = $this->Test1_model->orderPaymentDetails($order_id);
			$req_services_details = $this->Order_model->order_service($order_id);
			$ano_services_details = $this->Order_model->another_orderService($order_id);
			$services = array_merge($req_services_details,$ano_services_details);
        	$provider_details   = $this->db->get_where('registration',array('id'=>$order_detail->provider_id))->row();
        	$customer_details   = $this->db->get_where('registration',array('id'=>$order_detail->customer_id))->row();

        	$details=array(
            "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
            "provider_email"=>$provider_details->email,
            "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
            "customer_email" =>$customer_details->email,
            );
        	

        	$data->details  = $details;
			$data->order_details  = $order_detail;
			$data->payment_detail = $payment_detail;
        	$data->services      = $services;
        	$this->load->view('NewOrderBill',$data);
			//$this->Communication_model->SentOrderBillByEmail($order_id,$order_details,$services);
			//echo json_encode($order_details);
		}
	}

	public function OrderRequestResponse()             //Accept or reject form Freelancer or member side
	{
		if(isset($_POST['order_id']) && $_POST['order_id']!='')
		{
			$order_id  = $_POST['order_id'];
			$status    = $_POST['status'];
			$customer_id =$_POST['customer_id']; 
			$provider_id =$_POST['freelancer_id'];
			// echo "hii";die();
		 	// order_id:  status:
			if($this->Order_model->OrderRequestResponse($order_id,$status))
			{
				if($status!=2)
				{
					$subject    = "Order Status";
					$message 	= "Your order id ".$order_id." has been accepted by provider.";
				 	$message1 	= "Your response has been successfully saved.";
				}
				else
				{
					$subject    = "Order Status";
					$message 	= "Sorry! Your order id  ".$order_id." has been rejected by provider.";
				 	$message1 	= "Your response has been successfully saved.";
				}
				$order_details = $this->Order_model->order_details($order_id);
			 	//print_r($order_details->provider_id);
			 	$provider_id=$order_details->provider_id;
			 	$data = array(
					"provider_id"   => $order_details->provider_id,
					"customer_id" 	=> $order_details->customer_id,
					"date" 			=> $order_details->date,
					"time" 			=> $order_details->time,
					"address"		=> $order_details->address,
					);
			 	$provider 	= $this->Communication_model->get_notificationSetting($provider_id);
			 	$customer 	= $this->Communication_model->get_notificationSetting($customer_id);
			 	//$subject 	= "Order Status";
			 	if($provider!='' && $provider->isEmail==1)
			 	{
			 		//For Order detials with customer details send to provider
			 		$this->Communication_model->SentDetailByEmail($data,$subject,$message1);
			 	}
			 	if($customer!='' && $customer->isEmail==1)
			 	{
			 		//Email send to the customer
			 		$order_details = $this->Order_model->order_details($order_id);
			 		$req_services_details = $this->Order_model->order_service($order_id);
					$ano_services_details = $this->Order_model->another_orderService($order_id);
					$services = array_merge($req_services_details,$ano_services_details);

					$this->Test1_model->SentBillByEmail($order_id,$order_details,$services,$subject,$message);

			 		//$this->Communication_model->sendCancelMessageToCustomer($customer_id,$message,$subject);
			 	}
			 	if($customer!='' && $customer->isSms==1)
			 	{
			 		//Message send to the customer mobile number
			 		//$this->Communication_model->sendSms($message,$customer_id);
			 	}			 	
			 	$this->Communication_model->customernotification($provider_id,$customer_id,$message);
			 	//$this->Communication_model->providernotification($provider_id,$customer_id,$message1);
			 	if($status==3 && $customer_id!='' && $provider_id!='')
				{
					$data= array(
						"order_id" =>$order_id,
						"customer_id"=>$customer_id,
						"provider_id"=>$provider_id,
						"rating"=>'-1',
						"comment"=>'Reject',
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

	public function notification()
	{
		$this->Test1_model->notification1();
	}

	public function checknotification()
    {
        define( 'API_ACCESS_KEY', 'AAAAv9zZY0U:APA91bEYhM--Ut6wl3CK0JCWK5KH7nkFEnOrdH_8fTYVVG3cY7jm_RqGyAFKFjLdMfsQnozWrknY5jZRhTceUJrKTTpw8wbKB0fVRuHMRVGEgTSf-sdHAw72PHHB1oznWdBrpK7aQtiR');
        //$registrationIds = array($_GET['id']);
        $registrationIds=array("fhk4ey92Eds:APA91bGeTZvFoOpp3mscmqmWCkVbqdvTI4QDE1hG0qpYDezRRhxPLZU5at8wiaHOde38r752COCvEZheijs6Pvj6YpMVIT7tNa1SP0SOpKB7rqjqCXe8KartUfRQMBJfRuuhdNpoqpqv");
        //print_r($regis);
        //echo "<br>";
        //print_r($registrationIds);die();
        // prep the bundle
        $msg = array
        (
            'message'   => 'Hii syplo',
            'title'     => 'syplo',
            'vibrate'   => 1,
            'sound'     => 1
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'          => $msg
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;
    }

    public function checksettings()
    {
    	$provider_id = $_POST['provider_id'];
    	$pra = $this->Test1_model->get_notificationSetting($provider_id);
    	print_r($pra->isEmail);
    	
    }

    public function checkemail()
    {
    	$this->Test1_model->sendemail();
    }

    public function cancel_booking_order()
	{
		extract($_POST);
		if(!empty($order_id))
		{
			if($this->Order_model->cancel_booking_orders($order_id))
			{
				$subject = "Order Status";
				$message = "Sorry! Your order has been canceled by customer. Cancel Order id is ".$order_id.'.';
				$order_details = $this->Order_model->order_details($order_id);
				$customer_id = $order_details->customer_id;
				$provider_id = $order_details->provider_id;
				$provider = $this->Communication_model->get_notificationSetting($provider_id);
				if($provider!='' && $provider->isEmail==1)
			 	{
					$this->Communication_model->sendCancelMessage($provider_id,$message,$subject);
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

	public function checkSms()
	{	//Content-Type: application/json; charset=ISO-8859-4
		//header('charset=ISO-8859-4');
		//header('content:text/html; charset=utf-8');
		$order_id   = 15;	
		$Message    = 'Du har fatt ett nytt omdome, ga in på Syplo appen för att se ditt omdöme.';
		//$smsMessage= utf8_encode($Message);

		$iso88591 = 'ÄÖÜ'; // file must be ISO-8859-1 encoded
		$smsMessage = utf8_decode($Message);
		//$utf8_2 = iconv('ISO-8859-1', 'UTF-8', $iso88591);
		//$utf8_2 = mb_convert_encoding($iso88591, 'UTF-8', 'ISO-8859-1');


		//print_r($utf8_2);die();
		//$smsMessage = $this->checkencoding($Message);
		//$smsMessage = iconv('UTF-8','UTF-8//IGNORE',$Message);
		//print_r($mm);die();
		$customer_id  = 25;
		$this->Test1_model->sendSms($smsMessage,$customer_id);//For customer
	}

	function checkencoding($text)
	{
		$string1 = call_user_func_array('mb_convert_encoding', array(&$text,'HTML-ENTITIES','UTF-8'));
		//$enc = mb_detect_encoding($text, "UTF-8,ISO-8859-1");

		//echo 'Detected encoding '.$enc."<br />";

		//return iconv($enc, "UTF-8", $text);
		return $string1;
	}

	

	public function service_request_listPrevious()
	{
		if(isset($_POST['company_id']) && $_POST['company_id']!='')
		{
			$company_id    = $_POST['company_id'];
			$member_id	   = $this->Company_model->members($company_id);
			$rr     = array(); 
			//print_r($member_id);
			foreach ($member_id as $key => $value) 
			{	
				$member_id  = $value->id;
				$response   = $this->Company_model->order_request($member_id);
				//print_r($response);
				if(!empty($response))
				{
					$member_detail = $this->Freelancer_model->customer_profile($value->id);
					if(!empty($member_detail))
					{
						$perResponse["data"]= $response;
						$perResponse["memberDetails"]=$member_detail;						
						$rr[]=$perResponse;
						//$memberDet[]= $member_details;
					}
				}
			}
			//print_r(count($rr));
			
			//echo json_encode($rr);die();			
			if(!empty($rr))
			{
				//$res=[];
		        //echo json_encode($response);die();
		        foreach ($rr as $key => $value) 
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
				$response   = $this->Test1_model->MemberRequestHistory($member_ids);
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

	public function SentOrderBillByEmail()  //For customer 
    {

		$order_id       = $_GET['order_id'];
    	$order_details 	= $this->Order_model->order_details($order_id);
		$customer_id 	= $order_details->customer_id;
		$provider_id 	= $order_details->provider_id;
		$req_services_details = $this->Order_model->order_service($order_id);
		$ano_services_details = $this->Order_model->another_orderService($order_id);
		$services = array_merge($req_services_details,$ano_services_details);
		$payment_detail  = $this->Test1_model->orderPaymentDetails($order_id);
		//----------------------------------------------------------------------------//
        $customer_details=$this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id))->row();
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        $company_name = '';
        if($provider_details->user_type==4)
	 	{ 
	 		$company_id = $provider_details->company_id;
	 		$company = $this->db->get_where('registration',array('id'=>$company_id))->row();
	 		$company_name = $company->company_name;
	 		$user_type='Company Member';
	 	}
	 	else
	 	{ $user_type='Freelancer';}    	
    	$details=array(
        "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
        "provider_email"=>$provider_details->email,
        "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
        "customer_email" =>$customer_details->email,
        "user_type" =>$user_type,
        "company_name"=>$company_name
        );
        $data->order_details  = $order_details;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;
        $data->details  = $details;
        $this->load->view('NewFinalOrderBill',$data);

    }

    public function forget_password()
  	{
  		$response = array("success" => 0, "error" => 0);
  		if(isset($_POST['tag']) && $_POST['tag']!='')
  		{
  			$tag = $_POST['tag'];
  			$res = '';
  			if($tag=='email' && isset($_POST['email']) && $_POST['email']!='')
  			{
  				$email = $_POST['email'];
				$res = $this->Test1_model->forget_password($email);
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
  			elseif ($tag=='MultiEmail' && isset($_POST['id']) && $_POST['id']!='') 
  			{
  				$id    = $_POST['id'];
				$email = $_POST['email'];
				$res   = $this->Test1_model->ForgetpasswordForMultipleEmail($id);
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


}
?>
