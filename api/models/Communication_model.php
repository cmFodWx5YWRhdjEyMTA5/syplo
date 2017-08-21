<?php
//book//
class Communication_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
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

    //Sent order details to provider when instant booking
    public function SentDetailByEmail($data,$subject,$message1)  //For Provider
    {
        //echo $message1;
        $customer_id      = $data['customer_id'];
        $provider_id      = $data['provider_id'];
        $order_address    = $data['address'];
        $order_date       = $data['date'];
        $order_time       = $data['time'];
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
            $customerDe= $check->row();
            $providerDe = $provider_details->row();
            $provider_email = $providerDe->email;
            $customer_name = $customerDe->first_name.' '.$customerDe->last_name;
            //print_r($customer_name);die();
            //print_r($result->mobile);die();
            // print_r($result->password);die();
            $config= $this->mailconfig();
            $this->load->library('email');
            $this->email->initialize($config);
            $message   = "Hej,"."\n";
            $message  .= $message1."\r\n\r\n"; 
            $message  .= 'Customer Name : '.$customer_name."\n";
            $message  .= 'Contact Number : '.$customerDe->mobile."\n";
            $message  .= 'Customer Email : '.$customerDe->email."\n";
            $message  .= 'Order Date : '.$order_date."\n";
            $message  .= 'Order Time : '.$order_time."\n";
            $message  .= 'Order Address : '. $order_address."\r\n\r\n";
            $message  .= 'Thanks,'."\n";
            $message  .= 'Syplo Team!,'."\n";
            //print_r($message); 
            $this->email->set_newline("\r\n");
            $this->email->from('info@syplo.se','Syplo'); 
            $this->email->to($provider_email);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
        }
    }

    public function SentProviderDetailByEmail($data,$subject)  //For customer 
    {
        //echo "<pre>";
        //print_r($data);
        $customer_id      = $data['customer_id'];
        $provider_id      = $data['provider_id'];
        $order_address    = $data['address'];
        $order_date       = $data['date'];
        $order_time       = $data['time'];
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
           $customerDe= $check->row();
           $providerDe = $provider_details->row();
           $customer_email = $customerDe->email;
           $provider_name = $providerDe->first_name.' '.$providerDe->last_name;
           //print_r($customer_name);die();
           //print_r($result->mobile);die();
           // print_r($result->password);die();
           $config= $this->mailconfig();
           $this->load->library('email');
           $this->email->initialize($config);
           $message   =  "Hej,"."\n";
           $message  .= 'Your order has been approved. Our provider will be Contact you soon.'."\n";
           $message  .= 'Provider Name : '.$provider_name."\n";
           $message  .= 'Contact Number : '.$providerDe->mobile."\n";
           $message  .= 'Provider Email : '.$providerDe->email."\n";
           $message  .= 'Order Date :   '.$order_date."\n";
           $message  .= 'Order Time :   '.$order_time."\n";
           $message  .= 'Order Address  : '. $order_address."\r\n\r\n";
           $message  .= 'Thanks,'."\n";
           $message  .= 'Syplo Team!,'."\n";
           //print_r($message); 
           $this->email->set_newline("\r\n");
           $this->email->from('info@syplo.se','Syplo'); 
           $this->email->to($customer_email);
           $this->email->subject($subject);
           $this->email->message($message);
           $this->email->send();
        }
    }

    public function SentReviewByEmail($data)  //Review send to the provider 
    {
        $customer_id      = $data['customer_id'];
        $provider_id      = $data['provider_id'];
        $rating           = $data['rating'];
        $comment          = $data['comment'];
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
           $customerDe     = $check->row();
           $providerDe     = $provider_details->row();
           $customer_email = $customerDe->email;
           $provider_email = $providerDe->email;
           $provider_name  = $providerDe->first_name.' '.$providerDe->last_name;
           $customer_name  = $customerDe->first_name.' '.$customerDe->last_name;
           $subject  = "Nytt omdöme";
           $config= $this->mailconfig();
           $this->load->library('email');
           $this->email->initialize($config);
           $message   = 'Hej '.$provider_name.','."\r\n\r\n";
           $message  .=  $customer_name. ' has given follwoing review and rating on your prform services :-'."\r\n";
           $message  .= 'omdöme : '. $comment."\r\n";  
           $message  .= 'Betyg : '. $rating."\r\n";  
           $message  .= 'Kundens email : '.$customer_email."\r\n";
           $message  .= 'Kontaktnummer : '.$customerDe->mobile."\r\n\r\n\r\n";  
           $message  .= 'Med vänliga hälsningar, Syplo!';           
           //print_r($message); 
           $this->email->set_newline("\r\n");
           $this->email->from('info@syplo.se','Syplo'); 
           $this->email->to($provider_email);
           $this->email->subject($subject);
           $this->email->message($message);
           $this->email->send();
        }
    }

    public function SentReviewToCustomer($data)  //Review send to the customer 
    {
        $customer_id      = $data['customer_id'];
        $provider_id      = $data['provider_id'];
        $rating           = $data['rating'];
        $comment          = $data['comment'];
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
           $customerDe     = $check->row();
           $providerDe     = $provider_details->row();
           $customer_email = $customerDe->email;
           $provider_email = $providerDe->email;
           $provider_name  = $providerDe->first_name.' '.$providerDe->last_name;
           $customer_name  = $customerDe->first_name.' '.$customerDe->last_name;
           $subject  = "Nytt omdöme";
           $config= $this->mailconfig();
           $this->load->library('email');
           $this->email->initialize($config);
           $message   = 'Hej '.$customer_name.','."\r\n\r\n";
           $message  .=  $provider_name. ' has given follwoing review and rating on your prform services :-'."\r\n";
           $message  .= 'omdöme : '. $comment."\r\n";  
           $message  .= 'Betyg : '. $rating."\r\n";  
           $message  .= 'Leverantörs e-post : '.$provider_email."\r\n";
           $message  .= 'Kontaktnummer : '.$providerDe->mobile."\r\n\r\n\r\n";  
           $message  .= 'Med vänliga hälsningar, Syplo!';           
           //print_r($message); 
           $this->email->set_newline("\r\n");
           $this->email->from('info@syplo.se','Syplo'); 
           $this->email->to($customer_email);
           $this->email->subject($subject);
           $this->email->message($message);
           $this->email->send();
        }
    }

    public function SentOrderBillByEmail($order_id,$order_details,$services,$Emailmessage)  //For customer 
    {
        $customer_id = $order_details->customer_id;
        $provider_id = $order_details->provider_id;
        $customer_details=$this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id))->row();
        $payment_detail   = $this->orderPaymentDetails($order_id);
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        
        $details=array(
        "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
        "provider_email"=>$provider_details->email,
        "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
        "customer_email" =>$customer_details->email,
        );
        $data->order_details  = $order_details;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;
        $data->details  = $details;

        //----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $toemail  =$customer_details->email;
        $subject  = "Kvitto";
        $message  = " "."\r\n";
        $message .= $Emailmessage."\r\n";
        $message .= $this->load->view('NewFinalOrderBill',$data,true);

        // $mesg = $this->load->view('template/email',$data,true);
        // or
        //$mesg = $this->load->view('email','',true);
        $config=array(
        'charset'=>'utf-8',
        'wordwrap'=> TRUE,
        'mailtype' => 'html'
        );

        $this->email->initialize($config);
        $this->email->to($toemail);
        //$this->email->cc('chetanapptech@gmail.com');
        $this->email->cc('info@syplo.se');
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function orderPaymentDetails($order_id)
    {
        return $this->db->get_where('order_payment',array('order_id'=>$order_id))->row();
    }

    public function SentBillByEmail($order_id,$order_details,$services,$subject,$Emailmessage,$mailstatus)  //For customer 
    {
        $customer_id      = $order_details->customer_id;
        $provider_id      = $order_details->provider_id;
        $customer_details = $this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details = $this->db->get_where('registration',array('id'=>$provider_id))->row();
        $payment_detail   = $this->orderPaymentDetails($order_id);
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        $detail=array(
            "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
            "provider_email"=>$provider_details->email,
            "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
            "customer_email" =>$customer_details->email,
            );
        $data->order_details  = $order_details;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;
        $data->details        = $detail;
        // $this->load->view('OrderBill',$data);
        //----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        if($mailstatus==0)
        {          
          $toemail  = $customer_details->email;
        }
        if($mailstatus==1)
        {
          $toemail = $provider_details->email;
        }        
        $subject  = $subject;
        $message  = " "."\r\n";
        $message .= $Emailmessage."\r\n";

        $message .= $this->load->view('NewOrderBill',$data,true);
        $message .= ''."\r\n\r\n";
        // $mesg = $this->load->view('template/email',$data,true);
        // or
        //$mesg = $this->load->view('email','',true);
        $config=array(
        'charset'=>'utf-8',
        'wordwrap'=> TRUE,
        'mailtype' => 'html'
        );
        $this->email->initialize($config);
        $this->email->to($toemail);
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function SentBillByEmailToSyplo($order_id,$order_detail,$services,$subject,$Emailmessage)  
    {
        //print_r($order_detail);die();
        $customer_id      = $order_detail->customer_id;
        $provider_id      = $order_detail->provider_id;
        $customer_details = $this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details = $this->db->get_where('registration',array('id'=>$provider_id))->row();
        $payment_detail   = $this->orderPaymentDetails($order_id);
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        $detail=array(
            "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
            "provider_email"=>$provider_details->email,
            "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
            "customer_email" =>$customer_details->email,
            );
        $data->order_details  = $order_detail;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;
        $data->details        = $detail;
        //print_r($data);
        // $this->load->view('OrderBill',$data);
        //----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $subject  = $subject;
        $message  = " "."\r\n";
        $message .= $Emailmessage."\r\n\r\n";
        $message .= $this->load->view('NewOrderBill',$data,true);
        $message .= ''."\r\n\r\n";
        // $mesg = $this->load->view('template/email',$data,true);
        // or
        //$mesg = $this->load->view('email','',true);
        $config=array(
        'charset'=>'utf-8',
        'wordwrap'=> TRUE,
        'mailtype' => 'html'
        );
        $this->email->initialize($config);
        //$this->email->to('shubhamapptech6@gmail.com');
        $this->email->to('info@syplo.se');
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','SyploSupport'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function SentSignupDetailsToSyplo($userdata)
    {
        $data = new stdClass();
        $from = $userdata->email;
        $data->result = $userdata;
        $config = $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $subject  = 'New Registration';
        $message = $this->load->view('signupTemp',$data,true);
        $config=array(
        'charset'=>'utf-8',
        'wordwrap'=> TRUE,
        'mailtype' => 'html'
        );
        $this->email->initialize($config);
        //$this->email->to('shubhamapptech6@gmail.com');
        $this->email->to('shubhamapptech6@gmail.com');
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','SyploSupport'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function sendCancelMessage($provider_id,$messages,$subject)
    {
        $provider=$this->db->get_where('registration',array('id'=>$provider_id))->row();
        $provider_email =$provider->email;
        //-----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $subject    =  $subject;
        $message    =  "Hej,"."\r\n\r\n";
        $message   .=  $messages;  
        $message   .= ''."\r\n\r\n";
        $message   .= 'Med vänliga hälsningar, Syplo!';  
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->to($provider_email);
        $this->email->cc('shubhamapptech6@gmail.com');
        $this->email->cc('info@syplo.se');
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send(); 
    }

    public function sendCancelMessageToCustomer($customer_id,$messages,$subject)
    {
        $provider=$this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_email =$provider->email;
        //-----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $subject    =  $subject;
        $message    =  "Hej,"."\r\n\r\n";
        $message   .=  $messages;  
        $message .=''."\r\n\r\n";
        $message .='Med vänliga hälsningar, Syplo!';  
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->to($provider_email);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send(); 
    }

    public function customernotification($provider_id,$customer_id,$notificationMessage)
    {    
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
            $customerDe     = $check->row();
            $providerDe     = $provider_details->row();
            $customerToken  = $customerDe->device_token;
            $device_type    = $customerDe->device_type;
            if($device_type=='1')
            {         
                $this->ios($customerToken,$notificationMessage); 
            }
            if($device_type=='0')
            {
                $this->android($customerToken,$notificationMessage); 
            }
        }
    }

    public function providernotification($provider_id,$customer_id,$notificationMessage)
    {    
        $check=$this->db->get_where('registration',array('id'=>$customer_id));
        $provider_details=$this->db->get_where('registration',array('id'=>$provider_id));
        $count=$check->num_rows();     
        //print_r($count);die(); 
        if($count>0)
        {
            $customerDe     = $check->row();
            $providerDe     = $provider_details->row();
            $providerToken  = $providerDe->device_token;
            $device_type    = $providerDe->device_type;
            if($device_type=='1')
            {         
                    $this->ios($providerToken,$notificationMessage); 
            }
            if($device_type=='0')
            {
                   $this->android($providerToken,$notificationMessage); 
            }
        }
    }

    public function ios($customerToken,$message)
    {
        $deviceToken = $customerToken;//'0329955742ccbfdb084327f535d3102939eff60b83d90d12b307ed12ed6a0740';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert','cert/syploDevAPNsCertificates.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', '123');
        $fp = stream_socket_client(
                'ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
        {
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        }
        else
        {
            $body['aps'] = array(
            'alert' => array(
                'title' => 'Syplo',
                'body' => $message,
            ),
            'sound' => 'default'
            );
            $payload = json_encode($body);
            $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
            // Send it to the server
            $result = fwrite($fp, $msg, strlen($msg));

            // Close the connection to the server
            fclose($fp);  
            //echo json_encode($result);    
        }        
    }

    public function android($customerToken,$message)
    {
        //print_r('ssss'); die;
        error_reporting(-1);
        ini_set('display_errors', 'On'); 
        require_once __DIR__ . '/firebase.php';
        require_once __DIR__ . '/push.php'; 
        $firebase = new Firebase();
        $push = new Push(); 
        // optional payload
        $payload = array();
        $payload['team']  = 'India';
        $payload['score'] = '5.6';
        $title = 'Syplo';//isset($_GET['title']) ? $_GET['title'] : '';
        $message = $message;//isset($_GET['message']) ? $_GET['message'] : '';
        $push_type = 'individual';  // isset($_GET['push_type']) ? $_GET['push_type'] : '';
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;
        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) 
        {
            $push->setImage('http://api.androidhive.info/images/minion.jpg');
        } 
        else
        {
            $push->setImage('');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
        $json = '';
        $response = '';
        if ($push_type == 'topic') 
        {
            //echo $push_type;
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
            //echo json_encode($response);
        } 
        if ($push_type == 'individual') 
        {
            //echo $push_type;
            $json = $push->getPush();
            $regId =$customerToken;//'exgaBVWNeHk:APA91bGGC0gsQ3SdS-i1yUJJ5TtyHF3lHXwTZpuD8_sy6E644FS6R47uFM0p91T8HEeZJjFdFqdLzXgb61kmrgcEqeCP6A5bP41-LGgNTRIEIpnTrMqJoUhKkp5Kn76LI1PrGiKZHrS9';//isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
            //echo json_encode($response);
        }
    }


    public function get_notificationSetting($provider_id)
    {
        return $this->db->get_where('notification_setting',array('user_id'=>$provider_id))->row();
    }

    public function sendSms($smsMessage,$customer_id)
    {
        $customer=$this->db->get_where('registration',array('id'=>$customer_id));
        $count=$customer->num_rows();     
        //print_r($count);
        if($count>0)
        {
            $customerDe     = $customer->row();
            $mobile         = $customerDe->mobile;
            //print_r($mobile);die();
            //$mobileNo = preg_replace('+', '00', $mobile);
            $mobile         = str_replace("+", "", $mobile);
            $mobileNo       = '00'.$mobile;
            //print_r('mobile '.'00'.$mobileNo);die();
            // Shut off error reporting
            ini_set("display_errors", "off");
            $sms_url = "http://se-1.cellsynt.net/sms.php";    // Gateway URL
            $username = "Syplo";                // Account username
            $password = "g1DpVYe1";               // Account password

            $type = "text";                   // Message type
            $originatortype = "alpha";       // Message originator (alpha = Alphanumeric, numeric = Numeric, shortcode = Operator shortcode)
            $originator = "Syplo";                // Message originator

            $destination = $mobileNo;      // Recipient's phone number on international format, in this example UK
            $text = $smsMessage;                // Message text

            // GET parameters
            $parameters  = "username=$username&password=$password";
            $parameters .= "&type=$type&originatortype=$originatortype&originator=" . urlencode($originator);
            $parameters .= "&destination=$destination&text=" . urlencode($text);

            // Send HTTP request
            $response = file_get_contents($sms_url . "?" . $parameters);
            // Check response
            /*if ($response === false) 
            {
                echo "Unable to send request.";
            }
            elseif (substr($response, 0, 4) == "OK: ") 
            {
                $trackingid = substr($response, 4);
                echo "SMS sent with tracking ID: " . $trackingid . "\n";
            }
            elseif (substr($response, 0, 7) == "Error: ")
            {
                echo "An error occured, the server sent the following response: " . $response;
            }*/
        }       
    }
}