<?php

class Search_edit_circular_model extends CI_Model
{

	var $table = 'info_circular_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_circular_ids()
	{
		$this->db->select('circular_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular circular id
	function get_circular_row($circular_id)
	{
		$this->db->where('circular_id',$circular_id);
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
				$this->db->insert('info_circular_archieve_details',$row);
				$this->db->delete($this->table,$row);
		}
	}
}

/* End of file search_edit_circular_model.php */
/* Location: mis/application/models/search_edit_circular_model.php */