<?php 

class Receive_file extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS ("file_tracking/validate_track_num.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}
	public function index()
	{
		$emp_id = $this->session->userdata('id');
		
		$this->load->model('file_tracking/user_notifications');
		$res = $this->user_notifications->get_user_notifications ($emp_id);
		foreach($res->result() as $row)
		{
			$row->description = urldecode($row->description);
		}
		$data = array (
						'res' => $res
					  );
		$this->drawHeader ("Receive File");
		$this->load->view('file_tracking/receive_file/notifications', $data);
		$this->drawFooter ();
	}
	public function validate_track_num ($file_id)
	{
		$data = array (
						'file_id' => $file_id
					  );
		$this->drawHeader ("Track Number Validation");
		$this->load->view('file_tracking/receive_file/validate_track_num',$data);
		$this->drawFooter ();
	}
}
