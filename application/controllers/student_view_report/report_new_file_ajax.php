<?php 

class Report_new_file_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	
	
	
	public function get_dept()
	{
		$this->load->model('student_view_report/report_model','',TRUE);
		$result = $this->report_model->get_depts();
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_report_department_name',$data);
		
		/*$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($type);
		$data['result'] = $result;
		$this->load->view('student/send_new_file/send_new_file_department_name',$data);
		*/
	}
	public function get_course()
	{
		
		
		$this->load->model('student_view_report/report_model','',TRUE);
		$result = $this->report_model->get_course();
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_report_course_name',$data);
				
	}
	public function get_branch()
	{
		$this->load->model('student_view_report/report_model','',TRUE);
		$result = $this->report_model->get_branch();
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_report_branch_name',$data);
	}
	public function get_state()
	{
			$this->load->model('student_view_report/states_model','',TRUE);
			$data['states']=$this->states_model->get_all_states();
		
		$this->load->model('states_model','',TRUE);
		$result = $this->states_model->get_all_states();
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_state_name',$data);
	}
	public function get_course_dept($dept_id)
	{
		
		
		$this->load->model('student_view_report/report_model','',TRUE);
		$result = $this->report_model->get_course_bydept($dept_id);
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_report_course_name',$data);
				
	}
	
	public function get_branch_bycourse($course,$dept)
	{
		$this->load->model('student_view_report/report_model','',TRUE);
		$result = $this->report_model->get_branch_bycourse($course,$dept);
		$data['result'] = $result;
		$this->load->view('student_view_report/send_new_file/send_report_branch_name',$data);
	}



	


	
	
	
}