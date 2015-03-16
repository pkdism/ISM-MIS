<?php 

class Search_publication_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	/*public function get_dept($type)
	{
		$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($type);
		$data['result'] = $result;
		$this->load->view('file_tracking/send_new_file/send_new_file_department_name',$data);
	}*/
	
	public function find_department()
	{
		$dept_type='academic';
		$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($dept_type);
		$data['result'] = $result;
		$this->load->view('publication/put_departments',$data);
	}
	public function find_department_query()
	{
		$dept_type='academic';
		$this->load->model('departments_model');
		$result = $this->departments_model->get_departments ($dept_type);
		$data['result'] = $result;
		$this->load->view('publication/put_department_for_query',$data);
	}
	
}