<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('guard_sup','seo'));
		$this->addJS('employee/print_script.js');
	}
	
	function index()
	{
		$this->addJS('guard/home.js');
		$this->load->model('guard/guard_model','',TRUE);
		
		$data['postnames'] = $this->guard_model->get_postnames();
		$data['guardnames'] = $this->guard_model->get_guardnames();
		
		$this->drawHeader('Guard Management Home');
		$this->load->view('guard/home',$data);
		$this->drawFooter();
	}
	
	function loadpostDutyChart($postname) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listR", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_post($postname)));
	}
	function loadpostDutyChartOvertime($postname) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listO", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_post_overtime($postname)));
	}
	
	function loaddateDutyChart($date) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listR", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date($date)));
	}
	
	function loaddateDutyChartOvertime($date) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listO", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_date_overtime($date)));
	}
	
	function loadrangeDutyChart($fromdate,$todate) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listR", array("DutyChart" => $this->guard_model->get_details_of_guards_in_a_range($fromdate,$todate)));
	}
	
	function loadrangeDutyChartOvertime($fromdate,$todate) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listO", array("DutyChart" => $this->guard_model->get_details_of_guards_in_a_range_overtime($fromdate,$todate)));
	}
	
	function loadrangepostDutyChart($fromdate,$todate,$postid) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listR", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_post_in_a_range($fromdate,$todate,$postid)));
	}
	
	function loadrangepostDutyChartOvertime($fromdate,$todate,$postid) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listO", array("DutyChart" => $this->guard_model->get_details_of_guard_at_a_post_in_a_range_overtime($fromdate,$todate,$postid)));
	}
	
	function loadrangeguardDutyChart($fromdate,$todate,$guardid) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listR", array("DutyChart" => $this->guard_model->get_details_of_guard_in_a_range($fromdate,$todate,$guardid)));
	}
	
	function loadrangeguardDutyChartOvertime($fromdate,$todate,$guardid) {
		$this->load->model('guard/guard_model');
		$this->load->view("guard/DutyChart_listO", array("DutyChart" => $this->guard_model->get_details_of_guard_in_a_range_overtime($fromdate,$todate,$guardid)));
	}
	
}	
