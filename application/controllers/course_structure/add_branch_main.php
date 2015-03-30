<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_branch_main extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		
		$this->addJS("course_structure/add.js");	
		$this->load->library('session');
		$this->load->model('course_structure/basic_model_main','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
		$data['result_course'] = $this->basic_model_main->get_course();
		$data['result_dept'] = $this->basic_model_main->get_depts();	
    	$this->drawHeader("Add or Map a Branch with Course");
		$this->load->view('course_structure/add_branch_main',$data);
		$this->drawFooter();
	}
  
  public function add()
  {
    $special = "/[^A-Za-z0-9\-]/";
	
	$branch_id = $this->input->post("branch_id");
	$branch_name = $this->input->post("branch_name");
	$dept = $this->input->post("dept");	
	$course_id = $this->input->post("course");
	$year = $this->input->post("year");
	
   	 
	$branch_id = preg_replace($special,"",$branch_id);
	$branch_id = strtolower(trim($branch_id));
	
	$result_course_branch = $this->basic_model_main->select_course_branch($course_id,$branch_id);
	
	if($result_course_branch)
		$course_branch_details['course_branch_id'] = $result_course_branch[0]->course_branch_id;
	else
		$course_branch_details['course_branch_id'] = uniqid();
	
	$course_branch_details['course_id'] = $course_id;
	$course_branch_details['branch_id'] = $branch_id;
	$course_branch_details['year_starting'] = $year;
	$course_branch_details['year_ending'] = 0;
	
	$branch_details['id'] = $branch_id;	
	$branch_details['name'] = $branch_name;
	
	
	$aggr_id = $course_id."_".$branch_id."_".$year;
	
	$dept_course_details['course_branch_id'] = $course_branch_details['course_branch_id'];
	$dept_course_details['dept_id'] = $dept;
	$dept_course_details['aggr_id'] = $aggr_id;
	$dept_course_details['date'] = date('Y-m-d');

	
    $result_branch = $this->basic_model_main->get_branch_details_by_id($branch_details['id']);
	
	if(!$result_branch)	//if branch does not exist then insert it first.
	{
		$result_insert_branch = $this->basic_model_main->insert_branch($branch_details);
		if($result_insert_branch)
		{
			$result_course_branch = $this->basic_model_main->insert_course_branch($course_branch_details);
			if($result_course_branch)
			{
				$result_dept_course = $this->basic_model_main->insert_dept_course($dept_course_details);
				if($result_dept_course)
					$this->session->set_flashdata("flashSuccess","Branch added and mapping done successfully.");
				else
						$this->session->set_flashdata("flashError","Error in mapping department.");
			}
				
			else
				$this->session->set_flashdata("flashError","Error in Mapping Branch.");	
				$result_insert_overall = true;	
		}
		else
			$this->session->set_flashdata("flashError","Error in Adding Branch.");
	}
	else
	{
		if(!$this->basic_model_main->select_course_branch($course_branch_details['course_id'],$course_branch_details['branch_id']))
		{
			$result_course_branch = $this->basic_model_main->insert_course_branch($course_branch_details);
		
			if($result_course_branch)
			{
				$result_dept_course = $this->basic_model_main->insert_dept_course($dept_course_details);
				if($result_dept_course)
					$this->session->set_flashdata("flashSuccess","Mapping done successfully.");	
				else
						$this->session->set_flashdata("flashError","Error in mapping department.");	
			}
			else
				$this->session->set_flashdata("flashError","Error in Mapping Branch.");		
		}
		else
		{
			$result_dept_course = $this->basic_model_main->insert_dept_course($dept_course_details);
				if($result_dept_course)
					$this->session->set_flashdata("flashSuccess","Mapping done successfully.");	
				else
					$this->session->set_flashdata("flashError","Error in mapping department.");		
					
			//$this->session->set_flashdata("flashError","Mapping Already Exist.");		
		}
			
		
	}
	
	
    redirect("course_structure/add_branch_main");
  }
}
?>