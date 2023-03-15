<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		if(isset($this->session->userdata['message']))
		{
			$currentMessage = $this->session->userdata['message'];  
			$this->session->unset_userdata(array('message'=>''));
			echo $currentMessage;   
		}
		$this->load->library('session'); 
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('login');
		$this->load->database();
		
		$this->load->helper('language');
		
		$this->lang->load('_auth');
		$this->lang->load('_header_navigation', $this->config->item('language'));
		$this->lang->load('_splash', $this->config->item('language'));
		$this->lang->load('_forms', $this->config->item('language'));
		$this->lang->load('_footer', $this->config->item('language'));
		
		//load model
		$this->load->model('member_model');
		
		$this->data = array();
		$this->data['language'] = array('path'=>'asian');
		$age_between_range = '18;30';
		$this->data['age_between_array'] = explode(';', $age_between_range);

		if(isset($this->session->userdata['age']))
		{   
			$this->data['age_between_array'] = explode(';', $this->session->userdata['age']);
		}
		
		if(isset($this->session->userdata['looking_for']))
		{
			$looking_for = $this->session->userdata['looking_for']; 
		} else {
			$looking_for = 'female';    
		}
	
		$this->data['i_am'] = array(
			'name'  => 'i_am',
			'value' => @$this->session->userdata['i_am'],
			'options'=> $this->lang->language['gender'],
			'form_options'=> 'id="i_am" class="form-control"',
		);

		$this->data['looking_for'] = array(
			'name'  => 'looking_for',
			'value' => $looking_for,
			'options'=> $this->lang->language['gender'],
			'form_options'=> 'id="looking_for" class="form-control"',
		);	
		
		$this->data['age'] = array(
			'name'  => 'age',
			'value' => '18;99',
			'id' => 'age-slider',
			'class' => 'form-control',
		);
		
		if(isset($this->session->userdata['user_id']))
		{
			$this->data['donate_user'] = $this->member_model->donate_user(@$this->session->userdata['user_id']);        
			//fetch login user list     
			$this->data['login_user'] = $this->member_model->login_user();     
			
			foreach($this->data['login_user'] as $value)
			{
				//get thread user data    
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
				$this->data['users'][$value['id']]['busy_status'] = $this->member_model->get_login_busystatus($value['id']);//login busy status
				$this->data['users'][$value['id']]['available_status'] = $this->member_model->get_login_availablestatus($value['id']);//login available status 
				$this->data['users'][$value['id']]['invisible_status'] = $this->member_model->get_login_invisiblestatus($value['id']);//login invisible status  
			} 
			redirect('/profile');    
			
			  //end login user list 
		}
		
		//get success story    
		$this->data['success_story'] = $this->member_model->get_success_story();     

		$this->load->view('/templates/asian/splash', $this->data);   
	}  
	
}   
/* End of file home.php */   
/* Location: ./application/controllers/home.php */  
