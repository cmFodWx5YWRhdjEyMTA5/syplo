<?php
class Service_modal extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }
	public function get_all()
	{
		$this->db->select('*');
		$this->db->from('services');
		//$this->db->group_by('category');
		$this->db->order_by('category', 'ASC');
		return $q=$this->db->get()->result();
	}
	public function get_service_by_id($id)
	{
		return $this->db->get_where('services',array('id'=>$id))->row();
	}
	public function update_service_by_id($id,$res)
	{
	    return $this->db->update('services',$res,array('id'=>$id));
	}
	public function delete_service_by_id($id)
	{
		return $this->db->delete('services',array('id'=>$id));
	}
	public function add_service_by_id($res)
	{
		return $this->db->insert('services',$res);
	}
	public function get_all_another_service()
	{
		$this->db->select('*');
		$this->db->from('another_service');
		return $q=$this->db->get()->result();
	}
	public function delete_another_service_by_id($id)
	{
		return $this->db->delete('another_service',array('id'=>$id));
	}
}	