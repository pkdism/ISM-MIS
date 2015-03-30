<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Supp_manu_mapping extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
					
				
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$this->drawHeader("Health Center");
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list1();
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/supp_manu_mapping',$data);
					$this->drawFooter();
					
				
			}
			
			public function insert()
			{
				$supp_manu_data = array(
							's_id' => $this->input->post('s_id'),
							'manu_id' => $this->input->post('manu_id')
			
					);
					
					
			// Loading Model
						$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
			// Transfering Data To Model
						$this->Supplier_medicine_mapping_model->insert($supp_manu_data);
			// Loading View
				$this->session->set_flashdata('flashSuccess','Supplier Manufacturer Mapping Done Successfully.');
				redirect('/healthcenter/supp_manu_mapping/', 'refresh');
		
			}
			
	
	
	
}
?>

