<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of project_model
 *
 * @author nitin
 */
class Orders_model extends CI_Model {
    
    private $table = 'order_details';
	private $order = 'order';
    /**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
     */ 
   
    public function get_list($is_array = false, $searchs = array(), $sort = array(), $from = 0, $num_result = 10) {
        
		//Get total Row
        $result['totalRows'] = $this->totat_count($searchs);
        //$this->db->select($this->table . '.*');
        $this->db->select($this->order . '.*');
        //Sort 
        if (!empty($sort)) {
            foreach ($sort as $sorter) {
                $this->db->order_by($sorter[0], $sorter[1]);
            }
        }
		if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
				//echo $field;die;
                if (empty($val)) {
                    continue;
                }else if($field=="order_id"){
					$this->db->like($this->order.'.order_id', $val);//category_name
					//die;
				}else{
					$this->db->where($field, $val);
				}
            }
        }
		
		//Get Orders
		$this->db->select('purchases.pay_type AS pay_type, purchases.paypal_txn_id AS paypal_txn_id');
		$this->db->select('users.first_name AS b_first_name, users.last_name AS b_last_name, users.id AS user_id'); 
		
		//$this->db->from('order_details'); 
		$this->db->from('order'); 
		$this->db->join('users', 'users.id = order.user_id', 'left'); 
		$this->db->join('purchases', 'purchases.order_id = order.order_id', 'left'); 
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		
		//Pagination logic
		$from = (int) $from;
        $start = ($from == 1) ? ($from - 1) : (($from - 1) * $num_result );
        $start = ($start < 0) ? 0 : $start;
        $this->db->limit($num_result, $start);

 
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
        //$query = $this->db->get($this->table);
        $query = $this->db->get($this->order);
        return $query->num_rows();
    }

    public function delete($id) {
        $this->db->where('order_id', $id);
        $this->db->delete($this->table);
		$this->db->where('order_id', $id);
		$this->db->delete($this->order);
		
        return TRUE;
    }
	
	function get_order_by_id($id) {
		$this->db->select('order_details.order_id, order_details.quantity, order_details.unit_price, order_details.purchasing_date, order_details.total');
		$this->db->select('product.product_title AS product_title');
		$this->db->select('users.first_name AS u_first_name, users.last_name AS u_last_name, users.id AS user_id'); 
		$this->db->select('order.*'); 
		
		$this->db->from('order_details'); 
		
		$this->db->join('product', 'product.product_id = order_details.product_id', 'left'); 
		$this->db->join('order', 'order.order_id = order_details.order_id', 'left'); 
		$this->db->join('users', 'users.id = order.user_id', 'left'); 
		
		$this->db->where('order_details.order_id', $id);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;

    }	
	
	function get_member_by_id($id) {
	
		$this->db->select('order_details.order_id, order_details.purchasing_date');
		$this->db->select('users.first_name AS u_first_name, users.last_name AS u_last_name, users.id AS user_id'); 
		$this->db->select('purchases.email AS purchases_email, purchases.paypal_txn_id AS txn_id, purchases.order_id AS order_id'); 
		$this->db->select('order.*'); 
		
		$this->db->from('order_details'); 
		
		$this->db->join('order', 'order.order_id = order_details.order_id', 'left'); 
		$this->db->join('purchases', 'purchases.order_id = order_details.order_id', 'left'); 
		$this->db->join('users', 'users.id = order.user_id', 'left'); 
		
		$this->db->where('order_details.order_id', $id);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;

    }	
	
	function orders($id, $array=false) {
	
		$this->db->select('order_details.quantity, order_details.product_id,order_details.unit_price, order_details.total');
		$this->db->select('product.product_title AS product_title');
		 
		$this->db->from('order_details'); 
		
		$this->db->join('product', 'product.product_id = order_details.product_id', 'left'); 
		$this->db->join('order', 'order.order_id = order_details.order_id', 'left'); 
		
		$this->db->where('order_details.order_id', $id);
		$query = $this->db->get();
		if($array)
			$result = $query->result_array();
		else
			$result = $query->result();
			;
		return $result;

    }	

	
	
	
	
	
}
