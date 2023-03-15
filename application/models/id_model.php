<?php
/**
 * Patient_model Class
 * 
 * Handles patient-data processing
 *
 * @package PMH Tools
 * @subpackage  Model
 * @author  Rolan Batungbakal <understasis@gmail.com>
 */
class Id_model extends CI_Model {


    function __construct() {
        parent::__construct();

    }

    /**
     * Encrypts the given data
     * 
     * @param mixed $data Array or object containing unencrypted data
     * @return mixed Array or object with encrypted data
     */
    public function getPending() {
		$query = $this->db->get_where('user_submitted_id', array('approved'=>'0'));
		return $query->result_array();
	}

	public function getApproved() {
		$query = $this->db->get_where('user_submitted_id', array('approved'=>'1'));
		return $query->result_array();
	}
    public function approve_image($id) {
		$data = array(
			   'approved' => '1'
		);

		$this->db->where('id', $id);
		$this->db->update('user_submitted_id', $data); 	
		//$this->db->result_array();
	}
	
	public function show_image ($id) {
		$query=$this->db->query("SELECT * FROM `user_submitted_id` WHERE `id`='".$id."' ORDER BY date DESC");
		return $query->result_array();
	}	
}
