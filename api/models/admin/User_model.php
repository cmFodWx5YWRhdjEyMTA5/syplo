<?php
class User_model extends CI_Model {
	function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user($id)
	{
		$this->db->where('id',$id);	
		$query=$this->db->get('registration');
		return $r=$query->row();
	}

	public function add_user($data)
	{		
		$this->db->insert('registration',$data);
		//return true;
		return $this->db->insert_id();
		
	}
	public function update_qbId($id,$qb_id)
	{
		$this->db->where('id',$id);
		return $this->db->update('registration',array('qb_id'=>$qb_id));
	}
	public function update_user($data,$id)
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
	
	public function check_user($email)
	{
		$query=$this->db->get_where('registration',array('email'=>$email));
		return $query->num_rows();		
	}

	public function update_image($image,$id)
	{
		 $data=array(
		 	"image"=>$image,
		 	"id"	=>$id	
		 	);		
		$this->db->where('id',$id);
		$res=$this->db->update('registration',$data);
		if($res)
		{
			return true;
		}
		else
		{
			return false;
		}

	}

	public function delete_user($id)
	{
		$s=$this->db->delete('registration', array('id' => $id));
		if($s)
		{
			$this->db->delete('family_member', array('user_id' => $id));
			$this->db->delete('prescription', array('user_id' => $id));
			$this->db->delete('patatent_tablets', array('user_id' => $id));
			return true;  
		}
		else
		{
			return false;
		}
	}

	public function deleteFromqb($qb_id)
	{

	}

}