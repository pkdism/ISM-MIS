<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','est_da1'));
	}

	public function index()
	{
		if($this->authorization->is_auth('est_da1'))
		{
			$this->addJS("employee/edit_employee_script.js");

			$this->load->model('employee/emp_basic_details_model','',TRUE);
			$data['employees']=$this->emp_basic_details_model->getAllEmployeesId();

			$this->load->model('Departments_model','',TRUE);
			$data['departments']=$this->Departments_model->get_departments();

			$this->drawHeader("Edit Employee");
			$this->load->view('employee/edit/index',$data);
			$this->drawFooter();
		}
		else if($this->authorization->is_auth('emp'))
		{
			$emp_id=$data['emp_id']=$this->session->userdata('id');
			$this->load->model('user/user_details_model','',TRUE);
			$this->load->model('user/user_other_details_model','',TRUE);
			$this->load->model('employee/emp_basic_details_model','',TRUE);
			$this->load->model('employee/faculty_details_model','',TRUE);
			$this->load->model('employee/emp_pay_details_model','',TRUE);
			$this->load->model('user/user_address_model','',TRUE);

			$data['user_details']=$this->user_details_model->getUserById($emp_id);
			$data['user_other_details']=$this->user_other_details_model->getUserById($emp_id);
			$data['emp']=$this->emp_basic_details_model->getEmployeeById($emp_id);
			$data['ft']=$this->faculty_details_model->getFacultyById($emp_id);
			$data['emp_pay_details']=$this->emp_pay_details_model->getEmpPayDetailsById($emp_id);
			$data['permanent_address']=$this->user_address_model->getAddrById($emp_id,'permanent');
			$data['present_address']=$this->user_address_model->getAddrById($emp_id,'present');

			$this->load->model('departments_model','',TRUE);
			$this->load->model('designations_model','',TRUE);
			$this->load->model('indian_states_model','',TRUE);

			// get distinct pay bands
			$this->load->model('pay_scales_model','',TRUE);
			$data['pay_bands']=$this->pay_scales_model->get_pay_bands();
			$data['states']=$this->indian_states_model->getStates();

			$this->drawHeader("Edit Basic details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
			$this->load->view('employee/edit/own_basic_details',$data);
			$this->drawFooter();
		}
	}

	public function edit_form()
	{
		if(!$this->authorization->is_auth('est_da1'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		$emp_id = $this->input->post('emp_id');
		$form = $this->input->post('form_name');

		// if some one refreshes the page then post values will be false, so saving the values in session.
		if($emp_id != '')
		{
			$this->session->set_userdata('EDIT_EMPLOYEE_ID',$emp_id);
			$this->session->set_userdata('EDIT_EMPLOYEE_FORM',$form);
		}

		if($emp_id == "" && !$this->session->userdata('EDIT_EMPLOYEE_ID'))
		{
			$this->session->set_flashdata('flashError','No employee selected.');
			redirect('employee/edit');
			return;
		}
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID',$emp_id);
		$form = $this->session->userdata('EDIT_EMPLOYEE_FORM',$emp_id);
		switch($form)
		{
			case 0: $this->_edit_profile_pic($emp_id);break;
			case 1:	$this->_edit_basic_details($emp_id);break;
			case 2: $this->_edit_prev_emp_details($emp_id);break;
			case 3: $this->_edit_family_details($emp_id);break;
			case 4: $this->_edit_education_details($emp_id);break;
			case 5: $this->_edit_last_5yr_stay_details($emp_id);break;
		}
	}

	private function _edit_profile_pic($emp_id)
	{
		$this->addJS("employee/emp_profile_picture_script.js");

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$emp_validation_details = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		$res = $this->user_details_model->getUserById($emp_id);

		$pending = false;
		if($emp_validation_details && $emp_validation_details->profile_pic_status != 'approved')
			$pending = $this->user_details_model->getPendingDetailsById($emp_id);

		$data['photopath'] = ($res == FALSE)?	FALSE:$res->photopath;
		$data['pending_photopath'] = ($pending == FALSE)?	FALSE:$pending->photopath;
		$data['status'] = ($emp_validation_details)? $emp_validation_details->profile_pic_status : 'approved';
		$data['emp_id']=$emp_id;
		$this->drawHeader('Change Employee picture',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/profile_pic',$data);
		$this->drawFooter();
	}

	function update_profile_pic($emp_id)
	{
		$upload = $this->_upload_image($emp_id,'photo');
		if($upload)
		{
			$this->load->model('user/user_details_model','',TRUE);

			//insert details if there exists no entry of emp_id otherwise update details
			$pending = $this->user_details_model->getPendingDetailsById($emp_id);
			if($pending)
				$this->user_details_model->updatePendingDetailsById(array('photopath'=>'employee/'.$emp_id.'/'.$upload['file_name']),$emp_id);
			else {
				$res=$this->user_details_model->getUserById($emp_id);
				$details = array_merge((array)$res,array('photopath'=>'employee/'.$emp_id.'/'.$upload['file_name']));
				$this->user_details_model->insertPendingDetails($details);
			}

			$this->edit_validation($emp_id,'profile_pic_status');

			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' profile picture updated and sent for validation.');
			redirect('employee/edit');
		}
	}

	private function _edit_basic_details($emp_id)
	{
		$this->addJS("employee/edit_basic_details_script.js");

		$data['emp_id']=$emp_id;
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('employee/emp_pay_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);

		//initializing pending data with real data
		$data['pending_user_details'] = $data['user_details'] = $this->user_details_model->getUserById($emp_id);
		$data['pending_user_other_details'] = $data['user_other_details'] = $this->user_other_details_model->getUserById($emp_id);
		$data['pending_emp'] = $data['emp'] = $this->emp_basic_details_model->getEmployeeById($emp_id);
		$data['pending_ft'] = $data['ft'] = $this->faculty_details_model->getFacultyById($emp_id);
		$data['pending_emp_pay_details'] = $data['emp_pay_details'] = $this->emp_pay_details_model->getEmpPayDetailsById($emp_id);
		$data['pending_permanent_address'] = $data['permanent_address'] = $this->user_address_model->getAddrById($emp_id,'permanent');
		$data['pending_present_address'] = $data['present_address'] = $this->user_address_model->getAddrById($emp_id,'present');
		$data['status'] = 'approved';

		if($data['emp_validation_details'] && $data['emp_validation_details']->basic_details_status != 'approved') {
			$data['pending_user_details'] = $this->user_details_model->getPendingDetailsById($emp_id);
			$data['pending_user_other_details'] = $this->user_other_details_model->getPendingDetailsById($emp_id);
			$data['pending_emp'] = $this->emp_basic_details_model->getPendingDetailsById($emp_id);
			$data['pending_ft'] = $this->faculty_details_model->getPendingDetailsById($emp_id);
			$data['pending_emp_pay_details'] = $this->emp_pay_details_model->getPendingDetailsById($emp_id);
			$data['pending_permanent_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'permanent');
			$data['pending_present_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'present');
			$data['status'] = $data['emp_validation_details']->basic_details_status;
		}

		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);
		$this->load->model('indian_states_model','',TRUE);
		// get distinct pay bands
		$this->load->model('pay_scales_model','',TRUE);

		$data['pay_bands']=$this->pay_scales_model->get_pay_bands();
		$data['states']=$this->indian_states_model->getStates();

		$this->drawHeader('Edit basic details',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/basic_details',$data);
		$this->drawFooter();
	}

	function update_basic_details($emp_id)
	{
		$user_details = array(
			'id' => $emp_id ,
			'salutation' => $this->input->post('salutation') ,
			'first_name' => ucwords(strtolower($this->input->post('firstname'))) ,
			'middle_name' => ucwords(strtolower($this->input->post('middlename'))) ,
			'last_name' => ucwords(strtolower($this->input->post('lastname'))) ,
			'sex' => strtolower($this->input->post('sex')) ,
			'category' => $this->input->post('category') ,
			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))) ,
			'email' => $this->input->post('email') ,
			'marital_status' => strtolower($this->input->post('mstatus')) ,
			'physically_challenged' => strtolower($this->input->post('pd')) ,
			'dept_id' => $this->input->post('department')
		);

		$user_other_details = array(
			'id' => $emp_id ,
			'religion' => strtolower($this->input->post('religion')) ,
			'nationality' => strtolower($this->input->post('nationality')) ,
			'kashmiri_immigrant' => $this->input->post('kashmiri') ,
			'hobbies' => strtolower($this->input->post('hobbies')) ,
			'fav_past_time' => strtolower($this->input->post('favpast')) ,
			'birth_place' => strtolower($this->input->post('pob')) ,
			'mobile_no' => $this->input->post('mobile') ,
			'father_name' => ucwords(strtolower($this->input->post('father'))) ,
			'mother_name' => ucwords(strtolower($this->input->post('mother')))
		);

		$dt = DateTime::createFromFormat("d-m-Y", $this->input->post('retire'));
		$emp_basic_details = array(
			'id' => $emp_id ,
			'auth_id' => $this->input->post('tstatus') ,
			'designation' => $this->input->post('designation') ,
			'office_no' => $this->input->post('office') ,
			'fax' => $this->input->post('fax') ,
			'joining_date' => date('Y-m-d',strtotime($this->input->post('entrance_age')))	 ,
			'retirement_date' => $dt->format("Y-m-d") ,
			'employment_nature' => strtolower($this->input->post('empnature'))
		);

		if($this->input->post('tstatus') == 'ft')
		{
			$faculty_details = array(
				'id' => $emp_id ,
				'research_interest' => strtolower($this->input->post('research_int'))
			);
		}

		$emp_pay_details = array(
			'id' => $emp_id ,
			'pay_code' => $this->input->post('gradepay') ,
			'basic_pay' => $this->input->post('basicpay')
		);

		$user_address = array(
							array(
								'id' => $emp_id ,
								'line1' => $this->input->post('line11') ,
								'line2' => $this->input->post('line21') ,
								'city' => strtolower($this->input->post('city1')) ,
								'state' => strtolower($this->input->post('state1')) ,
								'pincode' => $this->input->post('pincode1') ,
								'country' => strtolower($this->input->post('country1')) ,
								'contact_no' => $this->input->post('contact11') ,
								'type' => 'present'
							),
							array(
								'id' => $emp_id ,
								'line1' => $this->input->post('line12') ,
								'line2' => $this->input->post('line22') ,
								'city' => strtolower($this->input->post('city2')) ,
								'state' => strtolower($this->input->post('state2')) ,
								'pincode' => $this->input->post('pincode2') ,
								'country' => strtolower($this->input->post('country2')) ,
								'contact_no' => $this->input->post('contact12') ,
								'type' => 'permanent'
							)
		);

		//loading models
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('employee/emp_pay_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);

		//starting transaction for insertion in database
		$this->db->trans_start();

		//insert details if there exists no entry of corresponding emp_id otherwise update details
		$pending = $this->user_details_model->getPendingDetailsById($emp_id);
		if($pending)
			$this->user_details_model->updatePendingDetailsById($user_details,$emp_id);
		else {
			$res=$this->user_details_model->getUserById($emp_id);
			$details = array_merge((array)$res,$user_details);
			$this->user_details_model->insertPendingDetails($details);
		}

		$pending = $this->user_other_details_model->getPendingDetailsById($emp_id);
		if($pending)
			$this->user_other_details_model->updatePendingDetailsById($user_other_details,$emp_id);
		else
			$this->user_other_details_model->insertPendingDetails($user_other_details);

		$pending = $this->emp_basic_details_model->getPendingDetailsById($emp_id);
		if($pending)
			$this->emp_basic_details_model->updatePendingDetailsById($emp_basic_details,$emp_id);
		else
			$this->emp_basic_details_model->insertPendingDetails($emp_basic_details);

		if($this->input->post('tstatus') == 'ft') {
			$pending = $this->faculty_details_model->getPendingDetailsById($emp_id);
			if($pending)
				$this->faculty_details_model->updatePendingDetailsById($faculty_details,$emp_id);
			else
				$this->faculty_details_model->insertPendingDetails($faculty_details);
		}

		$pending = $this->emp_pay_details_model->getPendingDetailsById($emp_id);
		if($pending)
			$this->emp_pay_details_model->updatePendingDetailsById($emp_pay_details,$emp_id);
		else
			$this->emp_pay_details_model->insertPendingDetails($emp_pay_details);

		$pending = $this->user_address_model->getPendingDetailsById($emp_id);
		if($pending) {
			$this->user_address_model->updatePendingPresentDetailsById($user_address[0],$emp_id);
			$this->user_address_model->updatePendingPermanentDetailsById($user_address[1],$emp_id);
		}
		else
			$this->user_address_model->insertPendingDetails($user_address);

		$this->db->trans_complete();
		//transaction completed

		$this->edit_validation($emp_id,'basic_details_status');

		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' basic details updated and sent for validation.');
		redirect('employee/edit');
	}

	function update_own_basic_details($emp_id)
	{
		$user_details = array(
			'salutation' => $this->input->post('salutation') ,
			'email' => $this->input->post('email') ,
			'marital_status' => strtolower($this->input->post('mstatus')) ,
			'physically_challenged' => strtolower($this->input->post('pd'))
		);

		$user_other_details = array(
			'hobbies' => strtolower($this->input->post('hobbies')) ,
			'fav_past_time' => strtolower($this->input->post('favpast')) ,
			'mobile_no' => $this->input->post('mobile')
		);

		$emp_basic_details = array(
			'office_no' => $this->input->post('office') ,
			'fax' => $this->input->post('fax')
		);

		if($this->input->post('research_int'))
		{
			$faculty_details = array(
				'research_interest' => strtolower($this->input->post('research_int'))
			);
		}

		$user_present_address = array(
				'line1' => $this->input->post('line11') ,
				'line2' => $this->input->post('line21') ,
				'city' => strtolower($this->input->post('city1')) ,
				'state' => strtolower($this->input->post('state1')) ,
				'pincode' => $this->input->post('pincode1') ,
				'country' => strtolower($this->input->post('country1')) ,
				'contact_no' => $this->input->post('contact1') ,
		);

		//loading models
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$emp_validation_details = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		//starting transaction for insertion in database

		$this->db->trans_start();

		$this->user_details_model->updateById($user_details,$emp_id);
		$this->user_other_details_model->updateById($user_other_details,$emp_id);
		$this->emp_basic_details_model->updateById($emp_basic_details,$emp_id);
		if(isset($faculty_details))
			$this->faculty_details_model->updateById($faculty_details,$emp_id);
		$this->user_address_model->updatePresentAddrById($user_present_address,$emp_id);

		//update the pending tables too, because employee changes have higher priority then deo changes
		if($emp_validation_details->basic_details_status != 'approved') {
			$this->user_details_model->updatePendingDetailsById($user_details,$emp_id);
			$this->user_other_details_model->updatePendingDetailsById($user_other_details,$emp_id);
			$this->emp_basic_details_model->updatePendingDetailsById($emp_basic_details,$emp_id);
			if(isset($faculty_details))
				$this->faculty_details_model->updatePendingDetailsById($faculty_details,$emp_id);
			$this->user_address_model->updatePendingPresentDetailsById($user_present_address,$emp_id);
		}

		$this->db->trans_complete();
		//transaction completed

		$this->session->set_flashdata('flashSuccess','Your basic details have been updated.');
		redirect('home');
	}

	private function _edit_prev_emp_details($emp_id)
	{
		$this->addJS("employee/edit_prev_emp_details_script.js");

		$data['emp_id']=$emp_id;
		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		$data['validation_status'] = ($data['emp_validation_details'])? $data['emp_validation_details']->prev_exp_status : 'approved';

			$data['pending_emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);
			$data['emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);

		//joining date of the employee
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$emp_basic_details = $this->emp_basic_details_model->getEmployeeByID($emp_id);
		if($emp_basic_details !== FALSE)
			$data['joining_date'] = $emp_basic_details->joining_date;
		else
			$data['joining_date'] = FALSE;

		$this->drawHeader('Edit Previous Employment Details',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/previous_employment_details',$data);
		$this->drawFooter();
	}

	function update_prev_emp_details($emp_id)
	{
		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);

		$this->db->trans_start();
		//pending table if empty then copy records to pending table
		$pending = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_prev_exp_details_model->copyDetailsToPendingById($emp_id);

		if($this->emp_prev_exp_details_model->getPendingDetailsById($emp_id))
			$sno = count($this->emp_prev_exp_details_model->getPendingDetailsById($emp_id));
		else $sno = 0;

		$designation = $this->input->post('designation2');
		$from = date('Y-m-d',strtotime($this->input->post('from2')));
		$to = date('Y-m-d',strtotime($this->input->post('to2')));
		$payscale = $this->input->post('payscale2');
		$addr = $this->input->post('addr2');
		$reason = $this->input->post('reason2');

		$emp_prev_exp_details['id'] = $emp_id;
		$emp_prev_exp_details['sno'] = $sno+1;
		$emp_prev_exp_details['designation'] = strtolower($designation);
		$emp_prev_exp_details['from'] = $from;
		$emp_prev_exp_details['to'] = $to;
		$emp_prev_exp_details['pay_scale'] = strtolower($payscale);
		$emp_prev_exp_details['address'] = strtolower($addr);
		$emp_prev_exp_details['remarks'] = strtolower($reason);

		$this->emp_prev_exp_details_model->insertPendingDetails($emp_prev_exp_details);
		$this->db->trans_complete();
		$this->edit_validation($emp_id,'prev_exp_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' previous employment details updated and sent for validation.');

		redirect('employee/edit/edit_form');
	}

	function update_old_prev_emp_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);

		//pending table if empty then copy records to pending table
		$pending = $this->emp_prev_exp_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_prev_exp_details_model->copyDetailsToPendingById($emp_id);

		$this->emp_prev_exp_details_model->updatePendingDetailsWhere(array('designation'=>strtolower($this->input->post('edit_designation'.$row)),
																'from'=>date('Y-m-d',strtotime($this->input->post('edit_from'.$row))),
																'to'=>date('Y-m-d',strtotime($this->input->post('edit_to'.$row))),
																'pay_scale'=>strtolower($this->input->post('edit_payscale'.$row)),
																'address'=>strtolower($this->input->post('edit_addr'.$row)),
																'remarks'=>strtolower($this->input->post('edit_reason'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'prev_exp_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' previous employment details updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_family_details($emp_id)
	{
		$this->addJS("employee/edit_family_details_script.js");

		$data['emp_id']=$emp_id;
		$this->load->model('employee/emp_family_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		$data['validation_status'] = ($data['emp_validation_details'])? $data['emp_validation_details']->family_details_status : 'approved';

			$data['pending_emp_family_details'] = $this->emp_family_details_model->getPendingDetailsById($emp_id);
			$data['emp_family_details'] = $this->emp_family_details_model->getEmpFamById($emp_id);

		$this->drawHeader('Edit Family Details',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/family_details',$data);
		$this->drawFooter();
	}

	function update_family_details($emp_id)
	{
		$this->load->model('employee/emp_family_details_model','',TRUE);

		$this->db->trans_start();
		//pending table if empty then copy records to pending table
		$pending = $this->emp_family_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_family_details_model->copyDetailsToPendingById($emp_id);

		if($this->emp_family_details_model->getPendingDetailsById($emp_id))
			$sno = count($this->emp_family_details_model->getPendingDetailsById($emp_id));
		else $sno = 0;

		$upload = $this->_upload_image($emp_id,'photo3',$sno+1);
		if($upload !== FALSE) {
			$name = $this->input->post('name3');
			$relationship = $this->input->post('relationship3');
			$profession = $this->input->post('profession3');
			$addr = $this->input->post('addr3');
			$dob = date('Y-m-d',strtotime($this->input->post('dob3')));
			$active = $this->input->post('active3');

			$emp_family_details['id'] = $emp_id;
			$emp_family_details['sno'] = $sno+1;
			$emp_family_details['name'] = ucwords(strtolower($name));
			$emp_family_details['relationship'] = $relationship;
			$emp_family_details['profession'] = strtolower($profession);
			$emp_family_details['present_post_addr'] = strtolower($addr);
			$emp_family_details['photopath'] = (isset($upload['file_name']))? 'employee/'.$emp_id.'/'.$upload['file_name'] : '';
			$emp_family_details['dob'] = $dob;
			$emp_family_details['active_inactive'] = $active;

			$this->emp_family_details_model->insertPendingDetails($emp_family_details);
			$this->db->trans_complete();
			$this->edit_validation($emp_id,'family_details_status');
			$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' family details updated and sent for validation.');

			redirect('employee/edit/edit_form');
		}
	}

	function update_old_fam_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('employee/emp_family_details_model','',TRUE);

		//pending table if empty then copy records to pending table
		$pending = $this->emp_family_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_family_details_model->copyDetailsToPendingById($emp_id);

		$fam_array = array('dob'=>date('Y-m-d',strtotime($this->input->post('edit_dob'.$row))),
							'profession'=>strtolower($this->input->post('edit_profession'.$row)),
							'active_inactive'=>$this->input->post('edit_active'.$row),
							'present_post_addr'=>strtolower($this->input->post('edit_address'.$row)));

		if(isset($_FILES['edit_photo'.$row]['name']) && $_FILES['edit_photo'.$row]['name']!='')
		{	$upload = $this->_upload_image($emp_id,'edit_photo'.$row,$row);
			if($upload)	$fam_array = array_merge($fam_array,array('photopath'=>'employee/'.$emp_id.'/'.$upload['file_name']));
		}

		$this->emp_family_details_model->updatePendingDetailsWhere($fam_array, array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'family_details_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' family details updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_education_details($emp_id)
	{
		$this->addJS("employee/edit_education_details_script.js");

		$data['emp_id']=$emp_id;
		$this->load->model('employee/emp_education_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		$data['validation_status'] = ($data['emp_validation_details'])? $data['emp_validation_details']->educational_status : 'approved';

			$data['pending_emp_education_details'] = $this->emp_education_details_model->getPendingDetailsById($emp_id);
			$data['emp_education_details'] = $this->emp_education_details_model->getEmpEduById($emp_id);

		$this->drawHeader('Edit Educational Qualifications',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/educational_details',$data);
		$this->drawFooter();
	}

	function update_education_details($emp_id)
	{
		$this->load->model('employee/emp_education_details_model','',TRUE);

		$this->db->trans_start();
		//pending table if empty then copy records to pending table
		$pending = $this->emp_education_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_education_details_model->copyDetailstoPendingById($emp_id);

		if($this->emp_education_details_model->getPendingDetailsById($emp_id))
			$sno = count($this->emp_education_details_model->getPendingDetailsById($emp_id));
		else $sno = 0;

		$exam = $this->input->post('exam4');
		$branch = $this->input->post('branch4');
		$clgname = $this->input->post('clgname4');
		$year = $this->input->post('year4');
		$grade = $this->input->post('grade4');
		$div = $this->input->post('div4');

		$emp_education_details['id'] = $emp_id;
		$emp_education_details['sno'] = $sno+1;
		$emp_education_details['exam'] = strtolower($exam);
		$emp_education_details['branch'] = strtolower($branch);
		$emp_education_details['institute'] = strtolower($clgname);
		$emp_education_details['year'] = $year;
		$emp_education_details['grade'] = strtolower($grade);
		$emp_education_details['division'] = strtolower($div);

		$this->emp_education_details_model->insertPendingDetails($emp_education_details);
		$this->db->trans_complete();
		$this->edit_validation($emp_id,'educational_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' educational qualifications updated and sent for validation.');

		redirect('employee/edit/edit_form');
	}

	function update_old_education_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('employee/emp_education_details_model','',TRUE);

		//pending table if empty then copy records to pending table
		$pending = $this->emp_education_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_education_details_model->copyDetailsToPendingById($emp_id);

		$this->emp_education_details_model->updatePendingDetailsWhere(array('exam'=>strtolower($this->input->post('edit_exam'.$row)),
																'branch'=>strtolower($this->input->post('edit_branch'.$row)),
																'institute'=>strtolower($this->input->post('edit_clgname'.$row)),
																'year'=>$this->input->post('edit_year'.$row),
																'grade'=>strtolower($this->input->post('edit_grade'.$row)),
																'division'=>strtolower($this->input->post('edit_div'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'educational_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' educational qualifications updated and sent for validation.');
		redirect('employee/edit/edit_form');
	}

	private function _edit_last_5yr_stay_details($emp_id)
	{
		$this->addJS("employee/edit_last_5yr_stay_details_script.js");

		$data['emp_id']=$emp_id;
		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_validation_details'] = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		$data['validation_status'] = ($data['emp_validation_details'])? $data['emp_validation_details']->stay_status : 'approved';

			$data['pending_emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);
			$data['emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);

		$this->drawHeader('Edit last 5 year stay details',"<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/edit/last_five_year_stay_details',$data);
		$this->drawFooter();
	}

	function update_last_5yr_stay_details($emp_id)
	{
		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);

		$this->db->trans_start();
		//pending table if empty then copy records to pending table
		$pending = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_last5yrstay_details_model->copyDetailsToPendingById($emp_id);

		if($this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id))
			$sno = count($this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id));
		else $sno = 0;

		$from = $this->input->post('from5');
		$to = $this->input->post('to5');
		$addr = $this->input->post('addr5');
		$district = $this->input->post('dist5');

		$emp_last5yrstay_details['id'] = $emp_id;
		$emp_last5yrstay_details['sno'] = $sno+1;
		$emp_last5yrstay_details['from'] = date('Y-m-d',strtotime($from));
		$emp_last5yrstay_details['to'] = date('Y-m-d',strtotime($to));
		$emp_last5yrstay_details['res_addr'] = $addr;
		$emp_last5yrstay_details['dist_hq_name'] = strtolower($district);

		$this->emp_last5yrstay_details_model->insertPendingDetails($emp_last5yrstay_details);
		$this->db->trans_complete();
		$this->edit_validation($emp_id,'stay_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' last five year stay details updated and sent for validation.');

		redirect('employee/edit/edit_form');
	}

	function update_old_last_5yr_stay_details($row)
	{
		$emp_id = $this->session->userdata('EDIT_EMPLOYEE_ID');

		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);

		//pending table if empty then copy records to pending table
		$pending = $this->emp_last5yrstay_details_model->getPendingDetailsById($emp_id);
		if(!$pending)
			$this->emp_last5yrstay_details_model->copyDetailsToPendingById($emp_id);

		$this->emp_last5yrstay_details_model->updatePendingDetailsWhere(array('from'=>date('Y-m-d',strtotime($this->input->post('edit_from'.$row))),
																'to'=>date('Y-m-d',strtotime($this->input->post('edit_to'.$row))),
																'res_addr'=>$this->input->post('edit_addr'.$row),
																'dist_hq_name'=>strtolower($this->input->post('edit_dist'.$row))),
															array('id'=>$emp_id, 'sno'=>$row));

		$this->edit_validation($emp_id,'stay_status');
		$this->session->set_flashdata('flashSuccess','Employee '.$emp_id.' last five year stay details updated and sent for validation.');
		redirect('employee/edit/edit_form');
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
		$emp_name = ucwords($user->salutation.' '.$user->first_name.(($user->middle_name != '')? ' '.$user->middle_name: '').(($user->last_name != '')? ' '.$user->last_name: ''));
		$this->load->model('user/user_auth_types_model','',TRUE);
		$res = $this->user_auth_types_model->getUserIdByAuthId('est_ar');
		foreach ($res as $row)
		{
			if($row->id == $emp_id)	continue;
			$this->notification->notify($row->id, 'est_ar', "Validation Request", "Please validate ".$emp_name." details", "employee/validation/validate_step/".$emp_id);
		}
	}

	private function _upload_image($emp_id = '', $name ='', $n_family = FALSE)
	{
		$config['upload_path'] = 'assets/images/employee/'.strtolower($emp_id).'/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']  = '200';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		if(isset($_FILES[$name]['name']))
    	{
            if($_FILES[$name]['name'] == "")
        		$filename = "";
            else
			{
                $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                if(!$n_family)
                	$filename='emp_'.$emp_id.'_'.date('YmdHis').$ext;
                else
                	$filename='emp_'.$emp_id.'_fam_'.$n_family.date('YmdHis').$ext;
            }
        }
        else
        {
        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
			redirect('employee/edit/edit_form');
			return FALSE;
        }

		$config['file_name'] = $filename;
		//$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
		//return FALSE;

		if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
		{
			$error = $this->upload->display_errors();
			$this->session->set_flashdata('flashError','ERROR : '.$error);
			redirect('employee/edit/edit_form');
			return FALSE;
		}
		else
		{
			$upload_data = $this->upload->data();	//single upload for both user and fasmily
			return $upload_data;
		}
	}
}
/* End of file edit.php */
/* Location: mis/application/controllers/employee/edit.php */