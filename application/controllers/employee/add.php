<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('est_da1'));
	}

	public function index($error='')
	{
		$this->load->model('employee/emp_current_entry_model','',TRUE);
		$entry=$this->emp_current_entry_model->get_current_entry();
		if($entry === FALSE)
			$this->step(0,'',$error);
		else
			$this->step($entry->curr_step,$entry->id,$error);
	}

	private function step($num = 0,$employee = '',$error = '')
	{
		switch ($num)
		{
			case 0: $this->_add_basic_details($error);break;
			case 1: $this->_add_prev_emp_details($employee,$error);break;
			case 2: $this->_add_family_details($employee,$error);break;
			case 3: $this->_add_education_details($employee,$error);break;
			case 4: $this->_add_last_5yr_stay_details($employee,$error);break;
		}
	}

	private function _add_basic_details($error='')
	{
		// Handling Errors
		$data['error'] = $error;

		// get distinct pay bands
		$this->load->model('Pay_scales_model','',TRUE);
		$this->load->model('indian_states_model','',TRUE);

		$data['pay_bands']=$this->Pay_scales_model->get_pay_bands();
		$data['states']=$this->indian_states_model->getStates();
		//javascript
		$this->addJS('employee/basic_details_script.js');

		//view
		$this->drawHeader("Add Employee Basic Details");
		$this->load->view('employee/add/basic_details',$data);
		$this->drawFooter();
	}

	public function insert_basic_details()
	{
		$emp_id = strtolower($this->input->post('emp_id'));
		$upload = $this->_upload_image($emp_id,'photo');
		if($upload !== FALSE)
		{
			$users = array(
				'id' => $emp_id ,
				'password' => '' ,
				'auth_id' => 'emp' ,
				'created_date' => ''
			);

			$user_details = array(
				'id' => $emp_id ,
				'salutation' => $this->input->post('salutation') ,
				'first_name' => ucwords(strtolower($this->input->post('firstname'))) ,
				'middle_name' => ucwords(strtolower($this->input->post('middlename'))) ,
				'last_name' => ucwords(strtolower($this->input->post('lastname'))) ,
				'sex' => strtolower($this->input->post('sex')) ,
				'category' => $this->input->post('category') ,
				'dob' => date('Y-m-d',strtotime($this->input->post('dob'))) ,
				'email' => $this->input->post('email') ,
				'photopath' => 'employee/'.$emp_id.'/'.$upload['file_name'] ,
				'marital_status' => strtolower($this->input->post('mstatus')) ,
				'physically_challenged' => strtolower($this->input->post('pd')) ,
				'dept_id' => $this->input->post('department')
			);

			$user_other_details = array(
				'id' => $emp_id ,
				'religion' => strtolower($this->input->post('religion')) ,
				'nationality' => strtolower($this->input->post('nationality')) ,
				'kashmiri_immigrant' => $this->input->post('kashmiri') ,
				'hobbies' => strtolower($this->input->post('hobbies')) ,
				'fav_past_time' => strtolower($this->input->post('favpast')) ,
				'birth_place' => strtolower($this->input->post('pob')) ,
				'mobile_no' => $this->input->post('mobile') ,
				'father_name' => ucwords(strtolower($this->input->post('father'))) ,
				'mother_name' => ucwords(strtolower($this->input->post('mother')))
			);

			$dt = DateTime::createFromFormat("d-m-Y", $this->input->post('retire'));
			$emp_basic_details = array(
				'id' => $emp_id ,
				'auth_id' => $this->input->post('tstatus') ,
				'designation' => $this->input->post('designation') ,
				'office_no' => $this->input->post('office') ,
				'fax' => $this->input->post('fax') ,
				'joining_date' => date('Y-m-d',strtotime($this->input->post('entrance_age'))) ,
				'retirement_date' => $dt->format("Y-m-d") ,
				'employment_nature' => strtolower($this->input->post('empnature'))
			);

			if($this->input->post('tstatus') == 'ft')
			{
				$faculty_details = array(
					'id' => $emp_id ,
					'research_interest' => strtolower($this->input->post('research_int'))
				);
			}

			$emp_pay_details = array(
				'id' => $emp_id ,
				'pay_code' => $this->input->post('gradepay') ,
				'basic_pay' => $this->input->post('basicpay')
			);

			$user_address = array(
				array(
					'id' => $emp_id ,
					'line1' => $this->input->post('line11') ,
					'line2' => $this->input->post('line21') ,
					'city' => strtolower($this->input->post('city1')) ,
					'state' => strtolower($this->input->post('state1')) ,
					'pincode' => $this->input->post('pincode1') ,
					'country' => strtolower($this->input->post('country1')) ,
					'contact_no' => $this->input->post('contact11') ,
					'type' => 'present'
				),
				array(
					'id' => $emp_id ,
					'line1' => $this->input->post('line12') ,
					'line2' => $this->input->post('line22') ,
					'city' => strtolower($this->input->post('city2')) ,
					'state' => strtolower($this->input->post('state2')) ,
					'pincode' => $this->input->post('pincode2') ,
					'country' => strtolower($this->input->post('country2')) ,
					'contact_no' => $this->input->post('contact12') ,
					'type' => 'permanent'
				)
			);

			$emp_current_entry = array(
				'id' => $emp_id ,
				'curr_step' => 1
			);

			//loading models

			$this->load->model('employee_model','',TRUE);
			$this->load->model('employee/faculty_details_model','',TRUE);
			$this->load->model('employee/emp_current_entry_model','',TRUE);

			//starting transaction for insertion in database

			$this->db->trans_start();

			$this->users_model->insert($users);

			$this->user_details_model->insert($user_details);
			$this->user_details_model->insertPendingDetails($user_details);

			$this->user_other_details_model->insert($user_other_details);
			$this->user_other_details_model->insertPendingDetails($user_other_details);

			$this->emp_basic_details_model->insert($emp_basic_details);
			$this->emp_basic_details_model->insertPendingDetails($emp_basic_details);

			if($this->input->post('tstatus') == 'ft') {
				$this->faculty_details_model->insert($faculty_details);
				$this->faculty_details_model->insertPendingDetails($faculty_details);
			}

			$this->emp_pay_details_model->insert($emp_pay_details);
			$this->emp_pay_details_model->insertPendingDetails($emp_pay_details);

			$this->user_address_model->insert_batch($user_address);
			$this->user_address_model->insertPendingDetails($user_address);

			$this->emp_current_entry_model->insert($emp_current_entry);

			$this->db->trans_complete();
			//transaction completed

			redirect('employee/add');
		}
	}

	private function _add_prev_emp_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//joining date of the employee
		$this->load->model('employee/emp_basic_details_model','',TRUE);
		$emp_basic_details=$this->emp_basic_details_model->getEmployeeByID($emp_id);
		if($emp_basic_details!==FALSE)
			$data['joining_date']=$emp_basic_details->joining_date;
		else
			$data['joining_date']=FALSE;

		$this->load->model('employee/emp_prev_exp_details_model','',TRUE);
		$data['emp_prev_exp_details'] = $this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id);

		//javascript
		$this->addJS("employee/prev_emp_details_script.js");

		//view
		$this->drawHeader("Add Previous Employment Details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/add/previous_employment_details',$data);
		$this->drawFooter();
	}

	public function insert_prev_emp_details($emp_id = '', $error = '')
	{
		if($emp_id != '')
		{
			if(strtolower(trim($this->input->post('submit')))=='add')
			{
				$this->load->model('employee/emp_prev_exp_details_model','',TRUE);

				if($this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id))
					$sno = count($this->emp_prev_exp_details_model->getEmpPrevExpById($emp_id));
				else $sno = 0;

				$designation = $this->input->post('designation2');
				$from = date('Y-m-d',strtotime($this->input->post('from2')));
				$to = date('Y-m-d',strtotime($this->input->post('to2')));
				$payscale = $this->input->post('payscale2');
				$addr = $this->input->post('addr2');
				$reason = $this->input->post('reason2');

				$emp_prev_exp_details['id'] = $emp_id;
				$emp_prev_exp_details['sno'] = $sno+1;
				$emp_prev_exp_details['designation'] = strtolower($designation);
				$emp_prev_exp_details['from'] = $from;
				$emp_prev_exp_details['to'] = $to;
				$emp_prev_exp_details['pay_scale'] = strtolower($payscale);
				$emp_prev_exp_details['address'] = strtolower($addr);
				$emp_prev_exp_details['remarks'] = strtolower($reason);

				$this->db->trans_start();

				$this->emp_prev_exp_details_model->insert($emp_prev_exp_details);
				$this->emp_prev_exp_details_model->insertPendingDetails($emp_prev_exp_details);

				$this->db->trans_complete();
			}
			else if(strtolower(trim($this->input->post('submit')))=='next')
			{
				$this->load->model('employee/emp_current_entry_model','',TRUE);
				$this->emp_current_entry_model->update(array('curr_step' => 2),array('id' => $emp_id));
			}
			redirect('employee/add');
		}
		else
		{
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';
			$this->index($error);
		}
	}

	private function _add_family_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//javascript
		$this->addJS("employee/family_details_script.js");
		$this->load->model('employee/emp_family_details_model','',TRUE);
		$data['emp_family_details'] = $this->emp_family_details_model->getEmpFamById($emp_id);

		//view
		$this->drawHeader("Add Family Details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/add/family_details',$data);
		$this->drawFooter();
	}

	public function insert_family_details($emp_id = '', $error = '')
	{
		if($emp_id != '') {
			if(strtolower(trim($this->input->post('submit')))=='add') {
				$this->load->model('employee/emp_family_details_model','',TRUE);
				if($this->emp_family_details_model->getEmpFamById($emp_id))
					$sno = count($this->emp_family_details_model->getEmpFamById($emp_id));
				else $sno = 0;

				$upload = $this->_upload_image($emp_id,'photo3',$sno+1);
				if($upload !== FALSE) {

					$name = $this->input->post('name3');
					$relationship = $this->input->post('relationship3');
					$profession = $this->input->post('profession3');
					$addr = $this->input->post('addr3');
					$dob = date('Y-m-d',strtotime($this->input->post('dob3')));
					$active = $this->input->post('active3');

					$emp_family_details['id'] = $emp_id;
					$emp_family_details['sno'] = $sno+1;
					$emp_family_details['name'] = ucwords(strtolower($name));
					$emp_family_details['relationship'] = $relationship;
					$emp_family_details['profession'] = strtolower($profession);
					$emp_family_details['present_post_addr'] = strtolower($addr);
					$emp_family_details['photopath'] = (isset($upload['file_name']))? 'employee/'.$emp_id.'/'.$upload['file_name'] : '';
					$emp_family_details['dob'] = $dob;
					$emp_family_details['active_inactive'] = $active;

					$this->db->trans_start();

					$this->emp_family_details_model->insert($emp_family_details);
					$this->emp_family_details_model->insertPendingDetails($emp_family_details);

					$this->db->trans_complete();
				}
				else return;
			}
			else if(strtolower(trim($this->input->post('submit')))=='next')
			{
				$this->load->model('employee/emp_current_entry_model','',TRUE);
				$this->emp_current_entry_model->update(array('curr_step' => 3),array('id' => $emp_id));
			}
			redirect('employee/add');
		}
		else
		{
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';
			$this->index($error);
		}
	}

	private function _add_education_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//javascript
		$this->addJS("employee/education_details_script.js");

		$this->load->model('employee/emp_education_details_model','',TRUE);
		$data['emp_education_details'] = $this->emp_education_details_model->getEmpEduById($emp_id);

		//view
		$this->drawHeader("Add Education Qualifications","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/add/educational_details',$data);
		$this->drawFooter();
	}

	public function insert_education_details($emp_id = '', $error = '')
	{
		if($emp_id != '') {
			if(strtolower(trim($this->input->post('submit')))=='add') {
				$this->load->model('employee/emp_education_details_model','',TRUE);
				if($this->emp_education_details_model->getEmpEduById($emp_id))
					$sno = count($this->emp_education_details_model->getEmpEduById($emp_id));
				else $sno = 0;

				$exam = $this->input->post('exam4');
				$branch = $this->input->post('branch4');
				$clgname = $this->input->post('clgname4');
				$year = $this->input->post('year4');
				$grade = $this->input->post('grade4');
				$div = $this->input->post('div4');

				$emp_education_details['id'] = $emp_id;
				$emp_education_details['sno'] = $sno+1;
				$emp_education_details['exam'] = strtolower($exam);
				$emp_education_details['branch'] = strtolower($branch);
				$emp_education_details['institute'] = strtolower($clgname);
				$emp_education_details['year'] = $year;
				$emp_education_details['grade'] = strtolower($grade);
				$emp_education_details['division'] = strtolower($div);

				$this->db->trans_start();

				$this->emp_education_details_model->insert($emp_education_details);
				$this->emp_education_details_model->insertPendingDetails($emp_education_details);

				$this->db->trans_complete();
			}
			else if(strtolower(trim($this->input->post('submit')))=='next') {
				$this->load->model('employee/emp_current_entry_model','',TRUE);
				$this->emp_current_entry_model->update(array('curr_step' => 4),array('id' => $emp_id));
			}
			redirect('employee/add');
		}
		else
		{
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';
			$this->index($error);
		}
	}

	private function _add_last_5yr_stay_details($emp_id = '', $error = '')
	{
		$data['error'] = $error;	// Handling Errors
		$data['add_emp_id'] = $emp_id;

		//javascript
		$this->addJS("employee/last_5yr_stay_details_script.js");

		$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
		$data['emp_last5yrstay_details'] = $this->emp_last5yrstay_details_model->getEmpStayById($emp_id);

		//view
		$this->drawHeader("Add last 5 year stay details","<h4><b>Employee Id </b>< ".$emp_id.' ></h4>');
		$this->load->view('employee/add/last_five_year_stay_details',$data);
		$this->drawFooter();
	}

	public function insert_last_5yr_stay_details($emp_id = '', $error = '')
	{
		if($emp_id != '') {
			if(strtolower(trim($this->input->post('submit')))=='add') {
				$this->load->model('employee/emp_last5yrstay_details_model','',TRUE);
				if($this->emp_last5yrstay_details_model->getEmpStayById($emp_id))
					$sno = count($this->emp_last5yrstay_details_model->getEmpStayById($emp_id));
				else $sno = 0;

				$from = $this->input->post('from5');
				$to = $this->input->post('to5');
				$addr = $this->input->post('addr5');
				$district = $this->input->post('dist5');

				$emp_last5yrstay_details['id'] = $emp_id;
				$emp_last5yrstay_details['sno'] = $sno+1;
				$emp_last5yrstay_details['from'] = date('Y-m-d',strtotime($from));
				$emp_last5yrstay_details['to'] = date('Y-m-d',strtotime($to));
				$emp_last5yrstay_details['res_addr'] = $addr;
				$emp_last5yrstay_details['dist_hq_name'] = strtolower($district);

				$this->db->trans_start();

				$this->emp_last5yrstay_details_model->insert($emp_last5yrstay_details);
				$this->emp_last5yrstay_details_model->insertPendingDetails($emp_last5yrstay_details);

				$this->db->trans_complete();
			}
			else if(strtolower(trim($this->input->post('submit')))=='next') {
				//loading models
				$this->load->model('employee_model','',TRUE);
				$this->load->model('employee/emp_validation_details_model','',TRUE);
				$this->load->model('user/user_auth_types_model','',TRUE);
				$this->load->model('employee/emp_current_entry_model','',TRUE);

				$date = date("Y-m-d H:i:s",time());

				//starting transaction for insertion in database
				$this->db->trans_start();

				$res = $this->user_auth_types_model->getUserIdByAuthId('est_ar');
				if(!$res)
				{
					//if there is no nodal officer i.e est_ar then who will provide validation for default the details are approved and password is set as p.
					$pass='p';
					$encode_pass=$this->authorization->strclean($pass);
					$encode_pass=$this->authorization->encode_password($encode_pass,$date);
					$this->users_model->update(array('password' => $encode_pass, 'created_date' => $date), array('id' => $emp_id));
					$this->session->set_flashdata('flashError','Employee \''.$emp_id.'\' successfully created with password \''.$pass.'\' and was not sent for validation. There is no nodal officer with auth id \'est_ar\'.');
				}
				else
				{
					//notify nodal officers for vaidation.
					$emp_name = $this->user_model->getNameById($emp_id);
					foreach($res as $row)
						$this->notification->notify($row->id, 'est_ar', "Validation Request", "Please validate ".$emp_name." details", "employee/validation/validate_step/".$emp_id);

					//set status of all forms as pending
					$this->emp_validation_details_model->insert(array(	'id'=>$emp_id,
																		'profile_pic_status'=> 'pending',
																		'basic_details_status'=> 'pending',
																		'prev_exp_status'=> 'pending',
																		'family_details_status'=> 'pending',
																		'educational_status'=> 'pending',
																		'stay_status'=> 'pending',
																		'created_date'=> $date));

					$this->session->set_flashdata('flashSuccess','Employee \''.$emp_id.'\' successfully created and sent for validation.');
				}

				$this->emp_current_entry_model->delete(array('id' => $emp_id));

				$this->db->trans_complete();
				//transaction completed

			}
			redirect('employee/add');
		}
		else
		{
			$error = 'ERROR : No employee id selected. You are not supposed to be here.';
			$this->index($error);
		}
	}

	private function _upload_image($emp_id = '', $name ='', $n_family = FALSE)
	{
		$config['upload_path'] = 'assets/images/employee/'.strtolower($emp_id).'/';
		$config['allowed_types'] = 'jpeg|jpg|png';
		$config['max_size']  = '200';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		if(isset($_FILES[$name]['name']))
    	{
            if($_FILES[$name]['name'] == "")
        		$filename = "";
            else
			{
                $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                if(!$n_family)
                	$filename='emp_'.$emp_id.'_'.date('YmdHis').$ext;
                else
                	$filename='emp_'.$emp_id.'_fam_'.$n_family.date('YmdHis').$ext;
            }
        }
        else
        {
        	$this->index('ERROR: File Name not set.');
			return FALSE;
        }

		$config['file_name'] = $filename;
		//$this->load->view('welcome_message',array('d'=>array('photo_image'=>$_FILES,'config'=>$config)));
		//return FALSE;

		if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
		{
			$error = $this->upload->display_errors();
			$this->index('ERROR: '.$error);
			return FALSE;
		}
		else
		{
			$upload_data = $this->upload->data();	//single upload for both user and fasmily
			return $upload_data;
		}
	}
}
/* End of file add.php */
/* Location: mis/application/controllers/employee/add.php */