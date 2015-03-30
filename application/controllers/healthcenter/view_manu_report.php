<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_manu_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_manu_report',$data);
					
					$this->drawFooter();
				
			}
			public function show_manu()
			{
				
				$manu_id = $this->input->post('manuDrp');
				$from_date=date("Y-m-d",strtotime($this->input->post('from')));
				$to_date=date("Y-m-d",strtotime($this->input->post('to')));
				$this->addJS('healthcenter/rowGrouping.js');
				//echo $supp_id ;
				//echo $manu_id;
				//echo $from_date;
				//echo $to_date;
				
				$data=array();
		
				$this->load->model('healthcenter/report_model','',TRUE);
				$this->load->model('healthcenter/supplier_model','',TRUE);
				$data['show_details']=$this->report_model->getData_manu($manu_id,$from_date,$to_date);
					
				$this->drawHeader("Health Center Report");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/show_all_report_bymanu',$data);
				$this->drawFooter();
				
			}
			
			
	
	
	
}
?>

