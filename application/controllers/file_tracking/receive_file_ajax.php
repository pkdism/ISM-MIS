<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receive_file_ajax extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
	}

	public function index()
	{
	}
	public function send_details ($file_id, $track_num)
	{
		$emp_id = $this->session->userdata('id');
		
		$this->load->model ('file_tracking/file_details', '', TRUE);
		$track_no = $this->file_details->get_track_num ($file_id);
		$verify = 0;
		if ($track_num == $track_no)
		{
			$this->load->model('file_tracking/file_move_details', '', TRUE);
			$this->file_move_details->change_rcvd_timestamp ($track_num);
			$this->load->model('file_tracking/user_notifications', '', TRUE);
			$this->user_notifications->set_rec_date ($file_id, $emp_id);
			$verify = 1;
		}
		$data = array (
						'verify' => $verify
					  );
		$this->load->view('file_tracking/receive_file/track_num_notification',$data);
	}
}
