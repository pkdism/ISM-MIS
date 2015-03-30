<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Report_model extends CI_Model

{
	var $table = 'hc_medicine';
	
	
	public function __construct() 
    { 
        parent::__construct(); 
       
    } 
	
	
	function getData($supp_id,$manu_id,$from_date,$to_date)
	{
		
		$sql= "SELECT 
		`hc_medicine`.`m_id`,
  `hc_medicine`.`m_name`,
  `hc_medi_receive`.`supp_date`,
  `hc_medi_receive`.`mrec_qty`,
  `hc_manufacturer`.`manu_name`
FROM
  `hc_indent`
  INNER JOIN `hc_supplier` ON (`hc_indent`.`s_id` = `hc_supplier`.`s_id`)
  INNER JOIN `hc_pur_order` ON (`hc_indent`.`indent_id` = `hc_pur_order`.`indent_id`)
  INNER JOIN `hc_medi_receive` ON (`hc_pur_order`.`po_id` = `hc_medi_receive`.`po_id`)
  INNER JOIN `hc_medicine` ON (`hc_medi_receive`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
WHERE
  1 = 1  ";
		
		//print_r($sql);
			//die;
			
			if ($supp_id)
			{
					$sql .= " AND hc_supplier.s_id='".$supp_id."'";
  			}
			if ($manu_id)
			{
					$sql .= " AND hc_manufacturer.manu_id='".$manu_id."'";
			}
			
			
			if ($from_date !='1970-01-01' && $to_date !='1970-01-01')
			{
					$sql .= " AND supp_date BETWEEN CAST('".$from_date."' AS DATE) AND CAST('".$to_date."' AS DATE)";
			}
			
		//print_r($sql);
		//	die;
			$query = $this->db->query($sql);
			if($query->num_rows() == 0)	return FALSE;
			return ($query->result());
	
		
		/*$query = $this->db->query("SELECT 
  `hc_medicine`.`m_name`,
  `hc_medi_receive`.`supp_date`,
  `hc_medi_receive`.`mrec_qty`,
  `hc_manufacturer`.`manu_name`
FROM
  `hc_indent`
  INNER JOIN `hc_supplier` ON (`hc_indent`.`s_id` = `hc_supplier`.`s_id`)
  INNER JOIN `hc_pur_order` ON (`hc_indent`.`indent_id` = `hc_pur_order`.`indent_id`)
  INNER JOIN `hc_medi_receive` ON (`hc_pur_order`.`po_id` = `hc_medi_receive`.`po_id`)
  INNER JOIN `hc_medicine` ON (`hc_medi_receive`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
WHERE
  `hc_supplier`.`s_id` ='".$id."'");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;*/
			
	}
	/*function getData()
	{
			
			$this->db->select('*');
			$this->db->from('hc_medicine');
			$this->db->join('hc_manufacturer', 'hc_medicine.manu_id = hc_manufacturer.manu_id');
			$this->db->order_by('hc_medicine.m_name','asc');
			$query = $this->db->get();
			if($query->num_rows() > 0)
			{	
			return $query->result();
			}
			else
			{
				return FALSE;
			}
	}*/
	function getData_manu($manu_id,$from_date,$to_date)
	{
		
		$sql= "SELECT 
  `hc_medicine`.`m_name`,
  `hc_manufacturer`.`manu_name`,
  `hc_medi_receive`.`supp_date`,
  `hc_medi_receive`.`mrec_qty`
FROM
  `hc_medi_receive`
  INNER JOIN `hc_medicine` ON (`hc_medi_receive`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
WHERE
  1 = 1
  ";
		
			
			if ($manu_id)
			{
					$sql .= " AND hc_manufacturer.manu_id='".$manu_id."'";
			}
			if ($from_date !='1970-01-01' && $to_date !='1970-01-01')
			{
					$sql .= " AND supp_date BETWEEN CAST('".$from_date."' AS DATE) AND CAST('".$to_date."' AS DATE)";
			}
			$query = $this->db->query("$sql");
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
	}
	
	function getData_Exp($from_date,$to_date)
	{
		
		$sql= "SELECT 
  `hc_medicine`.`m_id`,
  `hc_medicine`.`m_name`,
  `hc_manufacturer`.`manu_name`,
  `hc_medi_receive`.`supp_date`,
  `hc_medi_receive`.`mfg_date`,
  `hc_medi_receive`.`exp_date`,
  `hc_medi_receive`.`mrec_qty`
FROM
  `hc_medicine`
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
  INNER JOIN `hc_medi_receive` ON (`hc_medicine`.`m_id` = `hc_medi_receive`.`m_id`)
  where 1=1

  ";
		
			if ($from_date !='1970-01-01' && $to_date !='1970-01-01')
			{
					$sql .= " AND exp_date BETWEEN CAST('".$from_date."' AS DATE) AND CAST('".$to_date."' AS DATE)";
			}
			
			$query = $this->db->query("$sql");
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
	}
	function getData_medi($m_id)
	{
		
		$sql= "	
		SELECT *
FROM
  `hc_medicine`
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
WHERE
  `m_generic_nm` = (SELECT `hc_medicine`.`m_generic_nm` FROM `hc_medicine` WHERE `m_id` =".$m_id." )

		
		";

			
			$query = $this->db->query($sql);
			if($query->num_rows() == 0)	return FALSE;
			return $query->result();
		

		
			
	}
	

	
	
	
}

?>