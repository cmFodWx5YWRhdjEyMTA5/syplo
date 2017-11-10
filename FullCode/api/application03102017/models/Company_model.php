<?php
class Company_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
    }

    public function profiledata($user_id)
    {
        return $this->db->get_where('registration', array('id'=>$user_id))->row();
    }

    public function profile_update($id,$data)
    {
        $this->db->where('id',$id);
        if($this->db->update('registration',$data))
        {
            return true;                                  
        }
        else
        {
            return false;
        }
    }

    public function isuserexits($email)
    {
        $query=$this->db->get_where('registration',array('email'=>$email));
        return $query->num_rows();      
    }

    public function registration($data)
    {
    	if($this->db->insert('registration',$data))
    	{ 
            $id = $this->db->insert_id(); 
            return $this->db->get_where('registration', array('id'=>$id))->row();        
    	}
    	else
    	{
    		return false;
    	}
    }

    public function paymentdetail($account,$res)
    {
    	if($this->db->insert_batch('accountdetails',$account))
    	{   		
            //$r1 = $this->db->get_where('registration', array('id'=>$res))->row();   
            $r2 = $this->db->get_where('accountdetails', array('user_id'=>$res))->result();          
            return $r2;
    	}
    	else
    	{
    		return false;
    	}
    } 

    public function certificate_detail($data)
    {
        $result=$this->db->insert_batch('certificate', $data);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

        /* service_request_list function */
    Public function members($company_id)
    {
        $this->db->select('id');
        $this->db->from('registration');
        $this->db->where('company_id',$company_id);
        $member_id = $this->db->get()->result();
        return $member_id;
    }


    Public function order_request($member_ids)
    { 
        $every = [];
        foreach ($member_ids as $key => $value) 
        {  
            //echo "ddds ".$value->id;
            $member_id =$value->id;
            $this->db->select('id,provider_id,customer_id');
            $this->db->from('order');
            $this->db->where('provider_id',$member_id);
            $this->db->where(array('order.approve_status'=>0,'order.order_status'=>0));
            $cust = $this->db->get()->result();
            //print_r($cust);
            if(!empty($cust))
            {
                foreach ($cust as $key => $value) 
                {
                    $cust_id  = $value->customer_id;   
                    $order_id = $value->id;
                    /*echo $cust_id; 
                    echo "<br>";
                    echo $order_id;*/
                    $this->db->select('order.*,registration.first_name,email,last_name,dob,gender,about,user_image,user_type');
                    $this->db->from('order');
                    $this->db->join('registration','order.customer_id=registration.id');
                    $this->db->where(array('order.approve_status'=>0,'order.order_status'=>0));
                    $this->db->where('registration.id',$cust_id);      
                    $this->db->where('order.id',$order_id);      
                    $response = $this->db->get()->row(); 
                    if(!empty($response))
                    {
                        $member_details = $this->customer_profile($member_id);
                        $rresponse["data"]            = $response;
                        $rresponse["memberDetails"]   = $member_details;                        
                        $rr[]=$rresponse;
                    }
                }
                //echo json_encode($rresponse);die();
                $every[] =$rr;            
                $rr='';
            }
        }
        if(!empty($every))
        {
            //echo json_encode($every);die(); 
            return $every;
        }
        else
        {
            return $every;
        } 
    }

    public function customer_profile($cust_id)
    {
        //print_r($provider_id);
        $res= $this->db->get_where('registration',array('id'=>$cust_id))->row();
        return $res;
        //print_r($res);die();
    }

    Public function CompanyBookingCalander($member_ids)
    { 
        $every = [];
        $rr = [];
        foreach ($member_ids as $key => $value) 
        {  
            //echo "ddds ".$value->id;
            $member_id =$value->id;
            $this->db->select('id,provider_id,customer_id');
            $this->db->from('order');
            $this->db->where(array('provider_id'=>$member_id,'approve_status'=>1,'order_status'=>0));
            $cust = $this->db->get()->result();
            //print_r($cust);die();
            if(!empty($cust))
            {
                foreach ($cust as $key => $value) 
                {
                    $cust_id  = $value->customer_id;   
                    $order_id = $value->id;
                    /*echo $cust_id; 
                    echo "<br>";
                    echo $order_id;*/
                    $this->db->select('order.*,registration.first_name,email,last_name,dob,gender,about,user_image,user_type');
                    $this->db->from('order');
                    $this->db->join('registration','order.customer_id=registration.id');
                    $this->db->where('registration.id',$cust_id);      
                    $this->db->where('order.id',$order_id);      
                    $response = $this->db->get()->row(); 
                    if(!empty($response))
                    {
                        $member_details = $this->customer_profile($member_id);
                        $rresponse["data"]            = $response;
                        $rresponse["memberDetails"]   = $member_details;                        
                        $rr[]=$rresponse;
                    }
                }
                //echo json_encode($rresponse);die();
                $every[] =$rr;            
                $rr='';
            }
        }
        if(!empty($every))
        {
            //echo json_encode($every);die(); 
            return $every;
        }
        else
        {
            return $every;
        } 
    }

    Public function CompanyBookingHistory($member_ids)
    { 
        $every = [];
        $rr = [];
        foreach ($member_ids as $key => $value) 
        {  
            //echo "ddds ".$value->id;
            $member_id =$value->id;
            $this->db->select('id,provider_id,customer_id');
            $this->db->from('order');
            $this->db->where('provider_id',$member_id);
            $where = '(approve_status=2 OR order_status=1)';
            $this->db->where($where);
            $cust = $this->db->get()->result();
            //print_r($cust);die();
            if(!empty($cust))
            {
                foreach ($cust as $key => $value) 
                {
                    $cust_id  = $value->customer_id;   
                    $order_id = $value->id;
                    /*echo $cust_id; 
                    echo "<br>";
                    echo $order_id;*/
                    $this->db->select('order.*,registration.first_name,email,last_name,dob,gender,about,user_image,user_type');
                    $this->db->from('order');
                    $this->db->join('registration','order.customer_id=registration.id');
                    $this->db->where('registration.id',$cust_id);      
                    $this->db->where('order.id',$order_id);      
                    $response = $this->db->get()->row(); 
                    if(!empty($response))
                    {
                        $member_details = $this->customer_profile($member_id);
                        $rresponse["data"]            = $response;
                        $rresponse["memberDetails"]   = $member_details;                        
                        $rr[]=$rresponse;
                    }
                }
                //echo json_encode($rresponse);die();
                $every[] =$rr;            
                $rr='';
            }
        }
        if(!empty($every))
        {
            //echo json_encode($every);die(); 
            return $every;
        }
        else
        {
            return $every;
        } 
    }


    public function order_service($order_id)  
    {        
        $this->db->select('id,order_id,service_id,service_type');
        $this->db->from('order_service');
        $this->db->where('order_id',$order_id);
        $service_ids = $this->db->get()->result();
        print_r($service_ids);
        $sss=[];
        if(!empty($service_ids))
        {
            foreach ($service_ids as $key => $value) 
            {
                $ser[] = $value->service_id;
            }
            //print_r($ser);
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

    public function delete_member($id)
    {
        $this->db->where('id',$id);
        if($this->db->delete('registration'))
        {
            return true;
        }
        else
        {
            return flase;
        }
    }

    public function delete_service($member_id)
    {
        $this->db->where('user_id',$member_id);
        $this->db->delete('service_rate');
    } 

    public function delete_workarea($member_id)
    {
        $this->db->where('user_id',$member_id);
        $this->db->delete('workarea');
    } 

    public function delete_user_days($member_id)
    {
        $this->db->where('user_id',$member_id);
        $this->db->delete('userdays');
    }           

    
}


 