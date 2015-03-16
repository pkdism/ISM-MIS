<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($auth_id='')
	{
		if($auth_id =='' || ($auth_id !='hod' && $auth_id !='dt' && $auth_id !='dsw' && $auth_id !='est_ar' && $auth_id !='exam_dr'))
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('minutes_no', 'Minutes Number', 'required');
		$this->form_validation->set_rules('date_of_meeting', 'Meeting Date', 'required');
		$this->form_validation->set_rules('place_of_meeting', 'Meeting Place', 'required');
		
		$this->load->model('information/post_minute_model','',TRUE);
		
		//title for the page
		//$header['title']='Post Minutes';
		$this->drawHeader("Post Minutes");
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['id'] = $this->post_minute_model->get_max_minute_id();
			$data['auth_id'] = $auth_id;
			$this->load->view('information/post_minute',$data);
		}
		else
		{
			$upload=$this->upload_file('minutes_path',$this->input->post('minutes_id'));
			if($upload)
			{
				//deparment of logged in employee
				$department = $this->post_minute_model->get_department();
				//current date
				$date = date("Y-m-d H:i:s");
				
				$others = $this->input->post('meeting_type');
				//checking for others meeting type
				if($others=='others')
					$others  = $this->input->post('meeting_others');
				
				$data = array('minutes_id'=>$this->input->post('minutes_id'),
						  'minutes_no'=>$this->input->post('minutes_no'),
						  'meeting_type'=>$others, 
						  'meeting_cat'=>$this->input->post('meeting_cat'),
						  'dept_name'=>$department,
						  'minutes_path'=>$upload['file_name'],
						  'date_of_meeting'=>$this->input->post('date_of_meeting'),
						  'place_of_meeting'=>$this->input->post('place_of_meeting'),
						  'issued_by'=>$this->session->userdata('id'),
						  'auth_id'=>$auth_id,
						  'posted_on'=>$date,
						  'valid_upto'=>$this->input->post('valid_upto'),
						  'modification_value'=>0
						  );
			
			$this->post_minute_model->insert($data);
			$this->session->set_flashdata('flashSuccess','Meeting minutes has been successfully posted.');
			redirect('home');
			
			//$this->load->view('information/post_minute_success');
			}
		}
		$this->drawFooter();
	}
	
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/files/information/minute';
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
                    $filename='MINUTE_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/post_minute');
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
				$this->session->set_flashdata('flashError',$this->upload->display_errors('',''));
				redirect('information/post_minute');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file post_minute.php */
/* Location: mis/application/controllers/information/post_minute.php */
