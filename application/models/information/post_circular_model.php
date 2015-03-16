<?php

class Post_circular_model extends CI_Model
{

	var $table = 'info_circular_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}
		
	function get_max_circular_id()
	{
		$this->db->select_max('circular_id');
		$query = $this->db->get($this->table);
		$this->db->select_max('circular_id');
		$query2 = $this->db->get('info_circular_archieve_details');
		if($query->row()->circular_id == NULL && $query2->row()->circular_id == NULL)
			return 	$query->row();
		else if($query->row()->circular_id > $query2->row()->circular_id)
			return $query->row();
		else
			return $query2->row();

	}
}

/* End of file post_circular_model.php */
/* Location: mis/application/models/post_circular_model.php */