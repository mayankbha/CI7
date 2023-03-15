<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_manager extends MY_Controller {

	function __construct()
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

		$this->lang->load('auth');
		$this->load->helper('language');
		//$this->lang->load('base', 'english');
		//$this->lang->load('register', 'english');
		//$this->lang->load('notices_emails', 'english');
		$this->lang->load('profile_manager', $this->config->item('language'));
		$this->lang->load('_header_navigation', $this->config->item('language'));
		$this->lang->load('_splash', $this->config->item('language'));
		$this->lang->load('_forms', $this->config->item('language'));
		$this->lang->load('_footer', $this->config->item('language'));		
		$this->load->model('member_model');
		$current_template = 'asian';
		$this->session->set_userdata(array('current_template'=>'asian'));
		$this->data['logged'] = check_login($this->session->userdata, 'member');
		
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
		//profile completness 
			$maximumPoints  = 100;
			$point = $this->member_model->profile_complete(); //get points of user data except profile pic
			
			$this->data['profile_pic'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']); //get profile pic completeness point (5)
			if($this->data['profile_pic'] != '')
				{
					$point += 14;
				}
			
			$this->data['profile_complete'] = ($point * $maximumPoints)/100; //percentage
			/////////////////*********Remaining compleness***********//
		
		$this->data['pm_match'] = $this->member_model->get_match_comp();
		$this->data['pm_profile_comp'] = $this->member_model->get_profile_comp();
		$this->data['pm_photo'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
		$this->data['pm_profile_verify'] = $this->member_model->get_profileverify_submitted_ids();
		$this->data['pm_interest'] = $this->member_model->get_user_interest();
		$this->data['pm_questions'] = $this->member_model->get_questions_comp();
		$this->data['pm_get_personality_comp'] = $this->member_model->get_personality_comp();
		
		/////////////////********************//
		//End profile completness 
		$this->data['title'] = 'Dumpflings - profile manager';
	}

	function index()
	{
		$data = array();
		//Personality
		$personality_questions = array (
			'0'=>'What is your favorite movie',
			'1'=>'What is your favorite book',
			'2'=>'What sort of food do you like',
			'3'=>'',
			'4'=>'',
			'5'=>'',
			'6'=>'',
			''=>'',
			''=>'',
			''=>'',
		);
	
		
		//questions
		$questions_jquery = '';
		$questions_old_array = $this->member_model->get_questions($this->session->userdata['user_id']);
		foreach($questions_old_array as $qoakey => $qoavalue){
			$questions_old[$qoavalue['question_id']]=$qoavalue['answer'];
		}
		//print_r($questions_old);
		foreach($this->lang->language['questions'] as $qid => $qvalue){
			$this->data['questions'][$qid] = array(
				'name'  => 'questions_'.trim($qid),
				'value' => $qvalue,
				'options'=> $qvalue,
				'selected'=> @$questions_old[$qid],
				'form_options'=> 'id="'.'questions_'.trim($qid).'" class="form-control"',
			);	

			$questions_jquery.='
			\'questions_'.trim($qid).'\': $("input:radio[name=questions_'.trim($qid).']:checked").val(),';
			
		}
		//profile pictures
		$this->data['main_id'] = $this->member_model->get_main_id($this->session->userdata['user_id']);
		$this->data['profile_photos'] = $this->member_model->get_profile_ids($this->session->userdata['user_id']);

		//questions
		$this->data['questions_jquery'] = $questions_jquery;
		
		//profile personality
		$get_profile_personality = $this->member_model->get_profile_personalitydetail();
		//print_r($get_profile_personality);die;
		
			$this->data['get_profile_personality']['fav_movie'] = array(
				'name'  => 'fav_movie',
				'id'    => 'fav_movie',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['fav_movie'],
			);
			
			$this->data['get_profile_personality']['fav_book'] = array(
				'name'  => 'fav_book',
				'id'    => 'fav_book',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['fav_book'],
			);
			
			$this->data['get_profile_personality']['food_you_like'] = array(
				'name'  => 'food_you_like',
				'id'    => 'food_you_like',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['food_you_like'],
			);
			
			$this->data['get_profile_personality']['music_you_like'] = array(
				'name'  => 'music_you_like',
				'id'    => 'music_you_like',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['music_you_like'],
			);
			
			$this->data['get_profile_personality']['your_hobies'] = array(
				'name'  => 'your_hobies',
				'id'    => 'your_hobies',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['your_hobies'],
			);
			
			$this->data['get_profile_personality']['describe_your_dress'] = array(
				'name'  => 'describe_your_dress',
				'id'    => 'describe_your_dress',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['describe_your_dress'],
			);
			
			$this->data['get_profile_personality']['describe_your_sense'] = array(
				'name'  => 'describe_your_sense',
				'id'    => 'describe_your_sense',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['describe_your_sense'],
			);
			
			$this->data['get_profile_personality']['describe_your_personality'] = array(
				'name'  => 'describe_your_personality',
				'id'    => 'describe_your_personality',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['describe_your_personality'],
			);	
			
			$this->data['get_profile_personality']['you_travelled'] = array(
				'name'  => 'you_travelled',
				'id'    => 'you_travelled',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['you_travelled'],
			);	
			$this->data['get_profile_personality']['adaptive_are_you'] = array(
				'name'  => 'adaptive_are_you',
				'id'    => 'adaptive_are_you',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => @$get_profile_personality['adaptive_are_you'],
			);	
			
		//End profile personality //////////////////////////////////////////////////
		
		
		//profile verify
		$this->data['submitted_ids'] = $this->member_model->get_submitted_ids($this->session->userdata['user_id']);
		$profile_verify = $this->member_model->get_profile_verify($this->session->userdata['user_id']);		

			$this->data['profile_verify']['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'First Name',
				'value' => @$profile_verify['first_name'],
			);
			$this->data['profile_verify']['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Last Name',
				'value' => @$profile_verify['last_name'],
			);	
			$this->data['profile_verify']['zip_code'] = array(
				'name'  => 'zip_code',
				'id'    => 'zip_code',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Zip Code',
				'value' => @$profile_verify['zip_code'],
			);			
			$this->data['profile_verify']['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Email',
				'value' => $profile_verify['email'],
			);
			$this->data['profile_verify']['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'Phone',
				'value' => $profile_verify['phone'],
			);	
			$this->data['profile_verify']['state_province'] = array(
				'name'  => 'state_province',
				'id'    => 'state_province',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'State/Province',
				'value' => $profile_verify['state_province'],
			);		
			$this->data['profile_verify']['city'] = array(
				'name'  => 'city',
				'id'    => 'city',
				'type'  => 'text',
				'class'	=> 'form-control',
				'placeholder' => 'City',
				'value' => $profile_verify['city'],
			);			

			
		$hobbies_jquery = '';
		$this->data['hobbies_jquery'] = '';
		$hobbies['what_do_you_do_for_fun'] = '';
		$hcount='1';
		$hobbies_saved =  $this->member_model->get_interest($this->session->userdata['user_id']);
		if(is_array($hobbies_saved))
		{
			$hobbies_array = explode('|', $hobbies_saved['hobbies']);
			$food_array = explode('|', $hobbies_saved['food']);
			$music_array = explode('|', $hobbies_saved['music']);
			$sports_array = explode('|', $hobbies_saved['sports']);
			
		}
		foreach($this->lang->language['what_do_you_do_for_fun'] as $hvalue){
			$this->data['hobbies_data']['what_do_you_do_for_fun'][$hcount] = array(
				'name'  => 'what_do_you_do_for_fun',
				'value' => $hvalue,
				'options'=> $hvalue,
				'form_options'=> 'id="hobbies_what_do_you_do_for_fun" class="form-control"',
			);
			$this->data['hobbies_jquery'].='
			\''.str_replace(' ', '_', $hvalue).'\': $("#hobbies_'.str_replace(' ', '_', $hvalue).'").attr(\'checked\'),';
			if(isset($hobbies_array)&&is_array($hobbies_array))
			{
				if(in_array($hvalue, $hobbies_array))
				{
					$this->data['hobbies_data']['what_do_you_do_for_fun'][$hcount]['selected'] = 'selected';
				}
			}
			$hcount++;
			//echo $btvalue.' '.$btcount;
		}	
		
		//food	

		$hobbies['what_sort_of_food_do_you_like'] = '';
		$h2count = '1';
		foreach($this->lang->language['what_sort_of_food_do_you_like'] as $h2value){
			$this->data['hobbies_data']['what_sort_of_food_do_you_like'][$h2count] = array(
				'name'  => 'what_sort_of_food_do_you_like',
				'value' => $h2value,
				'options'=> $h2value,
				'form_options'=> 'id="hobbies_what_sort_of_food_do_you_like" class="form-control"',
			);	
			if(isset($food_array)&&is_array($food_array)){
				if(in_array($h2value, $food_array)){
					$this->data['hobbies_data']['what_sort_of_food_do_you_like'][$h2count]['selected'] = 'selected';
				}
			}
			$h2count++;
		}			
		
		//music
		$music['what_sort_of_music_are_you_into'] = '';
		$mcount = '1';
		foreach($this->lang->language['what_sort_of_music_are_you_into'] as $mvalue){
			$this->data['music_data']['what_sort_of_music_are_you_into'][$mcount] = array(
				'name'  => 'what_sort_of_music_are_you_into',
				'value' => $mvalue,
				'options'=> $mvalue,
				'form_options'=> 'id="music_what_sort_of_music_are_you_into" class="form-control"',
			);	
			if(isset($music_array)&&is_array($music_array)){
				if(in_array($mvalue, $music_array)){
					$this->data['music_data']['what_sort_of_music_are_you_into'][$mcount]['selected'] = 'selected';
				}
			}
			$mcount++;
		}	
		
		//sports
		$music['what_sports_do_you_play_or_like_to_watch'] = '';
		$scount = '1';
		foreach($this->lang->language['what_sports_do_you_play_or_like_to_watch'] as $svalue){
			$this->data['sports_data']['what_sports_do_you_play_or_like_to_watch'][$scount] = array(
				'name'  => 'what_sports_do_you_play_or_like_to_watch',
				'value' => $svalue,
				'options'=> $svalue,
				'form_options'=> 'id="sports_what_sports_do_you_play_or_like_to_watch" class="form-control"',
			);	
			if(isset($sports_array)&&is_array($sports_array)){
				if(in_array($svalue, $sports_array)){
					$this->data['sports_data']['what_sports_do_you_play_or_like_to_watch'][$scount]['selected'] = 'selected';
				}
			}
			$scount++;
		}	
		
		
		//adding profile data
			$profile_exist = $this->member_model->get_edit_profile_data_count($this->session->userdata['user_id']);
			$this->data['reg_weight'] = '60';
			$this->data['reg_height'] = '250';			
			if(isset($profile_exist) && $profile_exist > 0){
				$edit_profile_data = $this->member_model->get_edit_profile_data($this->session->userdata['user_id']);
				$edit_profile_profile = $this->member_model->get_edit_profile_profile($this->session->userdata['user_id']);
				$this->data['reg_weight'] = $edit_profile_data['weight'];
				$this->data['reg_height'] = $edit_profile_data['height'];
				
				$this->data['profile_data']['hair_color'] = array(
					'name'  => 'hair_color',
					'value' => $edit_profile_data['hair_color'],
					'options'=> $this->lang->line('reg_hair_color_options'),
					'form_options'=> 'id="reg_hair_color" class="form-control"',
				);
				$this->data['profile_data']['eye_color'] = array(
					'name'  => 'eye_color',
					'value' => $edit_profile_data['eye_color'],
					'options'=> $this->lang->line('reg_eye_color_options'),
					'form_options'=> 'id="reg_eye_color" class="form-control"',
				);
				$this->data['profile_data']['height'] = array(
					'name'  => 'height',
					'id'    => 'reg-height-slider',
					'type'  => 'text',
					'class'	=> 'form-control',
					//'value' => '70;200',
					'value' => '100;120',
				);
				$this->data['profile_data']['weight'] = array(
					'name'  => 'weight',
					'id'    => 'reg-weight-slider',
					'type'  => 'text',
					'class'	=> 'form-control',
					'value' => '30;250',
				);
				$this->data['profile_data']['body_type'] = array(
					'name'  => 'body_type',
					'value' => $edit_profile_data['body_type'],
					'options'=> $this->lang->language['reg_body_type_options'],
					'form_options'=> 'id="reg_body_type" class="form-control"',
				);
				$this->data['profile_data']['ethnicity'] = array(
					'name'  => 'ethnicity',
					'value' => $edit_profile_data['ethnicity'],
					'options'=> $this->lang->language['reg_ethnicity_options'],
					'form_options'=> 'id="reg_ethnicity" class="form-control"',
				);
				$this->data['profile_data']['appearance'] = array(
					'name'  => 'appearance',
					'value' => $edit_profile_data['appearance'],
					'options'=> $this->lang->language['reg_appearance_options'],
					'form_options'=> 'id="reg_appearance" class="form-control"',
				);
				$this->data['profile_data']['drink'] = array(
					'name'  => 'drink',
					'value' => $edit_profile_data['drink'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_drink" class="form-control"',
				);	
				$this->data['profile_data']['smoke'] = array(
					'name'  => 'smoke',
					'value' => $edit_profile_data['smoke'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_smoke" class="form-control"',
				);
				$this->data['profile_data']['marital_status'] = array(
					'name'  => 'marital_status',
					'value' => $edit_profile_data['marital_status'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_marital_status" class="form-control"',
				);	
				$this->data['profile_data']['have_children'] = array(
					'name'  => 'have_children',
					'value' => $edit_profile_data['have_children'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_have_children" class="form-control"',
				);
				$this->data['profile_data']['want_more_children'] = array(
					'name'  => 'want_more_children',
					'value' => $edit_profile_data['want_more_children'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_want_more_children" class="form-control"',
				);	
				$this->data['profile_data']['occupation'] = array(
					'name'  => 'occupation',
					'value' => $edit_profile_data['occupation'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_occupation" class="form-control"',
				);
				$this->data['profile_data']['willing_to_relocate'] = array(
					'name'  => 'willing_to_relocate',
					'value' => $edit_profile_data['willing_to_relocate'],
					'options'=> $this->lang->language['reg_boolean_options'],
					'form_options'=> 'id="reg_willing_to_relocate" class="form-control"',
				);		
				
				
				// relationship is looking for
				$this->data['rylf_jquery'] = '';
				$lookingfor['relationship_is_looking_for_options'] = '';
				$rcount='1';
				if(is_array($edit_profile_data))
				{
					$rylf_array = explode('|' , $edit_profile_data['relationship_your_looking_for']);
				}
				foreach($this->lang->language['relationship_is_looking_for_options'] as $hvalue)
				{
					$this->data['relationship_your_looking_for']['relationship_is_looking_for_options'][$rcount] = array(
						'name'  => 'relationship_your_looking_for',
						'value' => $hvalue,
						'options'=> $hvalue,
						'form_options'=> 'id="Rel_relationship_your_looking_for" class="form-control"',
					);
					
					$this->data['rylf_jquery'].='\''.str_replace(' ', '_', $hvalue).'\': $("#Rel_'.str_replace(' ', '_', $hvalue).'").attr(\'checked\'),';
					if(isset($rylf_array)&&is_array($rylf_array))
					{
						if(in_array($hvalue, $rylf_array))
						{
							$this->data['relationship_your_looking_for']['relationship_is_looking_for_options'][$rcount]['selected'] = 'selected';
						}
					}
					$rcount++;
				}
				// end relationship is looking for
				
				
				/*// radio set
					$this->data['profile_data']['relationship_your_looking_for'][1] = array(
						'name'  => 'reg_relationship_your_looking_for',
						'id'    => 'reg_relationship_your_looking_for',
						'type'  => 'checkbox',
						//'checked' => '',
						'value'=>'penpal',
					);
					if($edit_profile_data['relationship_your_looking_for']=='penpal'){
						$this->data['profile_data']['relationship_your_looking_for'][1]['checked']='checked';
					}
					
					$this->data['profile_data']['relationship_your_looking_for'][2] = array(
						'name'  => 'reg_relationship_your_looking_for',
						'id'    => 'reg_relationship_your_looking_for',
						'type'  => 'checkbox',
						//'checked' => '',
						'value'=>'friendship',
					);		
					if($edit_profile_data['relationship_your_looking_for']=='friendship'){
						$this->data['profile_data']['relationship_your_looking_for'][2]['checked']='checked';
					}
					
					$this->data['profile_data']['relationship_your_looking_for'][3] = array(
						'name'  => 'reg_relationship_your_looking_for',
						'id'    => 'reg_relationship_your_looking_for',
						'type'  => 'checkbox',
						//'checked' => '',
						'value'=>'romance_dating',
					);		
					if($edit_profile_data['relationship_your_looking_for'] == 'romance_dating'){
						$this->data['profile_data']['relationship_your_looking_for'][3]['checked'] = 'checked';
					}			

					$this->data['profile_data']['relationship_your_looking_for'][4] = array(
						'name'  => 'reg_relationship_your_looking_for',
						'id'    => 'reg_relationship_your_looking_for',
						'type'  => 'checkbox',
						//'checked' => '',
						'value'=>'marriage',
					);	
					if($edit_profile_data['relationship_your_looking_for']=='marriage'){
						$this->data['profile_data']['relationship_your_looking_for'][4]['checked']='checked';
					}	*/	
					//bottom
					$this->data['profile_data']['nationality'] = array(
						'name'  => 'nationality',
						'value' => $edit_profile_data['nationality'],
						'options'=> $this->lang->language['reg_nationality_options'],
						'form_options'=> 'id="reg_nationality" class="form-control"',
					);
					$this->data['profile_data']['education'] = array(
						'name'  => 'education',
						'value' => $edit_profile_data['education'],
						'options'=> $this->lang->language['reg_education_options'],
						'form_options'=> 'id="reg_education" class="form-control"',
					);	
					$this->data['profile_data']['english_ability'] = array(
						'name'  => 'english_ability',
						'value' => $edit_profile_data['english_ability'],
						'options'=> $this->lang->language['reg_english_ability_options'],
						'form_options'=> 'id="reg_english_ability" class="form-control"',
					);	
					$this->data['profile_data']['vietnamese_ability'] = array(
						'name'  => 'vietnamese_ability',
						'value' => $edit_profile_data['vietnamese_ability'],
						'options'=> $this->lang->language['reg_vietnamese_ability_options'],
						'form_options'=> 'id="reg_vietnamese_ability" class="form-control"',
					);					
					$this->data['profile_data']['religion'] = array(
						'name'  => 'religion',
						'value' => $edit_profile_data['religion'],
						'options'=> $this->lang->language['reg_religion_options'],
						'form_options'=> 'id="reg_religion" class="form-control"',
					);	
					
					//new box
					$this->data['profile_data']['living_situation'] = array(
						'name'  => 'living_situation',
						'value' => $edit_profile_data['living_situation'],
						'options'=> $this->lang->language['living_situation_options'],
						'form_options'=> 'id="living_situation" class="form-control"',
					);	
					
					$this->data['profile_data']['incomeperyear'] = array(
						'name'  => 'incomeperyear',
						'value' => $edit_profile_data['incomeperyear'],
						'options'=> $this->lang->language['incomeperyear_options'],
						'form_options'=> 'id="incomeperyear" class="form-control"',
					);	
					
					$this->data['profile_data']['workingstatus'] = array(
						'name'  => 'workingstatus',
						'value' => $edit_profile_data['workingstatus'],
						'options'=> $this->lang->language['workingstatus_options'],
						'form_options'=> 'id="workingstatus" class="form-control"',
					);	
					
					$this->data['profile_data']['cupsize'] = array(
						'name'  => 'cupsize',
						'value' => $edit_profile_data['cupsize'],
						'options'=> $this->lang->language['cupsize_options'],
						'form_options'=> 'id="cupsize" class="form-control"',
					);	
					
					//end new box
					
					$this->data['profile_data']['chinese_sign'] = array(
						'name'  => 'chinese_sign',
						'value' => $edit_profile_data['chinese_sign'],
						'options'=> $this->lang->language['reg_chinese_signs_options'],
						'form_options'=> 'id="reg_chinese_sign" class="form-control"',
					);	
					$this->data['profile_data']['star_sign'] = array(
						'name'  => 'star_sign',
						'value' => $edit_profile_data['star_sign'],
						'options'=> $this->lang->language['reg_star_signs_options'],
						'form_options'=> 'id="reg_star_sign" class="form-control"',
					);		
					
					$this->data['profile_data']['profile_head'] = array(
						'name'  => 'profile_head',
						'id'    => 'reg_profile_head',
						'type'  => 'text',
						'class'	=> 'form-control',
						'value' => $edit_profile_profile['profile_head'],
					);

					$this->data['profile_data']['about_yourself'] = array(
						'name'  => 'about_yourself',
						'id'    => 'reg_about_yourself',
						'type'  => 'text',
						'class'	=> 'form-control',
						'value' => $edit_profile_profile['about_yourself'],
					);	

					$this->data['profile_data']['looking_for_in_partner'] = array(
						'name'  => 'looking_for_in_partner',
						'id'    => 'reg_looking_for_in_partner',
						'type'  => 'text',
						'class'	=> 'form-control',
						'value' => $edit_profile_profile['looking_for_in_partner'],
					);					
			}
		//adding match data
		
			$exist = $this->member_model->find_profile_match($this->session->userdata['user_id']);
			
			$im_seeking_a = '';
			$max_age_between = '18;99';
			$age_between_range = '18;30';
			$height_range = '100;220';
			$weight_range = '30;250';
			$with_in = '10';
			$living_in = 'hanoi';
			$living_in2 = 'vietnam';
			$lifestyle = 'sedentary';
			if(isset($exist) && $exist > 0)
			{
				$old_data = $this->member_model->get_profile_match($this->session->userdata['user_id']);
				
				//echo "<pre>";print_r($old_data);die;
				
				$age_between_range 	= $old_data['age_between'];
				$height_range		= $old_data['height'];
				$weight_range		= $old_data['weight'];
				$im_seeking_a		= $old_data['im_seeking_a'];
				$with_in			= $old_data['with_in'];
				$living_in			= $old_data['living_in'];
				$living_in2			= $old_data['living_in2'];
				$lifestyle			= $old_data['lifestyle'];
				$nationality		= $old_data['nationality'];
				$education			= $old_data['education'];
				$english_ability 	= $old_data['english_ability'];
				$vietnamese_ability = $old_data['vietnamese_ability'];
				$body_type 			= $old_data['body_type'];
				$ethnicity 			= $old_data['ethnicity'];
				$religion			= $old_data['religion'];
				$chinese_sign		= $old_data['chinese_sign'];
				$star_sign			= $old_data['star_sign'];
				$living_situation 	= $old_data['living_situation'];
				$incomeperyear 		= $old_data['incomeperyear'];
				$workingstatus 		= $old_data['workingstatus'];
				//$age_between = $old_data['age_between'];
			}
			
			//get looking for gender
				$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
				
				$this->data['getlooking_for'] = $this->member_model->get_looking_for();
			
			$this->data['match']['im_seeking_a'] = array(
				'name'  => 'im_seeking_a',
				'value' => $im_seeking_a,
				'options'=> $this->lang->language['im_seeking_a'],
				'form_options'=> 'id="match_im_seeking_a" name="im_seeking_a" class="form-control"',
			);
			$this->data['match']['age_between_array'] = explode(';', $age_between_range);
			$this->data['match']['height_range_array'] = explode(';', $height_range);
			$this->data['match']['weight_range_array'] = explode(';', $weight_range);
			$this->data['match']['age_between'] = array(
				'name'  => 'age_between',
				'id'    => 'match_age-slider',
				'type'  => 'text',
				'class'	=> 'form-control',
				'value' => $max_age_between,
			);
			$this->data['match']['with_in'] = array(
				'name'  => 'with_in',
				'value' => @$with_in,
				'options'=> $this->lang->language['with_in'],
				'form_options'=> 'id="match_with_in" name="with_in" class="form-control"',
			);			
			$this->data['match']['living_in'] = array(
				'name'  => 'living_in',
				'value' => @$living_in,
				'options'=> $this->lang->language['living_in'],
				'form_options'=> 'id="match_living_in" name="living_in" class="form-control"',
			);
			$this->data['match']['living_in2'] = array(
				'name'  => 'living_in2',
				'value' => @$living_in2,
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
					'value' => $lvalue,
				);
				if($lvalue == $lifestyle){
					$this->data['match']['lifestyle'.$lcount]['checked']='checked';
				}
				$lcount++;				
			}
				$this->data['match']['english_ability'] = array(
					'name'  => 'english_ability',
					'value' => @$english_ability,
					'options'=> $this->lang->language['reg_english_ability_options'],
					'form_options'=> 'id="match_english_ability" class="form-control"',
				);
				$this->data['match']['nationality'] = array(
					'id' =>'match_nationality',
					'name'  => 'nationality',
					'value' => @$nationality,
					'options' => $this->lang->language['reg_nationality_options'],
					'form_options' => 'id="match_nationality" class="form-control"',
				);
				$this->data['match']['education'] = array(
					'id'=>'match_education',
					'name'  => 'education',
					'value' => @$education,
					'options'=> $this->lang->language['reg_education_options'],
					'form_options'=> 'id="match_education" class="form-control"',
				);	

				$this->data['match']['vietnamese_ability'] = array(
					'id' =>'match_with_in',
					'name'  => 'vietnamese_ability',
					'value' => @$vietnamese_ability,
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
				$this->data['bt_jquery'] = '';
				$lookingfor['body_type_options'] = '';
				$btcount='1';
				if(is_array($old_data))
				{
					$bt_array = explode('|' , $old_data['body_type']);
				}
				foreach($this->lang->language['body_type_options'] as $btvalue)
				{
					$this->data['match']['body_type'][$btcount] = array(
						'name'  => 'body_type',
						'value' => $btvalue,
						'options'=> $btvalue,
						'form_options'=> 'id="match_body_type" class="form-control"',
					);
					$this->data['bt_jquery'].='\''.str_replace(' ', '_', $btvalue).'\': $("#match_'.str_replace(' ', '_', $btvalue).'").attr(\'checked\'),';
					if(isset($bt_array)&&is_array($bt_array))
					{
						
						if(in_array($btvalue, $bt_array))
						{
							$this->data['match']['body_type'][$btcount]['selected'] = 'selected';
						}
					}
					$btcount++;
					//echo $btvalue.' '.$btcount;
				}
				
				$this->data['match']['ethnicity'] = array(
					'name'  => 'ethnicity',
					'value' => @$ethnicity,
					'options'=> $this->lang->language['reg_ethnicity_options'],
					'form_options'=> 'id="match_ethnicity" class="form-control"',
				);	

				//new boxes of background and cultural details
				$this->data['match']['religion'] = array(
					'id'=>'match_religion',
					'name'  => 'religion',
					'value' => @$religion,
					'options'=> $this->lang->language['reg_religion_options'],
					'form_options'=> 'id="match_religion" class="form-control"',
				);
				$this->data['match']['chinese_sign'] = array(
					'id'=>'chinese_sign',
					'name'  => 'chinese_sign',
					'value' => @$chinese_sign,
					'options'=> $this->lang->language['reg_chinese_signs_options'],
					'form_options'=> 'id="match_chinese_sign" class="form-control"',
				);	
				$this->data['match']['star_sign'] = array(
					'id'=>'star_sign',
					'name'  => 'star_sign',
					'value' => @$star_sign,
					'options'=> $this->lang->language['reg_star_signs_options'],
					'form_options'=> 'id="match_star_sign" class="form-control"',
				);
				$this->data['match']['living_situation'] = array(
					'id'=>'living_situation',
					'name'  => 'living_situation',
					'value' => @$living_situation,
					'options'=> $this->lang->language['living_situation_options'],
					'form_options'=> 'id="match_living_situation" class="form-control"',
				);	
				$this->data['match']['incomeperyear'] = array(
					'id'=>'incomeperyear',
					'name'  => 'incomeperyear',
					'value' => @$incomeperyear,
					'options'=> $this->lang->language['incomeperyear_options'],
					'form_options'=> 'id="match_incomeperyear" class="form-control"',
				);		
				$this->data['match']['workingstatus'] = array(
					'id'=>'workingstatus',
					'name'  => 'workingstatus',
					'value' => @$workingstatus,
					'options'=> $this->lang->language['workingstatus_options'],
					'form_options'=> 'id="match_workingstatus" class="form-control"',
				);				
				//end new boxes of background and cultural details	
		
		
		$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
		$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
		
		$this->data['template_footer']['profile_manager_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/profile_manager_footer_js', $this->data, TRUE);
		$this->load->template('profile_manager', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
	}
	
	function profile_id_upload()
	{
		$this->load->blank_template('profile_id_upload', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
	}
}	
