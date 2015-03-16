<?php

class Student_sem_form_menu_model extends CI_Model
{
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function getMenu()
	{
		$this->load->model('student_sem_form/sbasic_model');
		if($this->sbasic_model->checkDate()){
		$menu=array();
		//auth ==> stu
		$menu['stu']=array();
		$menu['stu']['Semester Registration']=array();
		$menu['stu']["Semester Registration"]["Semester Form"] = site_url('student_sem_form/regular_form');
		//auth ==> hod
		$menu['hod']=array();
		$menu['hod']["Semester Approved"]["Semester Form"] = site_url('student_sem_form/regular_check');
		}
		//auth ==> deo
		$menu['deo']=array();
		$menu['deo']["Semester date"]["Set Semester Reg.Date"] = site_url('student_sem_form/date');
		$menu['deo']["Semester Approved"]["Semester Form"] = site_url('student_sem_form/regular_check_acdamic');
		
		return $menu;
	}
}
/* End of file menu_model.php */
/* Location: mis/application/models/employee/menu_model.php */