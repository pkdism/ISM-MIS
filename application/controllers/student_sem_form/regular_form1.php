<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regular_form extends MY_Controller {
		private  $img_name;
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct(array('stu'));
		// parent::__construct();
			$config['upload_path']   = './assets/sem_slip/';
			$config['allowed_types'] = 'pdf|jpg|png|jpeg';
			$config['file_name'] = $this->session->userdata('id').'_'.$this->session->userdata('course_id').'_'.$this->session->userdata('branch_id')."_".($this->session->userdata('semester')+1);
			$this->load->library('upload', $config);
			//load model;
			$this->load->model('student_sem_form/get_subject','',TRUE);
		 
	}
		public function index(){		
			$this->load->model('student_sem_form/basic_model','',TRUE);
			if($this->basic_model->checkStudent($this->session->userdata('id'),($this->session->userdata('semester')+1))==false){
			 redirect('/student_sem_form/regular_form/error', 'refresh');
			}		
			$sub=$this->get_subject->getSubject($this->session->userdata('course_id'),$this->session->userdata('branch_id'),($this->session->userdata('semester')+1));
			
			//Validation
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dateofPayment', 'Date of Payment', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('transId', 'Transaction id / Reference No.', 'required');
			$this->form_validation->set_rules('slip', 'Slip', 'callback_handle_upload');
			
			if ($this->form_validation->run() == true){
				
				if($this->regular_form_save())
					 redirect('/student_sem_form/regular_form/success', 'refresh');
			}else{
			$this->drawHeader("Fill Semester Registration");
			$this->load->view('student_sem_form/regular/regular_form',array('subjects'=>$sub['subjects'],'aid'=>$sub['aid'][0]['aggr_id']));
			$this->drawFooter();
			}
			//echo 'thik hai!';
						
		}
		
		public function success(){
			$this->drawHeader("Semester Registration Successful");
			$this->load->view('student_sem_form/regular/success','');
			$this->drawFooter();
		}
		public function error(){
			$this->drawHeader("Error.");
			$this->load->view('student_sem_form/regular/error','');
			$this->drawFooter();
		}
		//form regular_form submit  
		protected function regular_form_save(){
				//admission_id ,course_id, branch_id,semster,session_year,session,timestamp,status 
				$session = (($this->session->userdata('semester')+1)%2 == 0)?'Winter':'Monsoon';  
				$sem_form['admission_id']  	= $this->session->userdata('id');
				$sem_form['course_id']  	= $this->session->userdata('course_id');
				$sem_form['branch_id']  	= $this->session->userdata('branch_id');
				$sem_form['semster']  		= ($this->session->userdata('semester')+1);
				$sem_form['session_year'] 	= date('Y');
				$sem_form['session']  		= $session;
				$sem_form['course_aggr_id'] = $this->input->post('aggr_id');
				$sem_form['timestamp']  	= date("Y-m-d H:i:s");
				$sem_form['status'] 		= '0';
				$this->load->model('student_sem_form/add_form','',TRUE);
				$this->add_form->insertSemForm($sem_form);
				// Last Insert Id////
				$this->fee_save($this->db->insert_id());
				return true;
		}
		
		
		//Fee Details Save//
		protected function fee_save($form_id){
				//Insert Image and Details
				$data['fee_date'] = $this->input->post('dateofPayment');
				$data['fee_amt'] = $this->input->post('amount');
				$data['transaction_id'] = $this->input->post('transId');
				$data['form_id'] =$form_id;
				$data['recipt_path']=$this->img_name;
				$this->load->model('student_sem_form/add_form','',TRUE);
				
				if($this->add_form->insertSemFee($data))
				return true;		
		}
		//Image Upload Validation Handler || Image upload//
		function handle_upload()
		  {
			if (isset($_FILES['slip']) && !empty($_FILES['slip']['name']))
			  {

			  if ($this->upload->do_upload('slip'))
			  {
				// set a $_POST value for 'image' that we can use later
				$upload_data    = $this->upload->data();
				$this->img_name = $upload_data['file_name'];
				$_POST['slip'] = $upload_data['file_name'];
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
			  $this->form_validation->set_message('handle_upload', "You must upload an image!");
			  return false;
			}
		  }
		
		
		
}
?>
