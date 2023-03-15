<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of project_model
 *
 * @author nitin
 */
class Tax_model extends CI_Model {
    
    private $table = 'tax';
	private $country_table = 'country';
    /**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
     */
    function add($data = array()) {
        if (empty($data)) {
            return FALSE;
        }
        if (isset($data['tax_id']) && $data['tax_id'] !== 0) {
            $this->db->where('tax_id', $data['tax_id']);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
	
	
  
    public function get_list($is_array = false, $searchs = array(), $sort = array(), $from = 0, $num_result = 10) {
        //Get total Row
        $result['totalRows'] = $this->totat_count($searchs);
        $this->db->select($this->table . '.*');
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
                }
                $this->db->or_like($field, $val);
            }
        }
		
		//Get Category
		$this->db->select($this->country_table . '.name as country_name', FALSE);
        $this->db->join($this->country_table, $this->table . '.country_id = ' . $this->country_table . '.iso', 'left');
		
        //Pagination logic
        $from = (int) $from;
        $start = ($from == 1) ? ($from - 1) : (($from - 1) * $num_result );
        $start = ($start < 0) ? 0 : $start;
        $this->db->limit($num_result, $start);

        $query = $this->db->get($this->table);

        //echo $this->db->last_query(); 
        if ($is_array == true) {
            $result['data'] = $query->result_array();
            return $result;
        }
        return $result['data'] = $query->result();
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
                if (empty($val)) {
                    continue;
                }
                $this->db->or_like($field, $val);
            }
        }

        $query = $this->db->get($this->table);

        if ($is_array == true) {
            return $query->row_array();
        }
        return $query->row();
    }

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
                }
                $this->db->or_like($field, $val);
            }
        }
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function delete($id) {
        $this->db->where('tax_id', $id);
        $this->db->delete($this->table);
        return TRUE;
    }
	
	/**
	 * Get the list of added country
	 */ 
	public function getTaxCountries()
	{
		$result = array();
		$this->db->select('country_id');
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	
	/**
	 * Get Array of country to use in drop down 
	 */
	public function get_country_list($current_country=NULL)
	{
		$condition = ($current_country!=NULL) ? 'where country_id != \''.$current_country.'\'' : '';
        $this->db->where('`iso` NOT IN (SELECT `country_id` FROM `'.$this->table.'` '.$condition.' )', NULL, FALSE);
		$this->db->order_by("nicename", "asc"); 
		$query = $this->db->get($this->country_table);
		$rows = $query->result_array();
		$result = array(0=>'Select');
		foreach ($rows as $row) {
			//$result[$row['id']] = $row['nicename'];
			$result[$row['iso']] = $row['nicename'];
		}
		return $result;
	}
}
