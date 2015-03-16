<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Close_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS ("file_tracking/file_tracking_script.js");
		//$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index($file_id)
	{
		$emp_id = $this->session->userdata('id');

//		$this->load->model ('file_tracking/file_move_details');
//		$res = $this->file_move_details->get_pending_files ($emp_id);
//		$data = array (
//						'res' => $res,
//					  	'file_id' => $file_id
//					  );

//		$this->load->view('file_tracking/close_file/close_file',$data);


		$this->load->model ('file_tracking/file_details');
		$track_num = $this->file_details->get_track_num ($file_id);

		$res = $this->file_details->get_file_details ($track_num);
//		$res->row()->file_subject = urldecode($res->row()->file_subject);
		$data = array (
						'file_id' => $file_id,
						'res' => $res
					  );
		$this->drawHeader ("Close File");
		$this->load->view('file_tracking/close_file/file_details',$data);
		$this->drawFooter ();
	}
	public function insert_close_details ($file_id)
	{
		$emp_id = $this->session->userdata('id');

		$this->load->model ('file_tracking/file_details');
		$this->load->model ('file_tracking/file_move_details');

		$track_num = $this->file_details->get_track_num ($file_id);
		$this->file_details->insert_close_details ($file_id, $emp_id);
		$this->file_move_details->change_forward_status ($track_num);

		$this->session->set_flashdata('flashSuccess','File has been closed.');
		redirect('home');
	}
}
