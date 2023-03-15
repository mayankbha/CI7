<?php

class Settings extends MY_Controller{

	/**
	 * Constructor 
	 * - loads the model 
	 */
	 
	function __construct()
	{
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
        $this->load->model('templatedata_model');
		$this->load->model('setting_model');
        $this->load->model('member_model');
        
        $current_template = 'asian';
        $this->session->set_userdata(array('current_template' => 'asian'));
        if (!$this->ion_auth->logged_in())
        {
            $this->data['logged'] = check_login($this->session->userdata, 'member');
        }
		
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
		
		$this->data['title'] = 'Dumpflings - manage templates';
	}
	
	/**
	 * Loads the default page for the XML example
	 * 
	 */
	public function index()
	{	
		$this->data['all_tempgroup'] = $this->templatedata_model->get_templateimage();
		
		$this->load->template('settingsView', $this->session->userdata['current_template'], $this->data, $return = FALSE);
			
	}
	
	public function add()
    {
		$post = $this->input->post();
		$user_id = $this->session->userdata['user_id'];
		$this->data['all_tempgroup'] = $this->templatedata_model->get_templateimage();
        $add_id = $this->setting_model->add_template($post,$user_id);
		if (is_int($add_id)) 
		{
			$message = 'templates added Successfully';
			$this->session->set_flashdata('message', array(
				'message' => $message,
				'type' => 'success'   
			));
			redirect(base_url('settings/set_template'));
			die();
		}
	}
		
	
	public function set_template()
	{ 
		$user_id = $this->session->userdata['user_id']; 
		
		$this->data['all_tempgroup']	= $this->templatedata_model->get_templateimage(); 
		$this->data['temp_image']		= $this->setting_model->get_template_image($user_id); 
		
		$this->load->template('settingsView',$this->session->userdata['current_template'],$this->data,$return =  FALSE);  
	}
		

}
?>