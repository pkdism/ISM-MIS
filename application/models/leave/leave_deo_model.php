<?php

/* 
 * Author : Nishant Raj
 */

class Leave_deo_model extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    
    function get_full_users_details($user_id){
        
        $sql = "SELECT * FROM user_details WHERE id = '$user_id'";
        
        return $this->db->query($sql)->result_array();
    }
    
    function date_of_joining($user_id){
        
        $sql = "SELECT joining_date FROM emp_basic_details WHERE id = '$user_id'";
        
        return $this->db->query($sql)->result_array();
    }
    
}
