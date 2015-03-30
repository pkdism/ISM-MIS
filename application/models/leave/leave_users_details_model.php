<?php

/*
 * Author :- Nishant Raj
 */
class Leave_users_details_model extends CI_Model {

    function __construct() {
            parent::__construct();
    }

    function get_designation_by_department_id ($dept_id)
    {
        $query = $this->db->query("SELECT DISTINCT designations.id, designations.name FROM designations INNER JOIN user_details INNER JOIN emp_basic_details ON designations.id = emp_basic_details.designation AND user_details.id = emp_basic_details.id where dept_id = '".$dept_id."' ORDER BY designations.name;");
        if($query->num_rows() > 0)
                return $query->result();
        else
                return FALSE;	 
    }
    
    function get_emp_name ($designation, $dept)
    {
        $query = $this->db->query ("SELECT emp_basic_details.id AS id from user_details INNER JOIN emp_basic_details ON user_details.id = emp_basic_details.id where dept_id = '".$dept."' and designation = '".$designation."' ORDER BY salutation, first_name, middle_name, last_name;");
        if($query->num_rows() > 0)
                return $query->result();
        else
                return FALSE;	 
    }
    
    function get_users_under_hod($emp_id) {

            $sql = "SELECT * FROM  user_details WHERE id = '$emp_id'";

            $result = $this->db->query($sql)->result_array();

            $dept_id ="";
            foreach($result as $row) {
                $dept_id = $row['dept_id'];
            }

            $sql = "SELECT * FROM "
                    . "user_details as ud JOIN emp_basic_details as ebd "
                    . "ON ud.id = ebd.id "
                    . "WHERE ud.dept_id = '$dept_id' ORDER BY first_name";

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
        
        if($this->is_this_auth_valid($user_id, 'dsw') ||
                $this->is_this_auth_valid($user_id, 'est_ar') ||
                $this->is_this_auth_valid($user_id , 'exam_dr') ||
                $this->is_this_auth_valid($user_id, 'fictp') ||
                $this->is_this_auth_valid($user_id, 'hod')){
            
            if($approving_user_id == $user_id){

                $data['auth_id'] = "dt";

                $data['user_id'] = $this->get_director_user_id();

                return $data;
            }
            else if($this->is_director($approving_user_id)){
                return NULL;
            }
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
        
        if( $user_designation == "astprof" && !$this->is_hod($user_id)){
            
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
                && !$this->is_hod($user_id)){
            
            
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
        
        return $result;
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
    
    function is_dept_academic($dept_id){
        
        $sql = "SELECT type FROM departments"
                . "WHERE id = $dept_id";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            if($row['type'] == 'academic'){
                return TRUE;
            }
        }
        return FALSE;
    }
    
    function is_faculty($emp_id){
        
        $sql = "SELECT auth_id FROM emp_basic_details "
                . "WHERE id = $emp_id";
        
        $result = $this->db->query($sql)->result_array();
        
        foreach($result as $row){
            if($row['auth_id'] == 'ft'){
                return TRUE;
            }
        }
        return FALSE;
    }
    
//    function is_assistanceRegistar($emp_id){
//        
//        $result = $this->get_user_auth_type($emp_id);
//        
//        foreach($result as $row){
//            
//            if($row->auth_id == 'est_ar'){
//                return TRUE;
//            }
//        }
//        return FALSE;
//    }
//    
//    function is_dean_faculty_traning($emp_id){
//        
//        $result = $this->get_user_auth_type($emp_id);
//        
//        foreach($result as $row){
//            
//            if($row->auth_id == 'fictp'){
//                return TRUE;
//            }
//        }
//        return FALSE;
//    }
    
    function is_this_auth_valid($emp_id , $auth_id){
        
        $result = $this->get_user_auth_type($emp_id);
        
        foreach ($result as $row){
            
            if($row['auth_id'] === $auth_id){
                return TRUE;
            }
        }
        return FALSE;
    }
//    
//    function is_director($emp_id){
//        
//        $result = $this->get_user_auth_type($emp_id);
//        
//        foreach ($result as $row){
//            
//            if($row->auth_id == 'dir'){
//                return TRUE;
//            }
//        }
//        return FALSE;
//    }

    function get_next_higher_authorizing_emp($emp_id){
        
        $dept = $this->get_user_dept($emp_id);
        if($this->is_this_auth_valid($emp_id, 'est_ar') || $this->is_this_auth_valid($emp_id, 'fictp') ||
                $this->is_hod($emp_id)){
            
            $data['user_id'] = $this->get_director_user_id();
            $data['auth_id'] = 'dir';
            
            return $data;
        }
        
        
        if($this->is_dept_academic($dept)){
            
            $data['user_id'] = $this->get_dept_head($dept);
            $data['auth_id'] = 'hod';
        }
        else{
            
            //1.Who  is sectional head ;
            return NULL;
        }
    }
}