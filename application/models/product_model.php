<?php

(defined('BASEPATH')) or exit('No direct script access allowed');

/**
 * Description of project_model
 *
 * @author nitin
 */
class Product_model extends CI_Model {
    
    private $table = 'product';
    private $product_images = 'product_images';
    private $country_table = 'country';
    private $product_country_table = 'product_country';
    private $product_category = 'product_category';
	private $order = 'order';
	private $purchases = 'purchases';
	 
	

    /**
     * Add or Update a USER into database
     * @param type $data
     * @return boolean
     */
    function add($data = array()) {
        if (empty($data)) {
            return FALSE;
        }
        if (isset($data['product_id']) && $data['product_id'] !== 0) {
            $this->db->where('product_id', $data['product_id']);
            $this->db->update($this->table, $data);
            return TRUE; 
        } else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }
	
	/*
	 * Get Product List
	 */
	public function get_products()
	{
		$query = $this->db->get($this->table);
		$rows = $query->result_array();
		$result = array(0=>'Select');
		foreach ($rows as $row) {
			$result[$row['product_id']] = $row['product_title'];
		}
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
    public function get_list($is_array = false, $searchs = array(), $sort = array(), $from = 0, $num_result = 10, $dataTable = true) {
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
        //die('dad');
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
				//echo $field;die;
                if (empty($val)) {
                    continue;
                }else if($field=="category_name"){
					$this->db->like($this->product_category.'.category_name', $val);//category_name
					//die;
				}else{
					$this->db->where($field, $val);
				}
            }
        }
		
		//Get Images
        //$this->db->select($this->product_images . '.product_image_id, '.$this->product_images.'.path', FALSE);
        //$this->db->join($this->product_images, $this->table . '.product_id = ' . $this->product_images . '.fk_product', 'left');
		
		//Get Category
		$this->db->select($this->product_category . '.product_cat_id, '.$this->product_category.'.category_name', FALSE);
        $this->db->join($this->product_category, $this->table . '.fk_product_cat = ' . $this->product_category . '.product_cat_id', 'left');
        
