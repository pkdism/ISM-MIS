<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
	<div class="table-responsive">					
		
	
	<h2 class="page-header">Suppliers Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Supplier Name</td>
		<td>Supplier Address</td>
		<td>Email-ID</td>
		<td>TIN No.</td>
		<td>CST No.</td>
		<td>Drug Licence No.</td>
		<td>Phone No.</td>
		<td>Contact Person Name</td>
		<td>Contact Person Mobile No.</td>
		<td>Bank Name</td>
		<td>Account No.</td>
		<td>IFCS Code</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		
		?>
		<tr>
								
									
									<td><?php echo strtoupper($b->s_name); ?></td>
									<td><?php echo strtoupper($b->s_address1." ".$b->s_address2." ".$b->s_address3)." ".$b->s_city." ".$b->s_state; ?></td>
									<td><?php echo strtoupper($b->email_id); ?></td>
									<td><?php echo strtoupper($b->s_tin_no); ?></td>
									<td><?php echo strtoupper($b->s_cst_no); ?></td>
									<td><?php echo strtoupper($b->s_dl_no); ?></td>
									<td><?php echo strtoupper($b->s_phone_no); ?></td>
									<td><?php echo strtoupper($b->s_c_Person); ?></td>
									<td><?php echo strtoupper($b->s_c_Person_mob); ?></td>
									<td><?php echo strtoupper($b->bank_name); ?></td>
									<td><?php echo strtoupper($b->acc_no); ?></td>
									<td><?php echo strtoupper($b->ifcs_code); ?></td>
									
									
								</tr>
								<?php  } ?>
		</tbody>
		</tbody>
		</tbody>
		</tbody>
		</table>
	
	</div>
	</div>
	
</div>
</div>

<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

