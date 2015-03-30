<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
						
		
	
	<h2 class="page-header">Comparison of Rate Contract</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		<td>Medicine Name</td>
		<td>Manufacturer Name</td>
		<td>Discount By Manufacturer</td>
		<td>Supplier Name</td>
		<td>Discount By Supplier</td>
		
		</tr>
		</thead>
		<tbody>
		
		<?php  foreach($show_list as $b){ ?>
		<tr>
									
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->mdis); ?></td>
									<td><?php echo strtoupper($b->s_name); ?></td>
									<td><?php echo strtoupper($b->sdis); ?></td>
									
									
									
									
									
									
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

