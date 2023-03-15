<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_images extends CI_Controller
{
	
	private $data = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('login');
		$this->load->model('product_model','product');
		$this->data['logged']=check_login($this->session->userdata, 'admin');
	}
	
    public function index($product_id=0)
    {
		$this->session->set_userdata('product_id',$product_id);
		$this->data['product_image_list'] = $this->product->getAllProductImages($product_id);
		$this->load->admin_template('product_image', $this->data, $return = FALSE);		
    }
    
	
	public function add_image($product_id=0) {
	        $product_id = $this->session->userdata('product_id');
	        $config['upload_path'] = './uploads/product/'.$product_id;
			 if (!is_dir('uploads/product/' . $product_id))
			{
				mkdir('./uploads/product/' . $product_id, 0777, true);
				$dir_exist = false; // dir not exist
			}
            $config['allowed_types'] = '*';
            $config['encrypt_name'] = true;
            $config['max_size'] = '1024';
            $this->load->library('upload');
            $upload_error = array();
            $this->upload->initialize($config);
						
            if (!$this->upload->do_upload('product_image')) {
                $data = $this->upload->display_errors('', '<br />');
                $this->output
					->set_content_type('text/html')
						->set_output('Server Side Error');
				//die();
			    //echo "Server Side Error";
            } else {
			   
                $upload_data = $this->upload->data();
				$data['path'] = $upload_data['file_name'];
				$data['fk_product'] = $this->session->userdata('product_id');
			    $data['created_date'] = date('Y-m-d H:i:s');
				$imageId = $this->product->saveProductImage($data);
			    //echo $this->session->userdata('product_id')."/".$upload_data['file_name'];
				$this->output->set_output((string)$this->session->userdata('product_id')."/".$upload_data['file_name']);
				//die();
            }
			
	}
  
	
	public function delete($id = 0,$product_id=0) {
        //Check if id setes need
        if ($id != 0) {
            $image = $this->product->delete_product_image($id);
			@unlink('./uploads/'.$image);
            $message = 'Product deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(base_url('/admins/product_images/index/'.$product_id));
        } else {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(base_url('admins/product_images'));
        }
    }
}
