<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approve_reject_forms extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod'));
		
	}
	
	function index()
	{
		$this->load->model('sah/sah_model');
		$data['applications'] = $this->sah_model->get_all_applications_to_approve_reject($this->session->userdata('dept_id'));
		
		$this->drawHeader('Senior Academic Hostel Management');
		if(count($data['applications']) == 0)
			$this->load->view('sah/hod_null_list');
		else
			$this->load->view('sah/approve_reject_forms',$data);
		$this->drawFooter();
	}
}
