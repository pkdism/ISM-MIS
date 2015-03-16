<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_editable_by_student extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('stu'));
	}

	function index($error = '')
	{
		$stu_id = $this->session->userdata('id');
		$data['error'] = $error;
		$data['stu_id'] = $stu_id;
		$this->load->model('student/student_details_model');
		$this->load->model('student/student_other_details_model');
		$this->load->model('user/user_details_model');
		$this->load->model('user/user_other_details_model');
		$data['stu_detail'] = $this->student_details_model->get_student_details_by_id($stu_id);
		$data['stu_other_detail'] = $this->student_other_details_model->get_student_other_details_by_id($stu_id);
		$data['user_detail'] = $this->user_details_model->getUserById($stu_id);
		$data['user_other_detail'] = $this->user_other_details_model->getUserById($stu_id);

		$this->addJS('student/edit_my_details.js');

		$this->drawHeader('Edit Your Details');
		$this->load->view('student/edit/student_editable_by_student',$data);
		$this->drawFooter();
	}

	function update_my_details()
	{
		$stu_id = $this->session->userdata('id');
		$this->load->model('student/student_details_model');
		$this->load->model('student/student_other_details_model');
		$this->load->model('user/user_details_model');
		$this->load->model('user/user_other_details_model');

		$user_details = array(
			'email' => $this->authorization->strclean($this->input->post('email'))
		);

		$user_other_details = array(
			'hobbies' => strtolower($this->authorization->strclean($this->input->post('hobbies'))) ,
			'fav_past_time' => strtolower($this->authorization->strclean($this->input->post('favpast'))) ,
			'mobile_no' => $this->input->post('mobile') 
		);

		$stu_details = array(
			'alternate_mobile_no' => $this->input->post('alternate_mobile') ,
			'alternate_email_id' => $this->input->post('alternate_email_id')
		);

		$stu_other_details = array(
			'extra_curricular_activity' => strtolower($this->authorization->strclean($this->input->post('extra_activity'))) ,
			'other_relevant_info' => strtolower($this->authorization->strclean($this->input->post('any_other_information')))
		);

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);

		$this->db->trans_start();

		$this->user_details_model->updateById($user_details,$stu_id);
		$this->user_other_details_model->updateById($user_other_details,$stu_id);
		$this->student_details_model->update_by_id($stu_details,$stu_id);
		$this->student_other_details_model->update_by_id($stu_other_details,$stu_id);

		$this->db->trans_complete();

		$this->session->set_flashdata('flashSuccess','Details successfully updated.');
		redirect();

	}
}