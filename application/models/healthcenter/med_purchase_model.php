<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Med_purchase_model extends CI_Model

{
	var $table = 'hc_supplier';
	
	public function __construct() 
    { 
        parent::__construct(); 
       
    } 
	
	
	
	
	function insert($data)
	{
		if($this->db->insert($this->table,$data))
			return TRUE;
		else
			return FALSE;
	}

}

?>