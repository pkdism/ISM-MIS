<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_exp_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_exp_report');
					
					$this->drawFooter();
				
			}
			public function show_manu()
			{
				
				
				$from_date=date("Y-m-d",strtotime($this->input->post('from')));
				$to_date=date("Y-m-d",strtotime($this->input->post('to')));
				$this->addJS('healthcenter/rowGrouping.js');
				//echo $supp_id ;
				//echo $manu_id;
				
				$data=array();
		
				$this->load->model('healthcenter/report_model','',TRUE);
				$data['show_details']=$this->report_model->getData_Exp($from_date,$to_date);
				//$data['show_details']=$this->report_model->getData_Exp();
					
					$this->drawHeader("Health Center Report");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/show_exp_report',$data);
					$this->drawFooter();
				
			}
			
			
	
	
	
}
?>

