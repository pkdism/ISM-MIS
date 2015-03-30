<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_finyear extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','deo'));
				$this->load->helper(array('form', 'url'));
				$this->load->library('form_validation');
		
	}
		
			public function index()
			{
					
			
					$this->drawHeader("Health Center");
					$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/add_finyear');
					$this->drawFooter();
				
			}
			function check_fyear_availablity($str)
			{
				//print_r($str);
				//die;
				
				if($str=='0')
				{
					$this->form_validation->set_message('check_fyear_availablity', 'Please Select Financial Year');
				return FALSE;
				}
				/*else if(!is_numeric($str))
				{
					$this->form_validation->set_message('check_fyear_availablity', 'Financial Year Must be in Numeric');
				return FALSE;
				}*/
				else 
				{
					$this->load->model('healthcenter/fy_model','',TRUE);
					$get_result = $this->fy_model->check_fyear_availablity($str);
					
					if($get_result )
					{
						
					$this->form_validation->set_message('check_fyear_availablity', 'Financial Year Already Exits');
					return FALSE;
					}
					else
					{
						return true;
					}
				}
				
			}
	public function insert()
	{
		//$timestamp = date('Y-m-d H:i:s');
				
				$this->form_validation->set_rules('fyear', 'Financial Year','callback_check_fyear_availablity');
				$this->form_validation->set_rules('budget', 'Budget', 'required|numeric');
				
				if($this->form_validation->run()==FALSE)
				{
					$error = validation_errors();
					echo $error;
					//return false;
				}else{				
					$data = array(
						'curr_fin_year' => $this->input->post('fyear'),
						'budget' => $this->input->post('budget'),
						'b_groupA'=>($this->input->post('budget')*0.70),
						'b_groupB'=>($this->input->post('budget')*0.30),
						'bud_date'=>date('Y-m-d',strtotime($this->input->post('b_date'))) ,
					);
					
					$this->load->model('healthcenter/fy_model','',TRUE);
					$lid=$this->fy_model->insert($data);
					if(isset($lid)){
							$r=$this->fy_model->getFYById($lid,1);
							foreach($r as $re)
							{
							$re["bud_date"]=date("d M Y",strtotime($re["bud_date"]));
							
							echo json_encode($re);
							}
					}
				}			
					
	}
	
	
	public function budget_delete($id)
	{
			
		$this->load->model('healthcenter/fy_model','',TRUE);
		$this->fy_model->delete_budget($id);
	}
	public function budget_show($id)
	{
	
		$this->load->model('healthcenter/fy_model','',TRUE);
        $data['budget_show'] = $this->fy_model->show_budget_id($id);
			//$this->drawHeader("Health Center");
					//$this->load->view('healthcenter/hmenu');
					$this->load->view('healthcenter/update_view', $data);
				//	$this->drawFooter();
		 
	}
	public function update_budget()
	{
				
      $id= $this->input->post('budid');
	   $data = array(
				
           'budget' => $this->input->post('fbudget'),
            'b_groupA' => $this->input->post('gabud'),
            'b_groupB' => $this->input->post('gbbud')
           
        );
		
					$this->load->model('healthcenter/fy_model','',TRUE);
					$this->fy_model->update_budget($id,$data);
				
				
					redirect('healthcenter/view_finyear', 'refresh');
					
				
	}
	
	
	
	
	
	
}
?>

