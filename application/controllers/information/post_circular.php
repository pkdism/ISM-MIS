<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_circular extends MY_Controller
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

		$this->form_validation->set_rules('circular_sub', 'Subject', 'required');
		$this->form_validation->set_rules('circular_no', 'Circular Number', 'required');
		
		$this->load->model('information/post_circular_model','',TRUE);
		
		//title for the page
		//$header['title']='Post Circular';
		$this->drawHeader("Post Circular");
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['id'] = $this->post_circular_model->get_max_circular_id();
			$data['auth_id'] = $auth_id;
			$this->load->view('information/post_circular',$data);
		}
		else
		{
			$upload=$this->upload_file('circular_path',$this->input->post('circular_id'));
			if($upload)
			{
				$date = date("Y-m-d H:i:s");
				$data = array('circular_id'=>$this->input->post('circular_id'),
						  'circular_no'=>$this->input->post('circular_no'),
						  'circular_cat'=>$this->input->post('circular_cat'), 
						  'circular_sub'=>$this->input->post('circular_sub'),
						  'circular_path'=>$upload['file_name'],
						  'issued_by'=>$this->session->userdata('id'),
						  'auth_id'=>$auth_id,
						  'valid_upto'=>$this->input->post('valid_upto'),
						  'posted_on'=>$date,
						  'modification_value'=>0
						  );
			
			$this->post_circular_model->insert($data);
			$this->session->set_flashdata('flashSuccess','Circular has been successfully posted.');
			redirect('home');
			
			//$this->load->view('information/post_circular_success');
			}
		}
		$this->drawFooter();
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
	        	redirect('information/post_circular');
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
				redirect('information/post_circular');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}
/* End of file post_circular.php */
/* Location: mis/application/controllers/information/post_circular.php */
