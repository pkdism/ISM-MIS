<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Register_complaint extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
		$this->addJS ("complaint/get_residence_address.js");
	}

	public function index()
	{
//		$this->load->model("file_tracking/file_details");

//		$data['department'] = $this->file_details->get_department_by_id();

		$this->drawHeader ("Register your Complaint");
		$this->load->view('complaint/register_complaint');
		$this->drawFooter ();
	}
	public function insert ()
	{
		$type = $this->input->post('type');
     	$location = $this->input->post('location');
		$location_details = $this->input->post('locationDetails');
		$pref_time = $this->input->post('time');
		$problem_details = $this->input->post('problemDetails');
		
		$user_id = $this->session->userdata('id');
		$complaint_id = time();
		$complaint_id = $type."_".$complaint_id.$user_id;
		$data = array(
				'user_id' => $user_id,
				'type' => $type,
				'location'=> $location,
				'location_details' => $location_details, 
				'problem_details' => $problem_details,	  
				'pref_time' => $pref_time,	  
				'complaint_id' => $complaint_id	  
					  );
		
		$this->load->model ('complaint/complaints', '', TRUE);
		$this->complaints->insert($data);

		$this->session->set_flashdata('flashSuccess','Complaint successfully Registered. Your Complaint ID : '.$complaint_id.' .');
		redirect('home');
	}
}