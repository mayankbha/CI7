<?php

class Chatmodel extends CI_Model
{
	function __construct()
	{
		parent::__construct(); 
	}

	//function getMsg($limit = 10)
	function getMsg()
	{
		$sql = "SELECT * FROM messages ORDER BY id ASC ";		
		return $this->db->query($sql);
	}
	
	function insertMsg($name, $message, $current){
		$sql = "INSERT INTO messages SET user='$name', msg='$message', time='$current'";
		
		return $this->db->query($sql);
	}

}


	