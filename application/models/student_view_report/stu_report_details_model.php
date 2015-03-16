<?php

class Stu_Report_details_model extends CI_Model
{
	var $table = 'stu_details';

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	
	//*******************Department and Course************
	function getData($dept_nm,$course_nm,$branch_nm,$sem_nm,$state_nm,$marks,$op_type,$category,$bgroup,$year )
	{
		$sql= "SELECT stu_details.admn_no, user_details.first_name, user_details.middle_name, user_details.last_name, user_details.category, user_details.email, user_details.dept_id, user_other_details.mobile_no, stu_academic.course_id, stu_academic.branch_id, stu_academic.semester, user_address.state, stu_details.blood_group, stu_fee_details.payment_made_on
FROM ((((user_details INNER JOIN user_other_details ON user_details.id = user_other_details.id) INNER JOIN stu_academic ON user_details.id = stu_academic.id) INNER JOIN user_address ON user_details.id = user_address.id) INNER JOIN stu_details ON user_details.id = stu_details.admn_no) INNER JOIN stu_fee_details ON user_details.id = stu_fee_details.id  where 1=1
 ";
		
		
			
			if ($dept_nm)
			{
					$sql .= " AND user_details.dept_id='".$dept_nm."'";
			}
			if ($course_nm)
			{
					$sql .= " AND stu_academic.course_id='".$course_nm."'";
			}
			if ($branch_nm)
			{
					$sql .= " AND stu_academic.branch_id='".$branch_nm."'";
			}
			if ($sem_nm)
			{
					$sql .= " AND stu_academic.semester='".$sem_nm."'";
			}
			if ($state_nm)
			{
					$sql .= " AND user_address.state='".$state_nm."' And user_address.type='permanent'";
			}
			if ($category)
			{
					$sql .= " AND user_details.category='".$category."'";
			}
			if ($bgroup)
			{
					$sql .= " AND stu_details.blood_group='".$bgroup."'";
			}
			if ($year)
			{
					$sql .= " AND Year(stu_fee_details.payment_made_on)='".$year."'";
			}
			
			
			
			
			
			
			
			$query = $this->db->query("$sql group by stu_details.admn_no");

			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
		
	}
	
}
?>
