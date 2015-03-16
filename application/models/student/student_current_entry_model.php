<?php

class Student_current_entry_model extends CI_Model
{
	var $table = 'stu_current_entry';

	function __construct()
	{
		parent::__construct();
	}

	function get_current_entry()
	{
		$query = $this->db->get($this->table);
		if($query->num_rows() === 1)
			return $query->row();
		else
			return FALSE;
	}

	function get_current_entry_status_by_id($id)
	{
		$query = $this->db->where("id",$id)->get($this->table);
		if($query->num_rows() === 1)
			return $query->row();
		else
			return FALSE;
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function delete($where)
	{
		$this->db->empty_table($this->table);
	}
}