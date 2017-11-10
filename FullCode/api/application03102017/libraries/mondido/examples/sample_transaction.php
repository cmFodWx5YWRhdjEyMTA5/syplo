<?php

require_once(dirname(__FILE__) . '/../src/mondido_sdk.php');
//use mondido\models\transaction;
//use mondido\models\credit_card;
$ref = rand(100,10000);

$hh = '1762'.''.$ref.''.$ref.''.'10.00'.''.'sek'.''.'test'.''.'$2a$10$nA.uGNZOlUOy3WWAFJmxru';
//$hasss = MD5($hh);


$payment = array(
  "card_number" => "4111111111111111",
  "card_holder" => "php sdk",
  "card_expiry" => "0116",
  "card_cvv" => "200",
  "card_type" => "VISA",
  "amount" => "10.00",
  "payment_ref" => $ref,
  "currency" => "sek",
  "test" => "true",
  "SuccessUrl" => 'http://localhost/projects/mondido/examples/sample_transaction.php/payment_success?data=value&data2=value2',
  "ErrorUrl" => 'http://localhost/projects/mondido/examples/sample_transaction.php/payment_fail?data=value&data2=value2',
  "hash" => md5('1762'.''.$ref.''.$ref.''.'10.00'.''.'sek'.''.'test'.''.'$2a$10$nA.uGNZOlUOy3WWAFJmxru')
);
//$response = mondido\api\transaction::trans($payment);
//print_r($response);
$url ='https://api.mondido.com/v1/transactions';
$uname ='testshubj285@gmail.com';
$pass  ='shubham@123';

        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, count($payment));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payment);
        curl_setopt($ch, CURLOPT_USERPWD, "$uname:$pass");
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);

        if(curl_exec($ch) === false)
		{
		    echo 'Curl error: ' . curl_error($ch);
		}
		else
		{
		    echo 'Operation completed without any errors';
		}




        //print_r('res'.$result);
        //echo json_decode($result, TRUE);


   // curl -X POST --data "card_number=4111111111111111&card_expiry=0116&card_holder=name%20name&card_type=VISA&amount=5.00&payment_ref=53dfaa67&card_cvv=200&currency=sek&hash=6bd88f621553edcf0c553f91bf6fb797&test=true" --user 3:password 'https://api.mondido.com/v1/transactions'








/*$ref = rand(100,10000);
$transaction = new transaction(array(
	"MerchantId" => "1762",
	"Amount" => 1,
	"PaymentRef" => $ref,
	"Payment" => new credit_card(array(
		"Holder" => "PHPSDKTest",
		"Cvv" => "200",
		"Expiry" => "0116",
		"Number" => "4111111111111111",
		"Type" => "VISA"
	)),
	"Test" => true,
	"Metadata" => json_encode(array("name" => "Anderson")),
	"Currency" => "sek",
	"StoreCard" => false,
	"PlanId" => 100,
	"CustomerRef" => $ref,
	#"Hash" => "",
	"Webhook" => json_encode(array("trigger" => "payment_success", "email" => "shubhamj@gmail.com")),
	"Encrypted" => "",
	"Process" => true,
	"SuccessUrl" => 'http://localhost/projects/mondido/examples/sample_transaction.php/payment_success?data=value&data2=value2',
	"ErrorUrl" => 'http://localhost/projects/mondido/examples/sample_transaction.php/payment_fail?data=value&data2=value2'
));
//echo json_encode($transaction);
//print_r($transaction);
//$hh = '1762'.''.$ref.''.$ref.''.'10.00'.''.'sek'.''.'test'.''.'$2a$10$nA.uGNZOlUOy3WWAFJmxru';
//$hasss = MD5($hh);
//print_r($hasss);
//$response = mondido\api\transaction::create($transaction);
//print_r($response);*/