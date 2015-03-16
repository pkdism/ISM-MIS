<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_portal extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo'));
		$this->load->model('course_structure/basic_model','',true);
		$this->load->model('tnpcell/tnp_basic_model','',true);
	}
	public function index()
	{
		$data = array();
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_basic_details("");
		$this->drawHeader("Training and Placement Portal");
		$this->load->view('tnpcell/manage_portal',$data);
		$this->drawFooter();
	}
	public function ViewJNF()
	{
		$company_id = $this->input->post("ddl_company");
		$data = array();
		$auth_data = $this->session->userdata('auth');
		$data['auth_type'] = $auth_data;
		//if user is other than student then show contact details in JNF.
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_basic_details($company_id);
		$data['company_details'] = $this->tnp_basic_model->get_company_details($company_id);
		$data['company_eligible_branches'] = $this->tnp_basic_model->get_company_eligible_branches($company_id);
		$data['company_logistics'] = $this->tnp_basic_model->get_company_logistics($company_id);
		$data['company_salary'] = $this->tnp_basic_model->get_company_salary($company_id);
		$data['company_selectioncutoff'] = $this->tnp_basic_model->get_company_selectioncutoff($company_id);
		$data['company_selectionprocess'] = $this->tnp_basic_model->get_company_selectionprocess($company_id);
		
		if($this->input->post("ddl_company") != '')
		{
			$this->drawHeader("Job Notification Form");
			$this->load->view('tnpcell/view_jnf',$data);
			$this->drawFooter();
		}
		else
		{
			$this->session->set_flashdata("flashError","Please Select Company to view JNF.");
			redirect("/tnpcell/View_jnf");	
		}
	}
 
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>