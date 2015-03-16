<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Delete extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/delete.js");
		$this->load->model('course_structure/basic_model','',TRUE);
	}

	public function index($error='')
	{
		$data = array();
		$data["result_course"] = $this->basic_model->get_course();
		$data["result_branch"] = $this->basic_model->get_branches();	
		$this->drawHeader("Delete Course or Branch");
		$this->load->view('course_structure/delete',$data);
		$this->drawFooter();
	}
	
	public function json_delete_course($course = '')
	{
		if($course != '')
		{
			$this->output->set_content_type('application/json');
			$this->output->set_output(json_encode($this->basic_model->delete_course($course)));	
		}
		
	}
	public function json_get_course()
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->basic_model->get_course()));	
	}
	public function json_delete_branch($branch)
	{
		if($branch != '')
		{
			$this->output->set_content_type('application/json');
			//$this->output->set_output(json_encode(array("hello"=>"hii")));	
			$this->output->set_output(json_encode($this->basic_model->delete_branch($branch)));	
		}
		
	}
	
	public function json_get_branch()
	{
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->basic_model->get_branches()));	
	}
}
?>