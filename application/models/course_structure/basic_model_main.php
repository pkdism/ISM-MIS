<?php

class Basic_model_main extends CI_Model
{
	var $table_userdetails = 'user_details';
	var $table_dept_course = 'dept_course';
	var $table_course = 'courses';
	var $table_branch = 'branches';
	var $table_subject = 'subjects';
	var $table_course_structure = 'course_structure';
	var $table_elective_group = 'elective_group';
	var $table_course_branch = 'course_branch';
	var $table_optional_offered = 'optional_offered';
	var $table_honour_minor_offered = 'honour_minor_offered';
	var $table_minor_offered = 'minor_offered';
  	var $table_depts = 'departments';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_depts()
	{
		$query = $this->db->get_where($this->table_depts, array('type'=>'academic'));
		return $query->result();
	}
	
	function get_course()
	{
		$query = $this->db->get($this->table_course);
		return $query->result();
	}
	
	function get_course_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_course,array('id'=>$id));
		//if($query->num_rows() > 0) 
			return $query->result();
	}
	
	function insert_course($course_details)
	{
    	$this->db->insert($this->table_course, $course_details);
     	return true; 
	}
	
	function select_course_branch($course_id,$branch_id)
	{
    	$query = $this->db->get_where($this->table_course_branch, array('course_id'=>$course_id,'branch_id'=>$branch_id));
		if($query->num_rows() >= 1)
			return $query->result();
		return false;
	}
	
	function get_branch_details_by_id($id)
	{
		$query = $this->db->get_where($this->table_branch,array('id'=>$id));
		if($query->num_rows()>0)
			return $query->result();
	}
	
	function insert_branch($branch_details)
	{
    	$this->db->insert($this->table_branch, $branch_details);
      	return true;
	}
	
	function insert_course_branch($course_branch_mapping)
	{
    	$this->db->insert($this->table_course_branch, $course_branch_mapping);
		return true;
	}
	
	function insert_dept_course($dept_course)
	{
		$query = $this->db->insert($this->table_dept_course,$dept_course);
		return true;
	}
	
 	
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */