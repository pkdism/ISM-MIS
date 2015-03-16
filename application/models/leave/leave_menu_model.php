<?php
/*
 * Author : Nishant raj
 */
class Leave_menu_model extends CI_Model{
    
    function __construct()
    {
            // Calling the Model parent constructor
            parent::__construct();
    }
    
    function getMenu(){
        
        $menu = array();
        
        $menu['emp'] = array();
        $menu['emp']['Leave Management'] = array();
        $menu['emp']['Leave Management']['Apply For Leave'] = site_url('leave/leave_application');
        $menu['emp']['Leave Management']['Leave History'] = site_url('leave/leave_history');
        $menu['emp']['Leave Management']['Cancle Leave'] = site_url('leave/leave_cancel');
        
        
        $menu['deo']['Leave Management'] = site_url('leave/leave_deo');
        return $menu;
    }
}

