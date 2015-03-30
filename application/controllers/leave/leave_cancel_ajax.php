<?php
/**
 * Created by PhpStorm.
 * User: samsidx
 * Date: 19/3/15
 * Time: 3:34 PM
 */

class Leave_cancel_ajax extends CI_Controller {

    var $emp_id;
    
    function __construct() {
        parent::__construct();
        $this->emp_id = $this->session->userdata('id');
        $this->load->model('leave/leave_constants');
    }

    function fetch_leaves($leave_type) {

        $leave_type = str_replace('%20', ' ', $leave_type);

        $data = array(
            'leaves' => array()
        );

        switch ($leave_type) {

            // get cancelable casual leaves
            case Leave_constants::$TYPE_CASUAL_LEAVE:
                echo "Hello World";
                $this->load->model('leave/leave_casual_model', 'cl');
                $data['leaves'] = $this->cl->get_cancelable_casual_leaves($this->emp_id);
                $this->load->view('leave/leave_cancel_generators/leave_casual_cancel_view', $data);
                break;

            // get cancelable restricted leaves
            case Leave_constants::$TYPE_RESTRICTED_LEAVE:
                $this->load->model('leave/leave_restricted_model', 'rm');
                $data['leaves'] =  $this->rm->get_cancelable_restricted_leaves($this->emp_id);
                $this->load->view('leave/leave_cancel_generators/leave_restricted_cancel_view', $data);
                break;
        }
    }
}