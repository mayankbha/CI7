<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Forum extends CI_Controller {
class Forum extends MY_Controller {

	function __construct()
	{
		
		parent::__construct();
		$this->load->library('ion_auth');  
		$this->load->library('form_validation'); 
		$this->load->helper('url');
		$this->load->library('session'); 
		$this->load->helper('login');	 	
		$this->load->database();  
		$this->lang->load('auth');  
		$this->load->helper('language'); 
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
		$this->data['logged'] = check_login($this->session->userdata, 'member');
		$this->forum_model->track_forum_user();
		$this->forum_model->save_history();
		
		
		
		if(isset($this->session->userdata['user_id']))
		{
			$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
			//fetch login user list   
			$this->data['login_user'] = $this->member_model->login_user();
			
			foreach($this->data['login_user'] as $value)
			{
				// get thread user data  
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
			$this->data['top_users'] = $this->forum_model->get_top_posters();
			
			foreach($this->data['top_users'] as $tukey=>$tuvalue){
				// get thread user data   
				$this->data['users'][$tuvalue['user_id']] =  $this->member_model->get_poster_data($tuvalue['user_id']);
				$this->data['users'][$tuvalue['user_id']]['avatar'] = $this->member_model->get_active_avatar($tuvalue['user_id']);
				$this->data['users'][$tuvalue['user_id']]['thanks'] = $this->forum_model->get_thanks_count($tuvalue['user_id']);
			}
			
			$this->load->template('forum', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function thanks ()
	{
		if(isset($_POST['id'])){
			echo $this->forum_model->say_thanks($_POST['id']);
		}
	}
	
	function main($forum_id = null)
	{
		
		$this->data['forum'] = $this->forum_model->get_forum_data($forum_id);
		$this->data['thread'] = $this->forum_model->get_thread_title_list($forum_id);
		foreach($this->data['thread'] as $ttkey => $ttvalue)
		{
			$this->data['users'][$ttvalue['user_id']] = $this->member_model->get_profile_name_by_id($ttvalue['user_id']);
		}
		
		$this->data['top_users'] = $this->forum_model->get_top_posters();
		foreach($this->data['top_users'] as $tukey => $tuvalue){
			// get thread user data
			$this->data['users'][$tuvalue['user_id']] = $this->member_model->get_poster_data($tuvalue['user_id']);
			$this->data['users'][$tuvalue['user_id']]['avatar'] = $this->member_model->get_active_avatar($tuvalue['user_id']);
			$this->data['users'][$tuvalue['user_id']]['thanks'] = $this->forum_model->get_thanks_count($tuvalue['user_id']);
		}			
		//$this->data['forums'] = $this->forum_model->get_forums_list();
		//$this->load->template('forum_sub', $this->session->userdata['current_template'],$this->data, $return = FALSE);	
		$this->load->template('forum_sub', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}

	
	function compose($id = null)
	{
		//print_r($_POST);
		$this->data['id'] = @$id;
		if(isset($_POST['title']))
		{
			$this->forum_model->new_thread($_POST['title'], $_POST['content_body'], $_POST['forum_id']);
			redirect('/forum/main/'.$_POST['forum_id'], 'refresh');
		}
		$this->load->template('forum_compose', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	
	
	
	function thread($thread_id = null)
	{
		//show js for thanks
		$this->data['active_forum_thanks']=1;
		//get thread data
		$this->data['thread_id'] = @$id;
		$this->data['thread'] = $this->forum_model->get_thread_title($thread_id);
		//get forum data
		$this->data['forum'] = $this->forum_model->get_forum_data($this->data['thread']['forum_id']);
		// get thread creator data
		$this->data['users'][$this->data['thread']['user_id']] = $this->member_model->get_poster_data($this->data['thread']['user_id']);
		$this->data['users'][$this->data['thread']['user_id']]['avatar'] = $this->member_model->get_active_avatar($this->data['thread']['user_id']);
		//get posts
		$this->data['posts'] = $this->forum_model->get_thread_posts($thread_id);
		//get posters data
		foreach($this->data['posts'] as $pkey=>$pvalue){
		// get thread creator data   
		$this->data['users'][$pvalue['user_id']] = $this->member_model->get_poster_data($pvalue['user_id']);
		$this->data['users'][$pvalue['user_id']]['avatar'] = $this->member_model->get_active_avatar($pvalue['user_id']);
		}
		//top users   
		$this->data['top_users'] = $this->forum_model->get_top_posters();
		foreach($this->data['top_users'] as $tukey=>$tuvalue){
			// get thread user data   
			$this->data['users'][$tuvalue['user_id']] = $this->member_model->get_poster_data($tuvalue['user_id']);  
			$this->data['users'][$tuvalue['user_id']]['avatar'] = $this->member_model->get_active_avatar($tuvalue['user_id']);   
			$this->data['users'][$tuvalue['user_id']]['thanks'] = $this->forum_model->get_thanks_count($tuvalue['user_id']);    
		}	
		$this->data['thread']['formatted_date'] = date( 'd M Y H:iA', strtotime($this->data['thread']['date']));   
		$this->load->template('forum_thread', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	
	

	function thread_post($thread_id = null)
	{
		//new post  
		if(isset($_POST['reply_body'])) 
		{
			$this->forum_model->new_post($_POST['reply_body'], $_POST['thread_id']);    
			redirect('/forum/thread/'.$_POST['thread_id'], 'refresh'); 
			exit;
		}		
	}			

}