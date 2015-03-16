<?php

/**
 * Author: Majeed Siddiqui (samsidx)
*/

require_once 'leave_constants.php';

class Leave_basic_info_model extends CI_Model {
    
    function __construct() {
        parent::__construct();
    }
    
    function get_leave_basic_info($id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.
                " WHERE id = $id".
                " LIMIT 1";
        
        $query = $this->db->query($sql);
        
        $leave = $query->result_array();
        
        return $leave[0];
    }
    
    function insert_leave_basic_info($date_applied, $purpose, $type, $emp_id, $status) {
        $sql = "INSERT INTO ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.
                " VALUES('', '$date_applied', '$purpose', '$type', '$emp_id', '$status')";
        
        $is_insertion_successful = $this->db->query($sql);
        
        if ($is_insertion_successful) {
            return $this->get_leave_id($date_applied, $emp_id);
        }
        else {
            return FALSE;
        }
    }
    
    function get_leave_id($date_applied, $emp_id) {
        $sql = "SELECT id FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.
                " WHERE date_applied = '$date_applied' and emp_id = '$emp_id'".
                " ORDER BY id DESC".
                " LIMIT 1";
        
        $query = $this->db->query($sql);
        
        $leave = $query->result_array();
        
        return $leave[0]['id'];
    }
    
    function update_leave_status($id, $status) {
        $sql = "UPDATE ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.
                " SET status = $status".
                " WHERE id = $id";
        
        return $this->db->query($sql);
    }

    function get_leave_status($id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO.
                " WHERE id = $id LIMIT 1";
        $query = $this->db->query($sql);

        if ($query->num_rows <= 0) {
            return NULL;
        }

        return $query->result_array()[0]['status'];
    }
    
    function get_detail_leave_info($leave_id) {
        $sql = "SELECT * FROM ".Leave_constants::$TABLE_LEAVE_BASIC_INFO." WHERE id = $leave_id";
        $query = $this->db->query($sql);
        
        if ($query->num_rows <= 0) {
            return NULL;
        }
        
        $result = $query->result_array()[0];
        $leave_type = $result['type'];
        
        // complete data of leave will be stored as key - value pair in data
        $data = array();
        
        // fill it with basic info
        foreach($result as $key => $value) {
            $data[$key] = $value;
        }
        
        $leave = array();
        
        switch ($leave_type) {
            // if casual leave get its details
            case Leave_constants::$TYPE_CASUAL_LEAVE:
                $this->load->model('leave/leave_casual_model', 'cl');
                $leave = $this->cl->get_casual_leave($leave_id);
                break;
            
            // if restricted leave get its details
            case Leave_constants::$TYPE_RESTRICTED_LEAVE:
                $this->load->model('leave/leave_restricted_model', 'rm');
                $leave = $this->rm->get_restricted_leave($leave_id);
                break;
        }
        
        // fill it with specific leave info
        foreach($leave as $key => $value) {
            $data[$key] = $value;
        }
        
        // return data
        return $data;
    }
}

