<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of search
 *
 * @author 
 */
class Advancesearch extends CI_Controller
{

    var $data = array();

    public function __construct()
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
        $this->lang->load('_search', 'english');
        $this->lang->load('_forms_locations', $this->config->item('language'));
        //$this->lang->load('base', 'english');

        $this->lang->load('_header_navigation', $this->config->item('language'));
        $this->lang->load('_splash', $this->config->item('language'));
        $this->lang->load('_forms', $this->config->item('language'));
        $this->lang->load('_footer', $this->config->item('language'));
        $this->load->model('format_model');
        $this->load->model('member_model');
        $this->load->model('advancesearch_model');

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
    }

    public function index()
    {
      	$search = array( 
            'looking_for' => $this->input->post('looking_for'),
            'min_age' => ($this->input->post('min_age')) ? $this->input->post('min_age') : 18,
            'max_age' => ($this->input->post('max_age')) ? $this->input->post('max_age') : 99,
            'country' => ($this->input->post('country')) ? $this->input->post('country') : NULL,
            'state_province' => $this->input->post('state_province'),
            'have_pic' => $this->input->post('have_pic'),
        );
        $search_result = $this->member_model->search($search);

        $this->data['search_result'] = count($search_result);
        
        if (is_array($search_result) && count($search_result) > 0)
        {
            foreach ($search_result as $srkey => $srvalue)
            {
                //print_r($this->member_model->get_profile_by_id($srvalue['user_id']));      
                $found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
            }
            //print_r($found_users);    
        }
		
		$this->data['height'] = array(
			'name'  => 'height',
			'value' => $this->data['height_range'],
			'id' => 'match_height-slider',
			'class' => 'form-control',
		);		
		$this->data['weight'] = array(
			'name'  => 'weight',
			'value' => $this->data['weight_range'],
			'id' => 'match_weight-slider',
			'class' => 'form-control',
		);		
        $this->data['found_users'] = @$found_users;
		$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
        $this->load->template('advancesearch', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
    }

}