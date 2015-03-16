<?php

class Post_notice_model extends CI_Model
{

	var $table = 'info_notice_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}
		
	function get_max_notice_id()
	{
		$this->db->select_max('notice_id');
		$query = $this->db->get($this->table);
		
		$this->db->select_max('notice_id');
		$query2 = $this->db->get('info_notice_archieve_details');
		
		if($query->row()->notice_id == NULL && $query2->row()->notice_id == NULL)
			return 	$query->row();
		else if($query->row()->notice_id > $query2->row()->notice_id)
			return $query->row();
		else
			return $query2->row();
	}
}

/* End of file post_notice_model.php */
/* Location: mis/application/models/post_notice_model.php */