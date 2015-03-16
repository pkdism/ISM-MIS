<?php

class Course_structure_menu_model extends CI_Model
{
	function __construct()
	{
		// Calling the Model parent constructor
		parent::__construct();
	}

	function getMenu()
	{
		$menu=array();
		
		$menu['tp']=array();
		$menu['tp']['Course Structure']=array();
    	$menu['tp']["Course Structure"]["Add a Course"] = site_url('course_structure/add_course');
		$menu['tp']["Course Structure"]["Add/Map a Branch"] = site_url('course_structure/add_branch');
		//$menu['deo']["Course Structure"]["Select Courses Run by Department"] = site_url('course_structure/map_dept');
		$menu['tp']["Course Structure"]["Add Course Structure"] = site_url('course_structure/add');
		$menu['tp']["Course Structure"]["Edit Course Structure"] = site_url('course_structure/edit');
		$menu['tp']["Course Structure"]["View Course Structure"] = site_url('course_structure/view');
		
		//$menu['deo']=array();
		$menu['tp']['Course Structure']=array();
		$userid = $this->session->userdata('id');
    	$menu['hod']["Course Structure"]["View Course Structure"] = site_url('course_structure/view/index/'.$userid.'');
			
		//$menu['hod']=array();
		//$menu['hod']['Choose Elective']=array();
		$menu['hod']['Course Structure']["Offer Elective"] = site_url('course_structure/elective_offered_home');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */