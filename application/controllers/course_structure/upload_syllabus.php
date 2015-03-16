<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload_syllabus extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo'));
		$this->addJS("course_structure/upload_syllabus.js");
		$this->load->model('course_structure/basic_model','',TRUE);
		
		//$this->load->helper(array('form'));
		$CS_session = $this->session->userdata("CS_session");
	}

	public function index($error='')
	{
		$this->session->keep_flashdata('message');
		$data = array();
		$data["result_dept"] = $this->basic_model->get_depts();	
		$this->drawHeader("Upload Detailed Syllabus");
		$this->load->view('course_structure/upload_syllabus',$data);
		$this->drawFooter();
	}
	
	public function upload()
	{
		$this->load->model("course_structure/syllabus");
		$dept = $this->input->post("dept");
		$course_id = $this->input->post("course");
		$branch_id = $this->input->post("branch");
		$session = $this->input->post("session");
		$file = $this->input->post("file_upload");
		
		if(!$this->input->post() ||$_FILES['file_upload']['error'] != 0)
		{
			$this->session->set_flashdata("flashError","File size is too large to be uploaded.Please upload file of size less then 5 MB");
			redirect("course_structure/upload_syllabus");	
		}
		
		$expected_aggr_id = $course_id.'_'.$branch_id.'_'.$session;
		if(!$this->basic_model->check_if_aggr_id_exist_in_CS($expected_aggr_id))
		{
			$result_aggr_id = $this->basic_model->get_latest_aggr_id($course_id,$branch_id,$expected_aggr_id);
			$aggr_id = $result_aggr_id[0]->aggr_id;	
		}	
		else
			$aggr_id = $expected_aggr_id;
		
		$course_branch_id = $this->basic_model->select_course_branch($course_id,$branch_id);
		$course_branch_id = $course_branch_id[0]->course_branch_id;
		
		$file_name = basename($_FILES['file_upload']['name']);
		
		$dir = "assets/files/course_structure/";
		if(!file_exists($dir))
		{
			mkdir($dir,0777,true);	
		}
		$target_file = $_FILES['file_upload']['name'];
		$newfilename = $aggr_id.".".pathinfo($target_file,PATHINFO_EXTENSION);
		$newfilename = $dir.$newfilename;
		
		//if file is too large then show error message.
		if($_FILES['file_upload']['size'] >= 50000000)
		{
			$this->session->set_flashdata("flashError","File size is too large to be uploaded.Please upload file of size less then 5 MB");
			redirect("course_structure/upload_syllabus");	
		}
		
		//check the extension of the file to be uploaded.
		if(pathinfo($target_file,PATHINFO_EXTENSION) != 'pdf')
		{
			die("Extension");
			$this->session->set_flashdata("flashError","Please upload a file in PDF Format");
			redirect("course_structure/upload_syllabus");	
		}
		
		if(file_exists($newfilename) || $this->syllabus->check_if_syllabus_exist($aggr_id,$course_branch_id))
		{
			$this->syllabus->delete_syllabus($aggr_id,$course_branch_id);
			unlink($newfilename);	
			//die("deleted from folder and database");
		}	
		
		if(!$this->syllabus->check_if_syllabus_exist($aggr_id,$course_branch_id))
		{
			$syllabus_details['course_branch_id'] = $course_branch_id;
			$syllabus_details['aggr_id'] = $aggr_id;
			$syllabus_details['syllabus_path'] = $newfilename;
			$syllabus_details['uploaded_on'] = date("Y-m-d");
			
			if($this->syllabus->insert_syllabus($syllabus_details))
			{
				//if syllabus has been inserted into database then check if the file has been moved to physical location.
				if(move_uploaded_file($_FILES['file_upload']['tmp_name'],$newfilename))
				{
					$this->session->set_flashdata("flashSuccess","Syllabus Uploaded Successfully");
					redirect("course_structure/upload_syllabus");
				}	
				//else delete the entry from database.
				else
				{
					$this->syllabus->delete_syllabus($aggr_id,$course_branch_id);
					$this->session->set_flashdata("flashError","Error in uploading file");
					redirect("course_structure/upload_syllabus");
				}	
				
			}
			else
			{
				$this->session->set_flashdata("flashError","Error in Database Operation.");
				redirect("course_structure/upload_syllabus");	
			}
		
			$this->session->set_flashdata("flashSuccess","Uploaded successfully");
			redirect("course_structure/upload_syllabus");	
		}
		else
		{
			$this->session->set_flashdata("flashError","Error in uploading file.");
			redirect("course_structure/upload_syllabus");	
		}
	}
}

?>