<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_approval extends MY_Controller {

    function __construct() {
        parent::__construct(array('emp'));
        $this->load->model('leave/leave_constants');
    }
    
    function approve_or_decline_leave($emp_id, $leave_id) {
        
        // get current user id
        $current_user_id = $this->session->userdata('id');

        // get latest authority which approved this leave: id
        $this->load->model('leave/leave_users_details_model', 'ludm');
        $recent_auth_id = $this->ludm->get_latest_auth_id($leave_id);

        // verify double visit to approve, reject view
        // also verify if view is already canceled by user
        $this->load->model('leave/leave_basic_info_model', 'bm');
        $current_status = $this->bm->get_leave_status($leave_id);
        if ($current_status != Leave_constants::$PENDING || $current_user_id == $recent_auth_id) {
            // leave status eigther already canceled, approved or rejected
            $this->show_confirmation("You have already responded to this leave or leave has been canceled by user.");
            return;
        }

        // get info about leave
        $this->load->model('leave/leave_basic_info_model', 'bm');
        $leave = $this->bm->get_detail_leave_info($leave_id);
        
        // get approver user id
        $approving_user_id = $this->session->userdata('id');
                
        $data = array(
            'leave_details' => $leave
        );
        
        if (isset($_POST['approve'])) {
                
            // now get next verifier of the leave
            $leave_period = $this->get_leave_period($leave_id);
            $this->load->model('leave/leave_users_details_model', 'ludm');
            $notifiq_req = $this->ludm->get_next_authorizing_emp($approving_user_id, $leave_id, $leave_period);
            
            // update that leave has been seen at this stage
            $this->update_leave_status($approving_user_id, $leave_id);
            
//            var_dump($notifiq_req);
            
            // if notifiq_req is null means there is no one to receive further
            // update the status of leave to APPROVED and notify user that his leave
            // has been approved
            if (is_null($notifiq_req)) {
                $this->notify_requester($emp_id, $leave_id, Leave_constants::$APPROVED);
            }
            
            // if there is someone forward leave for approval to him/her
            else {
                
                // pass to next approver
                $this->notification->notify(
                        $notifiq_req['user_id'],
                        $notifiq_req['auth_id'],
                        "Leave Request",
                        "Your have pending leave request",
                        "leave/leave_history"
                       );
            }
            
            // dummy view
            // echo "Successful Approval!";
            $this->show_confirmation("Leave successfully approved by you.");
        }
        
        else if (isset($_POST['decline'])) {
            
            // update that leave has been seen at this stage
            $this->update_leave_status($approving_user_id, $leave_id);
            
            $this->notify_requester($emp_id, $leave_id, Leave_constants::$REJECTED);
            
            // this all will be refactored
            $this->update_balance($leave);
            
            // echo "Successful Rejection!";
            $this->show_confirmation("Leave successfully declined by you.");
        }
        
        else {
            $this->drawHeader();
            $this->load->view('leave/leave_approve_or_decline_view', $data);
            $this->drawFooter();
        }
    }
    
    
    // function which will return how long leave is taken
    function get_leave_period($leave_id) {
        
        // returning dummy value for now (11-02-2015 03:24:13 AM)
        return 2;
    }
    
    function update_leave_status($approver_id, $leave_id) {
        // check if already seen
        $this->load->model('leave/leave_status_model', 'lsm');
        $leave = $this->lsm->get_status($approver_id, $leave_id);
        
        if (is_null($leave)) {
            $this->lsm->add_leave_status($approver_id, $leave_id);
        }
    }
    
    function notify_requester($emp_id, $leave_id, $leave_status) {
        // udpate the status of the leave
        $this->load->model('leave/leave_basic_info_model', 'bm');
        $this->bm->update_leave_status($leave_id, $leave_status);

        // get user auth type
        /*$this->load->model('leave/leave_users_details_model', 'ludm');
        $requester_auth_type = $this->ludm->get_user_auth_type($emp_id);*/

//        var_dump($requester_auth_type);
        
        $title = "";
        $msg = "";
        
        switch ($leave_status) {
            case Leave_constants::$APPROVED:
                $title = "Leave Approved";
                $msg = "Your leave has been approved.";
                break;
            
            case Leave_constants::$REJECTED:
                $title = "Leave Rejected";
                $msg = "Your leave has been rejected.";
        }
        
        // notify user of its approval
        $this->notification->notify(
                $emp_id,
                'emp',
                $title,
                $msg,
                "leave/leave_history"
               );
    }
    
    function update_balance($leave) {
        
        switch ($leave['type']) {
            
            case Leave_constants::$TYPE_CASUAL_LEAVE:
                // get current bal
                $this->load->model('leave/leave_casual_model', 'cm');
                $current_bal = $this->cm->get_casual_leave_balance($leave['emp_id']);

                // initialize updated balance
                $updated_bal = $current_bal + $leave['period'];

                // query database for update
                $this->load->model('leave/leave_bal_model');
                $this->leave_bal_model->update_balance($leave['emp_id'], $updated_bal, Leave_constants::$TYPE_CASUAL_LEAVE);
                break;
            
            case Leave_constants::$TYPE_RESTRICTED_LEAVE:
                // get current bal
                $this->load->model('leave/leave_restricted_model', 'rm');
                $current_bal = $this->rm->get_restricted_leave_balance($leave['emp_id']);

                // initialize updated balance
                $updated_bal = $current_bal + 1;

                // query database for update
                $this->load->model('leave/leave_bal_model');
                $this->leave_bal_model->update_balance($leave['emp_id'], $updated_bal, Leave_constants::$TYPE_RESTRICTED_LEAVE);
                break;
        }
    }

    function show_confirmation($msg) {
        $data = array('msg' => $msg);

        $this->drawHeader('Leave Approval');
        $this->load->view('leave/leave_action_confirmation_view', $data);
        $this->drawFooter();
    }
}