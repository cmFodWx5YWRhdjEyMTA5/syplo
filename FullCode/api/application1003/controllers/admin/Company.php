<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Company extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
		$this->load->helper("form");
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Admin_model");
        $this->load->model("admin/Company_model");
        $this->load->model("admin/Freelancer_model");
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
	 	$com = $this->Company_model->registred_company();
	 	if(!empty($com))
	 	{
	 		$data->userlist=$com;
			$this->load->view('companyList',$data);	
	 	}
	 	else
	 	{
	        $data->error=0;
			$data->success=1;
			$data->message="No record available";
			$data->userlist=$com;
			$this->load->view('companyList',$data);
	 	}
	 	// print_r($com);die();	 	
	 }

	 public function update()
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
	 		"company_name"=>$company_name,
	 		"registration_no"=>$reg_no,
	 		"mobile"=>$mobile_no,
	 		"address" =>$address,
	 		"user_image"=>$picture	 		
	 		);
	 		$res=$this->Company_model->update($data,$id);
	 		if($res)
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Company_model->get_company($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Company record has been successfully updated";
				$this->load->view('update_company',$data);
	 		}
	 		else
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Company_model->get_company($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Error occur! Please try again";
				$this->load->view('update_company',$data);
	 		}
	 	}
	 	else
	 	{
	 		$id=$_GET['id'];
		 	$data['userlist']=$this->Company_model->get_company($id);
		 	$this->load->view('update_company',$data);
	 	} 	
	}

	public function delete()
	{
		$id= $_GET['id'];
		if($this->Customer_model->delete($id))
		{
			$data= new stdClass();
        	$data->userlist=$this->Company_model->registred_company();
	        $data->error=0;
			$data->success=1;
			$data->message="Company has been removed successfully !";
			$this->load->view('companyList',$data);
		}
		else
		{
			$data= new stdClass();
        	$data->userlist=$this->Company_model->registred_company();
	        $data->error=1;
			$data->success=0;
			$data->message="Error Occur! Company does not remove yet";
			$this->load->view('companyList',$data);
		}
	}

	public function members()
	{
		$data= new stdClass();
		$userlist=$this->Company_model->registred_company();
	 	if(!empty($userlist))
		{			
			$data->userlist =$userlist;
			$this->load->view('CompanyMember',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Member is not available!";
			$data->userlist =$userlist;
			$this->load->view('CompanyMember',$data);
		}
	}


	public function memberList()
	{
		$company_id  = $_GET['id'];
		$member_data = $this->Company_model->members($company_id);
		$data= new stdClass();
		if(!empty($member_data))
		{
			$data->member_data=$member_data;
    		$this->load->view('MemberList',$data); 
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Member is not available!";
			$data->member_data=$member_data;
    		$this->load->view('MemberList',$data); 
		}
	}

	public function Allmember()
	{
		$members = $this->Company_model->Allmembers();
		//echo "<pre>";
		//print_r($member_data);die();
		$data= new stdClass();
		if(!empty($members))
		{
			$data->members_data=$members;
    		$this->load->view('allMember',$data); 
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Member is not available!";
			$data->members_data=$members;
    		$this->load->view('allMember',$data); 
		}
	}

	public function update_member()
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
				$data->message="Member record has been successfully update";
				$this->load->view('update_member',$data);
	 		}
	 		else
	 		{
	 			$data= new stdClass();
	        	$data->userlist=$this->Freelancer_model->get_user($id);
		        $data->error=0;
				$data->success=1;
				$data->message="Error occur!Please try again";
				$this->load->view('update_member',$data);
	 		}
	 	}
	 	else
	 	{
	 		$id=$_GET['id'];
		 	$data['userlist']=$this->Freelancer_model->get_user($id);
		 	$this->load->view('update_member',$data);
	 	}	
	}
	 
	public function delete_member()
	{
		$id= $_GET['id'];
		if($this->Freelancer_model->delete($id))
		{
			$data= new stdClass();
        	$data->userlist=$this->Freelancer_model->Freelancer_user();
	        $data->error=0;
			$data->success=1;
			$data->message="Member Record has been successfully removed!";
			$this->load->view('MemberList',$data);
		}
		else
		{
			$data= new stdClass();
        	$data->userlist=$this->Freelancer_model->Freelancer_user();
	        $data->error=1;
			$data->success=0;
			$data->message="Error Occur! Member is not remove";
			$this->load->view('MemberList',$data);
		}
	}

	public function Other_Details()
	 {
	 	$company_id  = $_GET['id'];
		$member_data = $this->Company_model->members($company_id);
		$data= new stdClass();
		if(!empty($member_data))
		{
			foreach ($member_data as $list) 
			{
				$user_id              = $list->id;
				$status_level         = $this->Freelancer_model->service_level($user_id);	
				$level['user_id']     = $user_id;
				$level['complete']    = $status_level['complete'];
				$level['rank']        = $status_level['rank'];
				$rankData[] = $level;		
			}
			$data->userlist=$member_data;
			$data->rankData = $rankData;
			$this->load->view('MemberOtherDetails',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Member is not available!";
			$data->userlist=$member_data;
			$data->rankData =[];
    		$this->load->view('MemberOtherDetails',$data); 
		}
    	
	 }

	 public function services()
	{
		$user_id = $_GET['id'];
		//print_r($user_id);die();
		$data= new stdClass();
		$Servicelist=$this->Freelancer_model->service_price($user_id);
		if(!empty($Servicelist))
		{			
			$data->Servicelist =$Servicelist;
			$this->load->view('MemberServices',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Service is not available for this Member!";
			$data->Servicelist= $Servicelist;
			$this->load->view('MemberServices',$data);	
		}
		
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
			$this->load->view('MemberAnotherServices',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Another service is not available for this freelancer!";
			$data->AnotherServices= $another;
			$this->load->view('MemberAnotherServices',$data);	
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
			$this->load->view('Memberworkimages',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="No work images available!";
			$data->workimages= $workimages;
			$this->load->view('Memberworkimages',$data);	
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
			$this->load->view('Membercertificateimages',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="No certificate images available!";
			$data->certificates= $certificateimages;
			$data->about = $this->Freelancer_model->certificateabout($user_id);
			$this->load->view('Membercertificateimages',$data);	
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
			$this->load->view('MemberWorkArea',$data);
		}
		else
		{
			$data->error=0;
			$data->success=1;
			$data->message="Work area address is not available";
			$data->address= $CustomerAddress;
		    $this->load->view('MemberWorkArea',$data);
			
		}
	}

	 
}
