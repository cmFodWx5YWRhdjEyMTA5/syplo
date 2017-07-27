<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CI_Controller
{
	function __construct() 
	{
        parent::__construct();
            $this->load->model('Review_model');          
    }
	
	
    public function index()
	{
		extract($_POST);
		$this->load->Review_model->check_approve();
		
	}
	public function check_availability()
	{
  		extract($_POST);
		$rse=$this->Review_model->get_availability($user_id);
	    if($rse!=null)
		{
			$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>$rse);
	        echo json_encode($res);
		}
		else
		{
			$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>'');
			echo json_encode($res);
		}
	}
	
	public function add_availability()
	{
		extract($_POST);
		$res=array('show_position'=>$status);
		$data=array('user_id'=>$user_id,'start_time'=>$start_time,'end_time'=>$end_time,'date'=>$date,'show_position'=>$status);
		$rse=$this->Review_model->insert_availability($data,$user_id,$res);
		$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>$rse);
		echo json_encode($res);
	}
	
	public function update_availability()
	{
		$res=date('y-m-d h:i', time());
		$data=$this->Review_model->check_end(); 
		foreach($data as $key)
		{   $user_id=$key->id;
			$date_time=$key->dates .' '.$key->end_time;
			if($res==$date_time){
			$this->Review_model->update_time($user_id);
			}
		}
	}
	
	public function get_request()
	{
      extract($_POST);	
	  $this->Review_model->request($order_id,$status);
      $res['success']='1';
	  $res['error']='0';
	  $res['message']='success';
      $res['status']=$status;
	  echo json_encode($res);	  
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
    		// print_r($WorkPerformUserId);die();
    		$res = $this->Order_model->search($time,$addLat,$addLng,$region_id,$WorkPerformUserId); 
    		$d='';
    		//echo json_encode($res);die();
    		if(!empty($res))
    		{
    			foreach ($res as $key => $value)
	    		{
	    			$user_id    = $value->id;
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
		   		 	$data["user_image"]			= base_url().'/upload/'.$value->user_image;
		   		 	if($value->user_type==1)
		   		 	{ $user_type='Freelancer';}
		   		 	else
		   		 	{ $user_type='Company';}
		   		 	if($value->acceptance==1)
		   		 	{ $acceptance='Instant';}
		   		 	else
		   		 	{ $acceptance='Pre-approval';}
		    		$data["user_type"] 			= $user_type;   	
					$data["name"]				= $value->first_name.' '.$value->last_name;
					$data["acceptance"]			= $acceptance;					
					$data["address"]			= $value->address;
					$data["lat"]				= $value->lat;
					$data["long"]				= $value->long;
					$data["distance"]			= $value->distance;
					$data["Rating"]				= '3.5';
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

	public function CronCheck()
	{
		$this->Review_model->checkCron();
	}

}	