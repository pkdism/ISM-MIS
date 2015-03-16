<?php

class Faculty_details_model extends CI_Model
{

	var $table = 'faculty_details';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function updateById($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id));
	}

	function getFacultyById($id = '')
	{
		if($id != '')
		{
			$query = $this->db->where('id="'.$id.'"','',FALSE)->get($this->table);
			if($query->num_rows() === 1)
				return $query->row();
			else
				return FALSE;
		}
		else
			return FALSE;
	}

	function getPendingDetailsById($id = '')
	{
		if($id == '')
			return FALSE;
		else
		{
			$query=$this->db->where('id',$id)->get('pending_'.$this->table);
			if($query->num_rows() ==1 )	return $query->row();
			return FALSE;
		}
	}

	function insertPendingDetails($data)
	{
		$this->db->insert('pending_'.$this->table,$data);
	}

	function updatePendingDetailsById($data,$id)
	{
		$this->db->update('pending_'.$this->table,$data,array('id'=>$id));
	}

	function deletePendingDetailsWhere($data)
	{
		$this->db->delete('pending_'.$this->table,$data);
	}
}

/* End of file faculty_details_model.php */
/* Location: mis/application/models/faculty_details_model.php */