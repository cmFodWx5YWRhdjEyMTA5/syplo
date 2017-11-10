<?php
class Discount_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
    }

    public function discountList()
    {
        $this->db->select('*');
        $this->db->from('discount');
        $this->db->order_by('id','DESC');
        return $this->db->get()->result();
    }

    public function add_discount($data)
    {
    	if($this->db->insert('discount',$data))
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }

    public function get_discountDetail($id)
    {
        return $this->db->get_where('discount',array('id'=>$id))->row();
    }

    public function update_discount($id,$data)
    {
        if($this->db->update('discount',$data,array('id'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function delete_discount($id)
    {
        if($this->db->delete('discount',array('id'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function update_status($id,$data)
    {
        if($this->db->update('discount',$data,array('id'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function commissionList()
    {
        $this->db->select('*');
        $this->db->from('commissionsetting');
        return $this->db->get()->result();
    }

    public function get_commissionDetail($id)
    {
        return $this->db->get_where('commissionsetting',array('id'=>$id))->row();
    }
    
    public function updateCommission($id,$data)
    {
        if($this->db->update('commissionsetting',$data,array('id'=>$id)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }


}