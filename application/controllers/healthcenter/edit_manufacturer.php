<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_manufacturer extends MY_Controller
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
			$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
			$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
			
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$this->load->view('healthcenter/edit_manufacturer',$data);
			$this->drawFooter();
		}
	
	
	
	}
	public function update_manu()
	{
		
		 $id= $this->input->post('manu_id');;
		//print_r($id);
		//die;
		
		$manu_data = array(
			'manu_name' => $this->input->post('m_name'),
			'manu_address' => $this->input->post('m_address'),
			'manu_con_person' => $this->input->post('m_contact'),
			'manu_con_num' => $this->input->post('m_cnumber'),
			'm_ro_address' => $this->input->post('m_reg_address'),
			'm_ro_con_person' => $this->input->post('m_reg_contact'),
			'm_ro_con_num' => $this->input->post('m_reg_cnumber'),
			'm_group' => $this->input->post('group')
						
			);
			
			//print_r($id);
			//die;
			// Loading Model
						$this->load->model('healthcenter/manufacturer_model','',TRUE);
			// Transfering Data To Model
						$this->manufacturer_model->update_manu($id,$manu_data);
			// Loading View
				$this->session->set_flashdata('flashSuccess','Manufacturer Details modified Successfully.');
					echo "1";
				//redirect('/healthcenter/mainfile/', 'refresh');
		
		
			
	}
	
	public function del_manu($id)
	{
		//print_r($id);
		//die;
		
		$this->load->model('healthcenter/manufacturer_model','',TRUE);
		$r=$this->manufacturer_model->delete_ManuBy_id($id);
		$this->session->set_flashdata('flashSuccess','Manufacturer Deleted Successfully.');
					echo "1";
		
	}
	public function get_data($id)
	{
					$this->load->model('healthcenter/manufacturer_model','',TRUE);
					$data['show_list'] = $this->manufacturer_model->getAll_Manu_byID($id);
					echo json_encode($data);
	}
	
	
}
?>