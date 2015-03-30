<?php

class Sah_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> Employee
		$menu['emp']['SAH Management']=array();
		$menu['emp']['SAH Management']['Booking Form'] = site_url('sah/booking/form');
		$menu['emp']['SAH Management']['Track Booking Status'] = site_url('sah/booking/track_status');
		$menu['emp']['SAH Management']['Booked History'] = site_url('sah/booking/history');
		
		//auth ==> Student
		$menu['stu']['SAH Management']=array();
		$menu['stu']['SAH Management']['Booking Form'] = site_url('sah/booking/form');
		$menu['stu']['SAH Management']['Track Booking Status'] = site_url('sah/booking/track_status');
		$menu['stu']['SAH Management']['Booked History'] = site_url('sah/booking/history');
		
		//$auth=> Head of Department
		$menu['hod']['SAH Management']=array();
		$menu['hod']['SAH Management']['Approve/Reject Forms'] = site_url('sah/approve_reject_forms');
		
		return $menu;
	}
}
/* End of file sah_menu.php */
/* Location: mis/application/models/sah/sah_menu_model.php */