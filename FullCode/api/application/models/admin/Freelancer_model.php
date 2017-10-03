<?php
class Freelancer_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }
	
	public function Freelancer_user()
	{
		$this->db->select('*');
		$this->db->order_by("id","DESC");
		$this->db->where(array("user_type"=>1,'status'=>1));
		$query=$this->db->get("registration");		
		$result=$query->result();
		return $result;
	}
	public function get_user($id)
	{
		$this->db->where('id',$id);	
		$query=$this->db->get('registration');
		return $r=$query->row();
	}
	
	public function update_freelancer($data,$id)
	{
		$rr=$this->db->update('registration',$data,array('id'=>$id));
		if($rr)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id',$id);
		if($this->db->delete('registration'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function Freelancer_get($id)
	{
		$this->db->where('id',$id);	
		$query=$this->db->get('registration');
		$r=$query->row();
		//print_r($r->approve_status); die;
		if($r->approve_status==1)
		{       
	       $this->db->where('id',$id);	
            $rr=$this->db->update('registration',array('approve_status'=>'0'));
            if($rr)
            {            	
				echo "Approve Here";
            }
		}
		else
		{
			$this->db->where('id',$id);	
            $rr=$this->db->update('registration',array('approve_status'=>'1'));
			if($rr)
            {            	
				echo "Not Approved Here";
            }
		}
	}

	public function certificate_approved($id)
	{
		$this->db->where('id',$id);	
		$query=$this->db->get('certificate');
		$r=$query->row();
		//print_r($r->approve_status); die;
		if($r->approve_status==1)
		{       
	       $this->db->where('id',$id);	
            $rr=$this->db->update('certificate',array('approve_status'=>'0'));
            if($rr)
            {            	
				echo "Approved Here";
            }
		}
		else
		{
			$this->db->where('id',$id);	
            $rr=$this->db->update('certificate',array('approve_status'=>'1'));
			if($rr)
            {            	
				echo "Not Approve Here";
            }
		}
	}

	public function service_price($user_id)
    {
        $this->db->select('service_rate.*, services.category,sub_category');
        $this->db->from('service_rate');
        $this->db->join('services','service_rate.service_id=services.id');
        $this->db->where('service_rate.user_id',$user_id); 
        return $this->db->get()->result();
        // $this->db->get_where('service_rate',array('user_id'=>$user_id))->result();   
    }

    public function anoservice_price($user_id)
    {
        return $this->db->get_where('another_service',array('user_id'=>$user_id))->result();   
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
        $this->db->select('*');
        $this->db->from('certificate');
        $this->db->where(array('user_id'=>$user_id,'status'=>2));
        $WorkImage = $this->db->get()->result();
        return $WorkImage;
    } 

    public function certificateabout($user_id)
    {
    	$this->db->select('about');
        $this->db->from('certificate');
        $this->db->where(array('user_id'=>$user_id,'status'=>1));
        $certificateabout=$this->db->get()->row();
        return $certificateabout;
    }
    
    public function allCustomerAddress($user_id)
    {
        return $this->db->get_where('workarea',array('user_id'=>$user_id))->result();
       
    }

    public function service_level($user_id)
    {
        $level= $this->db->get_where('order',array('approve_status'=>1,'provider_id'=>$user_id,'order_status'=>1))->num_rows();
        if($level<500)
        {
            $levels ='Bronze';
        }
        elseif($level>=500 && $level<1000)
        {
            $levels ='Silver';
        }
        else
        {
            $levels ='Gold';
        }
        $data['complete'] = $level;
        $data['rank']     = $levels;
        return $data;

    }
	
}	