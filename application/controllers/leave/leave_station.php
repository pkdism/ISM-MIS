<?php

/**
 * Author: Nishant Raj
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_station extends MY_Controller {


	// names in form field
	const START_DATE = 'leave_st_date';
	const END_DATE = 'return_st_date';
    const START_TIME = 'st_leaving_time';
    const END_TIME = 'st_arrival_time';
	const PURPOSE = 'purpose';
	const ADDR = 'address';
    const NEXT_EMP = 'emp_name';

    var $emp_id;

    function __construct() {
        parent::__construct(array('emp'));
        $this->emp_id = $this->session->userdata('id');
        $this->addJS("leave/deo_query.js");
        $this->load->model("leave/leave_station_model", 'lsm');
        $this->load->model('employee_model');
        $this->load->model('user_model', 'um');
        $this->load->model('departments_model');
        $this->load->model('leave/leave_users_details_model', 'ludm');
        $this->load->model('designations_model');
        $this->load->model('employee_model');
        $this->load->model('leave/leave_bal_model', 'lbm');
        $this->load->model('leave/leave_constants');
    }

    function index() {
        $data['notification'] = false;
        $this->drawHeader('Leave Station Form');
        $this->load->view('leave/leave_station/leave_station_view', $data);
        $this->drawFooter();
    }

    function applyStationLeave()
    {
        $data = array();
        $data['notification'] = false;
        $leaving_date = $this->input->post(Leave_station::START_DATE);
        $leaving_time = $this->input->post(Leave_station::START_TIME);
        $arrival_date = $this->input->post(Leave_station::END_DATE);
        $arrival_time = $this->input->post(Leave_station::END_TIME);
        $purpose = $this->input->post(Leave_station::PURPOSE);
        $address = $this->input->post(Leave_station::ADDR);
        $next_emp = $this->input->post(Leave_station::NEXT_EMP);

        $current_time = date('Y-m-d');

        $leave_id = $this->lsm->get_station_leave_id($this->emp_id, $current_time, $leaving_date, $leaving_time, $arrival_date, $arrival_time);

        $leave_status = $this->lsm->get_station_leave_status($leave_id);
        if ($leave_id != NULL && $leave_status != Leave_constants::$CANCELED) {
            $data['notification'] = true;
            $data['type'] = 'danger';
            $data['string'] = " You have previously applied station leave for same time and date . Please try again";
        } else if ($arrival_date < $leaving_date) {
            $data['notification'] = true;
            $data['type'] = 'danger';
            $data['string'] = " Arrival date should be greater than or equal to Leaving date";
        } else {

            $this->lsm->insert_station_leave_details($this->emp_id, $leaving_date, $leaving_time, $arrival_date, $arrival_time, $purpose, $address);
            $leave_id = $this->lsm->get_station_leave_id($this->emp_id, $current_time, $leaving_date, $leaving_time, $arrival_date, $arrival_time);
            $this->lsm->insert_station_leave_status($leave_id, $this->emp_id, $next_emp, Leave_constants::$PENDING);

            //notification Sending to selected Employee
            $type = Leave_constants::$PENDING;
            $auth_type = "admin";
            $this->push_notification($leave_id, $next_emp, $auth_type, $type, Leave_constants::$PENDING, "");
            $data['notification'] = true;
            $data['type'] = 'success';
            $data['string'] = 'Your leave have been Applied successfully and sent to selected employee';
        }

        $this->drawHeader('Leave Station Form');
        $this->load->view('leave/leave_station/leave_station_view', $data);
        $this->drawFooter();
    }

    function push_notification($leave_id, $next_emp, $auth_type, $type, $action_type, $fwd_to)
    {

        $leave_details = $this->lsm->get_station_leave_by_id($leave_id);
        $leave_requesting_employee = $leave_details['emp_id'];
        $leave_requesting_employee_name = $this->lsm->get_user_name_by_id($leave_requesting_employee);
        if ($auth_type == "admin") {
            if ($type == Leave_constants::$PENDING) {
                $path = 'leave/leave_station/station_leave_approve/' . $leave_id . '/' . $next_emp . '/' . $leave_requesting_employee . '/' . $type;
            } else {
                $path = 'leave/leave_station/pendingStationLeaveStatus';
            }
        } else {
            $path = 'leave/leave_station/stationLeaveHistory';
        }
        if ($auth_type == 'emp') {
            if ($action_type == Leave_constants::$APPROVED) {
                $request_type = "Station Leave Approved";
                $message = "Your Station Leave has been Approved by " . $this->lsm->get_user_name_by_id($this->emp_id);
            } else if ($action_type == Leave_constants::$FORWARDED) {
                $request_type = "Station Leave Forwarded";
                $message = "Your Station Leave Has been forwarded by " . $this->lsm->get_user_name_by_id($this->emp_id) . " to " . $this->lsm->get_user_name_by_id($fwd_to);
            } else {
                $request_type = "Station Leave Rejected";
                $message = "Your Station Leave has been Rejected by " . $this->lsm->get_user_name_by_id($this->emp_id);
            }
        } else {
            if ($action_type == Leave_constants::$PENDING) {
                $request_type = "Station Leave Request";
                $message = "You Have Station Leave request from " . $leave_requesting_employee_name;
            } else if ($action_type == Leave_constants::$FORWARDED) {
                $request_type = "Station Leave Request";
                $message = "Station Leave Request of " . $leave_requesting_employee_name . " has been Forwarded to you by " . $this->lsm->get_user_name_by_id($this->emp_id);
            }
        }
        $this->notification->notify(
            $next_emp,
            'emp',
            $request_type,
            $message,
            $path
        );
    }

    function stationLeaveHistory()
    {

        $data = array();

        $data = $this->lsm->get_station_leave_history($this->emp_id);

        //var_dump($data);
        $this->drawHeader('Station Leave History');
        $this->load->view('leave/leave_station/station_leave_history_view', $data);
        $this->drawFooter();
    }

    function pendingStationLeaveStatus()
    {

        $data = $this->lsm->get_pending_station_leave($this->emp_id);
//        var_dump($data);
        $this->drawHeader('Pending Leave for Approval/Cancel/Forward');
        $this->load->view('leave/leave_station/pending_station_leave', $data);
        $this->drawFooter();
    }

    /**
     * @param $leave_id
     * @param $next_emp_id
     * @param $emp_id
     */
    function station_leave_approve($leave_id, $next_emp_id, $emp_id, $rqst_type)
    {

        $data = array();
        $temp = $this->lsm->get_station_leave_by_id($leave_id);
        if (($temp['status'] == Leave_constants::$PENDING || $temp['status'] == Leave_constants::$FORWARDED ||
                $temp['status'] == Leave_constants::$WAITING_CANCELLATION) && $next_emp_id == $temp['next_emp']
        ) {
            $data['leave_details'] = $temp;
            $data['respond'] = false;
            $details = $this->employee_model->getById($emp_id);
            $data['type'] = $rqst_type;
            $data['emp'] = $details;
            $data['img_path'] = $emp_id . "/";
            $data['img_path'] .= $this->um->getPhotoById($emp_id);
            $data['leave_id'] = $leave_id;
            $data['next_emp'] = $next_emp_id;
            $data['emp_id'] = $emp_id;
            $data['leave_user_id'] = $this->get_user_id_by_leave_id($leave_id);
            $data['name'] = $this->lsm->get_user_name_by_id($emp_id);
            //$this->insert_station_leave_status($leave_id , $next_emp_id , $next_emp_id , Leave_constants::$APPROVED );
        } else
            $data['respond'] = true;

        $this->drawHeader('Leave Approve/Reject/Forward');
        $this->load->view('leave/leave_station/leave_station_approval_view', $data);
        $this->drawFooter();

    }

    function get_user_id_by_leave_id($leave_id)
    {

        $result = $this->lsm->get_station_leave_by_id($leave_id);
        return $result['emp_id'];
    }

    function cancelStationLeave()
    {

        $data = array();
        $data = $this->lsm->getCancellableStationLeave($this->emp_id);

        $this->drawHeader('Leave Cancellation Page');
        $this->load->view('leave/leave_station/cancel_station_leave_view', $data);
        $this->drawFooter();
    }

    /**
     * @param $leave_id
     * @param $cur_emp
     * @param $next_emp
     * @param $status
     */
    function insert_station_leave_status($leave_id, $cur_emp, $next_emp, $status)
    {
        var_dump($leave_id);
        $this->lsm->insert_station_leave_status($leave_id, $cur_emp, $next_emp, $status);
    }

    function isWeekend($date) {
    	$week_day = date('w', strtotime($date));

    	if ($week_day != 0 && $week_day != 6) {
    		return FALSE;
    	}

    	return TRUE;
    }

    function getLeaveLength($leave_start_date, $leave_end_date) {
    	$start_time = strtotime($leave_start_date);
    	$end_time = strtotime($leave_end_date);
    	$two_days = ($end_time - $start_time) / (24 * 60 * 60) + 1;

    	if ($two_days > 2 || $two_days <= 0) {
    		return FALSE;
    	}

    	return TRUE;
    }

    function insertIntoStationTable() {
    	$this->load->model('leave/leave_station', 'ls');
    	$this->ls->insert(
            $this->emp_id,
    		$_POST[Leave_station::START_DATE],
    		$_POST[Leave_station::END_DATE],
    		$_POST[Leave_station::START_TIME],
    		$_POST[Leave_station::END_TIME],
    		$_POST[Leave_station::PURPOSE],
    		$_POST[Leave_station::ADDR],
            NULL
    	);
    }  
}