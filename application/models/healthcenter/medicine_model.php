<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Medicine_model extends CI_Model

{
	var $table = 'hc_medicine';
	var $manuf = 'hc_manufacturer';
	var $m_receive = 'hc_medi_receive';
	var $t_po='hc_pur_order';
	var $hc ='hc_indent_description';
	
	
	
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
	
	
	
	
	function get_medicine_list()
		{
			$this->db->from($this->table);
			$this->db->order_by('m_name');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['m_id']] = $row['m_name'];
			}
			}

					return $return;

		}
		function get_medicine_list1()
		{
			$this->db->from($this->table);
			$this->db->order_by('m_name');
			$query = $this->db->get();
			$query_result = $query->result();
			return $query_result;
		
		}
		
		function get_supplier_bymedicineid($med_id)
	{
		
		$query = $this->db->query("SELECT hc_supplier.s_name,hc_supplier.s_id
FROM ((hc_medicine INNER JOIN hc_manufacturer ON hc_medicine.manu_id = hc_manufacturer.manu_id) INNER JOIN hc_supp_manu ON hc_manufacturer.manu_id = hc_supp_manu.manu_id) INNER JOIN hc_supplier ON hc_supp_manu.s_id = hc_supplier.s_id
WHERE hc_medicine.m_id='".$med_id."'");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	}
	// For auto complete////
	
	function getAMed($id=''){
			$row_set=array();
			$query= $this->db->select('m_id, m_name')->like('m_name',$id);
			$q = $query->get($this->table);
			
			 if($q->num_rows > 0)
			 {
				foreach($q->result_array() as $row)
				{
					$new_row['label']=htmlentities(stripslashes($row['m_name']));
					$new_row['value']=htmlentities(stripslashes($row['m_name']));
					$row_set[] = $new_row; //build an array
				}
			 }
			echo json_encode($row_set); //format the array into json data
	}
	function getMedcineIdByName($id,$t='')
	{
		$this->db->select('*');
            $this->db->from('hc_medicine a'); 
            $this->db->join('hc_manufacturer b', 'b.manu_id=a.manu_id', 'left');
            $this->db->where('LOWER(a.m_name)',$id);
          //  $this->db->order_by('c.track_title','asc');         
            $q = $this->db->get(); 	
			
                   	
		if($q->num_rows > 0)
		{
			if($t)
			return $q->result_array();
		
			return $q->result();
		}
	}
	
	function getMedicineById($id,$t='')
	{
			$this->db->select('*');
            $this->db->from('hc_medicine a'); 
            $this->db->join('hc_manufacturer b', 'b.manu_id=a.manu_id', 'left');
            $this->db->join('hc_medi_receive c', 'c.m_id=a.m_id', 'left');
            $this->db->where('a.m_id',$id);
          //  $this->db->order_by('c.track_title','asc');         
            $q = $this->db->get(); 	
			
                   	
		if($q->num_rows > 0)
		{
			if($t)
			return $q->result_array();
		
			return $q->result();
		}
	}
	function get_po_indent()
	{
		$this->db->from($this->t_po);
			$this->db->order_by('po_refno');
			$this->db->where('DATEDIFF(now(),po_date)<=',30);
			
			$result = $this->db->get();
			
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['po_id']] = $row['po_refno'];
			}
			}

					return $return;
	}
	
	function get_po_outdated()
	{
			$this->db->from($this->t_po);
			$this->db->order_by('po_refno');
			$this->db->where('DATEDIFF(now(),po_date)>=',30);
			
			$result = $this->db->get();
			
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['po_id']] = $row['po_refno'];
			}
			}

					return $return;
	}
	
	function get_medi_list($id,$t="")
	{
		$query = $this->db->query("SELECT hc_pur_order.po_id,hc_medicine.m_id,hc_medicine.m_name, hc_indent_description.ind_qty, hc_indent_description.std_pkt, hc_indent_description.app_rate
		FROM (hc_pur_order INNER JOIN hc_indent_description ON hc_pur_order.indent_id = hc_indent_description.indent_id) INNER JOIN hc_medicine ON hc_indent_description.m_id = hc_medicine.m_id
		WHERE hc_pur_order.po_id='".$id."'");
		
		
		if($t==1)
		return	$query->result_array();
		else
		return	$query->result();
		
		
		
	}
	
	function insertMedR($data)
	{
		if($this->db->insert($this->m_receive,$data))
			return TRUE;
		else
			return FALSE;
	}
	
	function getAll_Medicine()
	{
			
			
			$this->db->select('*');
			$this->db->from('hc_medicine');
			$this->db->join('hc_manufacturer', 'hc_medicine.manu_id = hc_manufacturer.manu_id');
			 
			$query = $this->db->get();
						
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	function getAll_Medicine_stock($medi_id)
	{
	$sql= "SELECT 
  `hc_medicine`.`m_id`,
  `hc_medicine`.`m_name`,
  `hc_manufacturer`.`manu_name`,
  `hc_medi_receive`.`supp_date`,
  `hc_medicine`.`rack_no`,
  `hc_medicine`.`cabi_no`,
  `hc_medicine`.`c_stock`,
  `hc_medicine`.`threshold`
FROM
  `hc_medi_receive`
  INNER JOIN `hc_medicine` ON (`hc_medi_receive`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
WHERE
  1 = 1

  ";
		if ($medi_id)
			{
					$sql .= " AND hc_medicine.m_id='".$medi_id."'";
			}
			
			
			$query = $this->db->query($sql);
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
			
			
	}
	
	function getMrecQtyById($id){
		
		$q=$this->db->select_sum('mrec_qty')->get_where($this->m_receive,array('m_id'=>$id));
		return $q->row();
	}
	
	function get_Medi_By_ManuID($id)
	{
			
			/*$this->db->select('*');
			$this->db->from($this->table);
			$this->db->join($this->manuf, $this->table.manu_id = $this->manuf.manu_id); 
 			$query = $this->db->get();*/
			
			//$query = $this->db->query("SELECT * FROM hc_medicine");
			$this->db->select('*');
			$this->db->from('hc_medicine');
			$this->db->join('hc_manufacturer', 'hc_medicine.manu_id = hc_manufacturer.manu_id');
			 $this->db->where('hc_manufacturer.manu_id',$id);
			$query = $this->db->get();
						
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}
	
	function getMqtybyPo($id,$t=""){
			
			$q=$this->db->get_where($this->m_receive,array('po_id'=>$id));
			if($q->num_rows() >0){
				if($t){
					return $q->result_array();	
				}else{
				return $q->result();	
					}
			}
			else 
				return false;
		
	}
	function getMedi_rec()
	{
				
			$query = $this->db->query("SELECT 
  `hc_medicine`.`m_name`,
  `hc_indent_description`.`ind_qty`,
  `hc_medi_receive`.`mrec_qty`,
  `hc_medi_receive`.`mfg_date`,
  `hc_medi_receive`.`exp_date`,
  `hc_medi_receive`.`batch_no`,
  `hc_medi_receive`.`supp_date`,
  `hc_medi_receive`.`mrp`,
  `hc_medi_receive`.`rate_of_pur`,
  `hc_medi_receive`.`amount`,
  `hc_pur_order`.`po_refno`
FROM
  `hc_medi_receive`
  INNER JOIN `hc_medicine` ON (`hc_medi_receive`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_indent_description` ON (`hc_medicine`.`m_id` = `hc_indent_description`.`m_id`)
  INNER JOIN `hc_pur_order` ON (`hc_medi_receive`.`po_id` = `hc_pur_order`.`po_id`)
");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
	}
	
	function get_manu_name($id)
	{
			$this->db->select('*');
			$this->db->from('hc_medicine');
			$this->db->join('hc_manufacturer', 'hc_medicine.manu_id = hc_manufacturer.manu_id');
			 $this->db->where('hc_medicine.m_id',$id);
			$query = $this->db->get();
						
			if($query->num_rows() > 0)
			{	
				
			return $query->result_array();
			}
			else
			{
				return FALSE;
			}
	}
	function getAll_MedicineName()
	{
			
			$this->db->from($this->table);
			$this->db->order_by('m_name');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['m_id']] = $row['m_name'];
			}
			}

					return $return;
	}
	
	function getMedByGroup($g){
		$q=$this->db->get_where($this->table,array('m_generic_nm'=>$g));
		if($q->num_rows() > 0){
			return $q->result_array();
		}
		
		
	}
	
	function getAll_Medi_byID($id)
	{
			
			/*$query = $this->db->select("*");
			$query = $this->db->from('hc_medicine');
			$query = $this->db->where('m_id',$id);
			$query=$this->db->get();
			if($query->num_rows() > 0)
			{	
				
			return $query->result();
			}
			else
			{
				return FALSE;
			}*/
			$this->db->select('*');
			$this->db->from('hc_medicine');
			$this->db->join('hc_manufacturer', 'hc_medicine.manu_id = hc_manufacturer.manu_id');
			 $this->db->where('hc_medicine.m_id',$id);
			$query = $this->db->get();
						
			if($query->num_rows() > 0)
			{	
				
			return $query->result_array();
			}
			else
			{
				return FALSE;
			}
	}
	function update_medi($id,$data){
     $this->db->where('m_id', $id);
     $this->db->update('hc_medicine', $data);  
    }
	function delete_MediBy_id($id)
	{
		$this->db->where('m_id', $id);
		$this->db->delete('hc_medicine');
		if ( $this->db->affected_rows() >0 ) {return TRUE;}
			else {return FALSE;}
		
	}

}

?>