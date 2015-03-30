<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Manufacturer_model extends CI_Model

{
	var $table = 'hc_manufacturer';
	
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
	
	function getAll_Manu()
	{
			
			$query = $this->db->query("SELECT * FROM hc_manufacturer");
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	function getAll_Manu_byID($id)
	{
			
			$query = $this->db->select("*");
			$query = $this->db->from('hc_manufacturer');
			$query = $this->db->where('manu_id',$id);
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
	function delete_ManuBy_id($id)
	{
		$this->db->where('manu_id', $id);
		$this->db->delete('hc_manufacturer');
	}
	
	function update_manu($id,$data){
     $this->db->where('manu_id', $id);
     $this->db->update('hc_manufacturer', $data);  
    }

}

?>