<?php

class Report_model extends CI_Model
{
	var $table_userdetails = 'user_details';
	var $table_dept_course = 'dept_course';
	var $table_course = 'courses';
	var $table_branch = 'branches';
	var $table_subject = 'subjects';
	var $table_course_structure = 'course_structure';
	var $table_elective_group = 'elective_group';
	var $table_course_branch = 'course_branch';
	var $table_elective_offered = 'elective_offered';
  	var $table_depts = 'departments';
	

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	function get_admn_no()
	{
		$query = $this->db->query("SELECT admn_no FROM `stu_details`");
			foreach($query->result_array() as $row){
				//$new_row['label']=htmlentities(stripslashes($row['name_in_hindi']." - ".$row['admn_no']));
				$new_row['value']=htmlentities(stripslashes($row['admn_no']));
				$row_set[] = $new_row; //build an array
			}
			echo json_encode($row_set); //format the array into json data
	}
 	
	function get_depts()
	{
		$query = $this->db->get_where($this->table_depts, array('type'=>'academic'));
		return $query->result();
	}
	function get_course()
	{
		
		$query = $this->db->query("SELECT * from courses");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	function get_branch()
	{
		$query = $this->db->query("SELECT * from branches");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function get_course_dept($id)
	{
		
		$query = $this->db->query("SELECT * from courses");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	
	function get_course_bydept($dept_id)
	{
		
		$query = $this->db->query("SELECT DISTINCT course_branch.course_id,id,name,duration FROM 
		courses INNER JOIN course_branch ON course_branch.course_id = courses.id INNER JOIN dept_course ON 
		dept_course.course_branch_id = course_branch.course_branch_id WHERE dept_course.dept_id ='".$dept_id."'");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	function get_branch_bycourse($course,$dept)
	{
		$query = $this->db->query("SELECT DISTINCT id,name,dept_course.course_branch_id FROM branches INNER JOIN course_branch ON course_branch.branch_id = branches.id INNER JOIN dept_course ON dept_course.course_branch_id = course_branch.course_branch_id WHERE course_branch.course_id = '".$course."' AND dept_course.dept_id = '".$dept."'");
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}



	
}
