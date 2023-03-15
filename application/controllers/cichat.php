<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cichat extends CI_Controller {

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
        $this->load->model('format_model');
        $this->load->model('member_model');
        
        $current_template = 'asian';
        $this->session->set_userdata(array('current_template' => 'asian'));
        if (!$this->ion_auth->logged_in())
        {
            $this->data['logged'] = check_login($this->session->userdata, 'member');
        }
		 $this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
    }
	
	public function index()
	{
		//$this->load->view('startChat');
		
	$this->load->template('startChat', $this->session->userdata['current_template'], $this->data, $return = FALSE);
		
	}
	
	function chat($me, $you)
    {
        $this->data['me'] = $me;
        $this->data['you'] = $you;
		
		$this->load->template('chatty', $this->session->userdata['current_template'], $this->data, $return = FALSE);
        //$this->load->view('chatty', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
