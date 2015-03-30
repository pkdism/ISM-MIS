<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_rc_by_manu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
										
					
					$this->load->model('healthcenter/discount_model','',TRUE);
					$data['show_list'] = $this->discount_model->get_manu_discount();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_rc_by_manu',$data);
					$this->drawFooter();
				
			}
			public function manu_rc_show($id)
			{
	
					$this->load->model('healthcenter/fy_model','',TRUE);
					$data['budget_show'] = $this->fy_model->show_budget_id($id);
					$this->load->view('healthcenter/update_view', $data);
			
			}
			
			
	
	
}
?>

