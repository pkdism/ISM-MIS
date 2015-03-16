<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'leave_constants.php';

class Leave_status_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function add_leave_status($approver_id, $leave_id) {
        $sql = "INSERT INTO leave_status VALUES($leave_id, '$approver_id', CURRENT_TIMESTAMP)";
        return $this->db->query($sql);
    }
    
    function get_status($approver_id, $leave_id) {
        $sql = "SELECT * FROM leave_status WHERE emp_id = '$approver_id' and id = $leave_id";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        return $query->result_array()[0];
    }
    
    function get_leave_path($id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_STATUS.
                " WHERE id = $id".
                " ORDER BY approval_date DESC";
        
        $query = $this->db->query($sql);
        
        return $query->result_array();
    }
}
