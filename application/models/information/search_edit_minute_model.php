<?php

class Search_edit_minute_model extends CI_Model
{

	var $table = 'info_minute_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_minute_ids()
	{
		$this->db->select('minutes_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular minute number
	function get_minute_row($minute_id)
	{
		$this->db->where('minutes_id',$minute_id);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function remove()
	{
		$this->db->where('valid_upto <',date("Y-m-d"));
		$query = $this->db->get($this->table);
		$query_result = $query->result_array();
		
		foreach ($query_result as $row)
		{
				$this->db->insert('info_minute_archieve_details',$row);
				$this->db->delete($this->table,$row);
		}
	}
}

/* End of file search_edit_minute_model.php */
/* Location: mis/application/models/search_edit_minute_model.php */