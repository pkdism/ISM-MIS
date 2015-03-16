<?php

//Including the User Model
$CI = &get_instance();
$CI->load->model('user_model','',TRUE);

class Employee_model extends User_Model
{

	public $models = array('employee/emp_basic_details_model',
							'employee/emp_pay_details_model');

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model($this->models,'',TRUE);
	}

	function getById($id = '')
	{
		$user = User_Model::getById($id);
		$emp_basic_details = $this->emp_basic_details_model->getEmployeeById($id);
		$emp_pay_details = $this->emp_pay_details_model->getEmpPayDetailsById($id);

		if($user && $emp_basic_details && $emp_pay_details)
			return (object)(array_merge((array)$user,(array)$emp_basic_details,(array)$emp_pay_details,array('auth_id'=>array($user->auth_id,$emp_basic_details->auth_id)))) ;
		else
			return FALSE;
	}

	function getFamilyDetailsById($id = '')
	{
		$this->load->model('employee/emp_family_details_model','',TRUE);
		return $this->emp_family_details_model->getEmpFamById($id);
	}

	function getPreviousEmploymentDetailsById($id = '')
	{
		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);
		return $this->emp_prev_exp_details_model->getEmpPrevExpById($id);
	}

	function getEducationDetailsById($id = '')
	{
		$this->load->model('employee/emp_education_details_model','',TRUE);
		return $this->emp_education_details_model->getEmpEduById($id);
	}

	function getStayDetailsById($id = '')
	{
		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
		return $this->emp_last5yrstay_details_model->getEmpStayById($id);
	}

	function getEmpByDesignation($des_id = '')
	{
		$query = $this->db->select('user_details.id, salutation, first_name, middle_name, last_name')
								->from('emp_basic_details')
								->join('user_details','emp_basic_details.id = user_details.id')
								->where('designation',$des_id)
								->get();
		return $query->result();
	}
}

/* End of file employee_model.php */
/* Location: mis/application/models/employee_model.php */