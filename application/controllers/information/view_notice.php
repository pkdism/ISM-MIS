<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$this->load->model('information/view_notice_model','',TRUE);
		$data['notices'] = $this->view_notice_model->get_notices();
		$data['count_current_notice']=count($data['notices']);
		
		$this->load->model('information/viewnotice_model','',TRUE);
		$data['notices_archived'] = $this->viewnotice_model->get_notices();
		$data['count_archived_notice']=count($data['notices_archived']);
		$this->drawHeader('View Notice');
		$this->load->view('information/viewNotice',$data);
		$this->drawFooter();
			
	}
	
	public function prev($notice_id='')
	{
		if($notice_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}		
		
		$this->load->model('information/viewprevnotice_model','',TRUE);
		$data['notices'] = $this->viewprevnotice_model->get_notices($notice_id);

		if(count($data['notices']) == 0)
		{
			$this->session->set_flashdata('flashError','There is no any notice to view.');
			redirect('home');
		}
		$data['prevnotice'] = $notice_id;
		$this->drawHeader('View Notice');
		$this->load->view('information/view_Old_Notice',$data);
		$this->drawFooter();
	}
	
}
/* End of file view_notice.php */
/* Location: mis/application/controllers/information/view_notice.php */
