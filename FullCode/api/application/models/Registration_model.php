<?php
class Registration_model extends CI_Model 
{
    function __construct()
    {
        parent::__construct();
       $this->load->database();
    }

    public function isuserexits($email,$user_type)
    {
        $query=$this->db->get_where('registration',array('email'=>$email,'user_type'=>$user_type,'status'=>1));
        return $query->num_rows();
    }

    public function registration($data)
    {
        if($this->db->insert('registration',$data))
        { 
            $id = $this->db->insert_id(); 
            return $this->db->get_where('registration', array('id'=>$id))->row();
        }
        else
        {
            return false;
        }
    }
    
    public function basicregistration($data,$email,$user_type)
    {
        $check= $this->db->get_where('registration',array('email'=>$email,'user_type'=>$user_type,'status'=>0));
        $exist = $check->num_rows();
        //echo $exist;die();
        if($exist==1)
        {
            $this->db->where(array('email'=>$email,'user_type'=>$user_type));
            if($this->db->update('registration',$data))
            {
                $res=$this->db->get_where('registration',array('email'=>$email,'user_type'=>$user_type))->row();
                $user_id =$res->id;
                //echo json_encode($res);die();
                return $user_id;
            }
        }
        else if($exist==0)
        {
            if($this->db->insert('registration',$data))
            { 
                return $this->db->insert_id(); 
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        } 
    }

    public function setdays($d,$user_id)
    {

        $count=$this->db->get_where('userdays',array('user_id'=>$user_id))->num_rows();
        if($count>0)
        {
            $this->db->where('user_id',$user_id);
            if($this->db->delete('userdays'))
            {
                $this->db->insert_batch('userdays',$d);
            }  
        }
        else
        {
            $this->db->insert_batch('userdays',$d);         
        }        
    }

    public function finalregistration($data,$user_id)
    {
        $this->db->where('id',$user_id);
        if($this->db->update('registration',$data))
        {
            $basicDetails = $this->db->get_where('registration', array('id'=>$user_id))->row();
            return $basicDetails;
            
        }
        else
        {
            return false;
        } 
    }

    public function userArea($user_id)
    {
        $this->db->select('geographicalarea.id,area');
        $this->db->from('workarea');        
        $this->db->join('geographicalarea', 'workarea.area_id = geographicalarea.id');
        $this->db->where('user_id='.$user_id);
        return $this->db->get()->result(); 
    }

    public function userServices($user_id)
    {
        //User services and their prices     
        $this->db->select('services.id,category,sub_category,service_rate.id,price,pricetype');
        $this->db->from('service_rate');        
        $this->db->join('services', 'service_rate.service_id = services.id');
        $this->db->where('user_id='.$id);
        return $this->db->get()->result(); 
    }

    public function certificate_detail($data)
    {
        $result=$this->db->insert_batch('certificate', $data);
        if($result)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function paymentdetail($values,$user_id)
    {
        if($this->db->insert_batch('accountdetails',$values))
        {           
            $r2 = $this->db->get_where('accountdetails', array('user_id'=>$user_id))->result();         
            return $r2;
        }
        else
        {
            return false;
        }
    }

    public function login($email,$password,$device_token,$device_type)
    {
        $r = $this->db->get_where('registration', array('email'=>$email, 'password'=>$password));
        $count = $r->num_rows();
        if($count>1)
        {
            $this->db->select('id,email,user_type');
            $this->db->from('registration');
            $this->db->where('email',$email);
            $cc=$this->db->get()->result();
            $response["error"]              = 0;    
            $response["success"]            = 1;
            $response["message"]            = "Success, Which account does you want to login?";
            $response["data"]               = $cc;
            echo json_encode($response);die();
        }
        else if($count==1)
        {
            $r1 = $r->row();
            $id = $r1->id;
            $this->db->where('id',$id);
            $update =$this->db->update('registration',array('device_token'=>$device_token,'device_type'=>$device_type));  
            //$id = $r1->id;
            $r2 = $this->db->get_where('accountdetails', array('user_id'=>$id))->result();
            $data= array(
                    "u" =>$r1,
                    "a" =>$r2
                    );  

            return $data;                    
        }
        else
        {
            return false;
        }        
    }


    public function getUserDetail($id,$device_token,$device_type)
    {
        $r1 = $this->db->get_where('registration', array('id'=>$id))->row();
        if($r1)
        {
            //print_r($r1);die();
            $id = $r1->id;
            $this->db->where('id',$id);
            $update =$this->db->update('registration',array('device_token'=>$device_token,'device_type'=>$device_type));  
            $r2 = $this->db->get_where('accountdetails', array('user_id'=>$id))->result();
            $data= array(
                    "u" =>$r1,
                    "a" =>$r2
                    );  
            return $data;
        }
        else
        {
            return false;
        }
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
        $check=$this->db->get_where('registration',array('email'=>$email));
        $count=$check->num_rows(); 
        if($count>1)
        {
            $this->db->select('id,email,user_type');
            $this->db->from('registration');
            $this->db->where('email',$email);
            $cc=$this->db->get()->result();
            $response["error"]              = 0;    
            $response["success"]            = 2;
            $response["message"]            = "Success, Which account password do you want?";
            $response["data"]               = $cc;
            echo json_encode($response);die();
        }     
        else if($count==1)
        {
           $result= $check->row();
           //print_r($result->password);die();

            $config= $this->mailconfig();
            $this->load->library('email');
            $this->email->initialize($config);
            $message = 'Hi,'."\r\n\r\n";
            $message .= 'I have received request for forget password. The passowrd for syplo account is '  .$result->password.'.'."\r\n\r\n";
            $message .= "Regards,"."\r\n"; 
            $message .= "Syplo Customer Support,"."\r\n"; 
            $message .= "info@syplo.se"."\r\n";
            $this->email->set_newline("\r\n");
            $this->email->from('info@syplo.se'); 
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
            $response['message']="This email Id not found! Please enter correct email id";
            echo json_encode($response);
            exit;
        }
    }


    public function ForgetpasswordForMultipleEmail($id)
    {
        $check=$this->db->get_where('registration',array('id'=>$id));
        $count=$check->num_rows(); 
        if($count>0)
        {
           $result= $check->row();
           //print_r($result->password);die();

            $config= $this->mailconfig();
            $this->load->library('email');
            $this->email->initialize($config);
            $message = 'Hi,'."\r\n\r\n";
            $message .= 'I have received request for forget password. The passowrd for syplo account is: '  .$result->password.'.'."\r\n\r\n";
            $message .= "Regards,"."\r\n"; 
            $message .= "Syplo Customer Support,"."\r\n"; 
            $message .= "info@syplo.se"."\r\n";
            $this->email->set_newline("\r\n");
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
            $response['message']="This User Id is not found! Please enter correct details";
            echo json_encode($response);
            exit;
        }
    }

    public function change_password($id,$old_password,$password)
    {

        $r=$this->db->get_where('registration',array('password'=>$old_password,'id'=>$id))->num_rows();
        if($r>0)
        {
            $this->db->where('id',$id);
            if($this->db->update('registration',array('password'=>$password)))
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
            $response["error"]              = 3;    
            $response["success"]            = 0;
            $response["message"]            = "Old password does not found";
            echo json_encode($response);
            exit;
        }       
    } 
     public function profiledata($user_id)
    {
        return $this->db->get_where('registration', array('id'=>$user_id))->row();
    }

    public function profile_update($id,$data)
    {
        $this->db->where('id',$id);
        if($this->db->update('registration',$data))
        {
            $res=$this->profiledata($id);
            $response["error"]              = 0;    
            $response["success"]            = 1;
            $response["message"]            = "Profile has been updated successfully";
            $image = base_url().'upload/'.$res->user_image;
            $response["data"]["user_id"]            = $res->id;
            $response["data"]["user_image"]         = $image;
            $response["data"]["user_type"]          = $res->user_type;      
            $response["data"]["referral_code"]      = $res->referral_code;      
            $response["data"]["device_token"]       = $res->device_token; 
            $response["data"]["company_name"]       = $res->company_name;
            $response["data"]["reg_no"]             = $res->registration_no;
            $response["data"]["first_name"]         = $res->first_name;
            $response["data"]["last_name"]          = $res->last_name;
            $response["data"]["dob"]                = $res->dob;
            $response["data"]["address"]            = $res->address;
            $response["data"]["lat"]                = $res->lat;
            $response["data"]["long"]               = $res->long;           
            $response["data"]["mobile"]             = $res->mobile;
            $response["data"]["email"]              = $res->email;
            $response["data"]["password"]           = $res->password;
            $response["data"]["gender"]             = $res->gender;
            $response["data"]["about"]              = $res->about;                        
            $response["data"]["address_acceptance"] = $res->address_acceptance; 
            $response["data"]["availability"]       = $res->availability;   
            $response["data"]["canceling_policy"]   = $res->canceling_policy; 
            $response["data"]["acceptance"]         = $res->acceptance;         
            $response["data"]["seen_status"]        = $res->seen_status;            // 0=not, 1=yes
            $response["data"]["approv_status"]      = $res->approve_status;     
            echo json_encode($response);                        
        }
        else
        {
            $response["error"]      = 2;
            $response["success"]    = 0;
            $response["message"]    = "Error Occur! Profile is not update";
            echo json_encode($response);
        }
    }

    public function logout($id)
    {
        $this->db->where('id',$id);
        if($this->db->update('registration',array('device_token'=>'')))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

     public function CheckReferralCode($customerReferral_code)
    {
        if($details = $this->db->get_where('registration',array('referral_code'=>$customerReferral_code))->row())
        {
            $distDetail = $this->db->get_where('discount',array('discount_type'=>1))->row();
            $discountD= array(
                "referaler_user_id" => $details->id,
                "discount"          => $distDetail->discount,
                "type"              => $distDetail->type,
                "discount_type"     => $distDetail->discount_type
                );
            return $discountD;
        }
        else
        {
            return false;
        }
    }

    public function add_refralDiscount($ReferalData)
    {
        if($this->db->insert('user_discount',$ReferalData))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function discountDetails($user_id)
    {
        return $this->db->get_where('user_discount',array('customer_id'=>$user_id,'status'=>0,'discount_type'=>1))->row();
    }

    /*--------------------------For testing purpose --------------------------------*/
    public function certificateImage($data,$user_id)
    {
        if($this->db->insert('certificate', $data))
        {
            $this->db->insert_id();
            $response= $this->db->get_where('certificate', array('user_id'=>$user_id))->result();
            return $response;
        }
        else
        {
            return false;
        }
    }
    /*--------------------------For testing purpose End ------------------------------*/
}