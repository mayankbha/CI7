<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends MY_Controller {

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
		$this->load->model('mail_model');
		$this->session->set_userdata(array('current_template'=>'asian'));
		$this->data['logged'] = check_login($this->session->userdata, 'member');
		
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

		$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
		
		/*foreach($this->data['login_user'] as $value)
		{
			// get thread user data
			$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
		}
		//end login user list*/

	}

	function index()
	{
			if(isset($_POST))
			{
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item']))
				{
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue)
					{
						$this->mail_model->inbox_move_to_trash($cmvalue);
					}
					redirect('/mail/', 'refresh');
					//$this->data['inbox_count']=$this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}
			$offset = 0;
			$page_limit = 15;
			$this->data['inbox'] = $this->mail_model->get_inbox($page_limit, $offset);
			
			$this->data['inbox_count'] = $this->mail_model->get_inbox_count();
			$this->data['page'] = 15;
			$this->data['back'] = null;
			if($this->data['inbox_count']>$page_limit)
			{
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);			
			$this->data['title'] = 'Dumpflings - mail';
			
			$this->load->template('mail', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function page($page = NULL)
	{
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}			
			$this->data['inbox'] = $this->mail_model->get_inbox($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_inbox_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit)
			{
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);			
			$this->load->template('mail', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	
	
	
	//favorite old 30sept
	/*function favorites($page = NULL)
	{
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}
			$this->data['inbox'] = $this->mail_model->get_favorites($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_favorites_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);			
			$this->load->template('mail_favorites', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	*/

	function favorites($page = NULL)
	{
			if(isset($_POST))
			{
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item'])){
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue){
						$this->mail_model->inbox_move_to_trash($cmvalue);
					}
					redirect('/mail/favorites', 'refresh');
					//$this->data['inbox_count'] = $this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}	
			
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}
			$this->data['inbox'] = $this->mail_model->get_favorites($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_favorites_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);			
			$this->load->template('mail_favorites', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	

	function sent($page = NULL)
	{
			if(isset($_POST)){
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item'])){
				
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue){
						$this->mail_model->outbox_move_to_trash($cmvalue);
					}
					redirect('/mail/sent', 'refresh');
					//$this->data['inbox_count'] = $this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}	
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}			
			$this->data['inbox'] = $this->mail_model->get_outbox($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_outbox_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count']>$page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);		
			$this->load->template('mail_sent', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function compose($to = null)
	{
		$side_data['count'] = $this->mail_model->get_unread_count(); 
		$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);	
		$this->data['to'] = $to; 
		$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js','',TRUE);	
		$side_data['count'] = $this->mail_model->get_unread_count();
		$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);		
		$this->load->template('mail_compose', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function send()
	{
		if(isset($_POST['selected_recepients'])){
			$recepients = explode(',', $_POST['selected_recepients']);
			foreach($recepients as $rvalue){
				$new_recipients[$rvalue] = $rvalue;
			}
			foreach($new_recipients as $userid)
			{
				$this->mail_model->save_send_message($userid, $_POST['subject'], $_POST['content']); //for inbox
				// for outbox
				$this->mail_model->save_sent_message($userid, $_POST['subject'], $_POST['content']);  
				$this->session->userdata['message'] = 'Message Sent';
			}
		}
		redirect('/mail/', 'refresh');
	}
	
	
	/*
	old backup
	function view_email ($mail_id = null){

		$this->data['mail_data']	= $this->mail_model->get_inbox_by_id($mail_id);
		$this->data['sender_data']	= $this->member_model->get_profile_by_id2($this->data['mail_data']['from_user_id']);
		
		$this->data['avatar']		= $this->member_model->get_active_avatar($this->data['mail_data']['from_user_id']);
		$this->mail_model->inbox_read($mail_id);
		$side_data['count']			= $this->mail_model->get_unread_count();
		
		$this->data['mail_id'] 			= $mail_id;
		$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
		$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);				
		$this->load->template('mail_view_inbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	*/
	
	
	
	
	
	//bkup15sepmon
	
	/*function view_email ($mail_id = null,$from_user_id,$to_user_id,$subject){

		$to_user_id = $this->session->userdata['user_id'];
		//echo $sub;die;
		$this->data['all_mail_data']	= $this->mail_model->get_inbox_msg($to_user_id);

		$sub = urldecode($subject);
		//echo $sub;die;
		$this->data['mail_data']	= $this->mail_model->get_inbox_by_id($from_user_id,$to_user_id,$sub);
		
		foreach($this->data['mail_data'] as $mail_data)
		{
			
			$this->data['sender_data']	= $this->member_model->get_profile_by_id2($mail_data['from_user_id']);
			
			$this->data['avatar']		= $this->member_model->get_active_avatar($mail_data['from_user_id']);
		}
		//echo "<pre>";print_r($this->data['sender_data']);die;
		$this->mail_model->inbox_read($mail_id);
		$side_data['count']			= $this->mail_model->get_unread_count();
		
		$this->data['mail_id'] 			= $mail_id;
		$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
		$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);				
		$this->load->template('mail_view_inbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	*/
	
	
	function view_email ($mail_id = null,$from_user_id,$to_user_id,$subject){
		$to_user_id = $this->session->userdata['user_id'];
		$this->data['all_mail_data']	= $this->mail_model->get_inbox_msg($to_user_id);
		$sub = urldecode($subject);
		
		$this->data['mail_data']	= $this->mail_model->get_inbox_by_id($from_user_id,$to_user_id,$sub);
		
		if(empty($this->data['mail_data']))
		{
			redirect('/mail/next_mail/'.$mail_id); 
		}else
		{
			foreach($this->data['mail_data'] as $mail_data)
			{
				$this->data['sender_data']	= $this->member_model->get_profile_by_id2($mail_data['from_user_id']);
				$this->data['avatar']		= $this->member_model->get_active_avatar($mail_data['from_user_id']);
			}
			$this->mail_model->inbox_read($mail_id);
			$side_data['count']				= $this->mail_model->get_unread_count();
			
			$this->data['mail_id'] 			= $mail_id;
			
			//block user list
			$this->data['block_user'] = $this->member_model->get_block_user_data();
			
			$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);
			$this->load->template('mail_view_inbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}
	}
	
	function previous_mail ($mail_id = null)
	{
		$mail_data	= $this->mail_model->get_previous_msg($mail_id);
		if(empty($mail_data))
		{
			redirect('/mail');
		}else{
			redirect('/mail/previous_view_email/'.$mail_data['id'].'/'.$mail_data['from_user_id'].'/'.$mail_data['to_user_id'].'/'.$mail_data['subject']);
		}
	}
	
	function next_mail($mail_id = null)
	{
		$mail_data	= $this->mail_model->get_next_msg($mail_id);
		if(empty($mail_data))
		{
			redirect('/mail');
		}else{
			redirect('/mail/view_email/'.$mail_data['id'].'/'.$mail_data['from_user_id'].'/'.$mail_data['to_user_id'].'/'.$mail_data['subject']);
		}
		
	}
	
	////////////////////////////
	function previous_view_email($mail_id = null,$from_user_id,$to_user_id,$subject)
	{
		$to_user_id = $this->session->userdata['user_id'];
		$this->data['all_mail_data']	= $this->mail_model->get_inbox_msg($to_user_id);
		$sub = urldecode($subject);
		
		$this->data['mail_data']	= $this->mail_model->get_inbox_by_id($from_user_id,$to_user_id,$sub);
		
		if(empty($this->data['mail_data']))
		{
			redirect('/mail/previous_mail/'.$mail_id);
		}else
		{
			foreach($this->data['mail_data'] as $mail_data)
			{
				$this->data['sender_data']	= $this->member_model->get_profile_by_id2($mail_data['from_user_id']);
				$this->data['avatar']		= $this->member_model->get_active_avatar($mail_data['from_user_id']);
			}
			$this->mail_model->inbox_read($mail_id);
			$side_data['count']				= $this->mail_model->get_unread_count();
			
			$this->data['mail_id'] 			= $mail_id;
			$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);
			$this->load->template('mail_view_inbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}
	}
	/////////////////////////////
	
	
	/*
	old
	function view_sent_mail ($mail_id = null)
	{
		$this->data['mail_data'] = $this->mail_model->get_outbox_by_id($mail_id);
		$this->data['sender_data'] = $this->member_model->get_profile_by_id($this->data['id']);
		$side_data['count'] = $this->mail_model->get_unread_count();
		$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);		
		$this->load->template('mail_view_outbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}*/
	
	function view_sent_mail ($mail_id = null,$from_user_id,$to_user_id,$subject)
	{
	
		$sub = urldecode($subject);
		$this->data['all_mail_data']	= $this->mail_model->get_outbox_by_id($mail_id);
		$this->data['mail_data']		= $this->mail_model->get_sentmsg($from_user_id,$to_user_id,$sub);
			
		$this->mail_model->inbox_read($mail_id);
		
		$side_data['count']			= $this->mail_model->get_unread_count();
		$this->data['mail_id'] 			= $mail_id;
		$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
		$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);
		$this->load->template('mail_view_outbox', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	
	/*
	move function
	function trash ($page = NULL)
	{
			if(isset($_POST)){
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item'])){
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue){
						//$this->mail_model->outbox_move_to_trash($cmvalue);
					}
					redirect('/mail/sent', 'refresh');
					//$this->data['inbox_count'] = $this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}	
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}			
			$this->data['inbox'] = $this->mail_model->get_trash_inbox($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_trash_inbox_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);		
			$this->load->template('mail_sent', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	*/
	
	function trash ($page = NULL)
	{
			if(isset($_POST)){
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item'])){
					//print_r($_POST['checked_mail_item']);
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue){
						$this->mail_model->outbox_move_to_trash($cmvalue);
					}
					redirect('/mail/trash', 'refresh');
					//$this->data['inbox_count'] = $this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}	
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}			
			$this->data['inbox'] = $this->mail_model->get_trash_inbox($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_trash_inbox_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);		
			$this->load->template('mail_trash', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	
	
	
	//move to trash
	function delete_inbox_msg($mail_id)
	{
		$this->mail_model->inbox_move_to_trash($mail_id);
		redirect('/mail/', 'refresh');
	}
	
	//send reply mail
	function send_reply()
	{
		// add into inbox
		$this->mail_model->save_reply_message($_POST['to_user_id'], $_POST['subject'], $_POST['content']);
		//add into sent box
		$this->mail_model->save_sent_message($_POST['to_user_id'], $_POST['subject'], $_POST['content']);
		redirect('/mail/', 'refresh');
	}
	
	function spam ($page = NULL)
	{
			if(isset($_POST))
			{
				if(isset($_POST['checked_mail_item'])&&is_array($_POST['checked_mail_item'])){
					foreach($_POST['checked_mail_item'] as $cmkey=>$cmvalue){
						$this->mail_model->inbox_move_to_trash($cmvalue);
					}
					redirect('/mail/spam', 'refresh');
					//$this->data['inbox_count'] = $this->mail_model->inbox_move_to_trash($_POST['checked_mail_item']);
				}
			}	
			$page_limit = 15;
			$offset = $page*$page_limit-1;
			if($offset < 0){
				$offset = 0;
			}			
			$this->data['inbox'] = $this->mail_model->get_spam_inbox($page_limit, $offset);
			$this->data['inbox_count'] = $this->mail_model->get_spam_inbox_count();
			$this->data['page'] = 1;
			$this->data['back'] = null;
			if($this->data['inbox_count'] > $page_limit){
				$this->data['next'] = true;
			} else {
				$this->data['next'] = null;
			}
			$side_data['count'] = $this->mail_model->get_unread_count();
			$this->data['side_navigation'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);		
			$this->load->template('mail_spam', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}	
	
	//move to spam box
	function move_to_spam($mail_id)
	{
		$this->mail_model->inbox_move_to_spam($mail_id);
		redirect('/mail/', 'refresh');
	}
	
	//view favorite mail
	function view_favorite_email ($mail_id = null,$from_user_id,$to_user_id,$subject)
	{
		$to_user_id = $this->session->userdata['user_id'];
		$this->data['all_mail_data']	= $this->mail_model->get_inbox_msg($to_user_id);
		$sub = urldecode($subject);
		
		$this->data['mail_data']	= $this->mail_model->get_inbox_by_id($from_user_id,$to_user_id,$sub);
		
		if(empty($this->data['mail_data']))
		{
			redirect('/mail/next_mail/'.$mail_id);
		}else
		{
			foreach($this->data['mail_data'] as $mail_data)
			{
				$this->data['sender_data']	= $this->member_model->get_profile_by_id2($mail_data['from_user_id']);
				$this->data['avatar']		= $this->member_model->get_active_avatar($mail_data['from_user_id']);
			}
			$this->mail_model->inbox_read($mail_id);
			$side_data['count']				= $this->mail_model->get_unread_count();
			$this->data['mail_id'] 			= $mail_id;
			$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);
			$this->load->template('mail_view_favorite', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}
	}
	
	function view_spam_email($mail_id = null,$from_user_id,$to_user_id,$subject)
	{
		$to_user_id = $this->session->userdata['user_id'];
		$this->data['all_mail_data']	= $this->mail_model->get_spam_msg($to_user_id);
		$sub = urldecode($subject);
		
		$this->data['mail_data']		= $this->mail_model->get_inbox_by_id($from_user_id,$to_user_id,$sub);
		if(empty($this->data['mail_data']))
		{
			redirect('/mail/next_mail/'.$mail_id); 
		}else
		{
			$this->mail_model->inbox_read($mail_id);
			$side_data['count']				= $this->mail_model->get_unread_count();
			$this->data['mail_id'] 			= $mail_id;
			$this->data['side_navigation'] 	= $this->load->view('templates/'.$this->session->userdata['current_template'].'/mail_side_nav', $side_data, TRUE);
			$this->data['template_footer']['mail_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/mail_footer_js', '', TRUE);
			$this->load->template('mail_view_spam', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}
	}
	
	function unblock_user($from_user_id)
	{
		$this->mail_model->delete_block_user($from_user_id);
		redirect($_SERVER['HTTP_REFERER'], 'refresh');
	}
}