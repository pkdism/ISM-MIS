<?php

class Indian_states_model extends CI_Model
{

	var $table = 'indian_states';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function getStates()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}
}

/* End of file indian_states_model.php */
/* Location: mis/application/models/indian_states_model.php */