<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'result.php';

class Leave_helper extends CI_Model {
    
    var $emp_id;
    
    var $leave_start_date;
    var $leave_end_date;
    
    var $leave_start_time;
    var $leave_end_time;
    
    var $year_from;
    var $year_to;
    
    function __construct() {
        parent::__construct();
    }
    
    function verify_leaves_period($emp_id, $leave_start_date, $leave_end_date) {
        $result = new Result();
       
        /** Initialize class vars **/
        $this->emp_id = $emp_id;
        
        $this->leave_start_date = $leave_start_date;
        $this->leave_end_date = $leave_end_date;
        
        $this->leave_start_time = strtotime($leave_start_date);
        $this->leave_end_time = strtotime($leave_end_date);
        
        $this->year_from = date('Y', $this->leave_start_time);
        $this->year_to = date('Y', $this->leave_end_time);
        /** End: Initialize class vars **/
        
        $result->updateResult($this->check_clash_with_vacation());
        
        $result->updateResult($this->check_clash_with_casual_leaves());
        
        $result->updateResult($this->check_clash_with_restricted_leaves());
        
        $result->updateResult($this->check_prefix());
        
        $result->updateResult($this->check_suffix());
        
        $result->updateResult($this->check_for_weekend());
        
        return $result;
    }
    
    
    // check if leave is comming into vacation period
    function check_clash_with_vacation() {
        $result = new Result();
        
        $this->load->model('leave/leave_constants');
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_VACATION_DATES.
                " WHERE (start_date <= $this->leave_start_date and end_date >= $this->leave_start_date) "
                . "or ($this->leave_start_date <= start_date and $this->leave_end_date >= start_date)";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() > 0) {
            $period = $query->result_array()[0];
            
            $result->setResult(FALSE);
            if ($period['start_date'] !== $period['end_date']) {
                $error = "Your leave comes into vacation period from ".
                        $period['start_date']." and ".$period['end_date'];
            }
            else {
                $error = "Your leave clashes with vacation at ".$period['start_date'];
            }
            $result->addError($error);
        }
        
