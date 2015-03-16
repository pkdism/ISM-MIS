<?php

//Including the Employee Model
$CI = &get_instance();
$CI->load->model('employee_model','',TRUE);

class Faculty_model extends Employee_Model
{

	public $models = array('employee/faculty_details_model');

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model($this->models,'',TRUE);
	}

	function getById($id = '')
	{
		$employee = Employee_Model::getById($id);
		$faculty_details = $this->faculty_details_model->getFacultyById($id);

		if($employee && $faculty_details)
			return (object)(array_merge((array)$employee,(array)$faculty_details)) ;
		else
			return FALSE;
	}

}

/* End of file faculty_model.php */
/* Location: mis/application/models/faculty_model.php */