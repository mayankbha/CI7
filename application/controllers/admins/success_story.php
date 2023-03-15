<?php  if(!defined('BASEPATH')) exit('No direct script access allowed');  

class Success_story extends CI_Controller
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
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
		$this->load->model('successdata_model');
		
		$this->data['logged'] =	check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    { 
		$this->load->admin_template('success_datalist',$this->data,$return = FALSE);	  	
    } 
    
    public function add($id = 0)
    {
		$post = $this->input->post();
			if (!empty($post)) 
			{
				//Set Validation Rules          
				$this->form_validation->set_rules('description', 'Description', 'required');
				
				if ($this->form_validation->run() == TRUE) {
					//Set id
					$post['id'] = (int) $id;
				   
					//Upload success Image      
					$file = explode('.', $_FILES['image']['name']);  
					$file_name = preg_replace('/\s+/','', $post['id'].'_'.date('Y'));   
					
					$config['upload_path']		=	'./uploads/successstory';   
					$config['allowed_types']	=	'*';  
					//$config['encrypt_name'] 	= 	true;
					$config['max_size']			=	'1024';
					$config['file_name']		=	strtolower($file_name).'.'.end($file);
					
					$this->load->library('upload'); 
					$upload_error = array(); 
					$this->upload->initialize($config); 
					$this->upload->do_upload('image'); 
					$upload_data = $this->upload->data();
					$post['image'] = '';
					if (!empty($_FILES['image']['name']))
					{
						if (!$this->upload->do_upload('image'))
							{
								$invalid = $this->upload->display_errors();
							}else {
							$upload_data = $this->upload->data();
							$post['image'] = '/uploads/successstory/'.$upload_data['file_name'];
						 }
					}else {
						$post['image'] = $post['himage'];
						}
					//$post['image'] = isset($upload_data['file_name']) ? '/uploads/templates/'.$upload_data['file_name'] : '';
					
					//Save Data
					$add_id = $this->successdata_model->add($post);
					if (is_int($add_id))
					{
						$message = 'Success Story added Successfully';
						$this->session->set_flashdata('message', array(
							'message' => $message,
							'type' => 'success'   
						));
						redirect(base_url('admins/success_story'));
						die();
					}
					
					if ($add_id == TRUE)
					{
						$message = 'Success Story updated Successfully';
						$this->session->set_flashdata('message', array(
							'message' => $message, 
							'type' => 'success'
						));
						redirect(base_url('admins/success_story'));
						die();
					}
				}
			}
		//Check if update need
        if ($id != 0)
		{
            $search = array('id' => $id);
            $this->data['data'] = $this->successdata_model->get_row(TRUE, $search); 
        }
        
        $this->load->admin_template('successdata-form', $this->data, $return = FALSE);
    }
     
	function get_all()
	{
        $post			= $this->input->post();  
        $total_rows		= 200;
        $per_page		= $post["perPage"] ? $post["perPage"] : 10;
        $current_page 	= $post["currentPage"] ? $post["currentPage"] : 1;
        $sort			= isset($post["sort"]) ? $post["sort"] : array(array("id", "asc"),);
        $filter			= isset($post["filter"]) ? $post["filter"] : array("id" => "");
        
		$data = array(
            'currentPage' => 1,
            'totalRows' => $this->successdata_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(), 
            'posted' => $post 
        );
       
	    $user = $this->successdata_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);  
		$data['data'] = $user['data'];  
        $data['totalRows'] = $user['totalRows'];  
        $this->load->view('json_view', array('data' => $data)); 
    }
	
	public function delete($id = 0)
	{
        //Check if id setes need              
        if ($id != 0) {
            $this->successdata_model->delete($id);
            $message = 'templates deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/success_story'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message, 
                'type' => 'error' 
            ));
            redirect(base_url('admins/success_story')); 
            die(); 
        }
    }
	
}                                                     