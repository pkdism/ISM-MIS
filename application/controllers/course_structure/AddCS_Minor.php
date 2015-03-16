<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AddCS_Minor extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$data['result_dept'] = $this->basic_model->get_depts();
		$this->drawHeader("Add a Course Structure for Minor");
		$this->load->view('course_structure/addCS_Minor',$data);
		$this->drawFooter();
	}
	
	public function EnterNumberOfSubjects()
	{
		if($this->input->post() == false)
			redirect("course_structure/AddCS_Minor");
			
		$dept= $this->input->post("dept");
		$course= "minor";
		$branch= "minor";
		$session= $this->input->post('session');
		$sem=$this->input->post('semester');		
		
		//make semester equal to semester_group;
		$aggr_id= $course.'_'.$branch.'_'.$session;
		
		$result_course_branch = $this->basic_model->select_course_branch($course,$branch);
		
		$dept_course['course_branch_id'] = $result_course_branch[0]->course_branch_id;
		$dept_course['dept_id'] = $dept;
		$dept_course['aggr_id'] = $aggr_id;
		$dept_course['date'] = date("Y-m-d");
		
		//if this is new BOCS then first add its aggr_id to dept_courses .
		if($this->basic_model->count_dept_course_by_aggr_id($aggr_id) == 0)
		{
			$this->basic_model->insert_dept_course($dept_course);
		}
		//die("inserted successfully");
		//if CS already exisit for this semester then show error.
		if($this->basic_model->get_subjects_by_sem($sem,$aggr_id))
		{
			$this->session->set_flashdata("flashError","Course Structure already exist.Please Delete course structure first and then 
			add new.");
			redirect("course_structure/AddCS_Honour");
		}
			
		
		$row_course = $this->basic_model->get_course_details_by_id($course);
		$row_branch = $this->basic_model->get_branch_details_by_id($branch);
		
		$data["CS_session"]['duration']=$row_course[0]->duration;
		$data["CS_session"]['sem']=$sem;
		$data["CS_session"]['aggr_id'] = trim($aggr_id);
		
		$data["CS_session"]['course_name']=$row_course[0]->name;
		$data["CS_session"]['branch']=$row_branch[0]->name;
		$data["CS_session"]['session']=$session;
		$this->session->set_userdata($data);
		
		$this->drawHeader("Enter the number of core and elective subjects");
		$this->load->view('course_structure/count',$data);
		$this->drawFooter();
	}
}
?>