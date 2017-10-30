<?php
class Service_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
    }
    public function serviceCategory()
    {
        $this->db->select('category');
        $this->db->group_by('category');
        $res = $this->db->get_where('services')->result();
        return $res;
    }

    public function subCategory()
    {
        $this->db->order_by('category');
        $subcategory=$this->db->get_where('services')->result();
        return $subcategory;
    }
    public function add_subcategory($data)
    {
        if($this->db->insert('another_service',$data))
        {
            $id     = $this->db->insert_id();
            $result = $this->db->get_where('another_service',array('id'=>$id))->row();
            return $result;
        }
        else
        {
            return false;
        }
    }
    public function OtherServices()
    {
        //$this->db->order_by('category');
        $OtherServices=$this->db->get_where('another_service')->result();
        //print_r($OtherServices);die();
        return $OtherServices;
    }

    public function servicesprice($servicesprice,$user_id)
    {
        $count=$this->db->get_where('service_rate',array('user_id'=>$user_id))->num_rows();
        if($count>0)
        {
            $this->db->where('user_id',$user_id);
            if($this->db->delete('service_rate'))
            {
                if($this->db->insert_batch('service_rate',$servicesprice))
                {
                     return true;
                }
                else
                {
                    return false;
                } 
            }  
        }
        else
        {
            if($this->db->insert_batch('service_rate',$servicesprice))
            {
                 return true;
            }
            else
            {
                return false;
            } 
        }
        
    }

    public function AddNewService($servicesprice)
    {   
        if($this->db->insert_batch('service_rate',$servicesprice))
        {
             return true;
        }
        else
        {
            return false;
        }    
    }

    public function anotherprice($another)
    {       
        $re=$this->db->update_batch('another_service',$another,'id');
        if($re)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function arealist()
    {
        $this->db->order_by('area');
        $res = $this->db->get_where('geographicalarea')->result();
        return $res;
    }
    public function setArea($userarea,$user_id)
    {
        $count=$this->db->get_where('workarea',array('user_id'=>$user_id))->num_rows();
        if($count>0)
        {
            $this->db->where('user_id',$user_id);
            if($this->db->delete('workarea'))
            {
                $this->db->insert_batch('workarea',$userarea);
            }  
        }
        else
        {
            $this->db->insert_batch('workarea',$userarea);         
        }        
    }
    public function deleteservice($user_id,$id,$tablename)
    {
       $ss= $this->db->delete($tablename,array('id'=>$id,'user_id'=>$user_id));
       if($this->db->affected_rows()>0)
       {
            return true;
       }
       else
       {
            return false;
       }
    }

    public function UpdateActualService($service,$user_id)
    {
        $this->db->where('user_id',$user_id);
        $re=$this->db->update_batch('service_rate',$service,'id');
        if($re)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

     public function UpdateAnotherService($another,$user_id)
     {
        $this->db->where('user_id',$user_id);
        $re=$this->db->update_batch('another_service',$another,'id');
        if($re)
        {
            return true;
        }
        else
        {
            return false;
        }
     }



}
?>