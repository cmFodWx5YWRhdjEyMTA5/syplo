<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Discount extends CI_Controller
{
	public function __construct()
    {
    	parent::__construct();
        $this->load->model('admin/Admin_model');
        $this->load->model("admin/Customer_model");
        $this->load->model("admin/Discount_model");
    }

	public function index()
  {  
    $list = $this->Discount_model->discountList();
    //print_r($list);die();
    if(!empty($list))
    {
      //echo "NOT";die();
      $data= new stdClass();
      $data->discountlist=$list;
      $this->load->view('discountList',$data);
    }
    else
    {
      //echo "yes";die();
      $data= new stdClass();  
          $data->error=0;
      $data->success=1;
      $data->message="Discount code is not available";  
      $this->load->view('discountList',$data);
    }
  }

 	public function Add_discount()
  	{
  		
  		if(isset($_POST['submit']))
  		{ 
  			extract($_POST);
  			$data = array(
          "code"            => $code,
          "discount"        => $discount,
          "type"            => $type,
          "discount_type"   => $discount_type,
          "expiredate"      => $expire,
          "status"          => 1
          );
        //print_r($data);die();
  			$res = $this->Discount_model->add_discount($data);
  			if($res)
  			{  	
  				$data= new stdClass();	
		        $data->error=0;
				$data->success=1;
				$data->message="Discount code has been successfully submitted";	
    			$this->load->view('add_discount',$data);
  			}
  			else
 			{
 				$data= new stdClass();				
		        $data->error=0;
				$data->success=1;
				$data->message="Error occur! Discount code is not submitted";	
    			$this->load->view('add_discount',$data);
  				
  			}
  		}
  		else
  		{
  			$this->load->view('add_discount');
  		}
  	}
    public function update_discount()
    {
      $id  = $_GET['id'];
      if(isset($_POST['submit']))
      {
        extract($_POST);
        $update = date('Y-m-d H:i');
        $data = array(
          "code"            =>$code,
          "discount"        =>$discount,
          "discount_type"   =>$discount_type,
          "type"            => $type,
          "expiredate"      => $expire,
          "status"          => 1,
          "update_at"       =>$update
          );
      $response = $this->Discount_model->update_discount($id,$data);
      if($response)
      {
        $data= new stdClass();
            $data->userData = $this->Discount_model->get_discountDetail($id);
            $data->error=0;
        $data->success=1;
        $data->message="Record has been successfully update";
        $this->load->view('update_discount',$data);
      }
      else
      {
        $data= new stdClass();
            $data->userData = $this->Discount_model->get_discountDetail($id);
            $data->error=1;
        $data->success=0;
        $data->message="Error occur!Please try again";
        $this->load->view('update_discount',$data);
      }
    }
      else
      {   
        $res = $this->Discount_model->get_discountDetail($id);
        // print_r($res);die();
        $data= new stdClass();  
        $data->userData=$res;
        $this->load->view('update_discount',$data);
        //print_r($id);
      }
    }

  public function delete()
  {
    $id= $_GET['id'];
    if($this->Discount_model->delete_discount($id))
    {
      $data = new stdClass();
      $list = $this->Discount_model->discountList($id);
      if(!empty($list))
      {        
       $data->discountlist = $list;
      }
      $data->error=0;
      $data->success=1;
      $data->message="Discount has been removed successfully!";
      $this->load->view('discountList',$data);
    }
    else
    {
      $data= new stdClass();
      $data->discountlist = $this->Discount_model->discountList($id);
      $data->error=1;
      $data->success=0;
      $data->message="Error Occur! Discount is not remove";
      $this->load->view('discountList',$data);
    }
  }
  
  public function update_status()
    {
        $id = $_POST['id'];
        $status = $_POST['status'];        
        $data =array("status"=>$status);
        if($this->Discount_model->update_status($id,$data))
        {
          if($status==1)
            { $stat='Expire'; }
            else
            { $stat ='Active';}
          echo $stat;
        } 
        else
        {
          if($status==1)
            { $stat='Active'; }
            else
            { $stat ='Expire';}
          echo $stat;
        }
    }
    public function commissionSetting()
    {
        $list = $this->Discount_model->commissionList();
        if(!empty($list))
        {
          $data= new stdClass();
          $data->commissionlist=$list;
          $this->load->view('commissionSetting',$data);
        }
        else
        {
          //echo "yes";die();
          $data= new stdClass();  
          $data->error=0;
          $data->success=1;
          $data->message="Commission is not available";  
          $this->load->view('commissionSetting',$data);
        }
    }

    public function updateCommission()
    {
      $id  = $_GET['id'];
      if(isset($_POST['submit']))
      {
        extract($_POST);
        $update = date('Y-m-d H:i');
        $data = array(
          "commission"      => $commission,
          "update_at"       => $update
          );
      $response = $this->Discount_model->updateCommission($id,$data);
      if($response)
      {
        $data= new stdClass();
        $data->userData = $this->Discount_model->get_commissionDetail($id);
        $data->error=0;
        $data->success=1;
        $data->message="Commission has been successfully update";
        $this->load->view('updateCommission',$data);
      }
      else
      {
        $data= new stdClass();
        $data->userData = $this->Discount_model->get_commissionDetail($id);
        $data->error=1;
        $data->success=0;
        $data->message="Error occur!Please try again";
        $this->load->view('updateCommission',$data);
      }
    }
    else
    {   
      $res = $this->Discount_model->get_commissionDetail($id);
      $data= new stdClass();  
      $data->userData=$res;
      $this->load->view('updateCommission',$data);
    }
  }
}	