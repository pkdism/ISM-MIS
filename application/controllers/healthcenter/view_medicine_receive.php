<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_medicine_receive extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
				
									
						$this->load->model('healthcenter/medicine_model','',TRUE);
						$r=$data['mrec_list'] = $this->medicine_model->getMedi_rec();
						$this->drawHeader("Health Center");
						$this->load->view('healthcenter/hmenu');
						$this->load->view('healthcenter/view_medicine_receive',$data);
						$this->drawFooter();
					
					
					
				
			}
			
			
	
	
}
?>

