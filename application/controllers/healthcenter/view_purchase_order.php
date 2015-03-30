<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_purchase_order extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
				
						$this->load->model('healthcenter/indent_model','',TRUE);
						$this->drawHeader("Health Center");
						$this->load->view('healthcenter/hmenu');
						$data['show_list'] = $this->indent_model->getAll_PO();
						$this->load->view('healthcenter/view_po',$data);
						$this->drawFooter();
					
					
					
				
			}
			
			
	
	
}
?>

