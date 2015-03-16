<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Get_guards extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup','seo'));
	}
	
	function index($post_id='',$date='',$from_time='',$to_time='',$range='')
	{
		if($post_id ==  '' || $date=='' || $from_time=='' || $to_time=='' || $range=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('guard/home');
		}
		$this->load->model('guard/guard_model');
		
		$data['available_guards'] = $this->guard_model->get_available_guards_for_overtime($post_id,$date,$from_time,$to_time);
		//$data['available_guards'] = $this->guard_model->get_guards();
		$this->load->view('guard/available_guards',$data);
	}
}
