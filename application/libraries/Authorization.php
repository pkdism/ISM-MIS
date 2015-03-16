<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	 * Authorization
	 *
	 *
	 */
class Authorization
{

	var $CI;

	public function __construct()
	{
		log_message('debug', "Authorization Class Initialized");

		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
	}

	function auth($args = array())
	{
		//$args = func_get_args();

		if(!($this->CI->session->userdata('isLoggedIn') && $this->login_check()))
			return false;

		if(sizeof($args) == 0) return true;
		foreach($args as $aid) if($this->is_auth($aid)) return true;
		return false;
	}

	function is_auth($auth, $module = "")
	{
		if($auth == "")    return false;
		if($auth != "deo") return in_array($auth , $this->CI->session->userdata('auth'));
		else
		{
/*			if($module == "")
			{
				// This is a bad hack! Using debug_backtrace to find the module where the function was called.
				$backtrace = debug_backtrace();
				$module = _moduleFromURL($backtrace[sizeof($backtrace)-1]['file']);
			}

			$query = $this->CI->db->get_where("deo_modules", array('id' => $this->CI->session->userdata('id')));
			$deoRes = $query->result();
			$deoModules = array();
			foreach ($deoRes as $row) {
			 	array_push($deoModules, $row->module_id);
			 }
*/			return (in_array($auth, $this->CI->session->userdata('auth')));
//			return (in_array($auth, $this->CI->session->userdata('auth')) && in_array($module, $deoModules));
		}
	}



	function login_check()
	{
		if($this->CI->session->userdata('id') && $this->CI->session->userdata('login_string') )
		{
			$user_id = $this->CI->session->userdata('id');
			$login_string = $this->CI->session->userdata('login_string');
			$user_browser = $this->CI->session->userdata('user_agent');

			if($query = $this->CI->db->get_where("users",array("id" => $user_id)))
			{
				if($query->num_rows == 1)
				{
					$row = $query->row();
					$password = $row->password;
					return (hash('sha512', $password . $user_browser) == $login_string);
				}
			}
		}
		return false;
	}

	function check_brute($user_id) {
		return true;
	}

	function encode_password($pass, $created_date)
	{
		$date = strtotime($created_date);
		$year = date('Y', $date);
		$salt = 'ISM';

		$tempHash = $pass . (string)$date . (string)$salt;
		for($i=0; $i < $year; $i++) $tempHash = md5($tempHash);
		return $tempHash;
	}

	function error($message)
	{
		//header("Location: Error.php?err=".urlencode($message));
		exit();
	}

	function strclean($str)
	{
		//global $mysqli;
		$str = @trim($str);
		if(get_magic_quotes_gpc()) $str = stripslashes($str);
		return $this->CI->db->escape_str($str);
	}

	function esc_url($url)
	{

		if ('' == $url) return $url;

		$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

		$strip = array('%0d', '%0a', '%0D', '%0A');
		$url = (string) $url;

		$count = 1;
		while ($count) $url = str_replace($strip, '', $url, $count);

		$url = str_replace(';//', '://', $url);
		$url = htmlentities($url);
		$url = str_replace('&amp;', '&#038;', $url);
		$url = str_replace("'", '&#039;', $url);

		if ($url[0] !== '/') return '';
		else return $url;
	}
}
