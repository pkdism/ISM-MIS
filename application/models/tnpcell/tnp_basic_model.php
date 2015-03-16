<?php

class Tnp_basic_model extends CI_Model
{
	var $table_jnf_users = 'jnf_users';
  	var $table_jnf_user_details='jnf_user_details';
	var $table_jnf_company_details='jnf_company_details';
	var $table_jnf_eligible_branches='jnf_eligible_branches';
	var $table_jnf_logistic='jnf_logistics';
	var $table_jnf_salary='jnf_salary';
	var $table_jnf_selectioncutoff='jnf_selectioncutoff';
	var $table_jnf_selectionprocess='jnf_selectionprocess';
	var $table_tnp_calender = 'tnp_calender';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function get_company_basic_details($company_id)
	{
		if($company_id != '')
			$this->db->where("jnf_users.company_id",$company_id);
			
		$this->db->distinct();
		$this->db->join($this->table_jnf_user_details,"jnf_user_details.company_id = jnf_users.company_id");
		$query = $this->db->get($this->table_jnf_users);
		return $query->result();	
	}
	
	function get_company_basic_details_not_given_dates($company_id)
	{
		if($company_id != '')
			$this->db->where("jnf_users.company_id",$company_id);
		$this->db->where("jnf_users.company_id NOT IN (SELECT company_id FROM tnp_calender)");
		$this->db->distinct();
		$this->db->join($this->table_jnf_user_details,"jnf_user_details.company_id = jnf_users.company_id");
		$query = $this->db->get($this->table_jnf_users);
		return $query->result();	
	}
	
	function get_alloted_company_basic_details($company_id)
	{
		if($company_id != '')
			$this->db->where("jnf_users.company_id",$company_id);
			
		$this->db->where("jnf_users.company_id IN (SELECT company_id FROM tnp_calender)");
		//$this->db->distinct();
		$this->db->join($this->table_jnf_user_details,"jnf_user_details.company_id = jnf_users.company_id");
		$this->db->join($this->table_tnp_calender,"tnp_calender.company_id = jnf_users.company_id");
		
		$query = $this->db->from($this->table_jnf_users);
		$query = $this->db->get();
		
		return $query->result();	
	}
	
	function get_company_list()
	{		
		$query = $this->db->query("SELECT user_id,jnf_users.company_id,jnf_user_details.company_name,jnf_user_details.website,jnf_user_details.session,		jnf_salary.ctc,jnf_salary.gross,jnf_salary.take_home,jnf_company_details.category,jnf_company_details.industry,jnf_company_details.job_designation,jnf_company_details.job_description,jnf_company_details.job_posting,tnp_calender.date_from,tnp_calender.date_to,tnp_calender.status FROM jnf_users INNER JOIN jnf_user_details ON jnf_user_details.company_id = jnf_users.company_id INNER JOIN jnf_salary ON jnf_salary.company_id = jnf_users.company_id INNER JOIN jnf_company_details ON jnf_company_details.company_id = jnf_users.company_id LEFT JOIN tnp_calender ON tnp_calender.company_id = jnf_users.company_id");
		return $query->result();	
	}
	
	function get_company_list_visible_to_student()
	{		
		$query = $this->db->query("SELECT user_id,jnf_users.company_id,jnf_user_details.company_name,jnf_user_details.website,jnf_user_details.session,		jnf_salary.ctc,jnf_salary.gross,jnf_salary.take_home,jnf_company_details.category,jnf_company_details.industry,jnf_company_details.job_designation,jnf_company_details.job_description,jnf_company_details.job_posting,tnp_calender.date_from,tnp_calender.date_to,tnp_calender.status FROM jnf_users INNER JOIN jnf_user_details ON jnf_user_details.company_id = jnf_users.company_id INNER JOIN jnf_salary ON jnf_salary.company_id = jnf_users.company_id INNER JOIN jnf_company_details ON jnf_company_details.company_id = jnf_users.company_id LEFT JOIN tnp_calender ON tnp_calender.company_id = jnf_users.company_id WHERE tnp_calender.stu_visibility = 1");
		return $query->result();		
	}
	
	function get_company_details($company_id)
	{
		$query = $this->db->get_where($this->table_jnf_company_details,array("company_id"=>$company_id));
		return $query->result();	
	}
	
	function get_company_eligible_branches($company_id)
	{
		$query = $this->db->query("SELECT DISTINCT branches.id as b_id,branches.name as b_name,courses.id as c_id,courses.name as c_name,courses.duration,departments.id as dept_id,departments.name as dept_name FROM branches INNER JOIN course_branch ON course_branch.branch_id = branches.id INNER JOIN courses ON courses.id = course_branch.course_id INNER JOIN dept_course ON dept_course.course_branch_id = course_branch.course_branch_id INNER JOIN departments ON departments.id = dept_course.dept_id INNER JOIN jnf_eligible_branches ON jnf_eligible_branches.course_branch_id = course_branch.course_branch_id WHERE jnf_eligible_branches.company_id='$company_id'");
		return $query->result();	
	}
	
	function get_company_logistics($company_id)
	{
		$query = $this->db->get_where($this->table_jnf_logistic,array("company_id"=>$company_id));
		return $query->result();	
	}
	
	
	function get_company_salary($company_id)
	{
		$query = $this->db->get_where($this->table_jnf_salary,array("company_id"=>$company_id));
		return $query->result();	
	}
	
	function get_company_selectioncutoff($company_id)
	{
		
		$this->db->select("10marks as marks_10,12marks as marks_12,UG,PG,courses.name");
		$this->db->join("courses","courses.id = jnf_selectioncutoff.course_id");
		$query = $this->db->get_where($this->table_jnf_selectioncutoff,array("company_id"=>$company_id));
		return $query->result();	
	}
	
	function get_company_selectionprocess($company_id)
	{
		$query = $this->db->get_where($this->table_jnf_selectionprocess,array("company_id"=>$company_id));
		return $query->result();	
	}
	
	function get_company_in_date_range($from,$to)
	{
		$this->db->where("date_from >= '$from' AND date_from <= '$to'");
		$this->db->or_where("date_to >= '$from' AND date_to <= '$to'");
		$this->db->or_where("date_from <= '$from' AND date_to >= '$to'");
		$this->db->join("jnf_user_details","jnf_user_details.company_id = tnp_calender.company_id");
		$query = $this->db->get($this->table_tnp_calender);
		return $query->result();	
	}
	
	
	function insert_tnp_calender($tnp_calender)
	{
		$query = $this->db->insert_string($this->table_tnp_calender, $tnp_calender);
		$query = str_replace('INSERT INTO','INSERT IGNORE INTO',$query);
		$this->db->query($query);
		return $this->db->affected_rows();	
	}
	
	function update_tnp_calender($tnp_calender,$company_id)
	{
		$this->db->where("company_id",$company_id);
		$query = $this->db->update($this->table_tnp_calender,$tnp_calender);
		return $query;
	}
	
	function delete_tnp_calender($company_id)
	{
		$query = $this->db->delete($this->table_tnp_calender,array('company_id'=>$company_id));
		return $query;
	}
}

/* End of file emp_current_entry_model.php */
/* Location: Codeigniter/application/models/employee/emp_current_entry_model.php */