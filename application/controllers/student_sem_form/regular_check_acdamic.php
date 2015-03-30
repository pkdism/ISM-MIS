<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regular_check_acdamic extends MY_Controller
{		
		function __construct()
			{
				parent::__construct(array('arac'));
				$this->addJS("student_view_report/stu_report_file.js");
			}
	
	function index(){
		
		$this->load->model('student_sem_form/sbasic_model','',TRUE);
		//echo $this->input->post('department'); die();
			if($this->input->post('department')){
		$results['data']=$this->sbasic_model->acdamic_vaise_student($this->input->post('department'),$this->input->post('course'),$this->input->post('branch'),$this->input->post('semester'));
			}
			else{
				$results['data']=$this->sbasic_model->acdamic_vaise_student();
				}
			//Importent for table search view JS//
		$this->drawHeader('Semester form For Acdamic');
		$this->load->view('student_sem_form/department/department_acdamic',$results);
		$this->drawFooter();
		
	}
	function view($id,$fid,$p=0){
			
			if(isset($id)){
				
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				$this->load->model('student_sem_form/get_subject','',TRUE);
				$this->load->model('student_sem_form/get_results','',TRUE);
				$this->load->model('student_sem_form/get_carryover','',TRUE);
				$data['student']=$this->sbasic_model->hod_view_student($id,$fid);
				
				$data['subjects']=$this->get_subject->getSubject($data['student'][0]->course_id,$data['student'][0]->branch_id,($data['student'][0]->semester+1),$data['student'][0]->admission_id);
				
				$data['carryover']=$this->get_carryover->getCarryoverByformId($data['student'][0]->form_id);
				$data['confirm']=$this->get_subject->getConfirm($data['student'][0]->form_id);
				$data['CB']= $this->getCbByfromId($data['student'][0]->form_id);
				
				$this->load->view('templates/header_assets');
				if($p==1){
						$this->load->helper(array('dompdf', 'file'));
						//$html.=	$this->load->view('templates/header_assets');
						$html= $this->load->view('student_sem_form/department/view1.php',$data,TRUE);
						pdf_create($html, 'Regform_'.$data['student'][0]->admn_no);
					}else{
				
				$this->load->view('student_sem_form/department/view_acdmic.php',$data);
					}
			}
	}
	
	function updatehod(){
			if($this->input->post('hods')){
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				$data['acdmic_status'] = $this->input->post('hods');
				$data['acdmic_remark'] = $this->input->post('hodRemark');
				
				if($this->input->post('CBS') == 'Y'){
					//Student Acdamic Table Update
					$acd['course_id']=$this->input->post('course');
					$acd['branch_id']=$this->input->post('branch');
					$this->sbasic_model->udateCourseBranch($this->input->post('stuId'),$acd);
					// user Details Table Update
					$ud['dept_id']=$this->input->post('dept');
					$this->sbasic_model->udateDept($this->input->post('stuId'),$ud);
					// change Branch Table Update
					$cupdate['status']=$this->input->post('CBS'); 
					$cupdate['date']=date('Y-m-d');
					$cupdate['ip']=$this->input->ip_address();
					$cupdate['user_id']=$this->session->userdata('id');
					$this->sbasic_model->udateCBStatus($this->input->post('formId'),$data);
					
					
				}else if($this->input->post('CBS') == 'N'){
					
					// change Branch Table Update
					$cupdate['status']=$this->input->post('CBS');
					$cupdate['date']=date('Y-m-d');
					$cupdate['ip']=$this->input->ip_address();
					$cupdate['user_id']=$this->session->userdata('id');
					$this->sbasic_model->udateCBStatus($this->input->post('formId'),$data);
					
				}
				if($this->input->post('hods') ==2){
					$data['re_id'] = rand(999012,12345678);
					}
				$data['acdmic_time'] = date('Y-m-d H:i:s');
				$this->sbasic_model->udate_hod($this->input->post('formId'),$this->input->post('stuId'),$data);				redirect('/student_sem_form/regular_check', 'refresh');
			}
			
		}
}