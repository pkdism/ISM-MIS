<?php

class Deo_modules_model extends CI_Model
{

	var $table = 'deo_modules';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function getDeoByModuleId($module_id = '')
	{
		$query=$this->db->where('module_id',$module_id)->get($this->table);
		return $query->result();
	}
}

/* End of file deo_modules_model.php */
/* Location: mis/application/models/deo_modules_model.php */