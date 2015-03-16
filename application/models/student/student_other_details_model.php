<?php

Class Student_other_details_model extends CI_Model
{
	var $table = 'stu_other_details';

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

	function get_student_other_details_by_id($stu_id = '')
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

	function update_by_id($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id));
	}
}

?>