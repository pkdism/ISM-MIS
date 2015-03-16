<?php

class Search_edit_notice_model extends CI_Model
{

	var $table = 'info_notice_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_notice_ids()
	{
		$this->db->select('notice_id');
		$this->db->where('issued_by', $this->session->userdata('id'));
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	//return a row for a particular notice id
	function get_notice_row($notice_id)
	{
		$this->db->where('notice_id',$notice_id);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function remove()
	{
		$this->db->where('last_date <',date("Y-m-d"));
		$query = $this->db->get($this->table);
		$query_result = $query->result_array();
		
		foreach ($query_result as $row)
		{
				$this->db->insert('info_notice_archieve_details',$row);
				$this->db->delete($this->table,$row);
		}
	}
}

/* End of file search_edit_notice_model.php */
/* Location: mis/application/models/search_edit_notice_model.php */