<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emp_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function check_availability($emp_id = '')
	{
		$this->load->model('user/users_model','',TRUE);
		$result = $this->users_model->getUserById($emp_id);
		if($result)	return false;
		return true;
	}

	public function feedback_emp_detail($emp_id = '')
	{
		//if emp_id is available
		if($this->check_availability($emp_id))
		{
			// fetching employee details from feedback_faculty from feedback_mis database
			if($emp_id === '')
			{
				$data['feedback_emp_detail'] = FALSE;
				$data['error'] = 'NO_EMP';
			}
			else
			{
				$this->load->model('employee/feedback_faculty_model','',TRUE);
				$data['feedback_emp_detail'] = $this->feedback_faculty_model->get_faculty_info($emp_id);
			}
		}
		else
		{
			$data['feedback_emp_detail'] = FALSE;
			$data['error'] = 'NO_AVAIL';
		}
		$this->load->view('employee/emp_ajax/fetch_feedback_emp_detail.php',$data);
	}

	public function delete_record($form = -1, $s = -1)
	{
		$emp_id=$this->session->userdata('EDIT_EMPLOYEE_ID');
		switch($form)
		{
			case 2: $this->load->model('employee/emp_prev_exp_details_model','',TRUE);
					$pending = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);
					if(!$pending)
						$this->emp_prev_exp_details_model->copyDetailstoPendingById($emp_id);
					if($s != -1)	$this->emp_prev_exp_details_model->deletePendingDetailsWhere(array('id'=>$emp_id, 'sno'=>$s));
					$this->edit_validation($emp_id,'prev_exp_status');
					break;
			case 4: $this->load->model('employee/emp_education_details_model','',TRUE);
					$pending = $this->emp_education_details_model->getPendingDetailsById($emp_id);
					if(!$pending)
						$this->emp_education_details_model->copyDetailstoPendingById($emp_id);
					if($s != -1)	$this->emp_education_details_model->deletePendingDetailsWhere(array('id'=>$emp_id, 'sno'=>$s));
					$this->edit_validation($emp_id,'educational_status');
					break;
			case 5: $this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
					$pending = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);
					if(!$pending)
						$this->emp_last5yrstay_details_model->copyDetailstoPendingById($emp_id);
					if($s != -1)	$this->emp_last5yrstay_details_model->deletePendingDetailsWhere(array('id'=>$emp_id, 'sno'=>$s));
					$this->edit_validation($emp_id,'stay_status');
					break;
		}
		if($form !=-1 && $s!=-1)
		{
			$this->load->model('employee/emp_basic_details_model','',TRUE);
				$emp_basic_details = $this->emp_basic_details_model->getEmployeeByID($emp_id);
			if($emp_basic_details)	$data['joining_date'] = $emp_basic_details->joining_date;
			else $data['joining_date'] = FALSE;
			$data['form'] = $form;
			$data['emp_id'] = $emp_id;
			$this->load->view('employee/emp_ajax/delete_record',$data);
		}
	}

	public function edit_record($form = -1, $s = -1)
	{
		$emp_id=$this->session->userdata('EDIT_EMPLOYEE_ID');
		switch($form)
		{
			case 2: $this->load->model('employee/emp_prev_exp_details_model','',TRUE);
					if($s != -1) {
						$pending = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id,$s);
						if(!$pending)
							$data['emp_prev_exp_details']=$this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id,$s);
						else
							$data['emp_prev_exp_details']=$pending;
					}
					break;
			case 3: $this->load->model('employee/emp_family_details_model','',TRUE);
					if($s != -1) {
						$pending = $this->emp_family_details_model->getPendingDetailsById($emp_id,$s);
						if(!$pending)
							$data['emp_family_details']=$this->emp_family_details_model->getEmpFamById($emp_id,$s);
						else
							$data['emp_family_details']=$pending;
					}
					break;
			case 4: $this->load->model('employee/emp_education_details_model','',TRUE);
					if($s != -1) {
						$pending = $this->emp_education_details_model->getPendingDetailsById($emp_id,$s);
						if(!$pending)
							$data['emp_education_details']=$this->emp_education_details_model->getEmpEduById($emp_id,$s);
						else
							$data['emp_education_details']=$pending;
					}
					break;
			case 5: $this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
					if($s != -1) {
						$pending = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id,$s);
						if(!$pending)
							$data['emp_last5yrstay_details']=$this->emp_last5yrstay_details_model->getEmpStayById($emp_id,$s);
						else
							$data['emp_last5yrstay_details']=$pending;
					}
					break;
		}
		if($form !=-1 && $s!=-1)
		{
			$this->load->model('employee/emp_basic_details_model','',TRUE);
				$emp_basic_details = $this->emp_basic_details_model->getEmployeeByID($emp_id);
			if($emp_basic_details)	$data['joining_date'] = $emp_basic_details->joining_date;
			else $data['joining_date'] = FALSE;
			$data['form'] = $form;
			$data['emp_id'] = $emp_id;
			$data['sno']=$s;
			$this->load->view('employee/emp_ajax/edit_record',$data);
		}
	}

	private function edit_validation($emp_id,$form)
	{
		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$res = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		//If no entry in the emp_validation_details table then insert the record else update the record.
		if($res == FALSE)
		{
			$validation_details = array('id'=>$emp_id,
										'profile_pic_status'=> 'approved',
										'basic_details_status'=> 'approved',
										'prev_exp_status'=> 'approved',
										'family_details_status'=> 'approved',
										'educational_status'=> 'approved',
										'stay_status'=> 'approved',
										'created_date'=> date('Y-m-d H:i:s',time()));
			$validation_details[$form] = 'pending';
			$this->emp_validation_details_model->insert($validation_details);
		}
		else
		{
			$this->emp_validation_details_model->updateById(array($form => 'pending'),$emp_id);
		}

		//Notify Employee about the change in details
		$this->load->model('user/users_model','',TRUE);
		$user = $this->users_model->getUserById($emp_id);
		if($user->auth_id == 'emp' && $user->password !='')
		{
			$msg='';
			switch($form)
			{
				case 'profile_pic_status' : $msg = "Your photograph have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'basic_details_status' : $msg = "Your basic details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'prev_exp_status' : $msg = "Your previous employment details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'family_details_status' : $msg = "Your family details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'educational_status' : $msg = "Your educational qualifications have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
				case 'stay_status' : $msg = "Your last five year stay details have been successfully edited by Data Entry Operator ".$this->session->userdata('id')." and sent for validation.";break;
			}
			$this->notification->notify($emp_id, 'emp', "Details Edited", $msg, "employee/view/index/".(($this->session->userdata('EDIT_EMPLOYEE_FORM')==0)? $this->session->userdata('EDIT_EMPLOYEE_FORM'):($this->session->userdata('EDIT_EMPLOYEE_FORM')-1)));
		}
		//Notify Assistant registrar for validation
		$this->load->model('user/user_details_model','',TRUE);
		$user = $this->user_details_model->getUserById($emp_id);
		$emp_name = ucwords($user->salutation.'. '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));
		$this->load->model('user/user_auth_types_model','',TRUE);
		$res = $this->user_auth_types_model->getUserIdByAuthId('est_ar');
		foreach ($res as $row)
		{
			if($row->id == $emp_id)	continue;
			$this->notification->notify($row->id, 'est_ar', "Validation Request", "Please validate ".$emp_name." details", "employee/validation/validate_step/".$emp_id);
		}
	}

	public function getEmpByCategory($category)
	{
		$this->load->model('user_model','',TRUE);
		$data['emp']=$this->user_model->getEmpByCategory($category);
		$this->load->view('employee/emp_ajax/queries/query_view',$data);
	}

	public function getEmpByDepartment($dept_id)
	{
		$this->load->model('user/user_details_model','',TRUE);
		$data['emp']=$this->user_details_model->getEmpNamesByDept($dept_id);
		$this->load->view('employee/emp_ajax/queries/query_view',$data);
	}

	public function getEmpByDesignation($des_id)
	{
		$this->load->model('employee_model','',TRUE);
		$data['emp']=$this->employee_model->getEmpByDesignation($des_id);
		$this->load->view('employee/emp_ajax/queries/query_view',$data);
	}
}

/* End of file Emp_ajax.php */
/* Location: Codeigniter/application/controllers/empolyee/Emp_ajax.php */