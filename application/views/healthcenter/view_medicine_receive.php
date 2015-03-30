
<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		
	
	<div class="box box-solid box-primary">
				
					
		
	
	<h2 class="page-header">Details of Received Medicine</h2>
		<table class="table table-bordered table-striped" id="mrec_show">
		<thead>
		<tr>
		<td>Medicine Name</td>
		<td>Indented Quantity</td>
		<td>Supplied Quantity</td>
		<td>MFG. Date</td>
		<td>Exp. Date</td>
		<td>Batch No.</td>
		<td>Supply Date</td>
		<td>MRP</td>
		<td>Rate of Purchase</td>
		<td>Amount</td>
		<td>Purchase Ref. No.</td>
		
		
		
		</tr>
		</thead>
		<tbody>
		
		<?php  foreach($mrec_list as $b){ 
			
		?>
		<tr >
																	
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->ind_qty); ?></td>
									<td><?php echo strtoupper($b->mrec_qty); ?></td>
									<td><?php echo date('d M Y', strtotime($b->mfg_date)); ?></td>
									<td><?php echo date('d M Y', strtotime($b->exp_date)); ?></td>
									<td><?php echo strtoupper($b->batch_no); ?></td>
									<td><?php echo date('d M Y', strtotime($b->supp_date)); ?></td>
									<td><?php echo strtoupper($b->mrp); ?></td>
									<td><?php echo strtoupper($b->rate_of_pur); ?></td>
									<td><?php echo strtoupper($b->amount); ?></td>
									<td><?php echo strtoupper($b->po_refno); ?></td>
									
									
								</tr>
								<?php  } ?>
		</tbody>
		
		</table>
	
	</div>
	
</div>
</div>



<style>
#viewreport .modal-dialog
{
  width: 70%;
  height: 80% !important;
	
}

	
	
}

</style>

<script>
$(function(){
	
	$('#mrec_show').dataTable(); 
	

	
});
</script>