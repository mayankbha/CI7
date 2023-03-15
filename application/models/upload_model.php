<?php
class Upload_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	public function save ($id, $filename) {
		$query=$this->db->query("INSERT INTO `user_submitted_id` (`user_id`, `filename`) values ('".$id."', '".$filename."')");
	}
	

}
?>