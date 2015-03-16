<?php

Class Student_details_model extends CI_Model
{
	var $table = 'stu_details';

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

	function get_all_student_id()
	{
		$query = $this->db->select('admn_no')->order_by('admn_no')->get($this->table);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	function get_student_type_a_student($student = '')
	{
		$this->db->select('type')->where('admn_no',$student);
		$query = $this->db->get($this->table);
		foreach($query->result() as $row)
			return $row->type;
	}

	function get_student_details_by_id($stu_id = '')
	{
		if($stu_id != '')
		{
			$query = $this->db->where('admn_no="'.$stu_id.'"','',FALSE)->get($this->table);
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
		$this->db->update($this->table,$data,array('admn_no'=>$id));
	}
}

?>