<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_medicine_receive extends MY_Controller
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
		$this->addJS('healthcenter/health.js');
		//$this->load->helper(array('healthcenter/add_finyear', 'url'));

		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
				
		if ($this->form_validation->run() == TRUE)
		{
			//$this->show_medicine();
			
		}
		else
		{
			//$data = array();
			$this->load->model('healthcenter/Medicine_model','',TRUE);
			$data['po_list'] = $this->Medicine_model->get_po_indent();
			$data['po_list1'] = $this->Medicine_model->get_po_outdated();
			
			
			$this->drawHeader("Health Center");
			$this->load->view('healthcenter/hmenu');
			$this->load->view('healthcenter/add_medicine_receive',$data);
			$this->drawFooter();
			
			
			/*$this->drawHeader("Health Center");
			$this->load->view('healthcenter/add_medicine_purchase');
			$this->drawFooter();*/
		}
	
	
	
	
	
	}
	public function show_medicine()
	{
		$po=array();
		$po_id = $this->input->post('po_id');
			
		$this->load->model('healthcenter/Medicine_model','',TRUE);
		$r=$this->Medicine_model->get_medi_list($po_id,1);
		$po=$this->Medicine_model->getMqtybyPo($po_id,1);
		 if(!empty($po)){
			 //print_r($r);
			 //echo "<br>";
			// print_r($po);
			 $i=0;
			foreach($r as $p){
						foreach($po as $j){
							if($p['m_id'] == $j['m_id']){
									$r[$i]['ind_qty'] = $r[$i]['ind_qty'] - $j['mrec_qty'];
							}
						}
						$i++;
			}
		 }
		
			if(isset($r)){
			
				echo json_encode($r);
			}
			
	}
	public function medi_receive()
	{
		foreach($_POST as $key => $val){
					if(!$val){
						echo $key;
						return false;
					}
		}
		$this->load->model('healthcenter/Medicine_model','',TRUE);
		$this->Medicine_model->insertMedR($_POST);
		echo "0";
		return false;
	}
	
	
}
?>