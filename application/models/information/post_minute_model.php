<?php

class Post_minute_model extends CI_Model
{

	var $table = 'info_minute_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}
		
	function get_max_minute_id()
	{
		$this->db->select_max('minutes_id');
		$query = $this->db->get($this->table);
		$this->db->select_max('minutes_id');
		$query2 = $this->db->get('info_minute_archieve_details');
		if($query->row()->minutes_id == NULL && $query2->row()->minutes_id == NULL)
			return 	$query->row();
		else if($query->row()->minutes_id > $query2->row()->minutes_id)
			return $query->row();
		else
			return $query2->row();
	}
	
	function get_department()
	{
		$usertable = 'user_details';
		$this->db->select('dept_id');
		$this->db->where('id',$this->session->userdata('id'));
		$query  = $this->db->get($usertable);
		
		return $query->row()->dept_id;
	}
}

/* End of file post_minute_model.php */
/* Location: mis/application/models/post_minute_model.php */