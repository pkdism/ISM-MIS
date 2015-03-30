<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','est_da1','est_ar'));
	}

	public function index($form_no = 5, $emp_id = '')
	{
		if($this->authorization->is_auth('est_da1'))
		{
			$this->addJS('employee/edit_employee_script.js');

			if($emp_id == '') {
				$this->load->model('employee/emp_basic_details_model','',TRUE);
				$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

				$this->load->model('departments_model','',TRUE);
				$data['departments']=$this->departments_model->get_departments();

				$this->drawHeader("View Employee");
				$this->load->view('employee/view/index',$data);
				$this->drawFooter();
			}
			else
				$this->_load_view($emp_id,0);
		}
		else if($this->authorization->is_auth('emp'))
		{
			if($emp_id !='')
				$this->_load_view($emp_id,0);
			else
				$this->_load_view($this->session->userdata('id'),$form_no);
		}
	}

	function view_form()
	{
		if(!$this->authorization->is_auth('est_da1'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		$emp_id = $this->input->post('emp_id');

		// if some one refreshes the page then post values will be false, so saving the values in session.
		if($emp_id != '')
			$this->session->set_userdata('VIEW_EMPLOYEE_ID',$emp_id);

		if($emp_id == "" && !$this->session->userdata('VIEW_EMPLOYEE_ID'))
		{
			$this->session->set_flashdata('flashError','No employee selected.');
			redirect('employee/view');
			return;
		}
		$emp_id = $this->session->userdata('VIEW_EMPLOYEE_ID',$emp_id);

		$this->_load_view($emp_id);
	}

	private function _load_view($emp_id,$form=5)
	{
		$this->addJS('employee/print_script.js');

		$data['emp_id'] = $emp_id;
		$data['step']=$form;
		$this->load->model('employee_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('employee/emp_family_details_model','',TRUE);
		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);
		$this->load->model('employee/emp_education_details_model','',TRUE);
		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);

		//initialization
		$data['pending_photo'] = false;
		$data['pending_emp'] = false;
		$data['pending_permanent_address'] = false;
		$data['pending_present_address'] = false;
		$data['pending_ft'] = false;

		if($data['emp_validation_details'])	{

			$users = $this->users_model->getUserById($emp_id);
			$user_details = $this->user_details_model->getPendingDetailsById($emp_id);
			$user_other_details = $this->user_other_details_model->getPendingDetailsById($emp_id);
			$emp_basic_details = $this->emp_basic_details_model->getPendingDetailsById($emp_id);
			$emp_pay_details = $this->emp_pay_details_model->getPendingDetailsById($emp_id);

			//approved details from real tables and rejected/pending details from pending tables
			//case 0 : profile pic status
			if($data['emp_validation_details']->profile_pic_status != 'approved')
				$data['pending_photo'] = $user_details->photopath;

			//case 1 : basic details status
			if($data['emp_validation_details']->basic_details_status != 'approved') {
				$user = (object)(array_merge((array)$users,(array)$user_details,(array)$user_other_details));
				$data['pending_emp'] = (object)(array_merge((array)$user,(array)$emp_basic_details,(array)$emp_pay_details,array('auth_id'=>array($user->auth_id,$emp_basic_details->auth_id))));
				$data['pending_permanent_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'permanent');
				$data['pending_present_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'present');
				$data['pending_ft']=$this->faculty_details_model->getPendingDetailsById($emp_id);
			}
		}

		$data['emp']=$this->employee_model->getById($emp_id);
		$data['permanent_address'] = $this->user_address_model->getAddrById($emp_id,'permanent');
		$data['present_address'] = $this->user_address_model->getAddrById($emp_id,'present');
		$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);

		$data['emp_prev_exp_details'] = $this->employee_model->getPreviousEmploymentDetailsById($emp_id);
		$data['pending_emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);

		$data['emp_family_details'] = $this->employee_model->getFamilyDetailsById($emp_id);
		$data['pending_emp_family_details'] = $this->emp_family_details_model->getPendingDetailsById($emp_id);

		$data['emp_education_details'] = $this->employee_model->getEducationDetailsById($emp_id);
		$data['pending_emp_education_details'] = $this->emp_education_details_model->getPendingDetailsById($emp_id);

		$data['emp_last5yrstay_details'] = $this->employee_model->getStayDetailsById($emp_id);
		$data['pending_emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);

		$this->drawHeader("View Employee Details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/view/view',$data);
		$this->drawFooter();
	}
}
/* End of file view.php */
/* Location: mis/application/controllers/employee/view.php */