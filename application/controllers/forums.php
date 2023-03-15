<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forums extends CI_Controller {

	function __construct()
	{
	
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		//$this->load->library('session');
		
		//print_r($this->session->userdata);die;
		
		$this->load->helper('login');
		$this->load->database();
		$this->lang->load('auth');
		$this->load->helper('language');
		
		$this->lang->load('_header_navigation', $this->config->item('language'));
		$this->lang->load('_splash', $this->config->item('language'));
		$this->lang->load('_forms', $this->config->item('language'));
		$this->lang->load('_footer', $this->config->item('language'));
		
		$this->load->model('format_model');
		$this->load->model('member_model');
		$this->load->model('forum_model');
		$this->session->set_userdata(array('current_template'=>'asian'));
		
		//$this->data['logged'] = check_login($this->session->userdata, 'member');
		//$this->forum_model->track_forum_user();
		//$this->forum_model->save_history();
		if(isset($this->session->userdata['user_id']))
		{
			$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
			//fetch login user list   
			$this->data['login_user'] = $this->member_model->login_user();
			
			foreach($this->data['login_user'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
				$this->data['users'][$value['id']]['busy_status'] = $this->member_model->get_login_busystatus($value['id']);//login busy status
				$this->data['users'][$value['id']]['available_status'] = $this->member_model->get_login_availablestatus($value['id']);//login available status 
				$this->data['users'][$value['id']]['invisible_status'] = $this->member_model->get_login_invisiblestatus($value['id']);//login invisible status
			}
		//end login user list
		}
		
		$this->data['title'] = 'Dumpflings - forum';
	}

	function index()
	{
			$this->data['groups'] = $this->forum_model->get_forum_group_list();
			$this->data['forums'] = $this->forum_model->get_forums_list();
			$this->data['history'] = $this->forum_model->get_history();
			$this->data['forum_statistics']['threads'] = $this->forum_model->get_thread_count();
			$this->data['forum_statistics']['posts'] = $this->forum_model->get_post_count();
			$this->data['forum_statistics']['members'] = $this->member_model->get_member_count();
			$this->data['forum_statistics']['newest_member'] = $this->member_model->get_newest_member();
			$this->data['top_users'] =  $this->forum_model->get_top_posters();
			
			foreach($this->data['top_users'] as $tukey => $tuvalue){
				// get thread user data
				$this->data['users'][$tuvalue['user_id']] = $this->member_model->get_poster_data($tuvalue['user_id']);
				$this->data['users'][$tuvalue['user_id']]['avatar'] = $this->member_model->get_active_avatar($tuvalue['user_id']);
				$this->data['users'][$tuvalue['user_id']]['thanks'] = $this->forum_model->get_thanks_count($tuvalue['user_id']);
			}
		//$this->load->view('templates/asian/forum');
		$this->load->template('forum', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */