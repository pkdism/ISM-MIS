<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_application extends MY_Controller {
    
    var $emp_id;
    
    const LEAVE_TYPE = 'leave_type';
    const LEAVE_PURPOSE = 'leave_purpose';
    const LEAVE_START_DATE = 'leave_start_date';
    const LEAVE_END_DATE = 'leave_end_date';
    
    // casual leave special ids and vals
    const LEAVE_CASUAL_PERIOD = 'leave_casual_period';
    const LEAVE_PERIOD_HALF = 'Half Leave';
    const LEAVE_J_NOON = 'leave_j_noon';
    const LEAVE_BF_NOON = 'Before Noon';
    
    const EMPTY_VAL = "$";
    
    function __construct() {
        parent::__construct(array('emp'));
        $this->emp_id = $this->session->userdata('id');
        $this->load->model('leave/leave_basic_info_model', 'bm');
        $this->load->model('leave/leave_casual_model', 'cm');
        $this->load->model('leave/leave_restricted_model', 'rm');
        $this->load->model('leave/leave_constants');
        $this->load->model('leave/result');
    }
    
    function index() {
        
        $data = array(
            'is_notification_on' => FALSE
        );
        
        if (isset($_POST['submit'])) {
            $result = $this->find_errors();
            $data['is_notification_on'] = TRUE;
            
            if (!$result->getResult()) {
                $data['errors'] = $result->getErrors();
            }
            else {
                $leave_id = $this->insert_basic_leave_info();
                $this->insert_corressponding_leave($leave_id);
                $data['success_msg'] = "Your leave has been forwaded to corresponding officer.";
            }
        }
        
        $this->drawHeader('Leave Application');
        $this->load->view('leave/leave_application_view', $data);
        $this->drawFooter();
    }
    
    function find_errors() {
        
        // check for emptiness of all fields
        $result = $this->is_required_data_filled();
        if (!$result->getResult()) {
            return $result;
        }
        
        // check for valid date fields
        $result = $this->is_valid_date_field();
        if (!$result->getResult()) {
            return $result;
        }
        
        // check for valid leave period
        $result = $this->is_valid_leave_dates();
        if (!$result->getResult()) {
            return $result;
        }
        
        return $result;
    }
    
    /**
     * This function evaluates emptiness of fields
     * @return \Result
     */
    function is_required_data_filled() {
        $result = new Result();
        
        // check for leave type
        if ($_POST[Leave_application::LEAVE_TYPE] == Leave_application::EMPTY_VAL) {
            $result->setResult(FALSE);
            $result->addError("Please select type of leave.");
        }
        
        // check for leave start date
        if (empty($_POST[Leave_application::LEAVE_START_DATE])) {
            $result->setResult(FALSE);
            $result->addError("Please select start date.");
        }
        
        // if leave is not of restricted type check for end date
        if ($_POST[Leave_application::LEAVE_TYPE] != Leave_constants::$TYPE_RESTRICTED_LEAVE) {
            // check for leave end date
            if (empty($_POST[Leave_application::LEAVE_END_DATE])) {
                $result->setResult(FALSE);
                $result->addError("Please select end date.");
            }
        }
        
        // check for casual leave extra data if start date == end date
        if ($_POST[Leave_application::LEAVE_TYPE] === Leave_constants::$TYPE_CASUAL_LEAVE &&
                $_POST[Leave_application::LEAVE_START_DATE] === $_POST[Leave_application::LEAVE_END_DATE] &&
                $result->getResult()
            ) {
            
            // check if half or full is marked
            if ($_POST[Leave_application::LEAVE_CASUAL_PERIOD] == Leave_application::EMPTY_VAL) {
                $result->setResult(FALSE);
                $result->addError("For casual leave of single day, please specify period half or full");
            }
            
            // if it is not empty and it set to half check for j_noon
            else if ($_POST[Leave_application::LEAVE_CASUAL_PERIOD] == Leave_application::LEAVE_PERIOD_HALF
                        && ($_POST[Leave_application::LEAVE_J_NOON] == Leave_application::EMPTY_VAL)) {
                $result->setResult(FALSE);
                $result->addError("Please select in which half you want to take leave, before noon or after noon");
            }
        }        
        
        // check for purpose
        if (empty($_POST[Leave_application::LEAVE_PURPOSE])) {
            $result->setResult(FALSE);
            $result->addError("Please mention purpose.");
        }

        return $result;
    }
    
    
    /*
     * This function checks for valid date format: yyyy/mm/dd
     */
    function is_valid_date_field() {
        // validate emptiness and format of date
        // start date <= end date
        // start date > todays date
        // start date must be less than 3 months from today
        
        // result to return
        $result = new Result();
        
        // check for valid start date
        $start_date = strtotime($_POST[Leave_application::LEAVE_START_DATE]);
        if (empty($start_date) || $start_date == FALSE) {
            $result->setResult(FALSE);
            $result->addError("Invalid start date format. It should be in format mm/dd/yyyy");
        }
        
        // check for valid end date if not restricted leave
        if (Leave_constants::$TYPE_RESTRICTED_LEAVE != $_POST[Leave_application::LEAVE_TYPE]) {
            
            // check for empty or invalid date field
            $end_date = strtotime($_POST[Leave_application::LEAVE_END_DATE]);
            if (empty($end_date) || $end_date == FALSE) {
                $result->setResult(FALSE);
                $result->addError("Invalid end date format. It should be in format mm/dd/yyyy");
            }
                    
            // check if start date <= end date
            $diff = $end_date - $start_date;
            if ($diff < 0) {
                $result->setResult(FALSE);
                $result->addError("End date can not be before start date. Valid date format mm/dd/yyyy");
            }
        }

        // check if start date > todays date
        $today = strtotime(date('Y-m-d'));
        $diff = $start_date - $today;
        if ($diff <= 0) {
            $result->setResult(FALSE);
            $result->addError("Start date should be after today's date. Valid date format mm/dd/yyyy");
        }
        
        // leave can be applied only before 90 days from today
        $three_months_time = 90 * 24 * 60 * 60;
        if ($diff > $three_months_time) {
            $result->setResult(FALSE);
            $result->addError("Leave can be applied within 90 days from today");
        }
        
        return $result;
    }
    
    /*
     * This function call corresponding leave validators for correct dates
     */
    function is_valid_leave_dates() {
        switch($_POST[Leave_application::LEAVE_TYPE]) {
            
            // if casual leave
            case Leave_constants::$TYPE_CASUAL_LEAVE:
                return $this->cm->is_valid_casual_leave(
                                $this->emp_id,
                                $_POST[Leave_application::LEAVE_START_DATE],
                                $_POST[Leave_application::LEAVE_END_DATE]
                            );
                
            // if restricted leave
            case Leave_constants::$TYPE_RESTRICTED_LEAVE:
                return $this->rm->is_valid_restricted_leave(
                                $this->emp_id,
                                $_POST[Leave_application::LEAVE_START_DATE]
                            );
        }
    }
    
    function insert_basic_leave_info() {
        // insert leave basic info
        return $this->bm->insert_leave_basic_info(
                    date('Y-m-d'),
                    $_POST[Leave_application::LEAVE_PURPOSE],
                    $_POST[Leave_application::LEAVE_TYPE],
                    $this->emp_id,
                    Leave_constants::$PENDING
                  );
    }
    
    function insert_corressponding_leave($leave_id) {
        
        switch($_POST[Leave_application::LEAVE_TYPE]) {

            // insert if casual leave
            case Leave_constants::$TYPE_CASUAL_LEAVE:
                $this->make_casual_leave_request($leave_id);
                break;

            // insert if restricted leave
            case Leave_constants::$TYPE_RESTRICTED_LEAVE:
                $this->make_restricted_leave_request($leave_id);
                break;
        }
    }
    
    function send_notification($leave_id, $leave_type) {
        // update leave status table
        $this->load->model('leave/leave_status_model');
        $this->leave_status_model->add_leave_status($this->emp_id, $leave_id);

        // now pass leave request to higher authority
        $this->load->model('leave/leave_users_details_model', 'lud');
        $notif_req = $this->lud->get_next_authorizing_emp($this->emp_id, $leave_id, 1);
        $this->notification->notify(
                $notif_req['user_id'], 
                $notif_req['auth_id'], 
                "Leave Request", 
                "You have a {$leave_type} leave request from {$this->session->userdata('name')}",
                "leave/leave_approval/approve_or_decline_leave/$this->emp_id/$leave_id"
               );
    }
    
    function make_casual_leave_request($leave_id) {
        // get leave period
        $leave_period = strtotime($_POST[Leave_application::LEAVE_END_DATE]) 
            - strtotime($_POST[Leave_application::LEAVE_START_DATE]);
        $leave_period = floor($leave_period / (60 * 60 * 24)) + 1;
        $j_noon = 0;

        // if leave is for one day check if it for half day or full day
        if ($leave_period == 1 && 
                $_POST[Leave_application::LEAVE_CASUAL_PERIOD] == Leave_application::LEAVE_PERIOD_HALF) {
            $leave_period = 0.5;

            // if it is half day check which half, before noon or after noon
            if ($_POST[Leave_application::LEAVE_J_NOON] == Leave_application::LEAVE_BF_NOON) {
                $j_noon = 1;
            }
            else {
                $j_noon = 2;
            }
        }

        // do the insertion
        $is_successful = $this->cm->insert_casual_leave(
                            $leave_id,
                            $_POST[Leave_application::LEAVE_START_DATE],
                            $_POST[Leave_application::LEAVE_END_DATE],
                            $leave_period,
                            $j_noon
                        );

        if ($is_successful) {
            /** update the balance table **/
            // get current bal
            $current_bal = $this->cm->get_casual_leave_balance($this->emp_id);

            // initialize updated balance
            $updated_bal = $current_bal - $leave_period;

            // query database for update
            $this->load->model('leave/leave_bal_model');
            $this->leave_bal_model->update_balance($this->emp_id, $updated_bal, Leave_constants::$TYPE_CASUAL_LEAVE);

            // send notification
            $this->send_notification($leave_id, Leave_constants::$TYPE_CASUAL_LEAVE);
        }

        // TODO: because of internal error insertion fails notify user about that
        else {

        }
    }
    
    function make_restricted_leave_request($leave_id) {
        // add restricted leave to table
        $is_successful = $this->rm->insert_restricted_leave(
                            $leave_id,
                            $_POST[Leave_application::LEAVE_START_DATE]
                          );
                
        if ($is_successful) {
            /** update the balance table **/
            // get current bal
            $current_bal = $this->rm->get_restricted_leave_balance($this->emp_id);

            // initialize updated balance
            $updated_bal = $current_bal - 1;

            // query database for update
            $this->load->model('leave/leave_bal_model');
            $this->leave_bal_model->update_balance($this->emp_id, $updated_bal, Leave_constants::$TYPE_RESTRICTED_LEAVE);

            // send notification
            $this->send_notification($leave_id, Leave_constants::$TYPE_RESTRICTED_LEAVE);
        }
    }
}

