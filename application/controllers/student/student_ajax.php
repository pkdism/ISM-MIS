<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function update_branch($course = '',$dept = '')
	{
		//alert('horror');
		//var_dump($dept);
		if($course)
		{
			$this->load->model('course_structure/basic_model','',TRUE);
			$data['branches'] = $this->basic_model->get_branches_by_course_and_dept_for_student_reg($course,$dept);
			//$this->load->model('Branches_model','',TRUE);
			//$data['branches']=$this->Branches_model->get_branches_by_courses($course,$dept);
			//echo ('hello');
			$this->load->view('student/ajax/student_update_branches',$data);
		}
		else
		{
			$data['courses']='';
			$this->load->view('student/ajax/student_update_courses',$data);
		}
	}

	public function update_courses($dept = '')
	{
		$this->load->model('course_structure/basic_model','',TRUE);
		$data['courses'] = $this->basic_model->get_course_offered_by_dept_for_student_reg($dept);
		// $this->load->model('Courses_model','',TRUE);
		// $data['courses']=$this->Courses_model->get_courses_by_dept($dept);
		$this->load->view('student/ajax/student_update_courses',$data);
	}

	function check_if_user_exists($id = '')
	{
		if($id !== '')
		{
			$this->load->model('user/user_details_model','',TRUE);
			$data['user'] = $this->user_details_model->getUserById($id);
			if($data['user'])
				$this->load->view('student/ajax/student_update_user_id',$data);
		}
	}

	function check_if_rejected_user_exists($id = '')
	{
		if($id !== '')
		{
			$this->load->model('student/student_rejected_detail_model','',TRUE);
			$data['user'] = $this->student_rejected_detail_model->get_stu_status_details_by_id($id);
			if($data['user'])
				$this->load->view('student/ajax/student_update_user_id',$data);
		}
	}

	function check_if_user_for_validation_exists($id = '')
	{
		if($id !== '')
		{
			$this->load->model('student/student_details_to_approve','',TRUE);
			$data['user'] = $this->student_details_to_approve->get_all_stu_details_by_id($id);
			if($data['user'])
				$this->load->view('student/ajax/student_update_user_id',$data);
		}
	}
}
?>