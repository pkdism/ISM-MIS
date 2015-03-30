<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regular_check extends MY_Controller
{		
		function __construct()
			{
				parent::__construct(array('hod'));
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
			}
	
	function index(){
		
		
		$results['data']=$this->sbasic_model->hod_vaise_student($this->session->userdata('dept_id'));
			
			//Importent for table search view JS//
		
		$this->drawHeader('Semester form from '.$this->session->userdata('dept_id').' Department');
		$this->load->view('student_sem_form/department/department.php',$results);
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
				// Elective Subject
				$data['confirm']=$this->get_subject->getConfirm($data['student'][0]->form_id);
				//Change Branch
				$data['CB']= $this->sbasic_model->getCbByfromId($data['student'][0]->form_id);
				$this->load->view('templates/header_assets');
				if($p==1){
						$this->load->helper(array('dompdf', 'file'));
						//$html.=	$this->load->view('templates/header_assets');
						$html= $this->load->view('student_sem_form/department/view1.php',$data,TRUE);
						pdf_create($html, 'Regform_'.$data['student'][0]->admn_no);
					}else{
				
				$this->load->view('student_sem_form/department/view.php',$data);
					}
			}
	}
	
	function updatehod(){
			if($this->input->post('hods')){
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				$data['hod_status'] = $this->input->post('hods');
				$data['hod_remark'] = $this->input->post('hodRemark');
				
				if($this->input->post('hods') ==2){
					$data['re_id'] = rand(999012,12345678);
					}
				$data['hod_time'] = date('Y-m-d H:i:s');
				$this->sbasic_model->udate_hod($this->input->post('formId'),$this->input->post('stuId'),$data);	
				redirect('/student_sem_form/regular_check', 'refresh');
			}
			
		}
}