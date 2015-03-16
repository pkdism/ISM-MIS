<?php

class User_model extends CI_Model
{

	public $models = array('user/users_model',
							'user/user_details_model',
							'user/user_other_details_model',
							'user/user_address_model');

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->model($this->models,'',TRUE);
	}

	function getById($id = '')
	{
		$users = $this->users_model->getUserById($id);
		$user_details = $this->user_details_model->getUserById($id);
		$user_other_details = $this->user_other_details_model->getUserById($id);
		if($users && $user_details && $user_other_details)
			return (object)(array_merge((array)$users,(array)$user_details,(array)$user_other_details));
		else
			return FALSE;
	}

	function getPhotoById($id = '')
	{
		$user_details = $this->user_details_model->getUserById($id);
		if($user_details)
			return $user_details->photopath;
		else
			return FALSE;
	}

	function getNameById($id = '')
	{
		$user_details = $this->user_details_model->getUserById($id);
		if(!$user_details)
			return FALSE;
		$name = $user_details->salutation;
		$name .= '. '.ucwords(trim($user_details->first_name));
		if($user_details->middle_name != '')
			$name .= ' '.ucwords(trim($user_details->middle_name));
		if($user_details->last_name != '')
			$name .= ' '.ucwords(trim($user_details->last_name));

		return $name;
	}

	function getEmailById($id = '')
	{
		$user_details = $this->user_details_model->getUserById($id);
		if($user_details)
			return $user_details->email;
		else
			return FALSE;
	}

	function getAddressById($id = '')
	{
		$permanent_address = $this->user_address_model->getAddrById($id,'permanent');
		$present_address = $this->user_address_model->getAddrById($id,'present');
		if(!$permanent_address || !$present_address)
			return FALSE;

		$permanent_pretty = $permanent_address->line1.',<br>'.((trim($permanent_address->line2)=='')? '':$permanent_address->line2.',<br>')
                    .ucwords($permanent_address->city).', '.ucwords($permanent_address->state).' - '.$permanent_address->pincode.'<br>'
                    .ucwords($permanent_address->country).'<br>
                    Contact no. '.$permanent_address->contact_no;

        $present_pretty = $present_address->line1.',<br>'.((trim($present_address->line2)=='')? '':$present_address->line2.',<br>')
                    .ucwords($present_address->city).', '.ucwords($present_address->state).' - '.$present_address->pincode.'<br>'
                    .ucwords($present_address->country).'<br>
                    Contact no. '.$present_address->contact_no;

		return (object)(array('permanent'=>$permanent_address,
								'present'=>$present_address,
								'permanent_pretty'=>$permanent_pretty,
								'present_pretty'=>$present_pretty));
	}

	function getEmpByCategory($category)
	{
		$query = $this->db->select('users.id, salutation, first_name, middle_name, last_name')
							->from('user_details')
							->join('users','users.id = user_details.id')
							->where('category',$category)
							->where('auth_id','emp')
							->get();
		return $query->result();
	}

	function getUsersByDeptAuth($dept = 'all',$auth = 'all')
	{
		$query = $this->db->select('user_details.id, salutation, first_name, middle_name, last_name, departments.name as dept_name')
							->from('user_details')
							->join('departments','user_details.dept_id = departments.id');

		if($auth != 'all')	$query = $this->db->join('user_auth_types','user_details.id = user_auth_types.id')
												->where('user_auth_types.auth_id',$auth);
		if($dept != 'all')	$query = $this->db->where('user_details.dept_id',$dept);

		return $query->get()->result();
	}
}

/* End of file user_model.php */
/* Location: mis/application/models/user_model.php */