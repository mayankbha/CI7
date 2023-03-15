<?php defined('BASEPATH') or die('No direct access allowed.');

/**
 * Description of tempalategroup_model
 *
 * @author 
*/
class templategroup_model extends CI_Model
{
    private $table = 'templates_group';
    /**
     * Add or Update a $this->table into database
     * @param type $data
     * @return boolean
     */
    function save($data = array())
    {
        if (empty($data))
        {
            return FALSE;
        }
        if (isset($data['id']) && $data['id'] !== 0)
        {
            $this->db->where('id', $data['id']);
            $this->db->update($this->table, $data);
            return TRUE;
        } else
        {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        return FALSE;
    }

    /**
     * Get List of all $this->tables
     * @param type $searchs
     * @param type $sort
     * @param type $from
     * @param type $num_result
     * @param type $is_array
     * @return type
     */
    public function get_list($is_array = false, $searchs = array(), $sort = array(), $from = 0, $num_result = 10)
    {
        //Get total Row
        $result['totalRows'] = $this->totat_count($searchs);

        $this->db->select($this->table . '.*');

        //Sort 
        if (!empty($sort))
        {
            foreach ($sort as $sorter)
            {
                $this->db->order_by($sorter[0], $sorter[1]);
            }
        }

        //search
        if (!empty($searchs))
        {
            foreach ($searchs as $field => $val)
            {
                if (empty($val))
                {
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
		
		if ($is_array == true)
        {
            $result['data'] = $query->result_array();
            return $result;
        }
        return $result['data'] = $query->result();
    }

    /**
     * Search for a group
     * @param type $is_array
     * @param type $searchs
     * @return type
     */
    public function get_single($searchs = array(), $is_array = false)
    {
        //search
        if (!empty($searchs))
        {
            foreach ($searchs as $field => $val)
            {
                if (empty($val))
                {
                    continue;
                }
                $this->db->or_like($field, $val);
            }
        }

        $query = $this->db->get($this->table);

        if ($is_array == true)
        {
            return $query->row_array();
        }
        return $query->row();
    }


    /**
     * Count all records
     * @param type $searchs
     * @return type
     */
 
     public function totat_count($searchs = array())
    {

        //search
        if (!empty($searchs))
        {
            foreach ($searchs as $field => $val)
            {
                if (empty($val))
                {
                    continue;
                }
                $this->db->or_like($field, $val);
            }
        }
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
	
    /**
     * @param type $id
     * @return boolean
     */

	 public function delete($id)
	 {
	 	$this->db->where('id',$id);
		$this->db->delete($this->table);
		return TRUE;
	 }

}
