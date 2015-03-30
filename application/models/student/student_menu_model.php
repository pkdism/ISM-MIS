<?php

class Student_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();

		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']['Manage Students']=array();
		$menu['deo']["Manage Students"]["Add Student"] = site_url('student/student_add_deo');
		$menu['deo']['Manage Students']["Edit Student Details"] = site_url('student/student_edit');
		$menu['deo']["Manage Students"]["View Student"]["Details"] = site_url('student_view_report/view');
		$menu['deo']["Manage Students"]["View Student"]["Report"] = site_url('student_view_report/reports');
		$menu['deo']["Manage Students"]["View Rejected Students"] = site_url('student/student_rejected');
		
		//auth ==> emp
		$menu['emp']["Manage Students"]["View Student"]["Details"] = site_url('student_view_report/view');
		$menu['emp']["Manage Students"]["View Student"]["Report"] = site_url('student_view_report/reports');
		
		//$auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Edit Your Details'] = site_url('student/student_editable_by_student');
		$menu['stu']["View Your Details"] = site_url('student_view_report/view');

		//$auth ==> est_ar
		$menu['est_ar']=array();
		$menu['est_ar']['Student Details']=array();
		$menu['est_ar']['Student Details']['Validation Requests'] = site_url('student/student_validate');


		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */