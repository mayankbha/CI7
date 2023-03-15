<?php    
/**
 * Forum_model Class
 * 
 * Handles member-data processing
 *
 * @package PMH Tools
 * @subpackage  Model
 * @author 
 */
 
class Forum_model extends CI_Model {
		
		private $table_forumgroup = 'forum_group';
		private $table = 'forum_forums';
 
    function __construct() {
        parent::__construct();
    }

	function save_history(){
		$this->db->where('UNIX_TIMESTAMP(last_tracked)>(UNIX_TIMESTAMP() - 3600)');
		$this->db->from('forum_users_online');
		$count = $this->db->count_all_results();
		//insert count if greater
		$old_count = $this->get_highest_count();
		if($count>$old_count){
			$this->clear_history();
			$this->insert_current_count($count);
		}
	}
	
	function clear_history()
	{
		$this->db->truncate('forum_history'); 
	}
	
	function get_top_posters(){
		$this->db->select('user_id, count(*) as count');
		$this->db->from('forum_thread_title');
		$this->db->group_by('user_id');
		$this->db->order_by("count", "desc"); 
		$this->db->limit(5);
		$query = $this->db->get();
        $result = $query->result_array();		
		return $result;		
	}
	
	function say_thanks($user_id){
		$thanks_exist=$this->check_thanks($this->session->userdata['user_id'], $user_id);
		if($thanks_exist<1){
			$this->add_thanks($this->session->userdata['user_id'], $user_id);
			return('Thank you sent.');
		} else {
			return('You already thanked this member.');
		}
	}
	
	function add_thanks($from_id, $to_id){
		$data=array('user_id'=> $to_id, 'from_user_id' => $from_id);
		$result=$this->db->insert('forum_thanks', $data);
	}
	
	function check_thanks($from_id, $to_id){
		$this->db->from('forum_thanks');
		$this->db->where(array('user_id'=>$to_id, 'from_user_id'=>$from_id));
		return $this->db->count_all_results();		
	}
	
	function get_thanks_count($user_id){
		$this->db->from('forum_thanks');
		$this->db->where(array('user_id'=>$user_id));
		$this->db->group_by('user_id');
		return $this->db->count_all_results();
	}
	
	
	function get_highest_count(){
        $this->db->select('user_count');
        $this->db->from('forum_history');
        $query = $this->db->get();
        $result = $query->result_array();
		if(isset($result[0]['user_count'])){
			return $result[0]['user_count'];
		} else {
			return 0;
		}
	}
	
	function get_history(){
		$query =$this->db->get('forum_history');
        $result = $query->result_array();
		if(isset($result[0])){
			return $result[0];		
		} else {
			return 0;
		}		
		
	}
	
	function get_thread_count(){
		return $this->db->count_all_results('forum_thread_title');
	}
	
	function get_post_count(){
		return $this->db->count_all_results('forum_thread_posts');
	}	
	
	function insert_current_count($count){
		$this->db->insert('forum_history', array('user_count'=>$count));
	}
	
	function track_forum_user(){
		//remove previous instance if any
		$this->clear_user_tracking($this->session->userdata['ip_address'], $this->session->userdata['identity']);
		//add updated tracking
		$this->add_to_tracking($this->session->userdata['ip_address'], $this->session->userdata['identity']);
	}
	
	function add_to_tracking($ip, $user){
		$this->db->insert('forum_users_online', array('ip'=>$ip, 'username'=>$user));
	}
	
	function clear_user_tracking($user){
		$this->db->delete('forum_users_online', array('username'=>$user));
	}
	
