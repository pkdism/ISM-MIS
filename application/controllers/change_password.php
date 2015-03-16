<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_Password extends MY_Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->drawHeader("Change Password");
		$this->load->view('change_password');
		$this->drawFooter();
	}

	public function update_password()
	{
		$this->load->model('user/users_model','',TRUE);
		$date = $this->users_model->getUserById($this->session->userdata('id'))->created_date;

		$old_pass=$this->input->post('old_password');
		$new_pass=$this->input->post('new_password');

		if($new_pass == $this->session->userdata('id'))
		{
			$this->session->set_flashdata('flashError','Your new password cannot be your user ID.');
			redirect('change_password');
		}
		$new_pass_clean=$this->authorization->strclean($this->input->post('new_password'));
		$new_hash=$this->authorization->encode_password($new_pass_clean,$date);

		$confirm_pass=$this->authorization->strclean($this->input->post('confirm_password'));
		$confirm_hash=$this->authorization->encode_password($confirm_pass,$date);

		if($new_hash == $confirm_hash)
		{
			$this->users_model->change_password($old_pass,$new_pass);
			$this->session->set_flashdata('flashSuccess','Password changed successfully');
			redirect('login/logout/4');
		}
		else
		{
			$this->session->set_flashdata('flashError','New passwords do not match.');
			redirect('change_password');
		}
	}
}
