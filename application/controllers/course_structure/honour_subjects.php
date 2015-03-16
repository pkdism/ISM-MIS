<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Honour_subjects extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));;
		$this->load->model('course_structure/basic_model','',TRUE);
		$this->load->model('course_structure/offer_elective_model','',TRUE);
	}

	public function index($error='')
	{
		if($this->input->post() == false)
			redirect("course_structure/offer_honour_home");
			
		$data = array();
		$course = "honour";
		$branch = "honour";
		$batch = $this->input->post('session');
		$semester = $this->input->post('sem');
		
		$result_course_details = $this->basic_model->get_course_details_by_id($course);
		$duration = $result_course_details[0]->duration;
		
		$expected_aggr_id = $course."_".$branch."_".($batch-$duration)."_".($batch-$duration+1);
		
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_aggr_id))
		{
			$result_aggr_id = $this->basic_model->get_latest_aggr_id($course,$branch,$expected_aggr_id);
			$aggr_id = $result_aggr_id[0]->aggr_id;	
		}	
		else
			$aggr_id = $expected_aggr_id;
		
		$data['course'] = $course;
		$data['branch'] = $branch;
		$data['batch'] = $batch;
		$data['semester'] = $semester;
		$data['aggr_id'] = $aggr_id;
		
		$subject_details = $this->basic_model->select_all_honour_or_minor_subject_by_aggr_id_and_semester($aggr_id,$semester,$course,$branch);
		$data['subject_details'] = $subject_details;
		
		//show the list of already selected elective ..
		$already_selected_honour = $this->basic_model->select_honour_or_minor_offered_by_aggr_id($aggr_id,$semester);	
		
		foreach($already_selected_honour as $row)
			$data['subject'][$row->id]['selected'] = 1;	
		
			
		$this->session->set_userdata('aggr_id',$aggr_id);
		$this->session->set_userdata('semester',$semester);
		$this->session->set_userdata($data);
		$this->drawHeader();
		$this->load->view('course_structure/honour_subjects',$data);
		$this->drawFooter();
	}
	
	public function CreateMapping()
	{
		$formValues = $this->input->post('checkbox');
		$aggr_id = $this->session->userdata('aggr_id');
		$semester = $this->session->userdata('semester');
		//delete all elective offered for this batch and semester.
		$result_del = $this->basic_model->delete_honour_or_minor_offered($aggr_id,$semester);
		if($result_del)
		{
			foreach($formValues as $key=>$val)
			{
				$data['aggr_id'] = $aggr_id;
				$data['id'] = $val;
				if(!$this->basic_model->select_honour_or_minor_offered($data['aggr_id'],$data['id']))
				{
					$this->basic_model->insert_honour_or_minor_offered($data);
				}
					
			}
			$this->session->set_flashdata("flashSuccess","Honour Subjects Added Successfully");
			redirect("course_structure/offer_honour_home");
		}
		else
		{
			
			$this->session->set_flashdata("flashError","Error in database Operation.Please try after some time.");
			//redirect("course_structure/elective_offered_home");	
		}	
	}
}
?>