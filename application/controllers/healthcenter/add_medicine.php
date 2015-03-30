<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_medicine extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
	public function index()
	{
			
		/*//calling view
		$this->drawHeader("Health Center");
		$this->load->view('healthcenter/index');
		$this->drawFooter();*/
		
		//$this->load->helper(array('healthcenter/add_finyear', 'url'));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('medname', 'Medicine Name', 'required');
		$this->form_validation->set_rules('dropdown_menu', 'Type of Name', 'required|callback_type_check'); 
		//$this->form_validation->set_rules('gname', 'Group Name', 'required');
		//$this->form_validation->set_rules('seffect', 'Side Effect', 'required');
		//$this->form_validation->set_rules('adultdose', 'Adult Dose', 'required');
		//$this->form_validation->set_rules('kiddose', 'Kid Dose', 'required');
		$this->form_validation->set_rules('selmanu', 'Manufacturer', 'required|callback_manu_check');
		$this->form_validation->set_rules('thresh', 'Threshold', 'required');
		$this->form_validation->set_rules('rackno', 'Rack Number', 'required');
		$this->form_validation->set_rules('cabinetno', 'Cabinet Number', 'required');
		//$this->form_validation->set_rules('sdelaytm', 'Standard Delay Time', 'required');
			$this->form_validation->set_rules('c_stock', 'Current Stock', 'required');
			
		
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
			$this->load->view('healthcenter/add_medicine',$data);
			$this->drawFooter();
		}
	
	
	}
	public function insert()
	{
		
		$medi_data = array(
			'm_name' => $this->input->post('medname'),
			'mtype' => $this->input->post('dropdown_menu'),
			'm_generic_nm' => $this->input->post('gname'),
			'm_sideeffect' => $this->input->post('seffect'),
			'm_adult_dose' => $this->input->post('adultdose'),
			'm_kids_dose' => $this->input->post('kiddose'),
			'threshold' => $this->input->post('thresh'),
			'rack_no' => $this->input->post('rackno'),
			'cabi_no' => $this->input->post('cabinetno'),
			'manu_id' => $this->input->post('selmanu'),
			'std_del_time' => $this->input->post('sdelaytm'),
			'c_stock' => $this->input->post('c_stock')
						
			);
			
			// Loading Model
						$this->load->model('healthcenter/medicine_model','',TRUE);
			// Transfering Data To Model
						$this->medicine_model->insert($medi_data);
			// Loading View
				$this->session->set_flashdata('flashSuccess','Medicine Details Added Successfully.');
				redirect('/healthcenter/add_medicine/', 'refresh');
		
		
			
	}
	public function type_check()
    {
            if ($this->input->post('dropdown_menu') === 'Select Type') 
			{
            $this->form_validation->set_message('type_check', 'Please choose type of Medicine');
            return FALSE;
			}
        else {
            return TRUE;
        }
    }
	public function manu_check()
    {
            if ($this->input->post('selmanu') === 'none') 
			{
            $this->form_validation->set_message('manu_check', 'Please choose Manufacturer');
            return FALSE;
			}
        else {
            return TRUE;
        }
    }
	
	
	
	
}
?>