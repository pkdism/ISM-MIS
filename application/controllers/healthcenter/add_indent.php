<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_indent extends MY_Controller
{
	public $img_name;
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}
		
	public function index()
	{
			
		
		$this->form_validation->set_rules('ind_ref_no', 'Indent Reference Number', 'required');
		$this->form_validation->set_rules('ind_date', 'Indent Date', 'required');
		$this->form_validation->set_rules('selsup', 'Supplier', 'required|callback_supp_check'); 
			
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->insert();
			//$this->description();
			//$this->insert_desc();
		}
		else
		{
			
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$this->load->model('healthcenter/fy_model','',TRUE);
					
					
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list1();
					$data['fy_list1'] = $this->fy_model->fyear_getAll();
					$data['sum_group'] = $this->fy_model->get_Sum_group();
					$data['count_row'] = $this->fy_model->get_rowFrom_mRec();
										
					
					$this->load->view('healthcenter/add_indent',$data);
					$this->drawFooter();
		}
	
	
	}
	public function insert()
	{
		$timestamp = date('Y-m-d H:i:s');
		$t_remarks=$this->input->post('ind_remarks');
		if(isset($t_remarks))
		{
			$t_remarks=$this->input->post('ind_remarks');
		}
		else{
			$t_remarks=NULL;
		}
		
		$data = array(
			'indent_ref_no' => $this->input->post('ind_ref_no'),
			'indent_date'=>date('Y-m-d',strtotime($this->input->post('ind_date'))) ,
			'ind_type'=> $this->input->post('ind_type'),
			's_id'=>$this->input->post('selsup'),
			'indent_timestamp'=>$timestamp,
			'image_path'=>NULL,
			'remarks'=>$t_remarks
				
		);
			$this->load->model('healthcenter/indent_model','',TRUE);
			$lid=$this->indent_model->insert_indent($data);
			//$this->session->set_flashdata('flashSuccess','Indent Added Successfully.');
			//redirect('/healthcenter/add_indent_desc/', 'refresh');
			$this->description($lid);
			
			//Either you can print value or you can send value to database
			//echo json_encode($data);
			
		
	}
	public function insert_desc()
	{
			
		
		$data = array(
			'indent_id' => $this->input->post('indId'),
			'm_id'=>$this->input->post('m_id'),
			'std_pkt'=>$this->input->post('std_pkt'),
			'app_rate'=>$this->input->post('app_rate'),
			'ind_qty'=>$this->input->post('m_quantity'),
			'app_cost'=>($this->input->post('app_rate')*$this->input->post('m_quantity'))
			);
			
			$this->load->model('healthcenter/indent_model','',TRUE);
			$lid=$this->indent_model->insertIndentDes($data);
			if(isset($lid)){
					$r=$this->indent_model->getIndentDesById($lid,1);
					foreach($r as $re)
					echo json_encode($re);
			}
			
	}
	
	public function desc_delete($id)
	{
		$this->load->model('healthcenter/indent_model','',TRUE);
		$this->indent_model->delete_indent($id);
	}
	
	
	public function description($lid)
	{
			if(!$lid)
				redirect("healthcenter/add_indent");
			$data['ind_id']=$lid;
			
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$this->load->view('healthcenter/add_indent_desc',$data);
			$this->drawFooter();
		
		
			
	}
	
	
	
	function handle_upload()
		  {
			    $config['upload_path']   = './assets/images/indent/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['file_name'] = $this->input->post('ind_ref_no')."_".time();
				$this->load->library('upload', $config);
			if (isset($_FILES['up_indent']) && !empty($_FILES['up_indent']['name']))
			  {

			  if ($this->upload->do_upload('up_indent'))
			  {
				// set a $_POST value for 'image' that we can use later
				$upload_data    = $this->upload->data();
				$this->img_name = $upload_data['file_name'];
				$_POST['up_indent'] = $upload_data['file_name'];
				return true;
			  }
			  else
			  {
				// possibly do some clean up ... then throw an error
				$this->form_validation->set_message('handle_upload', $this->upload->display_errors());
				return false;
			  }
			}
			else
			{
			  // throw an error because nothing was uploaded
			  $this->form_validation->set_message('handle_upload', "You must upload Fee Receipt!");
			  return false;
			}
		  }
		
	function GetMedi(){
		
		$this->load->model('healthcenter/medicine_model');
		if (isset($_GET['term'])){
		$id = strtolower($_GET['term']);
		$this->medicine_model->getAMed($id);
		}
		
	}
	
	function getMedicineA()
	{
		
	//echo $this->input->get("mid");
//die;
		$this->load->model('healthcenter/medicine_model');
		$r['med_d']=$this->medicine_model->getMedcineIdByName(strtolower($this->input->get("mid")),1);
		
		//$r=$this->medicine_model->getMedicineById($tmp['m_id'],1);
		$r['suggest']=$this->medicine_model->getMedByGroup($r['med_d'][0]['m_generic_nm']);
			//print_r($r);
			echo json_encode($r);
	}
	
	function viewindent()
	{
	//	$this->addJS('employee/print_script.js');
		if($this->input->get("id")){
			 $id=$this->input->get("id");
		$this->load->model('healthcenter/indent_model','',TRUE);
		$data['indent_details']=$this->indent_model->get_indentbyId($id);
		
		//print_r($data);
		//die;
		$this->load->view('healthcenter/viewindent_details',$data);
		}
	}
	function fedit_indent($id)
	{
		
		$this->load->model('healthcenter/indent_model','',TRUE);
		$r=$this->indent_model->get_indent_list($id,1);
		if(isset($r)){
			
				echo json_encode($r);
			}
		//print_r($data);
		//die;
		
		/*$indent_id=$this->input->post("indent_id");
		//echo ($indent_id);
		$this->load->model('healthcenter/indent_model','',TRUE);
		$r=$this->indent_model->get_indent_list($indent_id,1);
		
		if(isset($r)){
			
				echo json_encode($r);
			}*/
	}
	
	public function ind_update()
	{
		foreach($_POST as $key => $val){
					if(!$val){
						echo $key;
						return false;
					}
		}
		$this->load->model('healthcenter/indent_model','',TRUE);
		$this->indent_model->update_indent($_POST,$this->input->post('ind_des_id'));
		echo "0";
		return false;
	}
	public function del_indent($id)
	{
		
		$this->load->model('healthcenter/indent_model','',TRUE);
		$r=$this->indent_model->delete_indentBy_id($id);
		
	}
	
	public function supp_check()
    {
            if ($this->input->post('selsup') === 'supplist') 
			{
            $this->form_validation->set_message('supp_check', 'Please Select Supplier');
            return FALSE;
			}
        else {
            return TRUE;
        }
    }
	

	
}
?>