<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_manufacturer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
										
					
					$this->load->model('healthcenter/manufacturer_model','',TRUE);
					$data['show_list'] = $this->manufacturer_model->getAll_Manu();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_manufacturer',$data);
					$this->drawFooter();
				
			}
			
			
	
	
}
?>

