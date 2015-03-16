<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Get_residence_address_ajax extends MY_Controller
{
	public function __construct()
	{
		parent::__construct(array('emp','stu'));
	//	$this->addJS ("file_tracking/file_tracking_script.js");
	//	$this->addCSS("file_tracking/file_tracking_layout.css");
	}

	public function index()
	{
		$emp_id = $this->session->userdata('id');
		$this->load->model('user/user_address_model', '', TRUE);
		$res_address = $this->user_address_model->getAddrById ($emp_id, 'present');
		if (!$res_address)
			echo "";
		else
		{
			$address = $res_address->line1.' '.((trim($res_address->line2)=='')? '':$res_address->line2.' ')
                    .ucwords($res_address->city).', '.ucwords($res_address->state).' - '.$res_address->pincode;
			echo $address;
		}
	}
}