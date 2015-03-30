<?php

class Subject_mapping_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		
		$menu=array();
		//auth ==> hod
		$menu['hod']=array();
		$menu['hod']["Subject Mapping"] =array();
		$menu['hod']["Subject Mapping"]['Subject Mapping'] = site_url('subject_mapping/departmentwise/');
		$menu['hod']["Subject Mapping"]['Manage Mapping'] = site_url('subject_mapping/main/mappingView');
		
		
		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']["Subject Mapping"] =array();
		$menu['deo']["Subject Mapping"]['Subject Mapping'] = site_url('subject_mapping/main');
		$menu['deo']["Subject Mapping"]['Manage Mapping'] = site_url('subject_mapping/main/mappingView');
		
		return $menu;
	}
	
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */