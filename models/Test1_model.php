<?php
class Test1_model extends CI_Model 
{
	function __construct()
	{
        parent::__construct();
       $this->load->database();
    }

    public function checkReviewStatus($order_id,$giver_id)
    {
        $count= $this->db->get_where('review', array('order_id'=>$order_id,'customer_id'=>$giver_id))->num_rows();
        print_r($count);die();
    }
    public function UserAreaSearch($services_id,$another)
    {   
        $match=0;
        $perfectId=array();
        $perfectId1=array();
        $this->db->where_in('service_id',$services_id);
        $this->db->from('service_rate');
        $this->db->group_by('user_id');
        $data=$this->db->get()->result();
        if(!empty($data))
        {
            $us='';
            foreach ($data as $key)
            {
                $us[]= $key->user_id;
            }
            $user_ids=count($us);
            $service_ids=count($services_id);
            for($i=0; $i<$user_ids; $i++)
            {
                for($j=0; $j<$service_ids; $j++)
                {
                    if($res=$this->db->get_where('service_rate',array('user_id'=>$us[$i],'service_id'=>$services_id[$j])))
                    {
                        if($res->num_rows()>0)
                        {
                            $match++;
                        }
                    }
                }
                if($match==$service_ids)
                {
                    $perfectId[]=$us[$i];
                }
                // print_r($i.'='.$match.',');
                $match=0;
            }
           if(!empty($perfectId) && !empty($another))
            {
                $match1=0;
                for($k=0; $k<count($perfectId); $k++)
                {
                    for($l=0; $l<count($another); $l++)
                    {
                        if($res1=$this->db->get_where('another_service',array('user_id'=>$perfectId[$k],'id'=>$another[$l])))
                        {
                            if($res1->num_rows()>0)
                            {
                                $match1++;
                            }
                        }
                    }
                    if($match1==count($another))
                    {
                        $perfectId1[]=$perfectId[$k];
                    }
                        $match1=0;
                }                
                return $perfectId1;
            }      
            else
            {
                return $perfectId;
            }
        }
        else
        {
           return $perfectId;         // when no user id found
        }
    }

    public function UserSearchToAnother($another_id)
    {
        $this->db->select('user_id');
        $this->db->where_in('id',$another_id);
        $this->db->from('another_service');
        $this->db->group_by('user_id');
        $data1=$this->db->get()->result();
        $match1=0;
        $actual=array();
        //print_r(count($another_id));die();
        foreach ($data1 as $key)
        {
            $our[]= $key->user_id;
        }
        for($k=0; $k<count($our); $k++)
        {
            for($l=0; $l<count($another_id); $l++)
            {
                if($our_res=$this->db->get_where('another_service',array('user_id'=>$our[$k],'id'=>$another_id[$l])))
                {
                    if($our_res->num_rows()>0)
                    {
                        $match1++;
                    }
                }
            }
            if($match1==count($another_id))
            {
                $actual[]=$our[$k];
            }
                // print_r($i.'='.$match.',');
                $match1=0;
        }                
        //print_r($actual);die();
        return $actual;
    }

    public function checkOrderTime($Ids,$date,$times)
    {
        //print_r($Ids);die();
        $countId = count($Ids);
        for($i=0; $i<$countId; $i++)
        {
            $this->db->select('*');
            $this->db->from('order');
            $this->db->where(array('provider_id'=>$Ids[$i],'date'=>$date,'approve_status'=>1,'order_status'=>0));
            $cc =$this->db->get();
            $c= $cc->num_rows();
            if($c>0)
            {
                $da = $cc->row();
                $otime=$da->time;
                if($otime<$times)
                { unset($Ids[$i]);}
            }
        }
        return $Ids;
    }

