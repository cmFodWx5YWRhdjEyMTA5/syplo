<?php
class Customer_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }
    public function login($data)
	{		
		$query =$this->db->get_where('admin', array('email' => $data['email'],'password'
			=>$data['password']));
		$result=$query->num_rows();
		if($result>0)
		{
			return $result->row();
		}
		else
		{
			return false;
		}
	}
	public function registred_customer()
	{
		$this->db->order_by("id","DESC");
		$this->db->where("user_type",2);
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

	public function update_customer($data,$id)
	{
		$this->db->where('id',$id);
		$rr=$this->db->update('registration',$data);
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

}