<?php

class Viewminute_model extends CI_Model
{

	var $table = 'info_minute_archieve_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	//return a list of minute number for a particular employee
	function get_minute_ids()
	{
		
		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$minute_cat = $auth_id->row()->auth_id;
		
		$this->db->select('minute_id');
		$where = "minute_cat = 'all' OR minute_cat = '".$minute_cat."'";
		$this->db->where($where);
		$this->db->order_by('posted_on','asc');
		$query = $this->db->get($this->table);

		return $query->result();
	}
	
	function get_minutes()
	{
		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$minute_cat = $auth_id->row()->auth_id;

		$where = "meeting_cat = 'all' OR meeting_cat = '".$minute_cat."'";
		$this->db->where($where);
		$query = $this->db->select("info_minute_archieve_details.*, user_details.*, auth_types.type as auth_name, departments.name as department, designations.name as designation")
						  ->from($this->table)
						  ->join("user_details", $this->table.".issued_by = user_details.id")
						  ->join("auth_types", $this->table.".auth_id = auth_types.id")
						  ->join("emp_basic_details", "emp_basic_details.id = user_details.id")
						  ->join("departments", "user_details.dept_id = departments.id")
						  ->join("designations", "designations.id = emp_basic_details.designation")
						  ->order_by("info_minute_archieve_details.posted_on", "desc")
						  ->get();

		return $query->result();
	}
	
	//return a row for a particular minute id
	function get_minute_row($minute_id)
	{
		$this->db->where('minute_id',$minute_id);
		$query = $this->db->get($this->table);
		
		return $query->row();
	}
	
	function get_prev_versions($minute_id)
	{
		$table = 'info_minute_modification_details';
		$this->db->where('minute_id',$minute_id);
		$this->db->order_by('posted_on','desc');
		$query = $this->db->get($table);
		
		return $query->result();
	}
	
	function get_minute_row2($minute_id,$modv)
	{
		$table = 'info_minute_modification_details';
		$this->db->where('minute_id',$minute_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($table);
		
		return $query->row();
	}
	
}

/* End of file view_minute_model.php */
/* Location: mis/application/models/view_minute_model.php */