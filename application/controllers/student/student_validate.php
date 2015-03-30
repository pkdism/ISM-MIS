<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Student_validate extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('acd_ar'));
	}

	function index()
	{
		$this->addJS('student/student_validation_script.js');
		$this->drawHeader('Select Student To Validate Details');
		$this->load->view('student/validate/student_validation_list');
		$this->drawFooter();
	}

	function loadUsersToValidate()
	{
		$this->load->model('student/student_details_to_approve','',TRUE);
		$this->load->view('student/validate/student_for_validation_table',array("users_to_validate" => $this->student_details_to_approve->get_all_stu_details()));
	}

	function validation($admn_no='')
	{
		// $admn_no = $this->input->post('stu_id');
		if($admn_no)
		{

			$data['admn_no'] = $admn_no;

			$this->load->model('user/user_details_model','',TRUE);
			$this->load->model('student/student_details_model','',TRUE);
			$this->load->model('departments_model','',TRUE);
			$this->load->model('user/user_address_model','',TRUE);
			$this->load->model('user/user_other_details_model','',TRUE);
			$this->load->model('student/student_other_details_model','',TRUE);
			$this->load->model('student/student_fee_details_model','',TRUE);
			$this->load->model('student/student_education_details_model','',TRUE);
			$this->load->model('student/student_academic_model','',TRUE);
			$this->load->model('student/student_type_model','',TRUE);
			$this->load->model('student_view_report/get_cb','',TRUE);
			$this->load->model('student_view_report/student_typeugpg_model','',TRUE);
			

			$data['user_details']=$this->user_details_model->getPendingDetailsById($admn_no);
			$data['stu_other_details']=$this->student_other_details_model->get_pending_student_other_details_by_id($admn_no);
			$data['student_fee_details']=$this->student_fee_details_model->get_pending_stu_fee_details_by_id($admn_no);
			$data['user_other_details']=$this->user_other_details_model->getPendingDetailsById($admn_no);
			$data['student_details']=$this->student_details_model->get_pending_student_details_by_id($admn_no);
			$data['permanent_address']=$this->user_address_model->getPendingDetailsById($admn_no,'permanent');
			$data['present_address']=$this->user_address_model->getPendingDetailsById($admn_no,'present');
			$data['cross_address']=$this->user_address_model->getPendingDetailsById($admn_no,'correspondence');
			$data['stu_education_details'] = $this->student_education_details_model->getPendingStuEduById($admn_no);
			$data['student_academic']=$this->student_academic_model->get_pending_stu_academic_details_by_id($admn_no);
			
			$this->load->model('student/student_details_to_approve','',TRUE);
			$head_data['data_recv'] = $this->student_details_to_approve->get_all_stu_details_by_id($admn_no);
			$head_data['data_recv'] = $head_data['data_recv'];
			
			$this->addJS('student/reject_reason_script.js');
			
			$this->drawHeader("Validate Student Details");
				
			
				if(is_object($data['user_details']))
				{
					$this->load->view('student/validate/details_to_approve',$head_data);
					$this->load->view('student_view_report/view/view_header',array('admn_no'=>$data['user_details']->id));
					$this->load->view('student_view_report/view/profile_pic',$data);
					$this->load->view('student_view_report/view/stu_validate_details',$data);
					$this->drawFooter();
				}
				else
				{
		            $data=array('1'=>'error');
					$this->load->view('student_view_report/view/stud_details',$data);
				}
				
				
		}
		else
			echo '<center><h2>Not Found","Your details have not been updated. Please check after some time</h2>';		
	}

	function fetch_stu_details()
	{
		if($this->validation($this->input->post('stu_id')))
			return true;
		else
			return false;
	}

	function insert_approved_details($stu_id)
	{
		$admn_no = $stu_id;
		
		$this->load->model('student/student_status_details_model','',TRUE);

		$stu_status = array(
			'details_authorized_on' => date("Y-m-d H:i:s",time()),
			'status' => 'Approved'
		);

		$this->db->trans_start();

		$this->delete_pending_data($stu_id);

		$this->student_status_details_model->updateById($stu_status,$admn_no);

		$this->db->trans_complete();

		$this->notification->notify($stu_id, 'stu', "Details Approved", "Your details have been approved.", "student_view_report/view/".$stu_id);

		$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' details Accepted.');
		redirect("student/student_validate");
	}

	function details_rejected($stu_id)
	{
		$this->load->model('student/student_rejected_detail_model','',TRUE);
		$this->load->model('student/student_status_details_model','',TRUE);

		$rejected_reason = array(
			'id' => $stu_id,
			'reason' => $this->input->post('reason')
		);

		$stu_status = array(
			'status' => 'rejected'
		);

		$rejected_status = $this->student_rejected_detail_model->get_stu_status_details_by_id($stu_id);

		$this->db->trans_start();

		if($rejected_status)
			$this->student_rejected_detail_model->deleteDetailsWhere(array('id' => $stu_id));

		$this->delete_pending_data($stu_id);

		if(!$this->student_rejected_detail_model->insert($rejected_reason))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_rejected_details.');
		if(!$this->student_status_details_model->updateById($stu_status,$stu_id))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_id_status_details.');

		$this->db->trans_complete();

		$this->load->model('user/user_auth_types_model','',TRUE);
		$res = $this->user_auth_types_model->getUserIdByAuthId('deos');
		foreach($res as $row)
			$this->notification->notify($row->id, 'deos', "Details Rejected", "Details of student ".$stu_id." have been rejected.", "".$stu_id);

		$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' details Rejected.');
		
		redirect("student/student_validate");
	}

	function delete_pending_data($stu_id)
	{
		$admn_no = $stu_id;
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_education_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('student/student_details_to_approve','',TRUE);

		$user_details=(array)($this->user_details_model->getPendingDetailsById($admn_no));
		$stu_other_details=(array)($this->student_other_details_model->get_pending_student_other_details_by_id($admn_no));
		$stu_fee_details=(array)($this->student_fee_details_model->get_pending_stu_fee_details_by_id($admn_no));
		$user_other_details=(array)($this->user_other_details_model->getPendingDetailsById($admn_no));
		$stu_details=(array)($this->student_details_model->get_pending_student_details_by_id($admn_no));
		$user_permanent_address=(array)($this->user_address_model->getPendingDetailsById($admn_no,'permanent'));
		$user_present_address=(array)($this->user_address_model->getPendingDetailsById($admn_no,'present'));
		$user_correspondence_address=(array)($this->user_address_model->getPendingDetailsById($admn_no,'correspondence'));
		$stu_education_details=(array)($this->student_education_details_model->getPendingStuEduById($admn_no));
		$stu_academic=(array)($this->student_academic_model->get_pending_stu_academic_details_by_id($admn_no));
		$correspondence_address=$this->user_address_model->getAddrById($admn_no,'correspondence');

		if($this->user_details_model->getUserById($stu_id))
		{
			/*if($user_details)
				$this->user_details_model->updateById($user_details,$stu_id);
			if($user_other_details)
				$this->user_other_details_model->updateById($user_other_details,$stu_id);
			if($user_present_address)
				$this->user_address_model->updatePresentAddrById($user_present_address,$stu_id);
			if($user_permanent_address)
				$this->user_address_model->updatePermanentAddrById($user_permanent_address,$stu_id);
			if($correspondence_address)
				if(!$this->input->post('correspondence_addr'))
					$this->user_address_model->updateCorrespondenceAddrById($user_correspondence_address,$stu_id);
				else
					$this->user_address_model->deleteCorrespondenceAddrById($stu_id);
			else
				if(!$this->input->post('correspondence_addr'))
					$this->user_address_model->insert($user_correspondence_address);
			if($stu_details)
				$this->student_details_model->update_by_id($stu_details,$stu_id);
			if($stu_other_details)
				$this->student_other_details_model->update_by_id($stu_other_details,$stu_id);
			if($stu_fee_details)
				$this->student_fee_details_model->update_by_id($stu_fee_details,$stu_id);
			if($stu_academic)
				$this->student_academic_model->update_by_id($stu_academic,$stu_id);*/
			$this->user_details_model->updateById($user_details,$stu_id);
			$this->user_other_details_model->updateById($user_other_details,$stu_id);
			$this->user_address_model->updatePresentAddrById($user_present_address,$stu_id);
			$this->user_address_model->updatePermanentAddrById($user_permanent_address,$stu_id);
			if($correspondence_address)
				if($user_correspondence_address)
					$this->user_address_model->updateCorrespondenceAddrById($user_correspondence_address,$stu_id);
				else
					$this->user_address_model->deleteCorrespondenceAddrById($stu_id);
			else
				if($user_correspondence_address)
					$this->user_address_model->insert($user_correspondence_address);
			$this->student_details_model->update_by_id($stu_details,$stu_id);
			$this->student_other_details_model->update_by_id($stu_other_details,$stu_id);
			$this->student_fee_details_model->update_by_id($stu_fee_details,$stu_id);
			$this->student_academic_model->update_by_id($stu_academic,$stu_id);
		}
		else
		{
			//$user_address = array($user_permanent_address,$user_present_address,$user_correspondence_address);
			$this->user_details_model->insert($user_details);
			$this->user_other_details_model->insert($user_other_details);
			//$this->user_address_model->insert_batch($user_address);
			$this->user_address_model->insert($user_present_address);
			$this->user_address_model->insert($user_permanent_address);
			if($user_correspondence_address)
				$this->user_address_model->insert($user_correspondence_address);
			if(!$this->student_academic_model->insert($stu_academic))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_academic_model.');
			if(!$this->student_details_model->insert($stu_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_details.');
			if(!$this->student_other_details_model->insert($stu_other_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_other_details.');
			if(!$this->student_fee_details_model->insert($stu_fee_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_fee_details.');
			//$this->student_current_entry_model->insert($stu_current_entry);
			if(!$this->student_education_details_model->insert_batch($stu_education_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_education_details.');
		}

		$this->student_details_to_approve->deleteDetailsWhere(array('id'=>$admn_no));
		$this->user_details_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->user_other_details_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->user_address_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->student_other_details_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->student_fee_details_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->student_details_model->deletePendingDetailsWhere(array('admn_no'=>$stu_id));
		$this->student_education_details_model->deletePendingDetailsWhere(array('id'=>$stu_id));
		$this->student_academic_model->deletePendingDetailsWhere(array('id'=>$stu_id));

		return ;
	}

}