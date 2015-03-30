<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_course extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/add.js");
		$this->addJS("course_structure/edit.js");
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data=array();
   		$this->drawHeader("Add new Course");
		$this->load->view('course_structure/add_course',$data);
		$this->drawFooter();
	}
	public function add()
    {
		$special = "/[^A-Za-z0-9\-]/";
		$course_details['id'] = $this->input->post("course_id");
		$course_details['id'] = preg_replace($special, "", $course_details['id']);
		$course_details['id'] = strtolower(trim($course_details['id']));
		//die($course_details['id']);
		
		$course_details['name'] = $this->input->post("course_name");
		$course_details['duration'] = $this->input->post("course_duration");
		$course_result = $this->basic_model->get_course_details_by_id($course_details['id']);
		if(!$course_result)
			$result = $this->basic_model->insert_course($course_details);
		else
			$result = false;
			
		if($result)
			$this->session->set_flashdata("flashSuccess","Course added successfully");
		else
			$this->session->set_flashdata("flashError","Error in adding Course.This Course ID Already Exist.");
			
		redirect("course_structure/add_course");
	  }
}
?>