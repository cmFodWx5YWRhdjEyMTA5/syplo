<?php
class Company_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }

	public function registred_company()
	{
		$this->db->order_by("id","DESC");
		$this->db->where("user_type",3);
		$query=$this->db->get("registration");		
		$result=$query->result();
		return $result;
	}
	
	public function get_company($id)
	{
		$this->db->where('id',$id);	
		$query=$this->db->get('registration');
		return $r=$query->row();
	}

	public function update($data,$id)
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
			return flase;
		}
	}

	Public function members($company_id)
    {
        $this->db->select('*');
        $this->db->from('registration');
        $this->db->where('company_id',$company_id);
        $memberdata = $this->db->get()->result();
        return $memberdata;
    }

}