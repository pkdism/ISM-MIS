<?php

class Edit_minute_model extends CI_Model
{

	var $table = 'info_minute_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function update($data)
	{
		$this->db->where('minutes_id',$data['minutes_id']);
		$this->db->update($this->table,$data);
	}
	
	function getMinutesByMinId($min_id)
	{
		$query=$this->db->where('minutes_id',$min_id)->get($this->table);
		if($query->num_rows()==0)	return FALSE;
		else	return $query->row();
	}
	
	function insertM($minute_id)
	{
		$table = 'info_minute_modification_details';
		$query = $this->db->where('minutes_id',$minute_id)->get($this->table);
		
		if($query->num_rows() == 0 ) return FALSE;
		else $ans = $query->row_array();
		
		$this->db->insert($table, $ans);
	}
	
	function get_minutes($authid)
	{
		
		$this->db->where('issued_by',$this->session->userdata('id'));
		$this->db->where('info_minute_details.auth_id',$authid);
		$query = $this->db->select("info_minute_details.*, user_details.*, auth_types.type as auth_name, departments.name as department, designations.name as designation")
						  ->from('info_minute_details')
						  ->join("user_details", "info_minute_details.issued_by = user_details.id")
						  ->join("auth_types", "info_minute_details.auth_id = auth_types.id")
						  ->join("emp_basic_details", "emp_basic_details.id = user_details.id")
						  ->join("departments", "user_details.dept_id = departments.id")
						  ->join("designations", "designations.id = emp_basic_details.designation")
						  ->order_by("info_minute_details.posted_on", "desc")
						  ->get();

		return $query->result();
	}
}

/* End of file edit_minute_model.php */
/* Location: mis/application/models/edit_minute_model.php */