<?php
require_once(dirname(__FILE__) . '/../src/mondido_sdk.php');
//use mondido\models\credit_card;
$data = array(
  "transaction_id" => "213961",
  "amount" => "01.00",
  "reason" => "wrong"
);
//print_r($data);
$res = mondido\api\refund::create($data);
print_r($res);
?>