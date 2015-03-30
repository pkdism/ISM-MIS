<?php

class Student_status_details_model extends CI_Model
{
	var $table = 'stu_id_status_details';

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

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function getUserById($id = '')
	{
		$query = $this->db->get_where($this->table,array('id'=>$id));
		if($query->num_rows() === 1)
			return $query->row();
		else
			return false;
	}

	function updateById($data,$id)
	{
		if($this->db->update($this->table,$data,array('id'=>$id)))
			return true;
		else
			return false;
	}

	function deleteDetailsWhere($data)
	{
		$this->db->delete($this->table,$data);
	}
}