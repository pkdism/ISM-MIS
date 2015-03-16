<?php

class Emp_current_entry_model extends CI_Model
{
	var $table = 'emp_current_entry';

	function __construct()
	{
		// Call the Model constructor
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

	function insert($data)
	{
    	$this->db->insert($this->table, $data);
	}

	function update($data, $where)
	{
		$this->db->update($this->table,$data,$where);
	}

	function delete($where)
	{
		$this->db->delete($this->table,$where);
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */