<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('upload_model');
		$this->load->helper('form', 'url');
		$this->load->database();
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->lang->load('base', 'english');
		$this->lang->load('register', 'english');
		$this->lang->load('notices_emails', 'english');
		$this->session->set_userdata(array('current_template'=>'asian'));
		
		//fetch login user list
		$this->data['login_user'] = $this->member_model->login_user();
		
		foreach($this->data['login_user'] as $value)
		{
			// get thread user data
			$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
			$this->data['users'][$value['id']]['block_user'] = $this->mail_model->get_block_user_data($value['id']);//block user list
			//$this->data['users_pic'] = $this->member_model->get_profile_pic($value['id']);
		}
		//end login user list
		
	}

	function index()
	{
		
     echo 'test';
	}
	function image_upload_frame(){
	//echo "dasdasd";
		
		$this->load->view('templates/admin/image_upload_frame', $vars, $return);
	}
	
	function upload_id() {
		$config['upload_path'] = 'D:/allsites/dating.dev/template/asian/id';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '500';
		$config['max_width']  = '2500';
		$config['overwrite']  = FALSE;
		$config['max_height']  = '2500';
		//$config['max_height']  = '2500';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		
		if ( ! $this->upload->do_upload('userfile'))
		{

			$data = array('error' => $this->upload->display_errors());
			//$this->load->view('upload_id_form', $error);
			//$data = array();
			//print_r($error);
			//$data['error']=$error;
			$this->load->template('upload_id_form', $this->session->userdata['current_template'],  $data, $return = FALSE);	
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			//print_r($data);
			$this->upload_model->save('1', $data['upload_data']['file_name']);
			$this->load->template('upload_id_success', $this->session->userdata['current_template'],  $data, $return = FALSE);	
		}		
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