        return $result;
    }
    
    // check with already requested(approved or pending) casual leave
    function check_clash_with_casual_leaves() {
        $result = new Result();
        
        // load casual leave model and get casual leaves
        $this->load->model('leave/leave_casual_model', 'cm');
        $casual_leaves = $this->cm->get_casual_leaves_for_employee($this->emp_id, $this->year_from, $this->year_to);
        
        foreach($casual_leaves as $leave) {
            $current_leave_start_time = strtotime($leave['leave_start_date']);
            $current_leave_end_time = strtotime($leave['leave_end_date']);
            
            if (($current_leave_start_time <= $this->leave_start_time && $current_leave_end_time >= $this->leave_start_time) ||
                ($this->leave_start_time <= $current_leave_start_time && $this->leave_end_time >= $current_leave_start_time)) {
                
                $result->setResult(FALSE);
                
                if ($leave['leave_start_date'] != $leave['leave_end_date']) {
                    $error = "Your leave period clashes with already requested casual leave from "
                            .$leave['leave_start_date']." and ".$leave['leave_end_date'];
                }
                else {
                    $error = "Your leave period clashes with already requested casual leave at "
                            .$leave['leave_start_date'];
                }
                
                $result->addError($error);
            }    
        }
        
        return $result;
    }
    
    // check with already requested(approved or pending) restricted leave
    function check_clash_with_restricted_leaves() {
        $result = new Result();
        
        // load restricted leave model and get restricted leaves
        $this->load->model('leave/leave_restricted_model', 'rm');
        $restricted_leave = $this->rm->get_restricted_leaves_for_employee($this->emp_id, $this->year_from, $this->year_to);
        
        foreach ($restricted_leave as $leave) {
            $current_leave_time = strtotime($leave['leave_date']);
            
            if ($this->leave_start_time <= $current_leave_time && $this->leave_end_time >= $current_leave_time) {
                $result->setResult(FALSE);
                $error = "Your leave period clashes with already "
                        . "requested restricted leave at ".$leave['leave_date'];
                $result->addError($error);
            }
        }
        
        return $result;
    }
    
    function check_prefix() {
        
        // result to return
        $result = new Result();
        
        $result->updateResult($this->check_prefix_with_casual_leave());
        if (!$result->getResult()) {
            return $result;
        }
        
        $result->updateResult($this->check_prefix_with_restricted_leave());
        if (!$result->getResult()) {
            return $result;
        }
        
        return $result;
    }
    
    function check_suffix() {
        
        // result to return
        $result = new Result();
        
        $result->updateResult($this->check_suffix_with_casual_leave());
        if (!$result->getResult()) {
            return $result;
        }
        
        $result->updateResult($this->check_suffix_with_restricted_leave());
        if (!$result->getResult()) {
            return $result;
        }
        
        return $result;
    }
    
    function check_prefix_with_casual_leave() {
        // restul to return
        $result = new Result();
        
        // get leave just before the start date of applied leave
        $this->load->model('leave/leave_casual_model', 'cl');
        $leave = $this->cl->get_casual_leave_before($this->leave_start_date);
        
        if (!is_null($leave)) {
            $leave_end_time = strtotime($leave['leave_end_date']);
            if ($leave_end_time + 60 * 60 * 24 == $this->leave_start_time) {
                $result->setResult(FALSE);
                $result->addError("Your leave is suffix to already applied leave, "
                        . "if you want to take combination of leaves please go through portal");
                return $result;
            }
        }
        
        return $result;
    }
    
    function check_suffix_with_casual_leave() {
        // result to return
        $result = new Result();
        
        // get leave just after the end date of applied leave
        $this->load->model('leave/leave_casual_model', 'cl');
        $leave = $this->cl->get_casual_leave_after($this->leave_end_date);
        
        if (!is_null($leave)) {
            $leave_start_time = strtotime($leave['leave_start_date']);
            if ($leave_start_time == $this->leave_end_time + 60 * 60 * 24) {
                $result->setResult(FALSE);
                $result->addError("Your leave is prefix to already applied leave, "
                        . "if you want to take combination of leaves please go through portal");
                return $result;
            }
        }
        
        return $result;
    }
    
    function check_prefix_with_restricted_leave() {
        // result to return
        $result = new Result();
        
        // get leave just before the start date of applied leave
        $this->load->model('leave/leave_restricted_model', 'rl');
        $leave = $this->rl->get_restricted_leave_before($this->leave_start_date);
        
        if (!is_null($leave)) {
            $latest_rl_time = strtotime($leave['leave_date']);
            if ($latest_rl_time + 60 * 60 * 24 == $this->leave_start_time) {
                $result->setResult(FALSE);
                $result->addError("Your leave is suffix to already applied leave, "
                        . "if you want to take combination of leaves please go through portal");
                return $result;
            }
        }
        
        return $result;
    }
    
    function check_suffix_with_restricted_leave() {
        // result to return
        $result = new Result();
        
        // get leave just before the start date of applied leave
        $this->load->model('leave/leave_restricted_model', 'rl');
        $leave = $this->rl->get_restricted_leave_after($this->leave_end_date);
        
        if (!is_null($leave)) {
            $latest_rl_time = strtotime($leave['leave_date']);
            if ($latest_rl_time == $this->leave_end_time + 60 * 60 * 24) {
                $result->setResult(FALSE);
                $result->addError("Your leave is prefix to already applied leave, "
                        . "if you want to take combination of leaves please go through portal");
                return $result;
            }
        }
        
        return $result;
    }
    
    function check_for_weekend() {
        
        // result to resturn
        $result = new Result();
        
        $time = $this->leave_start_time;
        
        while ($this->leave_end_time >= $time) {
            $day_of_week = date('w', $time);
            if ($day_of_week == 0 || $day_of_week == 6) {
               $result->setResult(FALSE);
               $result->addError("Your leave includes weekend(s) please break it around them.");
               break;
            }
            $time += 24 * 60 * 60;
        }
        
        return $result;
    }

    /**
    * 1. start date
    * 2. end date
    * 3. start time
    * 4. end time
    * 5. purpose
    * 6. addressd
    */

//    function isValidStationData($data) {
//        $result = new Result();
//        // 1. any field should not empty
//        // 2. validate date fields
//        
//        return $result;
//    }
}
