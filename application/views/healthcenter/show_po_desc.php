<?php echo form_open(''); ?>

<div class="row">
	<div class="col-md-12 ">
	<!-- Error Form-->
		<?php if(validation_errors()){ ?>
	<div class="alert alert-danger alert-dismissable">
                                <?php echo validation_errors(); ?>
    </div>
	<?php } ?>
	
	<div class="box box-solid box-primary">
				
						
		
	
	<h2 class="page-header">Indented Items to be Purchase.</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		<td>Name of Medicine</td>
		<td>Std. Pack</td>
		<td>Qty</td>
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_details as $b){ 
		?>
		<tr>
									
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->std_pkt); ?></td>
									<td><?php echo strtoupper($b->ind_qty); ?></td>
									
									
								</tr>
								<?php  } ?>
		</tbody>
		</tbody>
		</tbody>
		</tbody>
		</table>
	
	</div>
	<div class="box-footer">
				
				</div>
</div>
</div>
<?php echo form_close(); ?>
<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

