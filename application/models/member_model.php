<?php

/**
 * member_model Class
 * 
 * Handles member-data processing
 *
 * @package PMH Tools
 * @subpackage  Model
 * @author  Rommel Capispisan <x.romel@gmail.com>
 */
class Member_model extends CI_Model
{

    /**
     *
     * @var CI_Encrypt CodeIgniter's Encryption library 
     */
    private $encrypt = null;

    /**
     *
     * @var ArraySql ArrySql Object to simulate SQL operation on arrays 
     */
    private $arraySql = null;

    /**
     *
     * @var mixed Array of fields that are encrypted
     */
    private $encryptedFields = array(
        'birthdate'
    );
    private $table = 'users';  

    /**
     * Class constructor
     */
    function __construct()
    {
        parent::__construct();

        $CI = & get_instance();
        $CI->load->library('encrypt');
        //$CI->load->library('ArraySql');
        $this->encrypt = $CI->encrypt;
		$this->load->model('mail_model');
    }

    /**
     * Encrypts the given data   
     *    
     * @param mixed $data Array or object containing unencrypted data
     * @return mixed Array or object with encrypted data     
     */
    private function encryptData($data)
    {

        // process array-type data         
        if (is_array($data))
        {
       // Only encrypt fields that should be encrypted             
            foreach ($this->encryptedFields as $field)
            {
                if (isset($data[$field]))
                {
                    $data[$field] = $this->encrypt->encode($data[$field]);
                }
            }
            // Mark data as encrypted      
            $data['encrypted'] = 1;
            // Process object-type data          
        } else
        {
            // Only encrypt fields that should be encrypted       
            foreach ($this->encryptedFields as $field)    
            {
                if (property_exists($data, $field))
                {
                    $data->{$field} = $this->encrypt->encode($data->{$field});
                }
            }
            // Mark data as encrypted 
            $data->encrypted = 1;
        }

        // Return encrypted data   
        return $data;
    }

    /**
     * Decrypts the given data          
     * 
     * @param mixed $data Array or object containing encrypted data      
     * @return mixed Array or object with dencrypted data       
     */
    private function decryptData($data)
    {
        // Process array-type data           
        if (is_array($data))
        {
            // Check if encypted flag field is available        
            // if not available, do not decrypt        
            if (!isset($data['encrypted']))  
            {
                return $data;
            }

            // Check if encrypted flag is set to off 
            // If flag is 0 (off), it means that the record is in its  
            // unencrypted form so decryption shoul be skipped 
            if (!intval($data['encrypted']))   
            {
                return $data;
            }

            // Only decrypt fields that are encrypted        
            foreach ($this->encryptedFields as $field)
            {
                if (isset($data[$field]))
                {
                    $data[$field] = $this->encrypt->decode($data[$field]);
                }
            }

            // Process object-type data
        } else
        {
            // Check if encrypt flag property is available
            // If not, skip decryption 
            if (!property_exists($data, 'encrypted'))
            {
                return $data;
            }

            // If data is not encrypted (encrypted flag property is 0)
            // skip decryption
            if (!intval($data->encrypted))
            {
                return $data;
            }

            // Only decrypt fields that are encrypted
            foreach ($this->encryptedFields as $field)
            {
                if(property_exists($data, $field))
                {
                    $data->{$field} = $this->encrypt->decode($data->{$field});
                }
            }
        }

        // Return decrypted data
        return $data;
    }

    /**
     * Process all member records, encrypting fields that
     * needs encryption
     *
     */
    function convert_to_encrypted()
    {
        $query = $this->db->get('core_members');
        $result = $query->result_array();

        foreach ($result as $r)
        {
            // Encrypt record if it is not yet encrypted
            if (intval($r['encrypted']) == 0)
            {
                $r = $this->encryptData($r);
                $this->db
                        ->where('id', $r['id'])
                        ->update('core_members', $r);
            }
        }
    }

    /**
     *  get count of all users
     * 
     * @param string $id id of the member to find
     * @return mixed Array of member objects 
     */
    function get_member_count() 
    {
        return $this->db->count_all_results('users'); 
    }

    /**
     *  get newest member     
     *
     * @param string newest date `created_on` of the member to find   
     * @return $firstname, $lastname of member      
     */
    function get_newest_member() 
    { 
        $this->db->select('first_name, last_name'); 
        $this->db->from('users'); 
        $this->db->order_by('created_on', 'desc'); 
        $this->db->limit(1); 
        $query = $this->db->get(); 
        $result = $query->result_array(); 
        return $result[0]; 
    }

    /**
     *  Find members with the given the Id          
     *
     * @param string $id id of the member to find          
     * @return mixed Array of member objects            
     */
    function get_id_by_email($email)
    {
        $this->db->select('id');
        $this->db->from('users');
        //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left'); 
        $this->db->where(array('users.email' => $email));
        $query = $this->db->get();
        $result = $query->result_array();
		//print_r($result[0]['id']);die;
        return $result[0]['id'];
    }

    //get main profile pic             
    function get_main_id($id) 
    {
        $this->db->select('*');
        $this->db->from('profile_pics');
        //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left');    
        $this->db->where(array('user_id' => $id));
        $this->db->where(array('active' => '1'));
        $query = $this->db->get();  
        $result = $query->result_array();  
        if (count($result) > 0)  
        {  
                
        } else
        {
            $this->db->select('*');    
            $this->db->from('profile_pics');    
            //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left');     
            $this->db->where(array('user_id' => $id));   
            $query = $this->db->get();
            $result = $query->result_array();
            if (count($result) > 0)    
            {             
                    
            } else
            {
                $result[0] = array(   
                    'name' => 'default000001.jpg'   
                );
            }
        }
        //echo count($result);
        return $result[0];
    }   

