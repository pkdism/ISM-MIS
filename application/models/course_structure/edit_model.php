<?php

class Edit_model extends CI_Model
{
	var $table_subject = 'subjects';
	var $table_coursestructure = 'course_structure';
	var $table_elective_group = 'elective_group';


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert_subjects($subject_details)
	{
    	$this->db->insert($this->table_subject, $subject_details);
		return $this->db->_error_message(); 
	}
	
	function insert_coursestructure($coursestructure_details)
	{
    	$this->db->insert($this->table_coursestructure, $coursestructure_details);
		return $this->db->_error_message(); 
	}
	
	function insert_elective_group($elective_group)
	{
    	$this->db->insert($this->table_elective_group, $elective_group);
		return $this->db->_error_message(); 
	}
	
	function update_subjects($values, $where)
	{
		$this->db->where($where);
		//$this->db->where('id',$subjectid);
		return $this->db->update($this->table_subject,$values);
		//return $this->db->_error_message();
		//$this->db->query("UPDATE subjects SET name = '$name' WHERE subject_id = '$subject_id'");
		//return $this->db->affected_rows();
	}

	function delete($where)
	{
		$this->db->delete($this->table,$where);
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */