<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rc_compare extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/discount_model','',TRUE);
					$data['show_list'] = $this->discount_model->get_comparision();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/rc_compare',$data);
					
					$this->drawFooter();
				
			}
			
			
			
			
	
	
	
}
?>

