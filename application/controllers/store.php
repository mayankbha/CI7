<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//class Store extends CI_Controller
class Store extends CI_Controller
{
	
	private $data;
	public function __construct()
	{
		parent::__construct();
		$this->data = array();
		$this->load->library('ion_auth');
		
		$this->load->library('pagination');
		
		$this->load->model('product_model');
		$this->load->model('productcat_model');
		$this->load->model('member_model');
		$this->load->model('registration_model');
		$this->load->model('tax_model');
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('login');
		$this->load->helper('language');
		$this->lang->load('base', 'english');
		$this->lang->load('store', 'english');
		$this->lang->load('_footer', $this->config->item('language'));
		
		$this->lang->load('_header_navigation', $this->config->item('language'));
		
		$this->session->set_userdata(array('current_template'=>'asian'));
		
		$this->data['logged'] = check_login($this->session->userdata, 'member');
		//Set Data
		//$this->data['title'] = $this->lang->line('store_meta_title');
		$this->data['title'] = 'Dumpflings - store';
		$this->data['description'] = $this->lang->line('store_meta_description');
		
		if(isset($this->session->userdata['user_id']))
		{
			$this->data['donate_user'] = $this->member_model->donate_user($this->session->userdata['user_id']);
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
			 
			 //get profile pic at header
			 $this->data['profile'] = $this->member_model->get_profile($this->session->userdata['email']);
			foreach($this->data['profile'] as $value)
			{
				//get thread user profile pic
				$this->data['users']['avatar'] = $this->member_model->get_profile_pic($this->session->userdata['user_id']);
			}
		}
		
		//get newest member
		$this->data['newest_member'] = $this->member_model->get_newest_member_list();
		foreach($this->data['newest_member'] as $value)
			{
				$this->data['users'][$value['id']]['avatar'] = $this->member_model->get_profile_pic($value['id']); 
			}
			
		//get advance search donation user list 
		$this->data['advancesearch_donation'] = $this->member_model->get_advcsr_don_user();
		//echo "<pre>";print_r($this->data['advancesearch_donation']);die;
	}
	
