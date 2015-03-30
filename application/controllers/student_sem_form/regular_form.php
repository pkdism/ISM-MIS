<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Regular_form extends MY_Controller {
		private  $img_name;
		private  $img_name1;
		private  $img_carry;
		private $lnid;
		
	function __construct()
	{
		// Call the Model constructor
		parent::__construct(array('stu'));
			//parent::__construct();
			
			//load model;
			$this->load->model('student_sem_form/get_subject','',TRUE);
			$this->load->model('student_sem_form/sbasic_model','',TRUE);	
			$this->addJS("subject_mapping/stu_report_file.js");	
		 
	}
		public function index($id="a12a"){	
			// CHECK Date Open Or Not
			if($this->sbasic_model->checkDate() === false){
				 redirect('/student_sem_form/regular_form/daterror', 'refresh');
				}
				// Get Flag from Database
				$re=$this->sbasic_model->formrResponse($this->session->userdata('id'),($this->session->userdata('semester')+1));
				
				// Auth After Reject Form// 
				if($this->input->post('flg') =="a12a" or $this->input->post('flg') =="" ){
				
				// Compare id form link and database
			if($this->sbasic_model->checkStudent($this->session->userdata('id'),($this->session->userdata('semester')+1))==false && $re[0]->re_id != $id ){
			 redirect('/student_sem_form/regular_form/error', 'refresh');
			}}
			
			//Get Eletive offered by Department 
			$sub=$this->get_subject->getElective($this->session->userdata('course_id'),$this->session->userdata('branch_id'),($this->session->userdata('semester')+1),$this->session->userdata('id'));
			
			// get date Type Normal or With Late Fee
			$dates =$this->sbasic_model->getOcdatedes();
			
			//Validation
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('dateofPayment', 'Date of Payment', 'required');
			$this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
			$this->form_validation->set_rules('transId', 'Transaction id / Reference No.', 'required');
			$this->form_validation->set_rules('slip', 'Slip', 'callback_handle_upload');
			if($dates[0]->type == 2)
			$this->form_validation->set_rules('slip1', 'Slip1', 'callback_handle_upload1');

			//CarrOver Validation
			if($this->input->post('cenable') =='CY'){
				$this->form_validation->set_rules('cdateofPayment', 'Carryover Date of Payment', 'required');
				$this->form_validation->set_rules('camount', 'Carryover Amount', 'required|numeric');
				$this->form_validation->set_rules('ctransId', 'Carryover Transaction id / Reference No.', 'required');
				$this->form_validation->set_rules('cslip', 'cslip', 'callback_handle_upload2');
				$csem=$this->input->post('sem');
				
				//carry Over validation//
				if(is_array($csem)){
					foreach($csem as $cs){
							$this->form_validation->set_rules('csub1-'.$cs, 'Semester '.$cs.' Subject 1 is Required if you dont have Carryover Please Uncheck the Carry Over check box', 'required');
						}
				}
				}
			
			if ($this->form_validation->run() == true){
				
				if($this->fee_save())
					 $this->confirm();
			}else{
			
			$this->drawHeader("Fill Semester Registration");
			$this->load->view('student_sem_form/regular/regular_form',array('subjects'=>$sub['ele'],'dates'=>$dates,'flg'=>$id));
			$this->drawFooter();
			}
		}
		//success//
		public function success(){
			$this->drawHeader("Semester Registration Successful");
			$this->load->view('student_sem_form/regular/success','');
			$this->drawFooter();
		}
		
		//confirm//
		function confirm(){
				$last['lastId']= $this->lnid;
				//Subject
				$sub=$this->get_subject->getSubject($this->session->userdata('course_id'),$this->session->userdata('branch_id'),($this->session->userdata('semester')+1),$this->session->userdata('id'));
				//result
				$this->load->model('student_sem_form/get_results','',TRUE);
						
					//print_r($data['carryover']); die();
				$data=$this->get_subject->getConfirm($this->lnid);
				$data= array_merge($data,$sub);
				$data= array_merge($data,$last);
			
				//carryOver
				$this->load->model('student_sem_form/get_carryover','',TRUE);
				$data['carryover']=$this->get_carryover->getCarryoverByformId($this->lnid); 
				//print_r($data); die();
				$this->drawHeader("Semester Registration Card for REGULAR Student");
				$this->load->view('student_sem_form/regular/confirm',$data);
				$this->drawFooter();
		}
		
		//Fee Details Save//
		protected function fee_save(){
				//Insert Image and Details
				$data['fee_date'] = date('Y-m-d', strtotime($this->input->post('dateofPayment')));
				$data['stu_id'] = $this->session->userdata('id');
				$data['fee_amt'] = $this->input->post('amount');
				$data['transaction_id'] = $this->input->post('transId');
				$data['recipt_path']=$this->img_name;
				$data['late_recipt_path']=$this->img_name1;
				$this->load->model('student_sem_form/add_form','',TRUE);
				
				$this->add_form->insertSemFee($data);
				$this->lnid=$this->db->insert_id();
				$fid=$this->input->post('elvs0');
						$count=$this->input->post('scount');
						$this->load->model('student_sem_form/add_form','',TRUE);
						for($i=0; $i<$count; $i++){
								$data1['sem_form_id'] = $this->lnid;
								$data1['sub_seq'] =$fid;
								$data1['sub_id'] = $this->input->post('ele'.$fid);
								$this->add_form->insertSemSubject($data1);
						$fid++;
						} 
						$this->saveChangeBrachReq();
						$this->saveHornorMinner();
						$this->CarryoverDetailSave();
						return true;
				
					
		}
		
		// Carry Over Details Save//
		protected function CarryoverDetailSave(){
					
					if($this->input->post('cenable')){
							if(is_array($this->input->post('sem'))){
									$this->load->model('student_sem_form/add_form','',TRUE);
									foreach($this->input->post('sem') as $s){
											$data['form_id']=$this->lnid;
											$data['stu_id']=$this->session->userdata('id');
											$data['semester']=$s;
											$data['subject1_id']=$this->input->post('csub1-'.$s);
											$data['subject2_id']=$this->input->post('csub2-'.$s);
											$data['fee_date']=date('Y-m-d', strtotime($this->input->post('cdateofPayment')));
											$data['fee_amt']=$this->input->post('camount');
											$data['fee_slip']=$this->img_carry;
											$data['trans_id']=$this->input->post('ctransId');
											$this->add_form->insertCarryover($data);
										}	
								}
						}
			}
			//Save Honour & Minor if Selected
			protected function saveHornorMinner(){
						$this->load->model('student_sem_form/add_form','',TRUE);
						if($this->input->post('honour')){
							$data['sem_form_id']=$this->lnid;
							$data['subject_id']=$this->input->post('honour');
							$data['type']='h';
							$this->add_form->insertHM($data);
						}
						if($this->input->post('minor')){
							$data['sem_form_id']=$this->lnid;
							$data['subject_id']=$this->input->post('minor');
							$data['type']='m';
							$this->add_form->insertHM($data);
						}
			}
			
			//Save Change Branch Section if Student Want
			protected function saveChangeBrachReq(){
					if($this->input->post('changeB')=='Y'){
						$data['sem_form_id']=$this->lnid;
						$data['department']=$this->input->post('department_name');
						$data['course']=$this->input->post('course');
						$data['branch']=$this->input->post('branch');
						$this->load->model('student_sem_form/add_form','',TRUE);
						$this->add_form->insertCB($data);
					}
			}
		
		
		//Image Upload Validation Handler || Image upload Regular fee//
		function handle_upload()
		  {
			   $config['upload_path']   = './assets/images/semester_reg/sem_slip/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['file_name'] = $this->session->userdata('id')."_".($this->session->userdata('semester')+1);
				$this->load->library('upload', $config);
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
			  $this->form_validation->set_message('handle_upload', "You must upload Fee Receipt!");
			  return false;
			}
		  }
		  
		  //Image Upload Validation Handler || Image upload late Fee//
		function handle_upload1()
		  {
			  	$config['upload_path']   = './assets/images/semester_reg/sem_slip/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['file_name'] = $this->session->userdata('id')."_".($this->session->userdata('semester')+1)."_"."late";
				$this->load->library('upload', $config);
			  
			if (isset($_FILES['slip1']) && !empty($_FILES['slip1']['name']))
			  {

			  if ($this->upload->do_upload('slip1'))
			  {
				// set a $_POST value for 'image' that we can use later
				$upload_data    = $this->upload->data();
				$this->img_name1 = $upload_data['file_name'];
				$_POST['slip1'] = $upload_data['file_name'];
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
			  $this->form_validation->set_message('handle_upload', "You must upload Late fee Receipt!");
			  return false;
			}
		  }
		  
		  //Image Upload Validation Handler || Image upload carryover//
		  function handle_upload2()
		  {
			  	$config['upload_path']   = './assets/images/semester_reg/carryover_slip/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['file_name'] = $this->session->userdata('id')."_carryover_".($this->session->userdata('semester')+1);
				$this->load->library('upload', $config);
			  
			if (isset($_FILES['cslip']) && !empty($_FILES['cslip']['name']))
			  {

			  if ($this->upload->do_upload('cslip'))
			  {
				// set a $_POST value for 'image' that we can use later
				$upload_data   = $this->upload->data();
				$this->img_carry = $upload_data['file_name'];
				$_POST['cslip'] = $upload_data['file_name'];
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
			  $this->form_validation->set_message('handle_upload', "You must upload Late fee Receipt!");
			  return false;
			}
		  }

		  
		 function regular_form_save(){
				//admission_id ,course_id, branch_id,semster,session_year,session,timestamp,status 
				$session = (($this->session->userdata('semester')+1)%2 == 0)?'Winter':'Monsoon';  
				$sem_form['sem_form_id'] 	= $this->input->post('lid');
				$sem_form['admission_id']  	= $this->session->userdata('id');
				$sem_form['course_id']  	= $this->session->userdata('course_id');
				$sem_form['branch_id']  	= $this->session->userdata('branch_id');
				$sem_form['semster']  		= ($this->session->userdata('semester')+1);
				$sem_form['session_year'] 	= date('Y');
				$sem_form['session']  		= $session;
				$sem_form['course_aggr_id'] = 'N/A';
				$sem_form['timestamp']  	= date("Y-m-d H:i:s");
				$sem_form['status'] 		= '0';
				$this->load->model('student_sem_form/add_form','',TRUE);
				$this->add_form->insertSemForm($sem_form);
					 redirect('/student_sem_form/regular_form/success', 'refresh');
	
		}
		
		public function error(){
			$data['status']=$this->sbasic_model->formrResponse($this->session->userdata('id'),($this->session->userdata('semester')+1));
			 $data['oldrecord'] = $this->sbasic_model->getApprovedFormByStudent($this->session->userdata('id'));			
				if(!is_array($data['oldrecord'])){
					$data['oldrecord'] = 0;
					}
			$this->drawHeader("Thanks to fill the Form");
			$this->load->view('student_sem_form/regular/error',$data);
			$this->drawFooter();
		}
		
		public function daterror(){
			$this->drawHeader("Error.");
			$this->load->view('student_sem_form/regular/daterror','');
			$this->drawFooter();
		}
		
// 		public function ids($id=''){
// 					if($id){
// 						echo"this is very Good!";
// 						return false;
// 						}
// 						$this->drawHeader("Error.");
// 						$this->load->view('student_sem_form/free','');
// 						$this->drawFooter();
// 			}
			
	function view($id,$fid){
			
			if(isset($id)){
				
				$this->load->model('student_sem_form/get_subject','',TRUE);
				$this->load->model('student_sem_form/get_results','',TRUE);
				$this->load->model('student_sem_form/get_carryover','',TRUE);
				$data['student']=$this->sbasic_model->hod_view_student($id,$fid);
				$data['subjects']=$this->get_subject->getSubject($data['student'][0]->course_id,$data['student'][0]->branch_id,($data['student'][0]->semester+1),$this->session->userdata('id'));
				$data['carryover']=$this->get_carryover->getCarryoverByformId($data['student'][0]->form_id);
				$data['confirm']=$this->get_subject->getConfirm($data['student'][0]->form_id);
				//Change Branch
				$data['CB']= $this->sbasic_model->getCbByfromId($data['student'][0]->form_id);
				$this->load->view('templates/header_assets');
				$this->load->view('student_sem_form/regular/view.php',$data);
			}
	}
	//Ajax For CarryOver//
	function getAsub($sem,$sid,$depid,$cid,$bid){
		//echo $sem;
		$sd="";
			$this->load->model('student_sem_form/get_subject','',TRUE);
			$data['subjects']=$this->get_subject->getSubject($cid,$bid,$sem,$sid);
				
				if(is_array($data['subjects'])){
					
					$sd.='
					<div id="cesub-'.$sem.'">
					<div class="form-group" >
					<label for="samester-'.$sem.'">Select Carryover First Subject in Semester '.$sem.'</label>
					<select name="csub1-'.$sem.'" class="form-control">';
				foreach($data['subjects'] as $stu){
					$sd.='<option value="">Please Select Subject</option>';
				foreach($stu as $s)
					$sd.='<option value="'.$s['id'].'">'.$s['name'].'('.$s['subject_id'].')</option>';
					}
				$sd.='</select>
				</div>
				<div class="form-group" >
					<label for="samester-'.$sem.'">Select Carryover Second Subject in Semester '.$sem.' (Optional)</label>
					<select name="csub2-'.$sem.'" class="form-control">';
					$sd.='<option value="">Please Select Subject</option>';
				foreach($data['subjects'] as $stu){
				foreach($stu as $s)
					$sd.='<option value="'.$s['id'].'">'.$s['name'].'('.$s['subject_id'].')</option>';
					}
				$sd.='</select>
				</div>
				</div>
				';
				}else{
					$sd = "No Result Found!";
					}
			echo $sd;
		}
		
		//Ajax for Minor & honours//
		function getHonourMinnor(){
					$ms=''; $hs='';
					$h=''; $m='';
				$this->load->model('student_sem_form/get_subject','',TRUE);
					if($this->input->post('id') == 'H' || $this->input->post('id') == 'HM'){
				
							$data=$this->get_subject->getHonourSubject($this->session->userdata('id'),($this->session->userdata('semester')+1));
							if(is_array($data)){
							foreach($data as $val){
								$s= $this->get_subject->getSubjectById($val->id);
								
							  $h .='<option value="'.$val->id.'">'.$s[0]->name.'</option>';
							}
							$hs='<div class="col-sm-4">Select Honour Subject</div><div class="col-sm-8">
											<select name="honour" class="form-control">'.$h.'</select>
									</div>';
							}
					}
					
					if($this->input->post('id') == 'M' || $this->input->post('id') == 'HM'){
					
						$data=$this->get_subject->getMinorSubject($this->session->userdata('id'),($this->session->userdata('semester')+1));
						if(is_array($data)){
						foreach($data as $val){
							$s= $this->get_subject->getSubjectById($val->id);
							$m.='<option value="'.$val->id.'">'.$s[0]->name.'</option>';
						}
						$ms='<div class="col-sm-4">Select Honour Subject</div><div class="col-sm-8">
											<select name="minor" class="form-control">'.$m.'</select>
									</div>';
						}
					}
					
				echo $hs.$ms;
		}
		
	
}
?>

