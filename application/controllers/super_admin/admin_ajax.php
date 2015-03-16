<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_ajax extends MY_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function getUsersByDeptAuth($dept = 'all',$auth = 'all')
	{
		$this->load->model('user_model','',TRUE);
		$data['users']=$this->user_model->getUsersByDeptAuth($dept,$auth);
		$this->load->view('super_admin/admin_ajax/user_dept_view',$data);
	}

	public function deleteAuth($id, $dept = 'all',$auth)
	{
		$this->load->model('user/user_auth_types_model','',TRUE);
		$this->user_auth_types_model->delete(array('id'=>$id, 'auth_id'=>$auth));
		$this->getUsersByDeptAuth($dept,$auth);
	}
	public function get_dept()
	{
		$this->load->model('departments_model','',TRUE);
		$data['departments']=$this->departments_model->get_departments();
		$this->load->view('super_admin/admin_ajax/dept_list',$data);
	}
	public function get_emp_id()
	{
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();
		$this->load->view('super_admin/admin_ajax/emp_id_list',$data);
	}
	public function get_auths()
	{
		$this->load->model('auth_types_model','',TRUE);
		$data['auths']=$this->auth_types_model->getAllAuths();
		$this->load->view('super_admin/admin_ajax/auth_type_list',$data);
	}
}