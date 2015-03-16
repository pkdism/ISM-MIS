<?php if(!defined("BASEPATH")){ exit("No direct script access allowed"); }
	/**
	 * Authorization Extended Controller Class
	 *
	**/
	class MY_Controller extends CI_Controller {

		var $CI;
		var $_js = '';
		var $_css = '';

    	function __construct($args = array())
    	{
	        parent::__construct();
	        $this->CI =& get_instance();
			if(!$this->CI->authorization->auth($args))
				redirect('login/logout/2');

	    	$this->load->model('modules_model', '', TRUE);
	    	$this->load->model('auth_types_model', 'auth_types', TRUE);
			$this->load->model('user/user_notifications_model', '', TRUE);
	    }

        private function getMenuKey($menuItem) {
            //if(is_array($menuItem))
            return "";
        }
        private function menuCmp($a, $b) {
            return strcmp($this->getMenuKey($a), $this->getMenuKey($b));
        }

	    private function getMenu()
	    {
	    	$user_id = $this->CI->session->userdata('id');
	    	$auths = $this->CI->session->userdata('auth');

	    	$modules = $this->modules_model->getModules();

	    	$menu = array();
	    	foreach($auths as $i => $auth)
	    	{
	    		$menu[$auth] = array();
	    		foreach($modules as $row)
	    		{
	    			$module = $row->id;
	    			if(file_exists(APPPATH."models/$module/".$module."_menu_model.php"))
	    			{
	    				$this->load->model($module."/".$module."_menu_model",$module,TRUE);
	    				$model_menu = $this->$module->getMenu();

	    				if(isset($model_menu[$auth]) && is_array($model_menu[$auth]))
	    					$menu[$auth] = array_merge($menu[$auth], $model_menu[$auth]);
	    			}
	    		}
	    	}
	    	return $menu;
	    }

		private function getAuthKeys() {
	    	$auths = $this->CI->session->userdata('auth');
			foreach($auths as $i => $auth) {
				$keys[$auth] = $this->auth_types->getAuthTypeById($auth);
			}
			return $keys;
		}

		private function getNotifications() {
			$auths = $this->CI->session->userdata('auth');
			foreach($auths as $i => $auth) {
				$notifications[$auth]['unread'] = $this->user_notifications_model->getUnreadUserNotifications($this->session->userdata('id'), $auth);
				$notifications[$auth]['read'] = $this->user_notifications_model->getReadUserNotifications($this->session->userdata('id'), $auth);;
			}
			return $notifications;
		}

		function drawHeader($title = "Management Information System", $subtitle = "") {
			$data = array("menu" => $this->getMenu(),
						  "title" => $title,
						  "subtitle" => $subtitle,
						  "javascript" => $this->_js,
						  "css" => $this->_css,
						  "authKeys" => $this->getAuthKeys(),
						  "notifications" => $this->getNotifications());

			$this->load->view("templates/header_assets", $data);
			$this->load->view("templates/header", $data);
		}

		function drawFooter() {
			$this->load->view("templates/footer");
		}

		function addJS($js) {
			$this->_js .= "<script type=\"text/javascript\" src=\"".base_url()."assets/js/".$js." \" ></script>";
		}

		function addCSS($css) {
			$this->_css .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".base_url()."assets/css/".$css."\" />";
		}
	}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */