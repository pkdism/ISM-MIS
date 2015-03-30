<?php
/*
 * Author : Nishant Raj
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_history extends MY_Controller {

	var $emp_id;
    var $data = array();
        
	function __construct() {
            parent::__construct(array('emp'));

            $this->emp_id = $this->session->userdata('id');
            $this->load->model('leave/leave_basic_info_model', 'bm');
            $this->load->model('leave/leave_casual_model', 'cm');
            $this->load->model('leave/leave_restricted_model', 'rm');
            $this->load->model('leave/leave_constants');
            $this->load->model('leave/result');
            $this->load->model('leave/leave_history_model' , 'lhm');
            $this->load->model('leave/leave_users_details_model' , 'ludm');
        $this->load->model('leave/leave_station_model', 'lsm');

	}
        
        function index(){

            $auth_id = $this->lhm->get_user_auth_id($this->emp_id);

            
            if($this->ludm->is_hod($this->emp_id)){

                $this->data['notif'] = FALSE;
                $this->data['set'] = FALSE;
                
                if(isset($_POST['submit'])){
                    $user_id = $_POST['emp_id'];
                    //$leave_type = $_POST['leave_type'];
                    $this->data['error'] = "";
                    if($user_id == "$"){
                        $user_id = $this->emp_id;
                        $this->data['notif'] = TRUE;
                        $this->data['error'] .= "Please Select Employee Name <br>";
                    }
                    
                    $this->data['set'] = TRUE;
                    $casual_leave_avail_balance = $this->cm->get_casual_leave_balance($user_id);
                    $restricted_leave_avail_balance = $this->rm->get_restricted_leave_balance($user_id);
                    $all_user_under_hod = $this->ludm->get_users_under_hod($this->emp_id);
                    $this->data['user_id'] = $user_id;
                    $this->data['Casual_balance'] = $casual_leave_avail_balance;
                    $this->data['Restricted_balance'] = $restricted_leave_avail_balance;
                    $this->data['users'] = $all_user_under_hod;
                    $name="";
                    foreach($this->data['users'] as $user){
                        if($user['id'] == $user_id){
                            $salutation = $user['salutation'];
                            $f_name = $user['first_name'];
                            $m_name = $user['middle_name'];
                            $l_name = $user['last_name'];
                            $name = "$salutation "."$f_name "."$m_name "."$l_name";
                        }
                    }
                    $this->data['leave_history_casual'] = array();
                    $this->data['leave_history_restricted'] = array();
                    $this->data['name'] = $name;
                    $year = date("Y");
                    $start_date = "$year"."-01-01";
                    $end_date = "$year"."-12-31";
                    $this->data['leave_history_casual'] = $this->lhm->get_casual_leave_history_details($user_id , $start_date,$end_date );
                    $this->data['leave_history_restricted'] = $this->lhm->get_restricted_leave_history_details($user_id , $start_date,$end_date );
                    

                    //var_dump($this->data['users']);
                   // var_dump($this->data['leave_history']);
                }
                else{
                    $casual_leave_avail_balance = $this->cm->get_casual_leave_balance($this->emp_id);
                    $restricted_leave_avail_balance = $this->rm->get_restricted_leave_balance($this->emp_id);
                    $all_user_under_hod = $this->ludm->get_users_under_hod($this->emp_id);
                    
                    $this->data['Casual_balance'] = $casual_leave_avail_balance;
                    $this->data['Restricted_balance'] = $restricted_leave_avail_balance;
                    $this->data['users'] = $all_user_under_hod;
                    $this->data['leave_history_casual'] = $this->lhm->get_casual_leave_history_details($this->emp_id , "2015-01-01","2015-12-31" );
                    $this->data['leave_history_restricted'] = $this->lhm->get_restricted_leave_history_details($this->emp_id , "2015-01-01","2015-12-31" );

//                    var_dump($this->data['users']);
//                    var_dump($this->data['users']);
                }

                $this->drawHeader('Leave history');
                $this->load->view('leave/leave_history_hod_view' , $this->data);
                $this->drawFooter();
            }
            
            else{
                $casual_leave_avail_balance = $this->cm->get_casual_leave_balance($this->emp_id);
                $restricted_leave_avail_balance = $this->rm->get_restricted_leave_balance($this->emp_id);
                $this->data['leave_history_casual'] = $this->lhm->get_casual_leave_history_details($this->emp_id , "2015-01-01","2015-12-31" );
                $this->data['leave_history_restricted'] = $this->lhm->get_restricted_leave_history_details($this->emp_id , "2015-01-01","2015-12-31" );

                $this->data['Casual_balance'] = $casual_leave_avail_balance;
                $this->data['Restricted_balance'] = $restricted_leave_avail_balance;

                //var_dump($this->data['Casual_balance']);
                $this->drawHeader('Leave History');
                $this->load->view('leave/leave_history_ft_view' , $this->data);
                $this->drawFooter();
            }
        }
}
?>