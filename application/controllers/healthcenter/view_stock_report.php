<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_stock_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['manu_list'] = $this->medicine_model->get_medicine_list1();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_stock_report',$data);
					
					$this->drawFooter();
				
			}
			public function show_medi()
			{
				
				$medi_id = $this->input->post('mediDrp');
				$this->addJS('healthcenter/rowGrouping.js');
			//	$from_date=date("Y-m-d",strtotime($this->input->post('from')));
				//$to_date=date("Y-m-d",strtotime($this->input->post('to')));
				
				//echo $supp_id ;
				//echo $manu_id;
				//echo $from_date;
				//echo $to_date;
				
				$data=array();
		
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['show_list'] = $this->medicine_model->getAll_Medicine_stock($medi_id);//_stock($medi_id,$from_date,$to_date	);
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_medicine1',$data);
					$this->drawFooter();
				
			}
			
			
	
	
	
}
?>

