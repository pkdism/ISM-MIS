<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_report extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					//---------------Model calling starts------------------------------
					// Model for manufacturer, supplier,
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					// Model for medicine, Purchase Order
					$this->load->model('healthcenter/medicine_model','',TRUE);
					// Model for Indent
					$this->load->model('healthcenter/Indent_model','',TRUE);
					
					//---------------Model calling ends------------------------------
					
					// Manufacturer
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					
					//Supplier
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list();
					
					//Medicine
					$data['medi_list'] = $this->medicine_model->getAll_MedicineName();
					
					//Indent
					$data['indent_list'] = $this->Indent_model->getIndent();
					//Emergency Indent
					$data['emer_list'] = $this->Indent_model->get_Emer_Indent();
					//Purchase Order
					$data['po_list'] = $this->medicine_model->get_po_indent();
					//Emergency
					
					//Group
					
					//Date
					
					//Date Range
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_report',$data);
					$this->drawFooter();
				
			}
			
			
			
			
			
			
	
	
	
}
?>

