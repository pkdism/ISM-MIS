<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Supplier_model extends CI_Model

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
	
	function getAll_Suppliers()
	{
			
			$query = $this->db->query("SELECT * FROM hc_supplier");
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	function get_states()
	{
			/*$this->db->from('states');
			$this->db->order_by('name');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['name']] = $row['name'];
			}
			}			return $return;*/
			
			$this->db->from('states');
			$this->db->order_by('name');
			$query = $this->db->get();
			$query_result = $query->result();
			return $query_result;

	
			
	}
	function get_st_name($id)
	{
			
			$query = $this->db->get_where('states', array('id' => $id));
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	
	
	
	function get_Supp_Manu()
	{
			
			$query = $this->db->query("SELECT hc_supplier.s_name, hc_manufacturer.manu_name
FROM (hc_supplier INNER JOIN hc_supp_manu ON hc_supplier.s_id = hc_supp_manu.s_id) INNER JOIN hc_manufacturer ON hc_supp_manu.manu_id = hc_manufacturer.manu_id;
");
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	
	function get_Manu_by_suppID($id)
	{
			
			$query = $this->db->query("SELECT hc_manufacturer.manu_id, hc_manufacturer.manu_name FROM hc_manufacturer INNER JOIN (hc_supplier INNER JOIN hc_supp_manu ON hc_supplier.s_id = hc_supp_manu.s_id) ON hc_manufacturer.manu_id = hc_supp_manu.manu_id WHERE hc_supplier.s_id='".$id."'");
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	
	function get_suppName_byID($id)
	{
		$this->db->select('s_name');
		$this->db->from($this->table);
		$this->db->where('s_id',$id);
		$query=$this->db->get();
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	function get_manuName_byID($id)
	{
		$this->db->select('manu_name');
		$this->db->from('hc_manufacturer');
		$this->db->where('manu_id',$id);
		$query=$this->db->get();
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	

}

?>