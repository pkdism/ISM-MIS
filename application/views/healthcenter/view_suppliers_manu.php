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
		
	
	<h2 class="page-header">Suppliers Manufacturer Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Supplier Name</td>
		<td>Manufacturer Name</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		
		?>
		<tr>
									
									
									<td><?php echo strtoupper($b->s_name); ?></td>
									
									<td><?php echo strtoupper($b->manu_name); ?></td>
									
									
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

