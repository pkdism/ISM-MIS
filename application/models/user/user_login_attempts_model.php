<?php

class User_login_attempts_model extends CI_Model
{

	var $table = 'user_login_attempts';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	function insert($data)
	{
		$this->db->insert($this->table,$data);
	}
}

/* End of file user_login_attempts_model.php */
/* Location: mis/application/models/user/user_login_attempts_model.php */