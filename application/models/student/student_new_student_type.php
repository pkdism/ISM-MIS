<?php

class Student_new_student_type extends CI_Model
{
	var $table = 'stu_new_student_type';

	function __construct()
	{
		parent::__construct();
	}

	function get_new_id()
	{
		$query = $this->db->get($this->table);
		foreach($query->result() as $row)
		{
			return 'typ_'.($row->count + 1);
		}
	}

	function update()
	{
		$query = $this->db->get($this->table);
		foreach($query->result() as $row)
		{
			$count = $row->count+1;
			break;
		}
		$this->db->empty_table($this->table);
		$data = array(
			'count' => $count
		);
		$this->db->insert($this->table,$data);
	}
}

?>