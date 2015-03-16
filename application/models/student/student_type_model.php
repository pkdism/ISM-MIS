<?php

class Student_type_model extends CI_Model
{
	var $table = 'stu_type';

	function __construct()
	{
		parent::__construct();
	}

	function get_all_types()
	{
		$query = $this->db->get($this->table);
		return $query->result();
	}

	function insert($data)
	{
		if($data)
			$this->db->insert($this->table,$data);
	}
}

?>