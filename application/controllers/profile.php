<?php if(!defined('BASEPATH')) exit('No direct script access allowed');   

class Profile extends MY_Controller  
{
	function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('login');
        $this->load->database();
        $this->lang->load('auth');
        $this->load->helper('language');
        $this->lang->load('_search', 'english');
        $this->lang->load('_forms_locations', $this->config->item('language'));
        //$this->lang->load('base', 'english');    
		
        $this->lang->load('_header_navigation', $this->config->item('language'));   
        $this->lang->load('_splash', $this->config->item('language'));    
        $this->lang->load('_forms', $this->config->item('language'));   
        $this->lang->load('_footer', $this->config->item('language'));   
        $this->load->model('format_model');
        $this->load->model('member_model');
		
		if(isset($this->session->userdata['user_id']))
		{
			//get online users count and age dropdown between age for who's online popup'
			$this->data['age_arr'] = $this->onlineusers->getUsersBetweenAge();

			//get online users count(male and female) for who's online popup'
			$this->data['online_users_arr'] = $this->onlineusers->getOnlineUsersCount();

			//fetch login user list
			$this->data['login_user'] = $this->member_model->login_user();

			foreach($this->data['login_user'] as $value)
			{
				//get thread user data for payment
				//$this->data['users'][$value['id']] = $this->member_model->get_poster_data($value['id']);
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
				$this->data['users'][$value['id']]['busy_status'] = $this->member_model->get_login_busystatus($value['id']);//login busy status
				$this->data['users'][$value['id']]['available_status'] = $this->member_model->get_login_availablestatus($value['id']);//login available status 
				$this->data['users'][$value['id']]['invisible_status'] = $this->member_model->get_login_invisiblestatus($value['id']);//login invisible status
				$this->data['users']['donate_user']	= $this->member_model->donate_user($this->session->userdata['user_id']);
			}
		}

        $current_template = 'asian';

        $this->session->set_userdata(array('current_template' => 'asian'));

        if(!$this->ion_auth->logged_in()) {
			$this->data['logged']	=	check_login($this->session->userdata, 'member');
		}

