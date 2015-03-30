<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_manufacturer extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
	public function index()
	{
			
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('m_name', 'Manufacturer Name', 'required');
		
		$this->form_validation->set_rules('group', 'Select any one group', 'required');
		
		
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->insert();
			
		}
		else
		{
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$this->load->view('healthcenter/add_manufacturer');
			$this->drawFooter();
		}
	
	
	
	}
	public function insert()
	{
		
		
		$manu_data = array(
			'manu_name' => $this->input->post('m_name'),
			'manu_address' => $this->input->post('m_address'),
			'manu_con_person' => $this->input->post('m_contact'),
			'manu_con_num' => $this->input->post('m_cnumber'),
			'm_ro_address' => $this->input->post('m_reg_address'),
			'm_ro_con_person' => $this->input->post('m_reg_contact'),
			'm_ro_con_num' => $this->input->post('m_reg__cnumber'),
			'm_group' => $this->input->post('group')
						
			);
			// Loading Model
						$this->load->model('healthcenter/manufacturer_model','',TRUE);
			// Transfering Data To Model
						$this->manufacturer_model->insert($manu_data);
			// Loading View
				$this->session->set_flashdata('flashSuccess','Manufacturer Details Added Successfully.');
				redirect('/healthcenter/add_manufacturer/', 'refresh');
		
			
			
	}
	
	
}
?>