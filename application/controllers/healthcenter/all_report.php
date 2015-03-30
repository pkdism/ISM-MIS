<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class All_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
				
			}
			public function show_report()
			{
				$this->load->model('healthcenter/report_model','',TRUE);
				$medi_id = $this->input->post('m_id');
				$manu_id = $this->input->post('selmanu');
						
		
				$data=array();
		
				$this->load->model('healthcenter/report_model','',TRUE);
				$data['show_details']=$this->report_model->getData($medi_id);
		
				// Calling View*********
			
				$this->drawHeader("Health Center Report");
					$this->load->view('healthcenter/show_all_report',$data);
				$this->drawFooter();
		
				//$data=array();
				/* For Medicine
				if($medi_id>0)
				{
				
				$data['show_details']=$this->report_model->get_Medicine_byID($medi_id);
				}
				else
				{
					$data['show_details']=$this->report_model->get_AllMedicine();
				}
		
				// Calling View*********
						
					$this->drawHeader("Student Report");
					
					$this->load->view('healthcenter/show_all_report',$data);
					$this->drawFooter();*/
					
			}
			
			
			
			
			
			
	
	
	
}
?>