        //Pagination logic
        $start = (int) $from;
        if($dataTable) {
			$from = (int) $from;
			$start = ($from == 1) ? ($from - 1) : (($from - 1) * $num_result );
			$start = ($start < 0) ? 0 : $start;
		}
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
     * Search for a Product
     * @param type $is_array
     * @param type $searchs
     * @return type
     */
    public function get_product($is_array = false, $searchs = array()) {
		$result = array();
		$this->db->select($this->table . '.*');
        //search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (empty($val)) {
                    continue;
                }
                $this->db->where($field, $val);
            }
        }
		
		//Get Category
		$this->db->select($this->product_category . '.product_cat_id, '.$this->product_category.'.category_name', FALSE);
        $this->db->join($this->product_category, $this->table . '.fk_product_cat = ' . $this->product_category . '.product_cat_id', 'left');
        
        $query = $this->db->get($this->table);

        if ($is_array == true) {
			$product = $query->row_array();
			$result['product_countries'] = $this->get_product_country($product['product_id'], $is_array);
			$result['product_images'] = $this->getAllProductImages($product['product_id'], $is_array);
            $result['product'] = $product;
            return $result;
        }
        $product = $query->row();
        $result['product_countries'] = $this->get_product_country($product['product_id'], $is_array);
        $result['product_images'] = $this->getAllProductImages($product['product_id'], $is_array);
        $result['product'] = $product;
        return $result;
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
                }else if($field=="category_name"){
					$this->db->like($this->product_category.'.category_name', $val);//category_name
					//die;
				}
                $this->db->or_like($field, $val);
            }
        }
        //Get Category
		$this->db->select($this->product_category . '.product_cat_id, '.$this->product_category.'.category_name', FALSE);
        $this->db->join($this->product_category, $this->table . '.fk_product_cat = ' . $this->product_category . '.product_cat_id', 'left');
        
        
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
	
	/**
	 * Delete an product
	 */
    public function delete($id) {
		//Remove Peoduct Country
		$this->delete_product_country($id);
		
		//Remove Peoduct
        $this->db->where('product_id', $id);
        $this->db->delete($this->table);
        return TRUE;
    }
	
	/**
	 * update an product
	 */
    public function update_status($id,$status) {
		
		//update Product
		if($status == 1){
		  $sts = 0; 
		}else{
		   $sts = 1;
		}
		$data['active'] = $sts;
        $this->db->where('product_id', $id);
        $this->db->update($this->table,$data);
        return TRUE;
    }
	
	/**
	 * Get Countries for product
	 */ 
	 public function get_product_country_by_id ($product_id, $country_id, $is_array = TRUE)
	 {
		$query = $this->db->get_where($this->product_country_table, array('product_id' => $product_id, 'country_id'=>$country_id));
		//echo $this->db->last_query(); 
        if ($is_array == true) {
            return $query->row_array();
        }
        return $query->result();
	 }
	
	/**
	 * Get Countries for product
	 */ 
	 public function get_product_country ($product_id, $is_array = TRUE)
	 {
		$query = $this->db->get_where($this->product_country_table, array('product_id' => $product_id));
		//echo $this->db->last_query(); 
        if ($is_array == true) {
            return $query->result_array();
        }
        return $query->result();
	 }
	
	/**
	 * Delete Countries for product
	 */ 
	 public function delete_product_country($product_id)
	 {
		$this->db->where('product_id', $product_id);
        $this->db->delete($this->product_country_table);
        return TRUE;
	 }
	 
	/**
	 * Get Array of country to use in drop down 
	 */
	public function get_country_list($searchs=array())
	{
		//search
        if (!empty($searchs)) {
            foreach ($searchs as $field => $val) {
                if (empty($val)) {
                    continue;
                }
                $this->db->where($field, $val);
            }
        }
        
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
	
	public function save_product_country($product_id, $countries, $normal_ship, $experss_ship)
	{
		$data = array();
		if ( is_array($countries) && !empty($countries) )
		{
			$count = 0;
			$save = false;
			
			foreach ($countries as $key => $country)
			{
				if($country=='0') 
				{//echo '<pre>'; print_r($country); die;
					continue;
				}
				else
				{
					$save = true;
					$data[] = array(
						'country_id' => $country,
						'shipping_normal' => $normal_ship[$count],
						'shipping_express' => $experss_ship[$count],
						'product_id' => $product_id,
					);
				}
				$count++;
			}
			//echo '<pre>'; print_r($data);die;
			if($save) {
				$this->db->insert_batch($this->product_country_table, $data);
			}
			return $this->db->affected_rows();
		}
		return FALSE;
	}
	
	/**  Images Related Functions**/
	
	//get all product images
	public function getAllProductImages($product_id, $is_array = FALSE) {
	
	    $query = $this->db->get_where($this->product_images, array('fk_product' => $product_id));
	    if ($is_array == true) {
            return $query->result_array();
        }
        return $query->result();
	
	}
	//add product image
	public function saveProductImage($data) {
       $this->db->insert($this->product_images,$data);
       return $this->db->insert_id();
	}

   /**
    delete product image
   **/	
  public function delete_product_image($product_image_id)
  {
    $query = $this->db->get_where($this->product_images, array('product_image_id' => $product_image_id));
        if($query->num_rows()>0) :
            $image = $query->row()->path;
        else :
		    return array();
		endif;
	$this->db->where('product_image_id',$product_image_id);
	$this->db->delete($this->product_images);
	return $image;
  }
   
   /**
    add product order
   **/
  
    public function add_order($tbl_name,$data)
	{
	  $this->db->insert($tbl_name,$data);
	  $insert_id = $this->db->insert_id();
	  return $insert_id;
	}
	
	public function update_donation_status($tbl_name,$data)
	{
		$this->db->where('donation_id', $this->session->userdata['donate_id']);
		$this->db->update($tbl_name, $data); 

	}
	public function get_donation_detail()
	{
		$this->db->where('donation_id',$this->session->userdata('donate_id'));
        $query = $this->db->get('message_donation');
	    if ($query->num_rows() > 0)
        {
	      return $query->result();
		}
	}
	
	public function get_userinfo()
	{
		
		$this->db->select('*');
		$this->db->from('user_data');
		$this->db->where('user_id', $this->session->userdata('user_id'));
		$this->db->join('users', 'users.id = user_data.user_id');
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
        {
	      return $query->result();
		}
	}
	
	public function get_country($iso="")
	{
		
		$this->db->select('nicename');
		$this->db->from('country');
		$this->db->where('iso', $iso);
		
		$query = $this->db->get();
		if ($query->num_rows() > 0)
        {
	      return $query->result();
		}
	}
	
}
