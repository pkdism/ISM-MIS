<?php

class Cv_model extends CI_Model
{
	var $table_projects = 'tnp_cv_projects';
  var $table_achievements='tnp_cv_achievements';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function insert_project($project_details)
	{
		$query = $this->db->insert($this->table_projects,$project_details);
		return true;
	}	
  function insert_achievements($cv_details)
	{
    $query= $this->db->insert($this->table_achievements,$cv_details);
    return true;
  }
  function get_projects($user_id)
  {
    $query=$this->db->get_where($this->table_projects, array('user_id'=>$user_id));
    return $query->result();
  }
  function get_achievements($user_id)
  {
    $query=$this->db->get_where($this->table_achievements, array('user_id'=>$user_id));
    return $query->result();
  }
  function update_project($data, $id)
	{
    $details = array('id' => $id);
    $this->db->where($details);
    $this->db->update($this->table_projects, $data);
    return $this->db->affected_rows();
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */