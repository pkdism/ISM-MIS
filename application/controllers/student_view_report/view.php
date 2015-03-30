<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('stu','deo','emp'));
	}


	public function index($admn_no = '')
	{
		if($this->authorization->is_auth('deo'))
		{
			

				$this->drawHeader("View Student");
				$this->load->view('student_view_report/view/index');
				$this->drawFooter();
				
		}
		else if($this->authorization->is_auth('stu'))
		{
			if($admn_no !='')
				$this->_load_view($admn_no,0);
						
			else
				$this->_load_view($this->session->userdata('id'),$admn_no);
		}
		else if($this->authorization->is_auth('emp'))
		{
				$this->drawHeader("View Student");
				$this->load->view('student_view_report/view/index');
				$this->drawFooter();
				
		}
			
	}

	function view_form()
	{
		
		
		if(!$this->authorization->is_auth('deo') && !$this->authorization->is_auth('emp'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('student_view_report/view');
			return;
		}
		
		$admn_no = $this->input->post('admn_no');
		$admn_no=trim($admn_no);
		
						
	


		if($admn_no != '')
		{
			$this->session->set_userdata('VIEW_STUDENT_ID',$admn_no);

		}

		if($admn_no == "" && !$this->session->userdata('VIEW_STUDENT_ID'))
		{
			$this->session->set_flashdata('flashError','No Student selected.');
			redirect('student_view_report/view');
			return;
		}
		$admn_no = $this->session->userdata('VIEW_STUDENT_ID',$admn_no);


	
		$this->_load_view($admn_no);
	}

	
	public function _load_view($admn_no)
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
			
			$this->drawHeader("View Student Details");
			
		
			if(is_object($data['user_details']))
			{
				$this->load->view('student_view_report/view/view_header',array('admn_no'=>$data['user_details']->id));
				$this->load->view('student_view_report/view/profile_pic',$data);
				$this->load->view('student_view_report/view/stud_details',$data);
				$this->drawFooter();
			}
			else
			{
	       
	            $data=array('1'=>'error');
				$this->load->view('student_view_report/view/stud_details',$data);
				
			
			}
			
			
		}
		else
		{
       
            echo '<center><h2>Not Found","Your details have not been updated. Please check after some time</h2>';
		
		}
		
		
	}
}
