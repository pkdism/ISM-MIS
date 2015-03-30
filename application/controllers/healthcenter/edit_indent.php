<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_indent extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
										
					$this->load->model('healthcenter/indent_model','',TRUE);
					$data['indent_list'] = $this->indent_model->getIndent();
					
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/edit_indent',$data);
					$this->drawFooter();
					
					
					
				
			}
			
			
	
	
}
?>

