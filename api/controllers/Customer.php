<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Customer extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
		$this->load->helper("form");
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Admin_model");
        // $this->load->model("PrescriptionCheck");
        $this->load->library("session"); 
        $this->load->library("upload"); 
        if($this->session->userdata('email') == '')
        {
           redirect('admin');
        }
	 }

	 public function index()
	 {
	 	$data= new stdClass();
	 	$data->userlist=$this->Customer_model->registred_customer();
		$this->load->view('index',$data);
	 }

	public function update_customer()
	{
	 	if(isset($_POST['update']))
	 	{
	 		extract($_POST);
	 		$picture = $img;
		 	$id=$this->input->post('id');
		 	if(isset($_FILES['image']['name']) && $_FILES['image']['name']!='')
			{
	    		$s=$_FILES["image"]["tmp_name"];
	    		$imag_name=$_FILES["image"]["name"];
		        $picture = preg_replace('/\s*/m', '',$imag_name);
		        $d="upload/".$picture;
		        move_uploaded_file($s,$d);
		    }
		 	$data=array(
	 		"full_name"=>$full_name,
	 		"dob"=>$dob,
	 		"gender"=>$gender,
	 		"mobile"=>$mobile_no,
	 		"address" =>$address,
	 		"about"=>$about,
	 		"user_image"=>$picture	 		
	 		);
	 		$res=$this->Customer_model->update_customer($data,$id);
	 		if($res)
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Customer_model->get_user($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Customer Record has been successfully update";
				$this->load->view('update_customer',$data);
	 		}
	 		else
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Customer_model->get_user($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Error occur!Please try again";
				$this->load->view('update_customer',$data);
	 		}
	 	}
	 	else
	 	{
	 		$id=$_GET['id'];
		 	//echo $id;die();
		 	$data['userlist']=$this->Customer_model->get_user($id);
		 	$this->load->view('update_customer',$data);
	 	}
	 	
	 }
	 
	 
}
