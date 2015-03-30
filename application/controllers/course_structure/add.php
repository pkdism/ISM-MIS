<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add extends MY_Controller
{
	function __construct()
	{
		// This is to call the parent constructor
		parent::__construct(array('deo', 'hod'));
		$this->addJS("course_structure/add_course_structure.js");
		$this->load->model('course_structure/basic_model','',TRUE);
		$CS_session = $this->session->userdata("CS_session");
		
	}

	public function index($error='')
	{
		$this->session->keep_flashdata('message');
		$data = array();
		$data["result_dept"] = $this->basic_model->get_depts();	
		$this->drawHeader("Add a new course structure");
		$this->load->view('course_structure/add',$data);
		$this->drawFooter();
	}
	
	public function EnterNumberOfSubjects()
	{
		$dept= $this->input->post('dept');
		$course= $this->input->post('course');
		$branch= $this->input->post('branch');
		$session= $this->input->post('session');
		$sem=$this->input->post('sem');
		
		//if course selected is honour,minor or common then dont show the count for elective field.
		if($course == "honour" || $course == "minor" || $course == "comm")
			$data['CS_session']['ele_count'] = 0;
			
		$aggr_id= $course.'_'.$branch.'_'.$session;
		//if($dept == 0 || $course == 0 || $branch == 0 || $session == 0 || $sem == 0)
		//{
		//	$this->session->set_flashdata("flashError","Please select a valid option.");
		//	redirect("course_structure/add");
		//}
		
		$result_course_branch = $this->basic_model->select_course_branch($course,$branch);
		$dept_course['course_branch_id'] = $result_course_branch[0]->course_branch_id;
		$dept_course['dept_id'] = $dept;
		$dept_course['aggr_id'] = $aggr_id;
		$dept_course['date'] = date("Y-m-d");
		
		//if this is new BOCS then first add its aggr_id to dept_courses .
		if($this->basic_model->count_dept_course_by_aggr_id($aggr_id) == 0)
		{
			$this->basic_model->insert_dept_course($dept_course);
		}
		
		//if CS already exisit for this semester then show error.
		if($this->basic_model->get_subjects_by_sem($sem,$aggr_id))
		{
			$this->session->set_flashdata("flashError","Course Structure already exist.Please Delete course structure first and then add new.");
			redirect("course_structure/add");
		}
			
		
		$row_course = $this->basic_model->get_course_details_by_id($course);
		$row_branch = $this->basic_model->get_branch_details_by_id($branch);
		
		$data["CS_session"]['duration']=$row_course[0]->duration;
		$data["CS_session"]['sem']=$sem;
		$data["CS_session"]['aggr_id'] = trim($aggr_id);
		
		$data["CS_session"]['course_name']=$row_course[0]->name;
		$data["CS_session"]['branch']=$row_branch[0]->name;
		$data["CS_session"]['session']=$session;
		
		
		
		$this->session->set_userdata($data);
		$this->drawHeader("Enter the number of core and elective subjects");
		$this->load->view('course_structure/count',$data);
		$this->drawFooter();
	}
    public function EnterSubjects()
  	{
  		$this->addJS("course_structure/add.js");
		$session_variable = $this->session->userdata("CS_session");
		
		$data['CS_session']["duration"] = $session_variable["duration"];
		$data['CS_session']['sem']=$session_variable["sem"];
		$data['CS_session']['aggr_id']=$session_variable["aggr_id"];
		$data['CS_session']['course_name']=$session_variable["course_name"];
		$data['CS_session']['branch']=$session_variable["branch"];
		$data['CS_session']['session']=$session_variable["session"];
		
		$data['CS_session']['count_core'] = $this->input->post("count_core");
		$data['CS_session']['count_elective'] = $this->input->post("count_elective");
		
		$this->session->set_userdata($data);
		if($data['CS_session']['count_core'] + $data['CS_session']['count_elective'] == 0)
			redirect("course_structure/add/EnterNumberOfSubjects");
		else
		{
			$this->drawHeader("Enter core subject details");
			$this->load->view('course_structure/courses',$data);
			$this->drawFooter();
		}
  	}
 	 
 	 public function AddCoreSubjects()
  	{
		$this->load->model('course_structure/add_model','',TRUE);
		$session_values = $this->session->userdata("CS_session");
		$data['CS_session'] = $session_values;
		
		$sem = $session_values["sem"];
		$aggr_id = trim($session_values["aggr_id"]);
		
		$count_elective = $session_values["count_elective"];
		
		$count_core = $session_values["count_core"];
		$data['count_core'] = $count_core;
		$i=1;
		//for loop for inserting core subjects...
		for($i = 1;$i <= $count_core;$i++)
		{
			$subject_details['id'] = uniqid();
			$subject_details['subject_id'] = $this->input->post("id".$i);
			$subject_details['name'] = $this->input->post("name".$i);
			$subject_details['lecture'] = $this->input->post("L".$i);
			$subject_details['tutorial'] = $this->input->post("T".$i);
			$subject_details['practical'] = $this->input->post("P".$i);
			
			$credit_hours= $this->input->post('credit_hours'.$i);
		  	$contact_hours= $subject_details['lecture'] + $subject_details['tutorial'] + floatval($subject_details['practical']);

			$subject_details['credit_hours'] = $credit_hours;
			$subject_details['contact_hours'] = $contact_hours;
			$subject_details['elective'] = "0";
			$subject_details['type'] = $this->input->post("type".$i);			
			
			$coursestructure_details['id'] = $subject_details['id'];
			$coursestructure_details['semester'] = $sem;
			$coursestructure_details['sequence'] = $this->input->post("sequence".$i);
			$coursestructure_details['aggr_id'] = $aggr_id;
			
			//first insert into course structure table and then to subjects table to maintain foreign key contraints.
			if($this->add_model->insert_coursestructure($coursestructure_details))
			{
				$data['error'] = $this->add_model->insert_subjects($subject_details);
			}	
		}
		
		if($this->input->post('list_type') == false && $this->input->post('options1') == false)
		{
			$this->session->set_flashdata("flashSuccess","Course structure for ".$data['CS_session']['course_name']." in ".$data['CS_session'][
			'branch']." for semester ".$sem." inserted successfully");
			redirect("course_structure/add");
			
			$list_type= 0;
			$data['CS_session']['list_type'] = $list_type;	
		}
		else
		{
			$list_type= $this->input->post("list_type");
			$data['CS_session']['list_type'] = $list_type;
			//if same list is selected
			if($list_type == 1)
			{
				$data["options"][1] = $this->input->post("options1");
				$data["CS_session"]["options"][1] = $data["options"][1];
				for($i = 1;$i<=$count_elective;$i++)
				{
					$data["seq_e"][$i] = $this->input->post("seq_e".$i);	
					$data["CS_session"]["seq_elective"][$i] = $data["seq_e"][$i];	
				}
			}
			else
			{
				for($i = 1;$i<=$count_elective;$i++)
				{
					$data["options"][$i] = $this->input->post("options".$i);	
					$data["seq_e"][$i] = $this->input->post("seq_e".$i);
					
					$data["CS_session"]["options"][$i] = $data["options"][$i];
					$data["CS_session"]["seq_elective"][$i] = $data["seq_e"][$i];	
				}
			}
		}
	$this->session->set_userdata($data);	
	if($count_elective>=1)
    {
		$this->drawHeader("Enter the details for Elective subjects");
		$this->load->view('course_structure/add_elective',$data);
		$this->drawFooter();
    }
    else
    {
      $this->session->set_flashdata("flashSuccess","Course structure for ".$data['CS_session']['course_name']." in ".$data['CS_session']['branch']." for semester ".$sem." inserted 
	  successfully");
	  if($data['CS_session']['course_id'] == "comm")
	  	redirect("course_structure/addCS_Common");
	  else
      	redirect("course_structure/add");
    }
  }
  
  public function AddElectiveSubjects()
  {
    //this function inserts elective subject in database.
	$this->load->model('course_structure/add_model','',TRUE);  
	
	$session_data = $this->session->userdata("CS_session");
	
	$sem = $session_data['sem'];
    $aggr_id = $session_data["aggr_id"];
    $count_elective = $session_data["count_elective"];
	$count=$count_elective;
	
	if($session_data['list_type'] == 1)
	{
    	$count_elective = 1;
	}
  	else
  	{
   	 	$count=1;
	}
    for($counter = 1;$counter<=$count_elective;$counter++)
    {	
		$elective_details['lecture'] = $this->input->post("L".$counter);
		$elective_details['tutorial'] = $this->input->post("T".$counter);
		$elective_details['practical'] = $this->input->post("P".$counter);
		$elective_details['type'] = $this->input->post("type".$counter);
		
		//$credit_hours= $elective_details['lecture']*2 + $elective_details['tutorial'] + $elective_details['practical'];
		$credit_hours= $this->input->post("credit_hours".$counter);
		$contact_hours= $elective_details['lecture'] + $elective_details['tutorial'] + floatval($elective_details['practical']);
	 
		$options = $session_data['options'][$counter];
		
		if($session_data['list_type'] == 1)
		{		
			for($j = 1;$j <= $session_data["count_elective"];$j++)
			{
				$group_id[$j] = $session_data["count_elective"].'_'.uniqid();		
			}	
		}	
		else
		{
			$group_id[1] = '1_'.uniqid();			
		}
		
		for($i = 1;$i <= $options;$i++)
		{	
			$subject_id = $this->input->post("id".$counter."_".$i);
			$name = $this->input->post("name".$counter."_".$i);
			$lecture = $elective_details['lecture'];
			$tutorial = $elective_details['tutorial'];
			$practical = $elective_details['practical'];
			$credit_hours = $credit_hours;
			$contact_hours = $contact_hours;
			$type = $elective_details['type'];
			
			if($session_data['list_type'] == 1)
			{
				for($j = 1;$j <= $session_data["count_elective"];$j++)
				{
					$subject_details['id'] = uniqid();
					$subject_details['subject_id'] = $subject_id;
					$subject_details['name'] = $name;
					$subject_details['lecture'] = $lecture;
					$subject_details['tutorial'] = $tutorial;
					$subject_details['practical'] = $practical;
					$subject_details['credit_hours'] = $credit_hours;
					$subject_details['contact_hours'] = $contact_hours;					
					$subject_details['elective'] = $group_id[$j];
					$subject_details['type'] = $type;
					
					$coursestructure_details['id'] = $subject_details['id'];
					$coursestructure_details['semester'] = $sem;
					
					$sequence = $this->input->post("sequence".$counter."_".$i);
					$sequence = $session_data['seq_elective'][$j].".".$sequence;
					$coursestructure_details['sequence'] = ($sequence); 
					$coursestructure_details['aggr_id'] = $aggr_id;
					
					$this->db->trans_start();
					$res = $this->add_model->insert_coursestructure($coursestructure_details);
					$data['error'] = $this->add_model->insert_subjects($subject_details);
					$this->db->trans_complete();
				}
			}
			else
			{
				$subject_details['id'] = uniqid();
				$subject_details['subject_id'] = $subject_id;
				$subject_details['name'] = $name;
				$subject_details['lecture'] = $lecture;
				$subject_details['tutorial'] = $tutorial;
				$subject_details['practical'] = $practical;
				$subject_details['credit_hours'] = $credit_hours;
				$subject_details['contact_hours'] = $contact_hours;					
				$subject_details['elective'] = $group_id[1];
				$subject_details['type'] = $type;
				
				$coursestructure_details['id'] = $subject_details['id'];
				$coursestructure_details['semester'] = $sem;
					
				$sequence = $this->input->post("sequence".$counter."_".$i);
				$sequence = $session_data['seq_elective'][$counter].".".$sequence;
				$coursestructure_details['sequence'] = ($sequence); 
				$coursestructure_details['aggr_id'] = $aggr_id;
				
				$this->db->trans_start();
				$res = $this->add_model->insert_coursestructure($coursestructure_details);
				$data['error'] = $this->add_model->insert_subjects($subject_details);
				$this->db->trans_complete();
			}
		} 
		
		//insert into elective_group table.
		if($session_data['list_type'] == 1)
		{
			for($j = 1;$j <= $session_data["count_elective"];$j++)
			{
				$elective_group['elective_name'] = $this->input->post("name_".$counter."_".$j);
				$elective_group['group_id'] = $group_id[$j];
				$elective_group['aggr_id'] = $aggr_id;
				$data['error'] = $this->add_model->insert_elective_group($elective_group);	
			}
		}
		else
		{
			$elective_group['elective_name'] = $this->input->post("name_".$counter);
			$elective_group['group_id'] = $group_id[1];
			$elective_group['aggr_id'] = $aggr_id;
			$data['error'] = $this->add_model->insert_elective_group($elective_group);	
		}
    }
	
      $this->session->set_flashdata("flashSuccess","Course structure for semester ".$sem." inserted successfully");
    redirect("course_structure/add");
  }
  
  
  
  	public function json_get_course($dept='')
	{
		if($dept != ''){
			$this->output->set_content_type('application/json');
			//$this->output->set_output(json_encode(array("hello"=>$course)));
			$this->output->set_output(json_encode($this->basic_model->get_course_offered_by_dept($dept)));
		}
	}

	public function json_get_branch($course='',$dept='')
	{
		if($course != '' && $dept != ''){
			$this->output->set_content_type('application/json');
			//$this->output->set_output(json_encode(array("hello"=>$course)));
			$this->output->set_output(json_encode($this->basic_model->get_branches_by_course_and_dept($course,$dept)));
		}
	}

	public function json_get_session($course='',$branch='')
	{
		if($course != '' && $branch!=''){
			$this->output->set_content_type('application/json');
			//$this->output->set_output(json_encode(array("hello"=>$course)));
			$this->output->set_output(json_encode($this->basic_model->get_session_by_course_and_branch($course,$branch)));
		}
	}
}
?>