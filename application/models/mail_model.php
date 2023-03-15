<?php 
/**
 * Forum_model Class
 * 
 * Handles member-data processing
 *
 * @package PMH Tools  
 * @subpackage  Model
 * @author  Rommel Capispisan <x.romel@gmail.com>
 */
 
class Mail_model extends CI_Model {

 
    function __construct() {
        parent::__construct();

    }
	
	function inbox_read($email_id)
	{
		$data=array('read'=>'1');
		$this->db->where('id', $email_id);
		$this->db->update('mail_inbox', $data);
		//echo 'xxx';
	}
	
	//move to trash function
	function inbox_move_to_trash($email_id)
	{
		$data = array('trash'=>'1');
		$this->db->where('id', $email_id);
		$this->db->update('mail_inbox', $data);
	}
	
	function add_star_inbox($mail_id)
	{
		$data = array('favorite'=>'1');
		$this->db->where('id', $mail_id);
		$this->db->update('mail_inbox', $data);
	}
	
	function remove_star_inbox ($mail_id) {
		$data = array('favorite'=>'0');
		$this->db->where('id', $mail_id);
		$this->db->update('mail_inbox', $data);
	}	
	
	function save_send_message($to_user_id,$subject,$content)
	{
		$this->db->insert('mail_inbox',
			array(
				'subject'=>$subject,
				'content'=>$content,
				'to_user_id'=>$to_user_id,
				'from_user_id'=>$this->session->userdata['user_id']
			)
		);
		
	}
	
	function save_sent_message($to_user_id,$subject,$content)
	{
		$this->db->insert('mail_outbox', 
			array(
				'subject'=>$subject,
				'content'=>$content,
				'to_user_id'=>$to_user_id,
				'from_user_id'=>$this->session->userdata['user_id']
			)
		);
		
	}	
	
