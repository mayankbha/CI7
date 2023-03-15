<?php
(defined('BASEPATH')) OR die('No direct access');

/**
 * Description of member
 *
 * @author 
 */
 
class Member extends CI_Controller
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
        $this->load->model('member_model');
    }

    public function index()
    {
        $this->load->admin_template('member-list', $this->data, $return = FALSE);
    }

    public function get_all_record()
    {
        $post = $this->input->post();

        $total_rows = 200;
        $per_page = $post["perPage"] ? $post["perPage"] : 10;
        $current_page = $post["currentPage"] ? $post["currentPage"] : 1;
        $sort = isset($post["sort"]) ? $post["sort"] : array(array("first_name", "asc"), array("email", "asc"));
        $filter = isset($post["filter"]) ? $post["filter"] : array("first_name" => "", "email" => "");
      
        $data = array(
            'currentPage' => 1,
            'totalRows' => $this->member_model->totat_count(),
            'perPage' => $per_page,
            'sort' => $sort,
            'filter' => $filter,
            'currentPage' => $current_page,
            'data' => array(),
            'posted' => $post
        );
        $user = $this->member_model->get_members_list($filter, $sort, $current_page, $per_page);
        $data['data'] = $user['data']; 
        $data['totalRows'] = $user['totalRows']; 
        
        $this->load->view('json_view', array('data' => $data));
    }

    public function update_status()
    {
        $data['status'] = false;
        if ($this->input->is_ajax_request() && $this->input->get_post('user_id'))
        {
            $user = $this->ion_auth->user($this->input->get_post('user_id'))->row_array();
            $update_data['id'] = $user['id'];
            if ($user['active'] == 1)
            {
                $data['message'] = 'User deactivated successfully.';
                $update_data['active'] = 0;
            } else
            {
                $update_data['active'] = 1;
                $data['message'] = 'User activated successfully.';
            }
            $this->member_model->save_member($update_data);
            $data['status'] = true;
        }
        $this->load->view('json_view', array('data' => $data));
    }

    public function add($id = 0)
    {
        $user = $this->ion_auth->user($id)->row();
        if(empty($user))
        {
            redirect(base_url('admins/member'));
        }
        if($this->input->post())
        {
            // First we removed this user from all groups
            $this->ion_auth->remove_from_group(NULL, $user->id);
            
            // then add him to selected group$grp_id
            foreach ($this->input->post('group') as $grp_id) {
                $this->ion_auth->add_to_group($grp_id , $user->id );
            }
        }
        
        $this->data['userdetail'] = $user;
        $this->data['grouplist'] = $this->grouplist();
        $user_groups = array();
        foreach ($this->ion_auth->get_users_groups($user->id)->result() as $group)
        {
            $user_groups[$group->id] = $group->id;//ucfirst($group->name);
        }
        $this->data['user_groups'] = $user_groups;
        
        $this->load->admin_template('member-form', $this->data, $return = FALSE);
    }
    
    //Get group list
    private function grouplist()
    {
        $result = array();
        foreach ( $this->ion_auth->groups()->result() as $group)
        {
            $result[$group->id] = ucfirst($group->name);
        }
        return $result;
    }
}