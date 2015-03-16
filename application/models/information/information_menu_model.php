<?php

class Information_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> emp
		$menu['emp']=array();
		$menu['emp']["View Notice, Circular or Minutes"] = array();
		$menu['emp']["View Notice, Circular or Minutes"]['Notice'] = site_url('information/view_notice');
		$menu['emp']["View Notice, Circular or Minutes"]['Circular'] = site_url('information/view_circular');
		$menu['emp']["View Notice, Circular or Minutes"]['Minutes'] = site_url('information/view_minute');
		
		//auth ==> stu
		$menu['stu']=array();
		$menu['stu']["View Notice, Circular or Minutes"] = array();
		$menu['stu']["View Notice, Circular or Minutes"]['Notice'] = site_url('information/view_notice');
		$menu['stu']["View Notice, Circular or Minutes"]['Circular'] = site_url('information/view_circular');
		$menu['stu']["View Notice, Circular or Minutes"]['Minutes'] = site_url('information/view_minute');
		
		
		//auth ==> est_ar
		$menu['est_ar']=array();
		$menu['est_ar']['Notices, Circulars or Minutes']=array();
		$menu['est_ar']["Notices, Circulars or Minutes"]["Post"]=array();
		$menu['est_ar']["Notices, Circulars or Minutes"]["Post"]['Notice'] = site_url('information/post_notice/index/est_ar');
		$menu['est_ar']["Notices, Circulars or Minutes"]["Post"]['Circular'] = site_url('information/post_circular/index/est_ar');
		$menu['est_ar']["Notices, Circulars or Minutes"]["Post"]['Minutes'] = site_url('information/post_minute/index/est_ar');
		
		$menu['est_ar']["Notices, Circulars or Minutes"]["Edit"]=array();
		$menu['est_ar']["Notices, Circulars or Minutes"]["Edit"]['Notice'] = site_url('information/edit_notice/index/est_ar');
		$menu['est_ar']["Notices, Circulars or Minutes"]["Edit"]['Circular'] = site_url('information/edit_circular/index/est_ar');
		$menu['est_ar']["Notices, Circulars or Minutes"]["Edit"]['Minutes'] = site_url('information/edit_minute/index/est_ar');

		$menu['est_ar']["Notices, Circulars or Minutes"]["View"] = array();
		$menu['est_ar']["Notices, Circulars or Minutes"]["View"]['Notice'] = site_url('information/view_notice');
		$menu['est_ar']["Notices, Circulars or Minutes"]["View"]['Circular'] = site_url('information/view_circular');
		$menu['est_ar']["Notices, Circulars or Minutes"]["View"]['Minutes'] = site_url('information/view_minute');
		
		
		//auth ==> hod
		$menu['hod']=array();
		$menu['hod']['Notices, Circulars or Minutes']=array();
		$menu['hod']["Notices, Circulars or Minutes"]["Post"]=array();
		$menu['hod']["Notices, Circulars or Minutes"]["Post"]['Notice'] = site_url('information/post_notice/index/hod');
		$menu['hod']["Notices, Circulars or Minutes"]["Post"]['Circular'] = site_url('information/post_circular/index/hod');
		$menu['hod']["Notices, Circulars or Minutes"]["Post"]['Minutes'] = site_url('information/post_minute/index/hod');
		            
		$menu['hod']["Notices, Circulars or Minutes"]["Edit"]=array();
		$menu['hod']["Notices, Circulars or Minutes"]["Edit"]['Notice'] = site_url('information/edit_notice/index/hod');
		$menu['hod']["Notices, Circulars or Minutes"]["Edit"]['Circular'] = site_url('information/edit_circular/index/hod');
		$menu['hod']["Notices, Circulars or Minutes"]["Edit"]['Minutes'] = site_url('information/edit_minute/index/hod');
                                
		$menu['hod']["Notices, Circulars or Minutes"]["View"] = array();
		$menu['hod']["Notices, Circulars or Minutes"]["View"]['Notice'] = site_url('information/view_notice');
		$menu['hod']["Notices, Circulars or Minutes"]["View"]['Circular'] = site_url('information/view_circular');
		$menu['hod']["Notices, Circulars or Minutes"]["View"]['Minutes'] = site_url('information/view_minute');
		
		
		//auth ==> exam_dr
		$menu['exam_dr']=array();
		$menu['exam_dr']['Notices, Circulars or Minutes']=array();
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Post"]=array();
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Post"]['Notice'] = site_url('information/post_notice/index/exam_dr');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Post"]['Circular'] = site_url('information/post_circular/index/exam_dr');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Post"]['Minutes'] = site_url('information/post_minute/index/exam_dr');
		                
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Edit"]=array();
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Edit"]['Notice'] = site_url('information/edit_notice/index/exam_dr');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Edit"]['Circular'] = site_url('information/edit_circular/index/exam_dr');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["Edit"]['Minutes'] = site_url('information/edit_minute/index/exam_dr');
                                                        
		$menu['exam_dr']["Notices, Circulars or Minutes"]["View"] = array();
		$menu['exam_dr']["Notices, Circulars or Minutes"]["View"]['Notice'] = site_url('information/view_notice');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["View"]['Circular'] = site_url('information/view_circular');
		$menu['exam_dr']["Notices, Circulars or Minutes"]["View"]['Minutes'] = site_url('information/view_minute');

		
		//auth ==> dt
		$menu['dt']=array();
		$menu['dt']['Notices, Circulars or Minutes']=array();
		$menu['dt']["Notices, Circulars or Minutes"]["Post"]=array();
		$menu['dt']["Notices, Circulars or Minutes"]["Post"]['Notice'] = site_url('information/post_notice/index/dt');
		$menu['dt']["Notices, Circulars or Minutes"]["Post"]['Circular'] = site_url('information/post_circular/index/dt');
		$menu['dt']["Notices, Circulars or Minutes"]["Post"]['Minutes'] = site_url('information/post_minute/index/dt');
		           
		$menu['dt']["Notices, Circulars or Minutes"]["Edit"]=array();
		$menu['dt']["Notices, Circulars or Minutes"]["Edit"]['Notice'] = site_url('information/edit_notice/index/dt');
		$menu['dt']["Notices, Circulars or Minutes"]["Edit"]['Circular'] = site_url('information/edit_circular/index/dt');
		$menu['dt']["Notices, Circulars or Minutes"]["Edit"]['Minutes'] = site_url('information/edit_minute/index/dt');
                   
		$menu['dt']["Notices, Circulars or Minutes"]["View"] = array();
		$menu['dt']["Notices, Circulars or Minutes"]["View"]['Notice'] = site_url('information/view_notice');
		$menu['dt']["Notices, Circulars or Minutes"]["View"]['Circular'] = site_url('information/view_circular');
		$menu['dt']["Notices, Circulars or Minutes"]["View"]['Minutes'] = site_url('information/view_minute');
		
		
		//auth ==> dsw
		$menu['dsw']=array();
		$menu['dsw']['Notices, Circulars or Minutes']=array();
		$menu['dsw']["Notices, Circulars or Minutes"]["Post"]=array();
		$menu['dsw']["Notices, Circulars or Minutes"]["Post"]['Notice'] = site_url('information/post_notice/index/dsw');
		$menu['dsw']["Notices, Circulars or Minutes"]["Post"]['Circular'] = site_url('information/post_circular/index/dsw');
		$menu['dsw']["Notices, Circulars or Minutes"]["Post"]['Minutes'] = site_url('information/post_minute/index/dsw');
		            
		$menu['dsw']["Notices, Circulars or Minutes"]["Edit"]=array();
		$menu['dsw']["Notices, Circulars or Minutes"]["Edit"]['Notice'] = site_url('information/edit_notice/index/dsw');
		$menu['dsw']["Notices, Circulars or Minutes"]["Edit"]['Circular'] = site_url('information/edit_circular/index/dsw');
		$menu['dsw']["Notices, Circulars or Minutes"]["Edit"]['Minutes'] = site_url('information/edit_minute/index/dsw');
                    
		$menu['dsw']["Notices, Circulars or Minutes"]["View"] = array();
		$menu['dsw']["Notices, Circulars or Minutes"]["View"]['Notice'] = site_url('information/view_notice');
		$menu['dsw']["Notices, Circulars or Minutes"]["View"]['Circular'] = site_url('information/view_circular');
		$menu['dsw']["Notices, Circulars or Minutes"]["View"]['Minutes'] = site_url('information/view_minute');
		
		
		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']["View Notice, Circular or Minutes"] = array();
		$menu['deo']["View Notice, Circular or Minutes"]['Notice'] = site_url('information/view_notice');
		$menu['deo']["View Notice, Circular or Minutes"]['Circular'] = site_url('information/view_circular');
		$menu['deo']["View Notice, Circular or Minutes"]['Minutes'] = site_url('information/view_minute');

		return $menu;
	}
}
/* End of file information_menu.php */
/* Location: mis/application/models/information/information_menu.php */