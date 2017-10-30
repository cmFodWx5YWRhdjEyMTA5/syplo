<?php
class Order_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
    }
    
    public function UserAreaSearch($services_id,$another)
    {   
        $match=0;
        $perfectId=array();
        $perfectId1=array();
        $this->db->where_in('service_id',$services_id);
        $this->db->from('service_rate');
        $this->db->group_by('user_id');
        $data=$this->db->get()->result();
        if(!empty($data))
        {
            $us='';
            foreach ($data as $key)
            {
                $us[]= $key->user_id;
            }
            $user_ids=count($us);
            $service_ids=count($services_id);
            for($i=0; $i<$user_ids; $i++)
            {
                for($j=0; $j<$service_ids; $j++)
                {
                    if($res=$this->db->get_where('service_rate',array('user_id'=>$us[$i],'service_id'=>$services_id[$j])))
                    {
                        if($res->num_rows()>0)
                        {
                            $match++;
                        }
                    }
                }
                if($match==$service_ids)
                {
                    $perfectId[]=$us[$i];
                }
                // print_r($i.'='.$match.',');
                $match=0;
            }
           if(!empty($perfectId) && !empty($another))
            {
                $match1=0;
                for($k=0; $k<count($perfectId); $k++)
                {
                    for($l=0; $l<count($another); $l++)
                    {
                        if($res1=$this->db->get_where('another_service',array('user_id'=>$perfectId[$k],'id'=>$another[$l])))
                        {
                            if($res1->num_rows()>0)
                            {
                                $match1++;
                            }
                        }
                    }
                    if($match1==count($another))
                    {
                        $perfectId1[]=$perfectId[$k];
                    }
                        $match1=0;
                }                
                return $perfectId1;
            }      
            else
            {
                return $perfectId;
            }
        }
        else
        {
           return $perfectId;         // when no user id found
        }
    }

    public function UserSearchToAnother($another_id)
    {
        $this->db->select('user_id');
        $this->db->where_in('id',$another_id);
        $this->db->from('another_service');
        $this->db->group_by('user_id');
        $data1=$this->db->get()->result();
        $match1=0;
        $actual=array();
        //print_r(count($another_id));die();
        foreach ($data1 as $key)
        {
            $our[]= $key->user_id;
        }
        for($k=0; $k<count($our); $k++)
        {
            for($l=0; $l<count($another_id); $l++)
            {
                if($our_res=$this->db->get_where('another_service',array('user_id'=>$our[$k],'id'=>$another_id[$l])))
                {
                    if($our_res->num_rows()>0)
                    {
                        $match1++;
                    }
                }
            }
            if($match1==count($another_id))
            {
                $actual[]=$our[$k];
            }
                // print_r($i.'='.$match.',');
                $match1=0;
        }                
        //print_r($actual);die();
        return $actual;
    }
    //Check Provider is not book at given date and time Start
    public function checkOrderTime($Ids,$date,$times)
    {
        //print_r($Ids);die();
        $countId = count($Ids);
        for($i=0; $i<$countId; $i++)
        {
            $this->db->select('*');
            $this->db->from('order');
            $this->db->where(array('provider_id'=>$Ids[$i],'date'=>$date,'approve_status'=>1,'order_status'=>0));
            $cc = $this->db->get();
            $c  = $cc->num_rows();
            if($c>0)
            {
                $order   = $date.' '.$times; //Request order time
                $orderAt= strtotime($order); 
                $da = $cc->row();
                $otime=$da->time;  //already booking time at given date                
                $alreadyDate =  $da->date;
                $alreadyTime =  $da->time;
                $alreadyBookTime = $alreadyDate.' '.$alreadyTime;
                $AfterTime = strtotime('+2 hours',strtotime($alreadyBookTime));
                $BeforeTime = strtotime('-2 hours',strtotime($alreadyBookTime));
                if($orderAt>=$BeforeTime && $orderAt<=$AfterTime)
                //if($otime<$times)
                { $Ids[$i]=0;}
            }
        }
        return $Ids;
    }


    /*public function checkOrderTime($Ids,$date,$times)
    {
        $countId = count($Ids);
        for($i=0; $i<$countId; $i++)
        {
            $this->db->select('*');
            $this->db->from('order');
            $this->db->where(array('provider_id'=>$Ids[$i],'date'=>$date,'approve_status'=>1,'order_status'=>0));
            $cc =$this->db->get();
            $c= $cc->num_rows();
            if($c>0)
            {
                $da = $cc->row();
                $otime=$da->time;
                if($otime<=$times)
                { $Ids[$i]=0; }
            }
        }        
        return $Ids;
    }*/
    //Check Provider is not book at given date and time End

    //Check Provider that he is not off show position at this date and time Start

    public function checkTimeAvailability($Ids,$date,$times)
    {
        $dd   = strtotime($date);
        $Odate = date('Y-m-d',$dd);
        $countId = count($Ids);
        for($i=0; $i<$countId; $i++)
        {
            //echo "hii";
            $this->db->select('*');
            $this->db->from('freelancher_availability');
            $this->db->where(array('user_id'=>$Ids[$i],'dates'=>$Odate,'start_time<='=>$times ,'end_time>'=>$times,'show_position'=>1));
            $cc =$this->db->get();
            $c= $cc->num_rows();
            if($c>0)
            {               
                $Ids[$i]=0;
            }
        }        
        return $Ids;
    }

   //Check Provider that he is not off show position at this date and time end

    public function moving_address($user_id)
    {
        return $this->db->get_where('workarea',array('user_id'=>$user_id,'address_status'=>1))->row();

    }

    public function search($time,$addLat,$addLng,$addresstype,$WorkPerformUserId)
    {
        
        $ww_id=array();
        //print_r($WorkPerformUserId);die();
        for($w=0; $w<count($WorkPerformUserId); $w++)
        {
            $this->db->select('id,availability,address_acceptance');
            $this->db->from('registration');
            $this->db->where(array('id'=>$WorkPerformUserId[$w],'status'=>1));
            $AcceptWhere = '(address_acceptance="2" or address_acceptance='.$addresstype.')';
            $this->db->where($AcceptWhere);
            $av=$this->db->get()->row();   
            if($av!='')
            {
                 $where = '(user_type="1" or user_type="4")';
                if($addresstype==1)
                {
                    if($av->availability==2)
                    {                
                        $this->db->where(array('start_time<'=>$time,'end_time>'=>$time));
                    }                   
                    $this->db->select("workarea.id,user_id,registration.*,( 3959 * acos( cos( radians($addLat) ) * cos( radians(`area_lat`) ) * cos( radians( `area_lng` ) - radians($addLng) ) + sin( radians($addLat) ) * sin( radians( `area_lat` ) ) ) ) AS distance");
                    $this->db->from('registration');
                    $this->db->join('workarea','workarea.user_id=registration.id');
                    $this->db->where(array('registration.id'=>$WorkPerformUserId[$w],'registration.approve_status='=>1));
                    $this->db->where($where);
                    $this->db->having('distance <= ',2);  
                    $this->db->order_by('distance');
                    $res=$this->db->get()->row();
                    if(!empty($res))
                    {                
                         $ww_id[] = $res;
                    }
                }   
                else
                {
                    $this->db->select("*,( 3959 * acos( cos( radians($addLat) ) * cos( radians(`provider_lat`) ) * cos( radians( `provider_long` ) - radians($addLng) ) + sin( radians($addLat) ) * sin( radians( `provider_lat` ) ) ) ) AS distance");
                    $this->db->from('registration');
                    $this->db->where(array('id'=>$WorkPerformUserId[$w],'approve_status='=>1));
                    $this->db->where($where);
                    $this->db->having('distance <= ',5);  
                    $this->db->order_by('distance');
                    $res1=$this->db->get()->row();
                    if(!empty($res1))
                    {                
                        $ww_id[] = $res1;
                    }
                }                  
            }
        }   
        return $ww_id;
        //print_r($av);die();
        //echo json_encode($ww_id);die();          
        //return $this->db->get()->result();   
    }

                    /* old search end */
    public function search1($time,$addLat,$addLng,$region_id,$WorkPerformUserId)
    {
        $this->db->where_in('id',$WorkPerformUserId);           
        $this->db->where(array('start_time<'=>$time,'end_time>'=>$time,'approve_status='=>1,'user_type='=>1));
        $this->db->select("*,( 3959 * acos( cos( radians($addLat) ) * cos( radians(`lat`) ) * cos( radians( `long` ) - radians($addLng) ) + sin( radians($addLat) ) * sin( radians( `lat` ) ) ) ) AS distance");
        $this->db->from('registration');
        $this->db->having('distance <= ',1500);  
        $this->db->order_by('distance');
       // print_r($this->db->get()->result());die(); 
         return $this->db->get()->result();   
    }

                        /* old search end*/

    public function service_price($user_id,$service_id)
    {
        $this->db->select('services.*,service_rate.price,pricetype');
        $this->db->from('services');
        $this->db->join('service_rate','services.id=service_rate.service_id');
        $this->db->where_in('services.id',$service_id);
        $this->db->where('service_rate.user_id',$user_id);
        $this->db->order_by('services.sub_category');
        $service= $this->db->get()->result();
        return $service;
    }

    public function anoservice_price($user_id,$another_id)
    {
        $this->db->select('id,category,sub_category,price,pricetype,create_at');
        $this->db->from('another_service');
        $this->db->where_in('id',$another_id);
        $this->db->where('user_id',$user_id);
        $this->db->order_by('sub_category');
        $anoservice= $this->db->get()->result();
        return $anoservice;
    }

    public function ProviderCertificate($user_id)
    {
        $this->db->select('id,image,about,status,approve_status');
        $this->db->from('certificate');
        $this->db->where(array('user_id'=>$user_id,'status'=>1));
        $certificate=$this->db->get()->result();
        return $certificate;
    }
    public function ProviderWorkImage($user_id)
    {
        $this->db->select('id,image,about,status,type');
        $this->db->from('certificate');
        $this->db->where(array('user_id'=>$user_id,'status'=>2));
        $WorkImage = $this->db->get()->result();
        return $WorkImage;
    }

    public function book($data)
    {
        if($this->db->insert('order',$data))
        { return  $this->db->insert_id(); }
        else
        { return false; }
    } 

    public function book_service($book_service)
    {
        $this->db->insert_batch('order_service',$book_service);
    }

    public function storetransaction_details($data)
    {
        if($this->db->insert('order_payment',$data))
        {
            $id = $this->db->insert_id();
            return $this->db->get_where('order_payment',array('id'=>$id))->row();
        }
    } 
    public function updateDiscountStatus($discount_id,$taken_timestamp,$order_id)
    {
        $this->db->where('id',$discount_id);
        $this->db->update('user_discount',array('status'=>1,'taken_timestamp'=>$taken_timestamp,'order_id'=>$order_id));
    }

            /* service_request_list function */

    public function order_request($user_id)
    {
        $this->db->select('customer_id');
        $this->db->from('order');
        $this->db->where('provider_id',$user_id);
        $cust = $this->db->get()->result();
        $response=[];
        //print_r($cust);die();
        if(!empty($cust))
        {

            foreach ($cust as $key => $value) 
            {
                $cust_id[]=$value->customer_id;    
            }
            $this->db->select('order.*,registration.first_name,last_name,email,mobile,dob,gender,about,user_image,user_type');
            $this->db->from('order');
            $this->db->join('registration','order.customer_id=registration.id');
            $this->db->where(array('order.approve_status'=>0,'order.order_status'=>0));
            $this->db->where_in('registration.id',$cust_id); 
            $this->db->where('order.provider_id',$user_id);     
            $response = $this->db->get()->result();
            //print_r($response);die();
            return $response;
        }
        else
        {
            return $response;
        }
        
            //echo json_encode($response);die();        
            //print_r($response);die();
    }    

    public function order_service($order_id)  
    {        
        $this->db->select('id,service_id,service_type');
        $this->db->from('order_service');
        $this->db->where('order_id',$order_id);
        $service_ids = $this->db->get()->result();
        //print_r($service_ids);
        $sss=[];
        if(!empty($service_ids))
        {
            foreach ($service_ids as $key => $value) 
            {
                $ser[] = $value->service_id;
            }
        // $this->db->select('services.category,sub_category,create_at,order_service.service_id,price,price_type,order_service.id,service_type');
        $this->db->select('services.category,sub_category,create_at,order_service.*');
        $this->db->from('services');
        $this->db->join('order_service','order_service.service_id=services.id');
        $this->db->where(array('order_service.order_id'=>$order_id,'order_service.service_type'=>0));
        $this->db->where_in('services.id',$ser);
        $sss=$this->db->get()->result();
        //echo json_encode($sss);die();
            return $sss;
        }
        else
        {
            return $sss;
        }
        //print_r($sss);die();
        //echo json_encode($sss);die();
    }

    public function another_orderService($order_id)  
    {
        $this->db->select('service_id,service_type');
        $this->db->from('order_service');
        $this->db->where(array('order_id'=>$order_id,'service_type'=>1));
        $service_ids = $this->db->get()->result();
        $sss1=[];
        if(!empty($service_ids))
        {
            foreach ($service_ids as $key => $value)
            {
                $ser1[] = $value->service_id;
            }
            //$this->db->select('another_service.category,sub_category,create_at,order_service.id,service_id,order_service.price,price_type,service_type');
            $this->db->select('another_service.category,sub_category,create_at,order_service.*');
            $this->db->from('another_service');
            $this->db->join('order_service','order_service.service_id=another_service.id');
            $this->db->where(array('order_service.order_id'=>$order_id,'order_service.service_type'=>1));
            $this->db->where_in('another_service.id',$ser1);
            $sss1=$this->db->get()->result();
            //echo json_encode($sss1);die();
            return $sss1; 
        }
        else
        {
            return $sss1;
        }
        //print_r($service_ids);die();        
        //print_r($sss);die();
    }

    /* service_request_list function End */

    public function book_service_prise($asp,$order_id)
    {
       $re=$this->db->update_batch('order_service',$asp,'id');
       if($re)
       {
            $data =array('order_status'=>1);
            $this->db->where('id',$order_id);
            $this->db->update('order',$data);
            return true;
       }
       else
       {
            return false;
       }
    }

    public function final_order($order_id)
    {
        $data =array('order_status'=>1);
        $this->db->where('id',$order_id);
        if($this->db->update('order',$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    
    public function OrderRequestResponse($order_id,$status)
    { 
        $data=array('approve_status'=>$status);
        return $this->db->update('order',$data,array('id'=>$order_id));
    }

	public function insert_review($data)
	{
	  $this->db->insert('review',$data);	
	  return $this->db->insert_id();
	}
	public function get_review($id)
	{
	  return $this->db->get_where('review',array('id'=>$id))->row();
	}
    // hello
	
	public function get_order_list($user_id)
	{
		// return $order=$this->db->get_where('order',array('customer_id'=>$user_id,'order_status'=>'0'))->result();
        //$where = '(order_status="0" and approve_status="0" or approve_status = "2")';
        //$where = '(approve_status="0" or approve_status = "2")';
        $where = '(approve_status=0 or approve_status=1 )';
        $this->db->where(array('customer_id'=>$user_id,'order_status'=>0));
        $this->db->where($where);
        $this->db->from('order');
        $this->db->order_by('id','DESC');
        $order=$this->db->get()->result();
        //echo json_encode($order);die();
        return $order;
	}

    public function freelancher_profile($provider_id)
    {
        //print_r($provider_id);
        $res= $this->db->get_where('registration',array('id'=>$provider_id))->row();
        return $res;
        //print_r($res);die();
    }
	
	public function CalculateAge($age)
	{
		$from = new DateTime($age);
		$to   = new DateTime('today');
		return $from->diff($to)->y.' year old';
	}
	
	public function order_history($user_id)
	{
        $this->db->order_by('id','DESC');
        $where = '(order_status="1" or approve_status = "2")';
        $this->db->where('customer_id',$user_id);
        $this->db->where($where);
        $this->db->from('order');
        $order=$this->db->get()->result();
        return $order;
        /*$this->db->order_by('id','DESC');
		return $order=$this->db->get_where('order',array('customer_id'=>$user_id,'order_status'=>'1'))->result();*/
	}

    public function checkReviewStatus($order_id,$giver_id)
    {
        return $this->db->get_where('review', array('order_id'=>$order_id,'customer_id'=>$giver_id))->num_rows();
    }
	
	public function cancel_booking_orders($order_id)	
	{ 
	   $data=array('approve_status'=>'2');
		return $this->db->update('order',$data,array('id'=>$order_id));
		//return $this->get_booking($user_id);
	}

    public function ProviderChatList($user_id)
    {
        //Histroy and calanderlist provider
        $this->db->select('id,provider_id');
        $this->db->from('order');
        $this->db->group_by('provider_id');
        $this->db->where(array('customer_id'=>$user_id,'approve_status!='=>2));
        $HistoryProvider=$this->db->get()->result();
        //echo json_encode($HistoryProvider);die();
        return $HistoryProvider;
    }


    // For cron job 
    public function CheckOrderDateTime($current_date,$current_time,$NextExpireTime)
    {
        $where ='(approve_status=0 or approve_status=1)';
        $where1 ='(time='."'".$current_time."'".'or time<'."'".$NextExpireTime."'".' and time>='."'".$current_time."'".')';
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where(array('date'=>$current_date,'order_status'=>0));
        $this->db->where($where);
        $this->db->where($where1);
        $result =$this->db->get()->result();
        //print_r($result);
        return $result;
    }
    // For cron job

    public function order_details($order_id)
    {
        return $this->db->get_where('order',array('id'=>$order_id))->row();
    }

    public function checkGeneralDiscount($customer_id,$discountCode)
    {
        $today = date('d-m-Y');
        $DisDetails = $this->db->get_where('discount',array('code'=>$discountCode))->row();
        if(!empty($DisDetails))
        {
            $expireDate = $DisDetails->expiredate;
            $discountStatus = $DisDetails->status;
            $expire     = strtotime($expireDate);
            $today      = strtotime($today);
            if($expire>=$today && $discountStatus==1)
            {
                $details = $this->checkDiscountExistance($customer_id,$discountCode,$DisDetails);
                return $details;
                //exit;
            }
            else
            {
                $response['error'] = 1;
                $response['success'] = 0;
                $response['message'] = "This code is expired or not active";
                $response['discountDetails'] ='';
                echo json_encode($response);
            }
        }
        else
        {
            $response['error'] = 2;
            $response['success'] = 0;
            $response['message'] = "Invalid code";
            $response['discountDetails'] ='';
            echo json_encode($response);
            exit;
        }  
    }

    public function checkDiscountExistance($customer_id,$discountCode,$DisDetails) 
    {
        
        $count = $this->db->get_where('user_discount',array('customer_id'=>$customer_id,'code'=>$discountCode,'status'=>1,'discount_type'=>0))->num_rows();
        //print_r($count);die();
        if($count>0)
        {
            $response['error'] = 3;
            $response['success'] = 0;
            $response['message'] = "Alreay use";
            $response['discountDetails'] ='';
            echo json_encode($response);
        }
        else
        {
            //echo json_encode($DisDetails);3
            $data = array(
                "customer_id"   =>$customer_id,
                "code"          =>$discountCode,
                "discount"      =>$DisDetails->discount,
                "type"          =>$DisDetails->type,
                "discount_type" =>$DisDetails->discount_type,
                "status"        =>0            //Because here transaction is not complete
                );
            $cc = $this->db->get_where('user_discount',array('customer_id'=>$customer_id,'code'=>$discountCode,'status'=>0));
            $checkExist = $cc->num_rows();
            if($checkExist>0)
            {
               $disData = $cc->row();
               $U_DisId = $disData->id;
               $this->db->where('id',$U_DisId);
               $this->db->update('user_discount',$data); 
               return $this->db->get_where('user_discount',array('id'=>$U_DisId))->row();   

            }
            else
            {
                if($this->db->insert('user_discount',$data))
                {
                    $discount_id = $this->db->insert_id();
                    return $this->db->get_where('user_discount',array('id'=>$discount_id))->row();    
                }
                else
                {
                    $response['error'] = 4;
                    $response['success'] = 0;
                    $response['message'] = "Opps! Error occur. Please try again";
                    $response['discountDetails'] ='';
                    echo json_encode($response);
                    exit;
                } 
            }
        }
    }


}
?>