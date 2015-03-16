<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_notice extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('hod','est_ar','exam_dr','dt','dsw'));
	}

	public function index($auth_id='')
	{
		if($auth_id =='' || ($auth_id !='hod' && $auth_id !='dt' && $auth_id !='dsw' && $auth_id !='est_ar' && $auth_id !='exam_dr'))
		{
			$this->session->set_flashdata('flashError','Acccess Denied!'.$auth_id);
			redirect('home');
		}
		$this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');

		$this->form_validation->set_rules('notice_no', 'Notice Number', 'required');
		$this->form_validation->set_rules('notice_sub', 'Subject', 'required');
		//$this->form_validation->set_rules('notice_path', 'File', 'required');
		$this->form_validation->set_rules('last_date', 'Last Date', 'required');

		
		$this->load->model('information/post_notice_model','',TRUE);
		
		//title for the page
		//$header['title']='Post Notice';
		$this->drawHeader("Post Notice");
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['id'] = $this->post_notice_model->get_max_notice_id();
			$data['auth_id'] = $auth_id;
			$this->load->view('information/post_notice',$data);
		}
		else
		{
			$upload=$this->upload_file('notice_path',$this->input->post('notice_id'),$auth_id);
			if($upload)
			{
				$date = date("Y-m-d H:i:s");
				$data = array('notice_id'=>$this->input->post('notice_id'),
						  'notice_no'=>$this->input->post('notice_no'),
						  'notice_cat'=>$this->input->post('notice_cat'), 
						  'notice_sub'=>$this->input->post('notice_sub'),
						  'notice_path'=>$upload['file_name'],
						  'issued_by'=>$this->session->userdata('id'),
						  'auth_id'=>$auth_id,
						  'posted_on'=>$date,
						  'last_date'=>$this->input->post('last_date'),
						  'modification_value'=>0
						  );
			
			$this->post_notice_model->insert($data);
			$this->session->set_flashdata('flashSuccess','Notice has been successfully posted.');
			redirect('home');
			//$this->load->view('information/post_notice_success');
			}
		}
		$this->drawFooter();
	}
	
	
	private function upload_file($name ='',$sno = 0,$auth_id='')
	{
		$config['upload_path'] = 'assets/files/information/notice';
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
                    $filename='NOTICE_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: File Name not set.');
	        	redirect('information/post_notice/index/'.$auth_id);
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
				redirect('information/post_notice/index/'.$auth_id);
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file post_notice.php */
/* Location: mis/application/controllers/information/post_notice.php */
