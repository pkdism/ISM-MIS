<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_group_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['medi_list'] = $this->medicine_model->get_medicine_list1();
				
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_group_report',$data);
					
					$this->drawFooter();
				
			}
			public function show_manu()
			{
				$m_id = $this->input->post('mediDrp');
				$this->addJS('healthcenter/rowGrouping.js');
				//echo $m_id;
				$this->load->model('healthcenter/report_model','',TRUE);
				$data['show_details']=$this->report_model->getData_medi($m_id);
		
		
				$this->drawHeader("Health Center Report");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/show_group_report',$data);
				$this->drawFooter();
				
			}
			
			
	
	
	
}
?>