		$this->data['donate_user']	=	$this->member_model->donate_user($this->session->userdata['user_id']);
		$this->data['title'] = "Dumpflings - Profile ";
	}

    function index()
    {
        $data = array();
        $this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
		
		foreach($this->data['profile'] as $value)
			{
				//get thread user profile pic
				$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
			}
		
		
        //Prepare search form data
        $this->data['looking_for'] = array(
            'name' => 'looking_for',
            'value' => $this->session->userdata('looking_for'),
            'options' => $this->lang->language['gender'],
            'form_options' => 'id="looking_for" class="form-control"',
        );
		$this->data['countries'] = $this->lang->line('reg_countries_options');
		
		//count
		$this->data['send_heart'] = $this->member_model->count_heart($this->session->userdata['user_id']);
		$this->data['send_like'] = $this->member_model->count_like($this->session->userdata['user_id']);
		$this->data['count_fav_members'] = count($this->member_model->fav_member_list($this->session->userdata['user_id']));
		//$this->data['count_warning_message'] = count($this->member_model->warning_message_list($this->session->userdata['user_id']));
		
		$this->data['count_warning_message'] = $this->member_model->warning_message_list($this->session->userdata['user_id']);
	
		//$this->data['warning_message'] = $this->member_model->count_warning_message($this->session->userdata['user_id']);
		
		//like_member_list on popup
		$this->data['like_member_list'] = $this->member_model->get_like_member_list($this->session->userdata['user_id']);
		foreach($this->data['like_member_list'] as $value)
			{
				//get thread user profile pic
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);       
			}
			
		//sent heart member list
		$this->data['heart_member_list'] = $this->member_model->get_heart_member_list($this->session->userdata['user_id']);
		foreach($this->data['heart_member_list'] as $value)  
			{
				//get thread user profile pic
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']); 
			}
			
		// favourite people list
		$this->data['fav_member_list'] = $this->member_model->fav_member_list($this->session->userdata['user_id']);
		foreach($this->data['fav_member_list'] as $value)
			{
				//get thread user profile pic
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
			}
				
		//profile completness 
					$maximumPoints  = 100;
					$point = $this->member_model->profile_complete(); //get points of user data except profile pic
					
					$this->data['profile_pic'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']); //get profile pic completeness point (5)
					if($this->data['profile_pic'] != '')
						{
							$point += 14;
						}
					
					$this->data['profile_complete'] = ($point * $maximumPoints)/100; //percentage
		//End profile completness 
		
		/////////////////*********Remaining compleness***********//
		
		$this->data['match'] = $this->member_model->get_match_comp();
		$this->data['profile_comp'] = $this->member_model->get_profile_comp();
		$this->data['photo'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
		$this->data['profile_verify'] = $this->member_model->get_profileverify_submitted_ids();
		$this->data['interest'] = $this->member_model->get_user_interest();
		$this->data['questions'] = $this->member_model->get_questions_comp();
		$this->data['get_personality_comp'] = $this->member_model->get_personality_comp();
		
		/////////////////********************//
		//get looking for gender
			$this->data['getlooking_for'] = $this->member_model->get_looking_for();	
		//get login status
		$this->data['login_status'] = $this->member_model->get_login_status();
		//print_r($this->data['login_status']);die;
		$this->load->template('profile', $this->session->userdata['current_template'], $this->data, $return = FALSE);
    }

    function user($id = null)
    {
        $data = array();
        if(isset($id))
        {
			$this->data['allTabsData'] = $this->member_model->gedtAllTabsData($id);
			$this->data['id']			= $id;
            $this->data['profile']		= $this->member_model->get_profile_by_id2($id);
            
			$this->data['main_avatar']	= $this->member_model->get_active_avatar($id);
            $this->data['avatars']		= $this->member_model->get_non_active_avatars($id);
            $this->data['session']		= $this->session->userdata;
            $this->data['viewer_match']	= $this->member_model->get_profile_by_id2($this->session->userdata['user_id']);

			//options
			/*$this->data['count_send_like'] = $this->member_model->count_send_like($id);*/
			//end options
			//print_r($this->data['profile']);die;
		  
            $this->load->template('profile_users', $this->session->userdata['current_template'],$this->data, $return = FALSE);       
        } else 
        {
		   /* $this->data['profile']	= $this->userdata;                 
            $this->data['session'] 		= $this->session->userdata['current_template'], $this->data, $return = FALSE);     
			*/
			$this->data['profile']	= $this->member_model->get_profile($this->session->userdata['email']);
            $this->data['session']	= $this->session->userdata;
            $this->load->template('profile', $this->session->userdata['current_template'], $this->data, $return = FALSE);
		}
	}
	
	//message
	function message_old()
	{
		//warning message list
		$this->data['warning_message_list'] = $this->member_model->warning_message_list($this->session->userdata['user_id']);
		foreach($this->data['warning_message_list'] as $value)
			{
				//get thread user profile pic
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
			}
		$this->load->template('messageView', $this->session->userdata['current_template'], $this->data, $return = FALSE);
	}
	
	function message()
	{
	 $this->load->template('msgview', $this->session->userdata['current_template'],$this->data, $return = FALSE);
	}

	function get_all()
	{
        $post = $this->input->post();
        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
       // $sort = isset($post["sort"]) ? $post["sort"] : array(array('`u`'.'`.id`', "desc"),array('`u`'.'`.first_name`',"asc"));
		$sort = isset($post["sort"]) ? $post["sort"] : array(array('`u`'.'`.id`', "desc"));
        $filter = isset($post["filter"]) ? $post["filter"] : array('`u`'.'`.id`' => "",);
       	$data = array(
            'currentPage'	=> 1,
            'totalRows'		=> count($this->member_model->warning_message_list($this->session->userdata['user_id'])),
		   //'totalRows'	=> count($this->member_model->warning_message_list_data($filter, $sort, $current_page, $per_page, $this->session->userdata['user_id'])),
            'perPage' 		=> $per_page,
            'sort' 			=> $sort,
            'filter' 		=> $filter,
            'currentPage' 	=> $current_page,
            'data' 			=> array(),
            'posted' 		=> $post
        );
		
		$user = $this->member_model->warning_message_list_data($filter, $sort, $current_page, $per_page, $this->session->userdata['user_id']);
		
        $data['data'] = $user['data'];
        //$data['totalRows'] = $user['totalRows'];
		$data['totalRows'] = count($user['data']);
		
		$this->load->view('json_view', array('data' => $data));
    }

	public function login_status()
	{
		$status = $_REQUEST['login_status'];
		$this->member_model->login_status($status);
	}

	public function getOnlineUsersCount() {
		$online_users_arr = $this->data['online_users_arr'] = $this->onlineusers->getOnlineUsersCount();
		echo "Who is online? ". $online_users_arr['male_count']." male ".$online_users_arr['female_count']." female ";
	}

	public function getOnlineUsers() {
		$this->data['login_user'] = $this->onlineusers->getOnlineUsers();

		foreach($this->data['login_user'] as $value) {
			$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
			$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
			$this->data['users'][$value['id']]['busy_status'] = $this->member_model->get_login_busystatus($value['id']);//login busy status
			$this->data['users'][$value['id']]['available_status'] = $this->member_model->get_login_availablestatus($value['id']);//login available status
			$this->data['users'][$value['id']]['invisible_status'] = $this->member_model->get_login_invisiblestatus($value['id']);//login invisible status
			$this->data['users']['donate_user']	= $this->member_model->donate_user($this->session->userdata['user_id']);
		}

		$login_user = $this->load->view('templates/asian/login_users_list', $this->data, true);
		print_r($login_user);
	}

}