    public function search($time,$addLat,$addLng,$addresstype,$WorkPerformUserId)
    {        
        $ww_id=array();
        for($w=0; $w<count($WorkPerformUserId); $w++)
        {
            $this->db->select('id,availability,address_acceptance');
            $this->db->from('registration');
            $this->db->where(array('id'=>$WorkPerformUserId[$w],'show_position'=>1,'status'=>1));
            $AcceptWhere = '(address_acceptance="2" or address_acceptance='.$addresstype.')';
            $this->db->where($AcceptWhere);
            $av=$this->db->get()->row();   
            //print_r($av);
            if($av!='')
            {
                 $where = '(user_type="1" or user_type="4")';
                if($addresstype==1)
                {
                    if($av->availability==2)
                    {                
                        $this->db->where(array('start_time<'=>$time,'end_time>'=>$time));
                    }                   
                    $this->db->select("workarea.id,user_id,registration.*,( 3959 * acos( cos( radians($addLat) ) * cos( radians(`area_lat`) ) * cos( radians( `area_lng` ) - radians($addLng) ) + sin( radians($addLat) ) * sin( radians( `area_lat` ) ) ) ) AS distance");
                    $this->db->from('registration');
                    $this->db->join('workarea','workarea.user_id=registration.id');
                    $this->db->where(array('registration.id'=>$WorkPerformUserId[$w],'registration.approve_status='=>1));
                    $this->db->where($where);
                    $this->db->having('distance <= ',50);  
                    $this->db->order_by('distance');
                    $res=$this->db->get()->row();
                    if(!empty($res))
                    {                
                         $ww_id[] = $res;
                    }
                }   
                else
                {
                    $this->db->select("*,( 3959 * acos( cos( radians($addLat) ) * cos( radians(`lat`) ) * cos( radians( `long` ) - radians($addLng) ) + sin( radians($addLat) ) * sin( radians( `lat` ) ) ) ) AS distance");
                    $this->db->from('registration');
                    $this->db->where(array('id'=>$WorkPerformUserId[$w],'approve_status='=>1));
                    $this->db->where($where);
                    $this->db->having('distance <= ',50);  
                    $this->db->order_by('distance');
                    $res1=$this->db->get()->row();
                    if(!empty($res1))
                    {                
                        $ww_id[] = $res1;
                    }
                }                  
            }
        }   
        return $ww_id;
        //print_r($av);die();
        //echo json_encode($ww_id);die();          
        //return $this->db->get()->result();   
    }

    public function moving_address($user_id)
    {
        return $this->db->get_where('workarea',array('user_id'=>$user_id,'address_status'=>1))->row();

    }

    public function OrderRequestResponse($order_id,$status)
    { 
        $data=array('approve_status'=>$status);
        return $this->db->update('order',$data,array('id'=>$order_id));
    }

    public function order_details($order_id)
    {
        return $this->db->get_where('order',array('id'=>$order_id))->row();
    }


