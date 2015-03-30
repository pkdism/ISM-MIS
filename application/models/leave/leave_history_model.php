 <?php

/**
 * Author: Nishant Raj (nr3600)
*/

require_once 'leave_constants.php';

class Leave_history_model extends CI_Model {

	function __construct() {
        parent::__construct();
    }

	function get_casual_leave_history_details($emp_id ,$start_date , $end_date ){
            
            $lbi = Leave_constants::$TABLE_LEAVE_BASIC_INFO;
            $cl = Leave_constants::$TABLE_CASUAL_LEAVE;
            $sql = "SELECT * FROM $lbi JOIN $cl ON $lbi.id = $cl.id"
            ." WHERE $lbi.emp_id = '$emp_id' "
            ." and $cl.leave_start_date >= '$start_date' and $cl.leave_start_date <= '$end_date'";

            return $this->db->query($sql)->result_array();
	}
        
        function get_restricted_leave_history_details($emp_id , $start_date , $end_date){
            
            $lbi = Leave_constants::$TABLE_LEAVE_BASIC_INFO;
            $rl = Leave_constants::$TABLE_RESTRICTED_LEAVE;
            $sql = "SELECT * FROM $lbi JOIN $rl ON $lbi.id = $rl.id"
            ." WHERE $lbi.emp_id = '$emp_id' "
            ." and $rl.leave_date >= '$start_date' and $rl.leave_date <= '$end_date'";

            return $this->db->query($sql)->result_array();
        }
	function get_user_auth_id($emp_id){

            $sql = "SELECT * FROM user_auth_types WHERE id = '$emp_id'";

            $result = $this->db->query($sql)->result_array();
            foreach($result as $row)
                    return $row['auth_id'];
	}
        function get_casual_start_end_date($leave_id){
            
            $sql = "SELECT leave_start_date , leave_end_date FROM ".Leave_constants::$TYPE_CASUAL_LEAVE
                    ."WHERE id = '$leave_id'";
            
            $result = $this->db->query($sql)->result_array();
            
            foreach($result as $row)
                return $row;
        }
        
        function get_restricted_date($leave_id){
            
            $sql = "SELECT leave_date FROM ".Leave_constants::$TABLE_RESTRICTED_LEAVE
                    ." WHERE id = '$leave_id'";
            
            $result = $this->db->query($sql)->result_array();
            
            foreach($result as $row)
                return $row;
        }
        
}