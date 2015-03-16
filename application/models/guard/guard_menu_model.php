<?php

class Guard_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		//auth ==> Security Estate Officer
		$menu['seo']['Guard Management']=array();
		$menu['seo']['Guard Management']['Home'] = site_url('guard/home');
		
		$menu['seo']['Guard Management']['Duties'] = array();
		//$menu['seo']['Guard Management']['Duties']['Auto Assignment'] = site_url('guard/duties/auto_assignment');
		$menu['seo']['Guard Management']['Duties']['Assign Duties'] = array();
		$menu['seo']['Guard Management']['Duties']['Assign Duties']['Regular'] = site_url('guard/duties/assign_regular');
		$menu['seo']['Guard Management']['Duties']['Assign Duties']['Overtime'] = site_url('guard/duties/assign_overtime');
		
		$menu['seo']['Guard Management']['Duties']['Assign Duty to a Guard'] = site_url('guard/duties/assign_to_a_guard');
		
		$menu['seo']['Guard Management']['Duties']['View Duty Chart'] = site_url('guard/duties/view');
		
				
		$menu['seo']['Guard Management']['Manage Guard'] = array();
		$menu['seo']['Guard Management']['Manage Guard']['Add Guard'] = site_url('guard/manage_guard/add');
		$menu['seo']['Guard Management']['Manage Guard']['View Existing Guards'] = site_url('guard/manage_guard/view');
		
		$menu['seo']['Guard Management']['Manage Post'] = array();
		$menu['seo']['Guard Management']['Manage Post']['Add Post'] = site_url('guard/manage_post/add');	
		$menu['seo']['Guard Management']['Manage Post']['View Existing Posts'] = site_url('guard/manage_post/view');	
		
		
		//auth ==> guard supervisor
		$menu['guard_sup']['Guard Management']=array();
		$menu['guard_sup']['Guard Management']['Home'] = site_url('guard/home');
		
		$menu['guard_sup']['Guard Management']['Duties'] = array();
		//$menu['guard_sup']['Guard Management']['Duties']['Auto Assignment'] = site_url('guard/duties/auto_assignment');
		$menu['guard_sup']['Guard Management']['Duties']['Assign Duties'] = array();
		$menu['guard_sup']['Guard Management']['Duties']['Assign Duties']['Regular'] = site_url('guard/duties/assign_regular');
		$menu['guard_sup']['Guard Management']['Duties']['Assign Duties']['Overtime'] = site_url('guard/duties/assign_overtime');
		
		$menu['guard_sup']['Guard Management']['Duties']['Assign Duty to a Guard'] = site_url('guard/duties/assign_to_a_guard');
		
		$menu['guard_sup']['Guard Management']['Duties']['View Duty Chart'] = site_url('guard/duties/view');
		
		return $menu;
	}
}
/* End of file information_menu.php */
/* Location: mis/application/models/information/information_menu.php */