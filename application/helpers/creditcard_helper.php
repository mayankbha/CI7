<?php 
 if (!defined('BASEPATH')) exit('No direct script access allowed');

function validateCC($cc_num, $type) {

	$verified = false;
   
	if($type == "Amex") {
	$pattern = "/^([34|37]{2})([0-9]{13})$/";//American Express
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Discover") {
	$pattern = "/^([6011]{4})([0-9]{12})$/";//Discover Card
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "MasterCard") {
	$pattern = "/^([51|52|53|54|55]{2})([0-9]{14})$/";//Mastercard
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}


	} elseif($type == "Visa") {
	$pattern = "/^([4]{1})([0-9]{12,15})$/";//Visa
	if (preg_match($pattern,$cc_num)) {
	$verified = true;
	} else {
	$verified = false;
	}

	}

	if($verified == false) {
	//Do something here in case the validation fails
	$msg=  0;
	return $msg;

	} else { //if it will pass...do something
	$msg = 1;
	return $msg;
	}


}



?>