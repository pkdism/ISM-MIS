<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_post extends MY_Controller
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
		
		$this->load->model('guard/guard_model');
		
		if($this->input->post('addsubmit') == TRUE)
		{
			$date = date("Y-m-d",strtotime(date("Y-m-d"))+19800);
			$numberofguards = $this->input->post('number_a') + $this->input->post('number_b') + $this->input->post('number_c');
			
			$data = array('post_id'=>$this->input->post('post_id'),
					  'postname'=>$this->input->post('postname'),
					  'ipaddress'=>$this->input->post('ipaddress'),
					  'number_a'=>$this->input->post('number_a'),
					  'number_b'=>$this->input->post('number_b'),
					  'number_c'=>$this->input->post('number_c'),
					  'numberofguards'=>$numberofguards,
					  'added_on'=>$date
					  );		
			
			$this->guard_model->add_post($data);
			$this->session->set_flashdata('flashSuccess','Post has been added successfully');
			redirect('guard/manage_post/add');
		}
		
		$data['id'] = $this->guard_model->get_max_post_id();
		$this->drawHeader('Add Post');
		$this->load->view('guard/add_post',$data);
		$this->drawFooter();
	}
	
	function view()
	{
		$this->load->model('guard/guard_model');
		$data['details_of_posts'] = $this->guard_model->get_details_of_posts();
		$data['details_of_posts_archive'] = $this->guard_model->get_details_of_posts_archive();
		
		$this->drawHeader('View Posts Detail');
		$this->load->view('guard/view_posts_detail',$data);
		$this->load->view('guard/view_footer');
		$this->drawFooter();
	}
	
	function remove($post_id='')
	{
		
		if($post_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
			
		$this->load->model('guard/guard_model');
		
		$data = $this->guard_model->get_details_of_a_postname($post_id);
		$data['removed_on'] = date("Y-m-d",strtotime(date("Y-m-d"))+19800);
		
		$this->guard_model->add_into_archive($data);
		
		$this->guard_model->remove($post_id);
		
		$this->session->set_flashdata('flashSuccess','Post has been removed successfully.');
		redirect('guard/manage_post/view');
	}
	
	function edit($post_id='')
	{
		
		if($this->input->post('savesubmit') == TRUE)
		{
			
				
			$total = $this->input->post('number_a') + $this->input->post('number_b') + $this->input->post('number_c');
			$data = array('post_id'=>$this->input->post('post_id'),
						  'postname'=>$this->input->post('postname'),
						  'ipaddress'=>$this->input->post('ipaddress'),
						  'numberofguards'=>$total,
						  'number_a'=>$this->input->post('number_a'),
						  'number_b'=>$this->input->post('number_b'),
						  'number_c'=>$this->input->post('number_c')
						  );		

			$this->load->model('guard/guard_model');
			$this->guard_model->update_post($data);
			
			$this->session->set_flashdata('flashSuccess','Post Details have been updated successfully');
			redirect('guard/manage_post/view');
		}
		
		if($post_id=='')
		{
			$this->session->set_flashdata('flashError','Access Denied!');
			redirect('home');
		}
		$this->load->model('guard/guard_model');
		
		$data['details_of_a_postname'] = $this->guard_model->get_details_of_a_postname($post_id);
		
		$this->drawHeader('Edit Post Details');
		$this->load->view('guard/edit_post_details',$data);
		$this->drawFooter();
	}
	
}

?>