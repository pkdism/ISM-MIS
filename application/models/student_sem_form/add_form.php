<?php
class Add_form extends CI_Model
{
	var $sem_form = 'stu_sem_reg_form';
	var $sem_fee = 'stu_sem_reg_fee';
	var $sem_subject = 'stu_sem_reg_subject';
	var $carryover = 'stu_sem_carryover';
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	
	function insertSemForm($data){
		$this->db->insert($this->sem_form, $data);
		return $this->db->_error_message(); 
	}
	
	function insertSemFee($data){
		$this->db->insert($this->sem_fee, $data);
		return $this->db->_error_message(); 
	}
	
	function insertSemSubject($data){
		$this->db->insert($this->sem_subject, $data);
		return $this->db->_error_message(); 
	}
	
	function insertCarryover($data){
		$this->db->insert($this->carryover, $data);
		return $this->db->_error_message(); 
	}
	
}?>