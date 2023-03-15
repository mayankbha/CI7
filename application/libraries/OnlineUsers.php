<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class OnlineUsers {

	public function __construct() {
		$this->CI =& get_instance();

		$this->CI->load->library('ion_auth');
		//$this->CI->load->library('ion_auth');

		$this->CI->load->helper('url');
		$this->CI->load->helper('language');

		$this->CI->load->database();

		$this->CI->lang->load('auth');

		$this->CI->load->model('member_model');
		$this->CI->load->model('registration_model');
	}

	/*public function getCountries() {
		$countries = $this->CI->lang->line('reg_countries_options');
		return $countries;

		//return	$this->CI->member_model->getOnlineUsersCount();
	}*/

	public function getOnlineUsersCount() {
		return	$this->CI->member_model->getOnlineUsersCount();
	}

	public function getUsersBetweenAge() {
		$age_arr = array('18-24', '25-31', '32-38', '39-45', '46-52', '53-59', '60-66', '67-73', '74-79', '80-86');
		return $this->CI->member_model->getUsersBetweenAge($age_arr);
	}

	public function getOnlineUsers() {
		$data = $this->CI->input->post();
		return $this->CI->member_model->getOnlineUsers($data);
	}

}