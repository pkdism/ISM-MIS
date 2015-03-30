<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_supplier extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->load->model('healthcenter/supplier_model','',TRUE);
			
		
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
		
		$this->form_validation->set_rules('supname', 'Supplier Name', 'required');
		$this->form_validation->set_rules('add1', 'Address1', 'required');
		$this->form_validation->set_rules('add2', 'Address2');
		$this->form_validation->set_rules('add3', 'Address3');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('selstate', 'State', 'required|callback_state_check');
		$this->form_validation->set_rules('tinno', 'Tin No.', 'required');
		$this->form_validation->set_rules('cstno', 'CST No.', 'required');
		$this->form_validation->set_rules('dlno', 'Drug Licence No.', 'required');
		$this->form_validation->set_rules('phno', 'Phone Number', 'required|numeric');
		$this->form_validation->set_rules('cperson', 'Contact Person', 'required');
		$this->form_validation->set_rules('cpersonmob', 'Contact Person Mobile No.', 'required|numeric');
		$this->form_validation->set_rules('bname', 'Bank Name', 'required');
		$this->form_validation->set_rules('baccno', 'Bank Account Number', 'required|numeric');
		$this->form_validation->set_rules('bifcs', 'IFCS Code');
		$this->form_validation->set_rules('semailid', 'Email ID');
		$this->form_validation->set_rules('pannum', 'Pan Number');
		
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->insert();
			
		}
		else
		{
			
			$data['states']=$this->supplier_model->get_states();
			
		
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$this->load->view('healthcenter/add_supplier',$data);
			$this->drawFooter();
		}
	
	
	
	
	
	}
	public function insert()
	{
		
		// Model loaded already in constructor
		
		//$st_id=$this->input->post('id');
		//$tmp[0]=$this->supplier_model->get_st_name($st_id);
		
		//print_r($tmp[0]->name);
		//die;
		$supp_data = array(
			's_name' => $this->input->post('supname'),
			's_address1' => $this->input->post('add1'),
			's_address2' => $this->input->post('add2'),
			's_address3' => $this->input->post('add3'),
			's_city' => $this->input->post('city'),
			's_state' => $this->input->post('selstate'),
			's_tin_no' => $this->input->post('tinno'),
			's_cst_no' => $this->input->post('cstno'),
			's_dl_no' => $this->input->post('dlno'),
			's_phone_no' => $this->input->post('phno'),
			's_c_Person' => $this->input->post('cperson'),
			's_c_Person_mob' => $this->input->post('cpersonmob'),
			'bank_name' => $this->input->post('bname'),
			'acc_no' => $this->input->post('baccno'),
			'ifcs_code' => $this->input->post('bifcs'),
			'email_id' => $this->input->post('semailid'),
			'pan_card' => $this->input->post('pannum')
			
								
			);
			// Loading Model
						$this->load->model('healthcenter/supplier_model','',TRUE);
			// Transfering Data To Model
						$this->supplier_model->insert($supp_data);
			// Loading View
				$this->session->set_flashdata('flashSuccess','Supplier Details Added Successfully.');
				redirect('/healthcenter/add_supplier/', 'refresh');
		
		
			
	}
	public function state_check()
    {
            if ($this->input->post('selstate') === 'none') 
			{
            $this->form_validation->set_message('state_check', 'Please Select State');
            return FALSE;
			}
        else {
            return TRUE;
        }
    }
	
	
}
?>