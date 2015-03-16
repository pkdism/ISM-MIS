<?php

class User_notifications_model extends CI_Model
{

	var $table = 'user_notifications';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function updateNotification($data, $where) {
		$this->db->update($this->table, $data, $where);
	}
	
	function getUnreadUserNotifications($user_to, $auth)
	{
		$query = $this->db->select('user_notifications.*, user_details.photopath as photopath')
						->where('user_to',$user_to)
						->where('auth_id',$auth)
						->where('send_date >= ', $this->session->userdata('last_login'))
						->from($this->table)
						->join('user_details', 'user_details.id = user_notifications.user_from')
						->order_by('send_date','desc')
						->get();
		return $query->result();
	}

	function getReadUserNotifications($user_to, $auth)
	{
		$query = $this->db->select('user_notifications.*, user_details.photopath as photopath')
						->where('user_to',$user_to)
						->where('auth_id',$auth)
						->where('send_date < ', $this->session->userdata('last_login'))
						->from($this->table)
						->join('user_details', 'user_details.id = user_notifications.user_from')
						->order_by('send_date','desc')
						->limit(100)
						->get();

		return $query->result();
	}

}

/* End of file user_notifications_model.php */
/* Location: mis/application/models/user_notifications_model.php */