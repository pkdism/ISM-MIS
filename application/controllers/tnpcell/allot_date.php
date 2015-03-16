<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allot_date extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo'));
		$this->load->model('course_structure/basic_model','',true);
		$this->load->model('tnpcell/tnp_basic_model','',true);
	}
	public function index()
	{
		$this->addJS("tnpcell/allot_date.js");
		$data = array();
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_basic_details_not_given_dates("");
		$data['alloted_company_basic_info'] = $this->tnp_basic_model->get_alloted_company_basic_details("");
		$this->drawHeader("Manage Training and Placement Calender");
		$this->load->view('tnpcell/allot_date',$data);
		$this->drawFooter();
	}
	
	public function AllotDatesToCompany()
	{
		$date_from = $this->input->post("date_from");	
		$date_to = $this->input->post("date_to");	
		$company_id = $this->input->post("ddl_company");
		
		if($company_id == 0)
			$this->session->set_flashdata("flashError","Please Select a Valid Company");
		else
		{
			$tnp_calender['date_from'] = $date_from;
			$tnp_calender['date_to'] = $date_to;
			$tnp_calender['company_id'] = $company_id;
			$tnp_calender['status'] = "Proposed";
			$tnp_calender['stu_visibility'] = 0;
			if($this->tnp_basic_model->insert_tnp_calender($tnp_calender))
			{
				$this->session->set_flashdata("flashSuccess","Date Proposed Successfully.");
			}
			else
			{
				$this->session->set_flashdata("flashError","Error in Database operation.");
			}
		}
		redirect("tnpcell/allot_date");
	}
	
	public function RescheduleCompany()
	{
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		
		$company_id = $data['company_id'];
		$date_from = $data['date_from'];
		$date_to = $data['date_to'];
		$status = "Proposed";
		$stu_visibility = $data['stu_visibility'];
		
		$tnp_calender['date_from'] = $date_from;
		$tnp_calender['date_to'] = $date_to;
		$tnp_calender['status'] = "Proposed";
		$tnp_calender['stu_visibility'] = $stu_visibility;
		echo $this->tnp_basic_model->update_tnp_calender($tnp_calender,$company_id);
	}
	
	public function RemoveAllotedDate($company_id)
	{
		echo $this->tnp_basic_model->delete_tnp_calender($company_id);
	}
	
	function json_get_company_inrange($from,$to)
	{
		$this->output->set_content_type('application/json');
		
		$this->output->set_output(json_encode($this->tnp_basic_model->get_company_in_date_range($from,$to)));	
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>