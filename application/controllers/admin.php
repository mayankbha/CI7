<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('login');
		$this->load->helper('url');
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->lang->load('base', 'english');
		$this->lang->load('register', 'english');
		$this->lang->load('notices_emails', 'english');
		$this->session->set_userdata(array('current_template'=>'asian'));
	}

	function index()
	{
			$this->data=array();
			$this->data['logged']=check_login($this->session->userdata, 'admin');
			$this->load->admin_template('index', $this->data, $return = FALSE);	
	}
	
	function login ()
	{

			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			//$this->_render_page('auth/login', $this->data);
			$this->load->admin_template('login', $this->data, $return = FALSE);		
	}
	function manage_id ()
	{
			$this->data=array();
			$this->data['logged']=check_login($this->session->userdata, 'admin');	
			$this->load->admin_template('manage_id', $this->data, $return = FALSE);		
	}
	function pending ()
	{
		$this->data=array();
		$this->load->model('id_model');
		$this->data['pending']=$this->id_model->getPending();
		$this->load->iframe_template('pending', $this->data, $return = FALSE);		
	}
	function approved ()
	{
		$this->data=array();
		$this->load->model('id_model');
		$this->data['pending']=$this->id_model->getApproved();
		$this->load->iframe_template('approved', $this->data, $return = FALSE);		
	}	
	function approve_image ($id)
	{
		$this->load->model('id_model');
		$this->data=array();
		if(isset($_POST['approved'])){
			//echo 'xxx';
			$this->id_model->approve_image ($id);
		}
		$this->data['image']=$this->id_model->show_image ($id);
		//$this->data['pending']=$this->id_model->getPending();
		$this->load->iframe_template('approve_image', $this->data, $return = FALSE);		
	}	
	function logout()
	{
		$this->ion_auth->logout();
		redirect(base_url('admin'));
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
