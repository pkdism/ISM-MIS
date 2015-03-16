<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ui_example extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('user_model','users',TRUE);
	}

	function index() {
		$this->addJS('ui_example/user-loader.js');
		$this->drawHeader("A UI Library Demo", "See <a href='#'>views/ui_tester/example.php</a> for the source");
		$this->load->view('ui_example/example', array("users" => $this->users->getUsersByDeptAuth()));
		$this->drawFooter();
	}
	
	/*
	 * Just an example. Loads a large amount of data.
	 */
	function loadUsers() {
		$this->load->view("ui_example/users_list", array("users" => $this->users->getUsersByDeptAuth()));
	}
}