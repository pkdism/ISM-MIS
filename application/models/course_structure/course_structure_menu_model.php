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
		
		$menu['deo']=array();
		$menu['deo']['Course Structure']=array();
    	$menu['deo']["Course Structure"]["Add a Course"] = site_url('course_structure/add_course');
		$menu['deo']["Course Structure"]["Add/Map a Branch"] = site_url('course_structure/add_branch');
		$menu['deo']["Course Structure"]["Delete Course/Branch"] = site_url('course_structure/delete');
		
		$menu['deo']["Course Structure"]['Add Course Structure']["Department Wise"] = site_url('course_structure/add');
		$menu['deo']["Course Structure"]["Add Course Structure"]['For 1st Year'] = site_url('course_structure/AddCS_Common');
		$menu['deo']["Course Structure"]["Add Course Structure"]['For Honours'] = site_url('course_structure/AddCS_Honour');
		$menu['deo']["Course Structure"]["Add Course Structure"]['For Minor'] = site_url('course_structure/AddCS_Minor');
		
		$menu['deo']["Course Structure"]["Edit Course Structure"] = site_url('course_structure/edit');
		$menu['deo']["Course Structure"]["View Course Structure"] = site_url('course_structure/view');
		
		$menu['deo']["Course Structure"]["Upload Syllabus"] = site_url('course_structure/upload_syllabus');
		
		//$menu['deo']=array();
		$menu['hod']['Course Structure']=array();
		$userid = $this->session->userdata('id');
    	$menu['hod']["Course Structure"]["View Course Structure"] = site_url('course_structure/view/index/'.$userid.'');
			
		//$menu['hod']=array();
		//$menu['hod']['Choose Elective']=array();
		$menu['hod']['Course Structure']["Offer Elective"] = site_url('course_structure/elective_offered_home');
		$menu['hod']['Course Structure']["Offer Honour"] = site_url('course_structure/offer_honour_home');
		$menu['hod']['Course Structure']["Offer Minor"] = site_url('course_structure/offer_minor_home');

		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/course_structure/menu_model.php */