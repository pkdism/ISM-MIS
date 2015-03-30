<?php

/**
 * Author: Majeed Siddiqui (samsidx)
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_cancel extends MY_Controller {

    const LEAVE_TYPE = 'leave_type';
    const NO_DATA = "$";

    var $emp_id;

    function __construct() {
        parent::__construct(array('emp'));
        $this->emp_id = $this->session->userdata('id');
        $this->addJS('leave/cancel_query.js');
        $this->load->model('leave/result');
        $this->load->model('leave/leave_constants');
    }

    function index() {

        // set data to send
        $data = array(
            'is_notification_on' => FALSE
        );

        // if cancel button is pressed
        if (isset($_POST['cancel'])) {
            $result = $this->validate_cancel_input();
            if (!$result->getResult()) {
                $data['is_notification_on'] = TRUE;
                $data['errors'] = $result->getErrors();
            }
            else {
                // update leave status to waiting for cancellation
                $this->load->model('leave/leave_basic_info_model', 'bm');
                $this->bm->update_leave_status($_POST['leave_to_cancel'], Leave_constants::$WAITING_CANCELLATION);

                // send request to higher authority to cancel leave
                $this->send_notification($_POST['leave_to_cancel']);

                // show confirmation view to user
                $this->show_confirmation("Your cancellation request has been forwaded to corresponding officer.");
                return;
            }
        }

        $this->drawHeader('Cancel Leave');
        $this->load->view('leave/leave_cancel_view', $data);
        $this->drawFooter();
    }

    function validate_input() {
        $result = new Result();
        if (!isset($_POST[Leave_cancel::LEAVE_TYPE])
            || $_POST[Leave_cancel::LEAVE_TYPE] == Leave_cancel::NO_DATA) {
            $result->setResult(FALSE);
            $result->addError("Please select type of leave");
        }
        return $result;
    }

    function validate_cancel_input() {
        $result = new Result();
        if (!isset($_POST['leave_to_cancel']) || empty($_POST['leave_to_cancel'])) {
            $result->setResult(FALSE);
            $result->addError("Please select leave to cancel");
        }
        return $result;
    }

    function send_notification($leave_id) {
        // now pass leave cancellation request to higher authority
        $this->load->model('leave/leave_users_details_model', 'lud');
        $user_auth_type = $this->lud->get_user_auth_type($this->emp_id);

        $higher_auth_type = '';
        $higher_user_id = '';

        if ($user_auth_type == 'ft' || $user_auth_type == 'emp') {
            $higher_auth_type = 'hod';
            $user_dept = $this->lud->get_user_dept($this->emp_id);
            $higher_user_id = $this->lud->get_dept_head($user_dept);
        }
        else if ($user_auth_type == 'hod') {
            $higher_auth_type = 'dt';
            $higher_user_id = $this->lud->get_director_user_id();
        }

        $this->notification->notify(
            $higher_user_id,
            $higher_auth_type,
            "Leave Cancellation Request",
            "You have a leave cancellation request from {$this->session->userdata('name')}",
            "leave/leave_cancel_permission/cancel_leave_request/{$this->emp_id}/{$leave_id}"
        );
    }

    function show_confirmation($msg) {
        $data = array('msg' => $msg);

        $this->drawHeader('Leave Cancellation');
        $this->load->view('leave/leave_action_confirmation_view', $data);
        $this->drawFooter();
    }
}
