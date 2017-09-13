<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Order extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library("form_validation");
		$this->load->helper("form");
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Admin_model");
		 $this->load->model("admin/Order_model");
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
		$data['userlist']=$this->Order_model->Get_all_order();
		//echo json_encode($data);die();
		$this->load->view('order',$data);
	}
    public function service_coutomer()
	{
        $order_id=$_GET['order_id'];
        $data['service']=$this->Order_model->order_service($order_id) ;
		$this->load->view('order_service',$data);
		//print_r($data);
	}
	public function another_service_coutomer()
    {     
	    $order_id=$_GET['order_id'];
		$data['another_service']=$this->Order_model->another_orderService($order_id);  	
        $this->load->view('order_service',$data);		
	}

	public function trans_detail()
    {
        $order_id=$_GET['order_id'];
		$data['payment']  = $this->Order_model->trans_detail($order_id);
		$data['discount'] = $this->Order_model->discount_details();  	
        $this->load->view('order_payment',$data);		
    }
    	
	public function service_coutomer_update()
    { 
	       $order_service_id=$_GET['order_service_id'];
		   $data['service']=$this->Order_model->order_service_update($order_service_id);
		   $res=$data['service'];
		   $resss=$this->Order_model->check_status($res);
		   if($resss->order_status == '1')
		   {
			   //print_r($resss); die;
			   $order_id=$resss->id;
			   $data['script']="<script>alert('This service already completed');</script>";
               $data['service']=$this->Order_model->order_service($order_id) ;
			   $this->load->view('order_service',$data);
			  
		   }
		   else
		   {
			   $this->load->view('update_service',$data);
		   }
	}
	public function service_update()
    {   extract($_POST);
	     $order_service_id=$_GET['order_service_id'];
		 
	    if(isset($submit)){
	    $data=array('price'=>$service_price,'price_type'=>$service_price_type);
		$this->Order_model->services_update($id,$data);
		$data['message']='Service Update successfull';
		$data['success']='1';
		$data['error']='0';
	    $data['service']=$this->Order_model->order_service_update($order_service_id) ;
		$this->load->view('update_service',$data);
		}
		else{
	    $data['service']=$this->Order_model->order_service_update($order_service_id) ;
		$this->load->view('update_service',$data);
		}
	}
	
	public function service_coutomer_delete()
	{
		  $order_service_id=$_GET['order_service_id'];
		  $this->Order_model->order_service_delete($order_service_id) ;
		  $data['message']='Record Delete Successfull';
		  $data['success']='1';
		  $data['error']='0';
		  $data['userlist']=$this->Order_model->Get_all_order();
		  $this->load->view('order',$data);
		  
	}
	
	public function update_order()
	{
		$order_id=$_GET['order_id'];
		$data['order_details']=$this->Order_model->order_update($order_id);
		$key=$data['order_details'];
		if($key->order_status == '1'){
			$data['script']="<script>alert('This service already completed');</script>";
			$data['userlist']=$this->Order_model->Get_all_order();
		    $this->load->view('order',$data);
		}
		else{
		$data['provider_name']=$this->Order_model->provider_name_get($key);
		$data['All_provider']=$this->Order_model->provider();
		$this->load->view('update_order',$data);
		}  
	}
}