<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Duties extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup','seo'));
		$this->addJS('employee/print_script.js');
	}
	
	function index()
	{
		$this->session->set_flashdata('flashError','Access Denied!');
		redirect('home');
	}
	
	function loadcompDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_list", array("DutyChart" => $this->guard_model->get_all_duties_chart()));
	}
	
	function loaddateDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/dateDutyChart_list", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+19800))));
	}
	
	function loadtomorrowDutyChart() {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/tomorrowDutyChart_list", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+86400+19800))));
	}
	
	function view()
	{
		$this->load->model('guard/guard_model');
		$this->addJS('guard/to_duty_chart.js');
		$this->addJS('guard/dateDutyChart-loader.js');
		$this->addJS('guard/tomorrowDutyChart-loader.js');
		$this->addJS('guard/compDutyChart-loader.js');
		
		$data['details_of_guards_at_a_date_today'] = $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+19800));
		$data['details_of_guards_at_a_date_tomorrow'] = $this->guard_model->get_details_of_guard_at_a_date(date("Y-m-d",strtotime(date("Y-m-d"))+86400+19800));
		$data['all_duties_chart'] = $this->guard_model->get_all_duties_chart();
		
		$this->drawHeader('View Duty Chart');
		$this->load->view('guard/to_duty_chart',$data);
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	
	}
	
	function assign_to_a_guard()
	{
		$this->load->model('guard/guard_model');
		
		if($this->input->post('assign') == TRUE)
		{
			$data = array('date'=>$this->input->post('date'),
						  'post_id'=>$this->input->post('post_id'),
						  'Regno'=>$this->input->post('regno'),
						  'shift'=>$this->input->post('shift')
						  );
			$this->guard_model->insert_into_duty($data);	
			$this->session->set_flashdata('flashSuccess','Duty has been assigned successfully.');
			redirect('guard/duties/tomorrow_chart');
		}
		
		$data['available_guards'] = $this->guard_model->get_available_guards();
		
		if(count($data['available_guards']) == 0)
		{
			$this->session->set_flashdata('flashError','All Guards are already assigned their duties.');
			redirect('guard/home');
		}
		
		$data['posts'] = $this->guard_model->get_posts();
		
		$this->drawHeader('Assign Duty to a Guard');
		$this->load->view('guard/assign_to_a_guard',$data);
		$this->drawFooter();
		
	}
	
	function assign_regular()
	{
		//$this->addJS('guard/assign_regular.js');
		$this->load->model('guard/guard_model');
		$data['guards'] = $this->guard_model->get_guards_with_duties();
		$data['posts'] = $this->guard_model->get_posts();
		
		// getting unique guards in the list
		$new_array = array();
		$array_regno = array();
		foreach($data['guards'] as $row)
		{
			if(!in_array($row["Regno"],$array_regno))
			{
				array_push($array_regno,$row["Regno"]);
				array_push($new_array,$row);
			}
		}
		$data['guards'] = $new_array;
		// end of unique guards
		$tomorrow_duties = $this->guard_model->get_all_tomorrow_duties();
		
		if(count($tomorrow_duties) != 0)
		{
			$this->session->set_flashdata('flashError','You have already assigned duties for tomorrow.');
			redirect('guard/home');
		}
		
		if($this->input->post('assignment') == TRUE)
		{
			foreach($data['guards'] as $row)
			{
				$shift = 'shift_'.$row['Regno'];
				$postname = 'postname_'.$row['Regno'];
				if($this->input->post($postname) == TRUE)
				{
					$date = date('Y-m-d',strtotime(date("Y-m-d"))+86400+19800);
					$data = array('date'=>$date,
								  'shift'=>$this->input->post($shift),
								  'Regno'=>$row['Regno'],
								  'post_id'=>$this->input->post($postname)
								  );
					$this->guard_model->insert_into_duty($data);	
				}
			}
			$this->session->set_flashdata('flashSuccess','Duties have been assigned successfully for tomorrow.');
			redirect('guard/duties/view');	
		}
		
		if(count($data['guards']) == 0 || count($data['posts']) == 0) 
		{
			$this->session->set_flashdata('flashError','There is no guard to assign duty.');
			redirect('guard/home');
		}
		
		$this->drawHeader('Assign Regular Duties');
		$this->load->view('guard/assign_regular',$data);
		$this->drawFooter();
	}
	
	function assign_overtime()
	{
		$this->addJS('guard/assign_overtime.js');
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
			
			$insert_return = $this->guard_model->insert_into_overtime($datum);
			if($insert_return == -1)
			{
				$this->session->set_flashdata('flashError','Sorry, you are not allowed to assign overtime duties before assigning regular duties.');
				redirect('guard/duties/assign_overtime',$data);
			}			
			else if($insert_return == -2)
			{
				$this->session->set_flashdata('flashError','Sorry, The guard is already assigned another duty for the time period.');
				redirect('guard/duties/assign_overtime',$data);
			}
			$this->session->set_flashdata('flashSuccess','Duty has been successfully assigned.');
			redirect('guard/duties/assign_overtime',$data);
		}
		
		$this->drawHeader('Assign Overtime Duty');
		$this->load->view('guard/assign_overtime',$data);
		$this->drawFooter();
	}
	
	
	function replace($regno='',$post_id='',$shift='',$date='')
	{
		$this->addJS('guard/replace.js');
		$this->load->model('guard/guard_model');
		
		if($this->input->post('replace') != FALSE)
		{
			$date = $this->input->post('date');
			$shift = $this->input->post('shift');
			$guard_id = $this->input->post('guard_id');
			$regno = $this->input->post('regno');
			$post_id = $this->input->post('post_id');
			$remarks = $this->input->post('remarks');
			
			$data = array('date'=>$date,
							  'shift'=>$shift,
							  'Regno'=>$guard_id,
							  'post_id'=>$post_id,
							  'remarks'=>$remarks
							  );
			$this->guard_model->update_duty($data, $regno);
		
			$this->session->set_flashdata('flashSuccess','Duty has been replaced successfully.');
			redirect('guard/duties/view');		
		}
		
		if($regno=='' || $post_id=='' || $shift=='' || $date=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$data['all_gaurds_at_same_shift'] = $this->guard_model->get_all_guards_at_same_shift_post($shift,$date);
		
		$data['regno'] = $regno;
		$data['post_id'] = $post_id;
		$data['date']  = $date;
		$data['shift'] = $shift;
		$data['postname'] = $this->guard_model->get_postname_of_a_post_id($post_id)->postname;
		$data['guarddetails'] = $this->guard_model->get_guard_details($regno);
		
		$this->drawHeader('Replace Guard');
		$this->load->view('guard/replace',$data);
		$this->drawFooter();

	}
	
	function remove($regno='',$post_id='',$shift='',$date='')
	{
		$this->load->model('guard/guard_model');
		
		if($regno=='' || $post_id=='' || $shift=='' || $date=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
			
		if($this->guard_model->remove_from_duty($regno,$post_id,$shift,$date)) 
			$this->session->set_flashdata('flashSuccess','Duty has been removed successfully.');
		else
			$this->session->set_flashdata('flashError','Try Again!, There is some error in removing the guard.');
		if($date == date("Y-m-d",strtotime(date("Y-m-d"))+19800))
			redirect('guard/duties/today_chart');
		else
			redirect('guard/duties/tomorrow_chart');		
	}
}

?>