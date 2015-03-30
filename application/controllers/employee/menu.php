<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('emp','est_da1'));
	}

	public function index()
	{
		$this->load->model('employee/emp_current_entry_model','',TRUE);
		$data['entry']=$this->emp_current_entry_model->get_current_entry();
		$this->drawHeader('Employee Management');
		$this->load->view('employee/main_menu',$data);
		$this->drawFooter();
	}
}

/* End of file menu.php */
/* Location: mis/application/controllers/employee/menu.php */