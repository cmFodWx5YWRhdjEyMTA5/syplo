<?php
class Setting_model extends CI_Model 
{

    public function add_setting($user_id,$user_type)
    {
        $data=array(
                'user_id' => $user_id,
                'isSms'=>1,
                'isEmail'=>1,
                'user_type'=>$user_type
                );
        $this->db->insert('notification_setting',$data);
    }

    public function setting($id,$data)
    {
        $this->db->where('id',$id);
        if($this->db->update('notification_setting',$data))
        {
            return $this->db->get_where('notification_setting',array('id'=>$id))->row();
        }
        else
        {
            return false;
        }
    }


    public function get_setting($data)
    {
        return $this->db->get_where('notification_setting',$data)->row();
    }

    public function get_availability($user_id)
    {
	 $check_data='';
     $date=date('y-m-d');
     $q=$this->db->get_where('freelancher_availability',array('user_id'=>$user_id))->result();
	  if($q != null)
	  {
		foreach($q as $key){
		 if($key->dates >= $date){
		    $check_data[]=array(
			'calander_id'=>$key->id,
			'start_time'=>$key->start_time,
			'end_time'=>$key->end_time,
			'dates'=>$key->dates,
			'status'=>$key->show_position,
			);   	
		  }
		}
		return $check_data;
	  }
    }
    
    public function insert_availability($data,$user_id,$res)
    {
        if($this->db->insert('freelancher_availability',$data))
        {          
            return $this->get_availability($user_id);
        }
    }
	
	public function update_availability($user_id,$data,$calander_id,$rgStatus)
	{
		if($this->db->update('freelancher_availability',$data,array('user_id'=>$user_id,'id'=>$calander_id)))
        {           
    		return $this->get_availability($user_id);
        }
	}
	
    public function check_end()
    {
        return $this->db->get('freelancher_availability')->result();
    }
    
    public function update_time($id,$user_id)
    {  
        $data=array('show_position'=>'1');
        if($this->db->update('registration',$data,array('id'=>$user_id)))
        {
            $this->db->delete('freelancher_availability',array('id'=>$id));
            //echo "success";
        }
    }
	
	public function Review_get_by_id($provider_id)
	{
		return $this->db->get_where('review',array('provider_id'=>$provider_id))->result();
	}

    public function customer_get($customer_id)
	{
		return $this->db->get_where('registration',array('id'=>$customer_id))->row();
	}
}