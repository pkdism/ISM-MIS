<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supervisor extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function update_complaint_details ($complaint_id, $type)
	{
		$this->load->model ('complaint/complaints', '', TRUE);
		$status = $this->input->post('status');
		$fresh_action = $this->input->post('fresh_action');
     	$action_taken = $this->complaints->get_remarks($complaint_id);

		$date = date('j M Y g:i A');
		
		if ($action_taken == "New Complaint")
			$fresh_action = $date." : ".$fresh_action;
		else
			$fresh_action = $action_taken."<br/>".$date." : ".$fresh_action;

		$this->complaints->update_complaint($complaint_id, $status, $fresh_action);		
		$this->session->set_flashdata('flashSuccess','Complaint : '.$complaint_id.' successfully processed');
		redirect('complaint/supervisor/view_complaints/'.$type);
	}
	
	public function view_complaints ($supervisor)
	{
		$this->load->model ('complaint/complaints', '', TRUE);

		$this->load->model('user_model', '', TRUE);

		$res = $this->complaints->complaint_list("Closed", $supervisor);		
		$total_rows_closed = $res->num_rows();
		$data_array_closed = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array_closed[$sno]=array();
			$j=1;
			$data_array_closed[$sno][$j++] = $row->complaint_id;
			$data_array_closed[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array_closed[$sno][$j++] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data_array_closed[$sno][$j++] = $row->location;
			$data_array_closed[$sno][$j++] = $row->location_details;
			$data_array_closed[$sno][$j++] = $row->problem_details;
			$data_array_closed[$sno][$j++] = $row->remarks;
			//$data_array_closed[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$res = $this->complaints->complaint_list("Rejected", $supervisor);		
		$total_rows_rejected = $res->num_rows();
		$data_array_rejected = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array_rejected[$sno]=array();
			$j=1;
			$data_array_rejected[$sno][$j++] = $row->complaint_id;
			$data_array_rejected[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array_rejected[$sno][$j++] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data_array_rejected[$sno][$j++] = $row->location;
			$data_array_rejected[$sno][$j++] = $row->location_details;
			$data_array_rejected[$sno][$j++] = $row->problem_details;
			$data_array_rejected[$sno][$j++] = $row->remarks;
			//$data_array_rejected[$sno][$j++] = $row->pref_time;
			$sno++;
		}
		
		$res = $this->complaints->all_complaint_list($supervisor);		
		$total_rows_all = $res->num_rows();
		$data_array_all = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array_all[$sno]=array();
			$j=1;
			$data_array_all[$sno][$j++] = $row->complaint_id;
			$data_array_all[$sno][$j++] = $row->status;
			$data_array_all[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array_all[$sno][$j++] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data_array_all[$sno][$j++] = $row->location;
			$data_array_all[$sno][$j++] = $row->location_details;
			$data_array_all[$sno][$j++] = $row->problem_details;
			$data_array_all[$sno][$j++] = $row->remarks;
			//$data_array_all[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$res = $this->complaints->complaint_list("Under Processing", $supervisor);
		$total_rows_under_processing = $res->num_rows();
		$data_array_under_processing = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array_under_processing[$sno]=array();
			$j=1;
			$data_array_under_processing[$sno][$j++] = $row->complaint_id;
			$data_array_under_processing[$sno][$j++] = $this->user_model->getNameById($row->user_id);
			$data_array_under_processing[$sno][$j++] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data_array_under_processing[$sno][$j++] = $row->location;
			$data_array_under_processing[$sno][$j++] = $row->location_details;
			$data_array_under_processing[$sno][$j++] = $row->problem_details;
			$data_array_under_processing[$sno][$j++] = $row->remarks;
			//$data_array_under_processing[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array_closed'] = $data_array_closed;
		$data['total_rows_closed'] = $total_rows_closed;
		$data['data_array_rejected'] = $data_array_rejected;
		$data['total_rows_rejected'] = $total_rows_rejected;
		$data['data_array_all'] = $data_array_all;
		$data['total_rows_all'] = $total_rows_all;
		$data['data_array_under_processing'] = $data_array_under_processing;
		$data['total_rows_under_processing'] = $total_rows_under_processing;
	
		$this->drawHeader ("Complaint List");
		$this->load->view ('complaint/view_complaints_supervisor', $data);
		$this->drawFooter();

	}
}