	/*function get_inbox($page_limit, $start){
		$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'0'), $page_limit, $start);
		$inbox = $query->result_array();
		return $inbox;
	}*/

	
	function get_inbox($page_limit, $start)
	{
		$this->db->select('mail_inbox.*, COUNT(mail_inbox.subject) as count')
         ->from('mail_inbox')
         ->order_by("date", "desc")
		 ->group_by("subject");
	
		$this->db->where(array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'0','spam'=>'0'), $page_limit, $start);
		$query = $this->db->get();
		$inbox = $query->result_array();
		return $inbox;
	}

	function get_trash_inbox($page_limit, $start)
	{
		$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'1'), $page_limit, $start);
		$inbox = $query->result_array();
		return $inbox;
	}
	
	function get_favorites($page_limit, $start){
		$this->db->order_by("date", "desc");
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'favorite'=>'1', 'trash'=>'0'), $page_limit, $start);
		$inbox = $query->result_array();
		return $inbox;
	}
	
	function get_inbox_count(){
		//$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'0','spam'=>'0'));
		$count = count($query->result_array());
		return $count;
	}

	function get_trash_inbox_count(){
		//$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'1'));
		$count = count($query->result_array());
		return $count;
	}
	
	function get_favorites_count(){
		//$this->db->order_by("date", "desc"); 
		$query=$this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'favorite'=>'1', 'trash'=>'0'));
		$count=count($query->result_array());
		return $count;
	}
	
	function get_unread_count(){
		//$this->db->order_by("date", "desc"); 
		$query=$this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'read'=>'0'));
		$count=count($query->result_array());
		return $count;
	}	
	
	function get_outbox($page_limit, $start){
		//echo "$page_limit, $start";
		$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_outbox', array('from_user_id'=>$this->session->userdata['user_id'], 'trash'=>'0'), $page_limit, $start);
		$outbox = $query->result_array();
		return $outbox;
	}
	
	function get_outbox_count(){
		//$this->db->order_by("date", "desc"); 
		$query=$this->db->get_where('mail_outbox', array('to_user_id'=>$this->session->userdata['user_id'], 'trash'=>'0'));
		$count=count($query->result_array());
		return $count;
	}	
	
	function outbox_move_to_trash($email_id)
	{
		//$data=array('trash'=>'1');
		//$this->db->where('id', $email_id);
		//$this->db->update('mail_outbox', $data);
		$this->db->delete('mail_outbox', array('id' => $email_id)); 
	}	
	
	function sent_move_to_trash($email_id)
	{
		$this->db->select('*')->from('mail_outbox')->where(array('id'=>$email_id,'trash'=>'0'));
		$query = $this->db->get();
		$result = $query->result_array();
		foreach($result as $row)
		{	
			$to_user_id = $row['to_user_id'];
			$date = $row['date'];
			
			/*$this->db->select('*');
			$this->db->where(array('to_user_id'=>$to_user_id,'from_user_id'=>$this->session->userdata['user_id'],'date'=>$date));
			
			$this->db->get('mail_inbox');*/
			
			
			$data = array('trash'=>'1');
			$this->db->where(array('to_user_id'=>$to_user_id,'from_user_id'=>$this->session->userdata['user_id'],'date'=>$date));
			$this->db->update('mail_inbox', $data);
		}
		$data = array('trash'=>'1');
		$this->db->where('id', $email_id);
		$this->db->update('mail_outbox', $data);
	}
	
	/*function get_inbox_by_id($id){
		$query = $this->db->get_where('mail_inbox', array('id'=>$id));
		$inbox = $query->result_array();
		//return $inbox[0];	
		return $inbox[0];	
	}*/
	
	//bkup15sepmon
	
	function get_inbox_by_id($from_user_id,$to_user_id,$subject){
	
		$where = " ( from_user_id = '" . $from_user_id . "' OR from_user_id = '" . $to_user_id . "' )";
        $this->db->where($where, NULL, FALSE);

        $where = " ( to_user_id = '" . $from_user_id . "' OR to_user_id = '" . $to_user_id . "' )";
        $this->db->where($where, NULL, FALSE);
		
		
		$this->db->where(array('subject'=>$subject , 'trash'=>'0'));
		$this->db->order_by('date','desc');
	
		//$query = $this->db->get_where('mail_inbox', array('from_user_id'=>$from_user_id,'to_user_id'=>$to_user_id,'subject'=>$subject));
		
		$query = $this->db->get('mail_inbox');
		$rows = $query->result();
		$resultarray = array();
		
		foreach($rows as $row)
		{
			$data = array(
						'id' => $row->id,
						'subject' => $row->subject,
						'content' => $row->content,
						'from_user_id' => $row->from_user_id,
						'to_user_id' => $row->to_user_id,
						'favorite' => $row->favorite,
						'date' => $row->date,
						'read' => $row->read,
						'trash' => $row->trash,
						'name' => $this->get_profile_name($row->from_user_id),
						'avatar' => $this->get_active_avatar($row->from_user_id),
						'gender' => $this->get_gender($row->from_user_id),
						'block_user_id' => $this->get_block_user_data($row->from_user_id),
			);
			$resultarray[] = $data;
		}
		return $resultarray;
	}
	
	//get block user id
	function get_block_user_data($from_user_id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$query = $this->db->query("SELECT `block_user_id` FROM `block_user` WHERE `user_id_sender`= '".$this->session->userdata['user_id']."' and block_user_id = '".$from_user_id."' ");
			
			# Use any one query from the above!
			/*if($query->num_rows() > 0)
			{
			$result = $query->result_array();
			foreach($result as $row)
			{
				 $fieldArray[] = "" . $row['block_user_id'] . "";
			}
			$fields = implode(',', $fieldArray);
			$query = $this->db->query('SELECT `id` , `first_name` , `last_name` FROM (`users`) WHERE `id`  IN ('.$fields.') '); 
				//$existing_data = $query->result_array();
				*/
			$profile = $query->result_array();
			
			if ($profile > 0)
			{	
				foreach($profile as $name){
				$profile['id'] = $name['block_user_id'];
				}
				return @$profile['id'];
			} else
			{
				return false;
			}
		}
	}
	
	
	function get_previous_msg($id){
		//$query = $this->db->query('SELECT * FROM `mail_inbox` WHERE `id` < "'.$id.'"');
		$this->db->select('*');
		$this->db->from('mail_inbox');
		$this->db->where(array('spam'=>'0','trash'=>'0'));
		$this->db->where('id <',$id);
		$this->db->where('to_user_id',$this->session->userdata('user_id'));
		$this->db->order_by('id','desc');//add 18 sep
		$this->db->group_by('subject');//add 18sep
		
		$query = $this->db->get();
		$inbox = $query->result_array();
		
		//return $inbox[0];	
		if($inbox > 0){
			return $inbox[0];
		}else{
			return false;
		}	
	}
	
	function get_next_msg($id)
	{
		$this->db->select('*');
		$this->db->from('mail_inbox');
		$this->db->where(array('spam'=>'0','trash'=>'0'));
		$this->db->where('id >',$id);
		$this->db->where('to_user_id',$this->session->userdata('user_id'));
		$this->db->order_by('id','asc'); //add 18 sep
		$this->db->group_by('subject'); //add 18sep
		$query = $this->db->get();
		
		$inbox = $query->result_array();
		if($inbox > 0){
			return $inbox[0];
		}else{
			return false;
		}	
	}
	
	function get_profile_name($id)
    {
        $query = $this->db->query("
			SELECT 
			`u`.`first_name`, 
			`u`.`last_name`
			FROM `users` AS `u` 
			WHERE `u`.`id`='" . $id . "' 
			");
		
		$profile = $query->result_array();
        if (isset($profile))
        {	
			foreach($profile as $name){
			$profile['name'] = $name['first_name'].' '.$name['last_name'];
			}
            return $profile['name'];
        } else
        {
            return false;
        }
    }
	
	function get_active_avatar($id) 
    {
        $query = $this->db->query("
			SELECT `name`
			FROM `profile_pics`
			WHERE `user_id`='" . $id . "' AND `active`='1'
			");
		
		$profile = $query->result_array();   
		if (isset($profile))
        {
			foreach($profile as $name){
			$avatar['name'] =  $name['name']; 
			}
            return @$avatar['name'];
        } else
        {
            return false;
        }
    }
	
	function get_gender($id) 
    {
        $query = $this->db->query("
			SELECT `gender`
			FROM `user_data`
			WHERE `user_id`='" . $id . "' 
			");
		
		$profile = $query->result_array();   
		if (isset($profile))
        {
			foreach($profile as $name){
			$avatar['gender'] =  $name['gender']; 
			}
            return @$avatar['gender'];
        } else
        {
            return false;
        }
    }
	
	function get_outbox_by_id($id)
	{
		$query = $this->db->get_where('mail_outbox', array('id'=>$id));
		$inbox = $query->result_array();
		return $inbox;	
	}	
	//end

	function save_reply_message($to_user_id,$subject,$content)
	{
		$this->db->insert('mail_inbox', 
			array(
				'subject'=>$subject,
				'content'=>$content,
				'to_user_id'=>$to_user_id,
				'from_user_id'=>$this->session->userdata['user_id']
			)
		);
	}
	
	function get_inbox_msg($to_user_id){
	$this->db->select('*')
         ->from('mail_inbox')
         ->order_by("date", "desc");
		 
		$this->db->where(array('to_user_id'=>$to_user_id, 'trash'=>'0'));
		$query = $this->db->get();
		$inbox = $query->result_array();
		return $inbox;
	}
	
	function get_spam_msg($to_user_id){
	$this->db->select('*')
         ->from('mail_inbox')
         ->order_by("date", "desc");
		 
		$this->db->where(array('to_user_id'=>$to_user_id, 'trash'=>'0','spam'=> '1'));
		$query = $this->db->get();
		$inbox = $query->result_array();
		return $inbox;
	}
	
	
	function user_block($block_user_id)
	{
		 $query = $this->db->query("
			SELECT `u`.`first_name`, `u`.`last_name`
			FROM `users` AS `u` 
			WHERE `u`.`id`='" . $block_user_id . "' 
			");
       	$profile = $query->result_array();
		if($profile > 0)
		{
			foreach($profile as $name)
			{
				$avatar['name'] = $name['first_name'].' '.$name['last_name'];
			}
            $this->db->insert('block_user', 
				array(
					'block_user_id' => $block_user_id,
					'user_id_sender' => $this->session->userdata['user_id'],
					'block_user_name' => @$avatar['name'],
					'date'=>date('Y-m-d H:i:s'),
					)
				);
		}
	}
	
	//move to spam box
	function inbox_move_to_spam($email_id)
	{
		$data = array('spam'=>'1');
		$this->db->where('id', $email_id);
		$this->db->update('mail_inbox', $data);
	}
	
	//get spam mail
	function get_spam_inbox($page_limit, $start){
		$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'spam'=>'1','trash'=>'0'), $page_limit, $start);
		
		$inbox = $query->result_array();
		return $inbox;
	}
	
	function get_spam_inbox_count(){
		//$this->db->order_by("date", "desc"); 
		$query = $this->db->get_where('mail_inbox', array('to_user_id'=>$this->session->userdata['user_id'], 'spam'=>'1'));
		$count = count($query->result_array());
		return $count;
	}
	
	// get sent message by id

	function get_sentmsg($from_user_id,$to_user_id,$subject){
	
		$where = " ( from_user_id = '" . $from_user_id . "' OR from_user_id = '" . $to_user_id . "' )";
        $this->db->where($where, NULL, FALSE);

        $where = " ( to_user_id = '" . $from_user_id . "' OR to_user_id = '" . $to_user_id . "' )";
        $this->db->where($where, NULL, FALSE);
		
		
		$this->db->where(array('subject'=>$subject , 'trash'=>'0'));
		$this->db->order_by('date','desc');
	
		//$query = $this->db->get_where('mail_inbox', array('from_user_id'=>$from_user_id,'to_user_id'=>$to_user_id,'subject'=>$subject));
		
		$query = $this->db->get('mail_outbox');
		$rows = $query->result();
		$resultarray = array();
		
		foreach($rows as $row)
		{
			$data = array(
						'id' => $row->id,
						'subject' => $row->subject,
						'content' => $row->content,
						'from_user_id' => $row->from_user_id,
						'to_user_id' => $row->to_user_id,
						'favorite' => $row->favorite,
						'date' => $row->date,
						'trash' => $row->trash,
						'name' => $this->get_profile_name($row->to_user_id),
						'avatar' => $this->get_active_avatar($row->to_user_id),
						'gender' => $this->get_gender($row->to_user_id),
					);
			$resultarray[] = $data;
		}
		//print_r($resultarray);die;
		return $resultarray;
	}

	function delete_block_user($from_user_id)
	{
		$this->db->delete('block_user', array('user_id_sender' => $this->session->userdata['user_id'],'block_user_id' => $from_user_id));
	}
	
}