    //get all profile pic    
    function get_profile_ids($id)
    {
        $this->db->select('*');
        $this->db->from('profile_pics');
        //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left');   
        $this->db->where(array('user_id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
		//print_r($result);die;
        return $result;
    }

    //set profile as avatar
    function set_profile_avatar($id)
    {
        $this->unset_profile_avatar();
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->where('id', $id);
        $this->db->update('profile_pics', array('active' => '1'));

        $this->db->select('name');
        $this->db->from('profile_pics');
        $this->db->where(array('id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
        return '<img src="/uploads/profile/' . $result[0]['name'] . '" alt="" class="img-responsive img-rounded">';
    }

    function unset_profile_avatar()
    {
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->update('profile_pics', array('active' => ''));
    }

    //get submitted id entries
    function get_submitted_ids($id)
    {
        $this->db->select('*');
        $this->db->from('submitted_id');
        //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left');
        $this->db->where(array('user_id' => $id));
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    function test_getting_decripted($id)  
    {
        $this->db->select('id'); 
        $this->db->from('users');  
        //$this->db->join('users', 'core_members.attending_doctor = core_meta.user_id', 'left');  

        $this->db->where(array('users.id' => $id));  
        $query = $this->db->get();
        $result = $query->result();
 
        $decrypted = array();

        foreach ($result as $r)  
        {
            $r = $this->decryptData($r);  
            $decrypted[] = $r;   
        }

        return $decrypted;
    }

    /**
     * Get the number of records matching any given condition/s  
     * 
     * @param midex $conditions  
     * @return integer Number of matching records
     */
    function find_count($conditions = FALSE)
    {
        $count = $this->find_all_array($conditions);  

        if ($count)  
        {
            $this->arraySql->setData($this->find_all_array($conditions));  
            return count($this->arraySql->query($conditions));  
        } else
        {
			//print_r($count);
            return count($count);   
        }
    }

    /**
     *  Saves given member additional data into the database   
     *    
     * @param mixed $data Array representing member record   
     * @return integer Id of the saved member record   
     */
    function save_member_data($db_table, $data)
    {
		foreach ($data as $field => $value)
        {
            $fieldArray[] = "`" . $field . "`";
            $valueArray[] = "'" . addslashes($value) . "'";
			
            //$fields.='';
            //$value.='';
        }
        $fields = implode(', ', $fieldArray);
        $values = implode(', ', $valueArray);
        $sql = "INSERT INTO " . $db_table . "
			(" . $fields . ") VALUES (" . $values . ")
		";
        $query = $this->db->query($sql);
		//echo $this->db->last_query();die;
    }

    function get_profile($email)
    {
        $query = $this->db->query("
			SELECT * FROM `users` AS `u` 
			LEFT JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			LEFT JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			WHERE `email`='" . $email . "' 
			");
		
        $profile = $query->result_array();
		return $profile[0];
    }
	
	
	 

   /* function get_profile_by_id2($id)
    {
        $query = $this->db->query("
			SELECT * FROM `users` AS `u` 
			LEFT JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			LEFT JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			LEFT JOIN `match_criteria` on `ud`.`user_id`=`match_criteria`.`user_id`
			WHERE `u`.`id`='" . $id . "' 
			");
			
        $profile = $query->result_array(); 
		//return @$profile;  
		
		return @$profile[0];  
    }
	*/
	
	
	/////////////////////////////////////////  29oct ////////////////////////////////////
	/* function get_profile_by_id2($id)
    {
        $query = $this->db->query("
			SELECT * FROM `users` AS `u` 
			LEFT JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			LEFT JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			LEFT JOIN `match_criteria` on `ud`.`user_id`=`match_criteria`.`user_id`

			WHERE `u`.`id`='" . $id . "' 
			");
			
        $profile = $query->result_array(); 
		
		//return @$profile;  
		return @$profile[0];  
    }
	
	*/
	
	 function get_profile_by_id2($id)
    {
        $query = $this->db->query("
			SELECT * FROM `users` AS `u` 
			LEFT JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			LEFT JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			LEFT JOIN `match_criteria` on `ud`.`user_id`=`match_criteria`.`user_id`

			WHERE `u`.`id`='" . $id . "' 
			");
			
        $rows = $query->result();
		//echo "<pre>";print_r($row->id);die;
		$usersArray = array();
			foreach ($rows as $row) 
			{
				
                $data = array(
					
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
					"gender" => $row->gender,
					"looking_for" => $row->looking_for,
                    "email" => $row->email,
                    "state_province" => $this->get_state_name($row->state_province),
					"city" => $this->get_city_name($row->city),
                    //"city" => $row->city,
                    "country" => $row->country,
                    "im_seeking_a" => $row->im_seeking_a,
                    "age_between" => $row->age_between,
                    "about_yourself" => $row->about_yourself,
					"dob" => $row->dob,
                    "profile_head" => $row->profile_head,
                    "send_heart" => $this->count_send_heart($id),
					"like" => $this->count_send_like($id),
					"favourite" => $this->count_add_fav($id),
					"block_user_id" => $this->mail_model->get_block_user_data($id),
					"warning_message" => $this->count_warnings($id),
					"relationship_your_looking_for" => $row->relationship_your_looking_for,
                );
		$usersArray[0] = $data;
		}
		//print_r($usersArray);die;
		return $usersArray[0];
	
    }
	
	
	
	

    function get_poster_data($id) 
    {
        $query = $this->db->query("
			SELECT 
			`u`.`first_name`, 
			`u`.`last_name`, 
			`u`.`email`,
			`ud`.`state_province`,
			`ud`.`city`,
			`ud`.`country`,
			`ud`.`gender`,
			`u`.`created_on` as `created_on`,
			`ud`.`dob`,
			`up`.`profile_head`
			FROM `users` AS `u` 
			INNER JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			INNER JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			WHERE `u`.`id`='" . $id . "' AND `u`.`active`='1'
			");

        $profile = $query->result_array(); 
        if (isset($profile[0]))
        {
            return $profile[0];
        } else
        {
            return false;
        }
    }

    function get_active_avatar($id) 
    {
        $query = $this->db->query("
			SELECT `name`
			FROM `profile_pics`
			WHERE `user_id`='" . $id . "' AND `active`='1'
			");

        $profile = $query->result_array();   
        if (isset($profile[0]['name']))
        {
            return $profile[0]['name'];
        } else
        {
            return false;
        }
    }

    function get_non_active_avatars($id) 
    {
        $query = $this->db->query("
			SELECT `name`
			FROM `profile_pics`
			WHERE `user_id`='" . $id . "' AND `active`='0'
			");
        $profile = $query->result_array(); 
        return $profile;
    }

   /* function get_profile_by_id($id) 
    {
        $query = $this->db->query("
			SELECT 
			`u`.`first_name`, 
			`u`.`last_name`, 
			`u`.`email`,
			`ud`.`looking_for`,
			`ud`.`state_province`,
			`ud`.`city`,
			`ud`.`country`,
			`ud`.`gender`,
			`mc`.`im_seeking_a`,
			`mc`.`age_between`,
			YEAR(CURDATE())-YEAR(`ud`.`dob`) as `age`,
			`ud`.`dob`,
			`up`.`profile_head`
			FROM `users` AS `u` 
			INNER JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			INNER JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			INNER JOIN `match_criteria` AS `mc` on `u`.`id` = `up`.`user_id`
			WHERE `u`.`id`='" . $id . "' AND `u`.`active`='1'
			");

		
        $profile = $query->result_array();
        if (isset($profile[0]))
        {	
		
            return $profile[0];
        } else
        {
            return false;
        }
    }*/
	
	 function get_profile_by_id($id) 
    {
        $query = $this->db->query("
			SELECT 
			`u`.`id`, 
			`u`.`first_name`, 
			`u`.`last_name`, 
			`u`.`email`,
			`ud`.`looking_for`,
			`ud`.`state_province`,
			`ud`.`city`,
			`ud`.`country`,
			`ud`.`gender`,
			`mc`.`im_seeking_a`,
			`mc`.`age_between`,
			YEAR(CURDATE())-YEAR(`ud`.`dob`) as `age`,
			`ud`.`dob`,
			`up`.`profile_head`
			FROM `users` AS `u` 
			INNER JOIN `user_data` AS `ud` on `u`.`id` = `ud`.`user_id` 
			INNER JOIN `user_profile` AS `up` on `u`.`id` = `up`.`user_id` 
			INNER JOIN `match_criteria` AS `mc` on `u`.`id` = `up`.`user_id`
			WHERE `u`.`id`='" . $id . "' AND `u`.`active`='1'
			");

		$rows = $query->result();
		//echo "<pre>";print_r($rows);die;
		$usersArray = array();
			foreach ($rows as $row) 
			{
                $data = array(
					
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
					"gender" => $row->gender,
					"looking_for" => $row->looking_for,
                    "email" => $row->email,
                    "state_province" => $this->get_state_name($row->state_province),
					"city" => $this->get_city_name($row->city),
                    //"city" => $row->city,
                    "country" => $row->country,
                    "im_seeking_a" => $row->im_seeking_a,
                    "age_between" => $row->age_between,
                    "age" => $row->age,
					"dob" => $row->dob,
                    "profile_head" => $row->profile_head,
                    "send_heart" => $this->count_send_heart($row->id),
					"like" => $this->count_send_like($row->id),
					"favourite" => $this->count_add_fav($row->id),
					"block_user_id" => $this->mail_model->get_block_user_data($row->id),
					"warning_message" => $this->count_warnings($row->id)
                );
		$usersArray[0] = $data;
		}
		return $usersArray[0];
    }
	
	
	function count_warnings($id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			$this->db->where('user_id_sender',$this->session->userdata['user_id']);
			
			$query = $this->db->get('send_warning_message');
			return $query->num_rows();
		}
	}
	
	function age_between($id){
	
		$this->db->select('age_between');
		$this->db->where('user_id',$id);
		$query = $this->db->get('match_criteria');
		$age_between = $query->result_array();
        if (isset($age_between[0]['age_between']))
        {
			return $age_between[0]['age_between'];   
        }else
        {
            return false;
        }
	}
	
    function get_profile_name_by_id($id)
    {
        $query = $this->db->query("
			SELECT `u`.`first_name`, `u`.`last_name`
			FROM `users` AS `u` 
			WHERE `u`.`id`='" . $id . "' 
			");

        $profile = $query->result_array();
        if (isset($profile[0]))
        {
            return $profile[0];
        } else
        {
            return false;
        }
    }

    //profile edit ajax functions   
    function save_profile_match($data)
    {
        $exist = $this->find_profile_match($this->session->userdata['user_id']);

        if ($exist > 0)
        {
            //update data   
            $this->db->where('user_id', $this->session->userdata['user_id']);
            $this->db->update('match_criteria', $data);
            return 'Changes saved';
        } else
        {
            //insert data
            $data['user_id'] = $this->session->userdata['user_id'];
            $query = $this->db->insert('match_criteria', $data);
            return 'New data saved';
        }
    }

	//edit profile
    function save_edit_profile($data, $data2) 
    {
        //update data
        $this->db->where('user_id', $this->session->userdata['user_id']);  
        $this->db->update('user_data', $data);
		//echo $this->db->last_query();
        $this->db->where('user_id', $this->session->userdata['user_id']); 
        $this->db->update('user_profile', $data2); 
		
		
		
        return 'Changes saved'; 
    }
	
	//save personality details
	function save_personality_details($data) 
    {
		$exist = $this->find_profile_personality($this->session->userdata['user_id']);
        //print_r($exist);echo "asdf";die;
		if($exist > 0)
		{
			//update data   
            $this->db->where('user_id', $this->session->userdata['user_id']);
            $this->db->update('profile_personality', $data);
		}else{
			//insert data
        	$data['user_id'] = $this->session->userdata['user_id'];
        	$query = $this->db->insert('profile_personality', $data);
		}
		//echo $this->db->last_query();
        //return 'New data saved';    
    }  
	
	 //get existing profile match count
    public function find_profile_personality($user_id)
    {
        $query = $this->db->get_where('profile_personality', array('user_id' => $user_id));
		return count($query->result_array());
    }
	
	
    //get data for profile verify               
    public function get_profile_verify($user_id)
    {
		//echo $user_id;die;
        //$query = $this->db->get_where('users', array('id' => $user_id));    
		$this->db->select('*');
        $this->db->from('users');
        $this->db->join('user_data', 'user_data.user_id = users.id');
		$this->db->where('user_data.user_id = "'.$user_id.'"' );
        $query = $this->db->get();
		//echo $this->db->last_query();
        $existing_data = $query->result_array();
        //echo "<pre>";print_r($existing_data);die;
		
		return $existing_data[0];
    }

    //get existing questions data
    public function get_questions($user_id)
    {
        $query = $this->db->get_where('profile_questions', array('user_id' => $user_id));
        $existing_data = $query->result_array();
        return $existing_data;
    }

    //clear existing questions data
    public function clear_questions($user_id)
    {
        $this->db->delete('profile_questions', array('user_id' => $user_id));
    }

    //save interest    
    function save_questions($data) 
    {
        //insert data
        $data['user_id'] = $this->session->userdata['user_id'];
        $query = $this->db->insert('profile_questions', $data);
        //return 'New data saved';    
    }    

    //get existing interest data    
    public function get_interest($user_id)  
    {  
        $query = $this->db->get_where('user_interest', array('user_id' => $user_id)); 
        $existing_data = $query->result_array(); 
	
		
        if (isset($existing_data[0])) 
        {
            return $existing_data[0]; 
        } else
        { 
             return false;
        }  
    }  
      
    //clear existing interest data
    public function clear_interest($user_id)  
    { 
        $this->db->delete('user_interest', array('user_id' => $user_id)); 
    } 
 
    //save interest 
    function save_interest($data)   
    { 
        $exist = $this->find_interest($this->session->userdata['user_id']);
         
        if ($exist > 0) 
        { 
            //update data 
            $this->db->where('user_id', $this->session->userdata['user_id']); 
            $this->db->update('user_interest', $data); 
            return 'Changes saved';  
        } else
        { 
            //insert data   
            $data['user_id'] = $this->session->userdata['user_id']; 
            $query = $this->db->insert('user_interest', $data); 
            return 'New data saved'; 
        }
    }

    //get existing interest count
    public function find_interest($user_id) 
    {
        $query = $this->db->get_where('user_interest', array('user_id' => $user_id));
        return count($query->result_array());
    }

    //get existing profile match count
    public function find_profile_match($user_id)
    {
        $query = $this->db->get_where('match_criteria', array('user_id' => $user_id));
		//print_r(count($query->result_array()));die;
        return count($query->result_array());
    }

    //get existing profile match data
    public function get_profile_match($user_id)
    {
        $query = $this->db->get_where('match_criteria', array('user_id' => $user_id));
		$existing_data = $query->result_array();
        return $existing_data[0];
    }

    //get edit profile data count
    public function get_edit_profile_data_count($user_id)
    {
        $query = $this->db->get_where('user_data', array('user_id' => $user_id));
        return count($query->result_array());
    }

    //get edit profile user_data
    public function get_edit_profile_data($user_id)
    {
        $query = $this->db->get_where('user_data', array('user_id' => $user_id));
        $existing_data = $query->result_array();
        return $existing_data[0];
    }
 
    //get edit profile user_profile   
    public function get_edit_profile_profile($user_id)
    {
        $query = $this->db->get_where('user_profile', array('user_id' => $user_id));
        $existing_data = $query->result_array();
        return $existing_data[0];
    }

   /* 17sep
   //ajax recepient search    
    public function recepient_search($keyword)
    {
        $this->db->select('id, first_name, last_name');
        $this->db->from('users');
        //$this->db->join('users', 'user_data.user_id = users.id');    
        $this->db->where('`first_name` like \''.$keyword.'%\'');   
        $this->db->or_where('`last_name` like \''.$keyword.'%\'');   
        $this->db->where("`active` = '1'");   
        $query = $this->db->get();   
        $existing_data = $query->result_array();   
        return $existing_data;   
    }	
	*/
	
	 //ajax recepient search    
    public function recepient_search($keyword)
    {
		$query = $this->db->query("SELECT `block_user_id` FROM `block_user` WHERE `user_id_sender`= '".$this->session->userdata['user_id']."'");
		//var_dump($query);die;
			# Use any one query from the above!
			if ($query->num_rows() > 0)
			{
				$result = $query->result_array();
				foreach($result as $row)
				{
					 $fieldArray[] = "" . $row['block_user_id'] . "";
				}
				$fields = implode(',', $fieldArray);
				//print_r($fields);
				$query = $this->db->query('SELECT `id` , `first_name` , `last_name` FROM (`users`) WHERE `id` NOT IN ('.$fields.') '); 
				
				//$this->db->select('id, first_name, last_name');
				//$this->db->from('users');
				//$this->db->where_not_in('id', $fields);
				//$this->db->where('`id` NOT IN \'%'.$fields.'%\'');
				//$this->db->or_where('`first_name` like \'%'.$keyword.'%\'');
				//$this->db->where('`last_name` like \'%'.$keyword.'%\'');
				//$this->db->where("`active` = '1'");
				//$query = $this->db->get();
				//echo $this->db->last_query();
				$existing_data = $query->result_array();    
				return $existing_data;
				
			}else
			{
				$this->db->select('id, first_name, last_name');
				$this->db->from('users');
				//$this->db->join('users', 'user_data.user_id = users.id'); 
				$this->db->where('`first_name` like \'%'.$keyword.'%\'');
				$this->db->or_where('`last_name` like \'%'.$keyword.'%\'');
				$this->db->where("`active` = '1'");
				$query = $this->db->get();
				$existing_data = $query->result_array();
				return $existing_data;
			}
		
    }	

//////////////////////////////////////////////2 oct changes/////////////////////////////////////////////////////		
	/* //ajax recepient search    
   7 october
	 public function recepient_search($keyword)
    {
		$query = $this->db->query("SELECT `block_user_id` FROM `block_user` WHERE `user_id_sender`= '".$this->session->userdata['user_id']."'");
		
			# Use any one query from the above!
			if ($query->num_rows() > 0)
			{
				$result = $query->result_array();
				foreach($result as $row)
				{
					 $fieldArray[] = "" . $row['block_user_id'] . "";
				}
				$fields = implode(',', $fieldArray);
				$query = $this->db->query('SELECT `id` , `first_name` , `last_name` FROM (`users`) WHERE `id` NOT IN ('.$fields.') '); 
				$existing_data = $query->result_array();   
				return $existing_data;
				
			}else
			{
				$this->db->select('id, first_name, last_name');
				$this->db->from('users');
				//$this->db->join('users', 'user_data.user_id = users.id'); 
				$this->db->where('`first_name` like \'%'.$keyword.'%\'');
				$this->db->or_where('`last_name` like \'%'.$keyword.'%\'');
				$this->db->where("`active` = '1'");
				$query = $this->db->get();
				$existing_data = $query->result_array();
				return $existing_data;
			}
    }	*/
	
///////////////////////////////////////////////////////////////////////////////////////////////////	
	
	
	
	/*//ajax recepient search    
    public function recepient_search($keyword)
    {
		$query = $this->db->query("SELECT `block_user_id` FROM `block_user` WHERE `block_user_name` LIKE '%$keyword%' AND `user_id_sender`= '".$this->session->userdata['user_id']."'");
			# Use any one query from the above!
		
			if ($query->num_rows() > 0)
			{
				return false;
				
			}else{
				$this->db->select('id, first_name, last_name');
				$this->db->from('users');
				//$this->db->join('users', 'user_data.user_id = users.id');    
				$this->db->where('`first_name` like \'%'.$keyword.'%\'');   
				$this->db->or_where('`last_name` like \'%'.$keyword.'%\'');   
				$this->db->where("`active` = '1'");
				$query = $this->db->get();
				$existing_data = $query->result_array();   
				return $existing_data;
		}  
    }	
	*/
	//search            
    public function basic_search($i_am, $looking_for, $age)
    {
		$this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
        $this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $age[0] . ' AND ' . $age[1]);
        $this->db->where("`user_data`.`gender` = '" . substr($looking_for, 0, 1) . "'");
        $this->db->where("`users`.`active` = '1'");
        $query = $this->db->get();
        $existing_data = $query->result_array();
        return $existing_data;
    }
 
    public function advanced_search($i_am, $looking_for, $age, $living_in, $living_in2, $with_in, $nationality, $education, $english_ability, $vietnamese_ability, $height, $weight, $ethnicity, $body_type)
    {
		$this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
        if (isset($age[0]) && isset($age[1]) && !empty($age[0]) && !empty($age[1]))
            $this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $age[0] . ' AND ' . $age[1]);

        $this->db->where("`user_data`.`gender` = '" . substr($looking_for, 0, 1) . "'");
        if ($living_in != 'any')
        {
            $this->db->where("`user_data`.`city` = '" . $living_in . "'");
        }
        if ($living_in2 != 'any')
        {
            $this->db->where("`user_data`.`country` = '" . $living_in2 . "'");
        }
        if ($nationality != 'any')
        {
            $this->db->where("`user_data`.`nationality` = '" . $nationality . "'");
        }
        if ($education != 'any')
        {

            $this->db->where("`user_data`.`education` = '" . $education . "'");
        }
        if ($english_ability != 'any')
        {
            $this->db->where("`user_data`.`english_ability` = '" . $english_ability . "'");
        }
        if ($vietnamese_ability != 'any')
        {
            $this->db->where("`user_data`.`vietnamese_ability` = '" . $vietnamese_ability . "'");
        }
        if ($height != 'any')
        {
            $heightArray = explode(';', $height);

            $this->db->where("`user_data`.`height` >= '" . $heightArray[0] . "'");
            $this->db->where("`user_data`.`height` <= '" . $heightArray[1] . "'");
        }
        if ($weight != 'any')
        {
            $weightArray = explode(';', $weight);
            $this->db->where("`user_data`.`weight` >= '" . $weightArray[0] . "'");
            $this->db->where("`user_data`.`weight` <= '" . $weightArray[1] . "'");
        }
        if ($body_type != 'any')
        {
            //echo $body_type;
            $this->db->where("`user_data`.`body_type` = '" . $body_type . "'");
        }
        /*
          if($vietnamese_ability!='any'){
          $this->db->where("`user_data`.`vietnamese_ability` = '".$vietnamese_ability."'");
          }
          if($ethnicity!='any'){
          $this->db->where("`user_data`.`ethnicity` = '".$ethnicity."'");
          }
         */
        //$this->db->where("`user_data`.`country` = '".$with_in."'");				
        $this->db->where("`users`.`active` = '1'");
        $query = $this->db->get();   
		
        $existing_data = $query->result_array();    
        return $existing_data;   
    }

    
	public function search($criteria = array())    
    {      
		//print_r($criteria);die;
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
		//$this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);
       
        $this->db->where("`user_data`.`gender` = '" . substr($criteria['looking_for'], 0, 1) . "'");
        $this->db->where("`users`.`active` = '1'");    
		//$this->db->or_where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);
		$this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);

        if (isset($criteria['have_pic']) && $criteria['have_pic'] != FALSE)
        {   
            $this->db->join('profile_pics', 'profile_pics.user_id = user_data.user_id');
            $this->db->where("`profile_pics`.`active` = '1'");
        }

        if (isset($criteria['country']) && !empty($criteria['country']))
        {
            $this->db->where("`user_data`.`country` = '" . $criteria['country'] . "'");
        }
        
		if (isset($criteria['state_province']) && !empty($criteria['state_province']))  
        {
            $this->db->where("`user_data`.`state_province` = '" . $criteria['state_province'] . "'");
        }
		
		if(isset($criteria['city']) && !empty($criteria['city']))
		{
			$this->db->where("`user_data`.`city` = '".$criteria['city']."'");
		}

        $query = $this->db->get();  
		//echo $this->db->last_query();
		$existing_data = $query->result_array();
		//echo "<pre>";print_r($existing_data);die;
		return $existing_data;
    }

	


    /**** Function for admin start***/               

    public function get_members_list($searchs = array(), $sort = array(), $from = 0, $num_result = 10, $is_array = true)
    {
        //Get total Row        
        $result['totalRows'] = $this->totat_count($searchs);

        $this->db->select($this->table . '.*');
        $this->db->where($this->table . '.id != 1');
        $this->db->order_by($this->table . '.id', 'desc');
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
     * Count all records
     * @param type $searchs
     * @return type
     */
    public function totat_count($searchs = array())
    {
        $this->db->where($this->table . '.id != 1');    
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

    function save_member($data = array()) 
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


	/*public function advancesearch($i_am, $looking_for, $min_age, $nationality, $education, $english_ability, $religion,$height, $weight,$body_type,$appearance,$relationship_your_looking_for)
    {
		$this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
        if (isset($age[0]) && isset($age[1]) && !empty($age[0]) && !empty($age[1]))
            $this->db->or_where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $age[0] . ' AND ' . $age[1]);

        $this->db->where("`user_data`.`gender` = '" . substr($looking_for, 0, 1) . "'");
        
        if ($nationality != 'any')
        {
            $this->db->where("`user_data`.`nationality` = '" . $nationality . "'");
        }
        if ($education != 'any')
        {
            $this->db->where("`user_data`.`education` = '" . $education . "'");
        }
        if ($english_ability != 'any')
        {
            $this->db->where("`user_data`.`english_ability` = '" . $english_ability . "'");
        }
		
        if ($religion != 'any')
        {
            $this->db->where("`user_data`.`religion` = '" . $religion . "'");
        }
		if ($height != 'any')
        {
            $heightArray = explode(';', $height);

            $this->db->where("`user_data`.`height` >= '" . $heightArray[0] . "'");
            $this->db->where("`user_data`.`height` <= '" . $heightArray[1] . "'");
        }
        if ($weight != 'any')
        {
            $weightArray = explode(';', $weight);
            $this->db->where("`user_data`.`weight` >= '" . $weightArray[0] . "'");
            $this->db->where("`user_data`.`weight` <= '" . $weightArray[1] . "'");
        }
		if ($body_type != 'Any')
        {
            $this->db->where("`user_data`.`body_type` = '" . $body_type . "'");
        }
		
		
		if($appearance != 'Any')
		{
			$this->db->where("`user_data`.`appearance` = '".$appearance."'");
		}
		
		if($relationship_your_looking_for != 'Any')
		{
			$this->db->where("`user_data`.`relationship_your_looking_for` = '".$relationship_your_looking_for."'");
		}
      		
        $this->db->where("`users`.`active` = '1'"); 
        $query = $this->db->get(); 
		//echo $this->db->last_query();
		$existing_data = $query->result_array();
		// print_r($existing_data);die;
        return $existing_data;
    }*/
	
	
	
	public function donate_user($user_id)
	{ 
		$this->db->select('user_id');      
		$this->db->where('user_id', $user_id);    
        $query = $this->db->get('message_donation');    
		$rows = $query->num_rows();   
		if($rows > 0) 
		{ 
			$result = $query->result(); 
			return $rows;   
		}else{    
			return false; 
		} 
	}  
    
	/**** Function for admin ends***/
	
	public function login_user()
	{
		if(isset($this->session->userdata['user_id']))
		{
			//$current_user = '';
			$current_user = $this->session->userdata['user_id'];
			$this->db->select('*');
			$this->db->where("login_status" , '1');
			$this->db->where('users' . '.' . 'id'.' !=', $current_user);
			
			$query = $this->db->get('users');
			return $existing_data['data'] = $query->result_array();
		}
	}
	
	public function get_profile_pic($id)
    {
        $query = $this->db->query("
			SELECT  `name`
			FROM `profile_pics`
			WHERE `user_id`='" .$id. " 'AND `active`= 1
			");
			
        $profile = $query->result_array();
		if (isset($profile[0]['name']))
        {
			return $profile[0]['name'];
        }else
        {
            return false;
        }
    }
	
	public function get_success_story()
	{
		// select success stories
		$this->db->select('*');
		$this->db->order_by('created_date ', 'desc');     
		$query = $this->db->get('success_story');    
		return $existing_data['data'] = $query->result_array();     
	}
	
	/**
     *  get newest member
     *
     * @param string newest date `created_on` of the member to find
     * @return $firstname, $lastname of member   
     */
    function get_newest_member_list()
    {
       $query = $this->db->query("
			SELECT 
			`u`.`id` , 
			`u`.`first_name` , 
			`u`.`last_name` , 
			`u`.`email` , 
			`ud`.`looking_for` , 
			`ud`.`state_province` , 
			`ud`.`city` ,
			`ud`.`country` , 
			`ud`.`gender` , 
			`mc`.`im_seeking_a` , 
			`mc`.`age_between` , 
			`u`.`active`,
			 YEAR(CURDATE( ) ) - YEAR(`ud`.`dob`) AS `age` , 
			`ud`.`dob` , 
			`up`.`profile_head`
			
			FROM `users` AS `u`
			INNER JOIN `user_data` AS `ud` ON `u`.`id` = `ud`.`user_id`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			
			WHERE `u`.`active` = '1'
			GROUP BY u.id 
			ORDER BY u.id DESC 
			");
		//`ppic`.`name` 
		//INNER JOIN `profile_pics` AS `ppic` ON `u`.`id` = `ppic`.`user_id`
		
		$rows = $query->result();
		$usersArray = array();
			foreach ($rows as $row) 
			{
                $data = array(
					"id" => $row->id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
					'gender' => $row->gender,
					"looking_for" => $row->looking_for,
                    "email" => $row->email,
                    "state_province" => $this->get_state_name($row->state_province),
                    //"city" => $row->city,
                    "city" => $this->get_city_name($row->city),
					"country" => $row->country,
                    "im_seeking_a" => $row->im_seeking_a,
                    "age_between" => $row->age_between,
                    "age" => $row->age,
                    "profile_head" => $row->profile_head,
                    "send_heart" => $this->count_send_heart($row->id),
					"like" => $this->count_send_like($row->id),
					"favourite" => $this->count_add_fav($row->id),
					"block_user_id" => $this->mail_model->get_block_user_data($row->id),
					"warning_message" => $this->count_warnings($row->id)
                    
                );
		$usersArray[] = $data;
		}
		return $usersArray;
	}
	
	//get state name by id
	function get_state_name($state_id)
	{
		$this->db->select('region_name');
		$this->db->where('region_id',$state_id);
		$query = $this->db->get('regions');
		
		if($query->num_rows() > 0)
        {
            $states = array();
            if($query->result())
            {
                foreach($query->result() as $state)
                {
                    $states = $state->region_name;
                }
                return $states;
            }
		}
		else
            {
                return $state_id;
            }
	}
	
	//get city name by id
	function get_city_name($city_id)
	{
		$this->db->select('city_name');
		$this->db->where('city_id',$city_id);
		$query = $this->db->get('cities');
		if($query->num_rows() > 0)
        {
            $city = array();   
            if($query->result())
            {
                foreach($query->result() as $city)
                {
                    $city = $city->city_name;
                }
                return $city;
            }
		}
		else
            {
                return $city_id;
            }
	}
	
	function add($data)
	{
		$data['date'] = date('Y-m-d H:i:s');
        $query = $this->db->insert('send_heart', $data);
		return 'New data saved';
	}
	
	function add_warning($data) 
	{
		$data['date'] = date('Y-m-d H:i:s');
		$query = $this->db->insert('send_warning_message', $data);
		return true;
	}
	
	function count_send_heart($id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			$this->db->where('user_id_sender',$this->session->userdata['user_id']);
			$this->db->group_by('user_id_receiver');
			$query = $this->db->get('send_heart'); 
			return $query->num_rows();
		}
	}
	
	function count_heart($id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			//$this->db->where('user_id_sender',$this->session->userdata['user_id']);
			$this->db->group_by('user_id_receiver');
			$query = $this->db->get('send_heart');
			return $query->num_rows();
		}
	}
	
	function like($receiver_id,$sender_id)
	{
		$data = array(
		'user_id_receiver' => $receiver_id,
		'user_id_sender' => $sender_id,
		'active' => '1',
		'date' => date('Y-m-d H:i:s'),
		);
		//$data['date'] = date('Y-m-d H:i:s');
        $query = $this->db->insert('send_like', $data);
        return 'New data saved';
	}
	
	function count_send_like($id)
	{
		//echo $id;
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			$this->db->where('user_id_sender',$this->session->userdata['user_id']);
			$this->db->where('active','1');
			$query = $this->db->get('send_like');
			//echo $this->db->last_query();
			//print_r($query->num_rows());
			//die;
			return $query->num_rows();
		}
	}
	
	function count_like($id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			$this->db->where('active','1');
			$query = $this->db->get('send_like');
			return $query->num_rows();
		}
	}
	
	function unlike($receiver_id,$sender_id)
	{
		$data = array(
		'active' => '1',
		);
		
		$this->db->where(array('user_id_receiver' => $receiver_id,'user_id_sender' => $sender_id));
        $query = $this->db->delete('send_like', $data);
      	return TRUE;
	}
	
	function count_warning_message($id)
	{
		$this->db->select('*');
		$this->db->where('user_id_receiver',$id);
		$query = $this->db->get('send_warning_message');
		
		return $query->num_rows();
	}
	
	function get_like_member_list($id)
	{
        //$this->db->join('users', 'user_data.user_id = users.id');
		$query = $this->db->query("
			SELECT `u`.`id` , `u`.`first_name` , `u`.`last_name` , `u`.`email` , `up`.`profile_head` , `si`.`user_id_receiver` , `si`.`active`
			FROM `users` AS `u`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `send_like` AS `si` ON `u`.`id` = `si`.`user_id_sender`
			WHERE `u`.`active` = '1'
			AND `si`.`user_id_receiver` = '".$id."'
			AND `si`.`active` = '1'
			GROUP BY u.id
			");
		$rows = $query->result();
		$usersArray = array();
			foreach ($rows as $row){
                $data = array(
					"id" => $row->id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" => $row->email,
                );
		$usersArray[] = $data;
		}
		return $usersArray;
	}
	
	function get_heart_member_list($id)
	{
		$query = $this->db->query("
			SELECT `u`.`id` , `u`.`first_name` , `u`.`last_name` , `u`.`email` , `up`.`profile_head` , `sh`.`user_id_receiver` 
			FROM `users` AS `u`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `send_heart` AS `sh` ON `u`.`id` = `sh`.`user_id_sender`
			WHERE `u`.`active` = '1'
			AND `sh`.`user_id_receiver` = '".$id."'
			GROUP BY u.id
			");
		$rows = $query->result();
		$usersArray = array();
			foreach ($rows as $row)
			{
                $data = array(
					"id" => $row->id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" => $row->email,
                );
				$usersArray[] = $data;
			}
		return $usersArray;
	}
	
	// Add to favorite
	function favorite($receiver_id,$sender_id)
	{
		$data = array(
		'user_id_receiver' => $receiver_id,
		'user_id_sender' => $sender_id,
		'active' => '1',
		'date' => date('Y-m-d H:i:s'),
		);
		$query = $this->db->insert('send_favourite', $data);
		return TRUE;
	}
	
	//get favourite people list
	function fav_member_list($id)
	{
		$query = $this->db->query("
			SELECT `u`.`id` , `u`.`first_name` , `u`.`last_name` , `u`.`email` , `up`.`profile_head` , `sf`.`user_id_receiver` 
			FROM `users` AS `u`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `send_favourite` AS `sf` ON `u`.`id` = `sf`.`user_id_sender`
			WHERE `u`.`active` = '1'
			AND `sf`.`user_id_receiver` = '".$id."'
			
			GROUP BY u.id
			");
		$rows = $query->result();
		$usersArray = array();
			foreach ($rows as $row)
			{
			    $data = array(
					"id" => $row->id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" => $row->email,
                );
				$usersArray[] = $data;
			}
		return $usersArray;
	}
	
	//get warning message
	/*function warning_message_list($id)
	{
		$query = $this->db->query("
			SELECT `u`.`id` , `u`.`first_name` , `u`.`last_name` , `u`.`email` , `up`.`profile_head` , `swmsg`.`user_id_receiver` ,`swmsg`.`message`
			FROM `users` AS `u`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `send_warning_message` AS `swmsg` ON `u`.`id` = `swmsg`.`user_id_sender`
			WHERE `u`.`active` = '1'
			AND `swmsg`.`user_id_receiver` = '".$id."'
			
			GROUP BY u.id
			");
		$rows = $query->result();
		$usersArray = array();
			foreach ($rows as $row){
				
                $data = array(
					"id" => $row->id,
                    "first_name" => $row->first_name,
                    "last_name" => $row->last_name,
                    "email" => $row->email,
					"message" => $row->message
                );
		$usersArray[] = $data;
		}
		return $usersArray;
	}*/
	
	//get warning message
	function warning_message_list($id)
	{
		$query = $this->db->query("
			SELECT `u`.`id` , `u`.`first_name` , `u`.`last_name` , `u`.`email` , `up`.`profile_head` , `swmsg`.`user_id_receiver` ,`swmsg`.`message`
			FROM `users` AS `u`
			INNER JOIN `user_profile` AS `up` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `match_criteria` AS `mc` ON `u`.`id` = `up`.`user_id`
			INNER JOIN `send_warning_message` AS `swmsg` ON `u`.`id` = `swmsg`.`user_id_sender`
			WHERE `u`.`active` = '1'
			AND `swmsg`.`user_id_receiver` = '".$id."'
			
			GROUP BY u.id
			");
		$rows = $query->num_rows();
		return $rows;
	}

	/**** Function for admin start***/           

    public function warning_message_list_data($searchs = array(), $sort = array(), $from = 0, $num_result = 10,$id)
    {
	
        //Get total Row        
        $result['totalRows'] = $this->totat_count($searchs);
		$this->db->select('u'.'.*', FALSE); 
       	
		 $is_array = true;
		
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
		
		$this->db->select('swmsg'.'.*', FALSE);
		$this->db->from('users AS `u`');
		$this->db->join('`user_profile` AS `up`', 'u'.'.id = '.'up'.'.user_id', 'left'); 
		$this->db->join('`match_criteria` AS `mc`', 'u'.'.id = '.'up'.'.user_id', 'left'); 
        $this->db->join('send_warning_message AS swmsg' ,'u'.'.id = '.'swmsg'.'.user_id_sender','left'); 
		$this->db->where('u'.'.active = 1');
		$this->db->where('swmsg'.'.user_id_receiver = '.$id);
		$this->db->group_by('u'.'.id');
		
		//$this->db->order_by('u' . '.id', 'desc');       
        $query = $this->db->get();
		
		if ($is_array == true)
        {
            $result['data'] = $query->result_array();
            return $result;
        }
		return $result['data'] = $query->result();
    }
	
	function count_add_fav($id)
	{
		if(isset($this->session->userdata['user_id']))
		{
			$this->db->select('*');
			$this->db->where('user_id_receiver',$id);
			$this->db->where('user_id_sender',$this->session->userdata['user_id']);
			$this->db->where('active','1');
			$query = $this->db->get('send_favourite');
			return $query->num_rows();
		}
	}
	
	function get_block_user_data()
	{
		$query = $this->db->query("SELECT `block_user_id` FROM `block_user` WHERE `user_id_sender`= '".$this->session->userdata['user_id']."'");
		
		# Use any one query from the above!
		if($query->num_rows() > 0)
		{
			$result = $query->result_array();
			foreach($result as $row)
			{
				 $fieldArray[] = "" . $row['block_user_id'] . "";
			}
			$fields = implode(',', $fieldArray);
			$query = $this->db->query('SELECT `id` , `first_name` , `last_name` FROM (`users`) WHERE `id`  IN ('.$fields.') '); 
			$existing_data = $query->result_array();
			return $existing_data;
		}
	}
	
	function profile_complete()
	{
		$this->db->select('*')->from('user_data');
		$this->db->join('user_profile','user_profile.user_id = user_data.user_id');
		$this->db->where('user_data.user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->result();
		$maximumPoints  = 100;
		$point = 0;
		
		foreach($result as $row)
		{
			//Match (Your Appearance , Lifestyle)(1)
			if($row->height != '' AND $row->weight != '' AND $row->body_type != '' AND $row->ethnicity != ''  AND $row->nationality != '' AND $row->education != '' AND $row->english_ability != ''  AND $row->vietnamese_ability != '')
			{
				$point+=14;
			}
			
			//profile pic (2)
			
			//Profile  Your Background / Cultural Values + In your own words(3)
			if($row->chinese_sign != '' AND $row->hair_color != '' AND $row->eye_color != '' AND $row->star_sign != '' AND $row->profile_head != '' AND $row->about_yourself != ''  AND $row->profile_head != ''   AND $row->drink != '' AND $row->smoke != '' AND $row->religion != '' AND $row->marital_status != '' AND $row->have_children != '' AND $row->occupation != '' AND $row->willing_to_relocate != '' AND $row->relationship_your_looking_for != '' AND $row->living_situation != '' AND $row->incomeperyear != '' AND $row->workingstatus != '' )
			{
				$point+=14;
			}
			
			// Profile verify country,state and city  part 1(5)
			/*if($row->country != '' AND $row->state_province != '' AND $row->city != '' AND $row->phone != '' AND $row->address != '' AND $row->zip_code != '' )
			{	
				$point+=7; //part-1
			}*/
		}
		
		$point += $this->get_profileverify_submitted_ids(); // part2 get_submitted_ids
		$point += $this->get_user_interest(); // get interest completeness(4)
		$point += $this->get_questions_comp(); //get Questions completeness(7)
		$point += $this->get_personality_comp(); //get personality completeness(6)
		//$percentage = ($point*$maximumPoints)/100;
		//return $percentage;
		return $point;
	}
	
	//get submitted id entries
    function get_profileverify_submitted_ids()
    {
		
		$point = 0;
		$this->db->select('*')
			 ->from('submitted_id')
			 ->join('user_data','submitted_id.user_id = user_data.user_id')
		 	 ->where('submitted_id.user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->result();
		
		// Profile verify country,state and city  part 1(5)
			/*if($row->country != '' AND $row->state_province != '' AND $row->city != '' AND $row->phone != '' AND $row->address != '' AND $row->zip_code != '' )
			{	
				$point+=7; //part-1
			}*/
		
			foreach($result as $row)
			{
				if($row->name != '' AND $row->country != '' AND $row->state_province != '' AND $row->city != '' AND $row->phone != '' AND $row->address != '' AND $row->zip_code != '')
				{
					$point = 14;
				}
			return $point;
			}
	}
	
	//get match  entries
    function get_match_comp()
    {
		$this->db->select('*')->from('user_data');
		$this->db->join('user_profile','user_profile.user_id = user_data.user_id');
		$this->db->where('user_data.user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->result();
		$point = 0;
		
		foreach($result as $row)
		{
			//Match (Your Appearance , Lifestyle)(1)
			if($row->height != '' AND $row->weight != '' AND $row->body_type != '' AND $row->ethnicity != ''  AND $row->nationality != '' AND $row->education != '' AND $row->english_ability != ''  AND $row->vietnamese_ability != '')
			{
				$point+=14;
			}
			
			return $point;
		}
	}
	
	//get profile  entries
    function get_profile_comp()
    {
		$this->db->select('*')->from('user_data');
		$this->db->join('user_profile','user_profile.user_id = user_data.user_id');
		$this->db->where('user_data.user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->result();
		$point = 0;
		
		foreach($result as $row)
		{
			//Profile (2)
			if($row->chinese_sign != '' AND $row->hair_color != '' AND $row->eye_color != '' AND $row->star_sign != '' AND $row->profile_head != '' AND $row->about_yourself != ''  AND $row->profile_head != ''   AND $row->drink != '' AND $row->smoke != '' AND $row->religion != '' AND $row->marital_status != '' AND $row->have_children != '' AND $row->occupation != '' AND $row->willing_to_relocate != '' AND $row->relationship_your_looking_for != '' AND $row->living_situation != '' AND $row->incomeperyear != '' AND $row->workingstatus != '' )
			{
				$point+=14;
			}
			
			return $point;
		}
	}
	
	
	public function login_status($login_status)
	{	
		$exist = $this->check_login_status();
		print_r($exist);die;
		if($exist<0)
		{
			$this->db->where('user_id',$this->session->userdata['user_id']);
			if($login_status == 'Available')
			{
				$this->db->update('login_status',array('Available'=>'1','Busy'=>'0','Invisible'=>'0'));
			}
			if($login_status == 'Busy')
			{
				$this->db->update('login_status',array('Busy'=>'1','Available'=>'0','Invisible'=>'0'));
			}
			if($login_status == 'Invisible')
			{
				$this->db->update('login_status',array('Invisible'=>'1','Busy'=>'0','Available'=>'0'));
			}
			return true;
		}
	}
	
	
	
	public function get_login_status()
	{
		$this->db->select('*')->from('login_status');
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		//return $query->num_rows();
		$res = $query->result_array();
		//print_r($res[0]);die;
		return $res; 
		//return $query->result_array();
	}
	
	public function get_login_busystatus($id)
	{
		$this->db->select('busy')->from('login_status');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		$profile = $query->result_array();
		if (isset($profile[0]['busy']))
        {
			return $profile[0]['busy'];
        }else
        {
            return false;
        }
	}
	
	public function get_login_availablestatus($id)
	{
		$this->db->select('available')->from('login_status');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		$profile = $query->result_array();
		if (isset($profile[0]['available']))
        {
			return $profile[0]['available'];
        }else
        {
            return false;
        }
	}
	
	public function get_login_invisiblestatus($id)
	{
		$this->db->select('invisible')->from('login_status');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		$profile = $query->result_array();
		if (isset($profile[0]['invisible']))
        {
			return $profile[0]['invisible'];
        }else
        {
            return false;
        }
	}
	
	public function get_user_interest()
    {
		$point = 0;
        $query = $this->db->query("
			SELECT  *
			FROM `user_interest`
			WHERE `user_id`='" .$this->session->userdata['user_id']. " '
			");
			
        $profile = $query->result();
			foreach($profile as $row)
			{
				if($row->hobbies != '' AND $row->food != '')
				{
					$point = 14;
				}
			}
			return $point;
    }
	
	public function get_questions_comp()
	{
		$point = 0;
		$this->db->select('*')
			 ->from('profile_questions')
		 	 ->where('user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->num_rows();
			if($result == '60')
			{
				$point = 14;
			}
		return $point;
	}
	
	//get personality detail
	public function get_personality_comp()
	{
		$point = 0;
		$this->db->select('*')
			 ->from('profile_personality')
		 	 ->where('user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row)
		{
			if($row->fav_movie != '' AND $row->fav_book != '' AND $row->food_you_like != '' AND $row->music_you_like != '' AND $row->your_hobies != '' AND $row->describe_your_dress != '' AND $row->describe_your_sense != '' AND $row->describe_your_personality != '' AND $row->you_travelled != '' AND $row->adaptive_are_you != '')
			{
				$point = 16;
			}
		return $point;
		}
	}
	
	
	//get data for profile verify               
    public function get_profile_personalitydetail()
    {
		$exist = $this->find_profile_personality($this->session->userdata['user_id']);
		if($exist)
		{
			$this->db->select('*');
			$this->db->from('profile_personality');
			$this->db->where('user_id',$this->session->userdata['user_id']);
			$query = $this->db->get();
			$existing_data = $query->result_array();
			return $existing_data[0];
    	}
	}
	
	//get advance search donation user detail
	public function get_advcsr_don_user()
	{
		$this->db->select('*')->from('advancesearch_donation');
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$result = $query->num_rows();
		return $result;
		
	}
	
	//get looking for
	public function get_looking_for()
	{
		$this->db->select('looking_for')->from('user_data');
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$query   = $this->db->get();
		$result  = $query->result_array();
		return $result[0]['looking_for'];
		
	}
	
	//move function
	public function move_function()
    {
		$this->db->select('*');
		$this->db->from('profile_personality');
		$this->db->where('user_id',$this->session->userdata['user_id']);
		$query = $this->db->get();
		$existing_data = $query->result_array();
		return $existing_data[0];
    	
	}
	// end move function
	
	public function advancesearch($data)
    {
		//print_r($data);die;
		$this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
		
		//$this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $data['min_age'] . ' AND ' . $data['max_age']);
		
        /*if (isset($age[0]) && isset($age[1]) && !empty($age[0]) && !empty($age[1]))
            $this->db->or_where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $age[0] . ' AND ' . $age[1]);
*/
        //$this->db->where("`user_data`.`gender` = '" . substr($data['looking_for'], 0, 1) . "'");
        
        if ($data['nationality'] != 'any')
        {
            $this->db->where("`user_data`.`nationality` = '" . $data['nationality'] . "'");
        }
        if ($data['education'] != 'any')
        {
            $this->db->where("`user_data`.`education` = '" . $data['education'] . "'");
        }
        if ($data['english_ability'] != 'any')
        {
            $this->db->where("`user_data`.`english_ability` = '" . $data['english_ability'] . "'");
        }
		if ($data['religion'] != 'any')
        {
            $this->db->where("`user_data`.`religion` = '" . $data['religion'] . "'");
        }
		if ($data['living_situation'] != 'any')//
        {
            $this->db->where("`user_data`.`living_situation` = '" . $data['living_situation'] . "'");
        }
		if ($data['incomeperyear'] != 'any')//
        {
            $this->db->where("`user_data`.`incomeperyear` = '" . $data['incomeperyear'] . "'");
        }
		if ($data['workingstatus'] != 'any')
        {
            $this->db->where("`user_data`.`workingstatus` = '" . $data['workingstatus'] . "'");
        }
		if ($data['hair_color'] != 'any')
        {
            $this->db->where("`user_data`.`hair_color` = '" . $data['hair_color'] . "'");
        }
		if ($data['eye_color'] != 'any')
        {
            $this->db->where("`user_data`.`eye_color` = '" . $data['eye_color'] . "'");
        }
		if ($data['height'] != 'any')
        {
            $heightArray = explode(';', $data['height']);

            $this->db->where("`user_data`.`height` >= '" . $heightArray[0] . "'");
            $this->db->where("`user_data`.`height` <= '" . $heightArray[1] . "'");
        }
        if ($data['weight'] != 'any')
        {
            $weightArray = explode(';', $data['weight']);
            $this->db->where("`user_data`.`weight` >= '" . $weightArray[0] . "'");
            $this->db->where("`user_data`.`weight` <= '" . $weightArray[1] . "'");
        }
		if ($data['body_type'] != 'Any')
        {
            $this->db->where("`user_data`.`body_type` = '" . $data['body_type'] . "'");
        }
		if($data['drink'] != 'any')
		{
			$this->db->where("`user_data`.`drink` = '".$data['drink']."'");
		}
		if($data['marital_status'] != 'any')
		{
			$this->db->where("`user_data`.`marital_status` = '".$data['marital_status']."'");
		}
		if($data['have_children'] != 'any')
		{
			$this->db->where("`user_data`.`have_children` = '".$data['have_children']."'");
		}
		if($data['occupation'] != 'any')
		{
			$this->db->where("`user_data`.`occupation` = '".$data['occupation']."'");
		}
		if($data['willing_to_relocate'] != 'any')
		{
			$this->db->where("`user_data`.`willing_to_relocate` = '".$data['willing_to_relocate']."'");
		}
		/*if($data['lookingfor_options'] != 'any')
		{
			$this->db->where("`user_data`.`relationship_your_looking_for` = '".$data['lookingfor_options']."'");
		}*/
		if($data['lookingfor'] != 'any' && $data['lookingfor'] != '')
		{
			$lookingfor = implode('|', $_POST['lookingfor']);
			$this->db->where("`user_data`.`relationship_your_looking_for` = '".$lookingfor."'");
		}
		if($data['smoke'] != 'any')
		{
			$this->db->where("`user_data`.`smoke` = '".$data['smoke']."'");
		}
		if($data['chinese_sign'] != 'any')
		{
			$this->db->where("`user_data`.`chinese_sign` = '".$data['chinese_sign']."'");
		}
		if($data['star_sign'] != 'Any')
		{
			$this->db->where("`user_data`.`star_sign` = '".$data['star_sign']."'");
		}
		if($data['cupsize'] != 'any' && $data['cupsize'] != '')
		{
			$this->db->where("`user_data`.`cupsize` = '".$data['cupsize']."'");
		}
		
      		
        $this->db->where("`users`.`active` = '1'"); 
        $query = $this->db->get(); 
		//echo $this->db->last_query();
		$existing_data = $query->result_array();
		//print_r($existing_data);die;
        return $existing_data;
    }
	
	
	public function getUsersBetweenAge($age_arr)
	{
	  foreach($age_arr as $key => $age) {
	   $min_max_age = explode('-', $age);
	   $min_age = $min_max_age[0];
	   $max_age = $min_max_age[1];
	
	   //$this->db->select('*');
	   //$this->db->from('user_data');
	   $this->db->select('users.*, user_data.*');
	   $this->db->join('user_data', 'user_data.user_id = users.id');
	   $this->db->where('users.login_status', 1);
	   $this->db->where('users.id !=', $this->session->userdata['user_id']);
	   $this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $min_age . ' AND ' . $max_age);
	   $query = $this->db->get('users');
	
	   $users_count = $query->num_rows();
	
	   $age_array[$key]['age'] = $age;
	   $age_array[$key]['users_count'] = $users_count;
	  }
	  return $age_array;
	 }

	public function getOnlineUsersCount() 
	 {
	  $this->db->select('users.*, user_data.*');
	  $this->db->join('user_data', 'user_data.user_id = users.id');
	  $this->db->where('users.login_status', 1);
	  $this->db->where('users.id !=', $this->session->userdata['user_id']);
	  $this->db->where('user_data.gender', 'm');
	  $query1 = $this->db->get('users');
	
	  $online_users_arr['male_count'] = $query1->num_rows();
	
	  $this->db->select('users.*, user_data.*');
	  $this->db->join('user_data', 'user_data.user_id = users.id');
	  $this->db->where('users.login_status', 1);
	  $this->db->where('users.id !=', $this->session->userdata['user_id']);
	  $this->db->where('user_data.gender', 'f');
	  $query2 = $this->db->get('users');
	
	  $online_users_arr['female_count'] = $query2->num_rows();
	
	  return $online_users_arr;
	 }

	public function getOnlineUsers($data) 
	{
	  $this->db->select('users.*, user_data.*');
	  $this->db->join('user_data', 'user_data.user_id = users.id');
	
	  $this->db->where('users.login_status', 1);
	  $this->db->where('users.id !=', $this->session->userdata['user_id']);
	
	  if($data['interest'] != '') {
	   if($data['interest'] == 'm') {
		$this->db->join('send_like', 'send_like.user_id_receiver = user_data.user_id');
		$this->db->where('user_id_receiver', $this->session->userdata('user_id'));
	   } else if($data['interest'] == 'f') {
		$this->db->join('send_like', 'send_like.user_id_sender = user_data.user_id');
		$this->db->where('user_id_sender', $this->session->userdata('user_id'));
	   }
	  }
	
	  if($data['gender'] != '') {
	   $this->db->where('user_data.gender', $data['gender']);
	  }
	
	  if($data['age'] != '' && $data['age'] != 0) {
	   $age = $data['age'];
	
	   //$age = floor((time() - strtotime($birth_date))/31556926);
	   //$year = date('Y', strtotime($age.'years ago'));
	   //$from_date = "$year-01-01";
	   //$to_date = "$year-12-31";
	   //$this->db->where("user_data.dob BETWEEN '$from_date' AND '$to_date'");
	
	   $min_max_age = explode('-', $age);
	   $min_age = $min_max_age[0];
	   $max_age = $min_max_age[1];
	
	   $this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $min_age . ' AND ' . $max_age);
	  }
	
	  if($data['country'] != '') {
	   $this->db->where('user_data.country', $data['country']);
	  }
	
	  if($data['state_province'] != '') {
	   $this->db->where('user_data.state_province', $data['state_province']);
	  }
	
	  if($data['city'] != '') {
	   $this->db->where('user_data.city', $data['city']);
	  }
	
	  return $this->db->get('users')->result_array();
	 }
	 
	 //distance search
	 public function distance_search($criteria = array())    
    {      
		//print_r($criteria);die;
        $this->db->select('*');
        $this->db->from('user_data');
        $this->db->join('users', 'user_data.user_id = users.id');
		//$this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);
       
        $this->db->where("`user_data`.`gender` = '" . substr($criteria['looking_for'], 0, 1) . "'");
        $this->db->where("`users`.`active` = '1'");    
		//$this->db->or_where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);
		$this->db->where('YEAR(CURDATE())-YEAR(user_data.dob) BETWEEN ' . $criteria['min_age'] . ' AND ' . $criteria['max_age']);

        if (isset($criteria['have_pic']) && $criteria['have_pic'] != FALSE)
        {   
            $this->db->join('profile_pics', 'profile_pics.user_id = user_data.user_id');
            $this->db->where("`profile_pics`.`active` = '1'");
        }

        /*if (isset($criteria['country']) && !empty($criteria['country']))
        {
            $this->db->where("`user_data`.`country` = '" . $criteria['country'] . "'");
        }
        
		if (isset($criteria['state_province']) && !empty($criteria['state_province']))  
        {
            $this->db->where("`user_data`.`state_province` = '" . $criteria['state_province'] . "'");
        }
		
		if(isset($criteria['city']) && !empty($criteria['city']))
		{
			$this->db->where("`user_data`.`city` = '".$criteria['city']."'");
		}
*/
        $query = $this->db->get();  
		//echo $this->db->last_query();
		$existing_data = $query->result_array();
		//echo "<pre>";print_r($existing_data);die;
		return $existing_data;
    }

	 
	 //end distance search

	public function gedtAllTabsData($id) {
		$this->db->select('users.*, user_data.*, user_interest.*');
		$this->db->join('user_data', 'user_data.user_id = users.id');
		$this->db->join('user_interest', 'user_interest.user_id = users.id');
		$this->db->where('users.id', $id);
		$about_data = $this->db->get('users');
		$allTabsDataArr['about_data'] = $about_data->row();

		$allTabsDataArr['about_data']->hobbies = explode('|', $allTabsDataArr['about_data']->hobbies);

		$this->db->select('*');
		$this->db->where('user_id', $id);
		$favorites = $this->db->get('profile_personality');
		$favorites = $favorites->row();

		if(!empty($favorites)) {
			$allTabsDataArr['user_data']['favorites'] = $favorites;
		}

		$this->db->select('*');
		$this->db->where('user_id', $this->session->userdata['user_id']);
		$interest = $this->db->get('user_interest');
		$interest = $interest->row();

		if(!empty($interest)) {
			//$entertainment_arr = explode('|', $interest->entertainment);
			//$music_arr = explode('|', $interest->music);
			$food_arr = explode('|', $interest->food);
			//$sports_arr = explode('|', $interest->sports);

			//$allTabsDataArr['users'][$key]['entertainment'] = $entertainment_arr;
			//$allTabsDataArr['users'][$key]['music'] = $music_arr;
			$allTabsDataArr['user_data']['food'] = $food_arr;
			//$allTabsDataArr['users'][$key]['sports'] = $sports_arr;
		}

		//echo "<pre>"; print_r($allTabsDataArr);
		return $allTabsDataArr;
	}


}