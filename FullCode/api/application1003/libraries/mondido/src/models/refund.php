<?php namespace mondido\models;

use mondido\settings\configuration;

class refund extends base_model {
    private $transaction_id;
    private $amount;
    private $reason;
    
    public function __construct($arguments){
        parent::__construct();

        foreach ($arguments as $attribute => $value)
        {
            $methodName = "set" . $attribute;
            $this->$methodName($value);
        }
    }

    public function gettransaction_id(){
        return $this->transaction_id;
    }

    public function settransaction_id($transaction_id){
        $this->transaction_id = $transaction_id;
    }

    public function getamount(){
        return $this->amount;
    }

    public function setamount($amount){
        $this->amount = $amount;
    }

    public function getreason(){
        return $this->reason;
    }

    public function setreason($reason){
        $this->reason = $reason;
    }

    public function getAllAttributes(){
        return get_object_vars($this);
    }
}