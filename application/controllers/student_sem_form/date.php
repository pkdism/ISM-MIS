<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Date extends MY_Controller
{		
		function __construct()
			{
				parent::__construct(array('deo'));
			}
			
		function index(){
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
				
				if($this->input->post('stdate')){
					
					
					
					$this->form_validation->set_rules('session', 'Session', 'required');
					$this->form_validation->set_rules('stdate', 'Start Date', 'required');
					$this->form_validation->set_rules('eddate', 'End date', 'required');
					$this->form_validation->set_rules('type', 'Type of date', 'required');
					if ($this->form_validation->run() == true){
					$data['opendate'] =  date('Y-m-d',strtotime($this->input->post('stdate')));
					$data['closedate'] = date('Y-m-d',strtotime($this->input->post('eddate'))); 
					$this->updateDate($data);		
					}
				}
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				$data['sdate']=$this->sbasic_model->getOcdate();
				$this->addJS('jquery-ui.js');
				$this->addCSS('jquery-ui.css');
				$this->drawHeader("Fill Semester Registration");
				$this->load->view('student_sem_form/department/setdate',$data);
				$this->drawFooter();
			}
		
		protected function updateDate($data){
				$this->load->model('student_sem_form/sbasic_model','',TRUE);
				if($this->sbasic_model->udate_ocDate($data)){
					$date['date_id'] = 1;
					$date['user_id'] = $this->session->userdata('id');
					$date['type'] = $this->input->post('type');
					$date['session'] = $this->input->post('session');
					$date['seasons'] = $this->input->post('season');
					$date['start_date'] = date('Y-m-d',strtotime($this->input->post('osd')));
					$date['end_date'] = date('Y-m-d',strtotime($this->input->post('ocd')));
					$date['timestamp'] = date('y-m-d H:i:s');
					$date['remark'] = $this->input->post('remark');
					$date['ip'] = $this->input->ip_address();
					$this->sbasic_model->insertDateDes($date);
					//Notification
					$this->load->library('notification');
					$title="Semester Registration Date Open";
					$des="Semester REgistration date open now. Registration Open  from ".date('d/m/Y',strtotime($data['opendate']))." to ".date('d/m/Y',strtotime($data['closedate'])).".";
					//$this->notification->notify('stu',$this->session->userdata('id'),$title,$des,'');
					//End notification///
					 redirect('/student_sem_form/date/success', 'refresh');
					}
			}
			public function success(){
				
				$data['heading']= "The date has been Successfully changed!";
				$data['details']="thank You!";
				$this->drawHeader("Fill Semester Registration");
				$this->load->view('student_sem_form/department/status',$data);
				$this->drawFooter();
				}
				
				public function test(){
				$this->load->model('student_sem_form/get_results','',TRUE);
				echo $this->get_results->getGPAperSemester('2011jr0002',1);
				die();
				}
}