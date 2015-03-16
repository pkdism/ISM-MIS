<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Complaint_details extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
//		$this->addJS ("file_tracking/file_tracking_script.js");
//		$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function details ($complaint_id, $status='')
	{
		$this->load->model ('complaint/complaints', '', TRUE);
		$res = $this->complaints->get_complaint_details($complaint_id);
		
		$this->load->model('user_model', '', TRUE);
		$this->load->model('user_other_details_model', '', TRUE);
		//$total_rows = $res->num_rows();
		$data = array();
		//$sno = 1;
		foreach ($res->result() as $row)
		{
			//$data_array[$sno]=array();
			$j=1;
			$data['complaint_id'] = $row->complaint_id;
			$data['complaint_by'] = $this->user_model->getNameById($row->user_id);
			$data['date_n_time'] = date('j M Y g:i A', strtotime($row->date_n_time));
			$data['location'] = $row->location;
			$data['location_details'] = urldecode($row->location_details);
			$data['problem_details'] = urldecode($row->problem_details);
			$data['pref_time'] = $row->pref_time;
			$data['status'] = $row->status;
			$data['remarks'] = $row->remarks;
			
			$query = $this->user_other_details_model->getUserById($row->user_id);
			$data['mobile'] = $query->mobile_no;
			if (!$data['mobile'])
				$data['mobile'] = "NA";
			$data['email'] = $this->user_model->getEmailById($row->user_id);
			if (!$data['email'])
				$data['email'] = "NA";
			$data['type'] = $row->type;
			//$data_array[$sno][$j++] = $row->pref_time;
			//$sno++;
		}
		
		$this->drawHeader ("Complaint Details");
		if ($status == "UnderProcessing")
			$this->load->view('complaint/complaint_details_editable',$data);
		else
			$this->load->view('complaint/complaint_details_view',$data);
		$this->drawFooter();		
	}
}