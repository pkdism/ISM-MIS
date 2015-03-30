<?php 
class Sbasic_model extends CI_Model
{
	var $sem_form = 'stu_sem_reg_form';
	var $sem_start_date = 'stu_sem_reg_oc_date';
	var $sem_date_des = 'stu_sem_oc_date_des';
	var $branches = 'branches';
	var $Cbranch = 'stu_sem_change_branch';
	
	//In Case of change Branch/
	private $stu_acdamic = 'stu_academic';
	private $ud='user_details';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function checkStudent($a_id,$semeter){
		$query = $this->db->get_where($this->sem_form,array('admission_id'=>$a_id,'semster'=>$semeter));
		$data=$query->result_array();
			if(empty($data))
			return true;
			else
			return false;
	}
	/*public function checkStudentRepeat($a_id,$semeter){
		$query = $this->db->select('re_id')->get_where($this->sem_form,array('admission_id'=>$a_id,'semster'=>$semeter));
		$data=$query->result_array();
			if(empty($data))
			return false;
			else
			return $data;
	}*/
	//date set///
	public function udate_ocDate($data){
			$this->db->update($this->sem_start_date, $data, array('id' => '1'));
			return true;
		}
		
	public function getOcdate(){
			return $this->db->get_where($this->sem_start_date, array('id' => '1'))->result();
		}
    public function getOcdatedes(){
			return $this->db->query("SELECT * FROM `stu_sem_oc_date_des` WHERE `des_id`=(SELECT max(`des_id`) FROM `stu_sem_oc_date_des`) and date_id=1")->result();
		}
	
	public function checkDate(){
			$sdate = $this->getOcdate();
			$sd = $sdate[0]->opendate;
			$cd = $sdate[0]->closedate;
			$cdate = strtotime(date('Y-m-d'));
			$sdate = strtotime($sd);
			$closedate = strtotime($cd);
			if( $cdate >= $sdate){
				if($sdate <= $closedate)
					return true;
			}
			return false;
		}
		
		public function insertDateDes($data){
				
				$this->db->insert($this->sem_date_des, $data);
					if($this->db->_error_message()){
					return $this->db->_error_message();
					}else{
						return true;	
						}
			}

	/// End Date Set////	
	
	public function hod_vaise_student($dep){
			$query = $this->db->query("select * from stu_sem_reg_form as sf, stu_details as sd, user_details as ud, stu_sem_reg_fee as srf  where dept_id='".$dep."' and srf.form_id = sf.sem_form_id and sd.admn_no = sf.admission_id and ud.id = sf.admission_id and YEAR(timestamp)='".date('Y')."' order by sf.semster");
			if($query->num_rows() > 0){
					return $query->result();
			}else return false;
	}
	
	public function acdamic_vaise_student($did='',$cid='',$bid='',$sid=''){
			$q = "select * from stu_sem_reg_form as sf, stu_details as sd, user_details as ud, stu_sem_reg_fee as srf  where srf.form_id = sf.sem_form_id and sd.admn_no = sf.admission_id and ud.id = sf.admission_id and YEAR(timestamp)='".date('Y')."'";
			if($did)
				$q.=" and ud.dept_id='".$did."'";
			if($cid)
				$q.=" and sf.course_id='".$cid."'";
			if($bid)
				$q.=" and sf.branch_id='".$did."'";
			if($sid)
				$q.=" and sf.semester='".$sid."'";
				$q.=" and sf.hod_status='1'";
				$q.=" order by sf.semster";
			
			$query = $this->db->query($q);
			if($query->num_rows() > 0){
					return $query->result();
			}else return false;
	}
	
	public function hod_view_student($id,$fid){
			$query = $this->db->query("SELECT *
FROM
  `stu_details`
  INNER JOIN `stu_academic` ON (`stu_details`.`admn_no` = `stu_academic`.`id`)
  INNER JOIN `user_details` ON (`stu_academic`.`id` = `user_details`.`id`)
  INNER JOIN `stu_sem_reg_form` ON (`stu_academic`.`id` = `stu_sem_reg_form`.`admission_id`)
  INNER JOIN `stu_sem_reg_fee` ON (`stu_sem_reg_form`.`sem_form_id` = `stu_sem_reg_fee`.`form_id`)
WHERE
  `stu_sem_reg_form`.`admission_id` = '".$id."' and  `stu_sem_reg_form`.`sem_form_id` ='".$fid."'");
			if($query->num_rows() > 0){ 
					return $query->result();
			}else return false;
	}
	
	public function udate_hod($form,$stu_id,$data){
			$this->db->update($this->sem_form, $data, array('sem_form_id' => $form,'admission_id'=>$stu_id));
			return true;
		}
		
		public function udateCBStatus($form,$data){
			$this->db->update($this->Cbranch, $data, array('sem_form_id' => $form));
			return true;
		}
	
		public function udateCourseBranch($stu_id,$data){
			$this->db->update($this->stu_acdamic, $data, array('id'=>$stu_id));
			return true;
		}
		
		public function udateDept($stu_id,$data){
			$this->db->update($this->sem_form, $data, array('id'=>$stu_id));
			return true;
		}
		
	public function formrResponse($stid,$sem){
		$query = $this->db->select_max('sem_form_id')->get_where($this->sem_form,array('admission_id'=>$stid,'semster'=>$sem))->result();
		
			$q =$this->db->get_where($this->sem_form,array('admission_id'=>$stid,'semster'=>$sem,'sem_form_id'=>$query[0]->sem_form_id));
			if($q->num_rows() > 0)
				return $q->result();
			
				return false;
		}
		
  public function getCourseById($id){
	  	return $this->db->select('name')->get_where('courses',array('id'=>$id))->row();
	  }
  
  public function getBranchById($id){
	 // echo $id; die();
	 	return $this->db->get_where($this->branches,array('id'=>$id))->row();
			
	  }
	
	public function getDepatmentById($id){
			return $this->db->select('name')->get_where('departments',array('id'=>$id))->row();
		}
		
  public function getApprovedFormByStudent($id){
	  	$query = $this->db->select('sem_form_id,semster')->get_where($this->sem_form,array('hod_status'=>'1','acdmic_status'=>'1','admission_id'=>$id));
		 
		if($query->num_rows() > 0){
			return $query->result_array();
			}
	  
	  }
	  
  public function getCbByfromId($id){
	  	$query = $this->db->get_where($this->Cbranch,array('sem_form_id'=>$id));
	  		
	  	if($query->num_rows() > 0){
	  		return $query->result_array();
	  	}
	  	 
	  }
	  
	  
	
			
}
?>