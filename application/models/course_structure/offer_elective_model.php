<?php

class Offer_elective_model extends CI_Model
{
var $table_elective_group = 'elective_group';
	var $table_optional_offered = 'optional_offered';
	
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}	
	
	function get_branch_by_dept_course_session($dept,$course,$session){
		$query = $this->db->query("SELECT * from dept_course where dept_id='".$dept."' AND aggr_id REGEXP '^".$course.".*".$session."$'");
		return $query->result();
	}
	
	function select_elective_offered($aggr_id,$id,$batch)
	{
    	$query = $this->db->get_where($this->table_optional_offered,array('aggr_id'=>$aggr_id,'id'=>$id,'batch'=>$batch));
    	if($query->num_rows() > 0)
			return true;	
	}
	function insert_elective_offered($data)
	{
    	$this->db->insert($this->table_optional_offered,$data);
    	return $this->db->_error_message(); 
	}
	
	function select_elective_offered_by_aggr_id($aggr_id,$semester,$batch)
	{
		$query = $this->db->query("SELECT * FROM optional_offered INNER JOIN course_structure ON course_structure.id = optional_offered.id WHERE optional_offered.aggr_id = '$aggr_id' AND course_structure.semester = '$semester' AND optional_offered.batch = '$batch'");
			return $query->result();	
	}
	
	function delete_optional_subject_offered($aggr_id,$semester,$batch)
	{
		$query = $this->db->query("DELETE ele_off FROM optional_offered ele_off INNER JOIN course_structure ON course_structure.id = ele_off.id
		WHERE ele_off.aggr_id = '$aggr_id' AND course_structure.semester = '$semester' AND ele_off.batch = '$batch'");
	    
		if($this->db->affected_rows() >=0 || !$this->db->_error_message())
			return true;

	}
}
/* End of file menu_model.php */

/* Location: mis/application/models/course_structure/menu_model.php */