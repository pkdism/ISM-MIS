<?php

if($show_details)
{
	?>
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
		
	
	<h2 class="page-header">Medicine Group Details</h2>
		<table class="table table-bordered table-striped" id="po_show">
		<thead>
		<tr>
		
		<td>Medicine Name</td>
		<td>Group Name</td>
		<td>Manufacturer Name</td>
		<td>Quantity</td>
		
		
		
		
		</tr>
		</thead>
		<tbody>
		<?php  foreach($show_details as $b){ 
		
		?>
		<tr>
									<td><?php echo strtoupper($b->m_name); ?></td>
									<td><?php echo strtoupper($b->m_generic_nm); ?></td>
									<td><?php echo strtoupper($b->manu_name); ?></td>
									<td><?php echo strtoupper($b->c_stock); ?></td>
									
									
									
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
<?php
}
else
{?>
<div class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Error!</strong> Record Not Found
</div>


<?Php
}

?>
<script>
$(function(){
	
	$('#po_show').dataTable(); 
	

	
});
</script>

