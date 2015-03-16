<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Over_time extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup'));
		$this->addJS('employee/print_script.js');
		$this->addJS('ui_example/user-loader.js');
	}

	function index()
	{
		$this->session->set_flashdata('flashError','Access Denied!');
		redirect('guard/home');
	}
	
	function assign_to_a_guard()
	{
		$this->load->model('guard/guard_model');
		
		$data['posts'] = $this->guard_model->get_posts();
		
		if($this->input->post('assign_overtime') == TRUE && $this->input->post('Regno') == TRUE)
		{
			$from_time = (float)$this->input->post('hours_from') + (float)$this->input->post('minutes_from');
			$to_time = (float)$this->input->post('hours_to') + (float)$this->input->post('minutes_to');
			
			$datum =array('post_id'=>$this->input->post('post_id'),
						 'date'=>$this->input->post('date'),
						 'from_time'=>$from_time,
						 'to_time'=>$to_time,
						 'Regno'=>$this->input->post('Regno')
						 );
			$engage_guards = $this->guard_model->check_engage_guard('2015-02-09','54612','6','8');
			$this->session->set_flashdata('flashSuccess','data'.count($engage_guards));
			redirect('guard/over_time/assign_to_a_guard',$data);
			$insert_return = $this->guard_model->insert_into_overtime($datum);
			if($insert_return == -1)
			{
				$this->session->set_flashdata('flashError','Sorry, you are not allowed to assign overtime duties before assigning regular duties.');
				redirect('guard/over_time/assign_to_a_guard',$data);
			}			
			else if($insert_return == -2)
			{
				$this->session->set_flashdata('flashError','Sorry, The guard is already assigned another duty for the time period.'.$this->input->post('Regno').' '.$from_time.' '.$to_time.' '.$this->input->post('date'));
				redirect('guard/over_time/assign_to_a_guard',$data);
			}
			$this->session->set_flashdata('flashSuccess','Duty has been successfully assigned.');
			redirect('guard/over_time/assign_to_a_guard',$data);
		}
		
		$this->drawHeader('Assign Overtime Duty');
		$this->load->view('guard/assign_overtime',$data);
		$this->drawFooter();
	}
	
	function view()
	{
		$this->load->model('guard/guard_model','',TRUE);
		
		$data['postnames'] = $this->guard_model->get_postnames();
		$data['guardnames'] = $this->guard_model->get_guardnames();
		
		if($this->input->post('postsubmit') != False)
		{
			$data['mode'] = 'postname';
			$data['postname'] = $this->input->post('postname');
			$data['details_of_guards_at_a_post'] = $this->guard_model->get_details_of_guard_at_a_post_overtime($data['postname']);
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->load->view('guard/homeview_overtime',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
			
		}
		else if($this->input->post('datesubmit') != False)
		{
			$data['mode'] = 'date';	
			$data['selectdate'] = $this->input->post('selectdate');
			$data['details_of_guards_at_a_date'] = $this->guard_model->get_details_of_guard_at_a_date_overtime($data['selectdate']);
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->load->view('guard/homeview_overtime',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangesubmit') != False)
		{
			$data['mode'] = 'rangeofdates';
			$data['fromdate'] = $this->input->post('fromdate');
			$data['todate'] = $this->input->post('todate');
			$data['details_of_guards_in_a_range'] = $this->guard_model->get_details_of_guards_in_a_range_overtime($data['fromdate'], $data['todate']);
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->load->view('guard/homeview_overtime',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangeguardsubmit') != False)
		{
			$data['mode'] = 'rangeofdates_guard';
			$data['guardname'] = $this->input->post('guardname');
			$data['fromdateg'] = $this->input->post('fromdateg');
			$data['todateg'] = $this->input->post('todateg');
			$data['details_of_guard_in_a_range'] = $this->guard_model->get_details_of_guard_in_a_range_overtime($data['fromdateg'], $data['todateg'], $data['guardname']);
			$data['details_of_a_guard'] = $this->guard_model->get_details_of_a_guard($data['guardname']);
			$data['working_hours'] = $this->guard_model->get_working_hours_overtime($data['fromdateg'], $data['todateg'], $data['guardname']);
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->load->view('guard/homeview_overtime',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else if($this->input->post('rangepostsubmit') != False)
		{
			$data['mode'] = 'rangeofdates_postname';
			$data['postnamer'] = $this->input->post('postnamer');
			$data['fromdatep'] = $this->input->post('fromdatep');
			$data['todatep'] = $this->input->post('todatep');
			$data['details_of_guards_at_a_post_in_a_range'] = $this->guard_model->get_details_of_guard_at_a_post_in_a_range_overtime($data['fromdatep'], $data['todatep'], $data['postnamer']);
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->load->view('guard/homeview_overtime',$data);
			$this->load->view('guard/view_footer');
			$this->drawFooter();
		}
		else
		{
			$this->drawHeader('View Overtime Duties');
			$this->load->view('guard/view_overtime',$data);
			$this->drawFooter();
		}
	}
	
}