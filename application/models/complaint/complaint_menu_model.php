<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }

class Complaint_menu_model extends CI_Model
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
		$menu['emp']['Online Complaint'] = array();
		$menu['emp']['Online Complaint']['Register your Complaint'] = site_url('complaint/register_complaint');
		$menu['emp']['Online Complaint']['View all your Complaint'] = site_url('complaint/view_own_complaint');
		
		//auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Online Complaint'] = array();
		$menu['stu']['Online Complaint']['Register your Complaint'] = site_url('complaint/register_complaint');
		$menu['stu']['Online Complaint']['View all your Complaint'] = site_url('complaint/view_own_complaint');

		$menu['spvr_cc']=array();
		$menu['spvr_cc']['Online Complaint'] = site_url('complaint/supervisor/view_complaints/Internet');
		
		$menu['spvr_civil']=array();
		$menu['spvr_civil']['Online Complaint'] = site_url('complaint/supervisor/view_complaints/Civil');

		$menu['spvr_ee']=array();
		$menu['spvr_ee']['Online Complaint'] = site_url('complaint/supervisor/view_complaints/Electrical');
		
		$menu['spvr_mess']=array();
		$menu['spvr_mess']['Online Complaint'] = site_url('complaint/supervisor/view_complaints/Mess');
		
		$menu['spvr_snt']=array();
		$menu['spvr_snt']['Online Complaint'] = site_url('complaint/supervisor/view_complaints/Sanitary');
		
		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */