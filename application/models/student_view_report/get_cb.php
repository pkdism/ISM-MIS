<?php

class Get_cb extends CI_Model
{
	public function getCB($id){
		
		$q=$this->db->query("SELECT 
  `courses`.`name` AS `course_name`,
  `branches`.`name` AS `branch_name`
FROM
  `course_branch`
  INNER JOIN `courses` ON (`course_branch`.`course_id` = `courses`.`id`)
  INNER JOIN `dept_course` ON (`course_branch`.`course_branch_id` = `dept_course`.`course_branch_id`)
  INNER JOIN `branches` ON (`course_branch`.`branch_id` = `branches`.`id`)
WHERE
  `dept_course`.`dept_id` = '".$id."'
");
		if($q->num_rows() > 0){
			return $q->row();
		}
	}
}
?>