<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function grade_pay($pay_band = '')
	{
		// fetching grade pay for a particular pay band
		$this->load->model('pay_scales_model','',TRUE);
		$data['grade_pays'] = $this->pay_scales_model->get_grade_pay($pay_band);
		$this->load->view('ajax/grade_pay',$data);
	}

	public function designation($type = '')
	{
		// fetching designations of a particular type , if type is not given then all the designations are shown
		$this->load->model('designations_model','',TRUE);

		if($type === '')
			$data['designations'] = $this->designations_model->get_designations();
		else if($type === 'ft')
			$data['designations'] = $this->designations_model->get_designations("type in ('ft','others')");
		else if($type === 'nfta' || $type === 'nftn')
			$data['designations'] = $this->designations_model->get_designations("type in ('nft','others')");
		else
			$data['designations'] = FALSE;

		$this->load->view('ajax/designation',$data);
	}

	public function department($type = '')
	{
		// fetching departments of a particular type

		$this->load->model('departments_model','',TRUE);

		if($type === 'ft')
			$data['departments'] = $this->departments_model->get_departments('academic');
		else if($type === 'nftn')
			$data['departments'] = $this->departments_model->get_departments('nonacademic');
		else if($type === '' || $type === 'nfta')
			$data['departments'] = $this->departments_model->get_departments();
		else
			$data['departments'] = FALSE;

		$this->load->view('ajax/department',$data);
	}

	public function empNameByDept($dept = '')
	{
		$this->load->model('user/user_details_model','',TRUE);
		$data['empNames'] = $this->user_details_model->getEmpNamesByDept($dept);
		$this->load->view('ajax/empNameByDept',$data);
	}
	
}


/* End of file ajax.php */
/* Location: Codeigniter/application/controllers/ajax.php */