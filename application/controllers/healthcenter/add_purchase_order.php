<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_purchase_order extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
		
	}
		
	public function index()
	{
			
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('po_ref_no', 'Purchase Order Reference Number', 'required');
		$this->form_validation->set_rules('po_date', 'Purchase Order Date', 'required');
		$this->form_validation->set_rules('indent_id', 'Indent Reference Number', 'required');
		$this->form_validation->set_rules('up_indent', 'Indent Image', 'callback_handle_upload');
		
		
		
		
		
		if ($this->form_validation->run() == TRUE)
		{
			$this->insert();
			
		}
		else
		{
			$this->load->model('healthcenter/Indent_model','',TRUE);
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$data['indent_list'] = $this->Indent_model->getIndent();
				
			$this->load->view('healthcenter/add_purchase_order',$data);
			$this->drawFooter();
		}
	
	
	
	
	
	}
	public function insert()
	{
		
		$t_remarks=$this->input->post('po_remarks');
		if(isset($t_remarks))
		{
			$t_remarks=$this->input->post('po_remarks');
		}
		else{
			$t_remarks=NULL;
		}
		
		if(isset($this->img_name))
		{
			$t_img=$this->img_name;
		}
		else{
			$t_img=NULL;
		}
		
		$data = array(
			'po_refno' => $this->input->post('po_ref_no'),
			'po_date'=>date('Y-m-d',strtotime($this->input->post('po_date'))) ,
			'indent_id'=>$this->input->post('indent_id'),
			'image_path'=>$t_img,
			'remarks'=>$t_remarks
			
				
		);
			$this->load->model('healthcenter/indent_model','',TRUE);
			$this->indent_model->insert_po($data);
		
		
		$this->po_show();
		
		
			
	}
	public function po_show()
	{
			$id=$this->input->post('po_ref_no');
			
			$this->load->model('healthcenter/Indent_model','',TRUE);
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$data['show_details'] = $this->Indent_model->getPODetailByID($id);
			$this->load->view('healthcenter/show_po_desc',$data);
			$this->drawFooter();
		
		
			
	}
	function handle_upload()
		  {
			    $config['upload_path']   = './assets/images/indent/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['file_name'] = $this->input->post('indent_id')."_".time();
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
			  $this->form_validation->set_message('handle_upload', "You must upload Indent Reference Hard Copy!");
			  return false;
			}
		  }
		  
		  function viewpo()
	{
		
		if($this->input->get("id")){
			 $id=$this->input->get("id");
		$this->load->model('healthcenter/indent_model','',TRUE);
		$data['po_details']=$this->indent_model->get_po_byId($id);
		
		//print_r($data);
		//die;
		$this->load->view('healthcenter/viewpo_details',$data);
		
	}
	
	
}
}
?>