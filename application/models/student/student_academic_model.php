<?php

Class Student_academic_model extends CI_Model
{
	var $table = 'stu_academic';

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

	function pending_insert($data)
	{
		if($this->db->insert('pending_'.$this->table,$data))
			return TRUE;
		else
			return FALSE;
	}

	function get_stu_academic_details_by_id($stu_id = '')
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

	function get_pending_stu_academic_details_by_id($stu_id = '')
	{
		if($stu_id != '')
		{
			$query = $this->db->where('id="'.$stu_id.'"','',FALSE)->get('pending_'.$this->table);
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}

	function update_by_id($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id));
	}

	function deletePendingDetailsWhere($data)
	{
		$this->db->delete('pending_'.$this->table,$data);
	}
}

?>