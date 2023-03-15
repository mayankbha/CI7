<?php

/**
 * Description of MY_Controller
 *
 * @author 
 */
class MY_Controller extends CI_Controller
{
    public $data = array();

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(false);
		
		$this->load->model('member_model');
		
		//get newest member
		$this->data['newest_member'] = $this->member_model->get_newest_member_list();
		foreach($this->data['newest_member'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']);
				$this->data['users'][$value['id']]['age_between'] = $this->member_model->age_between($value['id']);  //age_between
			}
		
		if(isset($this->session->userdata['user_id']))
		{
			//get profile pic at header
			$this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
			
			foreach($this->data['profile'] as $value)
				{
					//get thread user profile pic
					$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
				}
    		
			//get advance search donation user list 
			$this->data['advancesearch_donation'] = $this->member_model->get_advcsr_don_user();
			//print_r($this->data['advancesearch_donation']);echo 'sdf';die;
		}
	}
	
	

}
