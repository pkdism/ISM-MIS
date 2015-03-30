<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rc_by_supp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				
		
	}
		
			public function index()
			{
					
					$this->load->model('healthcenter/Supplier_medicine_mapping_model','',TRUE);
					$data['supp_list'] = $this->Supplier_medicine_mapping_model->get_supplier_list();
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/rc_by_supp',$data);
					
					$this->drawFooter();
				
			}
			public function show_manu()
			{
				 $id_supp = $this->input->post('id'); 
				$this->load->model('healthcenter/supplier_model','',TRUE);					
				$data['manu_nm'] =$this->supplier_model->get_Manu_by_suppID($id_supp);
				//$data['supp_nm'] =$this->medicine_model->get_supplier_bymedicineid($id_supp);
										
				echo json_encode($data);
			}
			
			function insert()
			{
				$data = array(
					's_id'=> $this->input->post('s_id'),
					'manu_id' => $this->input->post('manu_id'),
					'm_id'=>$this->input->post('m_id'),
					'sdis'=>$this->input->post('sdis'),
					'sdvfrom'=>date('Y-m-d',strtotime($this->input->post('sdvfrom'))) ,
					'sdvto'=>date('Y-m-d',strtotime($this->input->post('sdvto'))) 
					
					);
					;
					$this->load->model('healthcenter/discount_model','',TRUE);
					$this->discount_model->supp_dis_insert($data);
					echo "0";
					//return false;
				
			}
			
	
	
	
}
?>

