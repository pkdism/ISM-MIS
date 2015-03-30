<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {
	
		function __construct(){
			parent::__construct(array('deo','hod','tti'));
			$this->addJS("subject_mapping/stu_report_file.js");
			$this->load->model('subject_mapping/mapping');
			}
		
		function index(){
				$data=array();
				$data['status']='';
				
				if($this->input->post('department_name') && $this->input->post('course') && $this->input->post('branch') && $this->input->post('semester')){
							$this->load->model('course_structure/basic_model',"",TRUE);
						$agr=$this->input->post('course')."_".$this->input->post('branch')."_".(date('Y')-1)."_".(date('Y'));
						// Get Letest Aggrigate Id//
			$Lagr=$this->basic_model->get_latest_aggr_id($this->input->post('course'),$this->input->post('branch'),$agr);
			//print_r($Lagr); die;
				
						$data['subject']=$this->basic_model->get_subjects_by_sem($this->input->post('semester'),$Lagr[0]->aggr_id);
						
					}
					
					
					if($this->input->post('course'))
				$data['status']=$this->mapping->checkExisting($this->input->post('course'),$this->input->post('branch'),$this->input->post('semester'));
					
				
				$this->drawHeader("Subject Mapping");
				$this->load->view('subject_mapping/index',$data);
				$this->drawFooter();
			}	
			
			function mappingadd(){
				
					if($this->input->post('dept') && $this->input->post('course') && $this->input->post('branch') && $this->input->post('semester')){
						
							$data['dept_id'] = $this->input->post('dept');
							$data['course_id'] = $this->input->post('course');
							$data['branch_id'] = $this->input->post('branch');
							$data['semester'] = $this->input->post('semester');
							$data['creater_id'] = $this->session->userdata('id');
							$data['date'] = date('Y-m-d H:i:s');
						//print_r($data); die();
							$lid=$this->mapping->insert_mapping($data);
							if($lid){
								$i=0;
								$t=$this->input->post('teacher');
								$r=$this->input->post('admin');
								$m=$this->input->post('subM');
								foreach($this->input->post('subId') as $s){
										$data1=array();
										$data1['map_id']=$lid;
										$data1['teacher_id']=$t[$i];
										$data1['rights']=$r[$i];
										$data1['subject_id']=$s;
										$data1['M']=$m[$i];
										$this->mapping->insert_mapping_des($data1);		
										$i++;
									}
									
									redirect('subject_mapping/main','refresh');
							}
						}
				
				}
				
			function MappingView(){
					
					
					$data['map']=$this->mapping->getMappingByYear($this->input->post('year'));
					$this->drawHeader("View Subject Mapping");
					$this->load->view('subject_mapping/view',$data);
					$this->drawFooter();
					
				}
				
			function AjaxView(){
						$id=$this->input->post('id');
						$this->load->model('employee/faculty_details_model');
						$this->load->model('employee/emp_basic_details_model');
						$this->load->model('user/user_details_model');
						$this->load->model('course_structure/basic_model');
						
						$re=$this->mapping->getMappingDesById($id);
							$i=0;
							foreach($re as $r){
								
								// Add teacher Details in result
								$usr=$this->user_details_model->getUserById($re[$i]['teacher_id']);
								$re[$i]['firstname']=$usr->first_name;
								$re[$i]['middlename']=$usr->middle_name;
								$re[$i]['lastname']=$usr->last_name;
								$re[$i]['email']=$usr->email;
								$re[$i]['photo']=$usr->photopath;
								$re[$i]['dept']=$usr->dept_id;
								
								$bas=$this->emp_basic_details_model->getEmployeeByID($re[$i]['teacher_id']);
								$re[$i]['designation'] = $bas->designation;
								$re[$i]['officeNo']=$bas->office_no;
								
							//	$fac=$this->faculty_details_model->getFacultyByID($re[$i]['teacher_id']);
								//$re[$i]['researchInterest'] = $fac->research_interest;
								
								//Subject Details//
								$sub=$this->basic_model->get_subject_details($re[$i]['subject_id']);
									$re[$i]['subjectId'] = $sub->subject_id;
									$re[$i]['subjectName'] = $sub->name;
									$re[$i]['lecture'] = $sub->lecture;
									$re[$i]['practical'] = $sub->practical;	
									$re[$i]['tutorial'] = $sub->tutorial;	
									$re[$i]['creditHr'] = $sub->credit_hours;
									$re[$i]['contactHr'] = $sub->contact_hours;
									$re[$i]['elective'] = ($sub->elective == 0)?"No":"Yes";
									$re[$i]['type'] = $sub->type;
								
								$i++;
							}
							
							
							
				
					echo json_encode($re);
					
					
			}
			
			function AjaxDelete(){
				$auth=$this->session->userdata('auth');
				//print_r(array_search('deo',$auth));
			//	return false;
				if(array_search('deo',$auth) || $auth[0]=='deo'){
						if($this->input->post('id')){
							if($this->Delete($this->input->post('id')));
								echo 1;
								return "";
						}
				}else if(array_search('hod',$auth) || $auth[0]=='hod' && $this->input->post('dept') == $this->session->userdata('dept_id')){
				
					if($this->input->post('id')){
							if($this->Delete($this->input->post('id')));
								echo 1;
								return "";
					}
				}else if(array_search('tti',$auth) || $auth[0]=='tti' && $this->input->post('dept') == $this->session->userdata('dept_id')){
						
					if($this->input->post('id')){
							if($this->Delete($this->input->post('id')));
								echo 1;
								return "";
					}
				}else{
					echo "You Have No Permission To Delete this Mapping!";
				}
				
			}
			
			private function Delete($id){
				
				if($id){
					$this->mapping->deleteMappingById($id);
					return  true;
				}else{
				
					return false;
				}
				
			}
			
			
			
			function mappingEdit($id){
				
				if($id){
						$this->load->model('course_structure/basic_model',"",TRUE);
						$this->load->model('user/user_details_model');
						$data['map']= $this->mapping->getMappingById($id);
						$data['map_des'] = $this->mapping->getMappingDesById($id);
						
						$this->drawHeader("Subject Mapping Edit");
						$this->load->view('subject_mapping/edit',$data);
						$this->drawFooter();
				}
			}
			
			//allready Exist Mapping Return
		function showMappingStatus($b,$c,$d){
			
			$a=$this->mapping->checkExistingSemester($c,$b,$d);
				echo json_encode($a);
		}
		
		function mappingDesEdit(){
			if($this->input->post('mapId') && $this->input->post('subId') && $this->input->post('teacherId') && $this->input->post('oldt') && $this->input->post('cod')){
				
						$data['teacher_id']=$this->input->post('teacherId');
						$data['rights']=($this->input->post('cod') == 'Y')?"1":"0";
				if($this->mapping->updateDMapping($this->input->post('mapId'),$this->input->post('subId'),$this->input->post('oldt'),$data)){
					
					$this->load->model('user/user_details_model');
					
					$r['name']= $this->user_details_model->user_details_model->getUserById($this->input->post('teacherId'))->first_name." ".$this->user_details_model->user_details_model->getUserById($this->input->post('teacherId'))->middle_name." ".$this->user_details_model->user_details_model->getUserById($this->input->post('teacherId'))->last_name;
					$r['rights']=($this->input->post('cod') == 'Y')?"Yes":"No";
					echo json_encode($r);
				}else{
				echo '0';
				}
			}
		}
		
		
		function mappingDesAdd(){
			//print_r($_POST);
			if($this->input->post('amid') && $this->input->post('teacher') && $this->input->post('subId') && $this->input->post('cod') ){
				
				$data['map_id']=$this->input->post('amid');
				$data['teacher_id']=$this->input->post('teacher');
				$data['rights']=$this->input->post('cod');
				$data['subject_id']=$this->input->post('subId');
				$data['M']='0';
				if($this->mapping->insert_mapping_des($data)){
					echo 1;
				}else{
					echo 0;
				}
			}
			
		}
		
		function mapDesDel(){
			if($this->input->post('mid') && $this->input->post('sid') && $this->input->post('tid') ){
				if($this->mapping->delMapDes($this->input->post('mid'),$this->input->post('sid'),$this->input->post('tid'))){
					echo 1;
				}else{
					echo 0;
				}
			}
		}
	
	}

?>