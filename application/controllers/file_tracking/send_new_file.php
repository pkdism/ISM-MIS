<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Send_new_file extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
		$this->addJS ("file_tracking/send_file.js");
		//$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
		$this->load->model("file_tracking/file_details");

		$data['department'] = $this->file_details->get_department_by_id();

		$this->drawHeader ("Send New File");
		$this->load->view('file_tracking/send_new_file/send_new_file',$data);
		$this->drawFooter ();
	}
	public function insert_file_details ()
	{
		$file_no = $this->input->post('file_no');
		$file_sub = $this->input->post('file_sub');
		$rcvd_emp_id = $this->input->post('emp_name');
		$remarks = $this->input->post('remarks');

		if ($file_no == "")
			$file_no = "NULL";
		if ($remarks == "")
			$remarks = "No Comments";

//		echo $file_no." ".$file_sub." ".$rcvd_emp_id." ".$remarks."<br/>";
		$emp_id = $this->session->userdata('id');
		$track_num = time();
		$data = array(
				'file_no' => $file_no,
				'file_subject' => $file_sub ,
				'track_num'=> $track_num ,
				'start_emp_id' => $emp_id
					  );

		$this->load->model ('file_tracking/file_details', '', TRUE);
		$this->file_details->insert($data);

		if ($file_no == "NULL")
			$description = $file_sub." (File No. not yet generated) ";
		else
			$description = $file_sub." (".$file_no.") ";

		$file_id = $this->file_details->get_file_id ($track_num);
		$this->insert_file_move_details ($file_id, $track_num, $rcvd_emp_id,$remarks,$description);
	}
	public function insert_move_details_main ($file_id)
	{
		$rcvd_emp_id = $this->input->post('emp_name');
		$this->insert_move_details ($file_id, $rcvd_emp_id);
	}
	public function insert_move_details ($file_id, $rcvd_emp_id)
	{
		$file_no = $this->input->post('file_no');
		$remarks = $this->input->post('remarks');

		if ($file_no == "")
			$file_no = "NULL";
		if ($remarks == "")
			$remarks = "No Comments";

		$this->load->model ('file_tracking/file_details', '', TRUE);
		$track_num = $this->file_details->get_track_num ($file_id);

		$query = $this->file_details->get_file_num($file_id);
		foreach ($query->result() as $row)
				$file_no_db = $row->file_no;
		if (!$file_no_db)
		{
			if ($file_no!="NULL")
				$this->file_details->insert_file_num($file_no, $file_id);
		}

		$res = $this->file_details->get_file_details ($track_num);
		foreach ($res->result() as $row)
		{
			$file_subject = $row->file_subject;
		}

		if ($file_no == "NULL")
			$description = $file_subject." (File No. not yet generated) ";
		else
			$description = $file_subject." (".$file_no.") ";

		$this->load->model ('file_tracking/file_move_details', '', TRUE);
   		$this->file_move_details->change_forward_status ($track_num);

		$this->insert_file_move_details ($file_id, $track_num, $rcvd_emp_id, $remarks, $description);
	}
	public function insert_file_move_details ($file_id, $track_num, $rcvd_emp_id, $remarks, $description)
	{
		$emp_id = $this->session->userdata('id');
		$data_arr = array (
			'file_id' => $file_id,
			'track_num' => $track_num,
			'sent_by_emp_id' => $emp_id,
			'sent_timestamp' => '',
			'rcvd_by_emp_id' => $rcvd_emp_id,
			'rcvd_timestamp' => '',
			'forward_status' => 0,
			'remarks' => $remarks
				);

		$this->load->model ('file_tracking/file_move_details', '', TRUE);
		$this->file_move_details->insert ($data_arr);

		$this->notification->notify ($rcvd_emp_id, "emp", "Receive a File",$description, "file_tracking/receive_file/validate_track_num/".$file_id, "");
		//$data_arr2['track_num'] = $track_num;
//		$this->load->view('file_tracking/send_new_file/notification', $data_arr2);

		$this->session->set_flashdata('flashSuccess','File successfully Sent. Track No. to track file : '.$track_num);
		redirect('home');
	}
}
