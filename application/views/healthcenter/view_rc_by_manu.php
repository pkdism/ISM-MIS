<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
						
		
	
	<h2 class="page-header">Manufacturer Rate Discount Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Manufacturer Name</td>
		<td>Medicine Name</td>
		<td>Discount Rate</td>
		<td>Valid From</td>
		<td>Valid To</td>
		
		</tr>
		</thead>
		<tbody>
		
		<?php  foreach($show_list as $b){ ?>
		<tr>
									
									
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->mdis); ?></td>
									
									<td><?php echo date('d M Y', strtotime($b->mdvfrom)); ?></td>
									<td><?php echo date('d M Y', strtotime($b->mdvto)); ?></td>
									
									
									
								</tr>
								<?php } ?>
		</tbody>
		</tbody>
		</tbody>
		</tbody>
		</table>
	
	</div>
	
</div>
</div>

<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

