<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_minute extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	
	public function index($auth_id='',$minute_id='')
	{
		if($auth_id =='' || ($auth_id !='hod' && $auth_id !='dt' && $auth_id !='dsw' && $auth_id !='est_ar' && $auth_id !='exam_dr'))
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		if($minute_id=='')
		{
			$this->load->model('information/edit_minute_model','',TRUE);
			//$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_minute/index/archieved">List of Archieved minutes</a>';
			
			$data['minutes'] = $this->edit_minute_model->get_minutes($auth_id);
			$data['auth_id'] = $auth_id;
			
			if(count($data['minutes']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any Meeting Minutes to edit.');
				redirect('home');
			}
				
			$this->drawHeader('Edit Meeting Minutes');
			$this->load->view('information/editMinute',$data);
			$this->drawFooter();
		}
		else
		{
			$this->load->model('information/view_minute_model','',TRUE);
			$data['minute_row'] = $this->view_minute_model->get_minute_row($minute_id);
			if(count($data['minute_row']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no meeting minutes available with the minute id ('.$minute_id.')');
				redirect('home');
			}
			
			$this->drawHeader('Edit Meeting Minutes');
			$this->load->view('information/edit_minute',$data);
			$this->drawFooter();
		}
	}

	public function edit($minute_id)
	{
		if($minute_id =='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('minute_sub', 'Minute Subject', 'required');
		$this->form_validation->set_rules('minutes_no', 'Minute Number', 'required');
		
		$this->load->model('information/edit_minute_model','',TRUE);
		
		$minute=$this->edit_minute_model->getminutesByMinId($this->input->post('minutes_id'));
		
		if(count($minute) == 0)
		{
			$this->session->set_flashdata('flashError','There is no meeting minutes with the minute id ('.$minute_id.') to edit');
			redirect('home');
		}
		
		if($_FILES['minutes_path']['name'] != '')
		{
			
			$upload=$this->upload_file('minutes_path',$this->input->post('minutes_id'),$this->input->post('modification_value'));
			if($upload)
			{
				//current date
				$date = date("Y-m-d H:i:s");
				
				$minute=$this->edit_minute_model->getminutesByMinId($this->input->post('minutes_id'));
				$old_file = $minute->minute_path;
				
				$data = array('minutes_id'=>$this->input->post('minutes_id'),
						  'minutes_no'=>$this->input->post('minutes_no'),
						  'meeting_type'=>$this->input->post('meeting_type'),
						  'meeting_cat'=>$this->input->post('meeting_cat'),
						  'minutes_path'=>$upload['file_name'],
						  'valid_upto'=>$this->input->post('valid_upto'),
						  'date_of_meeting'=>$this->input->post('date_of_meeting'),
						  'place_of_meeting'=>$this->input->post('place_of_meeting'),
						  'posted_on'=>$date,
						  'modification_value'=>$this->input->post('modification_value') + 1
						  );
			    
				$this->edit_minute_model->insertM($data['minutes_id']);
				$this->edit_minute_model->update($data);
				//if($old_file)	unlink(APPPATH.'../assets/files/information/minute/'.$old_file);
				$this->session->set_flashdata('flashSuccess','Meeting minutes has been successfully updated.');
				redirect('home');
			
			}
		}
		else
		{
				//current date
			$date = date("Y-m-d H:i:s");
			$meeting_type=$this->input->post('meeting_type');
			if($meeting_type=='others')
				$meeting_type=$this->input->post('meeting_others');
			$data = array('minutes_id'=>$this->input->post('minutes_id'),
						  'minutes_no'=>$this->input->post('minutes_no'),
						  'meeting_type'=>$meeting_type,
						  'meeting_cat'=>$this->input->post('meeting_cat'),
						  'valid_upto'=>$this->input->post('valid_upto'),
						  'date_of_meeting'=>$this->input->post('date_of_meeting'),
						  'place_of_meeting'=>$this->input->post('place_of_meeting'),
						  'posted_on'=>$date,
						  'modification_value'=>$this->input->post('modification_value') + 1
						  );
				
			$this->edit_minute_model->insertM($data['minutes_id']);
			$this->edit_minute_model->update($data);
			$this->session->set_flashdata('flashSuccess','Meeting Minutes has been successfully updated.');
			redirect('home');
		}		
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
	        	redirect('information/edit_minute');
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
				redirect('information/edit_minute');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file edit_minute.php */
/* Location: mis/application/controllers/information/edit_minute.php */
