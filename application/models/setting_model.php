<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of setting_model
 *
 * @author nitin
 */
class Setting_model extends CI_Model {
    
    private $table = 'site_setting';

    /**
     * Search for a PROJECT
     * @param type $is_array
     * @param type $searchs
     * @return type
     */
    public function get_popup_time($is_array = true) {
        //search
        $this->db->where('id', 1);
        $query = $this->db->get($this->table);
        if ($is_array == true) {
            return $query->row_array();
        }
        return $query->row();
    }
	
    public function update_popup_time($value) {
        //search
        $this->db->where('id', 1);
        $this->db->update($this->table, array('value' => $value));
        return TRUE;
    }
	
	public function add_template($data,$user_id)
	{
		$dataget = array(
            "image_location" => $data['image_location'],
            "user_id" => $user_id,
            );
            $this->db->insert('user_template', $dataget);
			//echo $this->db->last_query();die;
            return $this->db->insert_id();
	}
	
	public function get_template_image($user_id)
	{
		$this->db->where('user_id',$user_id);
		$query = $this->db->get('user_template');
		return $query->row();
	}
	
}
