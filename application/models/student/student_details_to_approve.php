<?php

class Student_details_to_approve extends CI_Model
{
	var $table = 'stu_details_to_approve';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		if($this->db->insert($this->table,$data))
			return true;
		else
			return false;
	}

	function get_all_stu_details()
	{
		$query = $this->db->order_by('id')->get($this->table);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	function get_all_stu_details_by_id($stu_id = '')
	{
		if($stu_id != '')
		{
			$query = $this->db->where('id="'.$stu_id.'"','',FALSE)->get($this->table);
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}

	function deleteDetailsWhere($data)
	{
		$this->db->delete($this->table,$data);
	}
}