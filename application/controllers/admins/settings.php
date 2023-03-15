<?php

class Settings extends CI_Controller
{
	
	private $data = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->helper('login');
		$this->load->helper('url');
		$this->load->database();
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->lang->load('auth');
		
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {   
		$this->popup_time();
    }
    
    public function popup_time()
    {
        $this->load->model('setting_model');
        $popup_time = $this->setting_model->get_popup_time();
        $this->data['popup_time'] = $popup_time['value'];

        $post = $this->input->post();
        if (!empty($post)) 
        {
            $this->form_validation->set_rules('timer', 'Product Title', 'required|integer');
            if ($this->form_validation->run() == TRUE) 
            {
                if($this->setting_model->update_popup_time($post['timer'])) {
                    $message = 'Detail updated Successfully';
                    $type = 'success';
                }else {
                    $message = 'unable to updated.';
                    $type = 'danger';
                }

                $this->session->set_flashdata('message', $message);
                redirect(base_url('admins/settings/popup_time'));
            }
        }
        //echo "<pre>"; print_r($this->data); die;
        $this->load->admin_template('popup_time', $this->data, $return = FALSE);      
    }
}
