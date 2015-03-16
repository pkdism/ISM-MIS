<?php

class User_auth_types_model extends CI_Model
{

	var $table = 'user_auth_types';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function delete($data)
	{
		$this->db->delete($this->table,$data);
	}

	function getUserIdByAuthId($auth_id = '')
	{
		$query=$this->db->where('auth_id',$auth_id)->get($this->table);
		return $query->result();
	}
}

/* End of file user_auth_types_model.php */
/* Location: mis/application/models/user_auth_types_model.php */