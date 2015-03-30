<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_finyear extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
					$this->load->model('healthcenter/fy_model','',TRUE);
					//$this->output->enable_profiler(true);
					$r=$data['fy_list'] = $this->fy_model->fyear_getAll_view();
					if($r)
					{
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_finyear',$data);
					$this->drawFooter();
					}
					else
					{
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/show_error');
					$this->drawFooter();
					}
				
			}
			
			
	
	
}
?>

