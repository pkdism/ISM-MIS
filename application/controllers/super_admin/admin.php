<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('admin'));
	}

	public function assign_auths()
	{
		$this->addJS("super_admin/admin_script.js");

		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

		$this->load->model('departments_model','',TRUE);
		$data['departments']=$this->departments_model->get_departments();

		$this->load->model('auth_types_model','',TRUE);
		$data['auths']=$this->auth_types_model->getAllAuths();

		$data['page_head_title'] = "Assign Authorizations";

		$this->drawHeader("Assign Authorizations");
		$this->load->view('super_admin/assign_auths',$data);
		$this->drawFooter();
	}

	public function insert_auths()
	{
		$this->load->model('user/user_auth_types_model','',TRUE);
		$auths=array('id'=>$this->input->post('emp_id'), 'auth_id'=>$this->input->post('auth'));
		$user = $this->user_auth_types_model->getUserIdByAuthId($auths['auth_id']);
		if($user && in_array((object)(array('id'=>$auths['id'],'auth_id'=>$auths['auth_id'])),$user))
		{
			$this->session->set_flashdata('flashInfo',$auths['id'].' is already authorized as '.$auths['auth_id'].' .');
			redirect('super_admin/admin/assign_auths');
		}
		else
		{
			$this->user_auth_types_model->insert($auths);
			$this->session->set_flashdata('flashSuccess',$auths['id'].' is set as '.$auths['auth_id'].' .');
			redirect('home');
		}
	}

	public function change_password()
	{
		$this->addJS("super_admin/admin_script.js");

		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

		$this->load->model('Departments_model','',TRUE);
		$data['departments']=$this->Departments_model->get_departments();

		$data['page_head_title'] = "Change Password";

		$this->drawHeader("Change Password");
		$this->load->view('super_admin/change_password',$data);
		$this->drawFooter();
	}

	public function update_password()
	{
		$this->load->model('user/users_model','',TRUE);
		$id = $this->input->post('emp_id');
		$date = $this->users_model->getUserById($id)->created_date;
		$pass = $this->input->post('password');
		$encode_pass=$this->authorization->strclean($pass);
		$encode_pass=$this->authorization->encode_password($encode_pass,$date);
		$this->users_model->update(array('password' => $encode_pass) , array('id' => $id));
		$this->session->set_flashdata('flashSuccess','Password successfully changed.');
		redirect('home');
	}

	public function deny_auths()
	{
		$this->addJS("super_admin/admin_script.js");

		$this->load->model('departments_model','',TRUE);
		$data['departments']=$this->departments_model->get_departments();

		$this->load->model('auth_types_model','',TRUE);
		$data['auths']=$this->auth_types_model->getAllAuths();

		$data['page_head_title'] = "Deny Authorizations";

		$this->drawHeader("Deny Authorizations");
		$this->load->view('super_admin/deny_auths',$data);

		if($this->input->post('submit'))
		{
			$this->load->model('user_model','',TRUE);
			$data['users']=$this->user_model->getUsersByDeptAuth($this->input->post('dept'),$this->input->post('auth_id'));
			$this->load->view('super_admin/user_dept_view',$data);
		}

		if($this->input->post('deny'))
		{
			$data['users']=$this->user_auth_types_model->getUsersByDeptAuth($this->input->post('dept'),$this->input->post('auth_id'));
			$this->load->view('super_admin/user_dept_view',$data);
		}
		$this->drawFooter();
	}

	/*public function delete_auths()
	{
		$this->load->model('user/user_auth_types_model','',TRUE);
		$auths=array('id'=>$this->input->post('emp_id'), 'auth_id'=>$this->input->post('auth'));
		$user = $this->user_auth_types_model->getUserIdByAuthId($auths['auth_id']);
		if($user && in_array((object)(array('id'=>$auths['id'],'auth_id'=>$auths['auth_id'])),$user))
		{
			$this->session->set_flashdata('flashInfo',$auths['id'].' is already authorized as '.$auths['auth_id'].' .');
			redirect('super_admin/admin/assign_auths');
		}
		else
		{
			$this->user_auth_types_model->insert($auths);
			$this->session->set_flashdata('flashSuccess',$auths['id'].' is set as '.$auths['auth_id'].' .');
			redirect('home');
		}
	}*/

}

/* End of file admin.php */
/* Location: mis/application/controllers/super_admin/admin.php */