<?php

class User_notifications extends CI_Model
{
	var $table = 'user_notifications';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_user_notifications ($user_id)
	{
		$res = $this->db->query("SELECT * from user_notifications
						   WHERE user_to = '".$user_id."' AND
						   ISNULL(rec_date) AND module_id='file_tracking'
						   ORDER BY send_date DESC");
		return $res;
	}
	function set_rec_date ($file_id, $emp_id)
	{
		$this->db->query("UPDATE user_notifications SET rec_date = now() WHERE path='receive_file/validate_track_num/".$file_id."' AND user_to='".$emp_id."';");

	}
}