    public function SentBillByEmail1($order_id,$order_details,$services,$subject,$Emailmessage,$mailstatus)  //For customer 
    {
        $customer_id      = $order_details->customer_id;
        $provider_id      = $order_details->provider_id;
        $customer_details = $this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details = $this->db->get_where('registration',array('id'=>$provider_id))->row();
        $payment_detail   = $this->orderPaymentDetails($order_id);
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        $details=array(
            "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
            "provider_email"=>$provider_details->email,
            "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
            "customer_email" =>$customer_details->address,
            );
        $data->order_details  = $order_details;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;
        $data->details  = $details;
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
        $message  = "Hi,"."\r\n\r\n";
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
        $this->email->to($toemail);
        //$this->email->cc('naman.jain7463@gmail.com');
        $this->email->cc('info@syplo.se');
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
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
    public function sendemail()
    {
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
       $provider_email = 'shubhamapptech6@gmail.com';
       $subject="email check";
       $message="Sucessfully check";       
       $message   = "Hi,"."\n";
       $this->email->set_newline("\r\n");
       $this->email->from('shubhamj285@gmail.com','Syplo'); 
       $this->email->to($provider_email);
       $this->email->subject($subject);
       $this->email->message($message);
        if($this->email->send())
        {
            echo "yess";
        } 
        else
        {
            echo "noo";  
        }  
    }

    public function notification($provider_id,$customer_id,$notificationMessage)
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
            //$device_type    = 0;
            //$customerToken  ='fhk4ey92Eds:APA91bGeTZvFoOpp3mscmqmWCkVbqdvTI4QDE1hG0qpYDezRRhxPLZU5at8wiaHOde38r752COCvEZheijs6Pvj6YpMVIT7tNa1SP0SOpKB7rqjqCXe8KartUfRQMBJfRuuhdNpoqpqv';
           //$message        = 'Your order has been booked successfull. Your Order Id is '.$order_id;
            if($device_type=='1')
            {         
                    $this->ios($customerToken,$notificationMessage); 
            }
            if($device_type=='0')
            {
                //print_r($customerToken);
                //echo "<br>";
                $this->android($customerToken,$notificationMessage); 
                //$this->androidnotification($customerToken,$message); 
            }
        }
    }

    public function notification1()
    {
        $device_type    = 1;
        $customerToken  = 'caa3f139c856613c6f0055e42130377359239a86e342c7725c7bb10ddfc89747';
        $message        = 'Your order has been Accepted';
        if($device_type=='1')
        {         
                $this->ios($customerToken,$message); 
        }
        if($device_type=='0')
        {
            $this->android($customerToken,$message); 
        }
    }

    public function ios($customerToken,$message)
    {

        //$ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert', '/Users/Development/Dev/ck.pem');
        $deviceToken = $customerToken;//'0329955742ccbfdb084327f535d3102939eff60b83d90d12b307ed12ed6a0740';
        $ctx = stream_context_create();
        //stream_context_set_option($ctx, 'ssl', 'local_cert','cert/syploDevAPNsCertificates.pem');
        stream_context_set_option($ctx, 'ssl', 'local_cert','cert/APNsDevCertificates.pem');
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
                'title' => 'Banner',
                'body' => 'Banner',
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
            echo json_encode($response);
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


    public function androidnotification($customerToken,$message)
    {
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAv9zZY0U:APA91bEYhM--Ut6wl3CK0JCWK5KH7nkFEnOrdH_8fTYVVG3cY7jm_RqGyAFKFjLdMfsQnozWrknY5jZRhTceUJrKTTpw8wbKB0fVRuHMRVGEgTSf-sdHAw72PHHB1oznWdBrpK7aQtiR');
        //$registrationIds = array( $_GET['id'] );
        $registrationIds = array('1873525b378c83d7c8ce17ebcdbd06f5');
        // prep the bundle
        $msg = array
        (
            'message'    => $message,
            'title'      => 'This is a title. title',
            'subtitle'   => 'This is a subtitle. subtitle',
            'tickerText' => 'Ticker text here...Ticker text here...Ticker text here',
            'vibrate'    => 1,
            'sound'      => 1,
            'largeIcon'  => 'large_icon',
            'smallIcon'  => 'small_icon'
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'              => $msg
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, true );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;
    }

    public function checknotification($customerToken,$message)
    {
        define( 'API_ACCESS_KEY', 'AAAAv9zZY0U:APA91bEYhM--Ut6wl3CK0JCWK5KH7nkFEnOrdH_8fTYVVG3cY7jm_RqGyAFKFjLdMfsQnozWrknY5jZRhTceUJrKTTpw8wbKB0fVRuHMRVGEgTSf-sdHAw72PHHB1oznWdBrpK7aQtiR');
        $registrationIds = array($_GET['id']);
        // prep the bundle
        $msg = array
        (
            'message'   => 'here is a message. message',
            'title'     => 'This is a title. title',
            'vibrate'   => 1,
            'sound'     => 1
        );
        $fields = array
        (
            'registration_ids'  => $registrationIds,
            'data'          => $msg
        );
         
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
         
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
        echo $result;
    }
    public function orderPaymentDetails($order_id)
    {
        return $this->db->get_where('order_payment',array('order_id'=>$order_id))->row();
    }

    
    public function SentBillByEmail($order_id,$order_details,$services,$subject,$Emailmessage)  //For customer 
    {
        $customer_id      = $order_details->customer_id;
        $provider_id      = $order_details->provider_id;
        $customer_details = $this->db->get_where('registration',array('id'=>$customer_id))->row();
        $provider_details = $this->db->get_where('registration',array('id'=>$provider_id))->row();
        $payment_detail   = $this->orderPaymentDetails($order_id);
        //----------------------------------------------------------------------------//
        $data = new stdClass();
        $details=array(
            "provider_name"=>$provider_details->first_name.' '.$provider_details->last_name,
            "provider_email"=>$provider_details->email,
            "customer_name"=>$customer_details->first_name.' '.$customer_details->last_name,
            "customer_email" =>$customer_details->address,
            );
        $data->order_details  = $order_details;
        $data->services       = $services;
        $data->payment_detail = $payment_detail;

        // $this->load->view('OrderBill',$data);
        //----------------------------------------------------------------------------//
        $config= $this->mailconfig();
        $this->load->library('email');
        $this->email->initialize($config);
        $toemail  = $customer_details->email;
        $subject  = $subject;
        $message  = "Hi,"."\r\n\r\n";
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
        $this->email->to($toemail);
        //$this->email->cc('naman.jain7463@gmail.com');
        //$this->email->cc('info@syplo.se');
        $this->email->set_newline("\r\n");
        $this->email->from('info@syplo.se','Syplo'); 
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
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
            if ($response === false) 
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
            }
        }   
    }

    

    Public function order_request($member_id)         //Old
    {             
        $this->db->select('id,customer_id');
        $this->db->from('order');
        $this->db->where('provider_id',$member_id);
        $cust = $this->db->get()->result();
        $response=[];
        if(!empty($cust))
        {
            foreach ($cust as $key => $value) 
            {
                $cust_id  = $value->customer_id;   
                $order_id = $value->id;
                /*echo $cust_id; 
                echo "<br>";
                echo $order_id;*/
                $this->db->select('order.*,registration.company_id,first_name,email,last_name,dob,gender,about,user_image,user_type');
                $this->db->from('order');
                $this->db->join('registration','order.customer_id=registration.id');
                $this->db->where(array('order.approve_status'=>0,'order.order_status'=>0));
                $this->db->where('registration.id',$cust_id);      
                $this->db->where('order.id',$order_id);      
                $response = $this->db->get()->row(); 
                /*if(!empty($response))
                {
                    $rresponse[]=$response;
                }*/
            }
            return $response;
            //print_r(count($rresponse));
            //echo json_encode($rresponse);die();              
        }
        else
        {
            return $response;
        }
        
            //echo json_encode($response);die();        
            //print_r($response);die();
    }

    Public function MemberRequestHistory($member_ids)
    { 
        $every = [];
        $rr = [];
        foreach ($member_ids as $key => $value) 
        {  
            //echo "ddds ".$value->id;
            $member_id =$value->id;
            $this->db->select('id,provider_id,customer_id');
            $this->db->from('order');
            $this->db->where('provider_id',$member_id);
            $where = '(approve_status=2 OR order_status=1)';
            $this->db->where($where);
            $cust = $this->db->get()->result();
            //print_r($cust);die();
            if(!empty($cust))
            {
                foreach ($cust as $key => $value) 
                {
                    $cust_id  = $value->customer_id;   
                    $order_id = $value->id;
                    /*echo $cust_id; 
                    echo "<br>";
                    echo $order_id;*/
                    $this->db->select('order.*,registration.first_name,email,last_name,dob,gender,about,user_image,user_type');
                    $this->db->from('order');
                    $this->db->join('registration','order.customer_id=registration.id');
                    $this->db->where('registration.id',$cust_id);      
                    $this->db->where('order.id',$order_id);      
                    $response = $this->db->get()->row(); 
                    if(!empty($response))
                    {
                        $member_details = $this->customer_profile($member_id);
                        $rresponse["data"]            = $response;
                        $rresponse["memberDetails"]   = $member_details;                        
                        $rr[]=$rresponse;
                    }
                }
                //echo json_encode($rresponse);die();
                $every[] =$rr;            
                $rr='';
            }
        }
        if(!empty($every))
        {
            //echo json_encode($every);die(); 
            return $every;
        }
        else
        {
            return $every;
        } 
    }

    public function customer_profile($cust_id)
    {
        //print_r($provider_id);
        $res= $this->db->get_where('registration',array('id'=>$cust_id))->row();
        return $res;
        //print_r($res);die();
    }

    public function MemberAcceptRequest12($provider_id)
    {
        $this->db->select('id,customer_id');
        $this->db->from('order');
        $this->db->where(array('provider_id'=>$provider_id,'approve_status'=>1,'order_status'=>0));
        $cust = $this->db->get()->result();
        $response=[];
        //echo json_encode($cust);die();
        //print_r($cust);
        if(!empty($cust))
        {
            foreach ($cust as $key => $value) 
            {
                $this->db->select('order.*,registration.first_name,last_name,email,dob,gender,user_image,user_type,about');
                $this->db->from('order');
                $this->db->join('registration','order.customer_id=registration.id');
                $this->db->where('registration.id',$value->customer_id);  
                $this->db->where('order.id',$value->id);    
                $res_data = $this->db->get()->row();
                $response[]=$res_data;    
            }
            //echo json_encode($response);die();
            return $response;
        }
        else
        {
            return $response;
        }
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
            $response["message"]            = "Success, Which account type password do you want?";
            $response["data"]               = $cc;
            echo json_encode($response);die();
        }     
        else if($count==0)
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
            $response['message']="This User Id is not found! Please enter correct details";
            echo json_encode($response);
            exit;
        }
    }
}
?>