<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_rate_contract extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->load->model('healthcenter/medicine_model','',TRUE);		
		
	}
		
			public function index()
			{
					
					$data['medi_list'] =$this->medicine_model->get_medicine_list();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/add_rate_contract',$data);
					$this->drawFooter();
				
			}
			
			public function show_manu()
			{
				 $id_medi = $this->input->post('id'); 
							
				$data['manu_nm'] =$this->medicine_model->get_manu_name($id_medi);
				$data['supp_nm'] =$this->medicine_model->get_supplier_bymedicineid($id_medi);
										
				echo json_encode($data);
			}
			
	
	
	
}
?>

