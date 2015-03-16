<?php 

class Add_publication_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

	public function get_type($type)
	{
		$data['type'] = $type;
		$this->load->view('publication/publication_type',$data);
	}
	public function add_authors($total_authors)
	{
		$data['total_authors'] = $total_authors;
		$this->load->view('publication/add_authors',$data);
	}
	public function input_authors($type,$type1)
	{
		$data['type'] = $type;
		$data['author_no']=$type1;
		if($type=='ISM')
			$this->load->view('publication/input_ism_authors',$data);
		else if($type=='OTHER')
			$this->load->view('publication/input_other_authors',$data);
		
	}
	public function find_department($type,$type1)
	{
		$data['type'] = $type;
		$data['author_no']=$type1;
		if($type=='ISM')
		{
			$dept_type='academic';
			$this->load->model('departments_model');
			$result = $this->departments_model->get_departments ($dept_type);
			$data['result'] = $result;
			var_dump($data['result']);
			$this->load->view('publication/put_departments',$data);
		}
	}
	public function find_department_query($type)
	{
		$data['type'] = $type;
		$data['author_no']=$type1;
		if($type=='ISM')
		{
			$dept_type='academic';
			$this->load->model('departments_model');
			$result = $this->departments_model->get_departments ($dept_type);
			$data['result'] = $result;
			var_dump($data['result']);
			$this->load->view('publication/put_department_for_query',$data);
		}
	}
	public function find_faculty($type)
	{
		$data['dept']=$type;
		$this->load->model('publication/basic_model');
		$data['result']=$this->basic_model->get_emp_by_dept($type);
		$this->load->view('publication/put_faculty',$data);
	}
	public function find_faculty_for_query($type)
	{
		$data['dept']=$type;
		$this->load->model('publication/basic_model');
		$data['result']=$this->basic_model->get_emp_by_dept($type);
		$this->load->view('publication/put_faculty_for_query',$data);
	}
}