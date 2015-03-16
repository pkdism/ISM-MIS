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
		
		//auth ==> emp
		$menu['emp']["Manage Students"]["View Student"]["Details"] = site_url('student_view_report/view');
		$menu['emp']["Manage Students"]["View Student"]["Report"] = site_url('student_view_report/reports');
		
		//$auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Edit Your Details'] = site_url('student/student_editable_by_student');
		$menu['stu']["View Your Details"] = site_url('student_view_report/view');


		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */