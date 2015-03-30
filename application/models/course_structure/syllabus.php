<?php

class Syllabus extends CI_Model
{
	var $table_userdetails = 'user_details';
	var $table_dept_course = 'dept_course';
	var $table_course = 'cs_courses';
	var $table_branch = 'cs_branches';
	var $table_subject = 'subjects';
	var $table_course_structure = 'course_structure';
	var $table_elective_group = 'elective_group';
	var $table_course_branch = 'course_branch';
	var $table_optional_offered = 'optional_offered';
  	var $table_depts = 'departments';
	var $table_syllabus = 'cs_syllabus';
    
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function insert_syllabus($syllabus_details)
	{
		$this->db->insert($this->table_syllabus,$syllabus_details);
		if($this->db->affected_rows() > 0)
			return true;
	}
	
	function check_if_syllabus_exist($aggr_id,$course_branch_id)
	{
		$query = $this->db->get_where($this->table_syllabus,array("aggr_id"=>$aggr_id,"course_branch_id"=>$course_branch_id));
		if($query->num_rows() > 0)
			return $query->result();	
		else
			return false;
	}
	
	function delete_syllabus($aggr_id,$course_branch_id)
	{
		$this->db->where("aggr_id = '$aggr_id' AND course_branch_id='$course_branch_id'");
		$this->db->delete($this->table_syllabus);	
	}
	

	
 		
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */