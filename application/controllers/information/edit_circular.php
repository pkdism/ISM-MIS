<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_circular extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	
	public function index($auth_id='',$circular_id='')
	{
		if($auth_id =='' || ($auth_id !='hod' && $auth_id !='dt' && $auth_id !='dsw' && $auth_id !='est_ar' && $auth_id !='exam_dr'))
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		if($circular_id=='')
		{
			$this->load->model('information/edit_circular_model','',TRUE);
			//$data['secondLink'] = '<a href="'.base_url().'index.php/information/view_circular/index/archieved">List of Archieved circulars</a>';
			
			$data['circulars'] = $this->edit_circular_model->get_circulars($auth_id);
			$data['auth_id'] = $auth_id;
			
			if(count($data['circulars']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no any Circular to edit.');
				redirect('home');
			}
				
			$this->drawHeader('Edit Circular');
			$this->load->view('information/editCircular',$data);
			$this->drawFooter();
		}
		else
		{
			$this->load->model('information/view_circular_model','',TRUE);
			$data['circular_row'] = $this->view_circular_model->get_circular_row($circular_id);
			if(count($data['circular_row']) == 0)
			{
				$this->session->set_flashdata('flashError','There is no Circular available with the circular id ('.$circular_id.')');
				redirect('home');
			}
			
			$this->drawHeader('Edit Circular');
			$this->load->view('information/edit_circular',$data);
			$this->drawFooter();
		}
	}

	public function edit($circular_id)
	{
		if($circular_id =='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('circular_sub', 'Circular Subject', 'required');
		$this->form_validation->set_rules('circular_no', 'Circular Number', 'required');
		
		$this->load->model('information/edit_circular_model','',TRUE);
		
		$circular=$this->edit_circular_model->getcircularsByMinId($this->input->post('circular_id'));
		
		if(count($circular) == 0)
		{
			$this->session->set_flashdata('flashError','There is no Circular with the circular id ('.$circular_id.') to edit');
			redirect('home');
		}
		
		if($_FILES['circular_path']['name'] != '')
		{
			
			$upload=$this->upload_file('circular_path',$this->input->post('circular_id'),$this->input->post('modification_value'));
			if($upload)
			{
				//current date
				$date = date("Y-m-d H:i:s");
				
				$circular=$this->edit_circular_model->getcircularsByMinId($this->input->post('circular_id'));
				$old_file = $circular->circular_path;
				
				$data = array('circular_id'=>$this->input->post('circular_id'),
						  'circular_no'=>$this->input->post('circular_no'),
						  'circular_sub'=>$this->input->post('circular_sub'),
						  'circular_cat'=>$this->input->post('circular_cat'),
						  'circular_path'=>$upload['file_name'],
						  'valid_upto'=>$this->input->post('valid_upto'),
						  'posted_on'=>$date,
						  'modification_value'=>$this->input->post('modification_value') + 1
						  );
			    
				$this->edit_circular_model->insertM($data['circular_id']);
				$this->edit_circular_model->update($data);
				//if($old_file)	unlink(APPPATH.'../assets/files/information/circular/'.$old_file);
				$this->session->set_flashdata('flashSuccess','Circular has been successfully updated.');
				redirect('home');
			
			}
		}
		else
		{
				//current date
			$date = date("Y-m-d H:i:s");
			
			$data = array('circular_id'=>$this->input->post('circular_id'),
					  'circular_no'=>$this->input->post('circular_no'),
					  'circular_sub'=>$this->input->post('circular_sub'),
					  'circular_cat'=>$this->input->post('circular_cat'),
					  'valid_upto'=>$this->input->post('valid_upto'),
					  'posted_on'=>$date,
					  'modification_value'=>$this->input->post('modification_value') + 1
					  );
				
			$this->edit_circular_model->insertM($data['circular_id']);
			$this->edit_circular_model->update($data);
			$this->session->set_flashdata('flashSuccess','Circular has been successfully updated.');
			redirect('home');
		}		
	}	
	
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/files/information/circular';
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
                    $filename='CIRCULAR_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/edit_circular');
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
				redirect('information/edit_circular');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file edit_circular.php */
/* Location: mis/application/controllers/information/edit_circular.php */
