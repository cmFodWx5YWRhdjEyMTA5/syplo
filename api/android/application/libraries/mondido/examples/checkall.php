<?php 
require_once(dirname(__FILE__) . '/../src/mondido_sdk.php');
$transaction_id ='215729';
$transaction = mondido\api\transaction::get($transaction_id);
print_r($transaction);
?>