<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Validation extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('est_ar','est_da1'));
	}

	public function index()
	{
		$this->addJS('employee/reject_reason_script.js');

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$data['emp_validation_details']=$this->emp_validation_details_model->getValidationDetails();

		$this->drawHeader("Validation Requests");
		$this->load->view('employee/validation/index',$data);
		$this->drawFooter();
	}

	function validate_step($emp_id='', $step=-1)
	{
		if(!$this->authorization->is_auth('est_ar')) {
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		if($emp_id == '') {
			redirect('employee/validation');
			return;
		}

		$this->addJS('employee/reject_reason_script.js');

		$this->load->model('employee_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('departments_model','',TRUE);
		$this->load->model('designations_model','',TRUE);
		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);
		$this->load->model('employee/emp_family_details_model','',TRUE);
		$this->load->model('employee/emp_education_details_model','',TRUE);
		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
		$this->load->model('employee/emp_validation_details_model','',TRUE);

		$data['emp_id']=$emp_id;
		$data['step']=$step;

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
			if($data['emp_validation_details']->profile_pic_status != 'approved' && $user_details)
				$data['pending_photo'] = $user_details->photopath;

			//case 1 : basic details status
			if($data['emp_validation_details']->basic_details_status != 'approved' && $users && $user_details && $user_other_details && $emp_basic_details && $emp_pay_details) {
				$user = (object)(array_merge((array)$users,(array)$user_details,(array)$user_other_details));
				$data['pending_emp'] = (object)(array_merge((array)$user,(array)$emp_basic_details,(array)$emp_pay_details,array('auth_id'=>array($user->auth_id,$emp_basic_details->auth_id))));
				$data['pending_permanent_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'permanent');
				$data['pending_present_address'] = $this->user_address_model->getPendingDetailsById($emp_id,'present');
				$data['pending_ft']=$this->faculty_details_model->getPendingDetailsById($emp_id);
			}
			$data['photo'] = $this->employee_model->getPhotoById($emp_id);
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
		}
		else {
			$this->session->set_flashdata('flashInfo','The employee '.$emp_id.' details have been Approved');
			redirect('employee/validation');
			return;
		}

		$this->drawHeader("Employee Validation","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/validation/index',array('emp_validation_details'=>array($data['emp_validation_details'])));
		$this->load->view('employee/validation/view',$data);
		$this->drawFooter();
	}

	function validate_details($emp_id, $step)
	{
		if(!$this->authorization->is_auth('est_ar'))
		{
			$this->session->set_flashdata('flashError','You are not authorized.');
			redirect('home');
			return;
		}

		$this->load->model('employee/emp_validation_details_model','',TRUE);
		$this->load->model('user/users_model','',TRUE);
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$this->load->model('employee/faculty_details_model','',TRUE);
		$this->load->model('employee/emp_pay_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('deo_modules_model','',TRUE);

		switch($step)
		{
			case 0: $form = 'profile_pic_status'; $msg='profile picture';break;
			case 1:	$form = 'basic_details_status'; $msg='basic details';break;
			case 2: $form = 'prev_exp_status'; $msg='previous employment details';break;
			case 3: $form = 'family_details_status'; $msg='dependent family member details';break;
			case 4: $form = 'educational_status'; $msg='educational qualificatons';break;
			case 5: $form = 'stay_status'; $msg='last 5 year stay details';break;
		}

		$user = $this->users_model->getUserById($emp_id);
		$date = date("Y-m-d H:i:s",time());

		if($this->input->post('approve'.$step))
		{
			//insert details from pending tables to real tables
			switch($step) {
				case 0:
						$this->db->trans_start();
						$res=$this->user_details_model->getUserById($emp_id);
						$old_photo = ($res == FALSE)?	FALSE:$res->photopath;
						$new_photo = $this->user_details_model->getPendingDetailsById($emp_id)->photopath;

						$this->user_details_model->updateById(array('photopath'=>$new_photo),$emp_id);

						//if old_photo and new_photo have same name ( in case of adding employee, data is copied in pending tables too, but one image present) then it should not be deleted.
						if($old_photo && $old_photo != $new_photo)	unlink(APPPATH.'../assets/images/'.$old_photo);

						$basic_status = $this->emp_validation_details_model->getValidationDetailsById($emp_id)->basic_details_status;
						if($basic_status == 'approved')
							$this->user_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));

						$this->db->trans_complete();
						break;

				case 1:
						$this->db->trans_start();

						$details = (array)($this->user_details_model->getPendingDetailsById($emp_id));
						unset($details['photopath']);
						$this->user_details_model->updateById($details,$emp_id);

						$details = (array)($this->user_other_details_model->getPendingDetailsById($emp_id));
						$this->user_other_details_model->updateById($details,$emp_id);

						$details = (array)($this->user_address_model->getPendingDetailsById($emp_id,'present'));
						$this->user_address_model->updatePresentAddrById($details,$emp_id);

						$details = (array)($this->user_address_model->getPendingDetailsById($emp_id,'permanent'));
						$this->user_address_model->updatePermanentAddrById($details,$emp_id);

						$details = (array)($this->emp_basic_details_model->getPendingDetailsById($emp_id));
						$this->emp_basic_details_model->updateById($details,$emp_id);

						$details = $this->emp_pay_details_model->getPendingDetailsById($emp_id);
						$this->emp_pay_details_model->updateById(array('pay_code'=>$details->pay_code, 'basic_pay'=>$details->basic_pay),$emp_id);

						$details = $this->faculty_details_model->getPendingDetailsById($emp_id);
						if($details)
							$this->faculty_details_model->updateById($details,$emp_id);

						$profile_pic_status = $this->emp_validation_details_model->getValidationDetailsById($emp_id)->profile_pic_status;
						if($profile_pic_status == 'approved')
							$this->user_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));

						$this->user_other_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));
						$this->user_address_model->deletePendingDetailsWhere(array('id'=>$emp_id));
						$this->emp_basic_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));
						$this->emp_pay_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));
						$this->faculty_details_model->deletePendingDetailsWhere(array('id'=>$emp_id));

						$this->db->trans_complete();
						break;

				case 2:
						$this->load->model('employee/emp_prev_exp_details_model','',TRUE);

						$this->db->trans_start();
						//delete records from real table
						$this->emp_prev_exp_details_model->delete_record(array('id'=>$emp_id));
						//move details from pending table to real table
						$this->emp_prev_exp_details_model->moveDetailsFromPendingById($emp_id);

						$this->db->trans_complete();
						break;

				case 3:
						$this->load->model('employee/emp_family_details_model','',TRUE);

						$this->db->trans_start();
						//delete records from real table
						$this->emp_family_details_model->delete_record(array('id'=>$emp_id));
						//move details from pending table to real table
						$this->emp_family_details_model->moveDetailsFromPendingById($emp_id);

						$this->db->trans_complete();
						break;

				case 4:
						$this->load->model('employee/emp_education_details_model','',TRUE);

						$this->db->trans_start();
						//delete records from real table
						$this->emp_education_details_model->delete_record(array('id'=>$emp_id));
						//move details from pending table to real table
						$this->emp_education_details_model->moveDetailsFromPendingById($emp_id);

						$this->db->trans_complete();
						break;

				case 5:
						$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);

						$this->db->trans_start();
						//delete records from real table
						$this->emp_last5yrstay_details_model->delete_record(array('id'=>$emp_id));
						//move details from pending table to real table
						$this->emp_last5yrstay_details_model->moveDetailsFromPendingById($emp_id);

						$this->db->trans_complete();
						break;
			}

			//pending --> approved
			$this->emp_validation_details_model->updateById(array($form => 'approved'),$emp_id);
			// delete reject details for the same
			$this->emp_validation_details_model->deleteRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id,'emp', "Validation Request Approved", "Your validation request for ".$msg." have been approved.", "employee/view/index/".(($step==0)? $step:($step-1)),"success");
			}
		}
		else if($this->input->post('reject'.$step))
		{
			//pending --> rejected
			$this->emp_validation_details_model->updateById(array($form => 'rejected'),$emp_id);
			// insert or update reject details
			$reason=$this->emp_validation_details_model->getRejectReasonWhere(array('id'=>$emp_id, 'step'=>$step));
			if($reason)
				$this->emp_validation_details_model->updateRejectReason(array('reason'=>$this->input->post('reason'.$step)),array('id'=>$emp_id,'step'=>$step));
			else
				$this->emp_validation_details_model->insertRejectReason(array('id'=>$emp_id,
																				'step'=>$step,
																				'reason'=>$this->input->post('reason'.$step),
																				'created_date'=> $date));
			//Notify Employee about the same
			if($user->auth_id == 'emp' && $user->password !='')
			{
				$this->notification->notify($emp_id,'emp', "Validation Request Rejected", "Your validation request for ".$msg." have been rejected. Contact the Establishment Section for the same.", "employee/view/index/".(($step==0)? $step:($step-1)),"error");
			}
			//Notify Deo of employee about the same
			$deo = $this->deo_modules_model->getDeoByModuleId('employee');
			foreach($deo as $row)
			{
				$this->notification->notify($row->id,'est_da1', "Validation Request Rejected", "Validation request for employee ".$emp_id." ".$msg." have been rejected.", "employee/validation","error");
			}
		}

		//If all the status are approved
		$this->emp_validation_details_model->deleteValidationDetailsWhere(array('profile_pic_status'=> 'approved',
																				'basic_details_status'=> 'approved',
																				'prev_exp_status'=> 'approved',
																				'family_details_status'=> 'approved',
																				'educational_status'=> 'approved',
																				'stay_status'=> 'approved'));
		$emp_validation_details = $this->emp_validation_details_model->getValidationDetailsById($emp_id);
		if($emp_validation_details)
			redirect('employee/validation/validate_step/'.$emp_id);
		else
		{
			//for new user
			if($user->auth_id == 'emp' && $user->password =='')
			{
				$pass='p';
				$encode_pass=$this->authorization->strclean($pass);
				$encode_pass=$this->authorization->encode_password($encode_pass,$date);
				$this->users_model->update(array('password' => $encode_pass, 'created_date' => $date), array('id' => $emp_id));

				#email the user and pass
				/*
				$email_query=mysql_query("SELECT email FROM user_details WHERE id='".$emp_id."'");
				$row=mysql_fetch_row($email_query);
				$to = $row[0];
				$subject = "Registration on Online ISM MIS Portal";
				$message = "You are registered on the Online ISM MIS Portal. Your Username and password are \n Username:".$emp_id ."\n Password:".$pass;
				$from = "xyz@example.com";
				$headers = "From:" . $from;
		//		mail($to,$subject,$message,$headers);
				echo "Mail Sent";
				*/
			}
			redirect('employee/validation');
		}
	}
}
/* End of file validation.php */
/* Location: mis/application/controllers/employee/validation.php */