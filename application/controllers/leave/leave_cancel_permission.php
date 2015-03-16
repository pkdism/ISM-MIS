<?php
/**
 * Author: Majeed Siddiqui (samsidx)
*/
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_cancel_permission extends MY_Controller {

	var $emp_id;

	function __construct() {
		parent::__construct(array('emp'));
    $this->load->model('leave/leave_constants');
	}

	function cancel_leave_request($emp_id, $leave_id) {
		// initilize class vars
		$this->emp_id = $emp_id;

		// check if request is already responded
		$this->load->model('leave/leave_basic_info_model', 'bm');
    $current_status = $this->bm->get_leave_status($leave_id);
    if ($current_status != Leave_constants::$WAITING_CANCELLATION) {
        // leave status eigther already canceled, approved or rejected
        $this->show_confirmation("You have already responded to this leave cancel request.");
        return;
    }

    // get info about leave
    $this->load->model('leave/leave_basic_info_model', 'bm');
    $leave = $this->bm->get_detail_leave_info($leave_id);

    $data = array(
        'leave_details' => $leave,
        'args' => "/{$emp_id}/{$leave_id}"
      );

    // if approve is clicked
		if (isset($_POST['approve'])) {
			// fetch leave basic info
      $this->load->model('leave/leave_basic_info_model', 'bm');
      $leave_basic_info = $this->bm->get_leave_basic_info($leave_id);
      
      // debug
      // $data['canceled_leave'] = $leave_basic_info;
      
      // cancel the leave and notify user
      $this->cancel_leave($leave_basic_info);
      $this->send_user_notification("Your leave cancel request has been approved.");

      // take to confirmation page
      $this->show_confirmation("You have successfully approved leave cancellation request.");
		}

    // if decline is clicked
		else if (isset($_POST['decline'])) {
			// notify user
			$this->send_user_notification("Your leave cancel request has been declined.");

			// if leave status is waiting for cancellation change it again to approved
			$this->load->model('leave/leave_basic_info_model', 'bm');
			$current_status = $this->bm->get_leave_status($leave_id);
			if ($current_status == Leave_constants::$WAITING_CANCELLATION) {
				$this->bm->update_leave_status($leave_id, Leave_constants::$APPROVED);
			}

			// take to confirmation page
			$this->show_confirmation("You have successfully declined leave cancellation request.");
		}

    // show default
		else {
			$this->drawHeader();
      $this->load->view('leave/leave_approve_or_decline_view', $data);
      $this->drawFooter();
		}
	}

	function cancel_leave($leave_basic_info) {
      switch ($leave_basic_info['type']) {
      	// if cancellation request is for casual leave
        case Leave_constants::$TYPE_CASUAL_LEAVE:
          
          $today = strtotime(date('Y-m-d'));
          
          $this->load->model('leave/leave_casual_model', 'cl');
          $leave = $this->cl->get_casual_leave($leave_basic_info['id']);
          
          if (!is_null($leave)) {
              $leave_start_time = strtotime($leave['leave_start_date']);
              
              if ($leave_start_time >= $today) {
                  $this->cancel_whole_leave($leave_basic_info['id']);
                  
                  // get how long leave was taken
                  $period = $this->cl->get_casual_leave_period($leave_basic_info['id']);
                  
                  // get current bal
                  $current_bal = $this->cl->get_casual_leave_balance($this->emp_id);
                  
                  // updated bal
                  $updated_bal = $current_bal + $period;
                  
                  // update the balance table
                  $this->load->model('leave/leave_bal_model', 'lbm');
                  $this->lbm->update_balance($this->emp_id, $updated_bal, Leave_constants::$TYPE_CASUAL_LEAVE);
              }
              else {
                  $this->cl->update_end_date($leave_basic_info['id'], date('Y-m-d'));
          
                  /** update the balance table **/
                  // get remaining leave period
                  $leave_end_time = strtotime($leave_basic_info['leave_end_date']);
                  $leave_remain_period = floor(($leave_end_time - $today) / (60 * 60 * 24));
      
                  // get current bal
                  $current_bal = $this->cl->get_casual_leave_balance($this->emp_id);
                  
                  // updated bal
                  $updated_bal = $current_bal + $leave_remain_period;
                  
                  // update the balance table
                  $this->load->model('leave/leave_bal_model', 'lbm');
                  $this->lbm->update_balance($this->emp_id, $updated_bal, Leave_constants::$TYPE_CASUAL_LEAVE);
              }
          }
          break;

        // if cancellation request is for restricted leave
        case Leave_constants::$TYPE_RESTRICTED_LEAVE:
          $this->cancel_whole_leave($leave_basic_info['id']);
          
          /** update the balance table **/
          // get current bal
          $this->load->model('leave/leave_restricted_model', 'rl');
          $current_bal = $this->rl->get_restricted_leave_balance($this->emp_id);
                  
          // updated bal
          $updated_bal = $current_bal + 1;

          // update the balance table
          $this->load->model('leave/leave_bal_model', 'lbm');
          $this->lbm->update_balance($this->emp_id, $updated_bal, Leave_constants::$TYPE_RESTRICTED_LEAVE);
          break;
      }
    }
    
    function cancel_whole_leave($leave_id) {
        $this->load->model('leave/leave_basic_info_model', 'bm');
        $this->bm->update_leave_status($leave_id, Leave_constants::$CANCELED);
    }

		function show_confirmation($msg) {
        $data = array('msg' => $msg);

        $this->drawHeader('Leave Cancellation');
        $this->load->view('leave/leave_action_confirmation_view', $data);
        $this->drawFooter();
    }

    function send_user_notification($msg) {
    	$this->notification->notify(
    		  $this->emp_id,
    		  'emp',
    		  'Leave Cancel Request Status',
    		  $msg,
    		  'leave/leave_history'
    		);
    }
}