<?php

class Auth_types_model extends CI_Model
{

	var $table = 'auth_types';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table, $data);
	}

	function getAuthTypeById($id)
	{
		$query = $this->db->where('id', $id)->get($this->table);
		return $query->row()->type;
	}

	function getAllAuths()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}
}

/* End of file auth_types_model.php */
/* Location: mis/application/models/auth_types_model.php */