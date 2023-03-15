<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

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
		$this->lang->load('base', 'english');
		$this->load->model('member_model');
		$this->load->model('mail_model');
		$current_template='asian';
		$this->session->set_userdata(array('current_template'=>'asian'));
		//$this->data['logged']=check_login($this->session->userdata, 'member');
	}

	function index()
	{

		if(isset($_POST['save'])&&$_POST['save']=='select_avatar'){
			echo $this->member_model->set_profile_avatar($_POST['id']);
		}
		//save match data
		
		if(isset($_POST['save'])&&$_POST['save']=='questions_save'){
			$message=$this->member_model->clear_questions($this->session->userdata['user_id']);
			foreach($_POST as $qkey=>$qvalue){
				if($qkey!='save'){
					//echo $qkey;
					$data['question_id']=str_replace('questions_', '', $qkey);
					$data['answer']=$qvalue;
					$data['user_id']=$this->session->userdata['user_id'];
					$message=$this->member_model->save_questions($data);
				}
			}	
		}
		if(isset($_POST['save'])&&$_POST['save']=='match'){
			foreach($_POST as $pkey => $pvalue){
				if($pkey!='save'){
					$data[$pkey] = $pvalue;
				}
			}
			$message = $this->member_model->save_profile_match($data);
			
			echo $message;
		}
		
		//edit_profile
		if(isset($_POST['save'])&&$_POST['save'] == 'edit_profile'){
			foreach($_POST as $pkey=>$pvalue){
				if($pkey!='save'&&$pkey!='profile_head'&&$pkey!='about_yourself'&&$pkey!='looking_for_in_partner'){
					$data[$pkey]=$pvalue;
				} elseif($pkey!='save') {
					$data2[$pkey]=$pvalue;
				}
			}
			
			$message = $this->member_model->save_edit_profile($data, $data2);		
		}
		
		//save personality
		if(isset($_POST['save'])&&$_POST['save'] == 'save_personality')
		{
			$data['fav_movie']					= $_POST['fav_movie'];
			$data['fav_book']					= $_POST['fav_book'];
			$data['food_you_like']				= $_POST['food_you_like'];
			$data['music_you_like']				= $_POST['music_you_like'];
			$data['your_hobies']				= $_POST['your_hobies'];
			$data['describe_your_dress'] 		= $_POST['describe_your_dress'];
			$data['describe_your_sense'] 		= $_POST['describe_your_sense'];
			$data['describe_your_personality'] 	= $_POST['describe_your_personality'];
			$data['you_travelled'] 				= $_POST['you_travelled'];
			$data['adaptive_are_you'] 			= $_POST['adaptive_are_you'];
			
			$message = $this->member_model->save_personality_details($data);		
		}
		//end personality section
		
		if(isset($_POST['save'])&&$_POST['save']=='hobbies_save'){
			if(isset($_POST['hobbies'])){
				$data['hobbies']	= implode('|', $_POST['hobbies']);
			}
			if(isset($_POST['food'])){
				$data['food']	= implode('|', $_POST['food']);
			}		
			
			if(isset($_POST['music'])){
				$data['music']	= implode('|', $_POST['music']);
			}
			
			if(isset($_POST['sports'])){
				$data['sports']	= implode('|', $_POST['sports']);
			}
			
			
			$message = $this->member_model->clear_interest($this->session->userdata['user_id']);
			$message = $this->member_model->save_interest($data);
		}
		//echo 'xxx';
		
		
		//search recepient mail compose
		if(isset($_POST['search_recepient'])){
				//print_r($_POST);
				$recepients = $this->member_model->recepient_search($_POST['search_recepient']);
				//print_r($recepients);
				$data='';
				if($recepients){
					foreach($recepients as $rkey => $rvalue){
						//print_r($rvalue);
						
						$profile = $this->member_model->get_main_id($rvalue['id']);
						$data.='
						<div id="'.$rvalue['id'].'" class="add_user" style="cursor:pointer;line-height:13px;font-size:13px;float:left;height:100px;width:100px;">
						<div class="member-avatar" style="margin-top:10px;height:80px;width:80px;background:url(\'/uploads/profile/thumbnail/'.$profile['name'].'\')">
							<img id="check_overlay" src="/template/asian/resources/images/check_overlay.png">
						</div>
						
						'.str_replace($_POST['search_recepient'], '<b><font style="color:#2090f9">'.$_POST['search_recepient'].'</font></b>', $rvalue['first_name']).'
						'.str_replace($_POST['search_recepient'], '<b><font style="color:#2090f9">'.$_POST['search_recepient'].'</font></b>', $rvalue['last_name']).'
						
						</div>
						';
					}
				}
				echo $data;
				//echo 'xxxxxxxxx';
			//$message=$this->member_model->clear_interest($this->session->userdata['user_id']);
			//$message=$this->member_model->save_interest($data);
		}
		if(isset($_POST['add_star'])&&$_POST['add_star']=='inbox'){
			print_r($_POST);
			$this->mail_model->add_star_inbox($_POST['mail_id']);
		}
				
		if(isset($_POST['remove_star'])&&$_POST['remove_star']=='inbox'){
			print_r($_POST);
			$this->mail_model->remove_star_inbox($_POST['mail_id']);
		}
		
		if(isset($_POST['user_block'])&&$_POST['user_block']=='inbox'){
			//print_r($_POST);
			$this->mail_model->user_block($_POST['mail_id']);
		}
		
		if(isset($_POST['user_unblock']) && $_POST['user_unblock'] == 'user_unblock')
		{
			$this->mail_model->delete_block_user($_POST['mail_id']);
		}
					
	}
}	
