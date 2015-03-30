<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Departmentwise extends MY_Controller {
	
		function __construct(){
			parent::__construct(array('hod','ttc'));
			
			$this->load->model('subject_mapping/mapping');
			}
			
		function index(){
			
			$data=array();
			$data['status']='';
			
			if($this->input->post('course') && $this->input->post('branch') && $this->input->post('semester')){
				$this->load->model('course_structure/basic_model',"",TRUE);
				$agr=$this->input->post('course')."_".$this->input->post('branch')."_".(date('Y')-1)."_".(date('Y'));
				// Get Letest Aggrigate Id//
				$Lagr=$this->basic_model->get_latest_aggr_id($this->input->post('course'),$this->input->post('branch'),$agr);
				//print_r($Lagr); die;
					
				$data['subject']=$this->basic_model->get_subjects_by_sem($this->input->post('semester'),$Lagr[0]->aggr_id);
			
			}
				
				
			if($this->input->post('course'))
				$data['status']=$this->mapping->checkExisting($this->input->post('course'),$this->input->post('branch'),$this->input->post('semester'));
				
			
			$this->drawHeader("Subject Mapping");
			$this->load->view('subject_mapping/deptindex',$data);
			$this->drawFooter();
		}
}
?>