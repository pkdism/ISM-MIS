<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mainfile extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
			public function index()
			{
					
				
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['show_list'] = $this->medicine_model->getAll_Medicine();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/view_medicine_status',$data);
					
					$this->drawFooter();
				
			}
			public function fin_year()
			{
				
				$selected_radio = $_POST['hcmain'];
				//echo $selected_radio;
				if($selected_radio=="addfy")
				{
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/add_finyear');
					$this->drawFooter();
				}
				if($selected_radio=="viewfy")
				{
					$this->load->model('healthcenter/fy_model','',TRUE);
					$data['fy_list'] = $this->fy_model->fyear_getAll();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_finyear',$data);
					$this->drawFooter();
				}
				if($selected_radio=="addmanu")
				{
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/add_manufacturer');
					$this->drawFooter();
				}
				if($selected_radio=="viewmanu")
				{
					$this->load->model('healthcenter/manufacturer_model','',TRUE);
					$data['show_list'] = $this->manufacturer_model->getAll_Manu();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_manufacturer',$data);
					$this->drawFooter();
				}
				if($selected_radio=="addsupp")
				{
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/add_supplier');
					$this->drawFooter();
				}
				if($selected_radio=="viewsupp")
				{
					$this->load->model('healthcenter/supplier_model','',TRUE);
					$data['show_list'] = $this->supplier_model->getAll_Suppliers();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_suppliers',$data);
					$this->drawFooter();
				}
				if($selected_radio=="smmapp")
				{
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$this->drawHeader("Health Center");
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list();
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					
					$this->load->view('healthcenter/supp_manu_mapping',$data);
					$this->drawFooter();
				}
				if($selected_radio=="viewsmmapp")
				{
					$this->load->model('healthcenter/supplier_model','',TRUE);
					$data['show_list'] = $this->supplier_model->get_Supp_Manu();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_suppliers_manu',$data);
					$this->drawFooter();
				}
				if($selected_radio=="addmedi")
				{
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/add_medicine',$data);
					$this->drawFooter();
				}
				if($selected_radio=="viewmedi")
				{
					$this->load->model('healthcenter/medicine_model','',TRUE);
					$data['show_list'] = $this->medicine_model->getAll_Medicine();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_medicine',$data);
					$this->drawFooter();
				}
				if($selected_radio=="addindent")
				{
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$this->load->model('healthcenter/fy_model','',TRUE);
					
					
					$this->drawHeader("Health Center");
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list();
					$data['fy_list1'] = $this->fy_model->fyear_getAll();
					$this->load->view('healthcenter/add_indent',$data);
					$this->drawFooter();
				}
				if($selected_radio=="viewindent")
				{
				
					$this->load->model('healthcenter/indent_model','',TRUE);
					$data['show_list'] = $this->indent_model->getAll_Indent();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/view_indent',$data);
					$this->drawFooter();
				}
				if($selected_radio=="editindent")
				{
				
					$this->load->model('healthcenter/indent_model','',TRUE);
					$data['indent_list'] = $this->indent_model->getIndent();
					
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/edit_indent',$data);
					$this->drawFooter();
				}
				// Purchase Order
				if($selected_radio=="addpo")
				{
					$this->load->model('healthcenter/Indent_model','',TRUE);
					$this->drawHeader("Health Center");
					$data['indent_list'] = $this->Indent_model->getIndent();
					$this->load->view('healthcenter/add_purchase_order',$data);
					$this->drawFooter();
				}
				if($selected_radio=="viewpo")
				{
						
						$this->load->model('healthcenter/indent_model','',TRUE);
						$this->drawHeader("Health Center");
						$data['show_list'] = $this->indent_model->getAll_PO();
						$this->load->view('healthcenter/view_po',$data);
						$this->drawFooter();
				}
				//-----End of PO-------
				//---- Medicine Recieve-----------
					if($selected_radio=="addmrec")
				{
					$this->load->model('healthcenter/Medicine_model','',TRUE);
					$data['po_list'] = $this->Medicine_model->get_po_indent();
					$data['po_list1'] = $this->Medicine_model->get_po_outdated();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/add_medicine_receive',$data);
					$this->drawFooter();
				}
				if($selected_radio=="viewmrec")
				{
						
						echo "hello";
				}
						
				// ----End of Medicine Recieve----
				
				
				
				
			}
			
	
	
	
}
?>

