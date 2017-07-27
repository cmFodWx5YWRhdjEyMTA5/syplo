<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Service extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
		$this->load->helper("form");
        $this->load->model("admin/Service_modal");
        $this->load->library("session"); 
        $this->load->library("upload"); 
        if($this->session->userdata('email') == '')
        {
           redirect('admin');
        }
	 }
	 
	 public function index()
	 {
		 $data['services']=$this->Service_modal->get_all();
		 $this->load->view('Service_list',$data);
	 }
	 public function update_Service()
	 {    $id=$_GET['id'];
	     $data['service']=$this->Service_modal->get_service_by_id($id);
		 $this->load->view('service_update',$data);
	 }
	 public function delete_Service()
	 {   
		  $id=$_GET['id'];
	      $this->Service_modal->delete_service_by_id($id);
		  $data['success']='1';
		  $data['error']='0';
		  $data['message']='Service has been successfully deleted';
		  $data['services']=$this->Service_modal->get_all();
		  $this->load->view('Service_list',$data);
	     
	 }
	 public function service_id_update()
	 {
		 extract($_POST);
		 $id=$_GET['id'];
		 if(isset($_POST['submit'])){
		   $res=array('category'=>$category,'sub_category'=>$sub_category);
		   $this->Service_modal->update_service_by_id($id,$res);
		   $data['success']='1';
		   $data['error']='0';
		   $data['message']='Service has been successfully updated';
		   $data['service']=$this->Service_modal->get_service_by_id($id);
		   $this->load->view('service_update',$data); 
		 }
		 else{
	     $data['service']=$this->Service_modal->get_service_by_id($id);
		 $this->load->view('service_update',$data); 
		 }
	 }
	 public function add_Service()
	 {
		if(isset($_POST['submit'])){
			extract($_POST);
		   $res=array('category'=>$category,'sub_category'=>$sub_category);
		   $this->Service_modal->add_service_by_id($res);
		   $data['success']='1';
		   $data['error']='0';
		   $data['message']='Service has been added successfully';
		   $this->load->view('service_add',$data); 
		}
		else{  
		$this->load->view('service_add'); 
		}
	 }
	 public function another_service()
	 {
		 $data['another_service']=$this->Service_modal->get_all_another_service();
		 $this->load->view('another_service',$data);
	 }
	  public function delete_another_service()
	 {   
		  $id=$_GET['id'];
	      $this->Service_modal->delete_another_service_by_id($id);
		  $data['success']='1';
		  $data['error']='0';
		  $data['message']='Another service has been successfully deleted';
		  $data['another_service']=$this->Service_modal->get_all_another_service();
		  $this->load->view('another_service',$data);
	 }
}	 