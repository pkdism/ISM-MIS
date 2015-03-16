<?php

class Modules_model extends CI_Model
{

	var $table = 'modules';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function getModules()
	{
		$query=$this->db->get($this->table);
		return $query->result();
	}
}

/* End of file modules_model.php */
/* Location: mis/application/models/modules_model.php */