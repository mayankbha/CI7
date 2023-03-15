<? if(!define('BASEPATH')) exit('no direct script allow');
	
	class main_prf extends CI_Controller{
		
		function __construct()
			{
				parent::__construct();
				if ($this->form_validation->run() == true)
			{
				$this->load->model('registration_model', 'registration');
				$this->load->helper('email');
				$this->lang->load('notices_emails', 'english');
				
				$reg_username='';
				$reg_password='';
				$reg_email=$this->session->userdata['reg_form1']['email'];
				$reg_additional_data = array(
					'first_name'=>$this->session->userdata['reg_form1']['first_name'],
					'last_name'=>$this->session->userdata['reg_form1']['last_name'],
					'activation_code'=>$this->registration->generate_activation_code(),
					'active'=>'0',
				);
				if ($this->form_validation->run() == true)
			{
				$this->load->model('registration_model', 'registration');
				$this->load->helper('email');
				$this->lang->load('notices_emails', 'english');
				
				$reg_username='';
				$reg_password='';
				$reg_email=$this->session->userdata['reg_form1']['email'];
				$reg_additional_data = array(
					'first_name'=>$this->session->userdata['reg_form1']['first_name'],
					'last_name'=>$this->session->userdata['reg_form1']['last_name'],
					'activation_code'=>$this->registration->generate_activation_code(),
					'active'=>'0',
				);
				if ($this->form_validation->run() == true)
			{
				$this->load->model('registration_model', 'registration');
				$this->load->helper('email');
				$this->lang->load('notices_emails', 'english');
				
				$reg_username='';
				$reg_password='';
				$reg_email=$this->session->userdata['reg_form1']['email'];
				$reg_additional_data = array(
					'first_name'=>$this->session->userdata['reg_form1']['first_name'],
					'last_name'=>$this->session->userdata['reg_form1']['last_name'],
					'activation_code'=>$this->registration->generate_activation_code(),
					'active'=>'0',
				);
			}
		}
	  }
	}
}
?> 