<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');  

class Productcategory extends CI_Controller
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
		$this->load->model('productcat_model');
		
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {
		$this->load->admin_template('category-list', $this->data, $return = FALSE);		
    }
    
    public function add($id = 0)
    {
		$post = $this->input->post();
        if (!empty($post)) {
            //Set Validation Rules
            $this->form_validation->set_rules('category_name', 'Category Title', 'required');
            //$this->form_validation->set_rules('emails', 'Email', 'valid_emails');
            if ($this->form_validation->run() == TRUE) {
                //Set id
                $post['product_cat_id'] = (int) $id;
                
                //Upload Category Image
                $file = explode('.', $_FILES['cat_image']['name']);
                $file_name = preg_replace('/\s+/', '', $post['category_name']);
                
                $config['upload_path'] = './uploads/category';
				$config['allowed_types'] = '*';
				//$config['encrypt_name'] = true;
				$config['max_size'] = '1024';
				$config['file_name'] = strtolower($file_name).'.'.end($file);
				
				$this->load->library('upload');
				$upload_error = array();
				$this->upload->initialize($config);
				$this->upload->do_upload('cat_image');
				$upload_data = $this->upload->data();
				
				$post['cat_image'] = isset($upload_data['file_name']) ? '/uploads/category/'.$upload_data['file_name'] : '';
				
				//Save Data
				$add_id = $this->productcat_model->add($post);
				if (is_int($add_id)) {
                    $message = 'Category added Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/productcategory'));
                    die();
                }
                if ($add_id==TRUE) {
                    $message = 'Category updated Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/productcategory'));
                    die();
                }
            }
        }
		$this->data['all_category'] = $this->productcat_model->get_category();
		
		
        //Check if update need
        if ($id != 0) {
            $search = array('product_cat_id' => $id);
            $this->data['data'] = $this->productcat_model->get_row(TRUE, $search);
            unset($this->data['all_category'][$id]);
        }
        
        $this->load->admin_template('category-form', $this->data, $return = FALSE);
    }
     
	function get_all()
	{
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("category_name", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("category_name" => "",);
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->productcat_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $user = $this->productcat_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
        $data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
        $this->load->view('json_view', array('data' => $data));
    }
	
	
	public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->productcat_model->delete($id);
            $message = 'Category deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/productcategory'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/productcategory'));
            die();
        }
    }
	
}