	function get_forum_group_list(){
        $this->db->select('*');
        $this->db->from('forum_group');
        //$this->db->where(array('users.email' => $email));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}

	function get_forum_group_id($id)
	{
        $this->db->select('*');
        $this->db->from('forum_group');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}
	
	function get_forum_thread_ids($id)
	{
        $this->db->select('id');
        $this->db->from('forum_thread_title');
        $this->db->where(array('forum_id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;		
	}
	
	function get_forums_list()
	{
        $this->db->select('*');
        $this->db->from('forum_forums');
        $query = $this->db->get();
        $result = $query->result_array();
		//get thread count
		foreach($result as $rkey => $rvalue){
			$result[$rkey]['thread_count']=$this->get_forum_thread_count($rvalue['id']);
			$threads=$this->get_forum_thread_ids($rvalue['id']);
			$postcount=0;
			foreach($threads as $thkey=>$thvalue){
				$posts=$this->get_forum_post_count($thvalue['id']);
				$postcount=$postcount+$posts;
			}
			$result[$rkey]['post_count']=$postcount;
		}
		return $result;
	}	

	function get_forum_data($id)
	{
        $this->db->select('*');
        $this->db->from('forum_forums');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0];
	}	

	function get_forum_thread_count($id)
	{
        $this->db->select('count(*) as count');
        $this->db->from('forum_thread_title');
        $this->db->where(array('forum_id' => $id));
		$this->db->group_by('forum_id');
        $query = $this->db->get();
        $result = $query->result_array();
		if(isset($result[0]['count'])){
			return $result[0]['count'];
		} else {
			return 0;
		}
	}
	
	function get_forum_post_count($tid)
	{
        $this->db->select('count(*) as count');
        $this->db->from('forum_thread_posts');
        $this->db->where(array('thread_id' => $tid));
		$this->db->group_by('thread_id');
        $query = $this->db->get();
        $result = $query->result_array();
		if(isset($result[0]['count'])){
			return $result[0]['count'];
		} else {
			return 0;
		}
	}	
	
	function new_thread($title, $body, $forum_id)
	{
		$data['title']=$title;
		$data['body']=$body;
		$data['forum_id']=$forum_id;
		$data['user_id']=$this->session->userdata['user_id'];
		$query=$this->db->insert('forum_thread_title', $data);
		return 'New data saved';
	}	
		
	function get_thread_title_list($forum_id)
	{
        $this->db->select('*');
        $this->db->from('forum_thread_title');
        $this->db->where(array('forum_id' => $forum_id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}
		
	function get_thread_title($thread_id)
	{
        $this->db->select('*');
        $this->db->from('forum_thread_title');
        $this->db->where(array('id' => $thread_id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result[0];
	}		
	
	function new_post($body, $thread_id)
	{
		$data['body']=$body;
		$data['thread_id']=$thread_id;
		$data['user_id']=$this->session->userdata['user_id'];
		$query=$this->db->insert('forum_thread_posts', $data);
		return 'New data saved';
	}	
	
	function get_thread_posts($thread_id)
	{
        $this->db->select('*');
        $this->db->from('forum_thread_posts');
        $this->db->where(array('thread_id' => $thread_id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
	}		
	
	
	/******************************D*********************************/
	/**
     * Count all records
     * @param type $searchs
     * @return type
     */
    public function totat_count($searchs = array()) {

        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (empty($val)) {
                    continue;
                }else if($field == "name"){
					$this->db->like('name', $val);
					//die;
				}
                $this->db->or_like($field, $val);
            }
        }
        //Get forum data
		$this->db->select('id,name', FALSE);
        
        $query = $this->db->get('forum_forums');
		//echo $this->db->last_query();die;
        return $query->num_rows();
    }
	
	    /**
     * Get List of all Forum data
     * @param type $searchs
     * @param type $sort
     * @param type $from
     * @param type $num_result
     * @param type $is_array
     * @return type
     */
    public function get_list($is_array = false, $searchs = array(), $sort = array(), $from = 0, $num_result = 10, $dataTable = true) {

		//Get total Row
		
        $result['totalRows'] = $this->totat_count($searchs);
		
		$aa = $this->db->query("SELECT * FROM forum_forums"); 
		
		//Sort 
        if (!empty($sort)) {
            foreach ($sort as $sorter) {
                $this->db->order_by($sorter[0], $sorter[1]);
            }
        }

        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (empty($val)) {
                    continue;
                }else if($field == "name"){
					$this->db->like('name', $val);
					//die;
				}else{
					$this->db->where($field, $val);
				}
            }
        }
		
		//Get Category
		//$this->db->select('id, name, description, forum_group, active', FALSE);
        $this->db->select($this->table.'.*',FALSE);
        
		//Pagination logic
        $start = (int) $from;
        if($dataTable)
		{
			$from = (int) $from;
			$start = ($from == 1) ? ($from - 1) : (($from - 1) * $num_result );
			$start = ($start < 0) ? 0 : $start;
		}
		
		$this->db->select($this->table_forumgroup.'.name',FALSE);
		$this->db->join($this->table_forumgroup,$this->table.'.forum_group = '.$this->table_forumgroup.'.id','left');
		
        $query = $this->db->get('forum_forums');
		//echo $this->db->last_query();die;
      
		if ($is_array == true) {
            $result['data'] = $query->result_array();
            return $result;
        }
        return $result['data'] = $query->result();
    }
	
	
	/**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
     */
    function add($data = array()) {
	
        if (empty($data)) {
            return FALSE;
        }
        if (isset($data['id']) && $data['id'] !== 0) {
            $this->db->where('id', $data['id']);
            $this->db->update('forum_forums', $data);
            return TRUE; 
        } else {
            $this->db->insert('forum_forums', $data);
            return $this->db->insert_id();
			
        }
    }
	
	/**
	 * Delete an Forum
	 */
    public function delete($id) 
	{
		//Remove Forum
        $this->db->where('id', $id);
        $this->db->delete('forum_forums');
        return TRUE;
    }
	
	
	/**
	 * update an Forum Status
	 */
    public function update_status($id,$status) 
	{
		//update Forums
		if($status == 1){
		  $sts = 0; 
		}else{
		   $sts = 1;
		}
		$data['active'] = $sts;
        $this->db->where('id', $id);
        $this->db->update('forum_forums',$data);
        return TRUE;
    }
	
	
	/**
     * Search for a PROJECT
     * @param type $is_array
     * @param type $searchs
     * @return type
     */
    public function get_row($is_array = false, $searchs = array()) { 
        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (!is_numeric($val) && empty($val)) {
                    continue;
                }
                $this->db->where($field, $val);
            }
            $query = $this->db->get('forum_forums');

			if ($is_array == true) {
				return $query->row_array();
			}
			return $query->row();
        }
		return array();
    }
	
	function get_forum_group()
	{
        $query	= $this->db->get('forum_group');
        $rows	= $query->result_array(); 
		
		//select group name and id 
		$result = array('' => 'select'); 
		foreach($rows as $row)
		{
			$result[$row['id']] = $row['name'];
		}
		return $result;
	}
	
	function get_forum_color()
	{
        $query	= $this->db->get('forum_colors');   
        $rows	= $query->result_array();   
		
		//select color name 
		$result = array('' => 'select');    
		foreach($rows as $row)
		{
			$result[$row['name']] = $row['name'];    
		}
		return $result;
	}

}