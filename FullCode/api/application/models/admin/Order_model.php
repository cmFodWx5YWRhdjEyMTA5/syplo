<?php
class Order_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }
	public function Get_all_order()
   	{
        $userdata=array();
		$this->db->order_by("id","desc");
 		$data=$this->db->get_where('order')->result(); 
        //echo json_encode($data);die();
		foreach($data as $key){
		$customer=$this->db->get_where('registration',array('id'=>$key->customer_id))->row(); 
		$provider=$this->db->get_where('registration',array('id'=>$key->provider_id))->row(); 
        if(!empty($customer) && !empty($provider))
        {
    		$userdata[]=array(
    	      'order_id'=>$key->id,
    		  'provider_name'=>$provider->first_name .' '.$provider->last_name,
    		  'customer_name'=>$customer->first_name .' '.$customer->last_name,
    		  'order_date'=>$key->date,
    		  'order_time'=>$key->time,
    		  'address_type'=>$key->address_type,
    		  'address'=>$key->address,
    		  'approve_status'=>$key->approve_status,
    		  'order_status'=>$key->order_status,
              'cancel_policy'=>$key->provider_cancelPolicy
              );
        }
		}        
		return $userdata;
	}
	
	public function order_service($order_id)  
    {
        $this->db->select('service_id,service_type');
        $this->db->from('order_service');
        $this->db->where('order_id',$order_id);
        $service_ids = $this->db->get()->result();
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

    public function trans_detail($order_id)
    {
        $payment = $this->db->get_where('order_payment',array('order_id'=>$order_id))->result();    
        //echo json_encode($payment);die();
        return $payment;
    }

    public function discount_details()
    {
        $this->db->select('*');
        $this->db->from('discount');
        return $this->db->get()->result();
    }


	public function check_status($res){
	  return $this->db->get_where('order',array('id'=>$res->order_id))->row();
	}
	public function order_service_update($order_service_id)
	{
		return $this->db->get_where('order_service',array('id'=>$order_service_id))->row();
	}
	public function services_update($id,$data)
	{
		return $this->db->update('order_service',$data,array('id'=>$id));
	}
	public function order_service_delete($order_service_id) 
	{
		return $this->db->delete('order_service',array('id'=>$order_service_id));
	}
	public function order_update($order_id) 
	{
		return $this->db->get_where('order',array('id'=>$order_id))->row();
	}
	public function provider_name_get($key)
	{
		return $this->db->get_where('registration',array('id'=>$key->provider_id))->row();
	}
	public function provider()
	{
		$this->db->select('first_name,last_name,id,address');
        $this->db->from('registration');
        $this->db->where(array('user_type'=>'1'));
       return $service_ids = $this->db->get()->result();
	}
}	