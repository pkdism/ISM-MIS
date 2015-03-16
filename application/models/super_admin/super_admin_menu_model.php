<?php

class Super_admin_menu_model extends CI_Model
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
		$menu['admin']=array();
		$menu['admin']['Change Password']= site_url('super_admin/admin/change_password');
		$menu['admin']['Assign Authorizations'] = site_url('super_admin/admin/assign_auths');
		$menu['admin']['Deny Authorizations'] = site_url('super_admin/admin/deny_auths');
		return $menu;
	}
}
/* End of file super_admin_menu_models.php */
/* Location: mis/application/models/super_admin/super_admin_menu_model.php */