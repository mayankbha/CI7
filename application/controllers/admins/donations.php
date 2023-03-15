<?php  

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Donations
 *
 * @author 
 */

class Donations extends CI_Controller
{

    private $data = array();

    public function __construct()
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
        $this->data['logged'] = check_login($this->session->userdata, 'admin');
        $this->load->model('donation_model');
		$this->lang->load('_donation', $this->config->item('language'));
    }

    public function index()
    {
        $this->load->admin_template('donation_list', $this->data, $return = FALSE);
    }

    function get_all_record()
    {
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("name", "asc"), array("email", "asc"));
        $filter = isset($post["filter"]) ? $post["filter"] : array("name" => "", "email" => "");
        
		$data = array(
            'currentPage' => 1,
            'totalRows' => $this->donation_model->totat_count(),  
            'perPage' => $per_page, 
            'sort' => $sort, 
            'filter' => $filter, 
            'currentPage' => $current_page, 
            'data' => array(), 
            'posted' => $post 
        );
		
        $user = $this->donation_model->get_list(TRUE);
        $data['data'] = $user['data'];
        $data['totalRows'] = $user['totalRows'];
        $this->load->view('json_view', array('data' => $data));
    }

    public function add($id = 0)
    {
        $this->data['action'] = ($id == 0) ? 'Add' : 'Edit';
        $this->data['id'] = $id;

        //If edit mode
        $this->data['data'] = ($id == 0) ? array() : $this->donation_model->get_single(array('id' => $id), true);
		
        //validate form input
        $this->form_validation->set_rules('donation_name', 'Donation Name', 'required|name|xss_clean');

        if ($this->form_validation->run() == true)
        {

            //save policy
            $save_data = array(
                'id' => (int) $id,
                'donation_name' => $this->input->post('donation_name'),
                'amount' => $this->input->post('amount'),
                'benifits' => $this->input->post('benifits'),
            );

            //save data
            $insert_id = $this->donation_model->save($save_data);

            if (is_int($insert_id) or $insert_id == TRUE)
            {
                //redirect them back to the users page
                $this->session->set_flashdata('message', array(
                    'message' => 'Data saved successfully',
                    'type' => 'success'
                ));
                redirect(site_url("admins/donations"), 'refresh');
            } else 
            {
                $this->session->set_flashdata('message', array(
                    'message' => 'Error occured !', 
                    'type' => 'danger' 
                ));
            }
        } else
        {
            $this->data            //set the flash data error message if there is one
                    ['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
			
			$this->data['donation_benifits'] = $this->donation_model->get_donation_benifits();
			$this->data['user_name']  = $this->donation_model->get_users();
				
            $this->load->admin_template('donation-form', $this->data);
        }
    }

    public function delete($id = 0)
    {
        //Check if update need
        if ($id != 0)
        {
            $this->donation_model->delete($id);
            $message = 'Data deleted Successfully';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'success'
            ));
            redirect(site_url("admins/donations"), 'refresh');
            die();
        } else
        {
            $message = 'Some error occured. Try again later.';
            $this->session->set_flashdata('message', array(
                'message' => $message,
                'type' => 'error'
            ));
            redirect(site_url("admins/donations"), 'refresh');
            die();
        }
    }

}
