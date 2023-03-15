<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Search_result extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->helper('login');		
		$this->load->database();
		$this->load->helper('language');
		$this->lang->load('_auth');
		
		$this->lang->load('_header_navigation', $this->config->item('language'));
		$this->lang->load('_splash', $this->config->item('language'));
		$this->lang->load('_forms', $this->config->item('language'));
		$this->lang->load('_footer', $this->config->item('language'));
		       
        $this->lang->load('_search', 'english');   
        $this->lang->load('_forms_locations', $this->config->item('language'));   
		
		$this->load->model('member_model');   
		$current_template = 'asian';         
		$this->session->set_userdata(array('current_template'=>'asian'));   
		//$this->data['logged'] = check_login($this->session->userdata, 'member'); 
		
		 if (!$this->ion_auth->logged_in())
			{
				$this->data['logged']	=	check_login($this->session->userdata, 'member');
			}
		
		
	}

	function index()
	{
		//print_r($_POST);die;          
		if(isset($_POST['i_am']))
		{
			$this->session->set_userdata(array('i_am' => $_POST['i_am']));
		} elseif(!isset($this->session->userdata['i_am'])) {
			$this->session->set_userdata(array('i_am' => 'male'));
		}
		if(isset($_POST['looking_for']))
		{
			$this->session->set_userdata(array('looking_for' => $_POST['looking_for']));
		} elseif(!isset($this->session->userdata['looking_for'])) {
			$this->session->set_userdata(array('looking_for' => 'female'));
		}
		if(isset($_POST['age']))
		{
			$this->session->set_userdata(array('age'=>$_POST['age']));
		} elseif(!isset($this->session->userdata['age'])) {
			$this->session->set_userdata(array('age'=>'18;30'));
		}
		
		$this->data = array();
		$age_between_range = '18;30';
		$this->data['age_between_array'] = explode(';', $age_between_range);	
		if(isset($this->session->userdata['age'])){
			$this->data['age_between_array'] = explode(';', $this->session->userdata['age']);	
		}
		//adding match data       
			$exist = $this->member_model->find_profile_match(@$this->session->userdata['user_id']);
			
			$this->data['im_seeking_a']			= '';
			$this->data['max_age_between'] 		= '18;99';
			$this->data['age_between_range']	= '18;30';
			$this->data['height_range'] 		= '50;260';
			$this->data['match']['height_range_default'] = explode(';', $this->data['height_range']);
			$this->data['weight_range'] 		= '30;90';
			$this->data['match']['height_range_default'] = explode(';', $this->data['weight_range']);
			$this->data['with_in'] 				= '10';
			$this->data['living_in'] 			= 'any';
			$this->data['living_in2'] 			= 'any';
			$this->data['lifestyle'] 			= 'sedentary';
			
			if(isset($exist)&& $exist > 0)
			{
				$old_data = $this->member_model->get_profile_match($this->session->userdata['user_id']);
				$this->data['age_between_range'] = $old_data['age_between'];
				$this->data['im_seeking_a'] = $old_data['im_seeking_a'];
				$this->data['with_in'] = $old_data['with_in'];

				if(isset($_POST['living_in'])){
					$this->data['living_in'] = $_POST['living_in'];
				} elseif(!isset($this->session->userdata['living_in'])) 
				{
					$this->data['living_in'] = $old_data['living_in'];
				}
				if(isset($_POST['living_in2'])){
					$this->data['living_in2'] = $_POST['living_in2'];
				} elseif(!isset($this->session->userdata['living_in2'])){
					$this->data['living_in2'] = $old_data['living_in2'];
				}	
				if(isset($_POST['with_in'])){
					$this->data['with_in'] = $_POST['with_in'];
				} elseif(!isset($this->session->userdata['with_in'])) {
					$this->data['with_in'] = $old_data['with_in'];
				}				
				if(isset($_POST['nationality'])){
					$this->data['nationality'] = $_POST['nationality'];
				} elseif(!isset($this->session->userdata['nationality'])) {
					$this->data['nationality'] = $old_data['nationality'];
				}	
				if(isset($_POST['education'])){
					$this->data['education'] = $_POST['education'];
				} elseif(!isset($this->session->userdata['education'])) {
					$this->data['education'] = $old_data['education'];
				}
				if(isset($_POST['english_ability']))
				{
					$this->data['english_ability'] = $_POST['english_ability'];
				} elseif(!isset($this->session->userdata['english_ability'])) {
					$this->data['english_ability'] = $old_data['english_ability'];
				}	
				if(isset($_POST['vietnamese_ability'])){
					$this->data['vietnamese_ability'] = $_POST['vietnamese_ability'];
				} elseif(!isset($this->session->userdata['vietnamese_ability'])) {
					$this->data['vietnamese_ability'] = $old_data['vietnamese_ability'];
				}					
				if(isset($_POST['height'])){
					$this->data['height'] = $_POST['height'];
				} elseif(!isset($this->session->userdata['height'])) {
					$this->data['height'] = $old_data['height'];
				}	
				if(isset($_POST['weight'])){
					$this->data['weight'] = $_POST['weight'];
				} elseif(!isset($this->session->userdata['weight'])) {
					$this->data['weight'] = $old_data['weight'];
				}	
				if(isset($_POST['body_type'])){
					$this->data['body_type'] = $_POST['body_type'];
				} elseif(!isset($this->session->userdata['body_type'])) {
					$this->data['body_type'] = $old_data['body_type'];
				}		
			
				$this->data['lifestyle'] = $old_data['lifestyle'];
				$this->data['ethnicity'] = $old_data['ethnicity'];
				//$age_between = $old_data['age_between'];       
			}
			
			$this->data['match']['im_seeking_a'] = array(
				'name'  => 'im_seeking_a',
				'value' => $this->data['im_seeking_a'],
				'options'=> $this->lang->language['im_seeking_a'],
				'form_options'=> 'id="match_im_seeking_a" name="im_seeking_a" class="form-control"',
			);
			$this->data['match']['age_between_array'] = @explode(';', $this->data['age_between_range']);
			$this->data['match']['height_range_array'] = @explode(';', $this->data['height']);
			$this->data['match']['weight_range_array'] = @explode(';', $this->data['weight']);
			$this->data['match']['age_between'] = @array(
				'name'  => 'age_between',
				'id'    => 'match_age-slider',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => $this->data['max_age_between'],
			);
			$this->data['match']['with_in'] = array(
				'name'  => 'with_in',
				'value' => @$this->data['with_in'],
				'options'=> $this->lang->language['with_in'],
				'form_options'=> 'id="match_with_in" name="with_in" class="form-control"',
			);			
			$this->data['match']['living_in'] = array(
				'name'  => 'living_in',
				'value' => @$this->data['living_in'],
				'options'=> $this->lang->language['living_in'],
				'form_options'=> 'id="match_living_in" name="living_in" class="form-control"',
			);
			$this->data['match']['living_in2'] = array(
				'name'  => 'living_in2',
				'value' => @$this->data['living_in2'],
				'options'=> $this->lang->language['living_in2'],
				'form_options'=> 'id="match_living_in2" name="living_in2" class="form-control"',
			);
			$lcount='';
			$this->data['match']['lifestyle_array'] = $this->lang->language['lifestyle_array'];
			
			foreach($this->lang->language['lifestyle_array'] as $lvalue)
			{
				$this->data['match']['lifestyle'.$lcount] = array(
					'name'  => 'match_lifestyle',
					'type'  => 'radio',
					//'checked' => '',       
					'value'=>$lvalue,
				);
				if($lvalue==$this->data['lifestyle']){
					$this->data['match']['lifestyle'.$lcount]['checked'] = 'checked';
				}
				$lcount++;
			}
			
			$this->data['match']['english_ability'] = array(
				'name'  => 'english_ability',
				'value' => @$this->data['english_ability'],
				'options'=> $this->lang->language['reg_english_ability_options'],
				'form_options'=> 'id="match_english_ability" class="form-control"',
			);
			$this->data['match']['nationality'] = array(
				'id'=>'match_nationality',
				'name'  => 'nationality',
				'value' => @$this->data['nationality'],
				'options'=> $this->lang->language['reg_nationality_options'],
				'form_options'=> 'id="match_nationality" class="form-control"',
			);
			$this->data['match']['education'] = array(
				'id'=>'match_education',
				'name'  => 'education',
				'value' => @$this->data['education'],
				'options'=> $this->lang->language['reg_education_options'],
				'form_options'=> 'id="match_education" class="form-control"',
			);	
			
			$this->data['match']['vietnamese_ability'] = array(
				'id'=>'match_with_in',
				'name'  => 'vietnamese_ability',
				'value' => @$this->data['vietnamese_ability'],
				'options'=> $this->lang->language['reg_vietnamese_ability_options'],
				'form_options'=> 'id="match_vietnamese_ability" class="form-control"',
			);		
				/*
				$this->data['body_type'] = array(    
					'name'  => 'body_type',      
					'value' => $this->form_validation->set_value('body_type'),       
					'options'=> $this->lang->language['body_type_options'],       
					'form_options'=> 'id="body_type" class="form-control"',       
				);      
				*/             
			$btcount = '1';
			foreach($this->lang->language['body_type_options'] as $btkey=>$btvalue){
				//echo "$body_type == $btvalue";                     
				$this->data['match']['body_type'][$btcount] = array(
					'name'  => 'body_type',
					'value' => $btkey,
					'options'=> $btvalue,
					'form_options'=> 'id="match_body_type" class="form-control"',
				);
				if(isset($this->data['body_type'])){
					//echo '<hr>'.$this->data['body_type'] . 'xxxxxx'.$btkey.'<br>';                     
					if(trim(strtolower($this->data['body_type'])) == trim(strtolower($btkey)))
					{
						$this->data['match']['body_type'][$btcount]['selected'] = 'selected';
					}
				}
				$btcount++;
				//echo $btvalue.' '.$btcount;                           
			}
			$this->data['match']['ethnicity'] = array(
				'name'  => 'ethnicity',
				'value' => @$this->data['ethnicity'],
				'options'=> $this->lang->language['reg_ethnicity_options'],
				'form_options'=> 'id="match_ethnicity" class="form-control"',
			);				
		//end match data                                                

		//$search_result=$this->member_model->basic_search($this->session->userdata['i_am'], $this->session->userdata['looking_for'], $this->data['age_between_array']);
		$search_result = @$this->member_model->advanced_search(
			$this->session->userdata['i_am'], 
			$this->session->userdata['looking_for'], 
			$this->data['age_between_array'], 
			$this->data['living_in'],
			$this->data['living_in2'],
			$this->data['with_in'],
			$this->data['nationality'],
			$this->data['education'],
			$this->data['english_ability'],
			$this->data['vietnamese_ability'],
			$this->data['height'],
			$this->data['weight'],
			$this->data['ethnicity'],
			$this->data['body_type']
		); 
		         
		$this->data['search_result'] = count($search_result);             
		if(is_array($search_result)&&count($search_result) > 0)
		{
			foreach ($search_result as $srkey => $srvalue) 
			{
				//print_r($this->member_model->get_profile_by_id($srvalue['user_id']));             
				$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
			}
			       
		}
		$this->data['found_users'] = @$found_users; 
		$this->data['i_am'] = array( 
			'name'  => 'i_am', 
			'value' => @$this->session->userdata['i_am'], 
			'options'=> $this->lang->language['gender'], 
			'form_options'=> 'id="i_am" class="form-control"',
		);		
		$this->data['looking_for'] = array(
			'name'  => 'looking_for',
			'value' => @$this->session->userdata['looking_for'],
			'options'=> $this->lang->language['gender'],
			'form_options'=> 'id="looking_for" class="form-control"',
		);	
		$this->data['age'] = array(
			'name'  => 'age',
			'value' => '18;99',
			'id' => 'age-slider',
			'class' => 'form-control',
		);	
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
		if(isset($this->session->userdata['identity']))
		{
			$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
			foreach($this->data['profile'] as $value)
			{
				//get thread user profile pic
				$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
			}
		}
		
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

		$this->data['countries'] = $this->lang->line('reg_countries_options');
		
		//get newest member     
		$this->data['newest_member'] = $this->member_model->get_newest_member_list();
		
		foreach($this->data['newest_member'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['age_between'] = $this->member_model->age_between($value['id']);  //age_between     
			}
		$this->load->template('search_result_profile', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		
		//get advance search donation user list 
		//$this->data['advancesearch_donation'] = $this->member_model->get_advcsr_don_user();	
		//echo "<pre>";print_r($this->data['advancesearch_donation']);die;
	}

}