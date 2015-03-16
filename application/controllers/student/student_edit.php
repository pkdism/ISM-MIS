<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Student_edit extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('deo'));
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

	function select_form($error = '')
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
	}

	function edit_profile_pic($stu_id = '')
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
	}

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
	       	$this->index('ERROR: File Name not set.');
			return FALSE;
	    }

	    //dont upload files with no file name
		/*for($i=0 ; $i < $n_family ; $i++)
			if($_FILES[$name]["name"][$i] == '')
			{
				unset($_FILES[$name]["name"][$i]);
			}*/

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

	private function edit_basic_details($stu_id)
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
	}

}

?>