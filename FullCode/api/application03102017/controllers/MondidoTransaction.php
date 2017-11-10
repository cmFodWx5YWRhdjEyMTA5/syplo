<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH. 'libraries/mondido/src/mondido_sdk.php');
use mondido\models\transaction;
use mondido\models\credit_card;

	class MondidoTransaction extends CI_Controller {
		function __construct() {
        parent::__construct();
        $this->load->helper("form");
    }

	public function index()
	{
		$this->load->library('Check');

		$res=$this->check->check();

		//$response = mondido\api\transaction::check();
		//echo json_encode($response);
	}

	public function creat_transaction()
	{
		$ref = rand(100,10000);
			$transaction = new transaction(array(
			"MerchantId" => "1762",
			"Amount" => 10.00,
			"PaymentRef" => $ref,
			"Payment" => new credit_card(array(
				"Holder" => "SyploTest",
				"Cvv" => "200",
				"Expiry" => "0116",
				"Number" => "4111111111111111",
				"Type" => "VISA"
			)),
			"Test" => true,
			"Metadata" => json_encode(array("name" => "Karim")),
			"Currency" => "sek",
			"StoreCard" => false,
			// "PlanId" => 100,
			"CustomerRef" => $ref,
			#"Hash" => "",
			// "Webhook" => json_encode(array("trigger" => "payment_success", "email" => "shubhamj@gmail.com")),
			"Encrypted" => "",
			"Process" => true,
			 "SuccessUrl" => 'https://syplo.se/api/index.php/MondidoTransaction/creat_transaction/payment_success?data=value&data2=value2',
			  "ErrorUrl" => 'https://syplo.se/api/index.php/MondidoTransaction/creat_transaction/payment_fail?data=value&data2=value2'
			));
			$response = mondido\api\transaction::create($transaction);
			echo json_encode($response);
	}
}
