<?php
/**
 * Registration_model Class
 * 
 * Handles Additional Registration class 
 *
 * @package PMH Tools
 * @subpackage  Model
 * <x.romel@gmail.com>
 */
class Registration_model extends CI_Model {



    /**
     * Class constructor
     */
    function __construct() {
        parent::__construct();

    }
	function generate_activation_code(){
		$random_string_length=15;
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$string = '';
		for ($i = 0; $i < $random_string_length; $i++) {
			  $string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}
		return $string;
	}
	
	
	function get_country()
    {
        $this->db->select('country_id,country_name');
        $this->db->from('countries');
        $query = $this->db->get();
		if($query->num_rows() > 0)
        {
            $countries = array();
            if($query->result())
            {
                foreach ($query->result() as $country)
                {
                    $countries[$country->country_id] = $country->country_name;
                }
                return $countries;
            }
            else
            {
                return FALSE;
            }
        }
    }

    function get_state($country = null)
    {
        $this->db->select('region_id,region_name');
        if($country != NULL)
        {
            $this->db->where('country_id',$country);
        }
        $query = $this->db->get('regions');
		
        if($query->num_rows() >0)
        {
            $states = array();   
            if($query->result())
            {
                foreach($query->result() as $state)
                {
                    $states[$state->region_id] = $state->region_name;
                }
                return $states;
            }
            else
            {
                return FALSE;
            }
        }
    }
   
    function get_city($state = null)
    {
        $this->db->select('city_id,city_name');
        if($state != NULL)
        {
            $this->db->where('region_id',$state);
        }
        $query = $this->db->get('cities');
        $cities = array();
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $city)
                {
                    $cities[$city->city_id] = $city->city_name;
                }
                return $cities;
        }
        else
        {
            return FALSE;
        }
    }

 
}
