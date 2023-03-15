<?php if(!defined('BASEPATH')) exit('No direct script access allowed');  

class Template_data extends CI_Controller
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
		$this->load->model('templatedata_model');
		
		$this->data['logged'] =	check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    { 
		$this->load->admin_template('template_datalist', $this->data, $return = FALSE);		
    } 
    
    public function add($id = 0)
    {
		$post = $this->input->post();
        if (!empty($post)) {
		
            //Set Validation Rules
            $this->form_validation->set_rules('group_id', 'Group Title', 'required');
            
			if ($this->form_validation->run() == TRUE) {
                //Set id
                $post['id'] = (int) $id;
               
                //Upload templates Image
                $file = explode('.', $_FILES['image_location']['name']);
                $file_name = preg_replace('/\s+/','', $post['group_id'].'_'.$post['section'].'_'.date('Y'));
                
                $config['upload_path']		=	'./uploads/templates';
				$config['allowed_types']	=	'*';
				
				//$config['encrypt_name'] = true;
				$config['max_size']			=	'1024';
				$config['file_name']		=	strtolower($file_name).'.'.end($file);
				
				$this->load->library('upload');
				$upload_error = array();
				$this->upload->initialize($config);
				$this->upload->do_upload('image_location');
				$upload_data = $this->upload->data();
				$post['image_location'] = '';
				if (!empty($_FILES['image_location']['name'])) {
					if (!$this->upload->do_upload('image_location'))
						{
							$invalid = $this->upload->display_errors();
						}else {
						$upload_data = $this->upload->data();
						$post['image_location'] = '/uploads/templates/'.$upload_data['file_name'];
					 }
				} else {
					$post['image_location'] = $post['himage_location'];
				}
				//$post['image_location'] = isset($upload_data['file_name']) ? '/uploads/templates/'.$upload_data['file_name'] : '';
				
				//Save Data
				$add_id = $this->templatedata_model->add($post);
				if (is_int($add_id)) {
                    $message = 'templates added Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'   
                    ));
                    redirect(base_url('admins/template_data'));
                    die();
                }
                if ($add_id == TRUE) {
                    $message = 'templates updated Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message, 
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/template_data'));
                    die();
                }
            }
        }
		$this->data['all_tempgroup'] = $this->templatedata_model->get_templategroup();
		
        //Check if update need
        if ($id != 0) {
            $search = array('id' => $id);
            $this->data['data'] = $this->templatedata_model->get_row(TRUE, $search); 
			//unset($this->data['all_tempgroup'][$id]); 
        }
        
        $this->load->admin_template('templatedata-form', $this->data, $return = FALSE);
    }
     
	function get_all() 
	{
        $post = $this->input->post(); 
        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("group_id", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("group_id" => "",);
        
		$data = array(
            'currentPage' => 1,
            'totalRows' => $this->templatedata_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
       
	    $user = $this->templatedata_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
		$data['data'] = $user['data']; 
        $data['totalRows'] = $user['totalRows']; 
        $this->load->view('json_view', array('data' => $data));
    }
	
	
	public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->templatedata_model->delete($id);
            $message = 'templates deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/template_data'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/template_data'));
            die();
        }
    }
	
}

