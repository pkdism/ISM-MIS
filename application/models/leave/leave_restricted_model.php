<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'leave_constants.php';
require_once 'result.php';

class Leave_restricted_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function is_valid_restricted_leave($emp_id, $leave_date) {
        
        $result = new Result();
        
        // modify date to match db date format
        $leave_date = date('Y-m-d', strtotime($leave_date));
        
        // check if restricted holiday available
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_RESTRICTED_HOLIDAYS.
                " WHERE holiday_date = '$leave_date'";
        
        $query = $this->db->query($sql);
        
        if ($query->num_rows() == 0) {
            $result->setResult(FALSE);
            $result->addError("No restricted holiday available.");
        }
        
        // check if leave is comming into already taken leaves period
        $this->load->model('leave/leave_helper', 'lh');
        $clash_verification = $this->lh->verify_leaves_period($emp_id, $leave_date, $leave_date);
        $result->updateResult($clash_verification);
        
        // check if balance for leave available
        $balance = $this->get_restricted_leave_balance($emp_id);
        
        if ($balance < 1) {
            $result->setResult(FALSE);
            $result->addError("Your don't have restricted leaves left.");
        }
        
        return $result;
    }
    
    function insert_restricted_leave($id, $leave_date) {
        $leave_date = $this->get_modified_date($leave_date);
        
        $sql = "INSERT INTO ".Leave_constants::$TABLE_RESTRICTED_LEAVE.
                " VALUES($id, '$leave_date')";
        
        return $this->db->query($sql);
    }
    
    function get_restricted_leaves_for_employee($emp_id, $year_from, $year_to) {
        $type = Leave_constants::$TYPE_RESTRICTED_LEAVE;
        $sql = "SELECT *"
            ." FROM ".Leave_constants::$TABLE_RESTRICTED_LEAVE
            ." WHERE leave_date >= '$year_from-01-01' "
            . "and leave_date <= '$year_to-12-31'"
            ." and id IN ("
                         . "SELECT id "
                         . "FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO
                         . " WHERE emp_id = '$emp_id' "
                           . "and type = '$type' "
                           . "and status != ".Leave_constants::$REJECTED." and status != ".Leave_constants::$CANCELED
                         .")";
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_restricted_leave_balance($emp_id) {
        $sql = "SELECT * FROM `leave_bal` "
                . "WHERE emp_id = '$emp_id' and leave_type = '".Leave_constants::$TYPE_RESTRICTED_LEAVE."' "
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
    
    function get_cancelable_restricted_leaves($emp_id) {
        $today = date('Y-m-d');
        $table_leave_basic_info = Leave_constants::$TABLE_LEAVE_BASIC_INFO;
        $table_restricted_leave = Leave_constants::$TABLE_RESTRICTED_LEAVE;
        $sql = "SELECT * FROM ".$table_leave_basic_info." JOIN ".$table_restricted_leave.
                " WHERE ".$table_leave_basic_info.".id = ".$table_restricted_leave.".id and emp_id = $emp_id".
                " and leave_date > $today".
                " and (status = ".Leave_constants::$APPROVED." or status = ".Leave_constants::$PENDING.")";
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_all_restricted_leaves($emp_id, $leave_date) {
        $table_leave_basic_info = Leave_constants::$TABLE_LEAVE_BASIC_INFO;
        $table_restricted_leave = Leave_constants::$TABLE_RESTRICTED_LEAVE;
        $sql = "SELECT * FROM ".$table_leave_basic_info." JOIN ".$table_restricted_leave.
                " WHERE ".$table_leave_basic_info.".id = ".$table_restricted_leave.".id and emp_id = $emp_id".
                " and leave_date >= '$leave_date'";
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
    
    function get_restricted_leave_before($date) {
        
        $date = $this->get_modified_date($date);
        
        $sql = "SELECT * FROM leave_restricted "
                . "WHERE leave_date <= '$date' "
                . "ORDER BY leave_date DESC "
                . "LIMIT 1";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
    
    function get_restricted_leave_after($date) {
        $date = $this->get_modified_date($date);
        
        $sql = "SELECT * FROM leave_restricted "
                . "WHERE leave_date >= '$date' "
                . "ORDER BY leave_date ASC "
                . "LIMIT 1";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
    
    function get_restricted_leave($leave_id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_RESTRICTED_LEAVE." WHERE id = $leave_id LIMIT 1";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
}
