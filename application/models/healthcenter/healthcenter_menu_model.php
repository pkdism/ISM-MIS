<?php

class  Healthcenter_menu_model extends CI_Model
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
		$menu['deo']['Health Center']=array();
		$menu['deo']["Health Center"]["Main File"] = site_url('healthcenter/mainfile');
		//$menu['deo']['Health Center']["Add Manufacturer"] = site_url('healthcenter/add_manufacturer');
		//$menu['deo']['Health Center']["Add Suppliers"] = site_url('healthcenter/add_supplier');
		//$menu['deo']['Health Center']["Supplier Manufacturer Mapping"] = site_url('healthcenter/supp_manu_mapping');
		//$menu['deo']['Health Center']["Add Medicine"] = site_url('healthcenter/add_medicine');
		//$menu['deo']['Health Center']["Add Indent"] = site_url('healthcenter/add_indent');
		//$menu['deo']['Health Center']["Add Purchase Order"] = site_url('healthcenter/add_purchase_order');
		//$menu['deo']['Health Center']["Add Medicine Receive"] = site_url('healthcenter/add_medicine_receive');
		
		return $menu;
	}
}
