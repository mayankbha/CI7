<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax extends CI_Controller
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
		
		$this->load->model('tax_model');
		$this->load->model('product_model');
		
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {
		$this->load->admin_template('tax-list', $this->data, $return = FALSE);		
    }
    
    public function add($id = 0)
    {
		$post = $this->input->post();
        if (!empty($post)) {
            //Set Validation Rules
            $this->form_validation->set_rules('country_id', 'Country', 'required');
            $this->form_validation->set_rules('tax_rate', 'Tax Rate', 'required|numeric');
            if ($this->form_validation->run() == TRUE) {
				
				//Save Product
				$post['tax_id'] = (int) $id;
                $add_id = $this->tax_model->add($post);
                
                if (is_int($add_id)) {
					
                    $message = 'Tax Rate added Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/tax'));
                    //redirect(base_url('admins/product'));
                    die();
                }
                if ($add_id==TRUE) {
					
					$message = 'Tax Rate updated Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/tax'));
                    die();
                }
            }
        }
        //Page heading
		$this->data['page_head'] = 'Create New Tax Recoed';
		
		$current_country = NULL;
		//Check if update need
        if ($id != 0) {
			$this->data['page_head'] = 'Edit Tax Recoed';
            $search = array('tax_id' => $id);
            $tax = $this->tax_model->get_row(TRUE, $search);
            $this->data['data'] = $tax;
            $current_country = $tax['country_id'];
        }
        //Setup Cpuntry
        $this->data['countries'] = $this->tax_model->get_country_list($current_country);
		//echo '<pre>'; echo $this->db->last_query(); print_r($this->data['countries']); die;
        
        $this->load->admin_template('tax-form', $this->data, $return = FALSE);
    }
     
	function get_all()
	{
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("country_id", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("country_id" => "",);
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->tax_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $user = $this->tax_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
        $data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
        $this->load->view('json_view', array('data' => $data));
    }
	
	
	public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->tax_model->delete($id);
            $message = 'Tax Record deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/tax'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/tax'));
            die();
        }
    }
}
