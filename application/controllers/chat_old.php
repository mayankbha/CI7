<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller {
  /* The default function that gets called when visiting the page */
  function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
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
        $this->load->model('format_model');
        $this->load->model('member_model');
        
        $current_template = 'asian';
        $this->session->set_userdata(array('current_template' => 'asian'));
        if (!$this->ion_auth->logged_in())
        {
            $this->data['logged'] = check_login($this->session->userdata, 'member');
        }
    }
  
  public function index() {       
    $this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
	$this->load->template('chat-view', $this->session->userdata['current_template'], $this->data, $return = FALSE); 
	//$this->load->view('chat-view');
  }
  
  public function get_chats() {
    /* Connect to the mySQL database - config values can be found at:
    /application/config/database.php */
    $dbconnect = $this->load->database();
    
    /* Load the database model:
    /application/models/simple_model.php */
    $this->load->model('Chat_model');
    
    /* Create a table if it doesn't exist already */
    //$this->Chat_model->create_table();
    
    echo json_encode($this->Chat_model->get_chat_after(time()));
  }
  
  public function insert_chat() {
    /* Connect to the mySQL database - config values can be found at:
    /application/config/database.php */
    $dbconnect = $this->load->database();
    
    /* Load the database model:
    /application/models/simple_model.php */
    $this->load->model('Chat_model');
    
    /* Create a table if it doesn't exist already */
    //$this->Chat_model->create_table();

    $this->Chat_model->insert_message($_REQUEST["message"]); 
  }
  
  public function time() {
    echo "[{\"time\":" +  time() + "}]";
  }
  }