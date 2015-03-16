<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'leave_constants.php';
require_once 'result.php';

class Leave_casual_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function is_valid_casual_leave($emp_id, $leave_start_date, $leave_end_date) {
        
        $result = new Result();
        
        // check if leave is comming into already taken leaves period
        $this->load->model('leave/leave_helper', 'lh');
        $clash_verification = $this->lh->verify_leaves_period($emp_id, $leave_start_date, $leave_end_date);
        $result->updateResult($clash_verification);
        
        // check if valid balance of casual leaves
        $avail_bal = $this->get_casual_leave_balance($emp_id);
        $applied_period = strtotime($leave_end_date) - strtotime($leave_start_date);
        $applied_period = floor($applied_period / (60 * 60 * 24)) + 1;
        
        if ($avail_bal < $applied_period) {
            $result->setResult(FALSE);
            $error = "Your leave length is more than available balance. "
                    . "Your available casual leave balance is ".$avail_bal;
            $result->addError($error);
        }
        
        // check for maximum allowed casual leaves in one stretch
        if ($applied_period > 5) {
            $result->setResult(FALSE);
            $error = "You can take atmost 5 casual leaves in one stretch.";
            $result->addError($error);
        }
        
        return $result;
    }
    
    function insert_casual_leave($id, $leave_start_date, $leave_end_date, $period, $j_noon = 0) {
        $leave_start_date = $this->get_modified_date($leave_start_date);
        $leave_end_date = $this->get_modified_date($leave_end_date);
        
        $sql = "INSERT INTO ".Leave_constants::$TABLE_CASUAL_LEAVE.
                " VALUES($id, '$leave_start_date', '$leave_end_date', $period, $j_noon)";
        
        return $this->db->query($sql);
    }
    
    function get_casual_leaves_for_employee($emp_id, $year_from, $year_to) {
        $type = Leave_constants::$TYPE_CASUAL_LEAVE;
        $sql = "SELECT *"
        ." FROM ".Leave_constants::$TABLE_CASUAL_LEAVE
        ." WHERE leave_start_date >= '$year_from-01-01' "
        . "and leave_start_date <= '$year_to-12-31' "
        . "and leave_end_date >= '$year_from-01-01' and leave_end_date <= '$year_to-12-31' "
        . "and id IN ("
                     . "SELECT id "
                     . "FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO
                     . " WHERE emp_id = '$emp_id' "
                       . "and type = '$type' "
                       . "and status != ".Leave_constants::$REJECTED." and status != ".Leave_constants::$CANCELED
                     .")";
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_casual_leave_balance($emp_id) {
        $sql = "SELECT * FROM `leave_bal` "
                . "WHERE emp_id = '$emp_id' and leave_type = '".Leave_constants::$TYPE_CASUAL_LEAVE."' "
                . "ORDER BY update_on DESC "
                . "LIMIT 1";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return 0;
        }
        
        $latest_bal =  $query->result_array()[0]['bal'];
        
        return $latest_bal;
    }
    
    function get_modified_date($date) {
        $time = strtotime($date);
        return date('Y-m-d', $time);
    }
    
    function get_cancelable_casual_leaves($emp_id) {
        
        $today = date('Y-m-d');
        
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO." JOIN ".Leave_constants::$TABLE_CASUAL_LEAVE.
                " WHERE ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.".id = ".Leave_constants::$TABLE_CASUAL_LEAVE.".id".
                " and (status = ".Leave_constants::$APPROVED." or status = ".Leave_constants::$PENDING.")".
                " and leave_end_date > '$today' and emp_id = $emp_id";
        
        //var_dump($sql);
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_all_casual_leaves($emp_id, $from_date, $to_date) {
        
        // query
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO." JOIN ".Leave_constants::$TABLE_CASUAL_LEAVE.
                " WHERE ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.".id = ".Leave_constants::$TABLE_CASUAL_LEAVE.".id".
                " and (status = ".Leave_constants::$APPROVED." or status = ".Leave_constants::$PENDING.")".
                " and leave_start_date >= '$from_date' and leave_start_date <= '$to_date' and emp_id = $emp_id";
        
        //var_dump($sql);
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_casual_leave($id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_CASUAL_LEAVE." WHERE id = $id";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows > 0) {
            return $query->result_array()[0];
        }
        
        return NULL;
    }
    
    function update_end_date($id, $end_date) {
        $sql = "UPDATE ".Leave_constants::$TABLE_CASUAL_LEAVE.
              " SET leave_end_date = '$end_date'".
              " WHERE id = $id";
        
        $this->db->query($sql);
    }
    
    function get_casual_leave_period($leave_id) {
        $sql = "SELECT * FROM leave_casual WHERE id = $leave_id LIMIT 1";
        $query = $this->db->query($sql);
        return $query->result_array()[0]['period'];
    }
    
    function get_casual_leave_before($date) {
        
        $date = $this->get_modified_date($date);
        
        $sql = "SELECT * FROM leave_casual "
                . "WHERE leave_end_date <= '$date' "
                . "ORDER BY leave_end_date DESC "
                . "LIMIT 1";
        $query = $this->db->query($sql);
       
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
    
    function get_casual_leave_after($date) {
        $date = $this->get_modified_date($date);
        
        $sql = "SELECT * FROM leave_casual "
                . "WHERE leave_start_date >= '$date' "
                . "ORDER BY leave_start_date ASC "
                . "LIMIT 1";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
}
