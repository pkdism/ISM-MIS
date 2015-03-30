<?php 

class Report_new_file_ajax extends CI_Controller
{
	function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		// Will never be used
	}

		
		public function get_supplier($id)
	{
		$s='<select>
			<option value="">--------------No Supplier Found-------------</option>
			</select>';
		
		$this->load->model('healthcenter/medicine_model','',TRUE);
		$result = $this->medicine_model->get_supplier_bymedicineid($id);
		$data['result'] = $result;
		
		if(is_array($data['result'])){
			$s="";
		$s.='<select name="suppliername" class="form-control">';
		foreach($data['result'] as $r){
			$s.='<option value="'.$r->s_id.'">'.$r->s_name.'</option>';
			
		}
		$s.="</select>";
		}
		
				echo $s;
	}
	
	


	
	
	
}