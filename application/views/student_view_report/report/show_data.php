
	<?php
if(isset($show_details) && is_array($show_details))
{
	$dept_nm = $this->input->post('department_name');
	$course_nm = $this->input->post('course');
	$branch_nm = $this->input->post('branch');
	$sem_nm = $this->input->post('semester');
	$state_nm = $this->input->post('state');
	$marks = $this->input->post('marks');
	$op_type = $this->input->post('opmarks');
	$category = $this->input->post('category');
	$bgroup = $this->input->post('bgroup');
	$year = $this->input->post('year');
	$headreport="Report of All ";
	
			if ($dept_nm)
			{
					$headreport .= $dept_nm." -> ";
			}
			if ($course_nm)
			{
					$headreport .=$course_nm." -> ";
			}
			if ($branch_nm)
			{
					$headreport .=$branch_nm." -> ";
			}
			if ($sem_nm)
			{
					$headreport .=$sem_nm." -> ";
			}
			if ($state_nm)
			{
					$headreport .=$state_nm." -> ";
			}
			if ($category)
			{
					$headreport .=$category." -> ";
			}
			if ($bgroup)
			{
					$headreport .=$bgroup." -> ";
			}
			if ($year)
			{
					$headreport .=$year." -> ";
			}
	
$ui = new UI();
$stuRow = $ui->row()->open();
			$col1 = $ui->col()->width(12)->open();
				$box = $ui->box()
						->title(strtoupper($headreport))
						->solid()	
						->uiType('primary')
						->open();
                    
					// Table First Row start
					$stuRow1 = $ui->row()->open();
					$col2 = $ui->col()->width(12)->open();
					//$table = $ui->table()->responsive()->hover()->bordered()->id('state')->open();
					
					
					?>
					<table class="table table-bordered" id="state_repo">
								<thead>
								<tr>
									<th>Admission No</th>
									<th>Name</th>
									<th>Dept</th>
									<th>Course</th>
									<th>Branch</th>
									<th>Mobile No.</th>
									<th>Email-ID</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $i=1; foreach($show_details as $b){ 
								 if($b->middle_name="Na")
								 {
									 $mname=" ";
								 }
								 else
								 {
									 $mname=$b->middle_name;
								 }
								?>
								<tr>
									<td><?php echo $b->admn_no; ?></td>
									<td><?=($b->first_name ." ". $mname." ". $b->last_name) ?></td>
									<td><?php echo strtoupper($b->dept_id); ?></td>
									<td><?php echo strtoupper($b->course_id); ?></td>
									<td><?php echo strtoupper($b->branch_id); ?></td>
									<td><?php echo $b->mobile_no; ?></td>
									<td><?php echo $b->email; ?></td>
									<td><a class="btn btn-primary" data-toggle="modal" value="<?php echo $b->admn_no; ?>" id="rv" onclick="my_fun_gen('<?php echo $b->admn_no; ?>')" data-target="#viewreport"  >View Profile</a></td>
								</tr>
								<?php $i++; } ?>
												
					</tbody>
					</table>
					<?php  //$table->close();
				
						$col2->close();
						$stuRow1->close();
					// Table first row end	
					
					$box->close();
									
			$col1->close();
$stuRow->close();




}
else
{
echo "No Record Found";
}

?>
<div class="modal fade" tableindex="-1" role="dialog" aria-hidden="true" id="viewreport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Student Details</h3>
				</div>
				<div class="modal-body">
				<div id="reportresult">
				</div>
			</div>
		</div>
	</div>
</div>
<style>
#viewreport .modal-dialog
{
  width: 70%;
  height: 80% !important;
	overflow-y: scroll !important;
}
#viewreport .modal-dialog .modal-content .modal-body, #reportresult{
	
	
}

</style>
<script>
$(function(){
	
	$('#state_repo').dataTable(); 
	

	
})
function my_fun_gen(id)
{
	
	//window.open("<?Php echo base_url(); ?>index.php/student_view_report/reports/viewtest/"+id,"_blank","toolbar=no, scrollbar=yes, width=800 height=600, top=50, left=100" );
	$.ajax({
		url: "<?Php echo base_url(); ?>index.php/student_view_report/reports/viewtest/"+id,
		success: function(data){
			//alert("data");
			$('#reportresult').html(data);
		}
	})
		
	
	
}
</script>