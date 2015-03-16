<?php

Class Branches_model extends CI_Model
{
	var $table = 'branches';

	function __construct()
	{
		parent::__construct();
	}

	function get_branches_by_department($dept_id = '')
	{
		$this->db->select('id, name')
				 ->where('dept_id="'.$dept_id.'"','',FALSE);
		$query = $this->db->get($this->table);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}

	function get_branches_by_courses($course = '', $dept = '')
	{
		$command = 'SELECT * FROM branches INNER JOIN (SELECT branch_id FROM (SELECT * FROM course_branch WHERE course_id = "'.$course.'") as temp_table_1 INNER JOIN (SELECT aggr_id FROM dept_course WHERE dept_id="'.$dept.'") as temp_table_2 ON temp_table_1.aggr_id = temp_table_2.aggr_id) as temp_table_3 ON temp_table_3.branch_id = branches.id';
		$query = $this->db->query($command);
		if($query->num_rows() > 0)
			return $query->result();
		else
			return FALSE;
	}
}

?>