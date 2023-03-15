<?php

/** 
 * Description of chat_model
 *
 * @author
 */
 
class Chat_model extends CI_Model
{

    private static $table = 'chat';
    private $tables = array();
    private $join = array();

    function __construct()
    {
        parent::__construct();
        $this->load->config('ion_auth', TRUE);
        //initialize db tables data
        $this->tables = $this->config->item('tables', 'ion_auth');
        $this->join = $this->config->item('join', 'ion_auth');
    }

    function get_all($from_user, $to_user, $last_chat_id = false, $is_array = true)
    {

        $this->db->select(self::$table . '.*');
        $this->db->order_by('id', 'ASC');
        $this->db->order_by('message_on', 'ASC');

        $where = " ( fk_from_user_id = '" . $from_user . "' OR fk_from_user_id = '" . $to_user . "' )";
        $this->db->where($where, NULL, FALSE);

        $where = " ( fk_to_user_id = '" . $from_user . "' OR fk_to_user_id = '" . $to_user . "' )";
        $this->db->where($where, NULL, FALSE);

        if ($last_chat_id)
        {
            $this->db->where('id >', $last_chat_id);
        }

        //$this->db->limit(10);

        $query = $this->db->get(self::$table);
        if ($is_array)
        {
            return $query->result_array();
        }
        return $query->result();
    }

    function save($data = array())
    {
        if (is_array($data) && !empty($data))
        {
            $this->db->insert(self::$table, $data);
            return $this->db->insert_id();
        }
        return 0;
    }

    function online_users($current_user)
    {
        $this->db->select($this->tables['users'] . '.first_name');
        $this->db->select($this->tables['users'] . '.last_name ');
        $this->db->select($this->tables['users'] . '.id');
        $this->db->join($this->tables['users'], $this->tables['users'] . '.id = ' . 'login_users' . '.' . 'fk_user_id', 'left');
        
        $this->db->where('login_users' . '.' . 'fk_user_id'.' !=', $current_user);
        
        $query = $this->db->get('login_users');
		//echo $this->db->last_query();die;
        return $query->result_array();
    }

}
