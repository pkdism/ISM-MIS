<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_indent extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
				
					
					$this->load->model('healthcenter/indent_model','',TRUE);
					$data['show_list'] = $this->indent_model->getAll_Indent();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_indent',$data);
					$this->drawFooter();
					
					
					
					
				
			}
			
			
	
	
}
?>

