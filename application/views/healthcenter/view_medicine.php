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
		
	
	<h2 class="page-header">Medicine Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Manufacturer Name</td>
		<td>Rack No.</td>
		<td>Cabinet No.</td>
		<td>Stock</td>
		<td>Threshold</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		
		?>
		<tr>
									
									
									
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->rack_no); ?></td>
									<td><?php echo strtoupper($b->cabi_no); ?></td>
									<td><?php echo( $b->c_stock + $this->medicine_model->getMrecQtyById($b->m_id)->mrec_qty); ?></td>
									<td><?php echo strtoupper($b->threshold); ?></td>
									
									
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

