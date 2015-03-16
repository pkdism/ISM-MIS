<?php

class User_address_model extends CI_Model
{

	var $table = 'user_address';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}

	function insert_batch($data)
	{
		$this->db->insert_batch($this->table,$data);
	}

	function updatePresentAddrById($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id,'type'=>'present'));
	}

	function updatePermanentAddrById($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id,'type'=>'permanent'));
	}

	function updateCorrespondenceAddrById($data,$id)
	{
		$this->db->update($this->table,$data,array('id'=>$id,'type'=>'correspondence'));
	}

	function deleteCorrespondenceAddrById($id)
	{
		$this->db->delete($this->table,array('id'=>$id,'type'=>'correspondence'));
	}

	function getAddrById($id = '',$type = '')
	{
		if($id == '')
			return FALSE;
		else
		{
			$this->db->where('id',$id);
			if($type != '')	$this->db->where('type',$type);
			$query=$this->db->get($this->table);
			if($query->num_rows() == 1)
				return $query->row();
			else
				return $query->result();
		}
	}

	function getPendingDetailsById($id = '',$type = '')
	{
		if($id == '')
			return FALSE;
		else
		{
			$this->db->where('id',$id);
			if($type != '')	$this->db->where('type',$type);
			$query=$this->db->get('pending_'.$this->table);
			if($query->num_rows() == 1)
				return $query->row();
			else
				return $query->result();
		}
	}

	function insertPendingDetails($data)
	{
		$this->db->insert_batch('pending_'.$this->table,$data);
	}

	function updatePendingPermanentDetailsById($data,$id)
	{
		$this->db->update('pending_'.$this->table,$data,array('id'=>$id,'type'=>'permanent'));
	}

	function updatePendingPresentDetailsById($data,$id)
	{
		$this->db->update('pending_'.$this->table,$data,array('id'=>$id,'type'=>'present'));
	}

	function deletePendingDetailsWhere($data)
	{
		$this->db->delete('pending_'.$this->table,$data);
	}
}

/* End of file user_address_model.php */
/* Location: mis/application/models/user_address_model.php */