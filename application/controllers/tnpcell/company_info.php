<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_info extends MY_Controller {

	function __construct()
	{
		parent::__construct(array('tpo','stu'));
		$this->load->model('course_structure/basic_model','',true);
		$this->load->model('tnpcell/tnp_basic_model','',true);
	}
	public function index()
	{
		$data = array();
		$data['company_basic_info'] = $this->tnp_basic_model->get_company_list_visible_to_student();
		$this->drawHeader("View all Companies");
		$this->load->view('tnpcell/company_info',$data);
		$this->drawFooter();
	}
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>