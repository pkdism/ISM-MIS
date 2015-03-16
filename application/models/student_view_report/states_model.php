<?php

class States_model extends CI_Model
{
	var $table = 'states';

	function __construct()
	{
		parent::__construct();
	}

	function get_all_states()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}
}

?>