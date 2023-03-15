<?php ob_start();

function check_login($login, $redirect){
	if(isset($login['username']))
	{
		//echo 'logged'; 
		return true;
	} else {
		if($redirect == 'admin'){
			redirect('/admin/login', 'refresh');
		} else {
			redirect('/auth/login?location='.urlencode($_SERVER['REQUEST_URI']), 'refresh');
		}
	}
}