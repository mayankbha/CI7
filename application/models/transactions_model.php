<?php (defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of project_model
 *
 * @author nitin
 */
class Transactions_model extends CI_Model {
    
    private $table = 'purchases';
	private $order = 'order';
    /**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
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
		
		//Get transactions
		$this->db->select($this->order . '.order_id, '.$this->order.'.order_id', FALSE);
        $this->db->join($this->order, $this->table . '.order_id = ' . $this->order . '.order_id', 'left');
		
        //Pagination logic
        $from = (int) $from;
        $start = ($from == 1) ? ($from - 1) : (($from - 1) * $num_result );
        $start = ($start < 0) ? 0 : $start;
        
		$this->db->limit($num_result, $start);
		$query = $this->db->get($this->table);

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
        $this->db->where('order_id', $id);
        $this->db->delete($this->table);
        return TRUE;
    }
	
}
