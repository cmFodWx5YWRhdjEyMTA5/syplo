<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
{
	public function __construct()
    {
    	parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Company_model");
    }

	public function index()
 	{  
		$data= new stdClass();
		if ($this->input->post('login') && $this->input->post())
		{
			extract($_POST);       
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$data=array('email' => $email, 'password' =>$password);
			$res=$this->Admin_model->login($data);
			if($res)
			{
			   if($res->status == 'admin')
			   { 
			   	$data= new stdClass();
			    $newdata = array(
			                'email'  => $res->email,
			                'name'   => $res->full_name,
			                'status' => $res->status,
			                'id'     => $res->id,
			                'img'    => $res->image,
			                'logged_in' => TRUE
			              );
			   $this->session->set_userdata($newdata);
			   $data->userlist=$this->Company_model->registred_company();
			   $this->load->view('companyList',$data);
			   }   
        	}
        	else
        	{
        		$data= new stdClass();
        		$data->error=1;
				$data->success=0;
				$data->message="Email id and password does not match";
				$this->load->view('login',$data); 
        	}
    	}
	    else
	    { 
			if($this->session->userdata('email') && $this->session->userdata('status')=='admin')
			{
			   $data->userlist=$this->Company_model->registred_company();
			   $this->load->view('companyList',$data);               
			}
			else
			{
			    $this->load->view('login');
			}   
    	}
  	}

  	public function change_password()
	{
	    $data=new stdClass();
	    if(isset($_POST['submit']))
	    { 
			$id=$this->input->post('id');
			//echo $id;die();
			$status=$this->input->post('status');
			$old_password=$this->input->post('old_password');
			$password=$this->input->post('password');
      		$confirm_password=$this->input->post('confirm_password');
			if($password !=$confirm_password)
            {
                $data->error=1;
                $data->success=0;
                $data->id=$id;
                $data->status=$this->session->userdata('status');
                $data->message="Confirm password does not match";
                $this->load->view('change_password',$data);  
            }
            else
            {
            	$rr=$this->Admin_model->change_password($old_password,$password,$id);    
                if($rr)
                {
                    $data->error=0;
                    $data->success=1;
                    $data->id=$id;
                    $data->status=$this->session->userdata('status');
                    $data->message="Password has been updated successful !";
                    $this->load->view('change_password',$data);
                }
                else
                {
                    $data->error=1;
                    $data->success=0;
                    $data->id=$id;
                    $data->status=$this->session->userdata('status');
                    $data->message="Old Password not found! Please Enter correct old password";
                    $this->load->view('change_password',$data);
                }
            }
	    }
	    else
	    {
	    	$data=new stdClass();
            $data->id =$this->session->userdata('id');
            $data->status=$this->session->userdata('status');
        	$this->load->view('change_password',$data);
	    }
	}

	public function profile()
  	{
    $data=new stdClass();
    $id =$this->session->userdata('id');
    if($this->input->post('submit'))
    {
      extract($_POST);
      $picture=$_POST['admin_img'];
      if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
        {
            $s=$_FILES["image"]["tmp_name"];
    		$imag_name=$_FILES["image"]["name"];
	        $picture = preg_replace('/\s*/m', '',$imag_name);
	        $d="upload/".$picture;
	        move_uploaded_file($s,$d);
        }
        $data=array(
                      "full_name"=>$name,
                      "mobile"=>$mobile,
                      "image"=>$picture     
                      );
          $response=$this->Admin_model->update_profile($id,$data);
          if($response!=false)
          {            
            $data=new stdClass();
            $res= $this->Admin_model->admin_profile($id);
            $data->admin=$res;
            $newdata =  array(
			                'email'  => $res->email,
			                'name'   => $res->full_name,
			                'status' => $res->status,
			                'id'     => $res->id,
			                'img'    => $res->image,
			                'logged_in' => TRUE
			              );
            $this->session->set_userdata($newdata);
            $data->success=1;
            $data->message="Profile has been Updated Sucessfully";
            $this->load->view('admin_profile',$data);
          }
          else
          {
            $data=new stdClass();
            $res= $this->Admin_model->admin_profile($id);
            $data->admin=$res;
            $data->error=1;
            $data->message="Error Occur! Profile is not Update";
            $this->load->view('admin_profile',$data);
          }    
    }
    else
    {
      $data=new stdClass();
      $res= $this->Admin_model->admin_profile($id);
      $data->admin=$res;
      $this->load->view('admin_profile',$data);
    }
  }

  public function Add_discount()
  {
    $this->load->view('add_discount');
  }


  	public function logout()
	{
		$data=new stdClass();
		$this->session->sess_destroy();
		$this->load->view('login');
	}
	
}
	
