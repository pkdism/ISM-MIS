<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pending_files extends MY_Controller{

	function __construct(){

		parent::__construct(array('emp','deo'));
		$this->addJS("file_tracking/file_tracking_script.js");
		//$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
		$emp_id = $this->session->userdata('id');

		$this->load->model('file_tracking/file_move_details');
		$res = $this->file_move_details->get_pending_files($emp_id);
		foreach($res->result() as $row)
		{
//			$row->file_no;
			$row->file_subject = urldecode($row->file_subject);
		}
		$data['res'] = $res;

		$this->drawHeader ("Pending Files");
		$this->load->view('file_tracking/pending_files/pending_files',$data);
		$this->drawFooter ();
	}
}
