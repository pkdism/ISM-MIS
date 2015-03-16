<?php

class Leave_users_details_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_users_under_hod($emp_id) {

		$sql = "SELECT * FROM  user_details WHERE id = '$emp_id'";

		$result = $this->db->query($sql)->result_array();

		$dept_id ="";
		foreach($result as $row) {
                    $dept_id = $row['dept_id'];
                }

		$sql = "SELECT * FROM user_details WHERE dept_id = '$dept_id' ORDER BY first_name";

		return $this->db->query($sql)->result_array();
	}

    function get_latest_auth_id($leave_id) {
        $sql = "SELECT emp_id FROM leave_status WHERE id = $leave_id "
                . "ORDER BY approved_on DESC "
                . "LIMIT 1";
        
        $query = $this->db->query($sql);

        if ($query->num_rows <= 0) {
            return NULL;
        }

        return $query->result_array()[0]['emp_id'];
    }
        
    //pass number of days in leave_period in double format
    function get_next_authorizing_emp($user_id , $leave_id , $leave_period){
        
        $data = array();
        
        $approving_user_id = $this->get_latest_auth_id($leave_id);
        
        $approving_user_auth_type = $this->get_user_auth_type($approving_user_id);
        $user_auth_type = $this->get_user_auth_type($user_id);
//            
//            $data['user_auth'] = $user_auth_type;
//            $data['approving_auth_type'] = $approving_user_auth_type;
//            $data['uesr_id'] = $user_id;
//            $data['approving_user_id'] = $approving_user_id;
        
        // Currently only for departments;

        if($user_auth_type == 'dsw'){

            $data['auth_id'] = "dt";
            
            $data['user_id'] = $this->get_director_user_id();

            return $data;
        }
        if($approving_user_id == $user_id  && !$this->is_hod($user_id)){
            
            $user_dept = $this->get_user_dept($user_id);
            $dept_head = $this->get_dept_head($user_dept);
            
            $data['auth_id'] = "hod";
            
            $data['user_id'] = $dept_head;
            
            return $data;
        }
        
        // TODO: add sectional head
        else if($approving_user_id == $user_id  && $this->is_hod($user_id)){
            
            //return director;
            $data['auth_id'] = "dt";
            $data['user_id'] = $this->get_director_user_id();
            return $data;
        }
        
        $user_designation = $this->get_user_designation($user_id);
        
        if( $user_designation == "astprof" && $this->is_hod($user_id)){
            
            if($leave_period <= 10.0){
                return NULL;
            }
            //here return type should be id of Dean(F & P):
            //else if ($leave_period > 10.0 && $leave_period <= 15.0)
            
            //return should be id of director;
            if($leave_period > 15.0 ){
                $data['auth_id'] = "dt";
                $data['user_id'] = $this->get_director_user_id();
                return $data;
            }
        }
        
        else if(($user_designation == "ascprof" || $user_designation == "prof")
                && $this->is_hod($user_id)){
            
            
            //Here return should be Dean(F & P) , Know id of Dean(F & P)
            //if($leave_period <= 15.0)

            
            //return should be director
            if($leave_period > 15.0){
                $data['auth_id'] = "dt";
                $data['user_id'] = $this->get_director_user_id();
                return $data;
            }
        }
        
    }
    

    function is_hod($user_id){

        $dept = $this->get_user_dept($user_id);

        $dept_head = $this->get_dept_head($dept);

        if($user_id == $dept_head)
            return true;
        else
            return false;
    }
    function get_user_auth_type($emp_id){
        
        $sql = "SELECT auth_id FROM user_auth_types"
                . " WHERE id = '$emp_id'";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            return $row['auth_id'];
        }
    }
    
    function get_user_dept($user_id){
        
        $sql = "SELECT dept_id FROM user_details "
                . "WHERE id = '$user_id'";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            return $row['dept_id'];
        }
    }
    
    function get_dept_head($dept){
        
        $sql = "SELECT id FROM user_details "
                . "WHERE dept_id = '$dept'";
        
        $result1 = $this->db->query($sql)->result_array();
        
        
        $hod = "hod";
        $sql = "SELECT id FROM user_auth_types "
                . "WHERE auth_id = '$hod' ";
        
        $result2 = $this->db->query($sql)->result_array();
        
        foreach($result1 as $row1){
            
            foreach($result2 as $row2){
                
                if($row1['id'] == $row2['id'])
                    return $row1['id'];
            }
        }
    }
    
    function get_user_designation($user_id){
        
        $sql = "SELECT designation FROM emp_basic_details "
                . "WHERE id = '$user_id'";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            
            return $row['designation'];
        }
    } 
    
    function get_director_user_id(){
        
        $director = "dt";
        $sql = "SELECT id FROM user_auth_types "
                . "WHERE auth_id = '$director' ";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            
            return $row['id'];
        }
    }
}