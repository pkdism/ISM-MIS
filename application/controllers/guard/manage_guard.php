<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_guard extends MY_Controller
{
	function __construct()
	{
		parent::__construct(array('seo'));
		$this->addJS('employee/print_script.js');
	}
	
	function index()
	{
		$this->session->set_flashdata('flashError','Access Denied!');
		redirect('home');
	}
	
	function add()
	{
		$this->addJS('guard/guard.js');
		if($this->input->post('addsubmit') == TRUE)
		{
			
			$upload=$this->upload_file('photo',$this->input->post('Regno'));
			
			$date = date("Y-m-d",strtotime(date("Y-m-d"))+19800);
			
			$data = array('Regno'=>$this->input->post('Regno'),
					  'firstname'=>$this->input->post('firstname'),
					  'middlename'=>$this->input->post('middlename'),
					  'lastname'=>$this->input->post('lastname'),
					  'fathersname'=>$this->input->post('fathersname'),
					  'qualification'=>$this->input->post('qualification'),
					  'localaddress'=>$this->input->post('localaddress'),
					  'permanentaddress'=>$this->input->post('permanentaddress'),
					  'mobilenumber'=>$this->input->post('mobilenumber'),
					  'dateofbirth'=>$this->input->post('dateofbirth'),
					  'dateofjoining'=>$this->input->post('dateofjoining'),
					  'photo'=>$upload['file_name'],
					  'added_on'=>$date
					  );		

			$this->load->model('guard/guard_model');
			
			if($this->guard_model->add_guard($data))
			{
				$this->session->set_flashdata('flashSuccess','Guard has been added successfully');
				redirect('guard/manage_guard/add');
			}
			else
			{
				$this->session->set_flashdata('flashError','Registration Number already exists');
				redirect('guard/manage_guard/view');
			}
		}
		
		$this->drawHeader('Add Guard');
		$this->load->view('guard/add_guard');
		$this->drawFooter();
	}
	
	function view()
	{
		$this->addJS('guard/view_guards_detail.js');
		$this->load->model('guard/guard_model');
		$data['personal_details_of_guards'] = $this->guard_model->get_personal_details_of_guards();
		$data['personal_details_of_guards_archive'] = $this->guard_model->get_personal_details_of_guards_archive();
		
		$this->drawHeader('View Guards Detail');
		$this->load->view('guard/view_guards_detail',$data);
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	}
	
	function remove($regno='')
	{
		
		if($regno=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
			
		$this->load->model('guard/guard_model');
		
		$data = $this->guard_model->get_details_of_a_guard($regno);
		$data['removed_on'] = date("Y-m-d",strtotime(date("Y-m-d"))+19800);
		
		$this->guard_model->insert_into_archive($data);
		
		$this->guard_model->delete($regno);
		
		$this->session->set_flashdata('flashSuccess','Guard has been removed successfully.');
		redirect('guard/manage_guard/view');
	}
	
	function edit($regno='')
	{
		$this->addJS('guard/edit_guard_details.js');
		if($this->input->post('savesubmit') == TRUE)
		{
			if($_FILES['photo']['name'] != '')
			{
				$upload=$this->upload_file('photo',$this->input->post('Regno'));
				
				if($upload)
				{
					
					$data = array('Regno'=>$this->input->post('Regno'),
							  'firstname'=>$this->input->post('firstname'),
							  'lastname'=>$this->input->post('lastname'),
							  'fathersname'=>$this->input->post('fathersname'),
							  'qualification'=>$this->input->post('qualification'),
							  'localaddress'=>$this->input->post('localaddress'),
							  'permanentaddress'=>$this->input->post('permanentaddress'),
							  'mobilenumber'=>$this->input->post('mobilenumber'),
							  'dateofbirth'=>$this->input->post('dateofbirth'),
							  'dateofjoining'=>$this->input->post('dateofjoining'),
							  'photo'=>$upload['file_name']
							  );		

					$this->load->model('guard/guard_model');
					$this->guard_model->update_guard($data);
				}
			}
			else
			{
				
				$data = array('Regno'=>$this->input->post('Regno'),
						  'firstname'=>$this->input->post('firstname'),
						  'lastname'=>$this->input->post('lastname'),
						  'fathersname'=>$this->input->post('fathersname'),
						  'qualification'=>$this->input->post('qualification'),
						  'localaddress'=>$this->input->post('localaddress'),
						  'permanentaddress'=>$this->input->post('permanentaddress'),
						  'mobilenumber'=>$this->input->post('mobilenumber'),
						  'dateofbirth'=>$this->input->post('dateofbirth'),
						  'dateofjoining'=>$this->input->post('dateofjoining')
						  );		

				$this->load->model('guard/guard_model');
				$this->guard_model->update_guard($data);
			}
			
			$this->session->set_flashdata('flashSuccess','Guard Details have been updated successfully');
			redirect('guard/manage_guard/view');
		}
		
		if($regno=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		$this->load->model('guard/guard_model');
		
		$data['details_of_a_guard'] = $this->guard_model->get_details_of_a_guard($regno);
		
		$this->drawHeader('Edit Guard Details');
		$this->load->view('guard/edit_guard_details',$data);
		$this->drawFooter();
	}
	
	private function upload_file($name ='',$sno = 0)
	{
		$config['upload_path'] = 'assets/images/guard';
		$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png';
		$config['max_size']  = '1050';

			if(isset($_FILES[$name]['name']))
        	{
                if($_FILES[$name]['name'] == "")
            		$filename = "";
                else
				{
                    $filename=$this->security->sanitize_filename(strtolower($_FILES[$name]['name']));
                    $ext =  strrchr( $filename, '.' ); // Get the extension from the filename.
                    $filename='GUARD_'.date('YmdHis').$sno.$ext;
                }
	        }
	        else
	        {
	        	$this->session->set_flashdata('flashError','ERROR: Image not set.');
	        	redirect('guard/manage_guard/add');
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
				redirect('guard/manage_guard/add');
				return FALSE;
			}
			else
			{
				$upload_data = $this->upload->data();
				return $upload_data;
			}
	}
}

?>