<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
						
		
	
	<h2 class="page-header">Manufacturer Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Manufacturer Name</td>
		<td>Manufacturer Address</td>
		<td>Manufacturer Contact Person Name</td>
		<td>Manufacturer Contact Number</td>
		<td>Manufacturer Regional Office Address</td>
		<td>Regional Office Contact Person Name</td>
		<td>Regional Office Contact Number</td>
		<td>Group</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_list as $b){ 
		
		?>
		<tr>
									
									
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->manu_address); ?></td>
									<td><?php echo strtoupper($b->manu_con_person); ?></td>
									<td><?php echo strtoupper($b->manu_con_num); ?></td>
									<td><?php echo strtoupper($b->m_ro_address); ?></td>
									<td><?php echo strtoupper($b->m_ro_con_person); ?></td>
									<td><?php echo strtoupper($b->m_ro_con_num); ?></td>
									<td><?php echo strtoupper($b->m_group); ?></td>
									
									
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

<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

