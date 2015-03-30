<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Indent_model extends CI_Model

{
	var $indent = 'hc_indent';
	var $indent_des = 'hc_indent_description';
	var $t_po='hc_pur_order';
	
	public function __construct() 
    { 
        parent::__construct(); 
       
    } 
	
	function insert_indent($data)
	{
		if($this->db->insert($this->indent,$data))
			return $this->db->insert_id();
		else
			return FALSE;
	}
	
	
	function insert_po($data)
	{
		if($this->db->insert($this->t_po,$data))
			return TRUE;
		else
			return FALSE;
	}
	
	
	function insertIndentDes($data)
	{
		if($this->db->insert($this->indent_des,$data))
			return $this->db->insert_id();
		else
			return FALSE;
	}
	
	function getIndentDesById($id,$t=""){
			$this->db->select('*');
			$this->db->from('hc_indent_description m'); 
            $this->db->join('hc_medicine a','m.m_id=a.m_id'); 
            $this->db->join('hc_manufacturer b', 'b.manu_id=a.manu_id', 'left');
            //$this->db->join('hc_medi_receive c', 'c.m_id=a.m_id', 'left');
			$this->db->where('m.ind_des_id',$id);
		$q= $this->db->get();
		if($t)
		return	$q->result_array();
		else
		return	$q->result();
	}
	
	function getIndent()
	{
		$this->db->from($this->indent);
			$this->db->order_by('indent_ref_no');
			$this->db->where('ind_type','n');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['indent_id']] = $row['indent_ref_no'];
			}
			}

					return $return;
	}
	function get_Emer_Indent()
	{
		$this->db->from($this->indent);
			$this->db->order_by('indent_ref_no');
			$this->db->where('ind_type','e');
			$result = $this->db->get();
			$return = array();
			if($result->num_rows() > 0) {
			foreach($result->result_array() as $row) {
			$return[$row['indent_id']] = $row['indent_ref_no'];
			}
			}

					return $return;
	}
	function getPODetailByID($id)
	{
				
		$query = $this->db->query("SELECT hc_medicine.m_name, hc_indent_description.std_pkt, hc_indent_description.ind_qty
FROM (hc_pur_order INNER JOIN hc_indent_description ON hc_pur_order.indent_id = hc_indent_description.indent_id) INNER JOIN hc_medicine ON hc_indent_description.m_id = hc_medicine.m_id
WHERE hc_pur_order.po_refno='".$id."' group by hc_medicine.m_name");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
		
	}
	
	function delete_indent($id)
	{
		$this->db->where('ind_des_id', $id);
		$this->db->delete('hc_indent_description');
		
	}
	
	function getAll_Indent()
	{
				
		$query = $this->db->query("SELECT hc_indent.ind_type,hc_indent.indent_id,hc_indent.indent_ref_no, hc_indent.indent_date, hc_supplier.s_name FROM hc_indent INNER JOIN hc_supplier ON hc_indent.s_id = hc_supplier.s_id;
");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
		
	}
	
	function getAll_PO()
	{
				
		$query = $this->db->query(" SELECT hc_pur_order.po_id,hc_pur_order.po_refno, hc_pur_order.po_date, hc_indent.indent_ref_no, hc_supplier.s_name FROM (hc_indent INNER JOIN hc_pur_order ON hc_indent.indent_id = hc_pur_order.indent_id) INNER JOIN hc_supplier ON hc_indent.s_id = hc_supplier.s_id; ");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
		
	}
	
	function get_indentbyId($id)
	{
				$idt=trim($id);
				
		/*$query = $this->db->query("SELECT hc_medicine.m_name, hc_indent_description.std_pkt, hc_indent_description.app_rate, hc_indent_description.ind_qty, hc_indent_description.app_cost FROM (hc_indent INNER JOIN hc_indent_description ON hc_indent.indent_id = hc_indent_description.indent_id) INNER JOIN hc_medicine ON hc_indent_description.m_id = hc_medicine.m_id WHERE hc_indent.indent_ref_no='".$idt."'");*/
		
		$query = $this->db->query("
		SELECT 
  `hc_medicine`.`m_name`,
  `hc_medicine`.`c_stock`,
  `hc_manufacturer`.`m_group`,
  `hc_manufacturer`.`manu_name`,
  `hc_indent_description`.`std_pkt`,
  `hc_indent_description`.`app_rate`,
  `hc_indent_description`.`ind_qty`,
  `hc_indent_description`.`app_cost`,
  `hc_indent`.`indent_id`,
  `hc_indent`.`indent_ref_no`,
  `hc_supplier`.`s_name`,
  `hc_indent`.`indent_date`
FROM
  `hc_indent_description`
  INNER JOIN `hc_indent` ON (`hc_indent_description`.`indent_id` = `hc_indent`.`indent_id`)
  INNER JOIN `hc_medicine` ON (`hc_indent_description`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
  INNER JOIN `hc_supplier` ON (`hc_indent`.`s_id` = `hc_supplier`.`s_id`)
WHERE
    	`hc_indent`.`indent_id`='".$idt."'");
		
		
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
		
	}
	function get_po_byId($id)
	{
	$query = $this->db->query("
		SELECT hc_medicine.m_name, hc_indent_description.std_pkt, hc_indent_description.ind_qty, hc_supplier.s_name, hc_supplier.s_address1, hc_supplier.s_address2, hc_supplier.s_address3, hc_supplier.s_city, hc_pur_order.po_refno, hc_pur_order.po_date FROM (hc_medicine INNER JOIN hc_indent_description ON hc_medicine.m_id = hc_indent_description.m_id) INNER JOIN ((hc_indent INNER JOIN hc_supplier ON hc_indent.s_id = hc_supplier.s_id) INNER JOIN hc_pur_order ON hc_indent.indent_id = hc_pur_order.indent_id) ON hc_indent_description.indent_id = hc_pur_order.indent_id WHERE hc_pur_order.po_id='".$id."'");
				
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
	
		
	}
	
	
	function get_indent_list($id,$t="")
	{
		$query = $this->db->query("SELECT 
  `hc_medicine`.`m_name`,
  `hc_medicine`.`c_stock`,
  `hc_manufacturer`.`m_group`,
  `hc_manufacturer`.`manu_name`,
  `hc_indent_description`.`std_pkt`,
  `hc_indent_description`.`app_rate`,
  `hc_indent_description`.`ind_qty`,
  `hc_indent_description`.`app_cost`,
  `hc_indent_description`.`m_id`,
  `hc_indent_description`.`ind_des_id`
FROM
  `hc_medicine`
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
  INNER JOIN `hc_indent_description` ON (`hc_medicine`.`m_id` = `hc_indent_description`.`m_id`)
WHERE
  `hc_indent_description`.`indent_id` ='".$id."'");

		
		if($t==1)
		return	$query->result_array();
		else
		return	$query->result();
		
		
		
	}
	function update_indent($data,$id)
	{
		
		$this->db->where('ind_des_id', $id);
		$q=$this->db->update($this->indent_des, $data); 
		
		if($q)
			return TRUE;
		else
			return FALSE;
	}
	
	function delete_indentBy_id($id)
	{
		
		$this->db->where('indent_id', $id);
		$this->db->delete('hc_indent_description');
		$this->db->where('indent_id', $id);
		$this->db->delete('hc_indent');
		
		
	}
	
	
	

}

?>