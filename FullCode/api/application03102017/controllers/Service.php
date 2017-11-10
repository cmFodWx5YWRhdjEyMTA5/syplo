<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{
	function __construct() 
	{
        parent::__construct();
            $this->load->model('Service_model');
             $this->load->model('Freelancer_model');
            
    }

	public function index()                       // Service with category 
	{
		$services =$this->Service_model->serviceCategory();
		$subCategory =$this->Service_model->subCategory();
		$response["error"]				= 0;	
		$response["success"]			= 1;
		$response["message"]			= "success";
		$response["category"]			= $services;
		$response["data"]				= $subCategory;
		echo json_encode($response);
	}
	public function arealist()
	{
		$res = $this->Service_model->arealist();
		$response["error"]				= 0;	
		$response["success"]			= 1;
		$response["message"]			= "success";
		$response["data"]				= $res;
		echo json_encode($response);
	}

	public function add_anothercategory()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$user_id =$_POST['user_id'];
			$category =$_POST['category'];
			$subCategory =$_POST['subCategory'];
			$data=array(
					'user_id'		=> $user_id,
			        'category'		=> $category,
			        'sub_category' 	=> $subCategory,    
					);	
			$res = $this->Service_model->add_subcategory($data);	
			if($res)
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["category"]			= $res->category;
	    		$response["data"]				= $res;
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Error occur!";
	    		$response["category"]			= '';
	    		$response["data"]				= '';
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

	public function service_offered_price()
	{
		$rawPostData = file_get_contents('php://input');
		$jsonData = json_decode($rawPostData,true);
		$user_id      = $jsonData['user_id'];
		$ActionStatus = $jsonData['ActionStatus']; 
		$another = $jsonData['anotherprice'];
		$service = $jsonData['serviceprice'];
		$res=''; $res1='';
		if(!empty($service) || !empty($another))
		{	
			if(!empty($service) && $ActionStatus!='')
			{
				$user_id=$jsonData['serviceprice'][0]['user_id'];
				if($ActionStatus=='signup')
				{	
					//print_r($ActionStatus);				
					$rr1= $this->Service_model->servicesprice($service,$user_id);	
					if($rr1)
					{ $res1= 'true'; }
					else
					{ $res1= 'false'; }
				}
				if($ActionStatus=='update')
				{
					//print_r($ActionStatus);
					$rr1= $this->Service_model->AddNewService($service);	
					if($rr1)
					{ $res1= 'true'; }
					else
					{ $res1= 'false'; }
				}	
			}
			if(!empty($another))
			{
				$rr= $this->Service_model->anotherprice($another);
				if($rr){ $res= 'true';}
				else{ $res= 'false';}
			}
			if($res=='true' && $res1=='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='false')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "Anothercategory is success and main is not success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='false' && $res1 =='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "main is success and Anothercategory is not success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='' && $res1=='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Not success";
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

	public function service_offered_price1()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{

			$user_id			= $_POST['user_id'];
			$ActionStatus       = $_POST['ActionStatus']; // signup or update
			$data				= $_POST['servicerate'];
			//   [{"service_id":"1","price":"500","pricetype":"0"}]
			$serviceRate		= json_decode($data);
			// service_offered_priceprint_r($serviceRate);die();
			$data1				= $_POST['otherservicerate'];//   [{"service_id":"1","price":"500","pricetype":"0"}]
			$anotherRate		= json_decode($data1);
			//print_r(count($serviceRate));
			//print_r(count($anotherRate));die();
	        $servicesprice ='';
	        $another='';
	        $res=''; $res1='';
			if(count($anotherRate)>0)
			{
				foreach ($anotherRate as $key)
				{
					$ac1["id"]=$key->service_id;
					$ac1["price"]=$key->price;
					$ac1["pricetype"]=$key->pricetype;
					$another[]=$ac1;
				}
				$rr= $this->Service_model->anotherprice($another);
				if($rr){ $res= 'true';}
				else{ $res= 'false';}
			}
			if(count($serviceRate)>0)
			{
				foreach ($serviceRate as $key)
				{
					$ac["user_id"]	  = $user_id;
					$ac["service_id"] = $key->service_id;
					$ac["price"]	  = $key->price;
					$ac["pricetype"]  = $key->pricetype;
					$servicesprice[]  = $ac;
				}
				if($ActionStatus=='signup')
				{
					$rr1= $this->Service_model->servicesprice($servicesprice,$user_id);	
					if($rr1)
					{ $res1= 'true'; }
					else
					{ $res1= 'false'; }
				}
				if($ActionStatus=='update')
				{
					//print_r($ActionStatus);
					$rr1= $this->Service_model->AddNewService($servicesprice);	
					if($rr1)
					{ $res1= 'true'; }
					else
					{ $res1= 'false'; }
				}
			}
			//echo $res;
			//echo $res1;die();	
			if($res=='true' && $res1=='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='false')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "Anothercategory is success and main is not success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='false' && $res1 =='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "main is success and Anothercategory is not success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='' && $res1=='true')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='')
			{
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
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		$response["data"]["serviceRate"]        = $serviceRate;
				$response["data"]["anoservicesRate"]    = $anoservicesRate;
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Not success";
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
	
	public function DeleteService()
	{
		if(isset($_POST['user_id']) && $_POST['user_id']!='')
		{
			$id          = $_POST['id'];
			$user_id     = $_POST['user_id'];
			$servicetype = $_POST['servicetype'];
			if($id!='' && $servicetype!='')
			{
				if($servicetype==0)
				{$tablename ='service_rate';}
				else
				{$tablename ='another_service';}
				if($this->Service_model->deleteservice($user_id,$id,$tablename))
				{
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
					$response["error"]				= 0;	
		    		$response["success"]			= 1;
		    		$response["message"]			= "success";
		    		$response["data"]["serviceRate"]        = $serviceRate;
					$response["data"]["anoservicesRate"]    = $anoservicesRate;
		    		echo json_encode($response); 
				}
				else
				{
					$response["error"]				= 1;	
		    		$response["success"]			= 0;
		    		$response["message"]			= "Not success! It is not found same id and user_id";
		    		$response["data"]				= array();
		    		echo json_encode($response); 
				}
			}
			else
			{
				$response["error"]				= 2;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Please fill all fields";
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

	public function update_services()
	{
		$rawPostData = file_get_contents('php://input');
		$jsonData = json_decode($rawPostData,true);
		$user_id = $jsonData["user_id"];
		$service = $jsonData['ActualService'];
		$another = $jsonData['AnotherService'];
		$res=''; $res1='';
		// print_r($another);die();
		if(!empty($service) || !empty($another))
		{	
			if(!empty($service))
			{
				$rr1= $this->Service_model->UpdateActualService($service,$user_id);	
				if($rr1)
				{ $res1= 'true'; }
				else
				{ $res1= 'false'; }
			}
			if(!empty($another))
			{
				$rr= $this->Service_model->UpdateAnotherService($another,$user_id);
				if($rr){ $res= 'true';}
				else{ $res= 'false';}
			}
			if($res=='true' && $res1=='true')
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='false')
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		echo json_encode($response);
			}
			elseif($res=='false' && $res1 =='true')
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		echo json_encode($response);
			}
			elseif($res=='' && $res1=='true')
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		echo json_encode($response);
			}
			elseif($res=='true' && $res1=='')
			{
				$response["error"]				= 0;	
	    		$response["success"]			= 1;
	    		$response["message"]			= "success";
	    		echo json_encode($response);
			}
			else
			{
				$response["error"]				= 1;	
	    		$response["success"]			= 0;
	    		$response["message"]			= "Not success";
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
    
}
