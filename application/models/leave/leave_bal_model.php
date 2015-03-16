<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

class Leave_bal_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function update_balance($emp_id, $balance, $leave_type) {
        $today = date('Y-m-d');
        $sql = "INSERT INTO `leave_bal` VALUES("
                . "'$emp_id', "
                . "$balance, "
                . "'$leave_type', "
                . "CURRENT_TIMESTAMP)";
        return $this->db->query($sql);
    }
}
