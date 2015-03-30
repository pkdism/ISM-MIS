<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elective_offered extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		$this->addJS("course_structure/add.js");
		$this->load->model('course_structure/basic_model','',TRUE);
		$this->load->model('course_structure/offer_elective_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$course = $this->input->post('course');
		$branch = $this->input->post('branch');
		$batch = $this->input->post('session');
		$semester = $this->input->post('sem');
		
		$result_course_details = $this->basic_model->get_course_details_by_id($course);
		$duration = $result_course_details[0]->duration;
		
		//since duration in case of honour and minor course will be 4 ie it is applicable to B.Tech only		
		if($course == "honour" || $course == "minor")
			$expected_aggr_id = $course."_".$branch."_".($batch-4)."_".($batch-4+1);	
		else
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
		
		
		if($course != "minor" && $course != "honour")
		{
			$subject_details = $this->basic_model->select_all_elective_subject_by_aggr_id_and_semester($aggr_id,$semester);
			$i =0;
			$j = 0;
			$data['group_id'] = array();
			$data['elective_count'] = 0;
			foreach($subject_details as $row)
			{
				$group_id = $row->elective;
				if(!in_array($group_id,$data['group_id']))
				{
					$data['group_id'][$j] = $group_id;
					$data['subjects'][$group_id]['number_of_options'] = substr($group_id,0,1);
					$group_details  = $this->basic_model->select_elective_group_by_group_id($group_id);
					$data['subject']['elective_name'][$j] = $group_details[0]->elective_name;					
					$data['elective_count']++;
					$data['subject'][$group_id]['count'] = 0;
					$i = 0;
					$j++;	
				}
				
				$data['subject'][$group_id]['id'][$i] = $row->id;
				$data['subject'][$group_id]['subject_id'][$i] = $row->subject_id;
				$data['subject'][$group_id]['subject_name'][$i] = $row->name;
				$data['subject'][$group_id]['lecture'][$i] = $row->lecture;
				$data['subject'][$group_id]['tutorial'][$i]= $row->tutorial;
				$data['subject'][$group_id]['practical'][$i]= $row->practical;
				$data['subject'][$group_id]['credit_hours'][$i]= $row->credit_hours;
				$data['subject'][$group_id]['contact_hours'][$i]= $row->contact_hours;
				$data['subject'][$group_id]['count']++;
				$i++;			
			}
			
			$already_selected_elective = $this->offer_elective_model->select_elective_offered_by_aggr_id($aggr_id,$semester,$batch);	
			foreach($already_selected_elective as $row)
				$data['subject'][$row->id]['selected'] = 1;	
		
		}
		else
		{
			$subject_details = $this->basic_model->select_all_honour_or_minor_subject_by_aggr_id_and_semester($aggr_id,$semester,$course,$branch);
			$i =0;
			
			$data['subject_details'] = $subject_details;
			$already_selected_honour = $this->offer_elective_model->select_elective_offered_by_aggr_id($aggr_id,$semester,$batch);	
			//$already_selected_honour = $this->basic_model->select_honour_or_minor_offered_by_aggr_id($aggr_id,$semester);	
		
			foreach($already_selected_honour as $row)
				$data['subject'][$row->id]['selected'] = 1;
		}
		
		
		
		$this->session->set_userdata('aggr_id',$aggr_id);
		$this->session->set_userdata('semester',$semester);
		$this->session->set_userdata('batch',$batch);
		$this->session->set_userdata('course',$course);
		
		$this->session->set_userdata($data);
		$this->drawHeader();
		$this->load->view('course_structure/LoadOfferedElective',$data);
		$this->drawFooter();
	}
	
	public function CreateMapping()
	{
		$formValues = $this->input->post('checkbox');
		$aggr_id = $this->session->userdata('aggr_id');
		$semester = $this->session->userdata('semester');
		$batch = $this->session->userdata('batch');
		$course = $this->session->userdata('course');
		//delete all elective offered for this batch and semester.
		$result_del = $this->offer_elective_model->delete_optional_subject_offered($aggr_id,$semester,$batch);
		if($result_del)
		{
			foreach($formValues as $key=>$val)
			{
				$data['aggr_id'] = $aggr_id;
				$data['id'] = $val;
				$data['batch'] = $batch;
				if(!$this->offer_elective_model->select_elective_offered($data['aggr_id'],$data['id'],$batch))
				{
					$this->offer_elective_model->insert_elective_offered($data);
				}
					
			}
			$this->session->set_flashdata("flashSuccess","Optional Subjects Added Successfully");
			redirect("course_structure/elective_offered_home");
		}
		else
		{
			
			$this->session->set_flashdata("flashError","Error in database Operation.Please try after some time.");
			//redirect("course_structure/elective_offered_home");	
		}
			
	}
}
?>