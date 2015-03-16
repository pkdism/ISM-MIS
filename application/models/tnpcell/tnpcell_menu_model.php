<?php

class TnpCell_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}
	var $table_projects = 'tnp_cv_projects';
    var $table_achievements='tnp_cv_achievements';
	function getMenu()
	{
    /*checking if CV filled*/
    $flag=0;
    $user_id=$this->CI->session->userdata('id');
    $query=$this->db->get_where($this->table_projects, array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    $query= $this->db->get_where($this->table_achievements, array('user_id'=>$user_id));
    if($query->result()) $flag=1;
    
    $menu=array();
    /*Student*/
	$menu['stu']=array();
    $menu['stu']['T&P']=array();      
	if($flag==0)
		$menu['stu']['T&P']["Fill CV"] = site_url('tnpcell/cv/');
    else 
    {
        $menu['stu']['T&P']["View CV"] = site_url('tnpcell/cv/print_cv');
        $menu['stu']['T&P']["Edit CV"] = site_url('tnpcell/cv/edit_cv');
    }
	$menu['stu']['T&P']["View JNF"] = site_url('tnpcell/view_jnf/');
	$menu['stu']['T&P']["Company Info"] = site_url('tnpcell/company_info');  
	
    /*T&P Officer*/
    $menu['tpo']=array();
	$menu['tpo']["View JNF"] = site_url('tnpcell/view_jnf');
	$menu['tpo']["Manage Portal"]['Open/Close Registration portal'] = site_url('tnpcell/manage_portal/');  
	$menu['tpo']["Manage Portal"]['View Registered Students'] = site_url('tnpcell/manage_portal/');  
	$menu['tpo']["Manage Portal"]['Manage Placement Calender'] = site_url('tnpcell/allot_date/');  
	
	$menu['tpo']["Company Info"] = site_url('tnpcell/company_info');  
	return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */