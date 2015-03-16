<?php

class Designations_model extends CI_Model
{

	var $table = 'designations';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function get_designations($where_clause = '')
	{
		if($where_clause !== '' )
			$this->db->where($where_clause,'',FALSE);
		$this->db->order_by('type asc,name asc');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	function getDesignationById($id = '')
	{
		$query = $this->db->get_where($this->table,array('id'=>$id));
		if($query->num_rows() === 1)
			return $query->row();
		else
			return false;
	}
}

/* End of file designations_model.php */
/* Location: mis/application/models/designations_model.php */