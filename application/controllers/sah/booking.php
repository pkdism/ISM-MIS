<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('emp','stu'));
		
	}
	
	function form()
	{
		
		$this->load->model('sah/sah_model');
		
		if($this->input->post('submit') == TRUE)
		{
			$upload=$this->upload_file('application_file');
			
			$date = date("Y-m-d",strtotime(date("Y-m-d"))+19800);
			$school_guest =1;
			if($this->input->post('schoolguest') == 'no')
				$school_guest = 0;
			
			$prec = 'SAH';
			if($this->session->userdata('auth[0]') == 'stu')
				$prec = 'DSW';
			$app_num = $prec.date('YmdHis');
			$user_id = $this->session->userdata('id');
			$numofguests = (int)$this->input->post('no_of_guests');
			
			$guest = $this->input->post('guest');
			for ($i =0;$i< $numofguests; $i++)
			{
				$data = array('app_num'=>$app_num,
						'gname'=>$guest[$i]['name'],
						'desg'=>$guest[$i]['designation'],
						'address'=>$guest[$i]['address'],
						'gender'=>$guest[$i]['gender'],
						'boarding'=>$guest[$i]['boarding_required'],
						'room_pref'=>$guest[$i]['room_preference']		
						);
				$this->sah_model->add_guest($data);
			}
		
			if($upload)
			{
				$application_data = array('app_num'=>$app_num,
					  'school_guest'=>$school_guest,
					  'user_id'=>$user_id,
					  'email_id'=>$this->session->userdata('email'),
					  'app_status'=>'Pending',
					  'approved_by'=>'Pending',
					  'branch_id'=>$this->session->userdata('dept_id'),
					  'purpose'=>$this->input->post('reason'),
					  'num_of_guest'=>$numofguests,
					  'check_in'=>$this->input->post('checkin'),
					  'check_out'=>$this->input->post('checkout'),
					  'app_date'=>date("Y-m-d"),
					  'photopath'=>$upload['file_name']
					  );		
					  
				$this->sah_model->add_application($application_data);
			}
			else
			{
				$application_data = array('app_num'=>$app_num,
					  'school_guest'=>$school_guest,
					  'user_id'=>$user_id,
					  'email_id'=>$this->session->userdata('email'),
					  'app_status'=>'Pending',
					  'approved_by'=>'Pending',
					  'branch_id'=>$this->session->userdata('dept_id'),
					  'purpose'=>$this->input->post('reason'),
					  'num_of_guest'=>$numofguests,
					  'check_in'=>$this->input->post('checkin'),
					  'check_out'=>$this->input->post('checkout'),
					  'app_date'=>date("Y-m-d")
					  );
					  
				$this->sah_model->add_application($application_data);
			}
			$this->session->set_flashdata('flashSuccess','The booking form has been successfully submitted. You\'ll be notified for the booked room.');
			redirect('sah/booking/track_status');
			
		}
		
		$this->drawHeader('Senior Academic Hostel Management');
		//$data['data'] = $this->session->all_userdata();
		if($this->sah_model->is_there_any_application_for_user($this->session->userdata('id')))
			$this->load->view('sah/progress');
		else
			$this->load->view('sah/booking_form');
		$this->drawFooter();
	}
	
	function track_status()
	{
		$this->load->model('sah/sah_model');
		$data['applications'] = $this->sah_model->get_all_applications_with_checkin_today_onwards($this->session->userdata('id'));
		
		if(count($data['applications']) == 0){
			$this->session->set_flashdata('flashError','You haven\'t any application form to track.');
			redirect('sah/booking/form');
		}	
		$this->drawHeader('Senior Academic Hostel Management');
		$this->load->view('sah/track_status',$data);
		$this->drawFooter();
	}
	
	function history()
	{
	
	}
	
	function get_guests($app_num)
	{
		$this->load->model('sah/sah_model');
		$data['guests'] = $this->sah_model->get_all_guests_for_a_application($app_num);
		$data['app_num'] = $app_num;
		$this->drawHeader('Senior Academic Hostel Management');
		$this->load->view('sah/guest_list',$data);
		$this->drawFooter();
	}
	
	private function upload_file($name ='')
	{
		$config['upload_path'] = 'assets/files/sah';
		$config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg|png';
		$config['max_size']  = '1050';

			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='FILE_'.date('YmdHis').$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('sah/booking/form');
				return FALSE;
	        }
	   
			$config['file_name'] = $filename;
			
			if(!is_dir($config['upload_path']))	//create the folder if it's not already exists
			{
				mkdir($config['upload_path'],0777,TRUE);
			}

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_multi_upload($name))		//do_multi_upload is back compatible with do_upload
			{
				$this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
				redirect('sah/booking/form');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
	
}