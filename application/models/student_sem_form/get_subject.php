<?php
class Get_subject extends CI_Model
{
	var $table_subject = 'subjects';
	var $table_course_branch = 'course_branch';
	var $eleSubject = 'stu_sem_reg_subject';
	var $fee = 'stu_sem_reg_fee';
	var $result = 'result_status';
	var $HM = 'stu_sem_honour_minor';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	
	function getSubject($course_id,$branch_id,$semster,$stuid){
			$d=$this->getStudentAcdamicDetails($stuid);
			$curaid = $course_id."_".$branch_id."_".$d[0]->enrollment_year;
		
		$this->load->model('course_structure/basic_model');
		$agr =$this->basic_model->get_latest_aggr_id($course_id,$branch_id,$curaid);
		
		$query="SELECT 
  `course_structure`.`sequence`,
  `subjects`.`id`,
  `subjects`.`subject_id`,
  `subjects`.`name`
FROM
  `dept_course`
  INNER JOIN `course_branch` ON (`dept_course`.`course_branch_id` = `course_branch`.`course_branch_id`)
  INNER JOIN `course_structure` ON (`dept_course`.`aggr_id` = `course_structure`.`aggr_id`)
  INNER JOIN `subjects` ON (`course_structure`.`id` = `subjects`.`id`)
WHERE
  `course_branch`.`course_id` = '".$course_id."' AND 
  `course_branch`.`branch_id` = '".$branch_id."' AND 
  `course_structure`.`semester` = '".$semster."' AND
   `course_structure`.`sequence` REGEXP '^[0-9]+$' AND
   `course_structure`.`aggr_id`='".$agr[0]->aggr_id."' order by `course_structure`.`sequence`";
		$data['subjects']= $this->db->query($query)->result_array();
		 
		 return $data;
	}
	
	// Get Elective Subject From Corse Structure //
	function getElective($course_id,$branch_id,$semster,$stuid){
			$d=$this->getStudentAcdamicDetails($stuid);
			 $curaid = $course_id."_".$branch_id."_".$d[0]->enrollment_year;
		
		$this->load->model('course_structure/basic_model');
		$agr =$this->basic_model->get_latest_aggr_id($course_id,$branch_id,$curaid);
		
	$query =	"SELECT   `subjects`.`id`, `subjects`.`subject_id`, `subjects`.`name`,  `course_structure`.`sequence`
		 FROM
		  `optional_offered`
		  INNER JOIN `subjects` ON (`optional_offered`.`id` = `subjects`.`id`)
		  INNER JOIN `course_structure` ON (`optional_offered`.`aggr_id` = `course_structure`.`aggr_id`)
		  AND (`optional_offered`.`id` = `course_structure`.`id`)
		  INNER JOIN `dept_course` ON (`course_structure`.`aggr_id` = `dept_course`.`aggr_id`)
		  INNER JOIN `course_branch` ON (`dept_course`.`course_branch_id` = `course_branch`.`course_branch_id`)
		WHERE
		  `course_branch`.`course_id` = '".$course_id."' AND 
		  `course_branch`.`branch_id` = '".$branch_id."' AND 
		  `course_structure`.`semester` = '".$semster."' AND
		  `optional_offered`.`aggr_id` = '".$agr[0]->aggr_id."' AND
		  `optional_offered.batch` = '".date('Y')."'"	;
		
	   $data['ele']=$this->db->query($query)->result_array();
	
	   return $data;
		
	}
	
	// get Honours Subject//
	
		function getHonourSubject($stuid,$semster){
			
			$d=$this->getStudentAcdamicDetails($stuid);
			$curaid = "honour_honour_".$d[0]->enrollment_year;
			
			$this->load->model('course_structure/basic_model');
			$agr =$this->basic_model->get_latest_aggr_id("honour","honour",$curaid);
			$data=$this->basic_model->select_honour_or_minor_offered_by_aggr_id($agr[0]->aggr_id,$semster);
			return $data;
		}
		
		// Get Minor Subject//
		function getMinorSubject($stuid,$semster){
				
			$d=$this->getStudentAcdamicDetails($stuid);
			$curaid = "minor_minor_".$d[0]->enrollment_year;
				
			$this->load->model('course_structure/basic_model');
			$agr =$this->basic_model->get_latest_aggr_id("minor","minor",$curaid);
			$this->basic_model->select_honour_or_minor_offered_by_aggr_id($agr[0]->aggr_id,$semster);
				
		}
	
	// Get Elective, Hornor, Minor Subjects and fee Details for Registration During form Filling//
	function getConfirm($id){
		$data['ele'] =$this->db->query("select * from stu_sem_reg_subject join subjects on stu_sem_reg_subject.sub_id = subjects.id where stu_sem_reg_subject.sem_form_id='".$id."'")->result_array();
		$data['fee'] =$this->db->get_where($this->fee,array('form_id'=>$id))->result_array();
		$data['HM'] = $this->db->query("select * from stu_sem_honour_minor join subjects on stu_sem_honour_minor.subject_id = subjects.id where stu_sem_honour_minor.sem_form_id='".$id."'")->result_array();
		return $data;
		}
	
		
		function getStudentAcdamicDetails($id){
			return $this->db->get_where('stu_academic',array('id'=>$id))->result();
			}
		
		function getSubjectById($id){
			$q=$this->db->get_where($this->table_subject,array('id'=>$id));
				if($q->num_rows($q)){
						return $q->result();
					}
					return false;
			}
			
	
	
}
?>