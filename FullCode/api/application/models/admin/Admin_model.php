<?php
class Admin_model extends CI_Model
{
	function __construct() 
	{
        parent::__construct();
        $this->load->database();
        $this->load->library('email');
        $this->load->model('Communication_model');
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

	public function mailconfig()
    {
        $config = array();
        $config['useragent']           = "CodeIgniter";
        $config['mailpath']            = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail 25"
        $config['protocol']            = "smtp";
        $config['smtp_host']           = "localhost";
        $config['smtp_port']           = "25";
        $config['mailtype']            = 'mail';
        $config['charset']             = 'utf-8';
        $config['newline']             = "\r\n";
        $config['wordwrap']            = TRUE;
        return $config;
    }

	public function forget_password($email)
    {
        $check=$this->db->get_where('admin',array('email'=>$email));
        $count=$check->num_rows();      
        if($count>0)
        {
        	//print_r($config);die();
            $result= $check->row();
            $data['email'] = $result->email;
            //print_r($data);die();
        	$config = $this->mailconfig();
            $this->email->initialize($config);
            $subject = "Reset Password";
            $message = $this->load->view('forget_passwordTemp',$data,true);
            // $mesg = $this->load->view('template/email',$data,true);
            // or
            //$mesg = $this->load->view('email','',true);
            $config=array(
            'charset'=>'utf-8',
            'wordwrap'=> TRUE,
            'mailtype' => 'html'
            );            
            $this->email->set_newline("\r\n");
            $this->email->initialize($config);
            $this->email->from('info@syplo.se','Syplo'); 
            $this->email->to($result->email);
            $this->email->subject('Forget Passwoord');
            $this->email->message($message);
            if($this->email->send())
            {
                return true;
            } 
            else
            {
                return false;  
            }
        }
        else
        {
            $response['error']=1;
            $response['success']=0;
            $response['message']="This email Id is not found! Please enter correct email id";
            $this->load->vieW('forget_password',$response);
            exit;
        }
    }

    public function recover_password($enpass,$email)
	{
		$this->db->where('email',$email);
		$rr=$this->db->update('admin',array('password'=>$enpass));
		if($rr)
		{
			return true;
		}	
		else
		{
			return false;
		}
	}

}