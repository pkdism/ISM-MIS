<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_rc_by_supp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
										
					
					$this->load->model('healthcenter/discount_model','',TRUE);
					$data['show_list'] = $this->discount_model->get_supp_discount();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_rc_by_supp',$data);
					$this->drawFooter();
				
			}
			
			
	
	
}
?>

