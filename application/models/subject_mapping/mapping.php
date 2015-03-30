<?php

class Mapping extends CI_Model
{
	private $sub_mapping = "sub_mapping";
	private $sub_m_des="sub_mapping_des"; 
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
   function insert_mapping($data){
	   
	   		if($this->db->insert($this->sub_mapping,$data))
				return $this->db->insert_id();
			else
			return false;
	   }
	   
	function insert_mapping_des($data){
	   
	   		if($this->db->insert($this->sub_m_des,$data))
				return true;
			else
			return false;
	   }
	   
	function getMappingByYear($y=""){
		
				if($y)
				$b=$this->db->get_where($this->sub_mapping,array('YEAR(date)'=>$y));
				else
				$b=$this->db->get($this->sub_mapping);
				if($b->num_rows()>0)
				return $b->result();
		}
		
	function checkExisting($course, $branch, $semester){
			$q=$this->db->get_where($this->sub_mapping,array('course_id'=>$course,'branch_id'=>$branch,'semester'=>$semester));
				
				if($q->num_rows > 0)
					return true;
			
				return false;
						
	}
	function checkExistingSemester($course, $branch,$department){
		 
		$re=$this->db->select('semester')->get_where($this->sub_mapping,array('course_id'=>$course,'branch_id'=>$branch,'dept_id'=>$department));
		//	var_dump($this->db);
			if($re->num_rows > 0)
				return $re->result();
			
			return false;
	}
	
	function getMappingById($id){
		$b=$this->db->get_where($this->sub_mapping,array('map_id'=>$id));
		return $b->result_array();
	}
	
	function getMappingDesById($id){
		//echo 12; die;
		$b=$this->db->get_where($this->sub_m_des,array('map_id'=>$id));
		return $b->result_array();
	}
	
	function deleteMappingById($id){
			
			$this->db->delete($this->sub_m_des,array('map_id'=>$id));	
			$this->db->delete($this->sub_mapping,array('map_id'=>$id));
			return true;
	}
	
	function updateDMapping($mapId,$subId,$teacherId,$data){
		$q=$this->db->update($this->sub_m_des, $data, array('map_id' =>$mapId,'subject_id'=>$subId,'teacher_id'=>$teacherId));
		if($q)
		return true;

		return false;	
	}
	function getSubjectforAddTeacherBymapId(){
		
		$this->db->get_where($this->sub_m_des,array('map_id'=>$id,'M'=>'1'))->result();
	}
	
	function delMapDes($mid,$subid,$t){
		
		$this->db->delete($this->sub_m_des,array('map_id'=>$mid,'subject_id'=>$subid,'teacher_id'=>$t));
		return true;
		
	}
		
} 
?>