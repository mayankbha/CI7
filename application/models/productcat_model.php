<?php 

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of project_model
 *
 * @author nitin
 */
class Productcat_model extends CI_Model {
    
    private $table = 'product_category';

    /**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
     */
    function add($data = array()) {
        if (empty($data)) {
            return FALSE;
        }
        if (isset($data['product_cat_id']) && $data['product_cat_id'] !== 0) {
            $this->db->where('product_cat_id', $data['product_cat_id']);
            $this->db->update($this->table, $data);
            return TRUE;
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
	
	public function get_category()
	{
		$query = $this->db->get($this->table);
		$rows = $query->result_array();
		$result = array(''=>'Select');
		foreach ($rows as $row) {
			$result[$row['product_cat_id']] = $row['category_name'];
		}
		//print_r($result);
		return $result;
	}
	
	
	
    /**
     * Get List of all USERs
     * @param type $searchs
     * @param type $sort
     * @param type $from
     * @param type $num_result
     * @param type $is_array
     * @return type
     */
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
        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (!is_numeric($val) && empty($val)) {
                    continue;
                }
                
                $this->db->where($field, $val);
            }
            
			$query = $this->db->get($this->table);

			if ($is_array == true) {
				return $query->row_array();
			}
			return $query->row();
        }
		return array();
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
        $this->db->where('product_cat_id', $id);
        $this->db->delete($this->table);
        return TRUE;
    }

}