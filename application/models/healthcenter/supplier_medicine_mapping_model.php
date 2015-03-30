<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Supplier_medicine_mapping_model extends CI_Model

{
	var $table_supp = 'hc_supplier';
	var $table_manu = 'hc_manufacturer';
	var $table_supp_manu='hc_supp_manu';
	
	
	public function __construct() 
    { 
        parent::__construct(); 
       
    } 
	
		function get_supplier_list()
		{
			$this->db->from($this->table_supp);
			$this->db->order_by('s_name');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['s_id']] = $row['s_name'];
			}
			}

					return $return;

		}
		function get_supplier_list1()
		{
			$this->db->from($this->table_supp);
			$this->db->order_by('s_name');
			$query = $this->db->get();
			$query_result = $query->result();
			return $query_result;
					
			

		}
		
		function get_manu_list()
		{
			$this->db->from($this->table_manu);
			$this->db->order_by('manu_name');
			$query = $this->db->get();
			$query_result = $query->result();
			return $query_result;

		}
		function get_manu_list1()
		{
			$this->db->from($this->table_manu);
			$this->db->order_by('manu_name');
			$result = $this->db->get();
			//$query_result = $query->result();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['manu_id']] = $row['manu_name'];
			}
			}

					return $return;

		}
		
		function insert($data)
		{
			if($this->db->insert($this->table_supp_manu,$data))
				return TRUE;
			else
				return FALSE;
		}

}

?>