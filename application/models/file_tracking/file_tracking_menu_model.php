<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }

class File_tracking_menu_model extends CI_Model
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
		$menu['emp']['File Tracking'] = array();
		$menu['emp']['File Tracking']['Send New File'] = site_url('file_tracking/send_new_file');
		$menu['emp']['File Tracking']['Receive File'] = site_url('file_tracking/receive_file');
		$menu['emp']['File Tracking']['Pending Files'] = site_url('file_tracking/pending_files');
		$menu['emp']['File Tracking']['Track File'] = site_url('file_tracking/track_file');
		
		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']['File Tracking'] = array();
		$menu['deo']['File Tracking']['Send New File'] = site_url('file_tracking/send_new_file');
		$menu['deo']['File Tracking']['Receive File'] = site_url('file_tracking/receive_file');
		$menu['deo']['File Tracking']['Pending Files'] = site_url('file_tracking/pending_files');
		$menu['deo']['File Tracking']['Track File'] = site_url('file_tracking/track_file');

		return $menu;
	}
}
/* End of file employee_menu.php */
/* Location: mis/application/models/employee/employee_menu.php */