<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rc_by_manu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$data['manu_list'] = $this->Supplier_medicine_mapping_model->get_manu_list();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/rc_by_manu',$data);
					$this->drawFooter();
				
			}
			
			function show_medi($id)
			{
				$this->load->model('healthcenter/medicine_model','',TRUE);
				$r=$this->medicine_model->get_Medi_By_ManuID($id);
				if(isset($r))
				{
						echo json_encode($r);
				}
				
			}
			function insert()
			{
				$data = array(
					'manu_id' => $this->input->post('manu_id'),
					'm_id'=>$this->input->post('m_id'),
					'mdis'=>$this->input->post('mdis'),
					'mdvfrom'=>date('Y-m-d',strtotime($this->input->post('mdvfrom'))) ,
					'mdvto'=>date('Y-m-d',strtotime($this->input->post('mdvto'))) 
					
					);
					
				//	print_r($data);
				//	die;
					
					$this->load->model('healthcenter/discount_model','',TRUE);
					$this->discount_model->manu_dis_insert($data);
					//echo "0";
					
				
					
					//return false;
				
			}
			
			
			
	
	
	
}
?>

