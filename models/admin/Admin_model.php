<?php
class Admin_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }

    public function login($data)
	{		
		$query =$this->db->get_where('admin', array('email' => $data['email'],'password'=>$data['password']));
		$count=$query->num_rows();
		if($count>0)
		{
			return $query->row();
		}
		else
		{
			return false;
		}
	}

	public function change_password($old_password,$password,$id)
	{
		$this->db->where('id',$id);
		$this->db->where('password',$old_password);
		$rr=$this->db->update('admin',array('password'=>$password));
		$result= $this->db->affected_rows($rr); 
		// echo $result;die();
		if($result>0)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}

	public function admin_profile($id)
	{
		return $this->db->get_where('admin',array('id'=>$id))->row();
	}

	public function update_profile($id,$data)
	{
		$this->db->where('id',$id);
		return $this->db->update('admin',$data);
	}

}