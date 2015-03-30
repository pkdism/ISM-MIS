

<?php

/*
 * Author : Nishant Raj
 */

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Leave_deo extends MY_Controller{
    
    var $current_emp_id;
    var $user_id;
    function __construct() {
        parent::__construct(array('deo','est_ar','astreg','dir','dyreg'));
        $this->current_emp_id = $this->session->userdata('id');
        $this->load->model('leave/leave_deo_model','ldm');
        $this->addJS("leave/deo_query.js");
        $this->load->model('user_model' , 'um');
        $this->load->model('departments_model');
        $this->load->model('leave/leave_users_details_model','ludm');
        $this->load->model('designations_model');
        $this->load->model('employee_model');
        $this->load->model('leave/leave_bal_model','lbm');
        $this->load->model('leave/leave_constants');
        
    }
    
    function index($emp_id_after_post=''){
        
        $data['is_error'] = false;
        $data['post'] = false;
        $data['place_holder'] = "Enter Employee id";

        if(isset($_POST['submit'])){
            $this->user_id = $_POST['emp_id'];
            $data['place_holder'] = $this->user_id;
            $details = $this->employee_model->getById($this->user_id);
            
            if(empty($details)){
                $data['error_type'] = "error";
                $data['is_error'] = true;
                $data['error_msg'] = 'User ID not found. Please Try Again.';
            }
            
            else{
                $data['post'] = true;
                $data['emp']=$details;
                $data['img_path'] = $this->user_id . "/";
                $data['img_path'] .= $this->um->getPhotoById($this->user_id);
            }
        }
        
        if(isset($_POST['bal_details'])){
            $casual_balance = $_POST['casual_bal'];
            $restricted_balance =$_POST['restricted_bal'];

            
            $success = $this->lbm->update_balance($emp_id_after_post , $casual_balance ,  Leave_constants::$TYPE_CASUAL_LEAVE );

            $success1 = $this->lbm->update_balance($emp_id_after_post , $restricted_balance ,  Leave_constants::$TYPE_RESTRICTED_LEAVE );
            
            
            $data = array();
            $data['post'] = false;
            $data['place_holder'] = "Enter User ID";
            $_POST = array();
            if($success && $success1){
                $data['error_type'] = "success";
                $data['is_error'] = true;
                $data['error_msg'] = 'Data Inserted Successfully.';
            }
            else{
                $data['error_type'] = "error";
                $data['is_error'] = true;
                $data['error_msg'] = 'Data Not Inserted . Please Try Again.';
            }
        }
        $this->drawHeader('Leave DEO Portal');
        $this->load->view('leave/leave_deo_view' , $data);
        $this->drawFooter();
    }

    function leave_administration(){
        $this->drawHeader();
        $this->load->view('leave/leave_administration/leave_administration_view');
        $this->drawFooter();
    }
    
}
