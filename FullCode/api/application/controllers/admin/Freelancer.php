<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Freelancer extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
		$this->load->helper("form");
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Admin_model");
		$this->load->model("admin/Freelancer_model");
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
	 	$userlist=$this->Freelancer_model->Freelancer_user();
	 	if(!empty($userlist))
	 	{
	 		$data->userlist = $userlist;
			//echo json_encode($data); die;
			$this->load->view('FreelancerList',$data);
	 	}
	 	else
	 	{
	 		$data->error=1;
			$data->message="No freelacer record found";
	 		$data->userlist = $userlist;
			//echo json_encode($data); die;
			$this->load->view('FreelancerList',$data);
	 	}
	 	
	 }

	 public function update_Freelancer()
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
	 		"first_name"=>$first_name,
	 		"last_name"=>$last_name,
	 		"dob"=>$dob,
	 		"gender"=>$gender,
	 		"mobile"=>$mobile_no,
	 		"address" =>$address,
	 		"about"=>$about,
			//"start_time"=>$start_time,
	 		//"end_time"=>$end_time,
	 		"current_workplace" =>$current_workplace,
	 		"previous_workplace"=>$previous_workplace,
			//"availability"=>$availability,
	 		"acceptance"=>$acceptance,
	 		"show_position" =>$show_position,
	 		"experience"=>$experience,
	 		"user_image"=>$picture	 		
	 		);
	 		$res=$this->Freelancer_model->update_freelancer($data,$id);
	 		if($res)
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Freelancer_model->get_user($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Freelancher record has been successfully update";
				$this->load->view('update_freelancer',$data);
	 		}
	 		else
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Freelancer_model->get_user($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Error occur!Please try again";
				$this->load->view('update_freelancer',$data);
	 		}
	 	}
	 	else
	 	{
	 		$id=$_GET['id'];
		 	$data['userlist']=$this->Freelancer_model->get_user($id);
		 	$this->load->view('update_freelancer',$data);
	 	}
	 	
	 }
	 
	public function delete()
	{
		$id= $_GET['id'];
		if($this->Freelancer_model->delete($id))
		{
			$data= new stdClass();
        	$data->userlist=$this->Freelancer_model->Freelancer_user();
	        $data->error=0;
			$data->success=1;
			$data->message="Freelancer Record has been successfully removed!";
			$this->load->view('FreelancerList',$data);
		}
		else
		{
			$data= new stdClass();
        	$data->userlist=$this->Freelancer_model->Freelancer_user();
	        $data->error=1;
			$data->success=0;
			$data->message="Error Occur! Freelancer is not remove";
			$this->load->view('FreelancerList',$data);
		}
	}
	  
	public function approved()
	{
		 $id=$_GET['id'];
		 $this->Freelancer_model->Freelancer_get($id);
	} 

	public function certificate_approved()
	{
		 $id=$_GET['id'];
		 $this->Freelancer_model->certificate_approved($id);
	} 

	public function Other_Details()
	{
		$rankData ='';
		$data= new stdClass();
		$userlist=$this->Freelancer_model->Freelancer_user();
		if(!empty($userlist))
		{
			foreach ($userlist as $list) 
			{
				$user_id      = $list->id;
				$status_level = $this->Freelancer_model->service_level($user_id);	
				$level['user_id'] = $user_id;
				$level['complete']    = $status_level['complete'];
				$level['rank']        = $status_level['rank'];
				$rankData[] = $level;		
			}			
			/*echo "<pre>";
			print_r($rankData);die();*/
			$data->userlist = $userlist;
			$data->rankData = $rankData;
			$this->load->view('FreelancerOtherDetails',$data);
		}
		else
		{
			$data->error=1;
			$data->message="No freelancer record found!";
			$data->userlist = $userlist;
			$data->rankData = $rankData;
			$this->load->view('FreelancerOtherDetails',$data);
		}

		
	}

	public function services()
	{
		$user_id = $_GET['id'];
		//print_r($user_id);die();
		$data= new stdClass();
		$data->Servicelist=$this->Freelancer_model->service_price($user_id);
		$this->load->view('FreelancerServices',$data);
	}

	public function anotherServices()
	{
		$user_id = $_GET['id'];
		//print_r($user_id);die();
		$data= new stdClass();
		$another = $this->Freelancer_model->anoservice_price($user_id);
		if(!empty($another))
		{			
			$data->AnotherServices= $another;
			$this->load->view('FreelancerAnotherServices',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Another service is not available for this freelancer!";
			$data->AnotherServices= $another;
			$this->load->view('FreelancerAnotherServices',$data);	
		}
	}

	public function workimages()
	{
		$user_id = $_GET['id'];
		$data= new stdClass();
		$workimages = $this->Freelancer_model->ProviderWorkImage($user_id);
		if(!empty($workimages))
		{	
			$data->workimages= $workimages;
			$this->load->view('workimages',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="No work images available!";
			$data->workimages= $workimages;
			$this->load->view('workimages',$data);	
		}
	}

	public function certificateimages()
	{
		$user_id = $_GET['id'];
		$data= new stdClass();
		$certificateimages = $this->Freelancer_model->ProviderCertificate($user_id);
		if(!empty($certificateimages))
		{
			$data->certificates= $certificateimages;
			$data->about = $this->Freelancer_model->certificateabout($user_id);
			//echo json_encode($workimages);die();
			$this->load->view('certificateimages',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="No certificate images available!";
			$data->certificates= $certificateimages;
			$data->about = $this->Freelancer_model->certificateabout($user_id);
			$this->load->view('certificateimages',$data);	
		}
	}

	public function workArea()
	{
	 	$user_id = $_GET['id'];
		$data= new stdClass();
	    $CustomerAddress = $this->Freelancer_model->allCustomerAddress($user_id);
	    if(!empty($CustomerAddress))
		{			
			$data->address= $CustomerAddress;
			$this->load->view('FreelancerWorkArea',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Work area address is not available";
			$data->address= $CustomerAddress;
		    $this->load->view('FreelancerWorkArea',$data);
		}
	}
}
