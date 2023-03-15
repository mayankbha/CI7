<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct()
	{
		parent::__construct(); 
		$this->load->library('ion_auth');  
		$this->load->library('form_validation');
		$this->load->model('registration_model');
		$this->load->helper('url');
		$this->load->model('member_model');		
		
		$this->load->database() ;
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth') ;
		
		$this->load->helper('language');
		$this->lang->load('_footer', $this->config->item('language'));
		$this->lang->load('base', 'english');
		$this->lang->load('register', 'english');
		$this->lang->load('notices_emails', 'english');
		$this->lang->load('_forms_locations', $this->config->item('language'));
		$this->session->set_userdata(array('current_template' => 'asian'));
		
		
		
		//get newest member only for regiteration page
			$this->data['newest_member'] = array();
			
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
		
		
	}

	function index()
	{
		$this->data['title'] = $this->lang->line('reg_meta_title');
		$this->data['description'] = $this->lang->line('reg_meta_description');
		
		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]');
		//$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean');
		//$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required|xss_clean');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');
		//$this->form_validation->set_rules('city', 'city', 'required|xss_clean');
		$this->form_validation->set_rules('dob', 'date of birth', 'required|xss_clean');
		//$this->form_validation->set_rules('State/Province', 'state_province', 'required|xss_clean');
		$this->form_validation->set_rules('terms', 'Terms', 'required|xss_clean');
		$this->form_validation->set_rules('gender', 'gender', 'required');
		$this->form_validation->set_rules('countries', 'countries', 'required|xss_clean');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//print_r($_POST);die;
		if ($this->form_validation->run() == true)
		{
			$regArray = array('reg_form1' => $_POST, 'reg_status' => 'step2');
			$this->session->set_userdata($regArray);
			redirect("/register/step_2", 'refresh');
		}

		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'First Name',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Last Name',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Email',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['company'] = array(
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Company',
				'value' => $this->form_validation->set_value('company'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Phone',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'class'	=> 'form-control',
				'placeholder' => 'Password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'class'	=> 'form-control',
				'placeholder' => 'Password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);

			$this->data['gender'] = array(
				'name'  => 'gender',
				'id'    => 'gender',
				'type'  => 'radio',
				//'checked' => '',
				'value'=>'male',
			);
			if(isset($_POST['gender'])&&$_POST['gender'] == 'male'){
				$this->data['gender']['checked'] = 'checked';
			}			
			$this->data['gender2'] = array(
				'name'  => 'gender',
				'id'    => 'gender',
				'type'  => 'radio',
				//'checked' => '',   
				'value'=>'female',
			);
			if(isset($_POST['gender'])&&$_POST['gender']=='female'){
				$this->data['gender2']['checked']='checked';
			}
			$this->data['looking_for'] = array(
				'name'  => 'looking_for',
				'id'    => 'looking_for',
				'type'  => 'radio',
				//'checked' => '',  
				'value'=>'male',
			);
			if(isset($_POST['looking_for'])&&$_POST['looking_for']=='male'){
				$this->data['looking_for']['checked']='checked';
			}			
			$this->data['looking_for2'] = array(
				'name'  => 'looking_for',
				'id'    => 'looking_for',
				'type'  => 'radio',
				//'checked' => '',
				'value'=>'female',
			);		
			if(isset($_POST['looking_for'])&&$_POST['looking_for'] == 'female'){
				$this->data['looking_for2']['checked'] = 'checked';
			}					
			$this->data['dob'] = array(
				'name'  => 'dob',
				'id'  => 'datepicker',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Day of Birth',
				'value' => $this->form_validation->set_value('dob'),
				//'value' => '21-12-2013',
				
			);		
			/*$this->data['state_province'] = array(
				'name'  => 'state_province',   
				'id'    => 'state_province', 
				'type'  => 'text',
				'class'	=> 'form-control',   
				'placeholder' => 'State/Province',   
				'value' => $this->form_validation->set_value('state_province'),  
			);*/
			
			
			/*$this->data['city'] = array(           
				'name'  => 'city',         
				'id'    => 'city',       
				'type'  => 'text',         
				'class'	=> 'form-control',         
				'placeholder' => 'City',       
				'value' => $this->form_validation->set_value('city'),     
			);	*/			
			
			$this->data['terms'] = array(
				'name'  => 'terms',
				'id'    => 'terms',
				'type'  => 'checkbox',
				'value'=>'1',

			);	
			
			//$this->data['countries'] = $this->registration_model->get_country(); 
			
			$this->data['countries'] = $this->lang->line('reg_countries_options');
				/*$this->data['countries'] = array(
					'name'  => 'countries',
					'value' => $this->form_validation->set_value('countries'),
					'options'=> $this->lang->language['reg_countries_options'],
					'placeholder' => 'Country',
					'form_options'=> 'id="countries" class="form-control"',
				);	*/		
			
			$this->data['template_footer']['register_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/register_footer_js', '', TRUE);
			$this->load->template('register', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
		}
 		
		/*if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("auth", 'refresh');
		}*/
	}
	
	function step_2()
	{
		//print_r($_POST);die;
		//$regArray=array('reg_form1'=>$_POST, 'reg_status'=>'stepx');
		//$this->session->set_userdata($regArray);

		if(!isset($this->session->userdata['reg_status'])){
			//$regArray=array('reg_form2'=>$_POST, 'reg_status'=>'step3');
			//$this->session->set_userdata($regArray);			
			redirect("/register/", 'refresh');
		} elseif($this->session->userdata['reg_status'] == 'step3') {	
			redirect("/register/step3", 'refresh');
		} elseif($this->session->userdata['reg_status'] == 'step2') {
			$this->data['title'] = "Create User - Step 2";
			$this->data['reg_height'] = '250';
			if(isset($_POST['height'])){
				$this->data['reg_height'] = $_POST['height'];
			}		
			$this->data['reg_weight'] = '60';
			if(isset($_POST['weight'])) 
			{
				$this->data['reg_weight'] = $_POST['weight'];
			}
			//validate form input
			//$this->form_validation->set_rules('height', 'height', 'required|xss_clean');
			//$this->form_validation->set_rules('weight', 'weight', 'required|xss_clean');	
			//$this->form_validation->set_rules('relationship_your_looking_for', 'relationship_your_looking_for', 'required|xss_clean|min_length[1]');
			$expected_posts = array(
				'Hair Color'=>'hair_color',
				'Eye Color'=>'eye_color',
				'Height'=>'height',
				'Weight'=>'weight',
				'Body Type'=>'body_type',
				'Ethnicity'=>'ethnicity',
				'Appearance'=>'appearance',
				'Drink'=>'drink',
				'Smoke'=>'smoke',
				'Mental Status'=>'marital_status',
				'Terms2'=>'terms2',
				'Do you have children'=>'have_children',
				
				//'Do you want more children'=>'want_more_children',
				'Occupation'=>'occupation',
				'Willing to relocate'=>'willing_to_relocate',
				'Relationship your looking for'=>'relationship_your_looking_for',
				'Education'=>'education',
				'English ability'=>'english_ability',
				'Vietnamese ability'=>'vietnamese_ability',
				'Religion'=>'religion',
				'Chinese Sign'=>'chinese_sign',
				'Star Sign'=>'star_sign',
				'Your profile heading'=>'profile_head',
				'A little about yourself'=>'about_yourself',
				'What you\'re looking for in a partner'=>'looking_for_in_partner',		
			);
			foreach($expected_posts as $exp_key=>$exp_value){
				$this->form_validation->set_rules($exp_value, $exp_key, 'required|xss_clean');
				//echo "<br>$exp_key $exp_value";
			}

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

				$this->ion_auth->register(
						$this->session->userdata['reg_form1']['email'],  //username
						$this->session->userdata['reg_form1']['password'],  //password
						$this->session->userdata['reg_form1']['email'],  //email
						$reg_additional_data, 
						array('2') //group
						);
				$current_user_id=$this->member_model->get_id_by_email($this->session->userdata['reg_form1']['email']);
				//print_r($this->session->userdata['reg_form1']['dob']);die;
				//add other data
				$user_data = array(
					'user_id' => $current_user_id,
					'gender' => $this->session->userdata['reg_form1']['gender'],
					'looking_for' => $this->session->userdata['reg_form1']['looking_for'],
					'dob' => substr($this->session->userdata['reg_form1']['dob'], 6,4).'-'.substr($this->session->userdata['reg_form1']['dob'], 0,2).'-'.substr($this->session->userdata['reg_form1']['dob'], 3,2),
					'country' => $this->session->userdata['reg_form1']['countries'],
					'state_province' => $this->session->userdata['reg_form1']['state_province'],
					'city' => $this->session->userdata['reg_form1']['city'],
					'hair_color' => '',
					'eye_color' => '',
					'height' => '',
					'weight' => '',
					'body_type' => '',
					'ethnicity' => '',
					'appearance' => '',
					'drink' => '',
					'smoke' => '',
					'marital_status' => '',
					'have_children' => '',
					//'want_more_children'=>'',
					'occupation' => '',
					'willing_to_relocate' => '',
					'relationship_your_looking_for' => '',
					'nationality' => '',
					'education' => '',
					'english_ability' => '',
					'vietnamese_ability' => '',
					'religion' => '',
					'chinese_sign' => '',
					'star_sign' => '',					
				);

				$user_profile=array(
					'user_id'=>$current_user_id,
					'profile_head'=>'',
					'about_yourself'=>'',
					'looking_for_in_partner'=>'',
				);
				$_POST['relationship_your_looking_for'] = implode('|', $_POST['relationship_your_looking_for']);
				foreach($_POST as $pkey => $pvalue)
				{
					//print_r($pvalue);
					//$relationship_your_looking_for = implode('|', $_POST['relationship_your_looking_for']);
					if(isset($user_data[$pkey]))
					{
						$user_data[$pkey] = $pvalue;
					}
					if(isset($user_profile[$pkey]))
					{
						$user_profile[$pkey]=$pvalue;
					}					
				}
				//print_r($_POST['relationship_your_looking_for']);die;
				//update database 	
				$this->member_model->save_member_data('user_data', $user_data);
				$this->member_model->save_member_data('user_profile', $user_profile);
				
				//send mail
				$current_user=$this->ion_auth->user($id = NULL);
				send_email($this->session->userdata['reg_form1']['email'], $this->lang->line('registration_subject'), $this->lang->line('registration_content') . '<a href="http://www.dumpflings.com/register/activate/'.$current_user_id.'/'.$current_user->activation_code.'">[Activate]</a>');
				$xmessage=array('message'=>$this->lang->line('registration_notice'));
				$this->session->set_userdata($xmessage);
				redirect("/register/finish", 'refresh');
			}
			else
			{
				$this->form_validation->set_error_delimiters('<div class="error">', '</div>');			
				//display the create user form
				//set the flash data error message if there is one
				$this->data['reg1'] = $this->session->userdata;
				$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
				$this->data['hair_color'] = array(
					'name'  => 'hair_color',
					'value' => $this->form_validation->set_value('hair_color'),
					'options'=> $this->lang->line('reg_hair_color_options'),
					'form_options'=> 'id="hair_color" class="form-control"',
				);
				$this->data['eye_color'] = array(
					'name'  => 'eye_color',
					'value' => $this->form_validation->set_value('eye_color'),
					'options'=> $this->lang->line('reg_eye_color_options'),
					'form_options'=> 'id="eye_color" class="form-control"',
				);

				$this->data['height'] = array(
					'name'  => 'height',
					'id'    => 'reg-height-slider',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => '100;250',
					'style'=> 'display:none',
				);
				$this->data['weight'] = array(
					'name'  => 'weight',
					'id'    => 'reg-weight-slider',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => '30;500',
					'style'=> 'display:none',					
				);
				$this->data['body_type'] = array(
					'name'  => 'body_type',
					'value' => $this->form_validation->set_value('body_type'),
					'options'=> $this->lang->language['reg_body_type_options'],
					'form_options'=> 'id="body_type" class="form-control"',
				);
			
				$this->data['ethnicity'] = array(
					'name'  => 'ethnicity',
					'value' => $this->form_validation->set_value('ethnicity'),
					'options'=> $this->lang->language['reg_ethnicity_options'],
					'form_options'=> 'id="ethnicity" class="form-control"',
				);
				
				$this->data['appearance'] = array(
					'name'  => 'appearance',
					'value' => $this->form_validation->set_value('appearance'),
					'options'=> $this->lang->language['reg_appearance_options'],
					'form_options'=> 'id="appearance" class="form-control"',
				);				

				$this->data['drink'] = array(
					'name'  => 'drink',
					'value' => $this->form_validation->set_value('drink'),
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="drink" class="form-control"',
				);
					
				$this->data['smoke'] = array(
					'name'  => 'smoke',
					'value' => $this->form_validation->set_value('smoke'),
					'options' => $this->lang->language['reg_boolean_options'],
					'form_options' => 'id="smoke" class="form-control"',
				);
				
				$this->data['marital_status'] = array(
					'name'  => 'marital_status',
					'value' => $this->form_validation->set_value('marital_status'),
					'options' => $this->lang->language['reg_boolean_options'],
					'form_options' => 'id="marital_status" class="form-control"',
				);	
				
				$this->data['have_children'] = array(
					'name'  => 'have_children',
					'value' => $this->form_validation->set_value('have_children'),
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="have_children" class="form-control"',
				);
				
				$this->data['want_more_children'] = array(
					'name'  => 'want_more_children',
					'value' => $this->form_validation->set_value('want_more_children'),
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="want_more_children" class="form-control"',
				);	
				
				$this->data['occupation'] = array(
					'name'  => 'occupation',
					'value' => $this->form_validation->set_value('occupation'),
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="occupation" class="form-control"',
				);
				
				$this->data['willing_to_relocate'] = array(
					'name'  => 'willing_to_relocate',
					'value' => $this->form_validation->set_value('willing_to_relocate'),
					'options' => $this->lang->language['reg_boolean_options'],
					'form_options' => 'id="willing_to_relocate" class="form-control"',
				);		
				
				// relationship is looking for
				$rcount='1';
				$relationship_your_looking_for['relationship_is_looking_for_options'] = '';
				
				foreach($this->lang->language['relationship_is_looking_for_options'] as $hvalue)
				{
					
					$this->data['relationship_your_looking_for']['relationship_is_looking_for_options'][$rcount] = array(
						'name'  => 'relationship_your_looking_for',
						'value' => $hvalue,
						'options'=> $hvalue,
						
						'form_options'=> 'id="Rel_relationship_your_looking_for" class="form-control"',
					);
					$rcount++;
				}	
				// end relationship is looking for
				
				
			// radio set
			/*$this->data['relationship_your_looking_for'][1] = array(
				'name'  => 'relationship_your_looking_for',
				'id'    => 'relationship_your_looking_for',
				'type'  => 'checkbox',
				//'checked' => '',
				'value'=>'penpal',
			);
			if(isset($_POST['relationship_your_looking_for'])&&$_POST['relationship_your_looking_for']=='penpal')
			{
				$this->data['relationship_your_looking_for'][1]['checked']='checked';
			}
			
			$this->data['relationship_your_looking_for'][2] = array(
				'name'  => 'relationship_your_looking_for',
				'id'    => 'relationship_your_looking_for',
				'type'  => 'checkbox',
				//'checked' => '',
				'value' => 'friendship',
			);		
			
			if(isset($_POST['relationship_your_looking_for'])&&$_POST['relationship_your_looking_for'] == 'friendship'){
				$this->data['relationship_your_looking_for'][2]['checked'] = 'checked';
			}
			
			$this->data['relationship_your_looking_for'][3] = array(
				'name'  => 'relationship_your_looking_for',
				'id'    => 'relationship_your_looking_for',
				'type'  => 'checkbox',
				//'checked' => '',
				'value'=>'romance_dating',
			);		
			if(isset($_POST['relationship_your_looking_for'])&&$_POST['relationship_your_looking_for'] == 'romance_dating'){
				$this->data['relationship_your_looking_for'][3]['checked'] = 'checked';
			}			

			$this->data['relationship_your_looking_for'][4] = array(
				'name'  => 'relationship_your_looking_for',
				'id'    => 'relationship_your_looking_for',
				'type'  => 'checkbox',
				//'checked' => '',
				'value'=>'marriage',
			);	*/
				$this->data['occupation'] = array(
					'name'  => 'occupation',
					'value' => $this->form_validation->set_value('occupation'),
					'options'=> $this->lang->language['reg_occupation_options'],
					'form_options'=> 'id="occupation" class="form-control"',
				);				
				$this->data['nationality'] = array(
					'name'  => 'nationality',
					'value' => $this->form_validation->set_value('nationality'),
					'options'=> $this->lang->language['reg_nationality_options'],
					'form_options'=> 'id="nationality" class="form-control"',
				);			
			
			/*if(isset($_POST['relationship_your_looking_for'])&&$_POST['relationship_your_looking_for']=='marriage')
			{
				$this->data['relationship_your_looking_for'][4]['checked']='checked';
			}	*/				
				$this->data['education'] = array(
					'name'  => 'education',
					'value' => $this->form_validation->set_value('education'),
					'options'=> $this->lang->language['reg_education_options'],
					'form_options'=> 'id="education" class="form-control"',
				);	
				$this->data['english_ability'] = array(
					'name'  => 'english_ability',
					'value' => $this->form_validation->set_value('english_ability'),
					'options'=> $this->lang->language['reg_english_ability_options'],
					'form_options'=> 'id="english_ability" class="form-control"',
				);	
				$this->data['vietnamese_ability'] = array(
					'name'  => 'vietnamese_ability',
					'value' => $this->form_validation->set_value('vietnamese_ability'),
					'options'=> $this->lang->language['reg_vietnamese_ability_options'],
					'form_options'=> 'id="english_ability" class="form-control"',
				);					
				$this->data['religion'] = array(
					'name'  => 'religion',
					'value' => $this->form_validation->set_value('religion'),
					'options'=> $this->lang->language['reg_religion_options'],
					'form_options'=> 'id="religion" class="form-control"',
				);	
				
				$this->data['chinese_sign'] = array(
					'name'  => 'chinese sign',
					'value' => $this->form_validation->set_value('chinese sign'),
					'options'=> $this->lang->language['reg_chinese_signs_options'],
					'form_options'=> 'id="chinese sign" class="form-control"',
				);	
				$this->data['star_sign'] = array(
					'name'  => 'star sign',
					'value' => $this->form_validation->set_value('star sign'),
					'options'=> $this->lang->language['reg_star_signs_options'],
					'form_options'=> 'id="star sign" class="form-control"',
				);		
				
				$this->data['profile_head'] = array(
					'name'  => 'profile_head',
					'id'    => 'profile_head',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => $this->form_validation->set_value('profile_head'),
				);

				$this->data['about_yourself'] = array(
					'name'  => 'about_yourself',
					'id'    => 'about_yourself',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => $this->form_validation->set_value('about_yourself'),
				);	

				$this->data['looking_for_in_partner'] = array(
					'name'  => 'looking_for_in_partner',
					'id'    => 'looking_for_in_partner',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => $this->form_validation->set_value('looking_for_in_partner'),
				);	
				$this->data['terms2'] = array(
					'name'  => 'terms2',
					'id'    => 'terms2',
					'type'  => 'checkbox',
					'value'=>'1',

				);
				$this->data['template_footer']['register_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/register_footer_js', $this->data, TRUE);				
				$this->load->template('register2', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
			}
		}
	}
	
	
	function step_3()
	{
		if(!isset($this->session->userdata['reg_status']))
		{
			$regArray=array('reg_form2'=>$_POST, 'reg_status'=>'step3');
			$this->session->set_userdata($regArray);			
			redirect("/register/step_3", 'refresh');
			
		} elseif($this->session->userdata['reg_status']=='step2') 
		{
			$this->data['title'] = "Create User - Step 2";
			//validate form input
			$this->form_validation->set_rules('height', 'height', 'required|xss_clean');
			$this->form_validation->set_rules('weight', 'weight', 'required|xss_clean');	
			//$this->form_validation->set_rules('relationship_your_looking_for', 'relationship_your_looking_for', 'required|xss_clean|min_length[1]');				
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');	
			
			if ($this->form_validation->run() == true)
			{
				redirect("/register/step3", 'refresh');
			}
			else
			{
			
			}
			$this->load->template('register3', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
		}
	}
	
	
	function activate($id = null, $code = null) {
		if($this->ion_auth->activate($id, $code)){
			// show registered
			$this->data['message'] = $this->lang->language['registration_success'];
			$this->data['link'] = $this->lang->language['registration_success_link'];
		} else {
			// show invalid
			$this->data['message'] = $this->lang->language['registration_invalid'];
		}
		$this->session->unset_userdata(array('message' => ''));	
		$this->load->template('registration_success', $this->session->userdata['current_template'], $this->data, $return = FALSE);	
	}
	
	function finish ()
	{
		$this->data['message'] = $this->lang->language['registration_notice'];
		$this->session->unset_userdata(array('message' => ''));
		$this->load->template('registration_success', $this->session->userdata['current_template'],  $this->data, $return = FALSE);		
	}
	
	function get_state()
    {
        $country = $_REQUEST['county_id'];  
        //$result = $this->registration_model->get_state($country);
        $result  =  $this->lang->line('reg_'.$country.'_state');
		  
        echo '<select name="state_province" id="state" class="form-control">';
			echo '<option value="">Any</option>';
			echo '<option value="">All</option>';
	
			 foreach($result as $key => $val)
			{                
				echo  '<option value="'.$key.'">'.$val.'</option>';
			}
        echo '</select>';
		
    }

   	function get_city()
    {
		$state_id = $_REQUEST['state_id'];
        $county_id = $_REQUEST['country_id'];
		
		if($state_id != '')
		{
			$states = $this->lang->line('reg_'.$county_id.'_state');
			
			$state_name = strtolower(str_replace(' ', '_', $states[$state_id]));
			
			//echo $state_name;
			
			$result = $this->lang->line( 'reg_'.$county_id . '_' . $state_name);
	
			echo  '<select name="city" class="form-control">';
			echo  '<option value="">Any</option>';
			echo  '<option value="">All</option>';
			 foreach($result as $key => $val) 
			{
				   echo '<option value="'.$key.'">'.$val.'</option>';
			}
			echo '</select>'; 
		}else{
			echo  '<select name="city" class="form-control">';
			echo  '<option value="">Any</option>';
			echo  '<option value="">All</option>';
			echo '</select>'; 
		}
		
    }
   	
    /*function get_city()
    {
        $state = $_REQUEST['state_id'];  
        $result = $this->registration_model->get_city($state);        
        echo  '<select name="city" class="form-control">';
		 echo '<option value="">Select City</option>';
         foreach($result as $key=>$val)  
        {                
               echo '<option value="'.$key.'">'.$val.'</option>';
         }
        echo '</select>';
    }*/
	
}

/* End of file home.php */
/* Location: ./application/controllers/register.php */