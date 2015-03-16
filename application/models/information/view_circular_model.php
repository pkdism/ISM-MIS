<?php

class View_circular_model extends CI_Model
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
		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$circular_cat = $auth_id->row()->auth_id;

		$this->db->select('circular_id');
		$where = "circular_cat = 'all' OR circular_cat = '".$circular_cat."'";
		$this->db->where($where);
		$this->db->order_by('posted_on','desc');
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

	function get_prev_versions($circular_id)
	{
		$table = 'info_circular_modification_details';
		$this->db->where('circular_id',$circular_id);
		$this->db->order_by('posted_on','desc');
		$query = $this->db->get($table);

		return $query->result();
	}

	function get_circular_row2($circular_id,$modv)
	{
		$table = 'info_circular_modification_details';
		$this->db->where('circular_id',$circular_id);
		$this->db->where('modification_value',$modv);
		$query = $this->db->get($table);

		return $query->row();
	}

	function get_circulars($date='')
	{
		if($date == '')	$date = date('Y-m-d');

		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$circular_cat = $auth_id->row()->auth_id;

		$where = "(circular_cat = 'all' OR circular_cat = '".$circular_cat."') AND date(info_circular_details.posted_on) <= '".$date."'";
		$this->db->where($where);
		 $query = $this->db->select("info_circular_details.*, user_details.*, auth_types.type as auth_name, departments.name as department, designations.name as designation")
						  ->from($this->table)
						  ->join("user_details", $this->table.".issued_by = user_details.id")
						  ->join("auth_types", $this->table.".auth_id = auth_types.id")
						  ->join("emp_basic_details", "emp_basic_details.id = user_details.id")
						  ->join("departments", "user_details.dept_id = departments.id")
						  ->join("designations", "designations.id = emp_basic_details.designation")
						  ->order_by("info_circular_details.posted_on", "desc")
						  ->get();

		return $query->result();
	}

	function get_new_circular_count()
	{
		$last_login_date = $this->db->query("SELECT `time` FROM `user_login_attempts` where `id` = '".$this->session->userdata('id')."' order by `time` desc limit 1,1")->row()->time;

		$auth_id = $this->db->select('auth_id')->where('id',$this->session->userdata('id'))->get('users');
		$notice_cat = $auth_id->row()->auth_id;

		return $this->db->select("count(*) as count")->where("(circular_cat = 'all' OR circular_cat = '".$notice_cat."') AND date(posted_on) > '".$last_login_date."'")->get($this->table)->row()->count;
	}
}

/* End of file view_circular_model.php */
/* Location: mis/application/models/view_circular_model.php */