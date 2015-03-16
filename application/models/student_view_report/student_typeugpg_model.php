<?php

class Student_typeugpg_model extends CI_Model
{
	var $table = 'stu_type';

	function __construct()
	{
		parent::__construct();
	}

	
	function getTypeById($id = '')
	{
		
		$query = $this->db->get_where($this->table,array('id'=>$id));
		if($query->num_rows() === 1)
			return $query->row();
		else
			return false;
	}
}

?>