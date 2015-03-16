<?php

class Employee_menu_model extends CI_Model
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
		$menu['emp']['Employee Details']=array();
		$menu['emp']["Employee Details"]["View your Details"] = site_url('employee/view');
		$menu['emp']["Employee Details"]["Edit your Details"] = site_url('employee/edit');

		//auth ==> est_ar
		$menu['est_ar']=array();
		$menu['est_ar']['Employee Details']=array();
		$menu['est_ar']["Employee Details"]["Validation Requests"]=site_url('employee/validation');
		$menu['est_ar']["Employee Details"]["Database Queries"]=array();
		$menu['est_ar']["Employee Details"]["Database Queries"]["Get Employee By Category"]=site_url('employee/queries/queryByCategory');
		$menu['est_ar']["Employee Details"]["Database Queries"]["Get Employee By Department"]=site_url('employee/queries/queryByDepartment');
		$menu['est_ar']["Employee Details"]["Database Queries"]["Get Employee By Designation"]=site_url('employee/queries/queryByDesignation');

		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']['Manage Employees']=array();
		$menu['deo']["Manage Employees"]["Add Employee"] = site_url('employee/add');
		$menu['deo']["Manage Employees"]["View Employee Details"] = site_url('employee/view');
		$menu['deo']["Manage Employees"]["Edit Employee Details"] = site_url('employee/edit');
		$menu['deo']["Manage Employees"]["Validation Requests"] = site_url('employee/validation');

		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */