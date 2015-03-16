<?php 

class Send_new_file_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function get_dept($type)
	{
		$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($type);
		$data['result'] = $result;
		$this->load->view('file_tracking/send_new_file/send_new_file_department_name',$data);
	}
	public function get_designation ($dept)
	{
		$this->load->model('file_tracking/file_details');
		$result = $this->file_details->get_designation_by_department_id ($dept);
		$data['result'] = $result;
		$this->load->view('file_tracking/send_new_file/send_new_file_designation',$data);
	}
	public function get_emp_name ($designation, $dept_id)
	{
		$this->load->model('file_tracking/file_details');
		$result = $this->file_details->get_emp_name ($designation, $dept_id);

		$this->load->model('user_model');
		
		$emp_id = $this->session->userdata('id');

		$data_array = array();
		$sno = 1;
		if ($result)
		{
			foreach ($result as $row)
			{			
				if ($row->id != $emp_id)
				{
					$data_array[$sno][1] = $row->id;
					$data_array[$sno++][2] = $this->user_model->getNameById($row->id);
				}
			}
		}
		$total_rows = ($sno-1);		
		$data['data_array'] = $data_array;
		$data['total_rows'] = $total_rows;

		$this->load->view('file_tracking/send_new_file/send_new_file_faculty_name',$data);		
	}
}