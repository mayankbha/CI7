<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of search
 * 
 * @author  
 */
 
class Search extends CI_Controller
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
       
	   	$this->lang->load('_search', 'english');
        $this->lang->load('_forms_locations', $this->config->item('language'));
	   
	    $this->load->model('format_model');
        $this->load->model('member_model');
		
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
		
        $current_template = 'asian';
        $this->session->set_userdata(array('current_template' => 'asian'));
        if (!$this->ion_auth->logged_in())
        {
            $this->data['logged'] = check_login($this->session->userdata, 'member');
        }
		
		//same for all functions
		
		$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
		foreach($this->data['profile'] as $value)
			{
				//get thread user profile pic
				$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
			}
		
		//Prepare search form data               
        $this->data['looking_for'] = array(
            'name' => 'looking_for',
            'value' => $this->session->userdata('looking_for'),
            'options' => $this->lang->language['gender'],
            'form_options' => 'id="looking_for" class="form-control"',
        );
		
		//get newest member
		$this->data['newest_member'] = $this->member_model->get_newest_member_list();
		foreach($this->data['newest_member'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['age_between'] = $this->member_model->age_between($value['id']);  //age_between  
			}
		$this->data['countries'] = $this->lang->line('reg_countries_options');
		
		$this->data['title'] = 'Dumpflings - search';
		//get advance search donation user list 
		$this->data['advancesearch_donation'] = $this->member_model->get_advcsr_don_user();	
		//echo "<pre>";print_r($this->data['advancesearch_donation']);die;
		
		
		$this->data['users']['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
		//print_r($this->data['users']['donate_user']);die;
		
		
	}

    public function index()
    {
		//print_r($_POST);die;
		   $search = array(
            'looking_for' => $this->input->post('looking_for'),
            'min_age' => ($this->input->post('min_age')) ? $this->input->post('min_age') : 18,
            'max_age' => ($this->input->post('max_age')) ? $this->input->post('max_age') : 99,
            'country' => ($this->input->post('country')) ? $this->input->post('country') : NULL,
            'state_province' => $this->input->post('state_province'),
			'city' => $this->input->post('city'),
            'have_pic' => $this->input->post('profile_pic'),
			'within' => $this->input->post('within'),
        );
		
		/*if($this->input->post('within'))
		{
			//calculate distance
			$post_city = $this->member_model->get_city_name($this->input->post('city'));
			$user_city = $this->member_model->get_profile_by_id($this->session->userdata['user_id']);
			$from = $user_city['city']; //"ujjain";
			$to = $post_city; //"indore";
			$from = urlencode($from);
			$to = urlencode($to);
			$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
			
			$data = json_decode($data);
			$time = 0;
			$distance = 0;
			foreach($data->rows[0]->elements as $road) 
			{
				//$time += $road->duration->value; //sec
				//$distance += $road->distance->value; // meter
				$distance += $road->distance->text; // km
			}
			echo "To: ".$data->destination_addresses[0];
			echo "<br/>";
			echo "From: ".$data->origin_addresses[0];
			echo "<br/>";
			echo "Distance: ".$distance." km";
			//calculate distance
			
		}*/
		
		
        $search_result = $this->member_model->search($search);
		
		$this->data['search_result'] = count($search_result);
		if($this->input->post('profile_pic') != '')
		{
			if (is_array($search_result) && count($search_result) > 0)
			{
				foreach ($search_result as $srkey => $srvalue)
				{
					//print_r($this->member_model->get_profile_by_id($srvalue['user_id']));
					$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
					//$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id'] = ''); 27octbk
					$this->data['users'][$srvalue['id']]['avatar'] = $this->member_model->get_profile_pic($srvalue['id']);
					$this->data['users'][$srvalue['id']]['age_between'] = $this->member_model->age_between($srvalue['id']);
				}
			}
		}else{
			if (is_array($search_result) && count($search_result) > 0)
			{
				foreach ($search_result as $srkey => $srvalue)
				{
					$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
				}
			}
		}
		//print_r($found_users[$srvalue['user_id']]);die;
		
        $this->data['found_users'] = @$found_users;
		$data = array();
       
        $this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
        
		if(isset($_POST)){
			$this->data['looking_for'] = array(
				'name' => 'looking_for',
				'value' => $this->input->post('looking_for'),
				'options' => $this->lang->language['gender'],
				'form_options' => 'id="looking_for" class="form-control"',
			);
		}
		$this->load->template('search_result_profile', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
    }
	
	/*public function index()
    {
       // echo '<pre>';print_r($_POST);die;
        $search = array(
            'looking_for' => $this->input->post('looking_for'),
            'min_age' => ($this->input->post('min_age')) ? $this->input->post('min_age') : 18,
            'max_age' => ($this->input->post('max_age')) ? $this->input->post('max_age') : 99,
            'country' => ($this->input->post('country')) ? $this->input->post('country') : NULL,
            'state_province' => $this->input->post('state_province'),
            'have_pic' => $this->input->post('have_pic'),
        );
		//print_r($search);die;
        $search_result = $this->member_model->search($search);
        $this->data['search_result'] = count($search_result);
        
        if (is_array($search_result) && count($search_result) > 0)
        {
            foreach ($search_result as $srkey => $srvalue)
            {
                //print_r($this->member_model->get_profile_by_id($srvalue['user_id']));
                $found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
				$this->data['users'][$srvalue['id']]['avatar'] = $this->member_model->get_profile_pic($srvalue['id']);
				$this->data['users'][$srvalue['id']]['age_between'] = $this->member_model->age_between($srvalue['id']);
            }
        }
        $this->data['found_users'] = @$found_users;
		$data = array();
       
        $this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
        
        //Prepare search form data               
        $this->data['looking_for'] = array(
            'name' => 'looking_for',
            'value' => $this->session->userdata('looking_for'),
            'options' => $this->lang->language['gender'],
            'form_options' => 'id="looking_for" class="form-control"',
        );
		
		
		$this->load->template('search_result_profile', $this->session->userdata['current_template'],  $this->data, $return = FALSE);	
    }*/
	
	
	//################################################## Advance Search ######################################################################
	
	
	/*function advancesearch()
	{
		echo "<pre>";print_r($_POST);die;
		$this->data['height_range'] = '100;250';
		//$this->data['match']['height_range_default'] = explode(';', $this->data['height_range']);
		
		$this->data['height_range_default'] = explode(';', $this->data['height_range']);
		$this->data['weight_range'] = '30;250';
		
		//$this->data['weight_range'] = '25000000;35000000';
		
		//$this->data['match']['weight_range_default'] = explode(';', $this->data['weight_range']);
		$this->data['weight_range_default'] = explode(';', $this->data['weight_range']);
		if(isset($_POST['search']))
			{
				
				$i_am 				= $this->input->post('gender');   
				$looking_for 		= $this->input->post('looking_for');   
				$min_age 			= ($this->input->post('min_age')) ? $this->input->post('min_age') : 18;   
				$max_age 			= ($this->input->post('max_age')) ? $this->input->post('max_age') : 99;   
				//$living_in 		= ($this->input->post('country')) ? $this->input->post('country') : NULL;       
				//$living_in2 		= $this->input->post('state_province');
				$nationality 		= $this->input->post('nationality'); 
				$education 			= $this->input->post('education'); 
				$english_ability 	= $this->input->post('english_ability'); 
				$religion 			= $this->input->post('religion');
				$height				= $this->input->post('height');
				$weight				= $this->input->post('weight');
				$body_type			= $this->input->post('body_type');
				$ethnicity			= $this->input->post('ethnicity');
				$vietnamese_ability	= $this->input->post('vietnamese_ability');    
				$appearance			= $this->input->post('myselfconsider_options');
				$relationship_your_looking_for	= $this->input->post('lookingfor_options');
				//$search_result = $this->member_model->advancesearch($i_am, $looking_for, $min_age, $living_in, $living_in2, $nationality, $education, $english_ability, $religion); 
				
				//$search_result = $this->member_model->advancesearch($i_am, $looking_for, $min_age, $nationality, $education, $english_ability, $religion,$height,$weight,$body_type,$ethnicity,$vietnamese_ability);
				
				$search_result = $this->member_model->advancesearch($i_am, $looking_for, $min_age, $nationality, $education, $english_ability, $religion,$height,$weight,$body_type,$appearance,$relationship_your_looking_for);
				
				//print_r($search_result);die;
				$this->data['search_result'] = count($search_result);
				
				if (is_array($search_result) && count($search_result) > 0)
				{
					foreach ($search_result as $srkey => $srvalue)
					{
						//echo '<pre>';print_r($this->member_model->get_profile_by_id($srvalue['user_id']));  
						$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id'] = '');
					}
					
				}
				$this->data['found_users'] = @$found_users;
				$this->load->template('search_result_profile', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}else
			{
				//echo $this->session->userdata('looking_for').'looking for';die;
				$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
				
				//get looking for gender
				$this->data['getlooking_for'] = $this->member_model->get_looking_for();
				
				//Prepare search form data     
				$this->data['looking_for'] = array(
					'name' => 'looking_for',
					'value' => $this->session->userdata('looking_for'),
					'options' => $this->lang->language['gender'],
					'form_options' => 'id="looking_for" class="form-control"',
				);
				
				$this->data['nationality'] = array(
						'name'  => 'nationality',
						'value' => $this->form_validation->set_value('nationality'),
						'options' => $this->lang->language['reg_nationality_options'],
						'form_options' => 'id="nationality" class="form-control"',
					);			
								
				$this->data['education'] = array(
						'name'  => 'education',
						'value' => $this->form_validation->set_value('education'),
						'options'=> $this->lang->language['reg_education_options'],
						'form_options'=> 'id="education" class="form-control"',
					);
		
				$this->data['religion'] = array(
						'name'  => 'religion',
						'value' => $this->form_validation->set_value('religion'),
						'options'=> $this->lang->language['reg_religion_options'],
						'form_options'=> 'id="religion" class="form-control"',
					);
				
				$this->data['english_ability'] = array(
						'name'  => 'english_ability',
						'value' => $this->form_validation->set_value('english_ability'),
						'options'=> $this->lang->language['reg_english_ability_options'],
						'form_options'=> 'id="english_ability" class="form-control"',
					);
				$this->data['countries'] = $this->lang->line('reg_countries_options');
				
				
				$this->data['height'] = array(
							'name'  => 'height',
							'value' => $this->data['height_range'],
							'id' => 'match_height-sliders',
							'class' => 'form-control',
						);		
				$this->data['weight'] = array(
							'name'  => 'weight',
							'value' => $this->data['weight_range'],
							'id' => 'match_weight-sliders',
							'class' => 'form-control',
						);		
			
				$this->data['body_type'] = array(
					'name'  => 'body_type',
					'value' => $this->form_validation->set_value('body_type'),
					'options'=> $this->lang->language['reg_body_type_options'],
					'form_options'=> 'id="body_type" class="form-control"',
				);
				
				
				
				//15 oct new changes
				$this->data['lookingfor'] = array(
					'name' => 'lookingfor', 
					'options' => $this->lang->language['lookingfor_options'],
					'value' => $this->form_validation->set_value('lookingfor'),
					'form_options' => 'class="form-control" id="lookingfor"'
				);
				
				$this->data['myselfconsider'] = array(
					'name' => 'myselfconsider',
					'options' => $this->lang->language['myselfconsider_options'],
					'value' => $this->form_validation->set_value('myselfconsider'),
					'form_options' => 'id="myselfconsider" class="form-control"', 
				);
				
				
				//new box 27oct
				$this->data['living_situation'] = array(
					'name' => 'living_situation',
					'options' => $this->lang->language['living_situation_options'],
					'value' => $this->form_validation->set_value('living_situation'),
					'form_options' => 'id="living_situation" class="form-control"', 
				);
				
				$this->data['incomeperyear'] = array(
					'name' => 'incomeperyear',
					'options' => $this->lang->language['incomeperyear_options'],
					'value' => $this->form_validation->set_value('incomeperyear'),
					'form_options' => 'id="incomeperyear" class="form-control"', 
				);
				
				$this->data['workingstatus'] = array(
					'name' => 'workingstatus',
					'options' => $this->lang->language['workingstatus_options'],
					'value' => $this->form_validation->set_value('workingstatus'),
					'form_options' => 'id="workingstatus" class="form-control"', 
				);
				
				$this->data['cupsize'] = array(
					'name' => 'cupsize',
					'options' => $this->lang->language['cupsize_options'],
					'value' => $this->form_validation->set_value('cupsize'),
					'form_options' => 'id="cupsize" class="form-control"', 
				);
				
				$this->data['hair_color'] = array(
					'name' => 'hair_color',
					'options' => $this->lang->language['reg_hair_color_options'],
					'value' => $this->form_validation->set_value('cupsize'),
					'form_options' => 'id="reg_hair_color" class="form-control"', 
				);
				
				$this->data['eye_color'] = array(
					'name' => 'eye_color',
					'options' => $this->lang->language['reg_eye_color_options'],
					'value' => $this->form_validation->set_value('eye_color'),
					'form_options' => 'id="reg_eye_color" class="form-control"', 
				);
				// life style boxes
				$this->data['drink'] = array(
					'name' => 'drink',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('drink'),
					'form_options' => 'id="reg_drink" class="form-control"', 
				);
				
				$this->data['smoke'] = array(
					'name' => 'smoke',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('smoke'),
					'form_options' => 'id="reg_smoke" class="form-control"', 
				);
				
				$this->data['marital_status'] = array(
					'name' => 'marital_status',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('marital_status'),
					'form_options' => 'id="reg_marital_status" class="form-control"', 
				);
				
				$this->data['have_children'] = array(
					'name' => 'have_children',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('have_children'),
					'form_options' => 'id="reg_have_children" class="form-control"', 
				);
				
				$this->data['occupation'] = array(
					'name' => 'occupation',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('occupation'),
					'form_options' => 'id="reg_occupation" class="form-control"', 
				);
				
				$this->data['willing_to_relocate'] = array(
					'name' => 'willing_to_relocate',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('willing_to_relocate'),
					'form_options' => 'id="reg_willing_to_relocate" class="form-control"', 
				);
				//end life style boxes
				
				//end new box


				$this->data['found_users'] = @$found_users;
				
				$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);   
				
				//testing
				$this->data['template_footer']['advancesearch_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/advancesearch_footer_js', $this->data, TRUE);
				//testing
				
				$this->load->template('advance_search', $this->session->userdata['current_template'],$this->data, $return = FALSE);	
   	 	}
	}*/
	
	public function add()
    {
		$post = $this->input->post();
        if (!empty($post)) 
		{ 
			//Save Data 
			$add_id = $this->member_model->add($post);
			
			if ($add_id != '') 
			{
				$message = 'Sent Heart Successfully';
				$this->session->set_flashdata('message', array(
					'message' => $message,
					'type' => 'success'
				));
				redirect($_SERVER['HTTP_REFERER'].'?msg='.$message);
				//redirect(base_url('/search_result?msg='.$message)); //redirect page to search_result page with message.
				die();
			}
		}
    }
	
	//like function
	public function like($receiver_id,$sender_id)
	{
		$add_id = $this->member_model->like($receiver_id,$sender_id);
		if ($add_id != '') 
			{
				$message = 'Sent Interest Successfully';
				redirect($_SERVER['HTTP_REFERER'].'?msg='.$message);
				//redirect(base_url('/search_result/?msg='.$message)); //redirect page to search_result page with message.
				die();
			}
	}
	
	public function unlike($receiver_id,$sender_id)
	{
		$add_id = $this->member_model->unlike($receiver_id,$sender_id);
		if ($add_id != '') 
			{
				redirect(base_url('/search_result/')); //redirect page to search_result page with message.
				die();
			}
	}
	
	public function warning()
	{
		$post = $this->input->post();
        if (!empty($post)){ 
			//Save Data
			$add_id = $this->member_model->add_warning($post);
			if ($add_id != '') 
			{
				$message = 'Sent Warning Successfully';
				$this->session->set_flashdata('message', array(
					'message' => $message,
					'type' => 'success'
				));
				redirect($_SERVER['HTTP_REFERER'].'?msg='.$message);
				//redirect(base_url('/search_result?msg='.$message)); //redirect page to search_result page with message.
				die();
			}
		}
	}
	
	//Add to favourite function
	public function favorite($receiver_id,$sender_id)
	{
		$add_id = $this->member_model->favorite($receiver_id,$sender_id);
		if ($add_id != '')
			{
				$message = 'Add To Favourites Successfully';
				redirect(base_url('/search_result?msg='.$message)); //redirect page to search_result page with message.
				die();
			}
	}
	
	function advancesearch()
	{
		//echo "<pre>";print_r($this->input->post('looking_for'));die;
		$this->data['height_range'] = '100;250';
		//$this->data['match']['height_range_default'] = explode(';', $this->data['height_range']);
		
		$this->data['height_range_default'] = explode(';', $this->data['height_range']);
		$this->data['weight_range'] = '30;250';
		
		//$this->data['weight_range'] = '25000000;35000000';
		
		//$this->data['match']['weight_range_default'] = explode(';', $this->data['weight_range']);
		$this->data['weight_range_default'] = explode(';', $this->data['weight_range']);
				
		if(isset($_POST['search']))
			{
				//echo "<pre>";print_r($_POST);
				//$lookingfor = implode('|',$this->input->post('lookingfor'));
				$data = array(
						'looking_for' 		=> $this->input->post('looking_for'),
						'min_age' 			=> ($this->input->post('min_age')) ? $this->input->post('min_age') : 18,  
						'max_age' 			=> ($this->input->post('max_age')) ? $this->input->post('max_age') : 99,   
						'nationality' 		=> $this->input->post('nationality'),
						'education' 		=> $this->input->post('education'),
						'english_ability' 	=> $this->input->post('english_ability'), 
						'religion' 			=> $this->input->post('religion'),
						'living_situation'	=> $this->input->post('living_situation'),
						'incomeperyear'		=> $this->input->post('incomeperyear'),
						'workingstatus'		=> $this->input->post('workingstatus'),
						'hair_color'		=> $this->input->post('hair_color'),
						'eye_color'			=> $this->input->post('eye_color'),
						'height'			=> $this->input->post('height'),
						'weight'			=> $this->input->post('weight'),
						'body_type'			=> $this->input->post('body_type'),
						'drink'				=> $this->input->post('drink'),    
						'smoke'				=> $this->input->post('smoke'),	
						'marital_status'	=> $this->input->post('marital_status'),
						'have_children'		=> $this->input->post('have_children'),
						'occupation'		=> $this->input->post('occupation'),
						'willing_to_relocate'		=> $this->input->post('willing_to_relocate'),
						'lookingfor'		=> $this->input->post('lookingfor'),
						//'lookingfor_options'	=> $lookingfor,
						'myselfconsider_options'	=> $this->input->post('myselfconsider_options'),
						'chinese_sign'		=> $this->input->post('chinese_sign'),
						'star_sign'			=> $this->input->post('star_sign'),
						'cupsize'	=> $this->input->post('cupsize'),
				);
				//print_r($data);die;
				$search_result = $this->member_model->advancesearch($data);
				
				//print_r($search_result);die;
				$this->data['search_result'] = count($search_result);
				
				if (is_array($search_result) && count($search_result) > 0)
				{
					foreach ($search_result as $srkey => $srvalue)
					{
						//echo '<pre>';print_r($this->member_model->get_profile_by_id($srvalue['user_id']));  
						$found_users[$srvalue['user_id']] = $this->member_model->get_profile_by_id($srvalue['user_id']);
					}
					
				}
				$this->data['found_users'] = @$found_users;
				$this->load->template('adv_search_result_profile', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		}else
			{
				//echo $this->session->userdata('looking_for').'looking for';die;
				$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
				
				//get looking for gender
				$this->data['getlooking_for'] = $this->member_model->get_looking_for();
				
				//Prepare search form data     
				$this->data['looking_for'] = array(
					'name' => 'looking_for',
					'value' => $this->session->userdata('looking_for'),
					'options' => $this->lang->language['gender'],
					'form_options' => 'id="looking_for" class="form-control"',
				);
				
				$this->data['nationality'] = array(
						'name'  => 'nationality',
						'value' => $this->form_validation->set_value('nationality'),
						'options' => $this->lang->language['reg_nationality_options'],
						'form_options' => 'id="nationality" class="form-control"',
					);			
								
				$this->data['education'] = array(
						'name'  => 'education',
						'value' => $this->form_validation->set_value('education'),
						'options'=> $this->lang->language['reg_education_options'],
						'form_options'=> 'id="education" class="form-control"',
					);
		
				$this->data['religion'] = array(
						'name'  => 'religion',
						'value' => $this->form_validation->set_value('religion'),
						'options'=> $this->lang->language['reg_religion_options'],
						'form_options'=> 'id="religion" class="form-control"',
					);
				
				$this->data['english_ability'] = array(
						'name'  => 'english_ability',
						'value' => $this->form_validation->set_value('english_ability'),
						'options'=> $this->lang->language['reg_english_ability_options'],
						'form_options'=> 'id="english_ability" class="form-control"',
					);
				$this->data['countries'] = $this->lang->line('reg_countries_options');
				
				
				$this->data['height'] = array(
							'name'  => 'height',
							'value' => $this->data['height_range'],
							'id' => 'match_height-sliders',
							'class' => 'form-control',
						);		
				$this->data['weight'] = array(
							'name'  => 'weight',
							'value' => $this->data['weight_range'],
							'id' => 'match_weight-sliders',
							'class' => 'form-control',
						);		
			
				$this->data['body_type'] = array(
					'name'  => 'body_type',
					'value' => $this->form_validation->set_value('body_type'),
					'options'=> $this->lang->language['reg_body_type_options'],
					'form_options'=> 'id="body_type" class="form-control"',
				);
				
				
				
				//15 oct new changes
				
				
				// relationship is looking for
				$rcount='1';
				$lookingfor['relationship_is_looking_for_options'] = '';
				
				foreach($this->lang->language['relationship_is_looking_for_options'] as $hvalue)
				{
					
					$this->data['lookingfor']['relationship_is_looking_for_options'][$rcount] = array(
						'name'  => 'lookingfor',
						'value' => $hvalue,
						'options'=> $hvalue,
						'form_options'=> 'id="Rel_lookingfor" class="form-control"',
					);
					$rcount++;
				}	
				// end relationship is looking for
				
				
				/*$this->data['lookingfor'] = array(
					'name' => 'lookingfor', 
					'options' => $this->lang->language['lookingfor_options'],
					'value' => $this->form_validation->set_value('lookingfor'),
					'form_options' => 'class="form-control" id="lookingfor"'
				);*/
				
				
				$this->data['myselfconsider'] = array(
					'name' => 'myselfconsider',
					'options' => $this->lang->language['myselfconsider_options'],
					'value' => $this->form_validation->set_value('myselfconsider'),
					'form_options' => 'id="myselfconsider" class="form-control"', 
				);
				
				//new box 27oct
				$this->data['living_situation'] = array(
					'name' => 'living_situation',
					'options' => $this->lang->language['living_situation_options'],
					'value' => $this->form_validation->set_value('living_situation'),
					'form_options' => 'id="living_situation" class="form-control"', 
				);
				
				$this->data['incomeperyear'] = array(
					'name' => 'incomeperyear',
					'options' => $this->lang->language['incomeperyear_options'],
					'value' => $this->form_validation->set_value('incomeperyear'),
					'form_options' => 'id="incomeperyear" class="form-control"', 
				);
				
				$this->data['workingstatus'] = array(
					'name' => 'workingstatus',
					'options' => $this->lang->language['workingstatus_options'],
					'value' => $this->form_validation->set_value('workingstatus'),
					'form_options' => 'id="workingstatus" class="form-control"', 
				);
				//print_r($this->lang->language['cupsize_options']);die;
				$this->data['cupsize'] = array(
					'name' => 'cupsize',
					'options' => $this->lang->language['cupsize_options'],
					'value' => $this->form_validation->set_value('cupsize'),
					'form_options' => 'id="cupsize" class="form-control"', 
				);
				
				$this->data['hair_color'] = array(
					'name' => 'hair_color',
					'options' => $this->lang->language['reg_hair_color_options'],
					'value' => $this->form_validation->set_value('cupsize'),
					'form_options' => 'id="reg_hair_color" class="form-control"', 
				);
				
				$this->data['eye_color'] = array(
					'name' => 'eye_color',
					'options' => $this->lang->language['reg_eye_color_options'],
					'value' => $this->form_validation->set_value('eye_color'),
					'form_options' => 'id="reg_eye_color" class="form-control"', 
				);
				// life style boxes
				$this->data['drink'] = array(
					'name' => 'drink',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('drink'),
					'form_options' => 'id="reg_drink" class="form-control"', 
				);
				
				$this->data['smoke'] = array(
					'name' => 'smoke',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('smoke'),
					'form_options' => 'id="reg_smoke" class="form-control"', 
				);
				
				$this->data['marital_status'] = array(
					'name' => 'marital_status',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('marital_status'),
					'form_options' => 'id="reg_marital_status" class="form-control"', 
				);
				
				$this->data['have_children'] = array(
					'name' => 'have_children',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('have_children'),
					'form_options' => 'id="reg_have_children" class="form-control"', 
				);
				
				$this->data['occupation'] = array(
					'name' => 'occupation',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('occupation'),
					'form_options' => 'id="reg_occupation" class="form-control"', 
				);
				
				$this->data['willing_to_relocate'] = array(
					'name' => 'willing_to_relocate',
					'options' => $this->lang->language['search_boolean_options'],
					'value' => $this->form_validation->set_value('willing_to_relocate'),
					'form_options' => 'id="reg_willing_to_relocate" class="form-control"', 
				);
				
				
				$this->data['chinese_sign'] = array(
					'name' => 'chinese_sign',
					'options' => $this->lang->language['reg_chinese_signs_options'],
					'value' => $this->form_validation->set_value('chinese_sign'),
					'form_options' => 'id="reg_chinese_sign" class="form-control"', 
				);
				$this->data['star_sign'] = array(
					'name' => 'star_sign',
					'options' => $this->lang->language['reg_star_signs_options'],
					'value' => $this->form_validation->set_value('star_sign'),
					'form_options' => 'id="reg_star_sign" class="form-control"', 
				);
				//end life style boxes
				
				//end new box
				$this->data['found_users'] = @$found_users;
				
				$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);   
				
				//testing footer
				$this->data['template_footer']['advancesearch_footer_js'] = $this->load->view('templates/'.$this->session->userdata['current_template'].'/footer/advancesearch_footer_js', $this->data, TRUE);
				//testing footer
				
				$this->load->template('advance_search', $this->session->userdata['current_template'],$this->data, $return = FALSE);	
   	 	}
	}
	
}