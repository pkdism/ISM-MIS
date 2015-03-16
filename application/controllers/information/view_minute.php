<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('information/view_minute_model','',TRUE);
		$data['minutes'] = $this->view_minute_model->get_minutes();
		$data['count_current_minutes']=count($data['minutes']);
		
		$this->load->model('information/viewminute_model','',TRUE);
		$data['minutes_archived'] = $this->viewminute_model->get_minutes();
		$data['count_archived_minutes']=count($data['minutes_archived']);
		$this->drawHeader('View Minutes');
		$this->load->view('information/viewMinute',$data);
		$this->drawFooter();
			
	}
	
	public function prev($minutes_id='')
	{
		if($minutes_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewprevminute_model','',TRUE);
		$data['minutes'] = $this->viewprevminute_model->get_minutes($minutes_id);

		if(count($data['minutes']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any minutes to view.');
			redirect('home');
		}
		$data['prevminutes'] = $minutes_id;
		$this->drawHeader('View Minutes');
		$this->load->view('information/view_Old_Minutes',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_minutes.php */
/* Location: mis/application/controllers/information/view_minutes.php */
