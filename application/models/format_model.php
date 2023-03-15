<?php
/**
 * format_model Class
 * 
 * Handles formats
 *
 * @package PMH Tools
 * @subpackage  Model
 * @author  Rommel Capispisan <x.romel@gmail.com>
 */
class Format_model extends CI_Model {

 
    function __construct() {
        parent::__construct();

    }
	function date_format_from_database($time){
		$newtime=date('d-m-Y', strtotime($time));
		return $newtime;
	}
	function time_format_from_database($time){
		$newtime=date('h:i a', strtotime($time));
		return $newtime;
	}	
	function dob_to_age($dob){
		return floor((time() - strtotime($dob))/31556926);
		 
	}
	
}
