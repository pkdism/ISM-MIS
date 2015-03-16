<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queries extends MY_Controller
{

	function __construct()
	{
		parent::__construct(array('est_ar'));
	}

	public function queryByCategory()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Category";
		$ui = new UI();
		$data['options']=array($ui->option()->value('none')->text('Select Category')->disabled()->selected(),
								$ui->option()->value('General')->text('GEN'),
                                $ui->option()->value('OBC')->text('OBC'),
                                $ui->option()->value('SC')->text('SC'),
                                $ui->option()->value('ST')->text('ST'),
                                $ui->option()->value('Others')->text('Others'));
		$this->drawHeader('Query By Category');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}

	public function queryByDepartment()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Department";
		$this->load->model('departments_model','',TRUE);
		$depts=$this->departments_model->get_departments();
		$ui = new UI();
		$options = array($ui->option()->value("none")->text("Select Department")->disabled()->selected());
		foreach($depts as $dept)
			array_push($options,$ui->option()->value($dept->id)->text($dept->name));
		$data['options']=$options;
		$this->drawHeader('Query By Department');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}

	public function queryByDesignation()
	{
		$this->addJS('employee/queries_script.js');
		$data['query_by']="Designation";
		$this->load->model('designations_model','',TRUE);
		$designations=$this->designations_model->get_designations();
		$ui = new UI();
		$options = array($ui->option()->value("none")->text("Select Designation")->disabled()->selected());
		foreach($designations as $des)
			array_push($options,$ui->option()->value($des->id)->text($des->name));
		$data['options']=$options;
		$this->drawHeader('Query By Designation');
		$this->load->view('employee/queries/query',$data);
		$this->drawFooter();
	}
}

/* End of file queries.php */
/* Location: mis/application/controllers/employee/queries.php */