	public function index($catId=0)
	{
		//Get Categories
		$this->data['categories'] = $this->productcat_model->get_category();
		unset($this->data['categories']['']);
		
		$this->data['current_category'] = $this->productcat_model->get_row(TRUE, array('product_cat_id'=>$catId)); 
                //echo '<pre>'; print_r($this->data['current_category']);die;
		//Set Product Search
		$search = array();
		$sort = array();
		
		if ($catId!==0) {
			$search['fk_product_cat'] = $catId;
		}
		
		//Set Paging
		$perPage = 3;
		$config['base_url'] = base_url('store/index/'.$catId);
		$config['total_rows'] = $this->product_model->totat_count($search);
		$config['per_page'] = $perPage;
		$config['uri_segment'] = 4;
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$this->pagination->initialize($config); 
		
		$offset = ($this->uri->segment(4)) ? ((int)$this->uri->segment(4)) : 0;
		$products = array();
		$product = $this->product_model->get_list(TRUE, $search, $sort, $offset, $perPage, false);
		if (isset($product['data']) && !empty($product['data']))
		{
			foreach ($product['data'] as $prd)
			{
				$prd['images'] = $this->product_model->getAllProductImages($prd['product_id'], TRUE);
				$products[$prd['product_id']] = $prd;
			}
		}
		$this->data['products'] = $products;//template
		$this->load->shop_template('product-listing', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		
		//$this->load->template('product-listing', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function productDetail($productId=0)
	{
		//Get Categories
		$this->data['categories'] = $this->productcat_model->get_category();
		unset($this->data['categories']['']);
		//Set Product Search
		$search = array();
		$sort = array();
		
		if ($productId	!== 0) {
			$search['product_id'] = $productId;
		}
		$product = $this->product_model->get_product(TRUE, $search);
		$this->data['product'] = $product['product'];
		$this->data['product_images'] = $product['product_images'];
		$this->data['product_countries'] = $product['product_countries'];
		
		//Get Featured Products
		$searchs = array('featured'=>1);
		$featured = array();
		$feature = $this->product_model->get_list(TRUE, $searchs, array(array('created_date', 'asc')));
		if (isset($feature['data']) && !empty($feature['data']))
		{
			foreach ($feature['data'] as $prd)
			{
				if($prd['product_id']==$productId) {
					continue;
				}
				$prd['images'] = $this->product_model->getAllProductImages($prd['product_id'], TRUE);
				$featured[$prd['product_id']] = $prd;
			}
		}
		
		$this->data['featured_products'] = $featured ;
		
		$this->load->shop_template('product-details', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		//$this->load->template('product-details', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	public function view_cart()
	{
		//Get member Country
		$profile = $this->member_model->get_profile($this->session->userdata['email']);
		$tax_rate = $this->tax_model->get_row(TRUE, array('country_id'=>$profile['country']));
		
		$post = $this->input->post();
		$cart = $this->manange_cart( $post );
		//echo '<pre>';print_r($cart); die;
		$products = array();
		//Get Products details for the cart
		if (!empty($cart)) 
		{
			foreach ($cart as $prd)
			{
			    $search['product_id'] = $prd['product_id'];
				$product = $this->product_model->get_product(TRUE, $search);
				$product['product']['product_images'] = $product['product_images'];
				$product['product']['product_countries'] = $product['product_countries'];
				//Quantiy
				$product['product']['quantity'] = $prd['quantity'];
				//Shipping
				$product['product']['shipping'] = $this->product_model->get_product_country_by_id($prd['product_id'], $profile['country']);
				
				$products[$prd['product_id']] = $product['product'];
			}
		}
		
		//echo '<pre>';print_r($products);die;
		$this->data['tax_rate'] = $tax_rate;
		$this->data['cart_products'] = $products ;
		
		$this->load->shop_template('view-cart', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
		//$this->load->template('view-cart', $this->session->userdata['current_template'],  $this->data, $return = FALSE);
	}
	
	function get_cart_item()
	{
		$cart = $this->session->userdata('store_cart');
		$products = array();
		//Get Products details for the cart
		if (!empty($cart)) 
		{
			foreach ($cart as $prd)
			{
				$search['product_id'] = $prd['product_id'];
				$product = $this->product_model->get_product(TRUE, $search);
				$product['product']['product_images'] = $product['product_images'];
				$product['product']['product_countries'] = $product['product_countries'];
				//Quantiy
				$product['product']['quantity'] = $prd['quantity'];
				
				$products[$prd['product_id']] = $product['product'];
			}
		}
		$this->data['cart_products'] = $products ;
		$content  = $this->load->view('templates/'.$this->session->userdata['current_template'].'/cart_item', $this->data, TRUE);
		$this->output->set_header('Content-Type: application/json; charset=utf-8');
		//header('Content-Type: application/json; charset=utf-8');
		echo json_encode(array('cart'=>$content));
	}
	
	function update_cart()
	{
		$result['status'] = FALSE;
		$post = $this->input->post();
		$cart = $this->session->userdata('store_cart');
		if ($post)
		{
			$action = (isset($post['action'])) ? $post['action'] : NULL ;
			$product_id = (isset($post['product_id'])) ? $post['product_id'] : '' ;
			
			if (NULL!==$action && $action=="remove" && array_key_exists($product_id, $cart))
			{//print_r(($cart));die;
				unset($cart[$product_id]);
				$result['status'] = TRUE;
			}
			else if (NULL!==$action && $action=="update" && array_key_exists($product_id, $cart)) 
			{
				//Get Product Unit Price
				$search['product_id'] = $product_id;
				$product_details = $this->product_model->get_product(TRUE, $search);
				$post['price'] = $product_details['product']['price'];
				
				$cart = $this->manange_cart($post);
				$result['status'] = TRUE;
			}
			$this->session->set_userdata('store_cart', $cart);
		}
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($result);
	}
	
	/**
	 * Manager cart 
	 */ 
	private function manange_cart($post)
	{
		$cart = $this->session->userdata('store_cart');
		if ($post)
		{
			if(!$cart) {
				$cart[$post['product_id']] = array(
					'product_id' => $post['product_id'],
					'quantity'	 => $post['qty'],
					'price' => isset($post['price']) ? $post['price'] : null,
				);
			}else if(in_array($post['product_id'], $cart)) {
				$quantity = ($post['qty']==$cart[$post['product_id']]['quantity']) ? $post['qty'] : $post['qty'];
				$cart[$post['product_id']] = array(
					'product_id' => $post['product_id'],
					'quantity'	 => $quantity,
					'price' => isset($post['price']) ? $post['price'] : null,
				);
				//echo '<pre>'; print_r($cart); die;
			}else {
				$cart[$post['product_id']] = array(
					'product_id' => $post['product_id'],
					'quantity'	 => $post['qty'],
					'price' => isset($post['price']) ? $post['price'] : null,
				);
			}
			$this->session->set_userdata('store_cart', $cart);
		}
		return $cart ;
	}
	
	public function success()
	{
	  
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
