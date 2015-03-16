<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Track_file extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->addJS("file_tracking/file_tracking_script.js");
		$this->addJS("file_tracking/track_file.js");
		//$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
		$emp_id = $this->session->userdata('id');

		$this->load->model('file_tracking/file_move_details');
		$res = $this->file_move_details->files_to_be_tracked($emp_id);

		$this->load->model('user_model');

		$total_rows = $res->num_rows();
		$data_array = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array[$sno]=array();
			$j=1;

			$this->load->model("file_tracking/file_move_details");
			$query = $this->file_move_details->get_last_rcvd_emp_id ($row->track_num, $emp_id);
			foreach ($query->result() as $row2)
			{
				$rcvd_by_emp_id = $this->user_model->getNameById($row2->rcvd_by_emp_id);
				$sent_timestamp = $row2->sent_timestamp;
				break;
			}
			$data_array[$sno][$j++] = $row->file_no;

			$data_array[$sno][$j++] = $row->file_id;
			$data_array[$sno][$j++] = urldecode($row->file_subject);
			$data_array[$sno][$j++] = $row->track_num;
			$data_array[$sno][$j++] = $rcvd_by_emp_id;
			$data_array[$sno][$j++] = $row->close_emp_id;
			$data_array[$sno][$j++] = date('j M Y g:i A', strtotime($sent_timestamp));

			$sno++;
		}

		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;

		$this->drawHeader ("Track File");
		$this->load->view('file_tracking/track_file/track_file',$data);
		$this->drawFooter ();
	}
	public function validate_track_num ($track_num)
	{
		$this->load->model ('file_tracking/file_details','',TRUE);
		$file_id = $this->file_details->get_file_id ($track_num);
		if($file_id == false)
		{
			//$this->notification->drawNotification("Enter valid Track Number", "");
			//$this->session->set_flashdata('flashError','Enter correct Track Number.'.$track_num);
			//redirect('file_tracking/track_file');
			$ui = new UI();

			$ui->callout()
			   ->uiType("error")
			   ->title("Enter Correct Track Number.")
			   ->desc("")
			   ->show();
		}
		else
		{
			$res = $this->file_details->get_file_details ($track_num);
			foreach($res->result() as $row)
			{
				$file_id = $row->file_id;
				$file_no = $row->file_no;
				$file_subject = $row->file_subject;
				$start_emp_id = $row->start_emp_id;
				$close_emp_id = $row->close_emp_id;
			}
			$this->load->model ('file_tracking/file_move_details');
			$result = $this->file_move_details->get_move_details ($track_num);
			$total_rows = $result->num_rows();

			$this->load->model('user_model');

			$data_array = array();
			$sno = 1;
			foreach ($result->result() as $row)
			{
				$data_array[$sno]=array();
				$j=1;
				$data_array[$sno][$j++] = $row->file_id;
				$data_array[$sno][$j++] = $row->track_num;
				$data_array[$sno][$j++] = $this->user_model->getNameById($row->sent_by_emp_id);
				$data_array[$sno][$j++] = date('j M Y g:i A', strtotime($row->sent_timestamp));
				$data_array[$sno][$j++] = $this->user_model->getNameById($row->rcvd_by_emp_id);
				if ($row->rcvd_timestamp)
					$data_array[$sno][$j++] = date('j M Y g:i A', strtotime($row->rcvd_timestamp));
				else
					$data_array[$sno][$j++] = $row->rcvd_timestamp;
				//$data_array[$sno][$j++] = date('j M Y g:i A', strtotime($row->rcvd_timestamp));

				$data_array[$sno][$j++] = $row->forward_status;
				$data_array[$sno][$j++] = urldecode($row->remarks);
				$sno++;
			}
			$data = array (
						'file_id' => $file_id,
						'file_no' => $file_no,
						'track_num' => $track_num,
						'file_subject' => $file_subject,
						'start_emp_id' => $start_emp_id,
						'close_emp_id' => $close_emp_id,
						'data_array' => $data_array,
						'total_rows' => $total_rows
						  );
			$this->load->view ('file_tracking/track_file/track_table', $data);
		}
	}
}
