<?PHP
if ( ! defined('BASEPATH'))  exit('No direct script access allowed'); 

class Discount_model extends CI_Model

{
	
	var $mdis_tbl= 'hc_rate_dis_manu';
	var $sdis_tbl= 'hc_rate_dis_supp';
	
	
	public function __construct() 
    { 
        parent::__construct(); 
       
    } 
	
	function manu_dis_insert($data)
	{
		if($this->db->insert($this->mdis_tbl,$data))
			return TRUE;
		else
			return FALSE;
	}
	
	function supp_dis_insert($data)
	{
		if($this->db->insert($this->sdis_tbl,$data))
			return TRUE;
		else
			return FALSE;
	}
	
	
	
	function get_manu_discount()
	{
		$this->db->select("*");
		$this->db->from('hc_medicine med');
		$this->db->join('hc_manufacturer manuf','med.manu_id=manuf.manu_id');
		$this->db->join('hc_rate_dis_manu rd','rd.m_id=med.m_id');
		$query=$this->db->get();
		if($query->num_rows()!=0)
		{
			return $query->result();
		}
		else{
			return false;
		}
	}
	function get_supp_discount()
	{
		
		$query = $this->db->query("
		SELECT 
  `hc_supplier`.`s_name`,
  `hc_medicine`.`m_name`,
  `hc_rate_dis_supp`.`sdis`,
  `hc_rate_dis_supp`.`sdvfrom`,
  `hc_rate_dis_supp`.`sdvto`,
  `hc_manufacturer`.`manu_name`
FROM
  `hc_rate_dis_supp`
  INNER JOIN `hc_supplier` ON (`hc_rate_dis_supp`.`s_id` = `hc_supplier`.`s_id`)
  INNER JOIN `hc_medicine` ON (`hc_rate_dis_supp`.`m_id` = `hc_medicine`.`m_id`)
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)


		
		");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
		
		
	}
	
	function get_comparision()
	{
		
		$query = $this->db->query("

SELECT 
  `hc_medicine`.`m_name`,
  `hc_manufacturer`.`manu_name`,
  `hc_supplier`.`s_name`,
  `hc_rate_dis_manu`.`mdis`,
  `hc_rate_dis_supp`.`sdis`
FROM
  `hc_medicine`
  INNER JOIN `hc_manufacturer` ON (`hc_medicine`.`manu_id` = `hc_manufacturer`.`manu_id`)
  INNER JOIN `hc_rate_dis_manu` ON (`hc_manufacturer`.`manu_id` = `hc_rate_dis_manu`.`manu_id`)
  AND (`hc_medicine`.`m_id` = `hc_rate_dis_manu`.`m_id`)
  INNER JOIN `hc_rate_dis_supp` ON (`hc_medicine`.`m_id` = `hc_rate_dis_supp`.`m_id`)
  INNER JOIN `hc_supplier` ON (`hc_supplier`.`s_id` = `hc_rate_dis_supp`.`s_id`)
		
		
		");
		
		if($query->num_rows() > 0)
			return $query->result();
		else
			return false;
		
		
	}
	
	


}

?>