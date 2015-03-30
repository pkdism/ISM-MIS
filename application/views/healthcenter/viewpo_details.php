<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
	<div id="printableArea">
	<div class="box box-solid box-primary">
				
	<div class="table-responsive">					
					<div class="row">
							
							<div class="col-md-3">
								<div class="form-group">
									<?php echo $po_details[0]->s_name; ?><br>
									<?php echo $po_details[0]->s_address1; ?><br>
									<?php echo $po_details[0]->s_address2; ?><br>
									<?php echo $po_details[0]->s_address3; ?><br>
									<?php echo $po_details[0]->s_city; ?><br>
								</div>
							</div>
					</div>
					<div class="row">		
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Purchase Order Reference No.</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo $po_details[0]->po_refno; ?>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="indrefno">Date</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<?php echo date('d M Y', strtotime($po_details[0]->po_date)); ?>
									
								</div>
							</div>
						
						</div>	
						
						
								
	
	<h3 class="page-header">Please arrange to supply the following medicines to ISM Health Center</h3>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Pack</td>
		<th>Quantity</th>
		
		</tr>
		</thead>
		<tbody>
		
		<?php  foreach($po_details as $b){ ?>
		
							<tr>
		
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->std_pkt); ?></td>
									
									<td><?php echo strtoupper($b->ind_qty); ?></td>
									
								</tr>
									 
								<?php   } ?>
								
		</tbody>
		
		</table>
						
					
<div class="row">

			<div class="col-md-12">
								<div class="form-group">
									<label for="smo">Term & Conditions are given below:</label><br><br><br>
									
								<label for="smo">1. The above material should be supplied within 10 days from the date of receipt of this order</label>
								<label for="smo">2. All Medicines should not have expairy date less thean one year. Product must be current product only           </label>
								<label for="smo">3. At the time of submission of bill, please enclose the copy or order, failing which bill will not processed. Bill must address in favour of Registrar, Indian school of Mines, Dhanbad. Please submit the bill to Senoir Medical offier ISM, Health Centre.          </label>
								<label for="smo">4.Please Indicate your Licence No., BST/CST/TIM/ on the body of the bill. The bill No. should contain MRP, Product Name and its brand, date of expairy, rate and taxes etc.           </label>
								<label for="smo">5. Please Confirm that the price quoted are not more than that of supplied to any Goverment organisation in Dhanbad/Jharkhand           </label>
								<label for="smo">6. 100% Payment will be raised within 30 days after receipt & acceptance of the material by SMO, ISM Health Centre.           </label>
								<label for="smo">7. All legal matters will be subject to Jharkhand jurisdaction only           </label>
								<label for="smo">8. If any of the ordered medicines is out of stock, please inform the SMO ISM, Health Centre immediately, so that alternative aggangement may be done           </label>
							</div>

			
					<div class="row" align="center">
						
							<div class="col-md-12">
								<div class="form-group">
									<label for="smo">Senior Medical Officer</label>
								</div>
								<div class="form-group">
									<label for="smo">For, Indian School of Mines</label>
								</div>
							</div>
										
						</div>
	</div>
						<div class="row">
						
							<div class="col-md-12">
								
									<button type="button" onclick="printDiv('printableArea')" class="btn btn-primary">Print</button>
								
							</div>
							
										
						</div>	
</div>
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

