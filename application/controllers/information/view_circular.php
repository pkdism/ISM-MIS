<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('information/view_circular_model','',TRUE);
		$data['circulars'] = $this->view_circular_model->get_circulars();
		$data['count_current_circular']=count($data['circulars']);
		
		$this->load->model('information/viewcircular_model','',TRUE);
		$data['circulars_archived'] = $this->viewcircular_model->get_circulars();
		$data['count_archived_circular']=count($data['circulars_archived']);
		$this->drawHeader('View Circular');
		$this->load->view('information/viewCircular',$data);
		$this->drawFooter();
			
	}
	
	public function prev($circular_id='')
	{
		if($circular_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewprevcircular_model','',TRUE);
		$data['circulars'] = $this->viewprevcircular_model->get_circulars($circular_id);

		if(count($data['circulars']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any circular to view.');
			redirect('home');
		}
		$data['prevcircular'] = $circular_id;
		$this->drawHeader('View Circular');
		$this->load->view('information/view_Old_Circular',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_circular.php */
/* Location: mis/application/controllers/information/view_circular.php */
