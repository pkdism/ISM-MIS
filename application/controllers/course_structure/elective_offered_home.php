<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elective_offered_home extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		
		$this->addJS("course_structure/elective_offered.js");
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		
		$data = array();
		$userid = $this->session->userdata("id");
		$data['userid'] = $userid;
		
		$dept = $this->basic_model->Select_Department_By_User_ID($userid);
		$dept_id = $dept[0]->dept_id;
		
		$data['dept_id'] = $dept_id;
		
		
		$data['result_course'] = $this->basic_model->get_course_offered_by_dept($dept_id);
		$result_course = $data['result_course'];
		
		
		//$data['result_course'] = $this->basic_model->get_course_offered_by_dept($dept_id);
		//$result_course = $data['result_course'];
		
		if(date('m') >= 7 && date('m') <=12)
			$curr_session = (substr(date('Y'),2,3)+1);
		else
			$curr_session = (substr(date('Y'),2,3));
			
		$data['curr_session'] = $curr_session;
		
		$i = 0;
		$j=0;
		$data['aggr_id'] = array();
		$data['course'] = array();
		$data['course']['name'] = array();
		$data['course']['duration'] = array();
		$data['course']['id'] = array();
		/*
		foreach($result_dept_course as $row)
		{
			$aggr_id_array = explode('_',$row->aggr_id);
			$course_id = $aggr_id_array[0];
			$branch_id = $aggr_id_array[1];
			$session = $aggr_id_array[3];
			
			$data['course_detail'] = $this->basic_model->get_course_details_by_id($course_id);
			$result_course_detail = $data['course_detail'];
			
			if(($curr_session - $session) <= $result_course_detail[0]->duration)
			{
				if(!in_array($aggr_id_array[0],$data['course']['id']))
				{
					$data['course']['id'][$j] = $result_course_detail[0]->id;
					$data['course']['name'][$j] = $result_course_detail[0]->name;
					$data['course']['duration'][$j] = $result_course_detail[0]->duration;
					$j++;
				}
			}
		}
		*/
		$this->drawHeader();
		$this->load->view('course_structure/elective_offered_home',$data);
		$this->drawFooter();
	}	

	public function json_get_branch($course =''){
		//The brlow gets the course that the user selected
		if($course!=''){
			$data = array();
			$userid = $this->session->userdata("id");		
			
			$dept = $this->basic_model->Select_Department_By_User_ID($userid);
			$dept_id = $dept[0]->dept_id;
			
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($this->basic_model->get_branches_by_course_and_dept($course,$dept_id)));
		}
	}
}
?>