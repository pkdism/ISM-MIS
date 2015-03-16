<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_own_complaint extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
		$this->load->model ('complaint/complaints', '', TRUE);
		$user_id = $this->session->userdata('id');
		$res = $this->complaints->user_complaint_list($user_id);
				
		$total_rows = $res->num_rows();
		$data_array = array();
		$sno = 1;
		foreach ($res->result() as $row)
		{
			$data_array[$sno]=array();
			$j=1;
			$data_array[$sno][$j++] = $row->complaint_id;
			$data_array[$sno][$j++] = $row->status;
			$data_array[$sno][$j++] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data_array[$sno][$j++] = $row->type;
			$data_array[$sno][$j++] = $row->location;
			$data_array[$sno][$j++] = $row->location_details;
			$data_array[$sno][$j++] = $row->problem_details;
			$data_array[$sno][$j++] = $row->remarks;
			//$data_array[$sno][$j++] = $row->pref_time;
			$sno++;
		}
	
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;
		
		if ($total_rows == 0)
		{
			$this->drawHeader ("No Complaints registered by you.");
			$this->drawFooter();
		}
		else 
		{
			$this->drawHeader ("List of all Registered Complaints");
			$this->load->view('complaint/view_own_complaint',$data);
			$this->drawFooter();
		}
	}
}