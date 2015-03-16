<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));

		$this->addJS("student_view_report/stu_report_file.js");
		
	}
	//Ajax//
	public function get_admissionno()
	{
		$this->load->model('student_view_report/report_model','',TRUE);
		$this->report_model->get_admn_no();
		
			
	}
	//Ajax//	
	public function index()
	{
		
		$this->load->model('student_view_report/report_model','',TRUE);
		$data['academic_departments']=$this->report_model->get_depts();
		
		//calling view
		$this->drawHeader("Student Report");
		$this->load->view('student_view_report/report/index',$data);
		$this->drawFooter();

		
		
		
	}
	public function show_report()
	{
		$dept_nm = $this->input->post('department_name');
		$course_nm = $this->input->post('course');
		$branch_nm = $this->input->post('branch');
		$sem_nm = $this->input->post('semester');
		$state_nm = $this->input->post('state');
		$marks = $this->input->post('marks');
		$op_type = $this->input->post('opmarks');
		$category = $this->input->post('category');
		$bgroup = $this->input->post('bgroup');
		$year = $this->input->post('year');
		
		
		$data=array();
		
		$this->load->model('student_view_report/Stu_Report_details_model','',TRUE);
		$data['show_details']=$this->Stu_Report_details_model->getData($dept_nm,$course_nm,$branch_nm,$sem_nm,$state_nm,$marks,$op_type,$category,$bgroup,$year );
		
		
		
		// Calling View*********
			
		$this->drawHeader("Student Report");
		
 		$this->load->view('student_view_report/report/show_data',$data);
		$this->drawFooter();
			
	}
	
	
		function viewtest($admn_no)
	{
	
		if($admn_no)
		{
		 
				$this->addJS('student_view_report/print_script.js');

		 $data['admn_no'] = $admn_no;
	
	

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_education_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('student/student_type_model','',TRUE);
		$this->load->model('student_view_report/get_cb','',TRUE);
		$this->load->model('student_view_report/student_typeugpg_model','',TRUE);
		

		$data['user_details']=$this->user_details_model->getUserById($admn_no);
		$data['stu_other_details']=$this->student_other_details_model->get_student_other_details_by_id($admn_no);
		$data['student_fee_details']=$this->student_fee_details_model->get_stu_fee_details_by_id($admn_no);
		$data['user_other_details']=$this->user_other_details_model->getUserById($admn_no);
		$data['student_details']=$this->student_details_model->get_student_details_by_id($admn_no);
		$data['permanent_address']=$this->user_address_model->getAddrById($admn_no,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($admn_no,'present');
		$data['cross_address']=$this->user_address_model->getAddrById($admn_no,'correspondence');
		$data['stu_education_details'] = $this->student_education_details_model->getStuEduById($admn_no);
		$data['student_academic']=$this->student_academic_model->get_stu_academic_details_by_id($admn_no);
		
		
					
		
		//$this->drawHeader("View Student Details");
			
		
			if(is_object($data['user_details']))
			{
				$this->load->view('student_view_report/view/view_header',array('admn_no'=>$data['user_details']->id));
				$this->load->view('student_view_report/view/profile_pic',$data);
				$this->load->view('student_view_report/view/stud_details',$data);
				
				
			
				$this->drawFooter();
			}
			else
		{
       
             echo '<center><h2>Not Found","Your details have not been updated. Please check after some time</h2></center>';
           
		
		}
			
		}
		else
		{
       
            echo '<center><h2>Not Found","Your details have not been updated. Please check after some time</h2>';
		
		}
		
		
	}
}
