<?php

class Orders extends CI_Controller
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
		$this->load->model('transactions_model');
		$this->load->model('product_model');
		$this->load->model('orders_model');
		$this->load->library('export');
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {
		$this->load->admin_template('orders-list', $this->data, $return = FALSE);		
    }
    
    
     
	function get_all()
	{
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("order_id", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("order_id" => "",);
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->orders_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $user = $this->orders_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
		$data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
		//echo '<pre>'; print_r($data);die;
		$this->load->view('json_view', array('data' => $data));
    }
	
	
	public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->orders_model->delete($id);
            $message = 'Order Record deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/orders'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/orders'));
            die();
        }
    }
	
	
	public function get_details($id = 0) {
        //Check if id setes need
        if ($id != 0) {
			$this->data['orders'] = $this->orders_model->get_order_by_id($id);
			$this->data['products'] = $this->orders_model->orders($id, true);
			//echo "<pre>"; print_r($this->data);die;
			$this->load->admin_template('view_order', $this->data, $return = FALSE);	
        
		} else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/transactions'));
            die();
        }
    }
		
		public function export_data($id = 0) {
			$orders = $this->orders_model->get_order_by_id($id);
			$this->export->to_excel($orders, 'OrderDetails'); 	
        }
	
	
}
