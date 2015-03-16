<?php

class Student_education_details_model extends CI_Model
{
	var $table = 'stu_education_details';

	function __construct()
	{
		parent::__construct();
	}

	function insert($data)
	{
		if($this->db->insert($this->table,$data))
			return TRUE;
		else
			return FALSE;
	}

	function insert_batch($data)
	{
		if($this->db->insert_batch($this->table,$data))
			return TRUE;
		else
			return FALSE;
	}

	function getStuEduById($id = '')
	{
		if($id != '')
		{
			$query = $this->db->where('id',$id)->get($this->table);
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
		}
		else
			return FALSE;
	}

	function delete_record($where_array)
	{
		$this->db->delete($this->table,$where_array);
	}

	function update_record($data,$where_array)
	{
		$this->db->update($this->table,$data,$where_array);
	}
}