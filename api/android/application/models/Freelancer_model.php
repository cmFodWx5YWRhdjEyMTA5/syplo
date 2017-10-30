<?php
class Freelancer_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
       $this->load->database();
    }
	
	public function profile_freelancher($user_id)
	{  $user_services=[];
	   $user_anotherservice=[];
	   $user_certificate=[];
	   $user_WorkImage=[];
       $where ='(user_type=1 OR user_type=4)';
       $this->db->where($where);
		$user_detail=$this->db->get_where('registration',array('id'=>$user_id))->row();
		if($user_detail!=''){
			$service=$this->db->get_where('service_rate',array('user_id'=>$user_id))->result();
			if($service!='')
			{
			 foreach($service as $key)
			 {
				$service_id=$key->service_id;
				$services=$this->db->get_where('services',array('id'=>$service_id))->row();
				$user_services[]=array(
				'id'=>$key->service_id,
				'category'=>$services->category,
				'sub_category'=>$services->sub_category,
				'price'=>$key->price,
				'pricetype'=>$key->pricetype
				);
			 }
			}
			$anotherservice=$this->db->get_where('another_service',array('user_id'=>$user_id))->result();
			if($anotherservice!= '' ){
			    foreach($anotherservice as $k)
			    {
				$user_anotherservice[]=array(
				'id'=>$k->id,
				'category'=>$k->category,
				'sub_category'=>$k->sub_category,
				'price'=>$k->price,
				'pricetype'=>$k->pricetype
				);
			    }
		    } 
			$certificate=$this->db->get_where('certificate',array('user_id'=>$user_id,'status'=>1))->result();
			if($certificate!= '' ){
				foreach($certificate as $cc)
				{
					$user_certificate[]=array(
					'image'=>$cc->image,
					'about'=>$cc->about,
					'status'=>$cc->status,
                    'approve_status'=>$cc->approve_status
					);
				}
	        }  
		   $WorkImage= $this->db->get_where('certificate',array('user_id'=>$user_id,'status'=>2))->result();
		   if($WorkImage!= '' ){
				foreach($WorkImage as $c)
				{
					$user_WorkImage[]=array(
					'image'=>$c->image,
					'about'=>$c->about,
					'status'=>$c->status,
					'type'=>$c->type
					);
				}
	        } 
		   $age = $this->CalculateAge($user_detail->dob);
		   $latestReview = $this->get_latestReview($user_id);
           $status_level    = $this->service_level($user_id);//Bronze,silver..
           $rating  = $this->get_rating($user_id);
			
             if($user_detail->acceptance==0)
	   		 	{ $acceptance='Instant';}
	   		 	else
	   		 	{ $acceptance='Pre-approval';}

		   		if($user_detail->user_type==1)
		   		{ $user_type='Freelancer';}
                else if($user_detail->user_type==4)
                { $user_type='Member';}
		   		else
		   		{ $user_type='Company';}

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
                    $company_name = $company_details->company_name;
                }

            $response["error"]			            = 0;	
			$response["success"]		            = 1;
			$response["message"]		            = "Success";			
			$response["data"]["image"]              = base_url().'upload/'.$user_detail->user_image;
			$response["data"]["user_id"]          	= $user_detail->id;
            $response["data"]["company_id"]         = $company_id;
            $response["data"]["company_name"]       = $company_name; 
	        $response["data"]["user_type"]          = $user_type; 
            $response["data"]["age"]          		= $age; 
            $response["data"]["rating"]			    = $rating;
	        $response["data"]["latestReview"]		= $latestReview;  			
	        $response["data"]["experience"]         = $user_detail->experience; 
			$response["data"]["full_name"]          = $user_detail->first_name.' '.$user_detail->last_name;
			$response["data"]["gender"]            	= $user_detail->gender;
			$response["data"]["about"]              = $user_detail->about;
			$response["data"]["current_workplace"]  = $user_detail->current_workplace;
			$response["data"]["previous_workplace"] = $user_detail->previous_workplace;
			$response["data"]["canceling_policy"]   = $canceling_policy; 
			$response["data"]["acceptance"]         = $acceptance; 
            $response["data"]["complete_serviceLevel"]= $status_level;
	        $response["data"]["user_services"]    	= $user_services;
	        $response["data"]["user_anotherservice"]= $user_anotherservice;
			$response["data"]["user_Performed"]	    = $user_WorkImage; 
	        $response["data"]["user_certificate"]   = $user_certificate; 
			$response["data"]["certificate_url"]    = base_url().'certificateimage/'; 
			$response["data"]["workimage_url"]      = base_url().'workimage/';	        
			return $response;	 
		}
		else
			{				
				$response["error"]				= 1;	
				$response["success"]			= 0;
				$response["message"]			= "Error occur! User not found";
				return $response;
			}
	}	
	
	public function CalculateAge($age)
	{
		$from = new DateTime($age);
		$to   = new DateTime('today');
		return $from->diff($to)->y.' year old';
	}
	
	public function get_user_details($user_id)
	{    
	    $service_actual=[];
		$servic_another=[];
		$review_profile='';
		$user_detail=$this->db->get_where('registration',array('id'=>$user_id,'user_type'=>'2'))->row();
		if($user_detail!=null)
		{
			$review=$this->db->get_where('review',array('id'=>$user_id))->row();
			if($review != '')
			{
				$review_profile=array(
				'rating'=>$review->rating,
				'comment'=>$review->comment
				);
			}
			 $age = $this->CalculateAge($user_detail->dob);
			    $order=$this->db->get_where('order',array('customer_id'=>$user_id))->result();
				foreach($order as $keys)
				{
					$service=$this->db->get_where('order_service',array('order_id'=>$keys->id))->row();
					if($service->service_type == '0')
					{
				    	$services=$this->db->get_where('services',array('id'=>$service->service_id))->row();
						$service_actual[]=array(
						'id'=>$service->id,
				     	'category'=>$services->category,
					    'sub_category'=>$services->sub_category,
					    'price'=>$service->price,
					    'price_type'=>$service->price_type
					     );
					}
					else
					{
						$services_another=$this->db->get_where('another_service',array('id'=>$service->service_id))->row();
						$servic_another[]=array(
						'id'=>$services_another->id,
				     	'category'=>$services_another->category,
					    'sub_category'=>$services_another->sub_category,
					    'price'=>$services_another->price,
					    'price_type'=>$services_another->pricetype
					    );
					}
					
				}
				$response["error"]			  = 0;	
				$response["success"]		  = 1;
				$response["message"]		  = "Success";	
				$response["data"]["image"]         = base_url().'upload/'.$user_detail->user_image;
	            $response["data"]["age"]          = $age;   			
		        $response["data"]["experience"]         = $user_detail->experience; 
				$response["data"]["full_name"]          = $user_detail->first_name.' '.$user_detail->last_name;
				$response["data"]["gender"]            	= $user_detail->gender;
				$response["data"]["about"]              = $user_detail->about;			
	            $response["message"]	  =$review_profile;				
		        $response["data"]["user_services"]    = $service_actual;
		        $response["data"]["user_anotherservice"]	= $servic_another;
				return $response;
		}
	    else
		{				
			$response["error"]				= 1;	
			$response["success"]			= 0;
			$response["message"]			= "Error occur! User not found";
			return $response;
		}	
	}

	public function AcceptRequest($provider_id)
    {
        $this->db->select('id,customer_id');
        $this->db->from('order');
        $this->db->where(array('provider_id'=>$provider_id,'approve_status'=>1,'order_status'=>0));
        $cust = $this->db->get()->result();
        $response=[];
        //echo json_encode($cust);die();
        //print_r($cust);
        if(!empty($cust))
        {
            foreach ($cust as $key => $value) 
            {
            	$this->db->select('order.*,registration.first_name,last_name,email,dob,gender,user_image,user_type,about');
	            $this->db->from('order');
	            $this->db->join('registration','order.customer_id=registration.id');
	            $this->db->where('registration.id',$value->customer_id);  
	            $this->db->where('order.id',$value->id);    
	            $res_data = $this->db->get()->row();
	            $response[]=$res_data;    
            }
            //echo json_encode($response);die();
            return $response;
        }
        else
        {
            return $response;
        }
    }

    public function get_bookingHistory($provider_id)
    {
        $this->db->order_by('id','DESC');
        $where = '(order_status="1" or approve_status = "2")';
        $this->db->where('provider_id',$provider_id);
        $this->db->where($where);
        $this->db->from('order');
        $order=$this->db->get()->result();
        return $order;
    }

    public function customer_profile($cust_id)
    {
        //print_r($provider_id);
        $res= $this->db->get_where('registration',array('id'=>$cust_id))->row();
        return $res;
        //print_r($res);die();
    }

    public function CustomerReview($provider_id)
    {
        $this->db->select('id,customer_id');
        $this->db->from('review');
        // $this->db->where(array('provider_id'=>$provider_id,'rating!='=>-1));
        $this->db->where(array('provider_id'=>$provider_id));
        $this->db->order_by('id','DESC');
        $idd = $this->db->get()->result();
        $Cust_review=[];
        //print_r($idd);die();
        if(!empty($idd))
        {
            foreach ($idd as $k => $idv) 
            {
                $this->db->select('review.*,registration.first_name,last_name,user_image');
                $this->db->from('review');
                $this->db->join('registration','review.customer_id=registration.id');
                $this->db->where(array('registration.id'=>$idv->customer_id,'review.id'=>$idv->id));     
                $res_data = $this->db->get()->row();
                if($res_data!='')
                {
	                $res_da=array(
	                    "id"=> $res_data->id ,               //Review Id
	                    "customer_id"=> $res_data->customer_id,
	                    "provider_id"=>$res_data->provider_id,
	                    "rating"=> $res_data->rating,
	                    "comment"=> $res_data->comment,
	                    "creat_at"=> $res_data->creat_at,
	                    "first_name"=> $res_data->first_name,
	                    "last_name"=> $res_data->last_name,
	                    "user_image"=>base_url().'upload/'.$res_data->user_image
	                );
                	$Cust_review[]=$res_da;  
                }  
            }
            //echo json_encode($Cust_review);die();
            return $Cust_review;
        }
        else
        {
            return $Cust_review;
        }
    }

    public function get_latestReview($provider_id)
    {
        $this->db->select('id,customer_id');
        $this->db->from('review');
        $this->db->where(array('provider_id'=>$provider_id,'rating!='=>-1));
        $this->db->order_by('id','DESC');
        $idd = $this->db->get()->row();
        //print_r($idd);die();
        $res ='';
        if($idd!='')
        {
            $cuId= $idd->customer_id;
            $review_id = $idd->id;
            $this->db->select('review.*,registration.first_name,last_name,user_image');
            $this->db->from('review');
            $this->db->join('registration','review.customer_id=registration.id');
            $this->db->where(array('registration.id'=>$cuId,'review.id'=>$review_id));      
            $latestReview = $this->db->get()->row();
            if($latestReview!=null)
            {
                 $da=array(
                    "id"=> $latestReview->id ,
                    "customer_id"=> $latestReview->customer_id,
                    "provider_id"=>$latestReview->provider_id,
                    "rating"=> $latestReview->rating,
                    "comment"=> $latestReview->comment,
                    "creat_at"=> $latestReview->creat_at,
                    "first_name"=> $latestReview->first_name,
                    "last_name"=> $latestReview->last_name,
                    "user_image"=>base_url().'upload/'.$latestReview->user_image
                );
                //print_r($res_data);
                //echo json_encode($res_data);die();
                return $da;    
            }
            else
            {
                return $res;
            }
            
        }
        else
        {
            return $res;
        }
    }

    public function get_rating($user_id)
    {
        $this->db->select('rating');
        $this->db->from('review');
        $this->db->where('provider_id',$user_id);
        $rr = $this->db->get()->result();
        $NofRating = count($rr);
        $userRating =0;
        $countRating=0;
        if(!empty($rr))
        {
            foreach ($rr as $ratecount) 
            {
                $rat= $ratecount->rating;
                $countRating = $countRating+$rat;
            }
            //print_r ($countRating);
            $n =$countRating/$NofRating;
            $userRating = round($n,2);
            return $userRating;
        }
        else
        {
            return $userRating;
        }
    }

    public function SwitchUserExits($email,$currenty_type,$switch_type)
    {
        $query=$this->db->get_where('registration',array('email'=>$email,'user_type'=>$switch_type));
        $count=$query->num_rows(); 
        //print_r($count);die();
        if($count>0)
        {
           $q1= $this->db->get_where('registration',array('email'=>$email,'user_type'=>$currenty_type))->row();
           //print_r($q1->password);die();
            if($query->row()->approve_status==1)
            {
                if($query->row()->password==$q1->password)
                {
                    $id = $query->row()->id;
                    $r1 = $this->db->get_where('registration', array('id'=>$id))->row();
                    if($r1)
                    {
                        //print_r($r1);die();
                        $device_token = $q1->device_token;
                        $id = $r1->id;
                        $this->db->where('id',$id);
                        $update =$this->db->update('registration',array('device_token'=>$device_token));
                        $r2 = $this->db->get_where('accountdetails', array('user_id'=>$id))->result();
                        $data= array(
                                "u" =>$r1,
                                "a" =>$r2
                                ); 
                        $response["error"]              = 0;    
                        $response["success"]            = 1;
                        $response["message"]            = "success";
                        $image = base_url().'upload/'.$data['u']->user_image;
                        $response["data"]["user_image"]         = $image;
                        $response["data"]["user_id"]            = $data['u']->id;
                        $response["data"]["user_type"]          = $data['u']->user_type;    
                        $response["data"]["device_token"]       = $data['u']->device_token; 
                        $response["data"]["company_name"]       = $data['u']->company_name;
                        $response["data"]["reg_no"]             = $data['u']->registration_no;
                        $response["data"]["first_name"]         = $data['u']->first_name;
                        $response["data"]["last_name"]          = $data['u']->last_name;
                        $response["data"]["dob"]                = $data['u']->dob;
                        $response["data"]["address"]            = $data['u']->address;
                        $response["data"]["lat"]                = $data['u']->lat;
                        $response["data"]["long"]               = $data['u']->long;         
                        $response["data"]["mobile"]             = $data['u']->mobile;
                        $response["data"]["email"]              = $data['u']->email;
                        $response["data"]["password"]           = $data['u']->password;
                        $response["data"]["gender"]             = $data['u']->gender;
                        $response["data"]["about"]              = $data['u']->about;
                        $response["data"]["address_acceptance"] = $data['u']->address_acceptance; 
                        $response["data"]["availability"]       = $data['u']->availability;     
                        $response["data"]["canceling_policy"]   = $data['u']->canceling_policy; 
                        $response["data"]["acceptance"]         = $data['u']->acceptance;       
                        $response["data"]["seen_status"]        = $data['u']->seen_status; // 0=not, 1=yes
                        $response["data"]["approv_status"]      = $data['u']->approve_status;       
                        $response["account"]                    = $data['a'];
                        echo json_encode($response);
                        exit;         
                    }               
                    else
                    {
                        return $count;
                    }   
                }
                else
                {
                    return $count;
                }
            }
            else
            {
                $response["error"]          = 2;    
                $response["success"]        = 0;
                $response["message"]        = "User is not approved by syplo admin.";
                echo json_encode($response);
                exit;
            }
        }
        else
        {
            return $count;
        }
    }

    public function allCustomerAddress($user_id)
    {
        return $this->db->get_where('workarea',array('user_id'=>$user_id))->result();
       
    }
    public function userDays($user_id)
    {
        return $this->db->get_where('userdays',array('user_id'=>$user_id))->result();   
    }
    public function service_price($user_id)
    {

        $this->db->select('service_rate.*, services.category,sub_category');
        $this->db->from('service_rate');
        $this->db->join('services','service_rate.service_id=services.id');
        $this->db->where('service_rate.user_id',$user_id); 
        return $this->db->get()->result();
        // return $this->db->get_where('service_rate',array('user_id'=>$user_id))->result();   
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

    public function anoservice_price($user_id)
    {
        return $this->db->get_where('another_service',array('user_id'=>$user_id))->result();   
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

    public function basic_update($user_id,$data)
    {
        $this->db->where('id',$user_id);
        if($this->db->update('registration',$data))
        {
            return $this->db->get_where('registration', array('id'=>$user_id))->row();
        }
        else
        {
            return false;
        }
    }


    public function Other_BasicUpdate($user_id,$data)
    {
        $this->db->where('id',$user_id);
        if($this->db->update('registration',$data))
        {
            return $this->db->get_where('registration', array('id'=>$user_id))->row();
        }
        else
        {
            return false;
        }
    }

    public function daysUpdate($insertArray,$user_id)
    {
        if($this->db->delete('userdays',array('user_id'=>$user_id)))
        {
            $this->db->insert_batch('userdays',$insertArray);
           
        } 
        else
        {
            return false;
        }        
    }

    public function customerAddressUpdate($geoarea,$user_id)
    {
        if($this->db->delete('workarea',array('user_id'=>$user_id)))
        {
            $this->db->insert_batch('workarea',$geoarea);
        } 
        else
        {
            return false;
        }        
    }

     public function deleteCustomerAddress($user_id)
    {
        $this->db->delete('workarea',array('user_id'=>$user_id));
    }
    
    public function imageDelete($id,$user_id)
    {
        if($this->db->delete('certificate',array('id'=>$id,'user_id'=>$user_id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function CustomerChatList($user_id)
    {
        //Histroy and calanderlist provider
        $this->db->select('id,customer_id');
        $this->db->from('order');
        $this->db->group_by('customer_id');
        $this->db->where(array('provider_id'=>$user_id,'approve_status!='=>2));
        $CustomerChatList=$this->db->get()->result();
        //echo json_encode($HistoryProvider);die();
        return $CustomerChatList;
    }

    public function service_level($provider_id)
    {
        $level= $this->db->get_where('order',array('provider_id'=>$provider_id,'approve_status'=>1,'order_status'=>1))->num_rows();
        if($level>=200 && $level<500)
        {
            $levels ='Bronze';
        }
        elseif($level>=500 && $level<1000)
        {
            $levels ='Silver';
        }
        elseif($level>=1000)
        {
            $levels ='Gold';
        }
        else
        {
            $levels = '';
        }
        return $levels;

    }

    public function updatePosition($provider_id,$data)
    {
        $this->db->where(array('user_id'=>$provider_id,'address_status'=>1));
        return $this->db->update('workarea',$data);
    }
    
	
}	