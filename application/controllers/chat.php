<?php 

/**
 * Description of chat
 *
 * @author 
 */
 
class Chat extends MY_Controller
{

    private $user_id = 1;

    public function __construct()
    {
        parent::__construct();
		
		//load languages
		 $this->load->helper('language');
        $this->lang->load('_search', 'english');
        $this->lang->load('_forms_locations', $this->config->item('language'));
        //$this->lang->load('base', 'english');

        $this->lang->load('_header_navigation', $this->config->item('language'));
        $this->lang->load('_splash', $this->config->item('language'));
        $this->lang->load('_forms', $this->config->item('language'));
        $this->lang->load('_footer', $this->config->item('language'));
        
		$this->load->model('format_model');
		$this->load->model('member_model');
        
		if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }
        $this->load->model('chat_model');
        $user = $this->ion_auth->user()->row();
        if ($user)
        {
            $this->user_id = $user->id;
        }
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
		$this->data['title'] = 'Dumpflings - chat';
    }

    public function index()
    {
	
        $this->data['user'] = $this->ion_auth->user()->row();
		//print_r($this->data);
        //$this->load->view('chat-view', $data);
		$this->load->template('chat-view', $this->session->userdata['current_template'], $this->data, $return = FALSE);
    }

    public function get_chat()
    {
        $from_user = $this->user_id;
        $to_user = $this->input->post('to_user');
        $last_chat_id = $this->input->post('last_chat_id');
        $this->data['chat_history'] = $this->chat_model->get_all($from_user, $to_user, $last_chat_id);
        //echo $this->db->last_query(); die;
        $last_chat = end($this->data['chat_history']);
        $this->data['last_chat_id'] = isset($last_chat['id']) ? $last_chat['id'] : FALSE;
        $this->json_output($this->data);
    }

    public function add_chat()
    {
        $from_user = $this->user_id;
        $to_user = $this->input->post('to_user');
        $message = $this->input->post('message');
        $chat_id = '';
        if ($to_user != "" && $message != "")
        {
            $save_data = array(
                'fk_from_user_id' => $this->user_id,
                'fk_to_user_id' => $to_user,
                'message' => $message,
                'time' => time(),
            );
            $chat_id = $this->chat_model->save($save_data);
        }
        $this->data['last_chat_id'] = $chat_id;
        $this->data['status'] = true;
        $this->json_output($this->data);
    }

    public function test()
    {
        $chat_history = $this->chat_model->get_all(1, 2);
        echo '<pre>';
        print_r($chat_history);
        echo '</pre>'; //die;
        //$this->load->view('chat-view');
    }

    private function json_output($data = array())
    {
		$this->output->enable_profiler(FALSE);
        $this->load->view('json_view', array('data' => $data));
    }

    public function get_online_users()
    {
        //$data['online_users'] = $this->chat_model->online_users($this->user_id);
		$data['online_users'] = $this->member_model->login_user();
		//print_r($data['online_users']);die;       
        $data['count'] = count($data['online_users']);
        $this->json_output($data);
    }

}
