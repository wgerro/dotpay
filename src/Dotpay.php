<?php

namespace Gerro\Dotpay;

use Illuminate\Database\Eloquent\Model;
use Config;
class Dotpay extends Model
{
    /*
    * Serwer Dotpay - check
    */
    public function dotpayCheckServer(){
        $servers = array('217.17.41.5','195.150.9.37');
        if (!in_array($_SERVER['REMOTE_ADDR'], $servers)) {
            exit('You are not authorized to do this operation!'); 
        }
    }
	/*
	* dotpay ID
	*/
    public function dotpayId(){
        return Config::get('dotpay.Account.dotpayId');
    }
    /*
    * dotpay PIN
    */
	public function dotpayPin(){
		return Config::get('dotpay.Account.dotpayPin');
	}
    /*
    * Sprawdzanie czy jest komplet 
    */
    public function checkCompleted($status, $id, $amount, $control){
        if($status == 'completed' && $id == $this->dotpayId() && !is_null($control)  && !is_null($amount)){
            if(is_numeric($amount))
            {
                return true;
            }
        }
        else{
            return false;
        }
    }
    /*
    * Dane do wyslania z formularza
    */
    public function parametersSetArray($array){
        foreach($array as $key=>$ar){
            {
                array_set($parameters,$key,$ar);
            }
        }    
        return $array;
    }
    /*
    * Generator chk
    */
    public function chkValue($ParametersArray){
        $dotpayId = $this->dotpayId();
        $dotpayPin = $this->dotpayPin();
        
        $chkParameters =
        $dotpayPin.
        (isset($ParametersArray['api_version']) ?
        $ParametersArray['api_version'] : null).
        (isset($ParametersArray['charset']) ?
        $ParametersArray['charset'] : null).
        (isset($ParametersArray['lang']) ?
        $ParametersArray['lang'] : null).
        $dotpayId.
        (isset($ParametersArray['amount']) ?
        $ParametersArray['amount'] : null).
        (isset($ParametersArray['currency']) ?
        $ParametersArray['currency'] : null).
        (isset($ParametersArray['description']) ?
        $ParametersArray['description'] : null).
        (isset($ParametersArray['control']) ?
        $ParametersArray['control'] : null).
        (isset($ParametersArray['channel']) ?
        $ParametersArray['channel'] : null).
        (isset($ParametersArray['credit_card_brand']) ?
        $ParametersArray['credit_card_brand'] : null).
        (isset($ParametersArray['ch_lock']) ?
        $ParametersArray['ch_lock'] : null).
        (isset($ParametersArray['channel_groups']) ?
        $ParametersArray['channel_groups'] : null).
        (isset($ParametersArray['onlinetransfer']) ?
        $ParametersArray['onlinetransfer'] : null).
        (isset($ParametersArray['url']) ?
        $ParametersArray['url'] : null).
        (isset($ParametersArray['type']) ?
        $ParametersArray['type'] : null).
        (isset($ParametersArray['buttontext']) ?
        $ParametersArray['buttontext'] : null).
        (isset($ParametersArray['urlc']) ?
        $ParametersArray['urlc'] : null).
        (isset($ParametersArray['firstname']) ?
        $ParametersArray['firstname'] : null).
        (isset($ParametersArray['lastname']) ?
        $ParametersArray['lastname'] : null).
        (isset($ParametersArray['email']) ?
        $ParametersArray['email'] : null).
        (isset($ParametersArray['street']) ?
        $ParametersArray['street'] : null).
        (isset($ParametersArray['street_n1']) ?
        $ParametersArray['street_n1'] : null).
        (isset($ParametersArray['street_n2']) ?
        $ParametersArray['street_n2'] : null).
        (isset($ParametersArray['state']) ?
        $ParametersArray['state'] : null).
        (isset($ParametersArray['addr3']) ?
        $ParametersArray['addr3'] : null).
        (isset($ParametersArray['city']) ?
        $ParametersArray['city'] : null).
        (isset($ParametersArray['postcode']) ?
        $ParametersArray['postcode'] : null).
        (isset($ParametersArray['phone']) ?
        $ParametersArray['phone'] : null).
        (isset($ParametersArray['country']) ?
        $ParametersArray['country'] : null).
        (isset($ParametersArray['code']) ?
        $ParametersArray['code'] : null).
        (isset($ParametersArray['p_info']) ?
        $ParametersArray['p_info'] : null).
        (isset($ParametersArray['p_email']) ?
        $ParametersArray['p_email'] : null).
        (isset($ParametersArray['n_email']) ?
        $ParametersArray['n_email'] : null).
        (isset($ParametersArray['expiration_date']) ?
        $ParametersArray['expiration_date'] : null).
        (isset($ParametersArray['deladdr']) ?
        $ParametersArray['deladdr'] : null).
        (isset($ParametersArray['recipient_account_number']) ?
        $ParametersArray['recipient_account_number'] : null).
        (isset($ParametersArray['recipient_company']) ?
        $ParametersArray['recipient_company'] : null).
        (isset($ParametersArray['recipient_first_name']) ?
        $ParametersArray['recipient_first_name'] : null).
        (isset($ParametersArray['recipient_last_name']) ?
        $ParametersArray['recipient_last_name'] : null).
        (isset($ParametersArray['recipient_address_street']) ?
        $ParametersArray['recipient_address_street'] : null).
        (isset($ParametersArray['recipient_address_building']) ?
        $ParametersArray['recipient_address_building'] : null).
        (isset($ParametersArray['recipient_address_apartment']) ?
        $ParametersArray['recipient_address_apartment'] : null).
        (isset($ParametersArray['recipient_address_postcode']) ?
        $ParametersArray['recipient_address_postcode'] : null).
        (isset($ParametersArray['recipient_address_city']) ?
        $ParametersArray['recipient_address_city'] : null).
        (isset($ParametersArray['warranty']) ?
        $ParametersArray['warranty'] : null).
        (isset($ParametersArray['bylaw']) ?
        $ParametersArray['bylaw'] : null).
        (isset($ParametersArray['personal_data']) ?
        $ParametersArray['personal_data'] : null).
        (isset($ParametersArray['credit_card_number']) ?
        $ParametersArray['credit_card_number'] : null).
        (isset($ParametersArray['credit_card_expiration_date_year']) ?
        $ParametersArray['credit_card_expiration_date_year'] : null).
        (isset($ParametersArray['credit_card_expiration_date_month']) ?
        $ParametersArray['credit_card_expiration_date_month'] : null).
        (isset($ParametersArray['credit_card_security_code']) ?
        $ParametersArray['credit_card_security_code'] : null).
        (isset($ParametersArray['credit_card_store']) ?
        $ParametersArray['credit_card_store'] : null).
        (isset($ParametersArray['credit_card_store_security_code']) ?
        $ParametersArray['credit_card_store_security_code'] : null).
        (isset($ParametersArray['credit_card_customer_id']) ?
        $ParametersArray['credit_card_customer_id'] : null).
        (isset($ParametersArray['credit_card_id']) ?
        $ParametersArray['credit_card_id'] : null).
        (isset($ParametersArray['blik_code']) ?
        $ParametersArray['blik_code'] : null).
        (isset($ParametersArray['credit_card_registration']) ?
        $ParametersArray['credit_card_registration'] : null).
        (isset($ParametersArray['recurring_frequency']) ?
        $ParametersArray['recurring_frequency'] : null).
        (isset($ParametersArray['recurring_interval']) ?
        $ParametersArray['recurring_interval'] : null).
        (isset($ParametersArray['recurring_start']) ?
        $ParametersArray['recurring_start'] : null).
        (isset($ParametersArray['recurring_count']) ?
        $ParametersArray['recurring_count'] : null);

        return hash('sha256',$chkParameters); //key chk
    }
    /*
    * Environment
    */
    public function environment($env){
        if($env == 'production')
        {
            return Config::get('dotpay.Services.production');
        }
        elseif($env == 'test')
        {
            return Config::get('dotpay.Services.test');
        }
        else
        {
            return false;
        }
    }
    /*
    * Method
    */
    public function redirectionMethod($method){
        return strtoupper($method);
    }
    /*
    * Button dotpay,form,a
    */
    public function buttonDotpay($environment, $redirectionMethod, $chkValue, $array){
        if($redirectionMethod == 'POST'){
            $redirection = '<form action="'.$environment.'" method="POST" id="dotpay_redirection_form">'.PHP_EOL;
            $redirection .= "\t".'<input name="_token" value="'.csrf_token().'" type="hidden"/>'.PHP_EOL;
            foreach($array as $key=>$value)
            {
                $redirection .= "\t".'<input name="'.$key.'" value="'.$value.'" type="hidden"/>'.PHP_EOL;
            }
            $redirection .= "\t".'<input name="id" value="'.$this->dotpayId().'" type="hidden"/>'.PHP_EOL;
            $redirection .= "\t".'<input name="chk" value="'.$chkValue.'" type="hidden"/>'.PHP_EOL;
            $redirection .= '</form>'.PHP_EOL;
            $redirection .= '<button id="dotpay_redirection_button" type="submit" form="dotpay_redirection_form" value="Submit"> PAY </button>'.PHP_EOL;
           
            return $redirection;
        }
        elseif($redirectionMethod == 'GET'){
            $redirection = $environment.'?';

            foreach($array as $key=>$value)
            {
                $redirection .= $key.'='.rawurlencode($value).'&';
            } 

            $redirection .= '&id='.$this->dotpayId().'&chk='.$chkValue;
            return '<a href="'.$redirection.'">PAY</a>';
        }
    }
}
