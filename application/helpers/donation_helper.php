<?php

if (!function_exists('allow_donate'))
{
	function allow_donate()
	{
		$CI =& get_instance();
		//If user loogged in
		if($CI->ion_auth->logged_in())
		{
			$CI->load->model('member_model');
			$user = $CI->member_model->get_profile_by_id($CI->ion_auth->user()->row()->id);	
			
			$userCountry = isset($user['country']) ? $user['country'] : NULL;
			$countries = array(
				'in' => 'india',
				'cn' => 'china',
				'jp' => 'japan',
				'kp' => 'korea',
				'kr' => 'korea',
				'vn' => 'vietnam',
				'ph' => 'philippines',
				'la' => 'laos',
				'id' => 'indonesian',
				'my' => 'malaysia',
			);
			$c_not_allowed = array_key_exists(strtolower($userCountry) , $countries);
			$g_not_allowed = ($user['gender']=='f');
			
			if($c_not_allowed && $g_not_allowed) {
				return false; //donation not allowd
			}
			return true;
		}
		return false;
	}
}

if (!function_exists('donation_timer'))
{
	function donation_timer()
	{
		$CI =& get_instance();
		$CI->load->model('setting_model');
		$detail = $CI->setting_model->get_popup_time();
		return (int)$detail['value'];
	}
}