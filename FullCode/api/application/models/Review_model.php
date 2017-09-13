<?php
class Review_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
    }
	public function get_availability($user_id)
	{
	return $this->db->get_where('freelancher_availability',array('user_id'=>$user_id))->row();
	}
	public function insert_availability($data,$user_id,$res)
	{
		$q=$this->db->get_where('freelancher_availability',array('user_id'=>$user_id))->row();
		if($q==null)
		{
		  	$this->db->insert('freelancher_availability',$data);
			$this->db->update('registration',$res,array('user_id'=>$user_id));
			return $this->get_availability($user_id);
		}
		else
		{
			$this->db->update('freelancher_availability',$data,array('user_id'=>$user_id));
			$this->db->update('registration',$res,array('user_id'=>$user_id));
		    return $this->get_availability($user_id);
		}
	}
	public function check_end()
	{
		return $this->db->get('freelancher_availability')->result();
	}
	public function update_time($user_id)
	{   $data=array('show_position'=>'0');
		return $this->db->update('freelancher_availability',$data,array('user_id'=>$user_id));
	}
	public function request($order_id,$status)
	{ 
	    $data=array('approve_status'=>$status);
		return $this->db->update('order',$data,array('id'=>$order_id));
	}
	public function check_approve()
	{ 
	    $data=array('approve_status'=>$status);
		return $this->db->update('order',$data,array('id'=>$order_id));
	}

	public function checkCron()
	{
		$rand = rand(999,2222);
		$this->db->insert('check',array('name'=>$rand));
	}
}	