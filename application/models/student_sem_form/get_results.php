<?php
class Get_results extends CI_Model
{
	var $result = 'result_status';
		
		function getSemesterDetails($sid,$semid){
				if($this->db->table_exists($this->result)){
				$q=$this->db->get_where($this->result,array('admission_no'=>$sid,'semster'=>$semid));
				if($q->num_rows() >0){
					return $q->result;
					}
				}
				return false;
			}
				/////Get GPA PER SEMSTER parameter $sid is Student Id and $semid is Semester id
		
		/*function getGPAperSemester($sid,$semid){
			if($this->db->table_exists($this->result)){
			$q=$this->db->query("select credit_hr,(sessional_m + theory_m + practical_m) as total from ".$this->result."  where admission_no='".$sid."' and semster='".$semid."'");
				if($q->num_rows() > 0){
					$q=$q->result();
					
				$i=0;
				$s=1;
				$chr=1;
				//print_r($q); die();
			foreach($q as $r){
					  $tm=$this->getMarks($this->get_numeric($r->total));
					   $j=$this->get_numeric($r->credit_hr);
					  $s = ($j*$tm*$s);
					    $chr = ($j * $chr);
					
				}	
				return $s/$chr;
				}else{
					return false;
					}
			}
			return false;
		}*/
		
		function getGPAperSemester($sid,$semid){
				//echo $sid;
				if($this->db->table_exists($this->result)){
				$q=$this->db->select('subject_id')->get_where($this->result,array('admission_no'=>$sid,'semster'=>$semid));
				if($q->num_rows() > 0){
						$d=$q->result_array();	 
						return " -: ".$d[0]['subject_id']; 
						
					}
				}
				
			}
		
		
	
	private function getMarks($n){
			if($n>=91 and $n<=100){
					$d = 10;
			}else if($n>=81 and $n<=90){
					$d = 9;
			}else if($n>=71 and $n<=80){
					$d = 8;
			}else if($n>=61 and $n<=70){
					$d = 7;
			}else if($n>=51 and $n<=60){
					$d = 6;
			}else if($n>=41 and $n<=50){
					$d = 5;
			}else if($n>=35 and $n<=40){
					$d = 4;
			}else{
				$d=0;	
			}
			return $d;
	}
	private function get_numeric($val) {
			if (is_numeric($val)) {
				return $val + 0;
		  }
		  	  return 0;
	} 
	///////////////////////////////////////////////////////////////////////////////
	
	
}

?>