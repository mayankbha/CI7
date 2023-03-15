<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Forums extends CI_Controller
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
		$this->load->model('forum_model');
		//$this->load->model('productcat_model');
		$this->data['logged'] = check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {
		$this->load->admin_template('forum_data', $this->data, $return = FALSE);		
    }
    
   /*function get_all()
	{ 
        $post = $this->input->post();

        $total_rows = 200;
		
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("name", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("name" => "",);
        //echo '<pre>'; print_r($sort);die;
		//echo $this->forum_model->totat_count(); die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->forum_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
		//var_dump($data); die;
        $user['data'] = $this->forum_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
        //var_dump($user); die;
		$data['data'] = $user['data'];
		
		
        $data['totalRows'] = $data['totalRows'];
		//print_r($data);die;
        $this->load->view('json_view', array('data' => $data));
    }*/
	
	function get_all()
	{
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("id", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("name" => "",);
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage'	=> 1,
            'totalRows'		=> $this->forum_model->totat_count(),
            'perPage' 		=> $per_page,
            'sort' 			=> $sort,
            'filter' 		=> $filter,
            'currentPage' 	=> $current_page,
            'data' 			=> array(),
            'posted' 		=> $post
        );
        $user = $this->forum_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
		
        $data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
        $this->load->view('json_view', array('data' => $data));
    }
	
	
	 public function add($id = 0)
    {
		$post = $this->input->post();
        if (!empty($post)) { 
            //Set Validation Rules
            $this->form_validation->set_rules('name','Forum Name', 'required');
            //$this->form_validation->set_rules('emails', 'Email', 'valid_emails');
            if ($this->form_validation->run() == TRUE) { 
                //Set id
                $post['id'] = (int) $id;
                
                //Save Data
				$add_id = $this->forum_model->add($post);
				
				if (is_int($add_id)) {
                    $message = 'Forum added Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/forums'));
                    die();
                }
                if ($add_id == TRUE) {
                    $message = 'Forum updated Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    
					redirect(base_url('admins/forums')); 
                    die();    
                }
            }
        }
		$this->data['all_forumgroup']	= $this->forum_model->get_forum_group();
		
		//Get Forum colors
		$this->data['forum_color']		= $this->forum_model->get_forum_color();
		//print_r($this->data['forum_color']);die;
		
        //Check if update need
        if ($id != 0) { 
            $search = array('id' => $id);
            $this->data['data'] = $this->forum_model->get_row(TRUE, $search);
			//print_r($this->data['data']); die;
        }
        
		
        $this->load->admin_template('forum_form', $this->data, $return = FALSE);
    }
	
		public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->forum_model->delete($id);
            $message = 'Category deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/forums'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/forums'));
            die();
        }
    }
	
	public function update_status($id = 0, $status = 0) {
	
        //Check if id setes need   
        if ($id != 0) {
            $this->forum_model->update_status($id,$status);
            $message = 'Product Status Updated Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/forums'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/forums'));
            die();
        }
    }

}