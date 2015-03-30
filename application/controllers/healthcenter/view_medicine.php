<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_medicine extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
				
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['show_list'] = $this->medicine_model->getAll_Medicine();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_medicine',$data);
					$this->drawFooter();
					
					
				
			}
			
			
			
	
	
}
?>

