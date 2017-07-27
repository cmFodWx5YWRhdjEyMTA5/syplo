<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Setting extends CI_Controller
{
	public function __construct()
	{
	    parent::__construct();
	    $this->load->model('Setting_model');
		$this->load->model('Registration_model');
	}
	public function index()
	{

	}

	public function user_setting()
	{
		if(isset($_POST['id']) && $_POST['id']!='')
		{
			$id 	    = $_POST['id'];
			$isSms		= $_POST['isSms'];           //0=off,1=On;
			$isEmail	= $_POST['isEmail'];         //0=off,1=On;
			$user_type  = $_POST['user_type'];       //0=registration, 1=member
			$data=array(
				'isSms'=>$isSms,
				'isEmail'=>$isEmail,
				);
			$res = $this->Setting_model->setting($id,$data);
			if($res)
			{
				$response["error"]		= 0;	
	    		$response["success"]	= 1;
	    		$response["message"]	= "success";
	    		$response["data"]		= $res;
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]		= 1;	
				$response["success"]	= 0;
				$response["message"]	= "Error occur";
				$response["data"]		= '';
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

	public function get_user_stting()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='' && isset($_POST['user_type']) && $_POST['user_type']!='')
		{
			$user_id 	= $_POST['user_id'];
			$user_type  = $_POST['user_type'];
			$data= array(
				"user_id"=>$user_id,
				"user_type"=>$user_type
				);
			$res = $this->Setting_model->get_setting($data);
			if($res)
			{
				$response["error"]		= 0;	
	    		$response["success"]	= 1;
	    		$response["message"]	= "success";
	    		$response["data"]		= $res;
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]		= 1;	
				$response["success"]	= 0;
				$response["message"]	= "Error occur";
				$response["data"]		= '';
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
	
	public function Add_card()
	{
	   $rawPostData  = file_get_contents('php://input');
       $jsonData   = json_decode($rawPostData,true);
	   $user_id=$jsonData['Account'][0]['user_id'];
	   foreach($jsonData as $key =>$value){
		   $values=$value;
	   }
	   $data= $this->Registration_model->paymentdetail($values,$user_id);
	   $userdata=array('success'=>'1','error'=>'0','message'=>'success','data'=>$data);
	   echo json_encode($userdata);
	}

	public function check_availability()
	{
  		extract($_POST);
		$rse=$this->Setting_model->get_availability($user_id);
	    if($rse!=null)
		{
			$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>$rse);
	        echo json_encode($res);
		}
		else
		{
			$res=array('success'=>'0','error'=>'1','message'=>'Not found','data'=>'');
			echo json_encode($res);
		}
	}
	
	public function add_availability()
	{
		extract($_POST);
		$res=array('show_position'=>$status);
		$data=array(
			'user_id'=>$user_id,
			'start_time'=>$start_time,
			'end_time'=>$end_time,
			'dates'=>$date,
			'show_position'=>$status
			);
		$rse=$this->Setting_model->insert_availability($data,$user_id,$res);
		$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>$rse);
		echo json_encode($res);
	}
	
	public function update_availability_by_id()
	{
		extract($_POST);
		$data=array('show_position'=>$status);
		if($status==1)
		{
			$rgStatus =0;
		}
		else
		{
			$rgStatus=1;
		}
		$rse=$this->Setting_model->update_availability($user_id,$data,$calander_id,$rgStatus);
		if($rse!=null)
		{
			$res=array('success'=>'1','error'=>'0','message'=>'success','data'=>$rse);
	        echo json_encode($res);
		}
		else
		{
			$res=array('success'=>'0','error'=>'1','message'=>'Not found','data'=>'');
			echo json_encode($res);
		}
	}
	
	/* for cron job to update avaibality time and status start */

	public function update_availability()
	{
		date_default_timezone_set("Asia/Kolkata");
		$res=date('Y-m-d H:i', time());
		echo $res;
		$data=$this->Setting_model->check_end(); 
		foreach($data as $key)
		{   $id=$key->id;
			$user_id= $key->user_id;
			//echo $id; echo $user_id;
			$date_time=$key->dates .' '.$key->end_time;
			if($res==$date_time)
			{
				//echo "yess";
			  	$this->Setting_model->update_time($id,$user_id);
			}
		}
	}

	/* for cron job to update avaibality time and status End*/

	
	public function Review_get()
    {
		extract($_POST);
		if(!empty($provider_id))
		{
			$data=$this->Setting_model->Review_get_by_id($provider_id);
			if($data!=null)
		    {   
		     foreach($data as $key)
			 { 
			     $customer_id=$key->customer_id;
               $custumer=$this->Setting_model->customer_get($customer_id);	 
			   $user_data[]=array(
				'full_name'=>$custumer->first_name .''.$custumer->last_name,
				'rating'=>5,
				'comment'=>$key->comment
			   );
			 }
				$response["error"]				= 0;	
				$response["success"]			= 1;
				$response["message"]			= "Success data" ;
				$response["data"]               =$user_data;
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
	
}	
