<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CV extends MY_Controller {

	function __construct()
  {
    // This is to call the parent constructor
		parent::__construct(array('tpo', 'stu'));
		
		//$this->addJS("course_structure/edit.js");
		//$this->addCSS("tnpcell/cs_layout.css");
		//$this->load->model('tnp/basic_model','',TRUE);
  }
	public function index()
	{
    $this->load->database();
    $this->load->helper('form');
    $this->drawHeader();
		$this->load->view('tnpcell/fill_projects');
		$this->drawFooter();
	}
  public function save_projects()
  {
    $this->load->database();
    $this->load->helper('form');
    $this->load->model('tnpcell/cv_model','',TRUE);
    for($i=1;$i<=5;$i++) 
    {
      $project_details['user_id'] = $this->CI->session->userdata('id');
			$project_details['place'] = $this->input->post("place".$i);
			$project_details['title'] = $this->input->post("title".$i);
      $project_details['duration'] =$this->input->post("duration".$i);
			$project_details['role'] = $this->input->post("role".$i);
			$project_details['description'] = $this->input->post("description".$i);
      $project_details['id'] = uniqid();
      if($project_details['place']=='') continue;
      $this->cv_model->insert_project($project_details);
    }
    $this->drawHeader();
    $this->load->view('tnpcell/fill_achievements');
	  $this->drawFooter();
    
  }
  public function save_achievements()
  {
    $this->load->database();
    $this->load->model('tnpcell/cv_model','',TRUE);
    for($i=1;$i<=5;$i++)
    {
      $cv_details['user_id']=$this->CI->session->userdata('id');
      $cv_details['category']=$this->input->post("category".$i);
      $cv_details['info']=$this->input->post("information".$i);
      echo $cv_details['category'];
      echo $cv_details['info'];
      if($cv_details['info']=='') continue;
      $cv_details['id']=uniqid();
      $this->cv_model->insert_achievements($cv_details);
    }
    redirect('tnpcell/cv/print_cv');
  }
  public function print_cv()
  {
    $user_id= $this->CI->session->userdata('id');
    $this->load->model('tnpcell/cv_model','',TRUE);
    $data['projects']= $this->cv_model->get_projects($user_id);
    $data['achievements']= $this->cv_model->get_achievements($user_id);
    $this->drawHeader("Your CV");
    $this->load->view('tnpcell/print_cv',$data);
	  $this->drawFooter();
    
  }
  public function edit_cv()
  {
    $user_id= $this->CI->session->userdata('id');
    $this->addJS("tnpcell/edit.js");
    $this->load->model('tnpcell/cv_model','',TRUE);
    $data['projects']= $this->cv_model->get_projects($user_id);
    $data['achievements']= $this->cv_model->get_achievements($user_id);
    $this->drawHeader("Edit Your CV");
    $this->load->view('tnpcell/edit_cv',$data);
	  $this->drawFooter();
  }
  public function update_project()
  {
	  $data = file_get_contents('php://input');
	  $data = json_decode($data, true);
      $this->load->model('tnpcell/cv_model','',TRUE);
	  
	  $project_details['place'] = $data['place'];
	  $project_details['title'] = $data['title'];
	  $project_details['role']= $data['role'];
	  $project_details['description'] = $data['description'];
	  $project_details['duration'] = $data['duration'];
	  //$id= $data['id'];
	  
	  
	  	if($this->cv_model->update_project($project_details,$id))
		{
			echo "success";
		}
		else	
			echo "failed";
  }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

?>