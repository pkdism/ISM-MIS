<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Send_running_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
//		$this->addJS("file_tracking/file_tracking_script.js");
		$this->addJS("file_tracking/send_file.js");
		//$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index($file_id,$file_sub,$sent_by_emp_id)
	{
		$emp_id = $this->session->userdata('id');

		$this->load->model("file_tracking/file_details");
		$query = $this->file_details->get_file_num($file_id);
//		$data['emp_id'] = $emp_id;
//		$data['department'] = $this->file_details->get_department_by_id();
		foreach ($query->result() as $row)
				$file_no = $row->file_no;
		$data['file_no'] = $file_no;
		$data['file_id'] = $file_id;
		$data['file_sub'] = urldecode($file_sub);
		$data['sent_by_emp_id'] = $sent_by_emp_id;

		$this->drawHeader ("Send Running File");
		$this->load->view('file_tracking/send_running_file/send_running_file',$data);
		$this->drawFooter ();
	}
}
