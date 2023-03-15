<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller
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
		$this->load->model('product_model');
		$this->load->model('productcat_model');
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index()
    {
		$this->load->admin_template('product-list', $this->data, $return = FALSE);		
    }
    
    public function add($id = 0)
    {
		$post = $this->input->post();
        if (!empty($post)) {
            //Set Validation Rules
            $this->form_validation->set_rules('product_title', 'Product Title', 'required');
            $this->form_validation->set_rules('price', 'Price', 'required');
            $this->form_validation->set_rules('fk_product_cat', 'Product Category', 'required|integer');
            $this->form_validation->set_rules('quantity', 'Quantity', 'integer');
            if ($this->form_validation->run() == TRUE) {
				
                //Prepare Product Array
                $product = array();
                //Set id
                $product['product_id'] = (int) $id;
                $product['fk_product_cat'] = $post['fk_product_cat'];
                $product['product_title'] = $post['product_title'];
                $product['description'] = $post['description'];
                $product['price'] = $post['price'];
                $product['weight'] = $post['weight'];
                $product['featured'] = $post['featured'];
                $product['active'] = $post['active'];
                $product['quantity'] = $post['quantity'];
                
                //Save Product
                $add_id = $this->product_model->add($product);
                
                if (is_int($add_id)) {
					
					//Save Country & Shipping details
					$count = $this->product_model->save_product_country($add_id, $post['countries'], $post['shipping_normal'], $post['shipping_express']);
					//echo $count; die;
                    $message = 'Product added Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/product_images/index/'.$add_id));
                    //redirect(base_url('admins/product'));
                    die();
                }
                if ($add_id==TRUE) {
					$add_id = $this->product_model->delete_product_country($product['product_id']);
					//Save Country & Shipping details
					$count = $this->product_model->save_product_country($product['product_id'], $post['countries'], $post['shipping_normal'], $post['shipping_express']);
                    $message = 'Product updated Successfully';
                    $this->session->set_flashdata('message', array(
                        'message' => $message,
                        'type' => 'success'
                    ));
                    redirect(base_url('admins/product'));
                    die();
                }
            }
        }
		$this->data['all_category'] = $this->productcat_model->get_category();
		$this->data['countries'] = $this->product_model->get_country_list();
		$this->data['product_countries'] = array();
        //Check if update need
        if ($id != 0) {
            $search = array('product_id' => $id);
            $product_detail = $this->product_model->get_product(TRUE, $search);
            $this->data['data'] = $product_detail['product'];
            $this->data['product_countries'] = $product_detail['product_countries'];
        }
        
        $this->load->admin_template('product-form', $this->data, $return = FALSE);
    }
     
	function get_all()
	{
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("product_title", "asc"),);
        $filter = isset($post["filter"]) ? $post["filter"] : array("product_title" => "",);
        //echo '<pre>'; print_r($sort);die;
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->product_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $product = $this->product_model->get_list(TRUE, $filter, $sort, $current_page, $per_page);
		$products = array();
		if(!empty($product['data']))
		{
			foreach($product['data'] as $prd)
			{
				//print_r($prd); die;
				$img = $this->product_model->getAllProductImages($prd['product_id'],TRUE);
				$prd['image'] = isset($img[0]['product_image_id']) ? '/uploads/product/'.$prd['product_id'].'/'.$img[0]['path'] : '';
				$products[] = $prd;
			}
		}
		//echo '<pre>';print_r($products);die;
        //echo $this->db->last_query();die;
        $data['data'] = $products;//$product['data'];
        $data['totalRows'] = $product['totalRows'];
		$this->load->view('json_view', array('data' => $data));
    }
	
	
	public function delete($id = 0) {
        //Check if id setes need
        if ($id != 0) {
            $this->product_model->delete($id);
            $message = 'Product deleted Successfully';
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
            redirect(base_url('admins/product'));
            die();
        }
    }
	
	public function update_status($id = 0, $status=0) {
        //Check if id setes need
        if ($id != 0) {
            $this->product_model->update_status($id,$status);
            $message = 'Product Status Updated Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('admins/product'));
            die();
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/product'));
            die();
        }
    }
	
	
}
