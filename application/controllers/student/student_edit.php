<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deos'));
	}

	function index($error = '')
	{
		$this->addJS('student/edit_student_details_script.js');
		$data['error'] = $error;
		$this->drawHeader('Edit Student Details');
		$this->load->view('student/edit/student_edit_detail_index',$data);
		$this->drawFooter();
		//$this->select_form($error);
	}

	/*function select_form($error = '')
	{
	}

	function select_details_to_edit()
	{
		$form = $this->input->post('select_form');
		$stu_id = $this->input->post('stu_id');
		switch($form)
		{
			case 0: $this->edit_profile_pic($stu_id);break;
			case 1:	$this->edit_basic_details($stu_id);break;
			case 2: $this->edit_education_details($stu_id);break;
		}
	}*/

	function edit_all_details()
	{
		$form = $this->input->post('select_form');
		$stu_id = $this->input->post('stu_id');

		$this->open_edit_form($stu_id);

	}

	function open_edit_form($stu_id)
	{
		$this->addJS("student/edit_all_details_script.js");

		//For Image details
		$this->load->model('user/user_details_model','',TRUE);
		$res=$this->user_details_model->getUserById($stu_id);
		$data['photopath'] = ($res == FALSE)?	FALSE:$res->photopath;
		$data['stu_id']=$stu_id;

		//For Details
		$this->load->model('course_structure/basic_model','',TRUE);
		$data['academic_departments']=$this->basic_model->get_depts();

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('indian_states_model','',TRUE);

		$data['states']=$this->indian_states_model->getStates();
		$data['user_details']=$this->user_details_model->getUserById($stu_id);
		$data['user_other_details']=$this->user_other_details_model->getUserById($stu_id);
		$data['stu_basic_details']=$this->student_details_model->get_student_details_by_id($stu_id);
		$data['stu_other_details']=$this->student_other_details_model->get_student_other_details_by_id($stu_id);
		$data['stu_fee_details']=$this->student_fee_details_model->get_stu_fee_details_by_id($stu_id);
		$data['stu_academic_details']=$this->student_academic_model->get_stu_academic_details_by_id($stu_id);
		$data['permanent_address']=$this->user_address_model->getAddrById($stu_id,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($stu_id,'present');
		$data['correspondence_address']=$this->user_address_model->getAddrById($stu_id,'correspondence');

		$depts = $data['user_details'];
		$data['courses']=$this->basic_model->get_course_offered_by_dept_for_student_reg($depts->dept_id);

		$course = $data['stu_academic_details'];
		if($course)
			$data['branches'] = $this->basic_model->get_branches_by_course_and_dept_for_student_reg($course->course_id,$depts->dept_id);
		else
		{
			$data['courses'] = FALSE;
			$data['branches'] = FALSE;
		}

		//For Educational details
		$this->load->model('student/student_education_details_model','',TRUE);
		$data['stu_education_details'] = $this->student_education_details_model->getStuEduById($stu_id);

		$this->load->model('student/student_rejected_detail_model','',TRUE);
		$head_data['data_recv'] = $this->student_rejected_detail_model->get_stu_status_details_by_id($stu_id);
		$head_data['data_recv'] = $head_data['data_recv'];

		$this->drawHeader('Edit Details of Student '.$stu_id);
		/*$this->load->view('student/edit/profile_pic',$data);
		$this->load->view('student/edit/student_edit_basic_details',$data);
		$this->load->view('student/edit/educational_details',$data);*/
		$this->load->view('student/edit/reject_reason',$head_data);
		$this->load->view('student/edit/student_edit_all_details',$data);
		$this->drawFooter();
	}

	function update_all_details($stu_id)
	{
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('student/student_education_details_model','',TRUE);

		$user_details=$this->user_details_model->getUserById($stu_id);
		$user_other_details=$this->user_other_details_model->getUserById($stu_id);
		$stu_basic_details=$this->student_details_model->get_student_details_by_id($stu_id);
		$stu_other_details=$this->student_other_details_model->get_student_other_details_by_id($stu_id);
		$stu_fee_details=$this->student_fee_details_model->get_stu_fee_details_by_id($stu_id);
		$stu_academic_details=$this->student_academic_model->get_stu_academic_details_by_id($stu_id);
		$permanent_address=$this->user_address_model->getAddrById($stu_id,'permanent');
		$present_address=$this->user_address_model->getAddrById($stu_id,'present');
		$correspondence_address=$this->user_address_model->getAddrById($stu_id,'correspondence');
		$stu_education_details=$this->student_education_details_model->getStuEduById($stu_id);

			if($this->input->post('depends_on'))
			{
				$father_name = '';
				$mother_name = '';
				$father_occupation = '';
				$mother_occupation = '';
				$father_income = '';
				$mother_income = '';
				$guardian_name = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_name'))));
				$guardian_relation = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_relation_name'))));
			}
			else
			{
				$father_name = ucwords(strtolower($this->authorization->strclean($this->input->post('father_name'))));
				$mother_name = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_name'))));
				$father_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('father_occupation'))));
				$mother_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_occupation'))));
				$father_income = $this->input->post('father_gross_income');
				$mother_income = $this->input->post('mother_gross_income');
				$guardian_name = '';
				$guardian_relation = '';
			}

		$details_modified = '';

		$details_modified_array = array();

		if($user_details->salutation != $this->input->post('salutation'))
			$details_modified_array[] = 'Salutation';
		if($user_details->first_name != $this->input->post('firstname'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'First Name';
		}
		if($user_details->middle_name != $this->input->post('middlename'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Middle Name';
		}
		if($user_details->last_name != $this->input->post('lastname'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Last Name';
		}
		if($stu_basic_details->name_in_hindi != $this->input->post('stud_name_hindi'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Name in Hindi';
		}
		if($user_details->sex != $this->input->post('sex'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Gender';
		}
		if($user_details->dob != date('Y-m-d',strtotime($this->input->post('dob'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Date of Birth';
		}
		if($user_other_details->birth_place != $this->input->post('pob'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Place of Birth';
		}
		if($user_details->physically_challenged != $this->input->post('pd'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Physically Challenged';
		}
		if($stu_basic_details->blood_group != $this->input->post('blood_group'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Blood Group';
		}
		if($user_other_details->kashmiri_immigrant != $this->input->post('kashmiri'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Kashmiri Immigrant';
		}
		if($user_details->marital_status != $this->input->post('mstatus'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Marital Status';
		}
		if($user_details->category != $this->input->post('category'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Category';
		}
		if($user_other_details->religion != strtolower($this->input->post('religion')))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Religion';
		}
		if($user_other_details->nationality != $this->input->post('nationality'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Nationality';
		}
		if($stu_other_details->aadhaar_card_no != $this->input->post('aadhaar_no'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Aadhaar Card No.';
		}
		if($stu_basic_details->identification_mark != $this->input->post('identification_mark'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Identification Mark';
		}
		if(ucwords(strtolower($user_other_details->father_name)) != ucwords(strtolower($this->input->post('father_name'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Father\'s Name' ;
		}
		if(ucwords(strtolower($user_other_details->mother_name)) != ucwords(strtolower($this->input->post('mother_name'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Mother\'s Name';
		}
		if(ucwords(strtolower($stu_other_details->fathers_occupation)) != ucwords(strtolower($this->input->post('father_occupation'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Father\'s Occupation';
		}
		if(ucwords(strtolower($stu_other_details->mothers_occupation)) != ucwords(strtolower($this->input->post('mother_occupation'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Mother\'s Occupation';
		}
		if($stu_other_details->fathers_annual_income != $this->input->post('father_gross_income'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Father\'s Gross Income';
		}
		if($stu_other_details->mothers_annual_income != $this->input->post('mother_gross_income'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Mother\'s Gross Income';
		}
		if(ucwords(strtolower($stu_other_details->guardian_name)) != ucwords(strtolower($this->input->post('guardian_name'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Guardian\'s Name';
		}
		if(ucwords(strtolower($stu_other_details->guardian_relation)) != ucwords(strtolower($this->input->post('guardian_relation_name'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Guardian\'s Relation';
		}
		if($stu_basic_details->parent_mobile_no != $this->input->post('parent_mobile'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Parent/Guardian Mobile No.';
		}
		if($stu_basic_details->parent_landline_no == '0')
			$parent_landline_number = '';
		else
			$parent_landline_number = $stu_basic_details->parent_landline_no;
		if($parent_landline_number != $this->input->post('parent_landline'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Parent/Guardian Mobile No.';
		}
		if($stu_basic_details->migration_cert != $this->input->post('migration_cert'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Migration Certificate No.';
		}
		if($stu_basic_details->enrollment_no != $this->input->post('roll_no'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Roll No.';
		}
		if($stu_basic_details->admn_date != date('Y-m-d',strtotime($this->input->post('entrance_date'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Date of Admission';
		}
		if($this->input->post('admn_based_on') == 'others')
		{
			if($stu_academic_details->admn_based_on != $this->input->post('mode_of_admission'))
			{
				$details_modified_array = array_values($details_modified_array);
				$details_modified_array[] = 'Admission Based On';
			}
		}
		else
		{
			if($stu_academic_details->admn_based_on != $this->input->post('admn_based_on'))
			{
				$details_modified_array = array_values($details_modified_array);
				$details_modified_array[] = 'Admission Based On';
			}
		}
		if($stu_academic_details->iit_jee_rank != $this->input->post('iitjee_rank'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'IIT JEE Rank';
		}
		if($stu_academic_details->iit_jee_cat_rank != $this->input->post('iitjee_cat_rank'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'IIT JEE Category Rank';
		}
		if($stu_academic_details->cat_score != $this->input->post('cat_score'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Cat Score';
		}
		if($stu_academic_details->gate_score != $this->input->post('gate_score'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Gate Score';
		}
		if($stu_academic_details->auth_id != $this->input->post('stu_type'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Student Type';
		}
		if($stu_academic_details->semester != $this->input->post('semester'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Semester';
		}
		if($user_details->dept_id != $this->input->post('department'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Department';
		}
		if($stu_academic_details->course_id != $this->input->post('course'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Course';
		}
		if($stu_academic_details->branch_id != $this->input->post('branch'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Branch';
		}
		if($stu_other_details->bank_name != $this->input->post('bank_name'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Bank Name';
		}
		if($stu_other_details->account_no != $this->input->post('bank_account_no'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Bank Account No.';
		}
		if($stu_fee_details->fee_mode != $this->input->post('fee_paid_mode'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Fee Payment Mode';
		}
		if($stu_fee_details->payment_made_on != date('Y-m-d',strtotime($this->input->post('fee_paid_date'))))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Fee Paid Date';
		}
		if($stu_fee_details->transaction_id != $this->input->post('fee_paid_dd_chk_onlinetransaction_cashreceipt_no'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Fee Transaction Id';
		}
		if($stu_fee_details->fee_amount == '0')
			$fee_amt = '';
		else
			$fee_amt = $stu_fee_details->fee_amount;
		if($fee_amt != $this->input->post('fee_paid_amount'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Fee Amount Paid';
		}
		if($present_address->line1 != $this->input->post('line11')||$present_address->line2 != $this->input->post('line21')||$present_address->city != $this->input->post('city1')||$present_address->state != $this->input->post('state1')||$present_address->pincode != $this->input->post('pincode1')||$present_address->country != $this->input->post('country1')||$present_address->contact_no != $this->input->post('contact1'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Detail of Present Addr';
		}
		if($permanent_address->line1 != $this->input->post('line12')||$permanent_address->line2 != $this->input->post('line22')||$permanent_address->city != $this->input->post('city2')||$permanent_address->state != $this->input->post('state2')||$permanent_address->pincode != $this->input->post('pincode2')||$permanent_address->country != $this->input->post('country2')||$permanent_address->contact_no != $this->input->post('contact2'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Detail of Permanent Addr';
		}
		if($correspondence_address)
		{
			if($correspondence_address->line1 != $this->input->post('line13')||$correspondence_address->line2 != $this->input->post('line23')||$correspondence_address->city != $this->input->post('city3')||$correspondence_address->state != $this->input->post('state3')||$permanent_address->pincode != $this->input->post('pincode3')||$correspondence_address->country != $this->input->post('country3')||$correspondence_address->contact_no != $this->input->post('contact3'))
			{
				$details_modified_array = array_values($details_modified_array);
				$details_modified_array[] = 'Detail of Correspondence Addr';
			}
		}
		else if($this->input->post('line13') != '')
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Detail of Correspondence Addr';
		}

		$exam = $this->input->post('exam4');
		$branch = $this->input->post('branch4');
		$clgname = $this->input->post('clgname4');
		$year = $this->input->post('year4');
		$grade = $this->input->post('grade4');
		$div = $this->input->post('div4');

		$n = count($clgname);
		$i = 0;
		$class = '10';
		while($i<2)
		{
			$stu_education_detail[$i]['id'] = $stu_id;
			$stu_education_detail[$i]['sno'] = $i+1;
			$stu_education_detail[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
			$stu_education_detail[$i]['branch'] = $class;
			$stu_education_detail[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
			$stu_education_detail[$i]['year'] = $year[$i];
			$stu_education_detail[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
			$stu_education_detail[$i]['division'] = strtolower($div[$i]);
			$class = '12';
			$i++;
		}
		while($i<$n)
		{
			$stu_education_detail[$i]['id'] = $stu_id;
			$stu_education_detail[$i]['sno'] = $i+1;
			$stu_education_detail[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
			$stu_education_detail[$i]['branch'] = strtolower($this->authorization->strclean($branch[$i]));
			$stu_education_detail[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
			$stu_education_detail[$i]['year'] = $year[$i];
			$stu_education_detail[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
			$stu_education_detail[$i]['division'] = strtolower($div[$i]);
			$i++;
		}
		$edu_detail_count = count($stu_education_details);
		if($edu_detail_count != $n)
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Educational Details';
		}
		else
		{
			$i = 0;
			while($i < $n)
			{
				if($stu_education_detail[$i]['exam'] != strtolower($stu_education_details[$i]->exam) || $stu_education_detail[$i]['branch'] != strtolower($stu_education_details[$i]->branch) || $stu_education_detail[$i]['institute'] != strtolower($stu_education_details[$i]->institute) || $stu_education_detail[$i]['year'] != $stu_education_details[$i]->year || $stu_education_detail[$i]['grade'] != strtolower($stu_education_details[$i]->grade) || $stu_education_detail[$i]['division'] != strtolower($stu_education_details[$i]->division))
				{
					$details_modified_array = array_values($details_modified_array);
					$details_modified_array[] = 'Educational Details';
					break;
				}
				$i++;
			}
		}

		if($user_details->email != $this->input->post('email'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Email Id';
		}
		if($stu_basic_details->alternate_email_id != $this->input->post('alternate_email_id'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Alternate Email Id';
		}
		if($user_other_details->mobile_no != $this->input->post('mobile'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Mobile No.';
		}
		if($stu_basic_details->alternate_mobile_no == '0')
			$alternate_mobile_number = '';
		else
			$alternate_mobile_number = $stu_basic_details->alternate_mobile_no;
		if($alternate_mobile_number != $this->input->post('alternate_mobile'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Alternate Mobile No.';
		}
		if($user_other_details->hobbies != $this->input->post('hobbies'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Hobbies';
		}
		if($user_other_details->fav_past_time != $this->input->post('favpast'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Favourite Pass Time';
		}
		if($stu_other_details->extra_curricular_activity != $this->input->post('extra_activity'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Extra-Curricular Activities';
		}
		if($stu_other_details->other_relevant_info != $this->input->post('any_other_information'))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Any other relevant information';
		}

		/*if($this->input->post('photo'))
		{
			var_dump('image');
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = 'Photo';*/
			$upload = $this->upload_image($stu_id,'photo');
			if($upload == FALSE)
			{
				/*var_dump('no image');
				$this->session->set_flashdata('flashError','Student '.$stu_id.' image upload failed.');
				redirect("");*/
				$image_path = $user_details->photopath;
			}
			else
			{
				//var_dump('image');
				$image_path = 'student/'.$stu_id.'/'.$upload['file_name'];
				$details_modified_array = array_values($details_modified_array);
				$details_modified_array[] = 'Photo';
			}
		/*}
		else
		{
			var_dump('no image');
			$image_path = $user_details->photopath;
		}*/

		//var_dump($this->input->post('photo'));

			//.var_dump($upload);return;
			$date = date("Y-m-d H:i:s",time());

			$user_details = array(
				'id' => $stu_id ,
				'salutation' => $this->input->post('salutation') ,
				'first_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('firstname')))) ,
				'middle_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('middlename')))) ,
				'last_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('lastname')))) ,
				'sex' => $this->input->post('sex') ,
				'category' => $this->input->post('category') ,
				'dob' => date('Y-m-d',strtotime($this->input->post('dob'))) ,
				'email' => $this->authorization->strclean($this->input->post('email')) ,
				'photopath' => $image_path ,
				'marital_status' => $this->input->post('mstatus') ,
				'physically_challenged' => $this->input->post('pd') ,
				'dept_id' => $this->input->post('department')
			);

			$user_other_details = array(
				'id' => $stu_id ,
				'religion' => strtolower($this->input->post('religion')) ,
				'nationality' => strtolower($this->authorization->strclean($this->input->post('nationality'))) ,
				'kashmiri_immigrant' => $this->input->post('kashmiri') ,
				'hobbies' => strtolower($this->authorization->strclean($this->input->post('hobbies'))) ,
				'fav_past_time' => strtolower($this->authorization->strclean($this->input->post('favpast'))) ,
				'birth_place' => strtolower($this->authorization->strclean($this->input->post('pob'))) ,
				'mobile_no' => $this->input->post('mobile') ,
				'father_name' => $father_name ,
				'mother_name' => $mother_name
			);

			/*if($this->input->post('stu_type') === 'others')
			{
				$student_type = $this->input->post('student_other_type');
				$this->load->model('student/student_new_student_type','',TRUE);
				$new_student_type_id = $this->student_new_student_type->get_new_id();
				$stu_type = array(
					'id' => $new_student_type ,
					'name' => $student_type
				);
			}
			else
			{
				$student_type = $this->input->post('stu_type');
				$stu_type = false;
			}*/

			$admn_based_on = $this->input->post('admn_based_on');
			$iit_jee_rank = $this->input->post('iitjee_rank');
			$iit_jee_cat_rank = $this->input->post('iitjee_cat_rank');
			$cat_score = $this->input->post('cat_score');
			$gate_score = $this->input->post('gate_score');
			if($admn_based_on === 'others')
			{
				$admn_based_on = $this->input->post('other_mode_of_admission');
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
				$gate_score = '0';
			}
			else if($admn_based_on === 'iitjee')
			{
				$cat_score = '0';
				$gate_score = '0';
			}
			else if($admn_based_on === 'gate')
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
			}
			else if($admn_based_on === 'cat')
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$gate_score = '0';
			}
			else
			{
				$iit_jee_rank = '0';
				$iit_jee_cat_rank = '0';
				$cat_score = '0';
				$gate_score = '0';
			}

			$stu_details = array(
				'admn_no' => $stu_id ,
				'admn_date' => date('Y-m-d',strtotime($this->input->post('entrance_date'))) ,
				'enrollment_no' => $this->input->post('roll_no') ,
				'type' => $this->input->post('stu_type') ,
				'identification_mark' => strtolower($this->authorization->strclean($this->input->post('identification_mark'))) ,
				'parent_mobile_no' => $this->input->post('parent_mobile') ,
				'parent_landline_no' => $this->input->post('parent_landline') ,
				'alternate_mobile_no' => $this->input->post('alternate_mobile') ,
				'alternate_email_id' => $this->input->post('alternate_email_id') ,
				'migration_cert' => $this->input->post('migration_cert') ,
				'name_in_hindi' => $this->input->post('stud_name_hindi') ,
				'blood_group' => $this->input->post('blood_group')
			);

			$stu_fee_details = array(
				'id' => $stu_id ,
				'fee_mode' => $this->input->post('fee_paid_mode') ,
				'fee_amount' => $this->input->post('fee_paid_amount') ,
				'fee_in_favour' => 'indian school of mines' ,
				'payment_made_on' => date('Y-m-d',strtotime($this->input->post('fee_paid_date'))) ,
				'transaction_id' => $this->input->post('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
			);

			$stu_other_details = array(
				'id' => $stu_id ,
				'fathers_occupation' => $father_occupation ,
				'mothers_occupation' => $mother_occupation ,
				'fathers_annual_income' => $father_income ,
				'mothers_annual_income' => $mother_income ,
				'guardian_name' => $guardian_name ,
				'guardian_relation' => $guardian_relation ,
				'bank_name' => $this->authorization->strclean($this->input->post('bank_name')) ,
				'account_no' => $this->authorization->strclean($this->input->post('bank_account_no')) ,
				'aadhaar_card_no' => $this->authorization->strclean($this->input->post('aadhaar_no')) ,
				'extra_curricular_activity' => strtolower($this->authorization->strclean($this->input->post('extra_activity'))) ,
				'other_relevant_info' => strtolower($this->authorization->strclean($this->input->post('any_other_information')))
			);

			$stu_academic = array(
				'id' => $stu_id ,
				'auth_id' => $this->input->post('stu_type') ,
				'enrollment_year' => date('Y',strtotime($this->input->post('entrance_date'))) ,
				'admn_based_on' => $admn_based_on ,
				'iit_jee_rank' => $iit_jee_rank ,
				'iit_jee_cat_rank' => $iit_jee_cat_rank ,
				'cat_score' => $cat_score ,
				'gate_score' => $gate_score ,
				'course_id' => $this->input->post('course') ,
				'branch_id' => $this->input->post('branch') ,
				'semester' => $this->input->post('semester')
			);

			if($this->input->post('correspondence_addr'))
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line11')) ,
						'line2' => $this->authorization->strclean($this->input->post('line21')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city1'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state1'))) ,
						'pincode' => $this->input->post('pincode1') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country1'))) ,
						'contact_no' => $this->input->post('contact1') ,
						'type' => 'present'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line12')) ,
						'line2' => $this->authorization->strclean($this->input->post('line22')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city2'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state2'))) ,
						'pincode' => $this->input->post('pincode2') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country2'))) ,
						'contact_no' => $this->input->post('contact2') ,
						'type' => 'permanent'
					)
				);
			}
			else
			{
				$user_address = array(
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line11')) ,
						'line2' => $this->authorization->strclean($this->input->post('line21')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city1'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state1'))) ,
						'pincode' => $this->input->post('pincode1') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country1'))) ,
						'contact_no' => $this->input->post('contact1') ,
						'type' => 'present'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line12')) ,
						'line2' => $this->authorization->strclean($this->input->post('line22')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city2'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state2'))) ,
						'pincode' => $this->input->post('pincode2') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country2'))) ,
						'contact_no' => $this->input->post('contact2') ,
						'type' => 'permanent'
					),
					array(
						'id' => $stu_id ,
						'line1' => $this->authorization->strclean($this->input->post('line13')) ,
						'line2' => $this->authorization->strclean($this->input->post('line23')) ,
						'city' => strtolower($this->authorization->strclean($this->input->post('city3'))) ,
						'state' => strtolower($this->authorization->strclean($this->input->post('state3'))) ,
						'pincode' => $this->input->post('pincode3') ,
						'country' => strtolower($this->authorization->strclean($this->input->post('country3'))) ,
						'contact_no' => $this->input->post('contact3') ,
						'type' => 'correspondence'
					)
				);
				/*var_dump($user_address);
				return ;
*/			}

			// $stu_current_entry = array(
			// 	'id' => $stu_id ,
			// 	'curr_step' => 1
			// );

			$p=0;
			foreach($details_modified_array as $mod_data)
			{
				if($p!=0)
					$details_modified = $details_modified.', ';
				else
					$p++;
				$details_modified = $details_modified.$mod_data;
			}

			if($p == 0)
				redirect("");

			$stu_details_to_approve = array(
				'id' => $stu_id,
				'details' => $details_modified
			);

			$this->load->model('student/student_status_details_model','',TRUE);
			$this->load->model('user/user_auth_types_model','',TRUE);
			$this->load->model('student/student_details_to_approve','',TRUE);
			$this->load->model('student/student_rejected_detail_model','',TRUE);

			$res = $this->user_auth_types_model->getUserIdByAuthId('acd_ar');

			$this->db->trans_start();

			$this->student_rejected_detail_model->deleteDetailsWhere(array("id" => $stu_id));

			$this->user_details_model->insertPendingDetails($user_details);
			$this->user_other_details_model->insertPendingDetails($user_other_details);
			$this->user_address_model->insertPendingDetails($user_address);
			if(!$this->student_academic_model->pending_insert($stu_academic))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_academic_model.');
			if(!$this->student_details_model->pending_insert($stu_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_details.');
			if(!$this->student_other_details_model->pending_insert($stu_other_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_other_details.');
			if(!$this->student_fee_details_model->pending_insert($stu_fee_details))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_fee_details.');
			//$this->student_current_entry_model->insert($stu_current_entry);
			if(!$this->student_education_details_model->pending_insert_batch($stu_education_detail))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_education_details.');
			if(!$this->student_details_to_approve->insert($stu_details_to_approve))
				$this->session->set_flashdata('flashError','Student '.$stu_id.' failed in table stu_details_to_approve.');
			//$this->Student_type_model->insert($stu_type);
			//$this->Student_new_student_type->update();

			//notify nodal officer
			foreach($res as $row)
				$this->notification->notify($row->id, 'acd_ar', "Validation Request", "Please validate ".$stu_id." details", "student/student_validate/validation/".$stu_id);

			$this->db->trans_complete();

			$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' data succssfully modified.');

			redirect("");

		/*if($user_details-> != $this->input->post(''))
		{
			$details_modified_array = array_values($details_modified_array);
			$details_modified_array[] = '';
		}*/
	}

	/*function edit_profile_pic($stu_id = '')
	{
		$this->addJS("student/edit_profile_picture_script.js");
		$this->load->model('user/user_details_model','',TRUE);
		$res=$this->user_details_model->getUserById($stu_id);
		$data['photopath'] = ($res == FALSE)?	FALSE:$res->photopath;
		$data['stu_id']=$stu_id;
		$this->drawHeader('Change Student picture');
		$this->load->view('student/edit/profile_pic',$data);
		$this->drawFooter();
	}

	function update_profile_pic($stu_id)
	{
		$upload = $this->upload_image($stu_id,'photo');
		if($upload)
		{
			$this->load->model('user/user_details_model','',TRUE);
			$res=$this->user_details_model->getUserById($stu_id);
			$old_photo = ($res == FALSE)?	FALSE:$res->photopath;
			$this->user_details_model->updateById(array('photopath'=>'student/'.$stu_id.'/'.$upload['file_name']),$stu_id);
			if($old_photo)	unlink(APPPATH.'../assets/images/'.$old_photo);

			//$this->edit_validation($stu_id,'profile_pic_status');

			$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' profile picture updated.');
			redirect('student/student_edit');
		}
	}*/

	function upload_image($stu_id = '', $name ='')
	{
		$config['upload_path'] = 'assets/images/student/'.strtolower($stu_id).'/';
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
                $filename='stu_'.$stu_id.'_'.date('YmdHis').$ext;
            }
        }
        else
        {
        	//var_dump('failure');
	       	$this->index('ERROR: File Name not set.');
			return FALSE;
	    }

		$config['file_name'] = $filename;

		if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
	    {
			mkdir($config['upload_path'],0777,TRUE);
    	}

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload($name))		//do_multi_upload is back compatible with do_upload
		{
			$error = $this->upload->display_errors();
			$this->index('ERROR: '.$error);
			return FALSE;
		}
		else
		{
			$upload_data = $this->upload->data();
			return $upload_data;
		}
	}

	/*private function edit_basic_details($stu_id)
	{
		$this->addJS("student/edit_basic_details_script.js");

		$this->load->model('course_structure/basic_model','',TRUE);
		$data['academic_departments']=$this->basic_model->get_depts();

		$data['stu_id']=$stu_id;
		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('student/student_type_model','',TRUE);
		$this->load->model('indian_states_model','',TRUE);

		$data['states']=$this->indian_states_model->getStates();
		$data['stu_type'] = $this->student_type_model->get_all_types();
		$data['user_details']=$this->user_details_model->getUserById($stu_id);
		$data['user_other_details']=$this->user_other_details_model->getUserById($stu_id);
		$data['stu_basic_details']=$this->student_details_model->get_student_details_by_id($stu_id);
		$data['stu_other_details']=$this->student_other_details_model->get_student_other_details_by_id($stu_id);
		$data['stu_fee_details']=$this->student_fee_details_model->get_stu_fee_details_by_id($stu_id);
		$data['stu_academic_details']=$this->student_academic_model->get_stu_academic_details_by_id($stu_id);
		$data['permanent_address']=$this->user_address_model->getAddrById($stu_id,'permanent');
		$data['present_address']=$this->user_address_model->getAddrById($stu_id,'present');
		$data['correspondence_address']=$this->user_address_model->getAddrById($stu_id,'correspondence');

		$depts = $data['user_details'];
		$data['courses']=$this->basic_model->get_course_offered_by_dept($depts->dept_id);

		$course = $data['stu_academic_details'];
		if($course)
			$data['branches'] = $this->basic_model->get_branches_by_course_and_dept($course->course_id,$depts->dept_id);
		else
		{
			$data['courses'] = FALSE;
			$data['branches'] = FALSE;
		}

		$this->drawHeader('Edit basic details');
		$this->load->view('student/edit/student_edit_basic_details',$data);
		$this->drawFooter();
	}

	function update_basic_details($stu_id,$correspondence_address)
	{
		$user_details = array(
			'salutation' => $this->input->post('salutation') ,
			'first_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('firstname')))) ,
			'middle_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('middlename')))) ,
			'last_name' => ucwords(strtolower($this->authorization->strclean($this->input->post('lastname')))) ,
			'sex' => $this->input->post('sex') ,
			'category' => $this->input->post('category') ,
			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))) ,
			'marital_status' => $this->input->post('mstatus') ,
			'physically_challenged' => $this->input->post('pd') ,
			'dept_id' => $this->input->post('department')
		);

		if($this->input->post('depends_on'))
		{
			$father_name = 'na';
			$mother_name = 'na';
			$father_occupation = 'na';
			$mother_occupation = 'na';
			$father_income = '0';
			$mother_income = '0';
			$guardian_name = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_name'))));
			$guardian_relation = ucwords(strtolower($this->authorization->strclean($this->input->post('guardian_relation_name'))));
		}
		else
		{
			$father_name = ucwords(strtolower($this->authorization->strclean($this->input->post('father_name'))));
			$mother_name = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_name'))));
			$father_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('father_occupation'))));
			$mother_occupation = ucwords(strtolower($this->authorization->strclean($this->input->post('mother_occupation'))));
			$father_income = $this->input->post('father_gross_income');
			$mother_income = $this->input->post('mother_gross_income');
			$guardian_name = 'na';
			$guardian_relation = 'na';
		}

		$user_other_details = array(
			'religion' => strtolower($this->input->post('religion')) ,
			'nationality' => strtolower($this->authorization->strclean($this->input->post('nationality'))) ,
			'kashmiri_immigrant' => $this->input->post('kashmiri') ,
			'birth_place' => strtolower($this->authorization->strclean($this->input->post('pob'))) ,
			'father_name' => $father_name ,
			'mother_name' => $mother_name
		);

		$admn_based_on = $this->input->post('admn_based_on');
		$iit_jee_rank = $this->input->post('iitjee_rank');
		$iit_jee_cat_rank = $this->input->post('iitjee_cat_rank');
		$cat_score = $this->input->post('cat_score');
		$gate_score = $this->input->post('gate_score');
		if($admn_based_on === 'others')
		{
			$admn_based_on = $this->input->post('other_mode_of_admission');
			$iit_jee_rank = '0';
			$iit_jee_cat_rank = '0';
			$cat_score = '0';
			$gate_score = '0';
		}
		else if($admn_based_on === 'iitjee')
		{
			$cat_score = '0';
			$gate_score = '0';
		}
		else if($admn_based_on === 'gate')
		{
			$iit_jee_rank = '0';
			$iit_jee_cat_rank = '0';
			$cat_score = '0';
		}
		else if($admn_based_on === 'cat')
		{
			$iit_jee_rank = '0';
			$iit_jee_cat_rank = '0';
			$gate_score = '0';
		}
		else
		{
			$iit_jee_rank = '0';
			$iit_jee_cat_rank = '0';
			$cat_score = '0';
			$gate_score = '0';
		}

		$stu_details = array(
			'admn_date' => date('Y-m-d',strtotime($this->input->post('entrance_date'))) ,
			'enrollment_no' => $this->input->post('roll_no') ,
			'type' => $this->input->post('stu_type') ,
			'identification_mark' => strtolower($this->authorization->strclean($this->input->post('identification_mark'))) ,
			'parent_mobile_no' => $this->input->post('parent_mobile') ,
			'parent_landline_no' => $this->input->post('parent_landline') ,
			'migration_cert' => $this->input->post('migration_cert') ,
			'name_in_hindi' => $this->input->post('stud_name_hindi') ,
			'blood_group' => $this->input->post('blood_group')
		);

		$stu_fee_details = array(
			'fee_mode' => $this->input->post('fee_paid_mode') ,
			'fee_amount' => $this->input->post('fee_paid_amount') ,
			'payment_made_on' => date('Y-m-d',strtotime($this->input->post('fee_paid_date'))) ,
			'transaction_id' => $this->input->post('fee_paid_dd_chk_onlinetransaction_cashreceipt_no')
		);

		$stu_other_details = array(
			'fathers_occupation' => $father_occupation ,
			'mothers_occupation' => $mother_occupation ,
			'fathers_annual_income' => $father_income ,
			'mothers_annual_income' => $mother_income ,
			'guardian_name' => $guardian_name ,
			'guardian_relation' => $guardian_relation ,
			'bank_name' => $this->authorization->strclean($this->input->post('bank_name')) ,
			'account_no' => $this->authorization->strclean($this->input->post('bank_account_no')) ,
			'aadhaar_card_no' => $this->authorization->strclean($this->input->post('aadhaar_no'))
		);

		$stu_academic = array(
			'auth_id' => $this->input->post('stu_type') ,
			'enrollment_year' => date('Y',strtotime($this->input->post('entrance_date'))) ,
			'admn_based_on' => $admn_based_on ,
			'iit_jee_rank' => $iit_jee_rank ,
			'iit_jee_cat_rank' => $iit_jee_cat_rank ,
			'cat_score' => $cat_score ,
			'gate_score' => $gate_score ,
			'course_id' => $this->input->post('course') ,
			'branch_id' => $this->input->post('branch') ,
			'semester' => $this->input->post('semester')
		);

		if($correspondence_address)
		{
			if(!$this->input->post('correspondence_addr'))
			{
				$user_correspondence_address = array(
					'line1' => $this->authorization->strclean($this->input->post('line13')) ,
					'line2' => $this->authorization->strclean($this->input->post('line23')) ,
					'city' => strtolower($this->authorization->strclean($this->input->post('city3'))) ,
					'state' => strtolower($this->authorization->strclean($this->input->post('state3'))) ,
					'pincode' => $this->input->post('pincode3') ,
					'country' => strtolower($this->authorization->strclean($this->input->post('country3'))) ,
					'contact_no' => $this->input->post('contact3')
				);
			}
		}
		else
		{
			$user_correspondence_address = array(
				'id' => $stu_id ,
				'line1' => $this->authorization->strclean($this->input->post('line13')) ,
				'line2' => $this->authorization->strclean($this->input->post('line23')) ,
				'city' => strtolower($this->authorization->strclean($this->input->post('city3'))) ,
				'state' => strtolower($this->authorization->strclean($this->input->post('state3'))) ,
				'pincode' => $this->input->post('pincode3') ,
				'country' => strtolower($this->authorization->strclean($this->input->post('country3'))) ,
				'contact_no' => $this->input->post('contact3') ,
				'type' => 'correspondence'
			);
		}

		$user_present_address = array(
			'line1' => $this->authorization->strclean($this->input->post('line11')) ,
			'line2' => $this->authorization->strclean($this->input->post('line21')) ,
			'city' => strtolower($this->authorization->strclean($this->input->post('city1'))) ,
			'state' => strtolower($this->authorization->strclean($this->input->post('state1'))) ,
			'pincode' => $this->input->post('pincode1') ,
			'country' => strtolower($this->authorization->strclean($this->input->post('country1'))) ,
			'contact_no' => $this->input->post('contact1')
		);

		$user_permanent_address = array(
			'line1' => $this->authorization->strclean($this->input->post('line12')) ,
			'line2' => $this->authorization->strclean($this->input->post('line22')) ,
			'city' => strtolower($this->authorization->strclean($this->input->post('city2'))) ,
			'state' => strtolower($this->authorization->strclean($this->input->post('state2'))) ,
			'pincode' => $this->input->post('pincode2') ,
			'country' => strtolower($this->authorization->strclean($this->input->post('country2'))) ,
			'contact_no' => $this->input->post('contact2')
		);

		$this->load->model('user/user_details_model','',TRUE);
		$this->load->model('user/user_other_details_model','',TRUE);
		$this->load->model('user/user_address_model','',TRUE);
		$this->load->model('student/student_details_model','',TRUE);
		$this->load->model('student/student_other_details_model','',TRUE);
		$this->load->model('student/student_fee_details_model','',TRUE);
		$this->load->model('student/student_academic_model','',TRUE);

		$this->db->trans_start();

		$this->user_details_model->updateById($user_details,$stu_id);
		$this->user_other_details_model->updateById($user_other_details,$stu_id);
		$this->user_address_model->updatePresentAddrById($user_present_address,$stu_id);
		$this->user_address_model->updatePermanentAddrById($user_permanent_address,$stu_id);
		if($correspondence_address)
			if(!$this->input->post('correspondence_addr'))
				$this->user_address_model->updateCorrespondenceAddrById($user_correspondence_address,$stu_id);
			else
				$this->user_address_model->deleteCorrespondenceAddrById($stu_id);
		else
			if(!$this->input->post('correspondence_addr'))
				$this->user_address_model->insert($user_correspondence_address);
		$this->student_details_model->update_by_id($stu_details,$stu_id);
		$this->student_other_details_model->update_by_id($stu_other_details,$stu_id);
		$this->student_fee_details_model->update_by_id($stu_fee_details,$stu_id);
		$this->student_academic_model->update_by_id($stu_academic,$stu_id);

		$this->db->trans_complete();

		$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' basic details updated.');
		redirect('student/student_edit');
	}

	private function edit_education_details($stu_id)
	{
		$this->addJS("student/edit_education_details_script.js");

		$data['stu_id']=$stu_id;
		$this->load->model('student/student_education_details_model','',TRUE);
		$data['stu_education_details'] = $this->student_education_details_model->getStuEduById($stu_id);

		$this->load->model('student/student_academic_model','',TRUE);
		$data['stu_type'] = $this->student_academic_model->get_stu_academic_details_by_id($stu_id);

		$this->drawHeader('Edit Educational Qualifications');
		$this->load->view('student/edit/educational_details',$data);
		$this->drawFooter();
	}

	function update_education_details($stu_id)
	{
		$exam = $this->input->post('exam4');
		$branch = $this->input->post('branch4');
		$clgname = $this->input->post('clgname4');
		$year = $this->input->post('year4');
		$grade = $this->input->post('grade4');
		$div = $this->input->post('div4');

		$n = count($clgname);
		$i = 0;
		$class = '10';
		while($i<2)
		{
			$stu_education_details[$i]['id'] = $stu_id;
			$stu_education_details[$i]['sno'] = $i+1;
			$stu_education_details[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
			$stu_education_details[$i]['branch'] = $class;
			$stu_education_details[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
			$stu_education_details[$i]['year'] = $year[$i];
			$stu_education_details[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
			$stu_education_details[$i]['division'] = strtolower($div[$i]);
			$class = '12';
			$i++;
		}
		while($i<$n)
		{
			$stu_education_details[$i]['id'] = $stu_id;
			$stu_education_details[$i]['sno'] = $i+1;
			$stu_education_details[$i]['exam'] = strtolower($this->authorization->strclean($exam[$i]));
			$stu_education_details[$i]['branch'] = strtolower($this->authorization->strclean($branch[$i-2]));
			$stu_education_details[$i]['institute'] = strtolower($this->authorization->strclean($clgname[$i]));
			$stu_education_details[$i]['year'] = $year[$i];
			$stu_education_details[$i]['grade'] = strtolower($this->authorization->strclean($grade[$i]));
			$stu_education_details[$i]['division'] = strtolower($div[$i]);
			$i++;
		}

		$this->load->model('student/student_education_details_model');

		$this->db->trans_start();

		$this->student_education_details_model->delete_record(array('id'=>$stu_id));
		$this->student_education_details_model->insert_batch($stu_education_details);

		$this->db->trans_complete();

		$this->session->set_flashdata('flashSuccess','Student '.$stu_id.' education details updated.');
		redirect('student/student_edit');
	}*/

}

?>