<?php

class Complaints extends CI_Model
{
	var $table = 'complaint';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->query ("INSERT INTO complaint (user_id, type, location, location_details, problem_details, pref_time, complaint_id) VALUES ('".$data['user_id']."','".$data['type']."','".$data['location']."','".$data['location_details']."','".$data['problem_details']."','".$data['pref_time']."','".$data['complaint_id']."');");
	}
	function complaint_list ($status, $supervisor)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE status = '".$status."' and type='".$supervisor."'ORDER BY date_n_time;");
		return $res;
	}
	function all_complaint_list ($supervisor)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE type='".$supervisor."'ORDER BY date_n_time DESC;");
		return $res;
	}
	function user_complaint_list ($user_id)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE user_id='".$user_id."' ORDER BY date_n_time DESC;");
		return $res;
	}
	function get_complaint_details ($complaint_id)
	{
		$res = $this->db->query("SELECT * FROM complaint WHERE complaint_id = '".$complaint_id."';");
		return $res;		
	}
	function update_complaint ($complaint_id, $status, $fresh_action)
	{	
		$this->db->query("UPDATE complaint SET remarks = '".$fresh_action."', status = '".$status."' WHERE complaint_id = '".$complaint_id."';");
	}
	function get_remarks ($complaint_id)
	{
		$res = $this->db->query("SELECT remarks FROM complaint WHERE complaint_id = '".$complaint_id."';");
		foreach ($res->result() as $row) //last
				$action_taken = $row->remarks;
		return $action_taken;		
	}
}
?>

