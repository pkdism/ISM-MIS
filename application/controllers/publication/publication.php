<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Publication extends MY_Controller{

	public function __construct(){
		parent::__construct(array('deo','ft','emp'));
		$this->addJS("publication/add_publication.js");
		//$this->addCSS('publication/layout.css');
		$this->load->model('publication/basic_model','',TRUE);
	}

	public function index(){
		$data= array();
		$data['prk_types'] = $this->basic_model->get_prk_types();
		$this->drawHeader();
		$this->load->view('publication/add',$data);
		$this->drawFooter();
	}

	public function json_get_all_departments(){
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->basic_model->get_all_departments()));
	}

	public function json_get_emp_by_dept($dept){
		$this->output->set_content_type('application/json');
		$this->output->set_output(json_encode($this->basic_model->get_emp_by_dept($dept)));
	}

	public function addPublication(){
		$data['rec_id'] = uniqid();
		$data['title'] = $this->input->post('title');
		$data['type_id'] = $this->input->post('publication_type');
		$data['name'] = $this->input->post('publication_name');
		$data['begin_date'] = (new DateTime($this->input->post('begin_date')));
		$data['begin_date'] = $data['begin_date']->format('Y-m-d h:i:s');
		$data['place'] = '';
		$data['vol_no'] = '';
		$data['issue_no'] = '';
		$data['end_date'] = '';

		if($data['type_id'] == '1' || $data['type_id'] =='2'){
			$data['vol_no'] = $this->input->post('vol_no');
			$data['issue_no'] = $this->input->post('issue_no');
		}
		else if($data['type_id'] == '3' || $data['type_id'] =='4'){
			$data['place'] = $this->input->post('venue');
			$data['end_date'] = (new DateTime($this->input->post('end_date')));
			$data['end_date'] = $data['end_date']->format('Y-m-d h:i:s');
		}
		else if ($data['type_id']=='5'){
			$data['edition'] = $this->input->post('edition');
			$data['isbn_no'] = $this->input->post('isbn_no');
			$data['publisher'] = $this->input->post('publisher');
		}
		else if ($data['type_id']=='6'){
			$data['chapter_name'] = $this->input->post('chapter_name');
			$data['chapter_no'] = $this->input->post('chapter_no');
			$data['isbn_no'] = $this->input->post('isbn_no');
			$data['publisher'] = $this->input->post('publisher');
		}
		$data['page_no'] = $this->input->post('page_no');
		$data['other_info'] = $this->input->post('other_info');
		$data['no_of_authors'] = $this->input->post('no_of_authors');

		//to check the no of authors outside ism
		$count = 0;
		$authors = array();
		$is_user_author = false;
		for($i=1;$i<=$data['no_of_authors'];$i++){
			if($this->input->post('author_'.$i.'_type')=='OTHER'){
				$authors['other'][$count] = array();
				$authors['other'][$count]['rec_id'] = $data['rec_id']; 
				$authors['other'][$count]['first_name'] = $this->input->post('author_'.$i.'_fname');
				$authors['other'][$count]['middle_name'] = $this->input->post('author_'.$i.'_mname');
				$authors['other'][$count]['last_name'] = $this->input->post('author_'.$i.'_lname');
				$authors['other'][$count]['email_id'] = $this->input->post('author_'.$i.'_email');
				$authors['other'][$count]['institution'] = $this->input->post('author_'.$i.'_institution');
				echo "abc";
				$count++;
			}
			else{
				$authors['ism'][$i-$count-1] = array();
				$authors['ism'][$i-$count-1]['rec_id'] =$data['rec_id'];
				$authors['ism'][$i-$count-1]['emp_id'] = $this->input->post('author_'.$i.'_emp_id');
				$authors['ism'][$i-$count-1]['notify_status'] =0;
				echo "azv";
				if($this->input->post('author_'.$i.'_emp_id') == $this->session->userdata('id')){
					$authors['ism'][$i-$count-1]['notify_status'] =1;
					$is_user_author=true;
				}
			}
		}
		if(!$is_user_author){
			$this->session->set_flashdata("flashError","You Must also be one of the author of the Publication.");
			redirect('publication/publication/');
		}
		$data['other_authors']=$count;
		$data['no_of_approval'] = $data['other_authors']+1;

		for($i=0;$i<$data['no_of_authors']-$data['other_authors'];$i++){
			if($authors['ism'][$i]['emp_id'] != $this->session->userdata('id')){
				$pub_name = $this->basic_model->get_prk_types($data['type_id']);
				$description = $this->session->userdata("name")." has added a ".$pub_name[0]->type_name." with title: ".$data['title']." and wants to add you as a co-author.";
				$title = "You have a Publication to Approve";
				$link = "publication/publication/approve";
				$this->notification->notify($authors['ism'][$i]['emp_id'],"emp",$title,$description,$link,"");
			}
		}

		$this->basic_model->insert_publication_record($data);
		//var_dump($authors);
		if($data['other_authors'] > 0){
			$this->basic_model->insert_other_authors($authors['other']);
		}
		$this->basic_model->insert_ism_authors($authors['ism']);
		$this->session->set_flashdata("flashSuccess","Inserted Publication");
		redirect('publication/publication/index');
		//var_dump($this->input->post());
	}

	/*public function ()*/

	public function editpublication($rec_id=''){
		if(!empty($rec_id)){//Edit particular Publication
			$temp= $this->basic_model->get_pub_detail_by_rec_id($rec_id);
			$data= array();
			$data['publication'] = array();
			$data['publication']['rec_id'] = $temp[0]->rec_id;
			$data['publication']['title'] = $temp[0]->title;
			$data['publication']['name'] = $temp[0]->name;
			$data['publication']['type_id'] = $temp[0]->type_id;
			$data['publication']['place'] = $temp[0]->place;
			$data['publication']['vol_no'] = $temp[0]->vol_no;
			$data['publication']['issue_no'] = $temp[0]->issue_no;
			$data['publication']['edition'] = $temp[0]->edition;
			$data['publication']['isbn_no'] = $temp[0]->isbn_no;
			$data['publication']['place'] = $temp[0]->place;
			$data['publication']['publisher'] = $temp[0]->publisher;
			$data['publication']['chapter_name'] = $temp[0]->chapter_name;
			$data['publication']['chapter_no'] = $temp[0]->chapter_no;
			$data['publication']['begin_date'] = $temp[0]->begin_date;
			$data['publication']['end_date'] = $temp[0]->end_date;
			$data['publication']['page_no'] = $temp[0]->page_no;
			$data['publication']['other_info'] = $temp[0]->other_info;
			$sess = array();
			$sess['pub_data'] =array();
			$sess['pub_data']['rec_id'] = $temp[0]->rec_id;
			$sess['pub_data']['type_id'] = $temp[0]->type_id;
			$sess['pub_data']['no_of_authors'] =$temp[0]->no_of_authors;
			$sess['pub_data']['other_authors'] = $temp[0]->other_authors;
			$this->session->set_userdata($sess);
			$this->drawHeader('Edit Publication');
			$this->load->view('publication/edit',$data);
			$this->drawFooter();
		}
		else{
			$temp['publications'] = $this->basic_model->get_all_user_pub($this->session->userdata('id'));
			$data = array();
			if(count($temp['publications']) > 0){
				$i=0;
				foreach($temp['publications'] as $pub){
					$data['publications'][$i] = array();
					$data['publications'][$i]['rec_id'] = $pub->rec_id;
					$data['publications'][$i]['title'] = $pub->title;
					$data['publications'][$i]['name'] = $pub->name;
					$data['publications'][$i]['no_of_authors'] = $pub->no_of_authors;
					$data['publications'][$i]['other_authors'] = $pub->other_authors;
					$data['publications'][$i]['authors']['ism'] = $this->basic_model->get_ism_author_detail_by_pub($pub->rec_id);

					if($data['publications'][$i]['other_authors'] > 0){
						$data['publications'][$i]['authors']['others'] = $this->basic_model->get_other_author_detail_by_pub($pub->rec_id);
					}

					$i++;
				}
				$this->drawHeader('Edit Publication');
				$this->load->view('publication/show_editable.php',$data);
				$this->drawFooter();
			}
			else{
				$this->session->set_flashdata("flashSuccess","You don't have any Publication to Edit");
				redirect('publication/publication/index');
			}
		}
	}

	public function submit_edit(){
		$sess = $this->session->userdata('pub_data');
		$data['rec_id'] = $sess['rec_id'];
		$data['title'] = $this->input->post('title');
		$data['type_id'] = $sess['type_id'];
		if ($data['type_id'] == 1 || $data['type_id']==2 || $data['type_id']==3 || $data['type_id']==4)
			$data['name'] = $this->input->post('publication_name');
		$data['begin_date'] = (new DateTime($this->input->post('begin_date')));
		$data['begin_date'] = $data['begin_date']->format('Y-m-d h:i:s');
		$data['place'] = '';
		$data['vol_no'] = '';
		$data['place'] = '';
		$data['issue_no'] = '';
		$data['end_date'] = '';
		$data['edition'] = '';
		$data['publisher'] = '';
		$data['chapter_name'] = '';
		$data['chapter_no'] = '';
		$data['isbn_no'] = '';
		$data['page_no'] = '';


		if($data['type_id'] == '1' || $data['type_id'] =='2'){
			$data['vol_no'] = $this->input->post('vol_no');
			$data['issue_no'] = $this->input->post('issue_no');
		}
		else if($data['type_id'] == '3' || $data['type_id'] =='4'){
			$data['place'] = $this->input->post('place');
			$data['page_no'] = $this->input->post('page_no');
			$data['end_date'] = (new DateTime($this->input->post('end_date')));
			$data['end_date'] = $data['end_date']->format('Y-m-d h:i:s');
		}
		else if ($data['type_id'] == '5'){
			$data['publisher'] = $this->input->post('publisher');
			$data['edition'] = $this->input->post('edition');
			$data['isbn_no'] = $this->input->post('isbn_no');
		}
		else if ($data['type_id'] == '6'){
			$data['publisher'] = $this->input->post('publisher');
			$data['chapter_name'] = $this->input->post('chapter_name');
			$data['chapter_no'] = $this->input->post('chapter_no');
			$data['isbn_no'] = $this->input->post('isbn_no');
		}
		$data['page_no'] = $this->input->post('page_no');
		$data['other_info'] = $this->input->post('other_info');
		$data['no_of_authors'] = $sess['no_of_authors'];
		$data['other_authors'] = $sess['other_authors'];
		$data['no_of_approval'] = $sess['other_authors'] + 1;
		
		$co_authors = $this->basic_model->get_ism_author_detail_by_pub($sess['rec_id']);
		for($i=0;$i<$data['no_of_authors']-$data['other_authors'];$i++){
			if($this->session->userdata('id') != $co_authors[$i]->id){
				$pub_name = $this->basic_model->get_prk_types($data['type_id']);
				$description = $this->session->userdata("name")." has edited a ".$pub_name[0]->type_name." with title: ".$data['title'].". Please check the content and approve the edit.";
				$title = "Edited Publication needs Approval";
				$link = "publication/publication/approve";
				$this->notification->notify($co_authors[$i]->id,"emp",$title,$description,$link,"");
			}
		}
		if($this->basic_model->update_publication_record($data)){
			$data['current_user_emp_id'] = $this->session->userdata('id');
			if($this->basic_model->update_ism_authors($data)){
				$this->session->set_flashdata("flashSuccess","Updated Publication");
			}
		}
		else{
			$this->session->set_flashdata("flashError","There was some error. Please Try again Later.");	
		}
		redirect('publication/publication/editpublication');
	}
	
	public function view(){
		$temp = array();
		$temp['emp_id'] = $this->session->userdata('id');
		$temp['publications'] = $this->basic_model->get_own_publications($temp);
		$data['flag'] = 0;
		$i=0;
		foreach($temp['publications'] as $pub){
			$data['publications'][$i] = array();
			$data['publications'][$i]['rec_id'] = $pub->rec_id;
			$data['publications'][$i]['title'] = $pub->title;
			$data['publications'][$i]['name'] = $pub->name;
			$data['publications'][$i]['no_of_authors'] = $pub->no_of_authors;
			$data['publications'][$i]['other_authors'] = $pub->other_authors;
			$data['publications'][$i]['authors']['ism'] = $this->basic_model->get_ism_author_detail_by_pub($pub->rec_id);
			$data['publications'][$i]['type_name'] = $pub->type_name;
			$data['publications'][$i]['type_id'] = $pub->type;
			$data['publications'][$i]['vol_no'] = $pub->vol_no;
			$data['publications'][$i]['edition'] = $pub->edition;
			$data['publications'][$i]['publisher'] = $pub->publisher;
			$data['publications'][$i]['isbn_no'] = $pub->isbn_no;
			$data['publications'][$i]['chapter_name'] = $pub->chapter_name;
			$data['publications'][$i]['chapter_no'] = $pub->chapter_no;
			$data['publications'][$i]['issue_no'] = $pub->issue_no;
			$data['publications'][$i]['begin_date'] = $pub->begin_date;
			$data['publications'][$i]['page_no'] = $pub->page_no;
			$data['publications'][$i]['place'] = $pub->place;
			$data['publications'][$i]['end_date'] = $pub->end_date;
			if($data['publications'][$i]['other_authors'] > 0){
				$data['publications'][$i]['authors']['others'] = $this->basic_model->get_other_author_detail_by_pub($pub->rec_id);
			}
			$data['flag'] = 1;
			$i++;
		}
		$own_name = array();
		$own_name = $this->basic_model->get_name_of_author_by_emp_id($this->session->userdata('id'));
		$data['own_name'] = $own_name[0]->name;
		$this->drawHeader('Search Publication');
		$this->load->view('publication/view_own_publications',$data);
		$this->drawFooter();
		
	}
	public function search_result(){
		$temp = array();
		$temp['dept_id'] = $this->input->post('department_name');
		$temp['emp_id'] = $this->input->post('faculty_name');
		$temp['type_id'] = $this->input->post('type_of_pub');
		$temp['begin_date'] = $this->input->post('begin_date');
		$temp['end_date'] = $this->input->post('end_date');
		$temp['publications'] = $this->basic_model->search($temp);
		if(count($temp['publications']) > 0){
			$i=0;
			foreach($temp['publications'] as $pub){
				$data['publications'][$i] = array();
				$data['publications'][$i]['rec_id'] = $pub->rec_id;
				$data['publications'][$i]['title'] = $pub->title;
				$data['publications'][$i]['name'] = $pub->name;
				$data['publications'][$i]['no_of_authors'] = $pub->no_of_authors;
				$data['publications'][$i]['other_authors'] = $pub->other_authors;
				$data['publications'][$i]['authors']['ism'] = $this->basic_model->get_ism_author_detail_by_pub($pub->rec_id);
				$data['publications'][$i]['type_name'] = $pub->type_name;
				$data['publications'][$i]['type_id'] = $pub->type;
				$data['publications'][$i]['vol_no'] = $pub->vol_no;
				$data['publications'][$i]['issue_no'] = $pub->issue_no;
				$data['publications'][$i]['edition'] = $pub->edition;
				$data['publications'][$i]['isbn_no'] = $pub->isbn_no;
				$data['publications'][$i]['issue_no'] = $pub->issue_no;
				$data['publications'][$i]['publisher'] = $pub->publisher;
				$data['publications'][$i]['chapter_name'] = $pub->chapter_name;
				$data['publications'][$i]['chapter_no'] = $pub->chapter_no;
				$data['publications'][$i]['begin_date'] = $pub->begin_date;
				$data['publications'][$i]['page_no'] = $pub->page_no;
				$data['publications'][$i]['place'] = $pub->place;
				$data['publications'][$i]['end_date'] = $pub->end_date;
				if($data['publications'][$i]['other_authors'] > 0){
					$data['publications'][$i]['authors']['others'] = $this->basic_model->get_other_author_detail_by_pub($pub->rec_id);
				}

				$i++;
			}
			$this->drawHeader('Edit Publication');
			$this->load->view('publication/search_result.php',$data);
			$this->drawFooter();
		}
		else{
			$this->session->set_flashdata("flashError","No Result for the Search");
				redirect('publication/publication/view');
		}
	}

	public function approve($rec_id=''){
		if($rec_id != ''){
			//var_dump($this->basic_model->approve_user_pub($rec_id,$this->session->userdata('id')));
			if($this->basic_model->approve_user_pub($rec_id,$this->session->userdata('id'))){
				$this->session->set_flashdata("flashSuccess","You Approved the Publication");
				redirect('publication/publication/approve');
			}
			else{
				$this->session->set_flashdata("flashError","There was some Error. Please try again later");
				redirect('publication/publication/approve');
			}
		}
		else{
			$temp['publications'] = $this->basic_model->get_not_approved_user_pub($this->session->userdata('id'));
			$data = array();
			if(count($temp['publications']) > 0){
				$i=0;
				foreach($temp['publications'] as $pub){
					$data['publications'][$i] = array();
					$data['publications'][$i]['rec_id'] = $pub->rec_id;
					$data['publications'][$i]['title'] = $pub->title;
					$data['publications'][$i]['name'] = $pub->name;
					$data['publications'][$i]['type_id'] = $pub->type_id;
					$data['publications'][$i]['place'] = $pub->place;
					$data['publications'][$i]['vol_no'] = $pub->vol_no;
					$data['publications'][$i]['issue_no'] = $pub->issue_no;
					$data['publications'][$i]['edition'] = $pub->edition;
					$data['publications'][$i]['isbn_no'] = $pub->isbn_no;
					$data['publications'][$i]['publisher'] = $pub->publisher;
					$data['publications'][$i]['chapter_name'] = $pub->chapter_name;
					$data['publications'][$i]['chapter_no'] = $pub->chapter_no;
					$data['publications'][$i]['begin_date'] = $pub->begin_date;
					$data['publications'][$i]['end_date'] = $pub->end_date;
					$data['publications'][$i]['page_no'] = $pub->page_no;
					$data['publications'][$i]['no_of_authors'] = $pub->no_of_authors;
					$data['publications'][$i]['other_authors'] = $pub->other_authors;
					$data['publications'][$i]['authors']['ism'] = $this->basic_model->get_ism_author_detail_by_pub($pub->rec_id);

					if($data['publications'][$i]['other_authors'] > 0){
						$data['publications'][$i]['authors']['others'] = $this->basic_model->get_other_author_detail_by_pub($pub->rec_id);
					}

					$i++;
				}
				$this->drawHeader('Edit Publication');
				$this->load->view('publication/approve.php',$data);
				$this->drawFooter();
			}
			else{
				$this->session->set_flashdata("flashSuccess","You don't have any Publication to Approve");
				redirect('publication/publication/index');
			}
		}
	}
	public function decline_view($rec_id=''){
		$data = array();
		$data['rec_id']=$rec_id;
		$data['emp_id']=$this->session->userdata('id');
		$this->drawHeader('Decline Publication');
		$this->load->view('publication/decline.php',$data);
		$this->drawFooter();
	}

	public function decline_action(){
		$data = array();
		$data['rec_id'] = $this->input->post('rec_id');
		$data['reason'] = $this->input->post('reason');
		$this->basic_model->remove_own_from_publication($data['rec_id'],$this->session->userdata('id'));
		$this->basic_model->decrease_no_of_approval_after_decline($data['rec_id']);
		$data['ism_authors'] = $this->basic_model->get_approved_author($data['rec_id']);
		foreach ($data['ism_authors'] as $authors){
			$temp = $this->basic_model->get_name_of_author_by_emp_id($this->session->userdata('id'));
			$title = "Declining of Publication by ".$temp[0]->name;
			$description = $data['reason'];
			$link = "publication/publication/view";
			$this->notification->notify($authors->emp_id,"emp",$title,$description,$link,"");
		}
		$this->session->set_flashdata("flashSuccess","Successfully declined the publication.");
		redirect('publication/publication/approve');
		
	}
}

?>