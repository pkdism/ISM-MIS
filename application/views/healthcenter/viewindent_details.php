<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	<div id="printableArea">
	<div class="box box-solid box-primary">
				<h2 class="page-header">Indian School of Mines</h2>
	<div class="table-responsive">					
					<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Indent Reference No.</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo $indent_details[0]->indent_ref_no; ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Date</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo date('d M Y', strtotime($indent_details[0]->indent_date)); ?>
									
								</div>
							</div>
						
						</div>	
	
	<h2 class="page-header">List of Medicines to be Purchased for ISM Health Centre</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Present Stock</td>
		<td>Group</td>
		<td>MFG.Co</td>
		<td>Std.Packet</td>
		<td>Approx.Rate</td>
		<th>Quantity</th>
		<th>Approx.Cost</th>
		
		
		
		</tr>
		</thead>
		<tbody>
		<?php $total = 0; ?>
		<?php  foreach($indent_details as $b){ ?>
		
							<tr>
		
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->c_stock); ?></td>
									<td><?php echo strtoupper($b->m_group); ?></td>
							    	<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->std_pkt); ?></td>
									<td><?php echo strtoupper($b->app_rate); ?></td>
									<td><?php echo strtoupper($b->ind_qty); ?></td>
									<td align="right"><?php echo strtoupper($b->app_cost); ?></td>
		
								</tr>
									 
								<?php $total = $total + $b->app_cost;  } ?>
								<tr>
								<td colspan="6"></td>
								<td>Total:</td>
								<td align="right"><?php echo $total ?></td>
								</tr>
		</tbody>
		
		</table>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="indrefno">Name of the Stokist/Distributors</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<?php echo $indent_details[0]->s_name; ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">Dealing Assistant</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">Lady Medical Officer</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">Senior Medical Officer</label>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="indrefno">RECOMMEDATION OF HEALTH CENTRE PURCHASE COMMITTEE</label>
									<label for="indrefno">Health Centre Medicine Purchase Committee Recoments Purchase of above</label>
									<label for="indrefno">medicines subject to approval to the competent authority</label>
								</div>
							</div>
							
						
						</div>	
						<div class="row">
						<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Chairman</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Member</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Member</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Member</label>
								</div>
							</div>
						
						</div>
						<div class="row">
						
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">Member</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">LMO Member</label>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">SMO Member Secretary</label>
								</div>
							</div>
						
						</div>
						<div class="row">
						
							<div class="col-md-4">
								<div class="form-group">
									<label for="indrefno">REGISTRAR</label>
								</div>
							</div>
										
						</div>
	</div>
						<div class="row">
						
							<div class="col-md-4">
								
									<button type="button" onclick="printDiv('printableArea')" class="btn btn-primary">Print</button>
								
							</div>
							
										
						</div>
	
	</div>
	</div>
</div>
</div>

<div class="modal fade" tableindex="-1" role="dialog" aria-hidden="true" id="viewreport">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Indent Details</h3>
				</div>
				<div class="modal-body">
				<div id="reportresult">
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}


</script>
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

