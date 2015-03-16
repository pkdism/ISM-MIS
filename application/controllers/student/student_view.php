<?php

class Student_view extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo','stu'));
	}

	public function index()
	{
		if($this->authorization->is_auth('deo'))
		{
			//$this->load->model('student/student_details_model','',TRUE);
			//$data['all_stu_id'] = $this->student_details_model->get_all_student_id();

			//$this->load->model('departments_model','',TRUE);
			//$data['departments'] = $this->departments_model->get_departments();

			$this->drawHeader('View Student Details');
			$this->load->view('student/view/student_view_index');
			$this->drawFooter();
		}
		else
		{
			$this->load_view($this->session->userdata('id'));
		}
	}

	function load_view($stu_id)
	{
	}
}

?>