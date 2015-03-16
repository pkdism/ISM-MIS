<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Offer_minor_home extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('hod'));
		
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

		if(date('m') >= 7 && date('m') <=12)
			$curr_session = (intval(date('Y'))+1);
		else
			$curr_session = (intval(date('Y')));
			
		$data['curr_session'] = $curr_session;
		
		$this->drawHeader();
		$this->load->view('course_structure/offer_minor_home',$data);
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